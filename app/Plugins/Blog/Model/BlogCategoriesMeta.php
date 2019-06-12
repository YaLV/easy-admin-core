<?php

namespace App\Plugins\Blog\Model;

use Illuminate\Database\Eloquent\Model;

class BlogCategoriesMeta extends Model
{
    public $fillable = ['meta_name', 'meta_value', 'language', 'owner_id'];

    public function category() {
        return $this->belongsTo(BlogCategories::class);
    }
}
