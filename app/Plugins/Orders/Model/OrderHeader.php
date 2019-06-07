<?php

namespace App\Plugins\Orders\Model;

use App\Plugins\Deliveries\Model\Delivery;
use App\Plugins\MarketDays\Model\MarketDay;
use App\Plugins\Orders\Functions\OrdersAdmin;
use App\Plugins\Products\Model\Product;
use App\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrderHeader extends Model
{

    use OrdersAdmin;
    use SoftDeletes;

    public $fillable = ['id', 'user_id', 'market_day_id', 'market_day_date', 'state', 'discount_code', 'discount_target', 'discount_amount', 'discount_type', 'delivery_amount', 'delivery_id', 'ordered_at', 'paid', 'invoice', 'payment_type', 'comments', 'discount_items', 'svaigi_comment_stats', 'svaigi_comment_invoice'];
    public $casts = [
        'discount_items' => 'array',
    ];


    public function cartItems()
    {
        return $this->whereHas('items', function (Builder $q) {
            $q->where('order_header_id', $this->id);
        });
    }

    public function items()
    {
        return $this->hasMany(OrderLines::class);
    }

    public function delivery()
    {
        return $this->belongsTo(Delivery::class);
    }

    public function currentDayItems(array $specific = [])
    {
        $items = $this->items();


        if (count($specific) > 0) {
            $items = $items->whereIn('product_id', $specific);
        }

        return $items->whereHas('products', function (Builder $q) {
            $q->whereHas('market_days', function (Builder $qq) {
                $md = session()->get('marketDay');
                $qq->where('market_days.id', $md->id);
            });
        });
    }

    public function inCategory(array $categories = [], $search = "whereHas", $items = [])
    {
        $items = $this->currentDayItems($items ?? []);

        return $items->$search('products', function (Builder $q) use ($categories) {
            $q->whereHas('extra_categories', function (Builder $qq) use ($categories) {
                $qq->whereIn('category_id', $categories);
            });
        });
    }

    public function buyer()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function buyergroup()
    {
        return $this->buyer->group;
    }

    public function order_market_day()
    {
        return $this->belongsTo(MarketDay::class, 'market_day_id', 'id');
    }

    /*
     * Scopes
     */

    /*
     * Apply filters
     */
    public function scopeFilters(Builder $query)
    {
        if ($filters = session('order_filters')) {
            foreach ($filters as $filter => $filterValue) {
                if ($filterValue) {
                    switch ($filter) {
                        case "market_day":
                            $query = $query->where('market_day_id', $filterValue);
                            break;

                        case "trashed":
                            $query = $query->onlyTrashed();
                            break;

                        case "ordered_at":
                            list($dateFrom, $dateTo) = explode("~", $filterValue);
                            $dateFrom = Carbon::createFromFormat("d.m.Y H:i", trim($dateFrom));
                            $dateTo = Carbon::createFromFormat("d.m.Y H:i", trim($dateTo));
                            $query = $query->whereBetween('ordered_at', [$dateFrom, $dateTo]);
                            break;

                        default:
                            $query = $query->where($filter, $filterValue);
                            break;
                    }
                }
            }

        }

        return $query;
    }
}
