<?php


/**
 * returns current language code from url, or default if no language specified
 *
 * @return \Illuminate\Config\Repository|\Illuminate\Routing\Route|mixed|object|string
 */
function language()
{
    try {
        return request()->route('lang') ?? config('app.locale');
    } catch ( \Exception $e) {
        return config('app.locale');
    }
}

/**
 * get available language list
 *
 * @return \Illuminate\Database\Eloquent\Collection|mixed|static[]
 */
function languages()
{
    $languageCache = \Illuminate\Support\Facades\Cache::get('languagelist');
    if (!$languageCache) {
        $languageCache = \App\Languages::all();
    }
    \Illuminate\Support\Facades\Cache::put("languagelist", $languageCache, 1440);

    return $languageCache;

}

/**
 * @param $path
 * @param $collections
 *
 * @return mixed
 */
function getTranslations($path, $collections)
{
    return $collections::selectRaw('id, concat("category.name.", id) as name')->get();
}

/**
 * @param $value
 * @param $results
 *
 * @return mixed
 */
function nullOrDate($value, $results)
{
    return ($value ?? false) ? $results[1] : $results[0];
}

/**
 * Calculate price with all possible variations for product
 *
 * @param     $price
 * @param     $vat
 * @param     $markup
 * @param     $discount
 * @param int $amount
 *
 * @return object
 */
function calcPrice($price, $vat, $markup, $discount, $amount = 1)
{
    $vat = 1 + ($vat / 100);
    $markup = 1 + ($markup / 100);
    $discount = 1 - ($discount / 100);

    $wovat = $price * $markup;
    $wvat = $wovat * $vat;

    $prices = [
        'cost'     => $price,
        'markup'   => $markup,
        'vat'      => $vat,
        'discount' => $discount,
    ];

    $prices['full'] = (object)[
        'wovat'  => number_format(round($wovat, 2), 2),
        'wvat'   => number_format(round($wvat, 2), 2),
        'vat'    => number_format(round($wvat - $wovat, 2), 2),
        'markup' => number_format(round($wovat - $price, 2), 2),
    ];

    $discountwvat = $wvat - ($wvat * $discount);
    $pricewdiscount = ($wvat * $discount);
    $pricewdiscountvat = $pricewdiscount - ($pricewdiscount / $vat);

    $prices['wdiscount'] = (object)[
        'discount'    => number_format(round($discountwvat, 2), 2),
        'discountvat' => number_format(round($discountwvat - ($discountwvat / $vat), 2), 2),
        'price'       => number_format(round($pricewdiscount, 2), 2),
        'pricevat'    => number_format(round($pricewdiscountvat, 2), 2),
        'pricewovat'  => number_format(round($pricewdiscount - $pricewdiscountvat, 2), 2),
    ];

    $prices['sum'] = (object)[
        'wdiscount'  => (object)[
            'wovat' => number_format(round(($pricewdiscount * $amount) - ($pricewdiscountvat * $amount), 2), 2),
            'wvat'  => number_format(round($pricewdiscount * $amount, 2), 2),
            'vat'   => number_format(round($pricewdiscountvat * $amount, 2), 2),
        ],
        'wodiscount' => (object)[
            'wovat' => number_format(round($wovat * $amount, 2), 2),
            'wvat'  => number_format(round($wvat * $amount, 2), 2),
            'vat'   => number_format(round(($wvat * $amount) - ($wovat * $amount), 2), 2),
        ],
    ];


    return (object)$prices;
}

/**
 * Frontend Route url maker - with language addition
 *
 * @param       $name
 * @param array $params
 * @param bool  $absolute
 *
 * @return string
 */
function r($name, $params = [], $absolute = true)
{

    $name = $name . isDefaultLanguage();

    if (!isDefaultLang()) {
        $params['lang'] = $params['lang'] ?? request()->route('lang') ?? "";
    }

    return route($name, $params, $absolute);
}

/**
 * returns route name addition if selected language is default
 *
 * @return string
 */
function isDefaultLanguage()
{
    return isDefaultLang() ? ".default" : "";
}

/**
 * detects if current language is defined as default
 *
 * @return bool
 */
function isDefaultLang()
{
    return language() == config('app.locale');
}

/**
 * Calculates cart/order total amounts
 *
 * @param \App\Plugins\Orders\Model\OrderHeader $cart
 * @param array                                 $items
 * @param bool                                  $original
 *
 * @return object
 */
function getCartTotals(\App\Plugins\Orders\Model\OrderHeader $cart, array $items = [], $original = false)
{
    $woDiscount = (object)['sum' => 0, 'vatsum' => 0];
    if (!$cart) {
        return (object)[
            'productSum' => 0,
            'vatSum'     => 0,
            'discount'   => 0,
            'toPay'      => 0,
        ];
    }

    $discount_target = $cart->discount_target;
    $discount_items = $cart->discount_items ?? [];

    if ($original) {
        $queryForCode = "sum((price_raw*amount)) as sum, sum((vat_raw*amount)) as vatsum";
        $queryNoCode = "sum((price*amount)) as sum, sum((vat*amount)) as vatsum";
    } else {
        $queryForCode = "sum((price_raw*amount)/total_amount*real_amount) as sum, sum((vat_raw*amount)/total_amount*real_amount) as vatsum";
        $queryNoCode = "sum((price*amount)/total_amount*real_amount) as sum, sum((vat*amount)/total_amount*real_amount) as vatsum";
    }


    switch ($discount_target) {

        /**
         * If discount is set to product(-s) - if no products specified applies to every product
         */
        case "product":
            $sums = $cart->currentDayItems($discount_items)
                ->discountUnder($cart->discount_amount, $cart->discount_type)
                ->selectRaw($queryForCode)
                ->first();
            $woDiscount = $cart->currentDayItems()
                ->whereNotIn('product_id', $discount_items)
                ->discountOver($cart->discount_amount, $cart->discount_type, $discount_items)
                ->selectRaw($queryNoCode)
                ->first();
            break;

        /**
         * If discount is set to category(-ies) applies to products in specified category(-ies) - if no category specified applies to every product
         */
        case "category":
            $sums = $cart->inCategory($discount_items, 'whereHas', $discount_items ?? [])
                ->discountUnder($cart->discount_amount, $cart->discount_type)
                ->selectRaw($queryForCode)
                ->first();
            $woDiscount = $cart->inCategory($discount_items, 'whereDoesntHave', $items ?? null)
                ->whereNotIn('product_id', $discount_items)
                ->discountOver($cart->discount_amount, $cart->discount_type, $discount_items)
                ->selectRaw($queryNoCode)
                ->first();
            break;

        /**
         * No discount code or discount code applies to delivery
         */
        default:
            $sums = $cart->currentDayItems($items)->selectRaw($queryNoCode)->first();
            break;
    }


    /** @var int $productSum */
    $productSum = number_format(round($sums->sum ?? 0, 2), 2);
    /** @var int $vatSum */
    $vatSum = number_format(ceil(($sums->vatsum ?? 0) * 100) / 100, 2);

    /** @var int $productSumWoDiscount */
    $productSumWoDiscount = number_format(round($woDiscount->sum ?? 0, 2), 2);
    /** @var int $productVatWoDiscount */
    $productVatWoDiscount = number_format(ceil(($woDiscount->vatsum ?? 0) * 100) / 100, 2);

    switch ($cart->discount_target) {
        case "product":
        case "cateogry";
            $discount = ($cart->discount_type == 'percent' ? ($productSum * ($cart->discount_amount / 100)) : $cart->discount_amount);
            break;

        case "delivery":
            $discount = ($cart->discount_type == 'percent' ? (($cart->delivery_amount ?? 0) * ($cart->discount_amount / 100)) : $cart->discount_amount);
            break;

        /**
         * Unused (remved) - this is left in case it needs to return
         */
        case "all":
            $totalSum = $productSum + $cart->delivery_amount;
            $discount = ($cart->discount_type == 'percent' ? ($totalSum * ($cart->discount_amount / 100)) : $cart->discount_amount);
            break;

        default:
            $discount = 0;
            break;
    }
    $discount = number_format(($discount != abs($discount) ? ($totalSum ?? $productSum) : round(($discount ?? 0), 2)), 2);

    return (object)[
        'productSum' => number_format($productSum + $productSumWoDiscount, 2),
        'vatSum'     => number_format($vatSum + $productVatWoDiscount, 2),
        'discount'   => $discount,
        'delivery'   => $cart->delivery_amount,
        'toPay'      => number_format(($productSum + $productSumWoDiscount) + ($cart->delivery_amount ?? 0) - ($discount ?? 0), 2),
    ];
}


/**
 * @param bool $change
 *
 * @return \App\User|mixed|null
 */
function currentUser($change = false)
{
    if (!$change) {
        $cu = session()->get('cu');
    }

    $user = $cu ?? Auth::user() ?? \App\User::find(99);

    session()->put('cu', $user);

    return $user;
}

/**
 * Translate the given message.
 *
 * @param  string $key
 * @param  array  $replace
 * @param  string $locale
 *
 * @return string|array|null
 */
function _t($key, $replace = [], $locale = null)
{

    $translation = app('translator')->getFromJson($key, $replace, $locale);

    $user = \Illuminate\Support\Facades\Auth::user();

    if ($user && $user->isAdmin) {
        $translation = $key == $translation ? "UndefinedProperty" : $translation;

        return view("admin.partials.translation", compact(['key', 'translation']))->render();
    }

    return $translation == $key ? "Undefined Property" : $translation;
}

/**
 * Translate the given message or return empty.
 *
 * @param  string $key
 * @param  array  $replace
 * @param  string $locale
 *
 * @return string|array|null
 */
function transOrEmpty($key, $replace = [], $locale = null)
{

    $translation = app('translator')->getFromJson($key, $replace, $locale);

    return $translation == $key ? "" : $translation;
}

/**
 * Supplier Slug list for routing purposes (with built in backup if there is no suppliers)
 *
 * @param bool $language
 *
 * @return mixed|string
 */
function getSupplierSlugs($language = false)
{


    if (pageTable()) {
        $slug = \App\Plugins\Pages\Model\Template::where('template', 'suppliers')->first();
        $slugs = [];
        foreach (($slug ? $slug->page : []) as $page) {
            $slugs[] = __("pages.slug.{$page->id}");
        }
        if (count($slugs) == 0) {
            if ($language) {
                return "#";
            }
            $slugs = ['401'];
        }

        if ($language) {
            return current($slugs);
        }

        return implode("|", $slugs);
    }

    return str_random(20);
}

/**
 * Checks if there's templates DB table for pages, to allow "pages"
 *
 * @return bool
 */
function pageTable()
{
    return \Illuminate\Support\Facades\Schema::hasTable("templates");
}


/**
 * get current category filters (reset on category change)
 *
 * @param $catId
 *
 * @return array
 */
function getCurrentAttributes($catId)
{
    if ($filters = session()->get('filters')) {
        if ($filters['category'] == $catId) {
            return $filters['filters'] ?? [];
        }
        session()->forget('filters');

        return [];
    }

    return [];
}

/**
 * @param $catId
 *
 * @return array
 */
function getCurrentSuppliers($catId)
{
    if ($filters = session()->get('filters')) {
        if ($filters['category'] == $catId) {
            return $filters['suppliers'] ?? [];
        }
        session()->forget('filters');

        return [];
    }

    return [];
}

/**
 * get text for discount codes
 *
 * @param $item
 *
 * @return mixed
 */
function discountTo($item)
{
    $texts = [
        'category' => 'Only Category(-ies)',
        'product'  => 'Only Product(-s)',
        'delivery' => 'Only Delivery',
    ];

    return $texts[$item];
}

/**
 * Discount code unlimited symbol
 *
 * @param $item
 *
 * @return string
 */
function usesLeft($item)
{
    if (is_null($item)) {
        return "∞";
    }

    return $item;
}