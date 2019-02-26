<?php

namespace App\Plugins\Orders\Functions;


use App\Http\Controllers\CacheController;
use App\Plugins\MarketDays\Model\MarketDay;
use App\Plugins\Orders\Model\OrderHeader;
use App\User;
use Illuminate\Support\Facades\Auth;

trait CartFunctions
{
    private function getCart($changedUser = null)
    {
        $cart = session()->get('ca');
        if ($changedUser && Auth::user() && $cart) {
            /** @var OrderHeader $userCart */
            $userCart = OrderHeader::where(['user_id' => Auth::user()->id])->first();
            /** @var OrderHeader $anonCart */
            $anonCart = OrderHeader::find(session()->get('cart'));

            if ($anonCart->items()->count() == 0) {
                session()->put('cart', $userCart->id);
                $anonCart->delete();
            } else {
                $userCart->items()->delete();
                $userCart->delete();
            }
        } elseif(!$cart) {
            $md = (new CacheController)->getSelectedMarketDay();

            if(!$md) {
                abort(404, "No Available MarketDays");
            }

            $cartFind = ['id' => null];


            $user = currentUser($changedUser);

            if ($cartId = session()->get('cart')) {
                $cartFind = [
                    'id'    => $cartId,
                    'state' => 'draft',
                ];
            } elseif ($user->isAnonimous()) {
                $cartFind = ['id' => null, 'state' => 'draft'];
            } elseif (!$user->isAnonimous()) {
                $cartFind = ['user_id' => $user->id, 'state' => 'draft'];
            }


            $cartUpdate = [
                'user_id'         => $user->id,
                'market_day_id'   => $md->id??null,
                'market_day_date' => $md->date??null,
            ];

            $cart = OrderHeader::updateOrCreate($cartFind, $cartUpdate);

            session()->put('cart', $cart->id);
            session()->put('ca', $cart);
        }

        return $cart;
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
                $items['items'] = view('Orders::frontend.partials.item', ['item' => $item])->render();
            }
        }

        return $items;
    }

}