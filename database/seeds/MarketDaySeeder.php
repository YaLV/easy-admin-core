<?php

use Illuminate\Database\Seeder;

class MarketDaySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $marketDays = [
            'monday'    => ["lv" => "Pirmdiena"],
            'tuesday'   => ["lv" => "Otrdiena"],
            'wednesday' => ["lv" => "Trešdiena"],
            'thursday'  => ["lv" => "Ceturtdiena"],
            'friday'    => ["lv" => "Piektdiena"],
            'saturday'  => ["lv" => "Sestdiena"],
            'Sunday'    => ["lv" => "Svētdiena"],
        ];

        foreach ($marketDays as $marketDaySlug => $marketDay) {
            $marketDay = \App\Plugins\MarketDays\Model\MarketDay::create([
                'marketDay'       => $marketDay,
                'marketDaysSlug'  => $marketDaySlug,
                'hideBeforeDays'  => 3,
                'hideBeforeHours' => "12:00",
            ]);
            $marketDay->delete();
        }


    }
}
