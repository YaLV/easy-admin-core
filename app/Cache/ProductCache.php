<?php

namespace App\Cache;


use App\Http\Controllers\CacheController;
use App\Plugins\Categories\Model\Category;
use App\Plugins\Products\Model\Product;
use App\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

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
    private $units;

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
        $unitData = $product->unit;
        $this->units = [
            'unit' => $unitData->unit,
        ];
        if ($fractionData = $unitData->subUnit) {
            $this->units['fraction'] = [
                'unit'     => $fractionData->unit,
                'multiply' => $fractionData->parent_amount,
            ];
        }

    }

    private function setProductVariations($product)
    {
        $prices = [];

        foreach ($product->variations ?? [] as $variation) {
            $prices[$variation->id] = (object)[
                'display_name' => $variation->display_name,
                'amount'       => $variation->amount,
            ];
        }
        $this->variations = $prices;
    }

    private function setDefaultData($product)
    {

        // Image
        $image = $product->getImage();
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

        $this->price = (object)[
            'cost'    => $product->cost,
            'mark_up' => $product->mark_up,
            'unit_id' => $product->unit_id,
            'vat_id'  => $product->vat_id,
            'vat'     => $product->vat->amount,
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
        return $this->discount() ? true : false;
    }

    private function discount()
    {
        $user = Auth::user() ?? session()->get('user') ?? User::find(99);

        return $user->discount();
    }

    public function prices($amount = 1)
    {
        $price = [];
        foreach ($this->variations as $variationid => $variation) {
            $priceVariation = calcPrice($this->price->cost, $this->price->vat, $this->price->mark_up, $this->discount() ?? 0);
            $price[$variationid] = (object)[
                'display_name' => $variation->display_name,
                'price'        => number_format(round($priceVariation->wdiscount->price * $variation->amount, 2), 2),
                'oldPrice'     => number_format(round($priceVariation->full->wvat * $variation->amount, 2), 2),
                'vat'          => $priceVariation->wdiscount->pricevat * $variation->amount,
                'id'           => $variationid,
                'size'         => $variation->amount,
                'amountinpackage' => ($variation->amount<1 && ($this->units['fraction']??false)) ? $variation->amount*$this->units['fraction']['multiply'] : $variation->amount,
                'amountUnit'    => ($variation->amount<1 && ($this->units['fraction']??false)) ? $this->units['fraction']['unit'] : $this->units['unit'],
            ];
        }
        if ($this->hasManyPrices()) {
            return $price;
        } else {
            return current($price);
        }
    }

    public function getVariationPrice($vid)
    {
        if ($this->hasManyPrices()) {
            return $this->prices()[$vid] ?? [];
        }

        return $this->prices();
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
        $newLife = config('app.product.newLength', ['h' => 168]);

        return $created->addSeconds((((($newLife['h'] ?? 0) * 60) + (($newLife['m'] ?? 0))) * 60));
    }

    public function image($size)
    {
        $path = "/" . implode("/", ["products", $size, $this->imageUrl]);
        if (\Storage::exists("public/$path")) {
            return $path;
        }

        return config("app.defaultProductImage");
    }

    public function getUrl($includeProduct = true, $fullUrl = true)
    {
        $categoryCache = (new CacheController)->getCategoryCache();
        $path = $this->createPath($categoryCache->getPath($this->mainCategory));

        if (count($path) == 0) return "#";

        if ($includeProduct)
            return r("url", array_merge($path, ['product' => __('product.slug.' . $this->id)]), $fullUrl);

        return r("url", $path, $fullUrl);
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

    public function getData($param)
    {
        return $this->$param;
    }

    public function getOtherProducts($exclude = false)
    {

        $category = Category::find($this->mainCategory)->products();

        if ($exclude) {
            $category = $category->where('products.id', '!=', $exclude);
        }

        return $category->limit(10)->pluck('products.id');
    }
}