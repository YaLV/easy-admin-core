<?php

namespace App\Plugins\Sales\Model;

use App\BaseModel;
use App\Plugins\UserGroups\Model\UserGroup;
use Carbon\Carbon;

class Sale extends BaseModel
{
    public $fillable = ['id', 'name', 'amount', 'discount_to', 'discount_target', 'user_group', 'valid_from', 'valid_to'];
    public $casts = [
        'discount_target' => 'array',
        'user_group'      => 'array',
    ];

    public function getValidFromAttribute($value)
    {
        if (!($value ?? false)) {
            return null;
        }

        return Carbon::createFromFormat('Y-m-d', $value)->format('m/d/Y');
    }

    public function getValidToAttribute($value)
    {

        if (!($value ?? false)) {
            return null;
        }

        return Carbon::createFromFormat('Y-m-d', $value)->format('m/d/Y');
    }

    public function getDiscountTargetAttribute($value) {
        $plugin = ucfirst(str_plural($this->discount_to));
        $pluginSingle = str_singular($plugin);
        $class = "\\App\\Plugins\\$plugin\\Model\\$pluginSingle" . "Meta";
        $value = !is_array($value)?json_decode($value):$value;
        return implode(", ", $class::where('meta_name', 'name')->whereIn('owner_id', $value)->get()->pluck('meta_value')->toArray()).", ";
    }

    public function getGroupAttribute($value) {
        $value = $this->user_group;
        $value = !is_array($value)?json_decode($value):$value;

        return implode(", ", UserGroup::where('id', $value)->pluck('name')->toArray()).", ";
    }
}
