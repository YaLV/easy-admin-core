<?php

namespace App\Plugins\Featured\Model;

use App\BaseModel;
use App\Plugins\Admin\Model\File;
use App\Plugins\Suppliers\Model\Supplier;

class FeaturedSupplier extends BaseModel
{
    public $fillable = ['id', 'supplier_id'];
    public $metaClass = __NAMESPACE__ . '\FeaturedSupplierMeta';

    public function images() {
        return $this->hasMany(File::class, 'owner_id', 'id')->where('owner', 'featured_image');
    }

    public function supplier() {
        return $this->belongsTo(Supplier::class);
    }
}
