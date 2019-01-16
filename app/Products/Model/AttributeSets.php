<?php

namespace App\Plugins\Products\Model;

use Illuminate\Database\Eloquent\Model;

class AttributeSets extends Model
{
    public function attributes() {
        return $this->hasMany(Attribute::class);
    }
}
