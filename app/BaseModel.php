<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

/**
 * Class BaseModel
 *
 * @package App
 * @property callback increment
 */
class BaseModel extends Model
{

    /**
     * @var
     */
    private $metaContent;

    public $language;

    /**
     * Setting Meta (unused ??)
     *
     * @param $name
     * @param $value
     *
     * @return bool
     */
    public function setMeta($name, $value) {
        if(!$this->id) return false;
        foreach(languages() as $language) {
            if(!$value[$language->code]??false) { continue; }
            $this->metaClass::firstOrCreate(['owner_id' => $this->id,'language' => $language->code], ['meta_value' => $value[$language->code], 'meta_name' => $name]);
        }
        return true;
    }

    /**
     * Get Models Meta Data
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function metaData() {
        if($this->metaClass) {
            return $this->hasMany($this->metaClass, 'owner_id', $this->idField ?? 'id');
        }
        return null;
    }

    /**
     * Get Single meta attribute
     *
     * @return array
     */
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

    /**
     * Forget Meta cache
     *
     * @param array $slugs
     */
    public function forgetMeta($slugs = []) {
        foreach(languages() as $language) {
            Cache::forget(implode("_", array_merge([class_basename($this), "meta", $language->code], $slugs)));
        }
    }

    /**
     * Get Meta (specific fields), either from cache, or DB, and cache it
     *
     * @param array $slugs
     * @param bool  $forget
     *
     * @return array|mixed
     */
    public function MetaLanguage($slugs = [], $forget = false) {

        $cacheData = Cache::get(implode("_", array_merge([class_basename($this),"meta", language()],$slugs)))??$this->formMetaLanguage($slugs);

        Cache::put(implode("_", array_merge([class_basename($this),"meta", language()],$slugs)), $cacheData, 1440);

        return $cacheData;
    }

    /**
     * unused ???
     *
     * @param $slugs
     *
     * @return array
     */
    public function formMetaLanguage($slugs) {
        $metaData = [];
        $metaDataCollection = $this->metaClass::where('language', language());
        if($slugs) {
            $metaDataCollection = $metaDataCollection->whereIn('meta_name', $slugs);
        }
        foreach($metaDataCollection->get()??[] as $meta) {
            $tKey = $meta->transKey??false;
            if(!$tKey) {
                $tKey = $meta->owner_id;
            } else {
                $tKey = $meta->$tKey;
            }
            $metaData[$meta->meta_name][$tKey] = $meta->meta_value;
        }
        return $metaData;
    }

    /**
     *  Select "chosen" selectables
     *
     * @param $item
     *
     * @return array
     */
    public function formatSelected($item) {
        return $this->$item->pluck('id')->toArray()??[];
    }

    /**
     * Get image filename
     *
     * @param string $imageType
     *
     * @return null
     */
    public function getImage($imageType = 'main') {
        if(method_exists($this, 'images')) {
            $types = array_flip(config('app.uploadFile'));
            if($types[str_plural(strtolower(class_basename($this)))]) {
                return $this->images()->where('owner', $types[str_plural(strtolower(class_basename($this)))])->first();
            }
        }
        return null;
    }

    public function getImageByKey($imageType = 'main', $size = false) {
        if(method_exists($this, 'images')) {
            $image = $this->images()->where('owner', $imageType)->first();
            $path = config("app.uploadFile.$imageType","temp");

            if(!$size) {
                $size = current(config("app.imageSize.$imageType", ['original']));
            } else {
                $size = config("app.imageSize.$imageType.$size", 'original');
            }
            if(!$image) {
                return null;
            }
            return "/$path/$size/{$image->filePath}";
        }
        return null;

    }

    public function getImageById($id, $size = false) {
        if(method_exists($this, 'images')) {
            $image = $this->images()->where('id', $id)->first();
            $imageType = $image->owner;

            $path = config("app.uploadFile.$imageType","temp");

            if(!$size) {
                $size = current(config("app.imageSize.$imageType", ['original']));
            } else {
                $size = config("app.imageSize.$imageType.$size", 'original');
            }
            if(!$image) {
                return null;
            }
            return "/$path/$size/{$image->filePath}";
        }
        return null;

    }
}
