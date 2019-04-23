<?php

namespace App\Plugins\Orders\Model;

use App\Plugins\Products\Model\Product;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class OrderLines extends Model
{
    public $fillable = ['supplier_id', 'supplier_name', 'product_id', 'product_name', 'vat_id', 'vat_amount', 'vat', 'price', 'display_name', 'variation_size', 'discount', 'amount', 'variation_id', 'real_amount', 'total_amount', 'amount_unit'];

    public function products() {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }

    public function currentMarketDayProducts() {
        $md = session()->get('marketDay');
        return $this->products()->whereHas('market_days', function(Builder $q) use($md) {
            $q->where('market_days.id', $md->id);
        });
    }

    public function getTable()
    {
        return parent::getTable(); // TODO: Change the autogenerated stub
    }
}
