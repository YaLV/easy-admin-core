<?php

namespace App\Plugins\Units\Model;


use App\BaseModel;
use App\Plugins\Products\Model\ProductVariation;

class Unit extends BaseModel
{
    public $fillable = [
        'name',
        'unit',
        'parent_amount',
        'unit_id'
    ];

    public function variations() {
        return $this->belongsTo(ProductVariation::class);
    }

    public function subUnit() {
        return $this->hasOne(Unit::class);
    }
}