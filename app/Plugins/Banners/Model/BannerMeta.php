<?php

namespace App\Plugins\Banners\Model;

use Illuminate\Database\Eloquent\Model;

class BannerMeta extends Model
{
    public $fillable = ['meta_name', 'meta_value', 'language', 'owner_id'];

    public function banner() {
        return $this->hasOne(Banner::class);
    }
}
