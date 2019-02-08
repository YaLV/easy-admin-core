<?php

namespace App\Http\Controllers;

use App\Plugins\Admin\Cache\SlugCache;
use App\Plugins\Categories\Cache\CategoryCache;
use App\Plugins\Menu\Cache\MenuCache;
use App\Plugins\Products\Cache\ProductCache;
use Illuminate\Support\Facades\Cache;

class CacheController extends Controller
{
    use CategoryCache;
    use ProductCache;
    use MenuCache;
    use SlugCache;

    public function setCache($name, $content) {
        Cache::put($name, $content, config('app.cacheLife', 1440));
    }

    public function forgetCache($cacheSlug) {
        Cache::forget($cacheSlug);
    }

    public function getCache($slug) {
        return Cache::get($slug);
    }

}

