<?php

namespace App\Plugins\Deliveries\Model;

use App\BaseModel;
use App\Plugins\MarketDays\Model\MarketDay;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletes;

class Delivery extends BaseModel
{
    use SoftDeletes;

    public $fillable = [
        'deliveryTime',
        'price',
        'vat_id',
        'freeAbove',
        'type',
        'sequence',
    ];
    public $metaClass = __NAMESPACE__ . '\DeliveryMeta';

    public static function boot()
    {
        static::addGlobalScope('order', function(Builder $builder) {
            $builder->orderBy('sequence', 'asc');
        });

        parent::boot();
    }

    public function getMarketDayListAttribute()
    {
        $mdays = [];
        $md = $this->marketDays;

        foreach ($md as $selectedMd) {
            $mdays[] = $selectedMd->marketDay[language()];
        }

        return implode(", ", $mdays);
    }

    public function marketDays()
    {
        return $this->belongsToMany(MarketDay::class);
    }
}
