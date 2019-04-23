<?php

use Illuminate\Database\Seeder;

class VacationsAdminMenu extends Seeder
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

        $main = 'vacations';

        $vacations = \App\Model\Admin\Menu::updateOrCreate(
            [
                'slug'      => $main,
                'routeName' => $main,
            ],
            [
                'icon'        => 'fas fa-calendar-times',
                'displayName' => 'Vacations',
                'action'      => '\App\Plugins\MarketDays\MarketDaysController@listVacationDays',
                'inMenu'      => '1',
                'sequence'    => $lastSeq,
                'parent_id'   => $menu->id,
                'method'      => 'GET',
            ]);

        \App\Model\Admin\Menu::updateOrCreate(
            [
                'slug'      => "add",
                'routeName' => $main.".add",
            ],
            [
                'icon'        => 'fas fa-calendar-times',
                'displayName' => 'Add',
                'action'      => '\App\Plugins\MarketDays\MarketDaysController@addVacationDay',
                'inMenu'      => '0',
                'sequence'    => ++$lastSeq,
                'parent_id'   => $vacations->id,
                'method'      => 'GET',
            ]);
        \App\Model\Admin\Menu::updateOrCreate(
            [
                'slug'      => "destroy/{id}",
                'routeName' => $main.".destroy",
            ],
            [
                'icon'        => 'far fa-window-close',
                'displayName' => 'Delete',
                'action'      => '\App\Plugins\MarketDays\MarketDaysController@deleteVacationDay',
                'inMenu'      => '0',
                'sequence'    => ++$lastSeq,
                'parent_id'   => $vacations->id,
                'method'      => 'POST',
            ]);


        \App\Model\Admin\Menu::updateOrCreate(
            [
                'slug'      => "store",
                'routeName' => $main.".store",
            ],
            [
                'icon'        => 'far fa-window-close',
                'displayName' => 'Save',
                'action'      => '\App\Plugins\MarketDays\MarketDaysController@storeVacationDay',
                'inMenu'      => '0',
                'sequence'    => ++$lastSeq,
                'parent_id'   => $vacations->id,
                'method'      => 'POST',
            ]);
    }
}
