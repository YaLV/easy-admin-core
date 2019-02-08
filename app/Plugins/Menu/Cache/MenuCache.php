<?php

namespace App\Plugins\Menu\Cache;



trait MenuCache
{
    public function getMenuCache($slug) {
        $cache = $this->getCache("menu.$slug")??$this->createMenuCache($slug);
        return $cache;
    }

    public function createMenuCache($slug, $forget = false) {
        if($forget) {
            $this->forgetCache("menu.$slug");
        }

        $cacheData = new \App\Cache\MenuCache($slug);

        $this->setCache("menu.$slug", $cacheData);

        return $cacheData;
    }
}