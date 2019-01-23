<?php

namespace App\Plugins\Categories\Model;

use Illuminate\Database\Eloquent\Model;

class CategoryMeta extends Model
{
    public $fillable = ['meta_name', 'meta_value', 'language', 'owner_id'];

}
