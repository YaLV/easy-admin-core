<?php

namespace App\Cache;


use App\Plugins\Admin\Model\File;
use App\Plugins\Categories\Model\Category;

class CategoryCache
{
    private $categories;
    private $categoryTree;
    private $products = [];
    private $image = [];
    private $filters = [];

    public function __construct() {
        $categoryList = [];
        $categories = Category::all();

        $this->categories = $categories->pluck('id')->toArray();

        foreach($categories as $category) {
            /** @var Category $category */
            $this->filters[$category->id] = $category->filters()->pluck('id')->toArray();
            $this->products[$category->id] = $category->products()->pluck('id')->toArray();
            $categoryList[$category->id] = $category->parent_id??0;
            /** @var File|null $cimage */
            $cimage = $category->getImage();
            $this->image[$category->id] = $cimage?$cimage->filePath:null;
        }

        $this->categoryTree = $categoryList;
    }

    public function getPath($categoryId) {
        return $this->findParent($categoryId);
    }

    public function findParent($categoryId) {
        if($categoryId==0) return [];
        return array_merge($this->findParent($this->categoryTree[$categoryId]), [$categoryId]);
    }

    public function image($size, $categoryId)
    {
        $path = "/".implode("/", ["categories", $size, $this->image[$categoryId]]);
        if(\Storage::exists("public/$path")) {
            return $path;
        }

        return config("app.defaultCategoryImage");
    }

    public function getFilters($categoryId) {
        return $this->filters[$categoryId];
    }
}