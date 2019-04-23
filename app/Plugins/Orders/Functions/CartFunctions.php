<?php

namespace App\Plugins\Orders\Functions;


use App\Http\Controllers\CacheController;
use App\Plugins\MarketDays\Model\MarketDay;
use App\Plugins\Orders\Model\OrderHeader;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;

trait CartFunctions
{
    private function getCart($changedUser = null)
    {

        // Find Cart in Session
        $cart = session()->get('cart');

        // Check DB if it has a record
        $cartObject = OrderHeader::find($cart);

        // If user logged in
        if ($changedUser && Auth::user() && $cart && $cartObject) {
            /** @var OrderHeader $userCart */
            $userCart = OrderHeader::where(['user_id' => Auth::user()->id])->first();

            /** @var OrderHeader $anonCart */
            $anonCart = OrderHeader::find(session()->get('cart'));

            if ($anonCart->items()->count() == 0) {
                if(!$userCart) {
                    $anonCart->update(['user_id' => Auth::user()->id]);
                    session()->put('cart', $anonCart->id);
                    $cartObject = $anonCart;
                } else {
                    session()->put('cart', $userCart->id);
                    $anonCart->forceDelete();
                    $cartObject = $userCart;
                }
            } else {
                $anonCart->update(['user_id' => Auth::user()->id]);
                if($userCart) {
                    $userCart->items()->delete();
                    $userCart->forceDelete();
                }
                $cartObject = $anonCart;
            }
            // if there is no cart or cartObject
        } elseif(!$cart || !$cartObject) {
            $user = Auth::user();

            $md = (new CacheController)->getSelectedMarketDay();

            if(!$md) {
                abort(404, "No Available MarketDays");
            }

            // if user is logged in - check if he has cart
            if($user) {
                $cartObject = $user->cart()->where('state', 'draft')->first();
            }

            // if there is no cart - create one
            if(!$cartObject) {
                $cartObject = OrderHeader::create([
                    'user_id'         => $user->id??99,
                    'market_day_id'   => $md->id??null,
                    'market_day_date' => $md->date??null,
                ]);
            }

            // Save created/found cart id in session
            session()->put('cart', $cartObject->id);
        }

        session()->flash('cartObject', $cartObject);
        return $cartObject;
    }

    private function getCartContents($cart, $cartType = false)
    {
        return array_merge(['cartTotals' => getCartTotals($cart)], $this->renderCartItems($cart, $cartType));
    }

    private function renderCartItems($cart, $bothCarts)
    {
        $items = [];
        foreach ($cart->items as $item) {
            $items['miniItems'] = view('Orders::frontend.partials.miniitem', ['item' => $item])->render();
            if ($bothCarts) {
                $items['items'] = view('Orders::frontend.partials.item', ['item' => $item, 'cart' => $cart])->render();
            }
        }

        return $items;
    }

    public function updateCartDay($md) {
        $cart = $this->getCart();

        $cart->update(['market_day_id' => $md->id, 'market_day_date' => $md->date]);
        return true;
    }
}