<?php

namespace App\Plugins\Orders\Model;

use Illuminate\Database\Eloquent\Model;

class OrderLines extends Model
{
    public $fillable = ['supplier_id', 'supplier_name', 'product_id', 'product_name', 'vat_id', 'vat_amount', 'vat', 'price', 'display_name', 'variation_size', 'discount', 'amount', 'variation_id'];
}
