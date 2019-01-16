<?php

use Illuminate\Database\Seeder;

class LanguageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\Languages::create([
            'code' => 'lv',
            'name' => 'Latviešu',
            'is_default' => true
        ]);

    }
}
