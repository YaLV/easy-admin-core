<?php

namespace App\Plugins\Blog\Model;

use App\BaseModel;

class BlogCategories extends BaseModel
{
    public $fillable = ['id'];

    public $metaClass = __NAMESPACE__."\BlogCategoriesMeta";

    public function posts() {
        return $this->belongsToMany(Blog::class);
    }

    public function mainPost() {
        return $this->hasMany(Blog::class, 'main_category','id');
    }

    public function getNameAttribute() {
        return $this->meta['name'][language()];
    }

}
