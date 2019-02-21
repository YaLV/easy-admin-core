<?php

namespace App\Plugins\Categories\Cache;

/**
 * Trait CategoryCache
 *
 * @package App\Plugins\Categories\Cache
 */
trait CategoryCache
{
    /**
     * @return \App\Cache\CategoryCache
     */
    public function getCategoryCache() {
        $cache = $this->getCache('categories')??$this->createCategoryCache();

        return $cache;
    }

    /**
     * @param bool $forget
     *
     * @return \App\Cache\CategoryCache
     */
    public function createCategoryCache($forget = false) {
        if($forget) {
            $this->forgetCache('categories');
        }

        $cacheData = new \App\Cache\CategoryCache();

        $this->setCache('categories', $cacheData);
        return $cacheData;
    }
}