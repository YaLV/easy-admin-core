<?php

namespace App\Plugins\Products\Model;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class ProductVariation extends Model
{
    public $fillable = [
        'amount', 'display_name', 'product_id', 'for_supplier'
    ];

    public static function boot()
    {
        static::addGlobalScope('order', function(Builder $builder) {
            $builder->orderBy('amount', 'asc');
        });

        parent::boot();
    }

    public function product() {
        return $this->belongsTo(Product::class);
    }

    public function getPriceAttribute() {
        return calcPrice($this->cost?:0, $this->product->vat->amount, $this->mark_up, (Auth::user()?Auth::user()->discount():0));
    }

}
