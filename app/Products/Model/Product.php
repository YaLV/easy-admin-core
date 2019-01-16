<?php

namespace App\Plugins\Products\Model;


use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public $fillable = ['name', 'product_slug_id', 'attribute_set_id', 'active'];

    public function setNameAttribute($value) {
        ProductNames::SaveNames($this->id, $value);
        ProductSlugs::SaveSlugs($this->id, $value);
    }

    // Names
    public function getNameAttribute() {
        if(!$this->id) return;
        return $this->translatedName(session()->get('language')??config('app.locale'))->first()->name??false;
    }

    public function names() {
        return $this->hasMany(ProductNames::class);
    }

    public function getNamesAttribute() {
        return $this->names()->pluck('name', 'language')->toArray();
    }

    public function translatedName($language) {
        return $this->hasMany(ProductNames::class)->where('language', $language);
    }

    // Slugs
    public function getSlugAttribute() {
        return $this->translatedSlug(session()->get('language')??config('app.locale'))->first()->slug??false;
    }

    public function translatedSlug($language) {
        return $this->hasMany(ProductSlugs::class)->where('language', $language);
    }

    public function slugs() {
        return $this->hasMany(ProductSlugs::class);
    }

    public function getSlugsAttribute() {
        return $this->slugs()->pluck('slug', 'language')->toArray();
    }

    // Excerpt
    public function setExcerptAttribute($value) {
        ProductExcerpt::SaveExcerpt($this->id, $value);
    }

    public function getExcerptAttribute() {
        if(!$this->id) return;
        return $this->translatedExcerpt(session()->get('language')??config('app.locale'))->first()->excerpt??false;
    }

    public function translatedExcerpt($language) {
        return $this->hasMany(ProductExcerpt::class)->where('language', $language);
    }

    public function Excerpts() {
        return $this->hasMany(ProductExcerpt::class);
    }

    public function getExcerptsAttribute() {
        return $this->Excerpts()->pluck('excerpt', 'language')->toArray();
    }

    // Description
    public function setDescriptionAttribute($value) {
        ProductDescription::SaveDescription($this->id, $value);
    }

    public function getDescriptionAttribute() {
        if(!$this->id) return;
        return $this->translatedDescription(session()->get('language')??config('app.locale'))->first()->description??false;
    }

    public function translatedDescription($language) {
        return $this->hasMany(ProductDescription::class)->where('language', $language);
    }

    public function Descriptions() {
        return $this->hasMany(ProductDescription::class);
    }

    public function getDescriptionsAttribute() {
        return $this->Descriptions()->pluck('description', 'language')->toArray();
    }

    public function getPriceAttribute() {
        if(!$this->id) return view("Products::prices", ["prices" => new Prices]);
        return "";
        return view("Products::prices", ['prices' => $this->prices]);
    }

    public function prices() {
        return $this->hasMany(Prices::class);
    }

    public function getAttributeSetAttribute() {
        return $this->attributeSet()->name??"";
    }

    public function attributeSet() {
        return $this->hasOne(AttributeSets::class);
    }

}