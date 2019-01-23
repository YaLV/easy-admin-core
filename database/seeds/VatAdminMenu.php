<?php

use Illuminate\Database\Seeder;

class VatAdminMenu extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $menu = \App\Model\Admin\Menu::firstOrCreate(
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

        $main = 'vat';

        $vacations = \App\Model\Admin\Menu::firstOrCreate(
            [
                'slug'      => $main,
                'routeName' => $main,
            ],
            [
                'icon'        => 'fas fa-percent',
                'displayName' => 'Vat',
                'action'      => '\App\Plugins\Vat\VatController@index',
                'inMenu'      => '1',
                'sequence'    => $lastSeq,
                'parent_id'   => $menu->id,
                'method'      => 'GET',
            ]);

        \App\Model\Admin\Menu::firstOrCreate(
            [
                'slug'      => "add",
                'routeName' => $main.".add",
            ],
            [
                'icon'        => 'fas fa-calendar-times',
                'displayName' => 'Add',
                'action'      => '\App\Plugins\Vat\VatController@add',
                'inMenu'      => '0',
                'sequence'    => ++$lastSeq,
                'parent_id'   => $vacations->id,
                'method'      => 'GET',
            ]);
        \App\Model\Admin\Menu::firstOrCreate(
            [
                'slug'      => "edit/{id}",
                'routeName' => $main.".edit",
            ],
            [
                'icon'        => 'fas fa-edit',
                'displayName' => 'Edit',
                'action'      => '\App\Plugins\Vat\VatController@edit',
                'inMenu'      => '0',
                'sequence'    => ++$lastSeq,
                'parent_id'   => $vacations->id,
                'method'      => 'GET',
            ]);
        \App\Model\Admin\Menu::firstOrCreate(
            [
                'slug'      => "destroy/{id}",
                'routeName' => $main.".destroy",
            ],
            [
                'icon'        => 'far fa-window-close',
                'displayName' => 'Delete',
                'action'      => '\App\Plugins\Vat\VatController@delete',
                'inMenu'      => '0',
                'sequence'    => ++$lastSeq,
                'parent_id'   => $vacations->id,
                'method'      => 'POST',
            ]);


        \App\Model\Admin\Menu::firstOrCreate(
            [
                'slug'      => "store/{id?}",
                'routeName' => $main.".store",
            ],
            [
                'icon'        => 'far fa-window-close',
                'displayName' => 'Save',
                'action'      => '\App\Plugins\Vat\VatController@store',
                'inMenu'      => '0',
                'sequence'    => ++$lastSeq,
                'parent_id'   => $vacations->id,
                'method'      => 'POST',
            ]);
    }
}
