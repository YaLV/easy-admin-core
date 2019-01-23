<?php

namespace App\Plugins\Products\Model;

use App\Plugins\Vat\Model\Vat;
use Illuminate\Database\Eloquent\Model;

class ProductVariation extends Model
{
    public $fillable = [
        'unit_id', 'amount', 'display_name', 'vat_id', 'cost', 'product_id', 'mark_up', 'for_supplier'
    ];

    public function vat() {
        return $this->belongsTo(Vat::class);
    }

    public function product() {
        return $this->belongsTo(Product::class);
    }

    public function getPriceAttribute() {
        return calcPrice($this->cost?:0, [$this->mark_up?:0, $this->vat->amount]);
    }
}
