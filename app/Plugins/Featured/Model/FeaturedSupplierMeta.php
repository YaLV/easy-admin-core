<?php

namespace App\Plugins\Featured\Model;

use Illuminate\Database\Eloquent\Model;

class FeaturedSupplierMeta extends Model
{
    public $fillable = ['meta_name', 'meta_value', 'language', 'owner_id'];
}
