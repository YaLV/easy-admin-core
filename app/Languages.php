<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Languages
 *
 * @package App
 */
class Languages extends Model
{
    use SoftDeletes;

    /**
     * @var array
     */
    public $fillable = ['code', 'name', 'is_default'];

    /**
     * isDefault mutator
     *
     * @param $value
     */
    public function setIsDefaultAttribute($value) {
        $this->attributes['is_default'] = $value=="on"?1:0;
    }
}
