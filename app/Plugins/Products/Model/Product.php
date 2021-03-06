<?php

namespace App\Plugins\Products\Model;


use App\BaseModel;
use App\Functions\General;
use App\Plugins\Admin\Model\File;
use App\Plugins\Attributes\Model\Attribute;
use App\Plugins\Attributes\Model\AttributeValue;
use App\Plugins\Blog\Model\Blog;
use App\Plugins\Categories\Model\Category;
use App\Plugins\MarketDays\Model\MarketDay;
use App\Plugins\Suppliers\Model\Supplier;
use App\Plugins\Units\Model\Unit;
use App\Plugins\Vat\Model\Vat;
use App\User;
use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

/**
 * Class Product
 *
 * @package App\Plugins\Products\Model
 */
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
        'vat_id',
        'unit_id',
        'cost',
        'mark_up',
        'sequence',
        'storage_amount',
        'info'
    ];
    public $metaClass = __NAMESPACE__ . '\ProductMeta';
    public $imageTypes;

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
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

    /**
     * @param $item
     *
     * @return array
     */
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

    public function market_days()
    {
        return $this->belongsToMany(MarketDay::class);
    }

    public function supplier_id()
    {
        return $this->belongsTo(Supplier::class);
    }

    public function attributes()
    {
        return $this->belongsToMany(Attribute::class);
    }

    public function attributeValues()
    {
        return $this->belongsToMany(AttributeValue::class);
    }

    public function attributeValuesList($product_id)
    {
        return $this->attributes()->values()->whereHas('product', function ($q) use ($product_id) {
            $q->where('product_id', $product_id);
        })->get();
    }

    public function vat()
    {
        return $this->belongsTo(Vat::class);
    }

    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }

    public function createVariation()
    {
        $this->variations()->delete();

        $unitSize = $this->unit->unit;

        return [
            $this->variations()->create([
                'amount'       => 1,
                'display_name' => "1" . $unitSize,
                'for_supplier' => "1" . $unitSize,
            ]),
        ];
    }

    public function metaName()
    {
        return $this->hasMany(ProductMeta::class, 'owner_id', 'id')->where('meta_name', 'name')->where('language', language());
    }

    /***************** Frontend Functions ********************/

    public function isSale()
    {
        return 1;
    }

    public function isNew()
    {
        return rand(0, 1);
    }

    public function images()
    {
        return $this->hasMany(File::class, 'owner_id');
    }

    public function getProductImageAttribute()
    {
        return $this->images()->where("owner", "product_image")->get();
    }

    public function findDiscount()
    {
        return Auth::user()->discount($this->id, $this->main_category);
    }

    public function getAmountAttribute() {
        return "<input type='text' name='amount' class='form-control small-width ajaxUpdate' style='float:left;' /> <a href='".route('products.storage.store', [$this->id])."' class='btn btn-xs hidden ajaxUpdate' style='display:block;float:left;'><i class='fas fa-check'></i></a>";
    }

    public function getInfoWindowAttribute() {
        return "<input type='text' name='info' class='form-control small-width ajaxUpdate updateInfo' style='float:left;' value='".$this->info."' /> <a href='".route('products.storage.store', [$this->id])."' class='btn btn-xs hidden ajaxUpdate' style='display:block;float:left;'><i class='fas fa-check'></i></a>";
    }

    public function getAvailableAttribute() {
        return "<input type='text' readonly class='form-control small-width currentAmount' style='float:left;border:0px;background:transparent;padding-left:0px;padding-right:0px;' value='".$this->storage_amount."'> <input type='hidden' name='reset' value='1' /> <a href='".route('products.storage.store', [$this->id])."' class='btn btn-xs hidden ajaxUpdate' style='display:block;float:left;'><i class='fas fa-times'></i></a>";
    }

    public function blogPosts() {
        return $this->belongsToMany(Blog::class);
    }

}