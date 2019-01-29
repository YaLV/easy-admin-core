<?php

namespace App\Plugins\Attributes\Model;

use Illuminate\Database\Eloquent\Model;

class AttributeValueMeta extends Model
{
    public $fillable = ['meta_name', 'meta_value', 'language', 'owner_id'];
}
