<?php

namespace App\Plugins\Suppliers\Model;

use Illuminate\Database\Eloquent\Model;

class SupplierMeta extends Model
{
    public $fillable = ['meta_name', 'meta_value', 'language', 'owner_id'];

}
