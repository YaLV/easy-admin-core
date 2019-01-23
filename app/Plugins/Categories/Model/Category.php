<?php

namespace App\Plugins\Categories\Model;

use App\BaseModel;
use App\Plugins\Admin\Model\File;


/**
 * Class Category
 *
 * @package App\Plugins\Products\Model\Categories
 */
class Category extends BaseModel
{
    public $fillable = ['parent_id'];
    public $metaClass = __NAMESPACE__.'\CategoryMeta';

    /******************** Meta Attributes *************************/
    public function setNameAttribute($value) {
        if(!$this->id) return false;
        $this->setMeta('name', $value);
    }

    /****************** Images ***************/
    public function getCategoryImageAttribute() {
        return $this->images()->where('owner', 'category_image')->get();
    }

    public function images() {
        return $this->hasMany(File::class, 'owner_id');
    }

    public function parent() {
        return $this->belongsTo(Category::class,  'parent_id');
    }

    public function getNameAttribute() {
        if(!$this->id) return;
        return __("category.name.".$this->id);
    }
}
