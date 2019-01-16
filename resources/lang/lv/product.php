<?php

return [
    'productName' => \App\Plugins\Products\Model\ProductNames::where('language', session()->get('language') ?? config('app.locale'))->get()->pluck('name', 'product_id')->toArray(),
    'productDescription' => \App\Plugins\Products\Model\ProductDescription::where('language', session()->get('language') ?? config('app.locale'))->get()->pluck('name', 'product_id')->toArray(),
    'productExcerpt' => \App\Plugins\Products\Model\ProductExcerpt::where('language', session()->get('language') ?? config('app.locale'))->get()->pluck('name', 'product_id')->toArray(),
];