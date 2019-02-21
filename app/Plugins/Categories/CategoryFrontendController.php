<?php

namespace App\Plugins\Categories;


use App\Http\Controllers\Controller;
use App\Plugins\Categories\Model\CategoryMeta;

/**
 * Class CategoryFrontendController
 *
 * @package App\Plugins\Categories
 */
class CategoryFrontendController extends Controller
{
    /**
     * @param      $language
     * @param      $cat1
     * @param bool $cat2
     * @param bool $cat3
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index($language, $cat1, $cat2 = false, $cat3 = false) {
        $category = CategoryMeta::where(["meta_value" => $cat3?:$cat2?:$cat1, 'meta_name' => 'slug'])->firstOrFail()->category;

        $products = $category->products()->paginate(20)->pluck('id');

        return view("Categories::frontend.list", compact(['category', 'products', 'cat1', 'cat2', 'cat3']));
    }

    /**
     * @param      $cat1
     * @param bool $cat2
     * @param bool $cat3
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function defaultIndex($cat1, $cat2 = false, $cat3 = false) {
        return $this->index(language(), $cat1, $cat2, $cat3);
    }
}