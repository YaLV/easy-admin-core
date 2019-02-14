<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class BaseModel extends Model
{

    private $metaContent;

    public function setMeta($name, $value) {
        if(!$this->id) return false;
        foreach(languages() as $language) {
            if(!$value[$language->code]??false) { continue; }
            $this->metaClass::firstOrCreate(['owner_id' => $this->id,'language' => $language->code], ['meta_value' => $value[$language->code], 'meta_name' => $name]);
        }
    }

    public function metaData() {
        return $this->hasMany($this->metaClass, 'owner_id', $this->idField??'id');
    }

    public function getMetaAttribute() {
        if($this->metaContent) return $this->metaContent;
        $metaData = [];
        $metaDataCollection = $this->metaData;
        foreach($metaDataCollection??[] as $meta) {
            $metaData[$meta->meta_name][$meta->language] = $meta->meta_value;
        }
        $this->metaContent = $metaData;
        return $metaData;
    }

    public function forgetMeta($slugs = []) {
        foreach(languages() as $language) {
            Cache::forget(implode("_", array_merge([class_basename($this), "meta", $language->code], $slugs)));
        }
    }

    public function MetaLanguage($slugs = [], $forget = false) {

        $cacheData = Cache::get(implode("_", array_merge([class_basename($this),"meta", language()],$slugs)))??$this->formMetaLanguage($slugs);

        Cache::put(implode("_", array_merge([class_basename($this),"meta", language()],$slugs)), $cacheData, 1440);

        return $cacheData;
    }

    public function formMetaLanguage($slugs) {
        $metaData = [];
        $metaDataCollection = $this->metaClass::where('language', language());
        if($slugs) {
            $metaDataCollection = $metaDataCollection->whereIn('meta_name', $slugs);
        }
        foreach($metaDataCollection->get()??[] as $meta) {
            $metaData[$meta->meta_name][$meta->owner_id] = $meta->meta_value;
        }
        return $metaData;
    }

    public function formatSelected($item) {
        return $this->$item->pluck('id')->toArray();
    }

    public function getImage($imageType = 'main') {
        if(method_exists($this, 'image')) {
            return $this->image()->whereIn('owner', $this->imageTypes)->get();
        }
        return null;
    }

}
