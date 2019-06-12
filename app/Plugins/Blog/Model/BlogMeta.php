<?php

namespace App\Plugins\Blog\Model;

use Illuminate\Database\Eloquent\Model;

class BlogMeta extends Model
{
    public $fillable = ['meta_name', 'meta_value', 'language', 'owner_id'];

    public function posts() {
        return $this->belongsTo(Blog::class);
    }
}
