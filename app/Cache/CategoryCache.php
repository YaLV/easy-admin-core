<?php

namespace App\Cache;


use App\Plugins\Categories\Model\Category;

class CategoryCache
{
    private $categories;
    private $categoryTree;
    private $products = [];

    public function __construct() {
        $categoryList = [];
        $categories = Category::all();

        $this->categories = $categories->pluck('id')->toArray();

        foreach($categories as $category) {
            $this->products[$category->id] = $category->products()->pluck('id')->toArray();
            $categoryList[$category->id] = $category->parent_id??0;
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
}