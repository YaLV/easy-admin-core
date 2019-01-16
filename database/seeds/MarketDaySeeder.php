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
            'monday'    => 'Pirmdiena',
            'tuesday'   => 'Otrdiena',
            'wednesday' => 'Trešdiena',
            'thursday'   => 'Ceturtdiena',
            'friday'    => 'Piektdiena',
            'saturday'  => 'Sestdiena',
            'Sunday'    => 'Svētdiena',
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
