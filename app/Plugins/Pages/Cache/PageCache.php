<?php

namespace App\Plugins\Pages\Cache;

use App\Plugins\Pages\Model\Page;
use App\Plugins\Pages\Model\PageMeta;

trait PageCache
{

    public function getPage($slug = false) {
        return $this->getCache("page-$slug")??$this->createPageCache($slug);
    }

    public function createPageCache($slug, $forget = false) {

        if($forget) {
            $this->forgetCache("page-$slug");
        }

        if(!$slug) {
            $pageData = Page::where('homepage', 1)->first();
        } else {
            $pageData = PageMeta::where(['meta_value' => $slug, 'meta_name' => 'slug'])->first()->page;
        }

        if(!$pageData) {
            return $pageData;
        }

        $cacheData = new \App\Cache\PageCache($pageData);

        $this->setCache("menu.$slug", $cacheData);

        return $cacheData;
    }
}