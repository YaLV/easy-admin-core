<?php

namespace App\Plugins\Orders\Model;

use App\Plugins\Deliveries\Model\Delivery;
use App\Plugins\MarketDays\Model\MarketDay;
use App\Plugins\Orders\Functions\OrdersAdmin;
use App\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrderHeader extends Model
{

    use OrdersAdmin;
    use SoftDeletes;

    public $fillable = ['user_id', 'market_day_id', 'market_day_date', 'state', 'discount_code', 'discount_target','discount_amount','discount_type', 'delivery_amount', 'delivery_id', 'ordered_at', 'paid', 'invoice', 'payment_type'];

    public function cartItems() {
        return $this->whereHas('items', function(Builder $q) {
            $q->where('order_header_id', $this->id);
        });
    }

    public function items() {
        return $this->hasMany(OrderLines::class);
    }

    public function delivery() {
        return $this->belongsTo(Delivery::class);
    }

    public function currentDayItems(array $specific = []) {
        $items = $this->items();

        if(count($specific)>0) {
            $items = $items->whereIn('id', $specific);
        }

        return $items->whereHas('products', function(Builder $q) {
           $q->whereHas('market_days', function(Builder $qq) {
               $md = session()->get('marketDay');
               $qq->where('market_days.id', $md->id);
           });
        });
    }

    public function buyer() {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function buyergroup() {
        return $this->buyer->group;
    }

    public function order_market_day() {
        return $this->belongsTo(MarketDay::class, 'market_day_id', 'id');
    }
}
