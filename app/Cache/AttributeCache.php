<?php

namespace App\Cache;


use App\Plugins\Attributes\Model\Attribute;

class AttributeCache
{
    private $values = [];
    private $products = [];

    public function __construct($attributeId) {

        /** @var Attribute $attribute */
        $attribute = Attribute::findOrFail($attributeId);
        $this->values = $attribute->values()->pluck('id')->toArray();
        $this->products = $attribute->products()->pluck('id')->toArray();
    }

    public function getProducts() {
        return $this->products;
    }

    public function getValues() {
        return $this->values;
    }
}