<?php

namespace App\Plugins\Attributes\Model;

use App\BaseModel;

class Attribute extends BaseModel
{
    public $fillable = ['id'];

    public $metaClass = __NAMESPACE__."\AttributeMeta";

    public function values() {
        return $this->hasMany(AttributeValue::class);
    }

    public function getNameAttribute() {
        if(!$this->id) return false;
        return __("attributes.name.".$this->id);
    }

    public function attributeValuesList($product_id) {
        $attributeValues = $this->values()->whereHas('product', function($q) use($product_id){
            $q->where('product_id', $product_id);
        })->get();

        return $attributeValues;
    }

}
