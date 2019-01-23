<?php

namespace App\Plugins\Units\Model;


use App\BaseModel;

class Unit extends BaseModel
{
    public $fillable = [
        'name',
        'unit',
    ];
}