<?php

namespace App\Plugins\Categories\Model;

use App\BaseModel;
use App\Plugins\Admin\Model\File;
use App\Plugins\Attributes\Model\Attribute;
use App\Plugins\Banners\Model\Banner;
use App\Plugins\Products\Model\Product;


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

    public function filters() {
        return $this->belongsToMany(Attribute::class);
    }

    public function products() {
        return $this->belongsToMany(Product::class);
    }

    public function products_main() {
        return $this->hasMany(Product::class, 'main_category');
    }

    public function children() {
        return $this->hasMany(Category::class, 'parent_id');
    }

    public function discount() {
        return 0;
    }

    public function banners() {
        return $this->belongsToMany(Banner::class);
    }
}
