<?php

namespace App\Model\Admin;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Menu
 *
 * @package App\Model\Admin
 */
class Menu extends Model
{
    /**
     * Order by sequence
     *
     * @var array
     */
    public $orderBy = ['sequence', 'asc'];

    /**
     * Fillable fields
     *
     * @var array
     */
    public $fillable = ['routeName', 'slug', 'icon', 'displayName', 'action', 'inMenu', 'sequence', 'parent_id', 'method'];

    /**
     * Menu Items
     *
     * @return mixed
     */
    public function getMenuItems() {
        return $this->whereNull('parent_id')->where('inMenu', 1)->orderBy('sequence')->get();
    }

    /**
     * Menu Children
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function hasChildren() {
        return $this->hasMany(Menu::class, 'parent_id', 'id');
    }

    /**
     * Menu Parent
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function getParent() {
        return $this->belongsTo(Menu::class, 'parent_id','id');
    }

    /**
     * Get slug ????
     *
     * @param      $slug
     * @param bool $show
     *
     * @return array
     */
    public function getSlug($slug, $show=false) {
        $slug = is_array($slug)?$slug:[$slug];
        $parent = $this->getParent()->first();
        if($parent) {
            array_unshift($slug, $parent->slug);
            $slug = $parent->getSlug($slug);
        }
        return $slug;
    }

    /**
     * Increment Sequence
     *
     * @return int|mixed
     */
    public function getLastAttribute() {
        return $this->sequence+1;
    }
}
