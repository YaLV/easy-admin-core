<?php

namespace App\Plugins\Orders\Model;

use Illuminate\Database\Eloquent\Model;

class OrderHeader extends Model
{
    public $fillable = ['user_id', 'market_day_id', 'market_day_date', 'state', 'discount_code', 'discount_target'];

    public function cartItems() {
        return $this->whereHas('items', function($q) {
            $q->where('order_header_id', $this->id);
        });
    }

    public function items() {
        return $this->hasMany(OrderLines::class);
    }
}
