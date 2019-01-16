<?php

namespace App\Plugins\MarketDays\Model;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MarketDay extends Model
{
    public $fillable = ['marketDay', 'hideBeforeDays', 'hideBeforeHours'];

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

}
