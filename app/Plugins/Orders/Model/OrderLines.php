<?php

namespace App\Plugins\Orders\Model;

use App\Plugins\Products\Model\Product;
use App\Plugins\Products\Model\ProductVariation;
use App\Plugins\Suppliers\Model\Supplier;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class OrderLines extends Model
{
    public $fillable = [
        'supplier_id',
        'supplier_name',
        'product_id',
        'product_name',
        'vat_id',
        'vat_amount',
        'vat',
        'price',
        'display_name',
        'variation_size',
        'discount',
        'amount',
        'variation_id',
        'real_amount',
        'total_amount',
        'amount_unit',
        'price_raw',
        'vat_raw',
        'cost',
        'markup',
        'markup_amount',
        'discount_name'
    ];

    public function products()
    {
        return $this->belongsTo(Product::class,
            'product_id',
            'id');
    }

    public function currentMarketDayProducts()
    {
        $md = session()->get('marketDay');

        return $this->products()->whereHas('market_days',
            function (Builder $q) use ($md) {
                $q->where('market_days.id',
                    $md->id);
            });
    }

    public function getTable()
    {
        return parent::getTable(); // TODO: Change the autogenerated stub
    }

    public function variation()
    {
        return $this->belongsTo(ProductVariation::class);
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

    public function order()
    {
        return $this->belongsTo(OrderHeader::class,
            'order_header_id',
            'id');
    }

    public function ScopeDiscountUnder(
        Builder $query,
        $amount,
        $type
    ) {
        if ($type == 'percent') {
            return $query->where('discount',
                '<',
                $amount);
        }

        return $query;
    }

    public function ScopeDiscountOver(
        Builder $query,
        $amount,
        $type,
        $items
    ) {

        if ($type == 'percent') {
            if (($items ?? false) && count($items) > 0) {
                return $query->where(function (Builder $q) use (
                    $amount,
                    $items
                ) {
                    $q->where('discount',
                        '>=',
                        $amount)->whereIn('product_id',
                        $items);
                })->orWhereNotIn('product_id', $items);

            }

            return $query->where('discount', '>=', $amount);
        }

        return $query;
    }

}