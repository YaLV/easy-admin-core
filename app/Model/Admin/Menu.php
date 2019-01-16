<?php

namespace App\Model\Admin;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    public $orderBy = ['sequence', 'asc'];
    public $fillable = ['routeName', 'slug', 'icon', 'displayName', 'action', 'inMenu', 'sequence', 'parent_id', 'method'];

    public function getMenuItems() {
        return $this->whereNull('parent_id')->where('inMenu', 1)->orderBy('sequence')->get();
    }

    public function hasChildren() {
        return $this->hasMany(Menu::class, 'parent_id', 'id');
    }

    public function getParent() {
        return $this->belongsTo(Menu::class, 'parent_id','id');
    }

    public function getSlug($slug,$show=false) {
        $slug = is_array($slug)?$slug:[$slug];
        $parent = $this->getParent()->first();
        if($parent) {
            array_unshift($slug, $parent->slug);
            $slug = $parent->getSlug($slug);
        }
        return $slug;
    }

    public function getLastAttribute() {
        return $this->sequence+1;
    }
}
