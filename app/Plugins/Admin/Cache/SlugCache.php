<?php

namespace App\Plugins\Admin\Cache;


/**
 * Trait SlugCache
 *
 * @package App\Plugins\Admin\Cache
 */
trait SlugCache
{
    /**
     * @return \App\Cache\SlugCache
     */
    public function getSlugCache() {
        $cache = $this->getCache("slugs.".language())??$this->createSlugCache();
        return $cache;
    }

    /**
     * @param bool $forget
     *
     * @return \App\Cache\SlugCache
     */
    public function createSlugCache($forget = false) {
        if($forget) {
            $this->forgetCache("slugs.".language());
        }

        $cacheData = new \App\Cache\SlugCache();

        $this->setCache("slugs.".language(), $cacheData);

        return $cacheData;
    }
}