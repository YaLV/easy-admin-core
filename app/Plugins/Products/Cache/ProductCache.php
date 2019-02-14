<?php

namespace App\Plugins\Products\Cache;


use App\Plugins\Products\Model\Product;
use Illuminate\Support\Facades\Cache;

trait ProductCache
{
    public function getProduct($productId) {
        $cache = $this->getCache("product$productId")??$this->createProductCache($productId);

        return $cache;
    }

    public function createProductCache($productId, $forget = false) {

        if($forget) {
            $this->forgetCache("product$productId");
        }

        $product = Product::findOrFail($productId);

        $cacheData = new \App\Cache\ProductCache($product);

        $this->setCache("product$productId", $cacheData);
        return $cacheData;
    }
}