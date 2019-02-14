<?php

namespace App\Cache;


use App\Http\Controllers\CacheController;
use Carbon\Carbon;

class ProductCache
{

    private $imageUrl;
    private $discount;
    private $created;
    private $variations;
    private $categoryPath = [];
    private $mainCategory;
    private $metaFields = ['description', 'ingredients', 'expire_date', 'google_keywords', 'google_description'];
    private $metaData = [];

    public $isBio;
    public $isLv;
    public $isSuggested;
    public $isHighlighted;
    public $supplier_id;
    public $id;
    public $marketDays;
    public $price;


    public function __construct($product)
    {
        $this->discount = $product->findDiscount();
        $this->setDefaultData($product);
        $this->setProductVariations($product);
        $this->setupCategories($product);
    }

    private function setProductVariations($product)
    {
        $prices = [];

        /*$prices['orig'] = (object)[
            'price'        => calcPrice($product->cost, [$product->vat->amount, $product->mark_up, $this->discount]),
            'display_name' => '1'.$product->unit->unit,
            'oldPrice'     => calcPrice($product->cost, [$product->vat->amount, $product->mark_up]),
        ];*/


        foreach ($product->variations ?? [] as $variation) {
            $cost = $product->cost * $variation->amount;
            $price = calcPrice($cost, [$product->vat->amount, $product->mark_up, $this->discount]);
            $prices[$variation->id] = (object)[
                'price'        => $price,
                'display_name' => $variation->display_name,
                'oldPrice'     => calcPrice($cost, [$product->vat->amount, $product->mark_up]),
                'vat'          => $price - calcPrice($cost, [$product->mark_up]),
                'vat_amount'   => $product->vat->amount,
                'size'         => $variation->size,
            ];
        }
        $this->variations = $prices;
    }

    private function setDefaultData($product)
    {

        // Image
        $image = $product->image();
        $this->imageUrl = $image ? $image->filePath : config("app.defaultProductImage");

        // New
        $this->created = $this->getNewUntil($product->created_at);

        // ID
        $this->id = $product->id;

        // Supplier
        $this->supplier_id = $product->supplier_id;

        // main category
        $this->mainCategory = $product->main_category;

        //Product Description

        foreach (languages() as $language) {
            foreach ($product->metaData()->whereIn('meta_name', $this->metaFields)->get() as $meta) {
                $this->metaData[$meta->meta_name][$language->code] = $meta->meta_value;
            }
        }

        // Badge stuff
        foreach (['is_bio', 'is_lv', 'is_suggested', 'is_highlighted'] as $isIt) {
            $param = camel_case($isIt);
            $this->$param = $product->$isIt;
        }

        $this->sku = $product->sku;

        $this->price = [
            'cost'    => $product->cost,
            'mark_up' => $product->mark_up,
            'unit_id' => $product->unit_id,
            'vat_id'  => $product->vat_id,
        ];

        $this->marketDays = $product->market_days->pluck('id')->toArray();
    }

    private function setupCategories($product)
    {
        $this->formCategoryPath($product->main_cat);
    }

    private function formCategoryPath($category)
    {
        $this->categoryPath[] = $category->id;
        $parentCategory = $category->parent;
        if ($parentCategory) {
            $this->formCategoryPath($parentCategory);
        }
    }

    public function isSale()
    {
        return $this->discount ? true : false;
    }

    public function prices()
    {
        if ($this->hasManyPrices()) {
            return $this->variations;
        } else {
            return current($this->variations);
        }
    }

    public function getVariationPrice($vid)
    {
        return $this->variations[$vid] ?? [];
    }

    public function hasManyPrices()
    {
        return count($this->variations) > 1;
    }

    public function isNew()
    {
        return Carbon::now()->diffInSeconds($this->created, false) > 0;
    }

    private function getNewUntil($created)
    {
        $newLife = config('app.product.newLength', ['h' => 24]);

        return $created->addSeconds((((($newLife['h'] ?? 0) * 60) + (($newLife['m'] ?? 0))) * 60));
    }

    public function image($type = 'list')
    {
        return $this->imageUrl[$type] ?? config('app.defaultProductImage');
    }

    public function getUrl()
    {
        $categoryCache = (new CacheController)->getCategoryCache();
        $path = $this->createPath($categoryCache->getPath($this->mainCategory));

        if (count($path) == 0) return "#";

        return r("url" . isDefaultLanguage(), array_merge($path, ['product' => __('product.slug.' . $this->id)]));
    }

    public function createPath($catList)
    {
        $pathParts = [];
        foreach ($catList as $oid => $category) {
            $nid = $oid + 1;
            $pathParts['slug' . $nid] = __("category.slug.$category");
        }

        return $pathParts;
    }

    public function createBreadcrumbs()
    {
        $categoryCache = (new CacheController)->getCategoryCache();
        $path = $this->createBreadCrumbPath($categoryCache->getPath($this->mainCategory));

        return $path;
    }

    public function createBreadCrumbPath($catList)
    {
        $pathParts = [];
        $slugs = [];
        foreach ($catList as $oid => $category) {
            $nid = $oid + 1;
            $slugs[$nid] = __("category.slug.$category");
            $pathParts[] = ['url' => r('url', $slugs), 'name' => __("category.name.$category")];
        }

        return $pathParts;
    }

    public function getMeta($field, $language = null)
    {
        return $this->metaData[$field][$language] ?? $this->metaData[$field][language()] ?? "";
    }

    public function supplier()
    {
        return (new CacheController)->getSupplier($this->supplier_id);
    }
}