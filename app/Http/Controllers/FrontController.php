<?php

namespace App\Http\Controllers;


use App\Plugins\Categories\Model\Category;
use App\Plugins\Categories\Model\CategoryMeta;
use App\Plugins\Orders\Functions\CartFunctions;
use App\Plugins\Orders\Model\OrderHeader;
use App\Plugins\Orders\Model\OrderLines;
use App\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

/**
 * Class FrontController
 *
 * @package App\Http\Controllers
 */
class FrontController extends Controller
{

    use CartFunctions;

    /**
     * Open page - detected by cache
     *
     * @return mixed
     */
    public function divert()
    {
        $cache = (new CacheController)->getSlugCache();


        $action = $cache->findAction();

        if (!($action ?? false)) abort(404);

        return $this->{$action['action']}($action['slug'], $action['id']);
    }

    /**
     * Show Category products
     *
     * @param $categorySlug
     * @param $categoryId
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showCategory($categorySlug, $categoryId)
    {
        /** @var \App\Plugins\Categories\Model\Category $category */
        $category = Category::findOrFail($categoryId);

        /** @var \App\Plugins\Products\Model\Product $products */
        $products = $category->products()
            ->whereHas('market_days', function (Builder $q) {
                $md = (new CacheController)->getSelectedMarketDay();

                return $q->where('market_day_id', $md->id);
            });

        if (($filters ?? false)) {
            $products = $products->whereHas('attributeValues', function (Builder $q) {
                $q->whereIn('attribute_value_id', request('attributes'));
            });
        }

        $products = $products->paginate(20)
            ->pluck('id');

        return view("Products::frontend.listitem", compact(['category', 'products']));
    }

    /**
     * Show Product opening
     *
     * @param $productSlug
     * @param $productId
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showProduct($productSlug, $productId)
    {

        $product = (new CacheController)->getProduct($productId);

        return View("Products::frontend.product", compact(['product']));
    }

    /**
     * Get current category product id's
     *
     * @return mixed
     */
    public function getItems()
    {
        list($cat1, $cat2, $cat3) = [request()->route('category1'), request()->route('category2'), request()->route('category3')];
        $products = CategoryMeta::where(["meta_value" => $cat3 ?: $cat2 ?: $cat1, 'meta_name' => 'slug'])->firstOrFail()->category->products()->pluck('id')->toArray();

        return $products;
    }

    /**
     * Get cart total value
     *
     * @return object
     */
    public function getCartTotals()
    {
        return getCartTotals($this->getCart());
    }

    /**
     * Get cart items
     *
     * @return mixed
     */
    public function getCartItems()
    {
        return $this->getCart()->items;
    }

    /**
     * Get current page
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function page()
    {
        return view('frontend.pages.home');
    }

    public function redrawCart()
    {
        /** @var User $user */
//        $user = (Auth::user() ?? User::find(99));

        /** @var OrderHeader $cart */
        $cart = $this->getCart(true);

//        $cart->update(['user_id' => $user->id]);

        /** @var OrderLines $item */
        foreach ($cart->items as $item) {

            $lineData = ['id' => $item->id];

            $product = $this->cache()->getProduct($item->product_id);
            $variation = $product->getVariationPrice($item->variation_id);

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
                'variation_id'   => $item->variation_id,
            ];
            $item->updateOrCreate($lineData, $itemData);
        }

        return $cart->id;
    }

    public function findCart($user)
    {
        /** @var OrderHeader $currentCart */
        $currentCart = OrderHeader::find(session()->get('cart'))->first();

        if ($user == 99) {
            return $currentCart;
        } else {
            /** @var OrderHeader $previousCart */
            $previousCart = OrderHeader::where(['user_id' => Auth::user()->id, 'state' => 'draft'])->first();
        }

        $cartHasItems = $currentCart->items()->count();
        if ($previousCart) {
            if (!$cartHasItems) {
                session()->put('cart', $previousCart->id);

                return $previousCart;
            }
            $previousCart->items()->delete();
            $previousCart->delete();
        }

        return $currentCart;
    }
}