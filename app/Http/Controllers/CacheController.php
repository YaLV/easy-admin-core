<?php

namespace App\Http\Controllers;

use App\Plugins\Admin\Cache\SlugCache;
use App\Plugins\Attributes\Cache\AttributeCache;
use App\Plugins\Categories\Cache\CategoryCache;
use App\Plugins\MarketDays\Functions\MarketDays;
use App\Plugins\MarketDays\Model\MarketDay;
use App\Plugins\Menu\Cache\MenuCache;
use App\Plugins\Orders\CartController;
use App\Plugins\Pages\Cache\PageCache;
use App\Plugins\Products\Cache\ProductCache;
use App\Plugins\Suppliers\Cache\SupplierCache;
use Illuminate\Support\Facades\Cache;

/**
 * Class CacheController
 *
 * @package App\Http\Controllers
 */
class CacheController extends Controller
{
    use CategoryCache;
    use ProductCache;
    use MenuCache;
    use SlugCache;
    use MarketDays;
    use SupplierCache;
    use PageCache;
    use AttributeCache;

    /**
     * Set cache
     *
     * @param $name
     * @param $content
     */
    public function setCache($name, $content) {
        Cache::put($name, $content, config('app.cacheLife', 1440));
    }

    /**
     * Forget cache
     *
     * @param $cacheSlug
     */
    public function forgetCache($cacheSlug) {
        Cache::forget($cacheSlug);
    }

    /**
     * Get Cache
     *
     * @param $slug
     *
     * @return mixed
     */
    public function getCache($slug) {
        return Cache::get($slug);
    }

    /**
     * Get current marketDay - formatted
     *
     * @return array|null|string
     */
    public function getSelectedMarketDayFormatted() {
        $marketDay = $this->getSelectedMarketDay();
        if(!($marketDay instanceof MarketDays)) {
            $this->getClosestMarketDayList();
            $marketDay = $this->getSelectedMarketDay();
            if(!$marketDay) {
                return __("No Market Days Available");
            }
        }
        return __("Uz :dayname, :date", ['dayname' => substr($marketDay->name, 0, -1)."u", 'date' => $marketDay->date->format("d.m")]);
    }

    /**
     * Get selected market day, and save it in cache
     *
     * @return bool|mixed
     */
    public function getSelectedMarketDay() {
        $marketDay = session()->get('marketDay');
        if($marketDay instanceof MarketDay) {
            return $marketDay;
        }
        $marketDay = $this->getClosestMarketDay();
        session()->put('marketDay', $marketDay);
        return $marketDay;
    }

    /**
     * Change marketDay
     *
     * @param $timestamp
     *
     * @return \Illuminate\Http\RedirectResponse|false
     */
    public function selectMarketDay($timestamp) {
        $marketDay = $this->getClosestMarketDayList($timestamp);
        if($marketDay) {
            session()->forget('marketDay');
            session()->put('marketDay', $marketDay);
            session()->forget('ca');
            (new CartController)->updateCartDay($marketDay);
            return redirect()->back();
        } else {
            abort(404);
        }
        return false;
    }

    /**
     * Check if current market Day is selected
     *
     * @param $mDay
     *
     * @return bool
     */
    public function isSelectedMarketDay($mDay) {
        $marketDay = $this->getSelectedMarketDay();
        return $mDay->date->timestamp==$marketDay->date->timestamp;
    }

}

