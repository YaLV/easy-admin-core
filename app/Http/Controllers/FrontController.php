<?php

namespace App\Http\Controllers;


use App\Plugins\Categories\Model\Category;
use App\Plugins\Categories\Model\CategoryMeta;
use App\Plugins\Menu\Model\FrontendMenu;
use App\Plugins\Products\Model\Product;
use Illuminate\Support\Facades\Cache;

class FrontController extends Controller
{

    public function divert() {
        $cache = (new CacheController)->getSlugCache();


        $action = $cache->findAction();

        if(!($action??false)) abort(404);

        return $this->{$action['action']}($action['slug'], $action['id']);
    }

    public function showCategory($categorySlug, $categoryId) {
        $category = Category::findOrFail($categoryId);

        $products = $category->products()->paginate(20)->pluck('id');

        return view("Products::frontend.listitem", compact(['category', 'products']));
    }

    public function showProduct($productSlug, $productId) {

        $product = (new CacheController)->getProduct($productId);

        return View("Products::frontend.product", compact(['product']));
    }

    public function getItems() {
        list($cat1, $cat2, $cat3) = [request()->route('category1'), request()->route('category2'), request()->route('category3')];
        $products = CategoryMeta::where(["meta_value" => $cat3?:$cat2?:$cat1, 'meta_name' => 'slug'])->firstOrFail()->category->products()->pluck('id')->toArray();

        return $products;
    }

}