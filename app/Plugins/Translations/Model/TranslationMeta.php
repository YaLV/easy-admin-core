<?php

namespace App\Plugins\Translations\Model;

use App\BaseModel;

class TranslationMeta extends BaseModel
{
    public $fillable = ['meta_name', 'meta_value', 'language', 'owner_id'];
    public $transKey = "slug";

    public function getSlugAttribute() {
        return $this->translation->key;
    }

    public function translation() {
        return $this->belongsTo(Translation::class, 'owner_id');
    }
}
