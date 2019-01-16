<?php

namespace App\Plugins\Products\Model;


use Illuminate\Database\Eloquent\Model;

class ProductNames extends Model
{
    public $fillable = ['product_id', 'language', 'name'];

    public static function SaveNames($slug, $value) {
        foreach($value as $language => $translation) {
            self::updateOrCreate(['product_id' => $slug, 'language' => $language], ['name' => $translation]);
        }
        return;
    }
}