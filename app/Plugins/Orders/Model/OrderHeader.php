<?php

namespace App\Plugins\Orders\Model;

use Illuminate\Database\Eloquent\Model;

class OrderHeader extends Model
{


    public function cartItems() {
        return $this->whereHas('items', function($q) {
            $q->where('order_header_id', $this->id);
        });
    }

    public function items() {
        return $this->hasMany(OrderLines::class);
    }
}
