<?php


function language()
{
    return request()->route('lang') ?? config('app.locale');
}

function languages()
{
    $languageCache = \Illuminate\Support\Facades\Cache::get('languagelist');
    if (!$languageCache) {
        $languageCache = \App\Languages::all();
    }
    \Illuminate\Support\Facades\Cache::put("languagelist", $languageCache, 1440);

    return $languageCache;

}

function getTranslations($path, $collections)
{
    return $collections::selectRaw('id, concat("category.name.", id) as name')->get();
}

function nullOrDate($value, $results)
{
    return ($value ?? false) ? $results[1] : $results[0];
}

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
        'wovat' => number_format(round($wovat, 2), 2),
        'wvat'  => number_format(round($wvat, 2), 2),
        'vat'   => number_format(round($wvat - $wovat, 2), 2),
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

function r($name, $params = [], $absolute = true)
{

    $name = $name . isDefaultLanguage();

    if (!isDefaultLang()) {
        $params['lang'] = $params['lang'] ?? request()->route('lang') ?? "";
    }

    return route($name, $params, $absolute);
}

function isDefaultLanguage()
{
    return isDefaultLang() ? ".default" : "";
}

function isDefaultLang()
{
    return language() == config('app.locale');
}

function getCartTotals($cart)
{
    if (!$cart) {
        return (object)[
            'productSum' => 0,
            'vatSum'     => 0,
            'discount'   => 0,
            'toPay'      => 0,
        ];
    }

    $sums = $cart->items()->selectRaw('sum(price*amount) as sum, sum(vat*amount) as vatsum ')->first();
    $productSum = $sums->sum ?? 0;
    $vatSum = $sums->vatsum ?? 0;

    switch ($cart->discount_target) {
        case "product":
            $discount = ($cart->discount_type == 'percent' ? ($productSum * ($cart->discount_amount / 100)) : $cart->discount_amount);
            break;

        case "delivery":
            $discount = ($cart->discount_type == 'percent' ? (($cart->delivery_amount ?? 0) * ($cart->discount_amount / 100)) : $cart->discount_amount);
            break;

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
        'productSum' => $productSum,
        'vatSum'     => $vatSum,
        'discount'   => $discount,
        'toPay'      => number_format($productSum + ($cart->delivery_amount ?? 0) - ($discount ?? 0), 2),
    ];
}

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

function getSupplierSlugs($language = false)
{



    if(pageTable()) {
        $slug = \App\Plugins\Pages\Model\Template::where('template', 'suppliers')->first();
        $slugs = [];
        foreach (($slug?$slug->page:[]) as $page) {
            $slugs[] = __("pages.slug.{$page->id}");
        }
        if(count($slugs)==0) {
            if($language) {
                return "#";
            }
            $slugs = ['401'];
        }

        if($language) {
            return current($slugs);
        }

        return implode("|", $slugs);
    }
    return str_random(20);
}

function pageTable() {
    return \Illuminate\Support\Facades\Schema::hasTable("templates");
}

function getCurrentAttributes($catId) {
    if($filters = session()->get('filters')) {
        if($filters['category']==$catId) {
            return $filters['filters']??[];
        }
        session()->forget('filters');
        return [];
    }
    return [];
}

function getCurrentSuppliers($catId) {
    if($filters = session()->get('filters')) {
        if($filters['category']==$catId) {
            return $filters['suppliers']??[];
        }
        session()->forget('filters');
        return [];
    }
    return [];
}