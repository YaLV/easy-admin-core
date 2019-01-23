<?php

namespace App\Plugins\Vat\Model;


use App\BaseModel;

class Vat extends BaseModel
{
    public $fillable = [
        'name',
        'amount',
    ];
}