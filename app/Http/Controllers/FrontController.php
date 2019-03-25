<?php

namespace App\Http\Controllers;


use App\Plugins\Categories\Model\Category;
use App\Plugins\Categories\Model\CategoryMeta;
use App\Plugins\Deliveries\Model\Delivery;
use App\Plugins\Orders\Functions\CartFunctions;
use App\Plugins\Orders\Model\OrderHeader;
use App\Plugins\Orders\Model\OrderLines;
use App\Plugins\Pages\Model\Page;
use App\Plugins\Suppliers\Model\Supplier;
use App\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/**
 * Class FrontController
 *
 * @package App\Http\Controllers
 */
class FrontController extends Controller
{

    use CartFunctions;

    private $slugPath;

    /**
     * Open page - detected by cache
     *
     * @return mixed
     */
    public function divert()
    {
        session()->flash("cu", (Auth::user() ?? User::find(99)));

        $cache = (new CacheController)->getSlugCache();

        $action = $cache->findAction();

        if (!($action ?? false)) abort(404);

        $this->slugPath = $cache->getSlugs();

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
        session()->put('lastCategory', request()->route()->parameters);

        /** @var \App\Plugins\Categories\Model\Category $category */
        $category = Category::findOrFail($categoryId);

        /** @var \App\Plugins\Products\Model\Product $products */
        $products = $category->products()
            ->whereHas('market_days', function (Builder $q) {
                $md = (new CacheController)->getSelectedMarketDay();

                return $q->where('market_day_id', $md->id);
            });

        $filters = session()->get('filters');

        if (($filters['filters'] ?? false) && $filters['category']==$category->id) {
            $products = $products->whereHas('attributeValues', function (Builder $q) use($filters) {
                $q->whereIn('attribute_value_id', $filters['filters']);
            });
        }

        if(($filters['suppliers']??false) && $filters['category']==$category->id) {
            $products = $products->whereIn('supplier_id', $filters['suppliers']);
        }

        if($searchString = request()->get('search')) {
            $products = $products->whereHas('metaData', function (Builder $q) use($searchString) {
               $q->where('meta_value', 'like', "%$searchString%")->where('language', language())->whereIn('meta_name', ['name']);
            });
        }

        $products = $products->paginate(20)
            ->pluck('id');

        $suppliers = Supplier::all()->pluck('id');

        $categoryPath = $this->slugPath;

        return view("Products::frontend.listitems", compact(['category', 'products', 'suppliers', 'categoryPath']));
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
        $suppliers = Supplier::all()->pluck('id');
        $category = Category::findOrFail($product->getData('mainCategory'));
        $categoryPath = $this->slugPath;

        return View("Products::frontend.product", compact(['product', 'suppliers', 'categoryPath', 'category']));
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
    public function homepage()
    {
        if(!pageTable()) {
            abort(404);
        }
        $homepageId = Page::where("homepage", 1)->first()->id??0;
        $slug = __("pages.slug.$homepageId");
        return (new PageController)->show($slug);
    }

    public function redrawCart()
    {
        /** @var OrderHeader $cart */
        $cart = $this->getCart(true);

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

    public function showImage($folder, $size, $image = null)
    {

        $cr = Route::currentRouteName();

        if ($cr === 'image') {
            $path = implode("/", ["public", $folder, $size, $image]);
        } elseif ($cr === 'image.nopath') {
            $path = implode("/", ["public", $folder, $image]);
        } else {
            abort(404);
        }

        if (!\Storage::exists($path)) {
            abort(404);
        }

        return response()->file(storage_path("app/$path"));
    }

    public function getFeaturedSupplier() {
        return Supplier::inRandomOrder()->first();
    }

}