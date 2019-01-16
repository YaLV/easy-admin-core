<?php

namespace App\Plugins\MarketDays\Functions;

use App\Languages;
use App\Plugins\MarketDays\Model\MarketDay;
use Carbon\Carbon;

trait MarketDays
{
    public function getList()
    {
        return [
            ['field' => 'marketDay', 'label' => 'Market Day', 'translate' => 'array'],
            ['field' => 'parsedAcceptOrders', 'label' => 'Order Accepted to'],
            ['field' => 'buttons', 'buttons' => ['edit', 'state'], 'label' => ''],
        ];
    }

    public function getVacationList()
    {
        return [
            ['field' => 'vacation_date', 'label' => 'Date'],
            ['field' => 'marketDay', 'label' => 'Market Day'],
            ['field' => 'buttons', 'buttons' => ['edit', 'delete', 'state'], 'label' => ''],
        ];
    }

    public function form()
    {
        $default = [
            [
                'languages' => Languages::all()->pluck('name', 'code'),
                'Label'     => 'Display',
                'data'      => [
                    'marketDay' => ['type' => 'text', 'class' => '', 'label' => 'Market Day'],
                ],
            ],
            [
                'Label' => 'Settings',
                'data'  => [
                    'hideBeforeDays'  => ['type' => 'text', 'class' => '', 'label' => 'Close sales to this day before X days'],
                    'hideBeforeHours' => ['type' => 'text', 'class' => '', 'label' => 'Close sales to this day at XX:XX hours'],
                ],
            ],
        ];

        return $default;
    }

    public function vacationForm()
    {
        $default = [
            'data' => [
                'vacation_date' => ['type' => 'text', 'class' => 'datepicker', 'label' => 'Vacation Day'],
            ],
        ];

        return $default;
    }

    public function getClosestMarketDayList()
    {
        $marketDays = [];

        foreach (MarketDay::all() as $marketDay) {
            list($time, $marketDaySelected) = $marketDay->availableTo;
            $marketDay->date = $marketDaySelected;
            $marketDays[$time] = $marketDay;
        }

        ksort($marketDays);

        return $marketDays;
    }

    public function getClosestMarketDay()
    {
        $marketDays = $this->getClosestMarketDayList();

        return count($marketDays) > 0 ? current($marketDays) : false;
    }
}