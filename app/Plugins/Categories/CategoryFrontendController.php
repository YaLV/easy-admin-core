<?php

namespace App\Plugins\Categories;


use App\Http\Controllers\Controller;
use App\Plugins\Categories\Model\CategoryMeta;

class CategoryFrontendController extends Controller
{
    public function index($language, $cat1, $cat2 = false, $cat3 = false) {
        $category = CategoryMeta::where(["meta_value" => $cat3?:$cat2?:$cat1, 'meta_name' => 'slug'])->firstOrFail()->category;

        $products = $category->products()->paginate(20)->pluck('id');

        return view("Categories::frontend.list", compact(['category', 'products', 'cat1', 'cat2', 'cat3']));
    }

    public function defaultIndex($cat1, $cat2 = false, $cat3 = false) {
        return $this->index(language(), $cat1, $cat2, $cat3);
    }
}