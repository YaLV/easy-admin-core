<?php

namespace App\Plugins\Products;


use App\Plugins\Products\Model\AttributeSets;

class Products
{
    public static function attributeSets() {
        return AttributeSets::all();
    }

    public function attributes($attributeSet) {

    }
}