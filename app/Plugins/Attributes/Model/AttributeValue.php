<?php

namespace App\Plugins\Attributes\Model;

use App\BaseModel;
use App\Plugins\Products\Model\Product;


class AttributeValue extends BaseModel
{
    public $fillable = ['id', 'attribute_id'];
    public $metaClass = __NAMESPACE__."\AttributeValueMeta";

    public function product() {
        return $this->belongsToMany(Product::class);
    }
}
