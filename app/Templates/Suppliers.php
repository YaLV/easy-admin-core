<?php

namespace App\Templates;


use App\Http\Controllers\CacheController;
use App\Plugins\Pages\Functions\Components;
use App\Plugins\Suppliers\Model\SupplierMeta;

class Suppliers
{
    public $children = true;

    use Components;

    public static function getTemplateName() {
        return "Suppliers";
    }

    public function components()
    {
        return [
            'fullSizeBanner',
            'spacerMedium',
            'centeredText',
            'spacerMedium',
            'supplierMap',
        ];
    }

    public static function childView($farmer, $page) {
        $farmer = SupplierMeta::where(['meta_name' => 'slug', 'meta_value' => $farmer])->firstOrFail()->supplier;

        return view('frontend.pages.farmer', ['supplier' => $farmer, 'supplierCache' => (new CacheController())->getSupplier($farmer->id), 'page' => $page]);
    }
}