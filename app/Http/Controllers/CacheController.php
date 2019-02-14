<?php

namespace App\Http\Controllers;

use App\Plugins\Admin\Cache\SlugCache;
use App\Plugins\Categories\Cache\CategoryCache;
use App\Plugins\MarketDays\Functions\MarketDays;
use App\Plugins\MarketDays\Model\MarketDay;
use App\Plugins\Menu\Cache\MenuCache;
use App\Plugins\Products\Cache\ProductCache;
use App\Plugins\Suppliers\Cache\SupplierCache;
use Illuminate\Support\Facades\Cache;

class CacheController extends Controller
{
    use CategoryCache;
    use ProductCache;
    use MenuCache;
    use SlugCache;
    use MarketDays;
    use SupplierCache;

    public function setCache($name, $content) {
        Cache::put($name, $content, config('app.cacheLife', 1440));
    }

    public function forgetCache($cacheSlug) {
        Cache::forget($cacheSlug);
    }

    public function getCache($slug) {
        return Cache::get($slug);
    }

    public function getSelectedMarketDayFormatted() {
        $marketDay = $this->getSelectedMarketDay();
        if(!($marketDay instanceof MarketDays)) {
            $this->getClosestMarketDayList();
            $marketDay = $this->getSelectedMarketDay();
        }
        return __("Uz :dayname, :date", ['dayname' => substr($marketDay->name, 0, -1)."u", 'date' => $marketDay->date->format("d.m")]);
    }

    public function getSelectedMarketDay() {
        $marketDay = session()->get('marketDay');
        if($marketDay instanceof MarketDay) {
            return $marketDay;
        }
        $marketDay = $this->getClosestMarketDay();
        session()->put('marketDay', $marketDay);
        return $marketDay;
    }

    public function selectMarketDay($timestamp) {
        $marketDay = $this->getClosestMarketDayList($timestamp);
        if($marketDay) {
            session()->forget('marketDay');
            session()->put('marketDay', $marketDay);
            return redirect()->back();
        } else {
            abort(404);
        }
    }

    public function isSelectedMarketDay($mDay) {
        $marketDay = $this->getSelectedMarketDay();
        return $mDay->date->timestamp==$marketDay->date->timestamp;
    }

}

