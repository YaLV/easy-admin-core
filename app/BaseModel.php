<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

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

    public function MetaLanguage() {
        $metaData = [];
        $metaDataCollection = $this->metaClass::where('language', language())->get();
        foreach($metaDataCollection??[] as $meta) {
            $metaData[$meta->meta_name][$meta->owner_id] = $meta->meta_value;
        }
        return $metaData;

    }

    public function formatSelected($item) {
        return $this->$item->pluck('id')->toArray();
    }

}
