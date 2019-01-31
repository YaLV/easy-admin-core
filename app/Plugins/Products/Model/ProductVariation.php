<?php

namespace App\Plugins\Products\Model;

use Illuminate\Database\Eloquent\Model;

class ProductVariation extends Model
{
    public $fillable = [
        'amount', 'display_name', 'product_id', 'for_supplier'
    ];

    public function product() {
        return $this->belongsTo(Product::class);
    }

    public function getPriceAttribute() {
        return calcPrice($this->cost?:0, [$this->mark_up?:0, $this->vat->amount]);
    }

}
