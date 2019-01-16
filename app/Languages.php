<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Languages extends Model
{
    use SoftDeletes;

    public $fillable = ['code', 'name', 'is_default'];

    public function setIsDefaultAttribute($value) {
        $this->attributes['is_default'] = $value=="on"?1:0;
    }
}
