<?php

namespace App\Plugins\Units\Model;


use App\BaseModel;
use App\Plugins\Products\Model\ProductVariation;

class Unit extends BaseModel
{
    public $fillable = [
        'name',
        'unit',
    ];

    public function variations() {
        return $this->belongsTo(ProductVariation::class);
    }
}