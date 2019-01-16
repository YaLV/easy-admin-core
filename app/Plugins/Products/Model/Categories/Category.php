<?php

namespace App\Plugins\Products\Model\Categories;

use App\Plugins\Admin\Model\File;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public $fillable = ['parent_id'];

     /*********************************** Names ******************************/
    public function getNameAttribute() {
        if(!$this->id) return "";
        return $this->categoryNames()->where('language', language())->first()->category_name??"";
    }

    public function categoryNames() {
        return $this->hasMany(CategoryName::class);
    }

    public function setNameAttribute($value) {
        foreach(languages() as $language) {
            if(!$value[$language->code]??false) { continue; }
            CategoryName::firstOrCreate(['category_id' => $this->id, 'language' => $language->code], ['category_name' => $value[$language->code]]);
        }
    }

    /*********************************** Slugs ******************************/
    public function getSlugAttribute() {
        if(!$this->id) return;
        return $this->categorySlugs()->where('language', language())->first()->category_slug??"";
    }

    public function categorySlugs() {
        return $this->hasMany(CategorySlug::class);
    }

    public function setSlugAttribute($value) {
        foreach(languages() as $language) {
            if(!$value[$language->code]) { continue; }
            CategorySlug::firstOrCreate(['category_id' => $this->id, 'language' => $language->code], ['category_slug' => str_slug($value[$language->code])]);
        }
    }

    public function getNamesAttribute() {
        return $this->categoryNames->pluck('category_name','language')->toArray();
    }

    public function getCategoryImageAttribute() {
        return $this->images()->where('owner', 'category_image')->get();
    }

    public function images() {
        return $this->hasMany(File::class, 'owner_id');
    }
}
