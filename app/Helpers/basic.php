<?php


function language() {
    return session('locale')??config('app.locale');
}

function languages() {
    return \App\Languages::all();
}

function getTranslations($path, $collections) {
    return $collections::selectRaw('id, concat("category.name.", id) as name')->get();
}

function nullOrDate($value, $results) {
    return ($value??false)?$results[1]:$results[0];
}

function calcPrice($price, $changes) {
    foreach($changes as $change) {
        $changesToPrice = round((int)$price*(abs($change)/100), 2);
        if($change[0]=="-") { // discount
            $price-=$changesToPrice;
        } else {
            $price+=$changesToPrice;
        }
    }
    return number_format(round($price,2),2);
}