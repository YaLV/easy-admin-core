<?php

namespace App\Plugins\Suppliers\Model;

use App\BaseModel;
use App\Plugins\Admin\Model\File;
use App\Plugins\Blog\Model\Blog;
use App\Plugins\Products\Model\Product;

class Supplier extends BaseModel
{
    public $fillable = [
        'custom_id',
        'email',
        'location',
        'coords',
        'farmer',
        'craftsman',
        'featured',
    ];
    public $metaClass = __NAMESPACE__ . '\SupplierMeta';

    public function getNameAttribute()
    {
        if (!$this->id) return;

        return __('supplier.name.' . $this->id);
    }

    public function products() {
        return $this->hasMany(Product::class);
    }

    public function images() {
        return $this->hasMany(File::class, 'owner_id');
    }

    public function getCoordsArrayAttribute() {
        return explode(",",$this->coords);
    }

    public function blogPosts() {
        return $this->belongsToMany(Blog::class);
    }
}
