<?php

namespace App\Plugins\Products\Model\Categories;

use Illuminate\Database\Eloquent\Model;

class CategorySlug extends Model
{
    public $fillable = ['category_slug', 'category_id', 'language'];

    public function category() {
        return $this->belongsTo(Category::class);
    }
}
