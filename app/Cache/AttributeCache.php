<?php

namespace App\Cache;


use App\Plugins\Attributes\Model\Attribute;

class AttributeCache
{
    private $values = [];
    private $products = [];
    private $collections;

    public function __construct($attributeId) {

        /** @var Attribute $attribute */
        $attribute = Attribute::findOrFail($attributeId);
        $this->values = $attribute->values()->pluck('id')->toArray();
        $this->collections = $attribute->values()->get();
        $this->products = $attribute->products()->pluck('id')->toArray();
    }

    public function getProducts() {
        return $this->products;
    }

    public function getValues() {
        return $this->values;
    }

    public function getAvailableValues() {
        $values = [];
        foreach($this->collections as $collection) {
            if($collection->product()->count()) {
                $values[] = $collection->id;
            }
        }

        return $values;
    }


}