<?php

namespace App\Plugins\Pages\Model;

use App\BaseModel;


class PageComponentMeta extends BaseModel
{
    public $fillable = ['meta_name', 'meta_value', 'language', 'owner_id', 'owner'];

    public $casts = [
        'meta_value' => 'array',
    ];

    public function component()
    {
        return $this->belongsTo(PageComponent::class, 'owner_id');
    }
}
