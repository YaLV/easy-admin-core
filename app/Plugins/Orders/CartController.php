<?php

namespace App\Plugins\Orders;

use App\Http\Controllers\Controller;
use App\Http\Requests\Profile;
use App\Plugins\Deliveries\Model\Delivery;
use App\Plugins\DiscountCodes\Model\DiscountCode;
use App\Plugins\Orders\Functions\CartFunctions;
use App\Plugins\Orders\Model\OrderHeader;
use App\Plugins\Orders\Model\OriginalOrder;
use App\Plugins\Products\Model\Product;
use App\User;
use Carbon\Carbon;
use Illuminate\Database\Query\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Antcern\Paysera\PayseraManager;
use App\Paysera;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;

/**
 * Class CartController
 *
 * @package App\Plugins\Orders
 */
class CartController extends Controller
{

    use CartFunctions;

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $cart = $this->getCart();
        $this->checkFreeDelivery($cart->id);

        return view('Orders::frontend.cart', ['cart' => $cart, 'step' => 1, 'stepInclude' => 'freeDelivery', 'pageTitle' => _t('translations.cart')]);
    }

    public function setDelivery($deliveryId)
    {
        $cart = $this->getCart();
        /** @var OrderHeader $origCart */
        $origCart = OrderHeader::find($cart->id);
        $origCart->delivery()->associate(Delivery::findOrFail($deliveryId))->save();
        $this->checkFreeDelivery($cart->id);
        session()->forget('cartObject');

        return redirect(r('cart'));
    }

    public function recreateCart($orderId)
    {
        if ($order = Auth::user()->orders($orderId)->first()) {
            foreach ($order->items()->get() as $item) {

                $req = new Request();
                $req->setMethod('POST');
                $req->request->add(['product_id' => $item->product_id, 'variation_id' => $item->variation_id, 'amount' => $item->amount]);

                $this->changeCartItem($req);
            }

            return redirect(r('cart'));
        }
        abort(404);
    }

    /**
     * @return array|\Illuminate\Http\RedirectResponse
     */
    public function changeCartItem(Request $request)
    {
        $request->validate([
            'product_id'   => 'required|numeric',
            'variation_id' => 'required|numeric',
            'amount'       => 'numeric',
            'line'         => 'numeric',
        ]);

        $lineData = [
            'id' => null,
        ];

        /** @var OrderHeader $cart */
        $cart = $this->getCart();

        if ($cartItemId = $request->get('line')) {
            $item = $cart->items()->where(['id' => $cartItemId, 'product_id' => $request->get('product_id')])->first();
            if (!$item) abort(404);
            $lineData = [
                'id' => $item->id,
            ];
        } else {
            $item = $cart->items()
                ->where(
                    [
                        'product_id'   => $request->get('product_id'),
                        'variation_id' => $request->get('variation_id'),
                    ]
                )->first();
            if ($item) {
                $lineData = [
                    'id' => $item->id,
                ];
            }
        }
        if (($item ?? false) && $item->variation_id == $request->get('variation_id')) {
            $amount = $request->get('amount');

            if (!is_null($item->products->storage_amount) && $item->products->storage_amount < ($amount * $item->variation->amount)) {
                return ['status' => false, 'message' => 'Not enough Item', 'contents' => $this->getCartContents($cart, true)];
            }


            $origSize = $item->total_amount / $item->amount;
            if ($request->get('line')) {
                $item->update(['amount' => $amount]);
            } else {
                $item->increment('amount', ($amount ?? 1));
            }
            $item->update(['total_amount' => $origSize * $amount, 'real_amount' => $origSize * $amount]);
        } else {
            $amount = $request->get('amount');

            /** @var \App\Cache\ProductCache $product */
            $product = $this->cache()->getProduct($request->get('product_id'));
            $variation = $product->getVariationPrice($request->get('variation_id'));

            if (!$item) {
                $productAmount = Product::find($product->id)->storage_amount;
                if (!is_null($productAmount) && $productAmount < ($amount * $variation->size)) {
                    return redirect()->back()->with(['message' => 'Not Enough Item']);
                }
            } elseif (!is_null($items->products->storage_amount) && $item->products->storage_amount < ($amount * $variation->size)) {
                return ['status' => false, 'message' => 'Not enough Item', 'contents' => $this->getCartContents($cart, true)];
            }

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
                'discount'       => $product->discount(),
                'variation_id'   => $request->get('variation_id'),
                'total_amount'   => $variation->amountinpackage,
                'real_amount'    => $variation->amountinpackage,
                'amount_unit'    => $variation->amountUnit,
                'amount'         => $request->get('amount') ?? 1,
                'price_raw'      => $variation->price_raw,
                'vat_raw'        => $variation->vat_raw,
                'cost'           => $variation->cost,
                'markup'         => $variation->markup,
                'markup_amount'  => $variation->markup_amount,
                'discount_name'  => $product->getDiscountName()
            ];

            if ($item) {
                if ($amount != $item->amount) {
                    $itemData['amount'] = $amount;
                }
            }

            $cartItem = $cart->items()->updateOrCreate($lineData, $itemData);
        }

        $this->checkFreeDelivery($cart->id);

        $cart = $this->getCart();

        if ($request->ajax()) {
            return ['status' => true, 'message' => 'Item Updated', 'contents' => $this->getCartContents($cart, true)];
        } else {
            return redirect(r('cart'));
        }

    }

    private function checkFreeDelivery($cartId)
    {
        $cart = OrderHeader::find($cartId);
        $totalAmount = getCartTotals($cart) ?? 0;
        if ($cart->delivery_id) {
            $delivery = $cart->delivery;
            if ($totalAmount->productSum >= ($delivery->freeAbove ?? 0)) {
                $r = $cart->update(['delivery_amount' => "0"]);

                return true;
            } else {
                $deliveryPrice = $delivery->price;
                $cart->update(['delivery_amount' => $deliveryPrice]);

                return true;
            }
        }

        return false;
    }

    /**
     * @param null $edit
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function checkout($edit = null)
    {

        $cart = $this->getCart();

        if (!$cart->delivery_id) {
            return redirect()->back()->withErorrs(['delivery' => 'Please select Delivery option']);
        }

        $cartItemCount = $cart->items()->count();

        if ($cart->currentDayItems()->count() !== $cartItemCount || $cartItemCount == 0) {
            return redirect()->back()->withErrors(["cartError" => "Cart Has undeliverable items"]);
        }


        $step = 2;
        if (Auth::user() && !Auth::user()->registered) {
            Auth::logout();
        }

        if (Auth::user() && !$edit) {
            return redirect(r('payment'));
        }

        return view('Orders::frontend.userinfo', ['cart' => $cart, 'step' => $step, 'stepInclude' => 'loginToSave', 'user' => Auth::user() ?? new User, 'pageTitle' => _t('translations.checkoutForm')]);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function payment()
    {
        // handle Paysera accepturl
        if (!is_null(request()->get('data'))) return $this->saveOrder();

        session()->forget(['paymetMethod', 'order_header_id']);

        $step = 3;

        return view('Orders::frontend.payment', ['cart' => $this->getCart(), 'step' => $step, 'user' => Auth::user() ?? new User, 'pageTitle' => _t('translations.payments')]);
    }

    /**
     * Initiate Paysera payment
     *
     * @return void
     */
    public function payseraMake()
    {
        $cart = $this->getCart();
        $cart_totals = getCartTotals($cart);

        Session::put('paymetMethod', 'paysera');
        Session::put('order_header_id', $cart->id);
        Session::save();

        PayseraManager::makePayment($cart->id, $cart_totals->toPay);
    }

    /**
     * Validate Paysera response
     *
     * return void
     */
    public function payseraValidate()
    {
        $response = PayseraManager::parsePayment(request());

        Paysera::create([
            'status'          => 'success',
            'order_header_id' => $response['orderid'],
            'amount'          => number_format(round($response['amount'] / 100, 2), 2),
        ]);

        echo 'OK';
    }

    /**
     * Check payment status
     *
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function payseraSuccess()
    {
        if (request()->ajax()) {
            if (
                session()->get('paymetMethod') == 'paysera' &&
                is_int($order_header_id = session()->get('order_header_id')) &&
                $paymentSuccess = !empty(Paysera::where(['order_header_id' => $order_header_id, 'status' => 'success'])->first())
            ) {
                session()->forget(['paymetMethod', 'order_header_id']);

                return response()->json(true);
            } else {
                return response()->json(false);
            }
        } else {
            return redirect(r('checkout'));
        }
    }

    /**
     * @param Profile $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function saveUserInfo(Profile $request)
    {

        $request->validated();

        $user = Auth::user() ?? null;

        if (!$user) {
            $user = User::where('email', request()->get('email'))->first() ?? new User;
        }

        $user = $user->updateOrCreate(['id' => $user->id ?? null], request($user->getFillable()));

        /** @var OrderHeader $cart */
        $cart = $this->getCart();
        if (!Auth::user()) {
            Auth::login($user);
            $cart->update(['user_id' => $user->id]);
        }
        $cart->update(['comments' => request('comments')]);

        return redirect(r('payment'));

    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function saveOrder()
    {
        /** @var OrderHeader $cart */
        $cart = $this->getCart();

        if ($cart->items()->count() == 0) {
            return redirect()->route('cart');
        }

        $user = Auth::user() ?? User::where('email', (session()->get('email') ?? "noemailSpecified"))->first();

        if (!$user) {
            return redirect()->route('checkout');
        }

        $cart->update([
            'state'        => 'ordered',
            'ordered_at'   => Carbon::now(),
            'payment_type' => request()->get('payment_type'),
            'city'         => $user->city,
            'address'      => $user->address,
            'postcode'     => $user->postal_code,
        ]);

        foreach ($cart->items()->get() as $cartItem) {
            $cartItem->products()->increment('storage_amount', -($cartItem->amount * $cartItem->variation_size));
            if ($cartItem->products->storage_amount < 0) {
                $cartItem->products()->update(['storage_amount' => 0]);
            }
        }

        OriginalOrder::create([
            'id' => $cart->id,
            'headers' => $cart->getOriginal(),
            'items' => $cart->items->toArray()
        ]);

        return redirect(r('thankyou'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function thankyou()
    {
        session()->forget('cart');
        if (Auth::user() && !Auth::user()->registered) {
            Auth::logout();
        }

        if (session()->get('paymetMethod') == 'paysera') $paymentMethod = 'paysera';
        else $paymentMethod = null;

        return view('Orders::frontend.thankyou', compact('paymentMethod'));
    }

    public function removeFromCart($itemId)
    {

        $cart = $this->getCart();

        $item = $cart->items()->where('id', $itemId)->first();

        if (request()->ajax()) {
            if ($item) {
                $item->delete();
                $this->checkFreeDelivery($cart->id);
                $cart = $this->getCart();

                return ['status' => true, 'message' => 'Item Removed', 'contents' => $this->getCartContents($cart, true)];
            }

            return ['status' => false, 'message' => 'Item Couldn\'t be foundRemoved'];
        } else {
            if (request('goTo') && $item) {
                $item->delete();
                $urlParts = explode("/", request('goTo'));
                unset($urlParts[0]);
                $this->checkFreeDelivery($cart->id);
                $cart = $this->getCart();

                return redirect(r('url', $urlParts));
            }

            return redirect()->back();
        }
    }

    public function discount_code()
    {

        request()->merge(['code' => strtoupper(request('code'))]);

        request()->validate([
            'code' => [
                'required',
                Rule::exists('discount_codes')->where(function (Builder $q) {
                    $q->where('uses', '>', '0')
                        ->orWhereNull('uses');
                })
                    ->where(function (Builder $q) {
                        $q->where('valid_from', '<=', Carbon::now()->format('Y-m-d'))
                            ->where(function ($qq) { $qq->where('valid_to', '>=', Carbon::now()->format('Y-m-d'))->orWhereNull('valid_to'); });
                    }),
            ],
        ]);

        /** @var DiscountCode $discount_code */
        $discount_code = DiscountCode::where('code', request('code'))->first();
        if (!is_null($discount_code->uses)) {
            $discount_code->increment('uses', -1);
        }
        $cart = $this->getCart();
        $result = $cart->update([
            'discount_code'   => request('code'),
            'discount_amount' => $discount_code->amount,
            'discount_target' => $discount_code->applied,
            'discount_type'   => $discount_code->unit,
            'discount_items'  => json_decode($discount_code->getOriginal('items')),
        ]);

        return redirect()->back()->with(['message' => 'Discount Code Added']);
    }

    public function discount_code_remove()
    {
        $cart = $this->getCart();

        $discount_code = DiscountCode::where('code', $cart->discount_code)->first();
        $discount_code->increment('uses', 1);

        $cart->update([
            'discount_code'   => null,
            'discount_amount' => null,
            'discount_target' => null,
            'discount_type'   => null,
        ]);

        return redirect()->back()->with(['message' => 'Discount Code Removed']);
    }
}