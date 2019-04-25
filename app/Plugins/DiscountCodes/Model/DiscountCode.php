<?php

namespace App\Plugins\DiscountCodes\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DiscountCode extends Model
{
    use SoftDeletes;

    public $fillable = ['id', 'unit', 'applied','amount', 'code', 'uses', 'valid_from', 'valid_to'];
//    public $dateFormat = "m/d/Y";
}
