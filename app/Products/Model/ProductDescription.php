<?php

namespace App\Plugins\Products\Model;


use Illuminate\Database\Eloquent\Model;

class ProductDescription extends Model
{
    public $fillable = ['product_id', 'language', 'description'];

    public static function SaveExcerpt($slug, $value) {
        foreach($value as $language => $translation) {
            self::updateOrCreate(['product_id' => $slug, 'language' => $language], ['description' => $translation]);
        }
        return;
    }
}