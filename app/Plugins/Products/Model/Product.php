<?php

namespace App\Plugins\Products\Model;


use App\BaseModel;
use App\Functions\General;
use App\Plugins\Attributes\Model\Attribute;
use App\Plugins\Attributes\Model\AttributeValue;
use App\Plugins\Categories\Model\Category;
use App\Plugins\MarketDays\Model\MarketDay;
use App\Plugins\Suppliers\Model\Supplier;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends BaseModel
{
    use SoftDeletes;
    use General;

    public $fillable = [
        'sku',
        'state',
        'is_bio',
        'is_lv',
        'is_suggested',
        'is_highlighted',
        'main_category',
        'supplier_id',
    ];
    public $metaClass = __NAMESPACE__ . '\ProductMeta';


    public function getMainCategoryasdAttribute()
    {
        if (!$this->id) return;

        dd($this->main_cat()->first());

        return $this->main_cat()->id;
    }

    public function main_cat()
    {
        return $this->belongsTo(Category::class, 'main_category', 'id');
    }

    public function extra_categories()
    {
        return $this->belongsToMany(Category::class);
    }

    public function getNameAttribute()
    {
        if (!$this->id) return;

        return __('product.name.' . $this->id);
    }

    public function variations()
    {
        return $this->hasMany(ProductVariation::class);
    }

    public function formatSelected($item)
    {
        switch ($item) {
            case "extra_categories":
            case "market_days":
                return $this->$item->pluck('id')->toArray();
                break;

            default:
                return [];
                break;
        }
    }

    public function market_days() {
        return $this->belongsToMany(MarketDay::class);
    }

    public function supplier_id() {
        return $this->belongsTo(Supplier::class);
    }

    public function attributes() {
        return $this->belongsToMany(Attribute::class);
    }

    public function attributeValues() {
        return $this->belongsToMany(AttributeValue::class);
    }

    public function attributeValuesList($product_id) {
        return $this->attributes()->values()->whereHas('product', function($q) use($product_id){
            $q->where('product_id', $product_id);
        })->get();
    }
}