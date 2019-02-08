<?php

namespace App\Plugins\Categories\Cache;

trait CategoryCache
{
    public function getCategoryCache() {
        $cache = $this->getCache('categories')??$this->createCategoryCache();

        return $cache;
    }

    public function createCategoryCache($forget = false) {
        if($forget) {
            $this->forgetCache('categories');
        }

        $cacheData = new \App\Cache\CategoryCache();

        $this->setCache('categories', $cacheData);
        return $cacheData;
    }
}