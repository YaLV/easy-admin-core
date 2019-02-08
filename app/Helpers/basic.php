<?php


function language() {
    return request()->route('lang')??config('app.locale');
}

function languages() {
    $languageCache = \Illuminate\Support\Facades\Cache::get('languagelist');
    if(!$languageCache) {
        $languageCache = \App\Languages::all();
    }
    \Illuminate\Support\Facades\Cache::put("languagelist", $languageCache, 1440);
    return $languageCache;

}

function getTranslations($path, $collections) {
    return $collections::selectRaw('id, concat("category.name.", id) as name')->get();
}

function nullOrDate($value, $results) {
    return ($value??false)?$results[1]:$results[0];
}

function calcPrice($price, $changes) {
    foreach($changes as $change) {
        $changesToPrice = round((float)$price*(abs($change)/100), 2);
        if($change[0]=="-") { // discount
            $price-=$changesToPrice;
        } else {
            $price+=$changesToPrice;
        }
    }
    return number_format(round($price,2),2);
}

function r($name, $params = [], $absolute = true) {
    if(!isDefaultLang()) {
        $params['lang'] = $params['lang']??request()->route('lang')??"";
    }
    return route($name, $params, $absolute);
}

function isDefaultLanguage() {
    return isDefaultLang()?".default":"";
}

function isDefaultLang() {
    return language()==config('app.locale');
}