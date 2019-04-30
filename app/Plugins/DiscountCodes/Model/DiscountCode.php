<?php

namespace App\Plugins\DiscountCodes\Model;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DiscountCode extends Model
{
    use SoftDeletes;

    public $fillable = ['id', 'unit', 'applied','amount', 'code', 'uses', 'valid_from', 'valid_to'];
//    public $dateFormat = "m/d/Y";

    public function getValidFromAttribute($value) {
        if(!$value) { return null; }
        return Carbon::createFromFormat('Y-m-d', $value)->format('m/d/Y');
    }

    public function getValidToAttribute($value) {
        if(!$value) { return null; }
        return Carbon::createFromFormat('Y-m-d', $value)->format('m/d/Y');
    }


    public function getValidRangeAttribute($value) {
        return $this->valid_from." - ".($this->valid_to??"Until removed");
    }
}
