<?php

namespace App\Plugins\Translations\Model;

use App\BaseModel;

class Translation extends BaseModel
{
    public $fillable = ['key', 'params'];
    public $metaClass = __NAMESPACE__ . '\TranslationMeta';
    public $casts = [
        'params' => 'array'
    ];

    public $rowClass = "editTranslation";

    public function translation() {
        return $this->belongsTo(TranslationMeta::class, 'owner_id');
    }

    public function getParamsListAttribute() {
        return implode(", ",$this->params);
    }

}
