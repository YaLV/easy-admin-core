<?php

namespace App\Plugins\Products\Model;


use Illuminate\Database\Eloquent\Model;

class ProductSlugs extends Model
{
    public $fillable = ['product_id', 'language', 'slug'];

    public static function SaveSlugs($slug, $value) {
        foreach($value as $language => $translation) {
            self::updateOrCreate(['product_id' => $slug, 'language' => $language], ['slug' => str_slug($translation, "_")]);
        }
        return;
    }
}