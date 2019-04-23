<?php

use Illuminate\Database\Seeder;

class MarketDaysAdminMenu extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $menu = \App\Model\Admin\Menu::updateOrCreate(
            [
                'slug'      => 'config',
                'routeName' => 'config',
            ],
            [
                'icon'        => 'fas fa-cogs',
                'displayName' => 'Configurations',
                'action'      => '',
                'inMenu'      => '1',
                'sequence'    => 99,
                'parent_id'   => null,
                'method'      => 'GET',
            ]);

        $lastSeq = \App\Model\Admin\Menu::where('parent_id', $menu->id)->orderBy('sequence', 'DESC')->first()->sequence ?? 0;

        $lastSeq++;

        $main = 'marketdays';

        $marketDays = \App\Model\Admin\Menu::updateOrCreate(
            [
                'slug'      => $main,
                'routeName' => $main,
            ],
            [
                'icon'        => 'fas fa-calendar-alt',
                'displayName' => 'Market Days',
                'action'      => '\App\Plugins\MarketDays\MarketDaysController@listMarketDays',
                'inMenu'      => '1',
                'sequence'    => $lastSeq,
                'parent_id'   => $menu->id,
                'method'      => 'GET',
            ]);

        $lastSeq++;
        \App\Model\Admin\Menu::updateOrCreate(
            [
                'slug'      => "edit/{id}",
                'routeName' => "$main.edit",
            ],
            [
                'icon'        => 'fas fa-edit',
                'displayName' => 'Edit',
                'action'      => '\App\Plugins\MarketDays\MarketDaysController@editMarketDay',
                'inMenu'      => '0',
                'sequence'    => $lastSeq,
                'parent_id'   => $marketDays->id,
                'method'      => 'GET',
            ]);

        $lastSeq++;
        \App\Model\Admin\Menu::updateOrCreate(
            [
                'slug'      => "state/{id}",
                'routeName' => "$main.state",
            ],
            [
                'icon'        => 'fas fa-edit',
                'displayName' => 'State',
                'action'      => '\App\Plugins\MarketDays\MarketDaysController@changeState',
                'inMenu'      => '0',
                'sequence'    => $lastSeq,
                'parent_id'   => $marketDays->id,
                'method'      => 'POST',
            ]);

        $lastSeq++;
        \App\Model\Admin\Menu::updateOrCreate(
            [
                'slug'      => "store/{id?}",
                'routeName' => "$main.store",
            ],
            [
                'icon'        => 'fas fa-edit',
                'displayName' => 'Save',
                'action'      => '\App\Plugins\MarketDays\MarketDaysController@storeMarketDay',
                'inMenu'      => '0',
                'sequence'    => $lastSeq,
                'parent_id'   => $marketDays->id,
                'method'      => 'POST',
            ]);

    }
}
