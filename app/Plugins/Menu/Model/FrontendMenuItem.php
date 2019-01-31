<?php

namespace App\Plugins\Menu\Model;

use Illuminate\Database\Eloquent\Model;

class FrontendMenuItem extends Model
{
    public $fillable = ['frontend_menu_item_id', 'frontend_menu_id', 'menu_owner', 'owner_id', 'sequence'];

    public function menuItems()
    {
        return $this->hasMany(FrontendMenuItem::class);
    }
}
