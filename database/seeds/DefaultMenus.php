<?php

use Illuminate\Database\Seeder;

class DefaultMenus extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Plugins\Menu\Model\FrontendMenu::updateOrCreate([
            'name'      => 'Shop Menu',
            'slug'      => 'shop',
            'protected' => 1,
        ]);

        \App\Plugins\Menu\Model\FrontendMenu::updateOrCreate([
            'name'      => 'Main Menu',
            'slug'      => 'main',
            'protected' => 1,
        ]);

    }
}
