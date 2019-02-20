<?php

namespace App\Plugins\Orders;

use App\Http\Controllers\CacheController;
use App\Http\Controllers\Controller;
use App\Http\Requests\Profile;
use App\Plugins\Orders\Functions\CartFunctions;
use App\Plugins\Orders\Model\OrderHeader;
use App\Plugins\Products\Model\Product;
use App\User;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{

    use CartFunctions;

    public function index()
    {
        $cart = $this->getCart();

        return view('Orders::frontend.cart', ['cart' => $cart, 'step' => 1, 'stepInclude' => 'freeDelivery']);
    }

    public function changeCartItem()
    {
        request()->validate([
            'product_id'   => 'required|numeric',
            'variation_id' => 'required|numeric',
            'amount'       => 'numeric',
            'line'         => 'numeric',
        ]);

        $lineData = [
            'id' => null,
        ];

        $cart = $this->getCart();

        if ($cartItemId = request()->get('line')) {
            $item = $cart->items()->where(['id' => $cartItemId, 'product_id' => request()->get('product_id')])->first();
            if (!$item) abort(404);
            $lineData = [
                'id' => $item->id,
            ];
        } else {
            $item = $cart->items()
                ->where(
                    [
                        'product_id'   => request()->get('product_id'),
                        'variation_id' => request()->get('variation_id'),
                    ]
                )->first();
            if ($item) {
                $lineData = [
                    'id' => $item->id,
                ];
            }
        }

        if (($item ?? false) && $item->variation_id == request()->get('variation_id')) {
            $item->increment('amount', (request()->get('amount') ?? 1));
        } else {
            $product = $this->cache()->getProduct(request('product_id'));
            $variation = $product->getVariationPrice(request('variation_id'));

            $itemData = [
                'supplier_id'    => $product->supplier_id,
                'supplier_name'  => __('supplier.name.' . $product->supplier_id),
                'product_id'     => $product->id,
                'product_name'   => __("product.name.{$product->id}"),
                'vat_id'         => $product->price->vat_id,
                'vat_amount'     => $product->price->vat,
                'vat'            => $variation->vat,
                'price'          => $variation->price,
                'display_name'   => $variation->display_name,
                'variation_size' => $variation->size,
                'discount'       => (Auth::user() ?? User::find(99))->discount(),
                'variation_id'   => request('variation_id'),
            ];
            $cartItem = $cart->items()->updateOrCreate($lineData, $itemData);
        }

        if(request()->ajax()) {
            return $this->getCartContents($cart, (($item ?? false) ? true : false));
        } else {
            return redirect()->route('cart'.isDefaultLanguage());
        }

    }

    public function checkout($edit = null)
    {
        $step = 2;
        if(Auth::user() && !Auth::user()->registered) {
            Auth::logout();
        }

        if (Auth::user() && !$edit) {
            return redirect()->route('payment' . isDefaultLanguage());
        }

        return view('Orders::frontend.userinfo', ['cart' => $this->getCart(), 'step' => $step, 'stepInclude' => 'loginToSave', 'user' => Auth::user() ?? new User]);
    }

    public function payment()
    {
        $step = 3;
        return view('Orders::frontend.payment', ['cart' => $this->getCart(), 'step' => $step, 'user' => Auth::user()?? new User]);
    }

    public function saveUserInfo(Profile $request)
    {

        $request->validated();

        $user = Auth::user() ?? null;

        if(!$user) {
            $user = User::where('email', request()->get('email'))->first() ?? new User;
        }

        $user = $user->updateOrCreate(['id' => $user->id??null], request($user->getFillable()));

        if(!Auth::user()) {
            $cart = $this->getCart();
            Auth::login($user);
            $cart->update(['user_id' => $user->id]);
        }

        return redirect()->route('payment'.isDefaultLanguage());

    }

    public function saveOrder()
    {
        $cart = $this->getCart();

        if($cart->items()->count()==0) {
            return redirect()->route('cart'.isDefaultLanguage());
        }

        $user = Auth::user()??User::where('email', (session()->get('email')??"noemailSpecified"))->first();

        if(!$user) {
            return redirect()->route('checkout'.isDefaultLanguage());
        }

        $cart->update([
            'state'   => 'ordered',
        ]);

        return redirect()->route('thankyou'.isDefaultLanguage());
    }

    public function thankyou() {
        if(!Auth::user()->registered) {
            Auth::logout();
        }
        return view('Orders::frontend.thankyou');
    }

}