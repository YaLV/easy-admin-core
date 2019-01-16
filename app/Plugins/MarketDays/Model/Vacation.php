<?php

namespace App\Plugins\MarketDays\Model;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Vacation extends Model
{
    use SoftDeletes;

    public $fillable = ['vacation_date'];

    public function getMarketDayAttribute() {
        $carbon = new Carbon($this->vacation_date);
        return $carbon->format('l');
    }

    public static function checkForVacation($dateToCheck) {
        return self::where('vacation_date', $dateToCheck)->first();
    }

    public function getVacationDateAttribute($value) {
        if(!$value) return "";
        $carbon = new Carbon($value);
        return $carbon->format('d.m.Y');
    }
}
