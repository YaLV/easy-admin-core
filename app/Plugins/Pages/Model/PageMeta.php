<?php

namespace App\Plugins\Pages\Model;

use Illuminate\Database\Eloquent\Model;

class PageMeta extends Model
{
    public $fillable = ['meta_name', 'meta_value', 'language', 'owner_id', 'owner'];

    public function page() {
        return $this->belongsTo(Page::class, 'owner_id', 'id');
    }
}
