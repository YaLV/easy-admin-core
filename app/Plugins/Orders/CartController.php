<?php

namespace App\Plugins\Orders;

use App\Http\Controllers\Controller;
use App\Plugins\Orders\Model\OrderHeader;
use App\Plugins\Orders\Model\OrderLines;
use App\User;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index()
    {
        return view('frontend.pages.cart');
    }

    public function addToCart()
    {
        $cart = false;

        request()->validate([
            'product_id'   => 'required|numeric',
            'variation_id' => 'required|numeric',
            'amount'       => 'numeric',
        ]);

        $product = $this->cache()->getProduct(request('product_id'));
        $variation = $product->getVariationPrice(request('variation_id'));

        $user = Auth::user();

        $cartData = [
            'user_id'         => $user->id,
            'market_day_id'   => session()->get('marketDay')->id,
            'market_day_date' => session()->get('marketDay')->date,
            'status'          => 'draft',
        ];
        // Cart
        if (!$user) {
            $user = User::find('99');
            $cart_id = session()->get('cart') ?? null;
            $cartData['id'] = $cart_id;
            $cartData['user_id'] = $user->id;
            if (!$cart_id) {
                $cart = OrderHeader::create($cartData);
            }
        }

        if (!$cart) {
            $cart = OrderHeader::updateOrCreate($cartData);
        }

        if (!$cart) {
            abort(404);
        }
        $itemData = [
            'supplier_id'    => $product->supplier_id,
            'supplier_name'  => __('supplier.name.' . $product->supplier_id),
            'product_id'     => $product->id,
            'product_name'   => __("product.name.{$product->id}"),
            'vat_id'         => $product->price['vat_id'],
            'vat_amount'     => $variation->vat_amount,
            'vat'            => $variation->vat,
            'price'          => $variation->price,
            'display_name'   => $variation->display_name,
            'variation_size' => $variation->size,
            'discount'       => abs($product->price['discount']),
            'amount'         => request('amount') ?? 1,
            'variation_id'   => request('variation_id'),
        ];
        $cart->items()->create($itemData);

        if (request()->ajax()) {
            return ['status' => 'true', 'miniCart' => $this->getCartContents($cart->id)];
        } else {
            return redirect()->back();
        }
    }

    private function getCartContents($cartId, $template = "Cart::minicartitem")
    {
        $cart = OrderHeader::find($cartId);
        $cartItems = $cart->items();

        $itemsRendered = [];
        $cartTotals = 0;
        $cartItemCount = $cartItems->count();

        foreach ($cartItems->get() as $itemOrder => $cartItem) {
            $cartTotals += $cartItem->price ?? 0;
            if ($itemOrder < 4) {
                $itemsRendered[] = view($template, ['item' => $cartItem])->render();
            }
        }

        return [
            'totalAmount' => $cartTotals,
            'itemCount'   => $cartItemCount,
            'itemsToShow' => implode("\n", $itemsRendered),
        ];
    }
}