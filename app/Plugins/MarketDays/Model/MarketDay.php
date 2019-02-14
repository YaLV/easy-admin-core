<?php

namespace App\Plugins\MarketDays\Model;

use App\Plugins\Products\Model\Product;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MarketDay extends Model
{
    public $fillable = ['marketDay', 'hideBeforeDays', 'hideBeforeHours'];
    protected $casts = [
        'marketDay' => 'array'
    ];
    use SoftDeletes;

    public function getParsedAcceptOrdersAttribute() {
        return Carbon::parse("next ".$this->marketDaysSlug." midnight")->addDays(-$this->hideBeforeDays)->format('l')." ".$this->hideBeforeHours;
    }

    public function getAvailableToAttribute() {
        list($hours,$minutes) = explode(":", $this->hideBeforeHours);
        $marketDay = Carbon::parse("next ".$this->marketDaysSlug." midnight");

        if(Vacation::checkForVacation($marketDay->format('Y-m-d'))) {
            $marketDay = $marketDay->addDays(7);
        }

        $marketDayOrig = new Carbon($marketDay);
        $availableTime = $marketDay->addDays(-$this->hideBeforeDays)->addHours($hours)->addMinutes($minutes);
        if(time()>$availableTime->timestamp) {
            $marketDayOrig->addDays(7);
            return [$availableTime->addDays(7)->timestamp, $marketDayOrig];
        }
        return [$availableTime->timestamp, $marketDayOrig];
    }

    public function getNameAttribute() {
        return $this->marketDay[language()]??"";
    }

    public function products() {
        return $this->belongsToMany(Product::class);
    }
}
