<?php

namespace App\Plugins\Menu\Model;

use Illuminate\Database\Eloquent\Model;

class FrontendMenu extends Model
{
    public $fillable = ['name', 'slug'];

    public function menuItems() {
        return $this->hasMany(FrontendMenuItem::class);
    }
}
