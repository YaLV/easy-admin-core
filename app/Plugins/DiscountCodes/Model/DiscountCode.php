<?php

namespace App\Plugins\DiscountCodes\Model;

use App\Plugins\Categories\Model\Category;
use App\Plugins\Products\Model\Product;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DiscountCode extends Model
{
    use SoftDeletes;

    public $fillable = ['id', 'unit', 'applied','amount', 'code', 'uses', 'valid_from', 'valid_to', 'items'];
//    public $dateFormat = "m/d/Y";
    public $casts = [
        'items' => 'array'
    ];

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

    public function getItemsAttribute($value) {
        if(!$value || count($value)==0) { return ""; }
        $plugin = ucfirst(str_plural($this->applied));
        $pluginSingle = str_singular($plugin);
        /** @var Product|Category $class */
        $class = "\\App\\Plugins\\$plugin\\Model\\$pluginSingle" . "Meta";
        $value = !is_array($value)?json_decode($value):$value;
        return implode(", ", $class::where('meta_name', 'name')->whereIn('owner_id', $value)->get()->pluck('meta_value')->toArray()).", ";
    }
}
