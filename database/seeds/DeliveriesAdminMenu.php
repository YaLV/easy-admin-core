<?php

use Illuminate\Database\Seeder;

class DeliveriesAdminMenu extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $currentMenu = \App\Model\Admin\Menu::where('slug', '!=', 'config')->orderBy('sequence', 'desc')->first();

        $mainMenu = \App\Model\Admin\Menu::updateOrCreate(
            [
                'slug'      => 'shop',
                'routeName' => 'shop',
            ],
            [
                'icon'        => 'fas fa-shopping-bag',
                'displayName' => 'Shop',
                'action'      => '',
                'inMenu'      => '1',
                'sequence'    => $currentMenu->last,
                'parent_id'   => null,
                'method'      => 'GET',
            ]);

        $main = "deliveries";

        $mainCat = \App\Model\Admin\Menu::updateOrCreate(
            [
                'slug'      => $main,
                'routeName' => $main,
            ],
            [
                'icon'        => 'fas fa-shipping-fast',
                'displayName' => 'Deliveries',
                'action'      => '',
                'inMenu'      => '1',
                'sequence'    => 0,
                'parent_id'   => $mainMenu->id,
                'method'      => 'GET',
            ]);

        \App\Model\Admin\Menu::updateOrCreate(
            [
                'slug'      => "list",
                'routeName' => "$main.list",
            ],
            [
                'icon'        => 'fas fa-list',
                'displayName' => 'List',
                'action'      => '\App\Plugins\Deliveries\DeliveryController@index',
                'inMenu'      => '1',
                'sequence'    => 0,
                'parent_id'   => $mainCat->id,
                'method'      => 'GET',
            ]);
        \App\Model\Admin\Menu::updateOrCreate(
            [
                'slug'      => "add",
                'routeName' => "$main.add",
            ],
            [
                'icon'        => 'fas fa-plus',
                'displayName' => 'Add',
                'action'      => '\App\Plugins\Deliveries\DeliveryController@add',
                'inMenu'      => '1',
                'sequence'    => 1,
                'parent_id'   => $mainCat->id,
                'method'      => 'GET',
            ]);
        \App\Model\Admin\Menu::updateOrCreate(
            [
                'slug'      => "edit/{id}",
                'routeName' => "$main.edit",
            ],
            [
                'icon'        => 'fas fa-edit',
                'displayName' => 'Edit',
                'action'      => '\App\Plugins\Deliveries\DeliveryController@edit',
                'inMenu'      => '0',
                'sequence'    => 0,
                'parent_id'   => $mainCat->id,
                'method'      => 'GET',
            ]);
        \App\Model\Admin\Menu::updateOrCreate(
            [
                'slug'      => "store/{id?}",
                'routeName' => "$main.store",
            ],
            [
                'icon'        => 'fas fa-plus',
                'displayName' => 'Store',
                'action'      => '\App\Plugins\Deliveries\DeliveryController@store',
                'inMenu'      => '0',
                'sequence'    => 0,
                'parent_id'   => $mainCat->id,
                'method'      => 'POST',
            ]);
        \App\Model\Admin\Menu::updateOrCreate(
            [
                'slug'      => "destroy/{id}",
                'routeName' => "$main.destroy",
            ],
            [
                'icon'        => 'fas fa-trash-alt',
                'displayName' => 'Destroy',
                'action'      => '\App\Plugins\Deliveries\DeliveryController@destroy',
                'inMenu'      => '0',
                'sequence'    => 0,
                'parent_id'   => $mainCat->id,
                'method'      => 'POST',
            ]);

        \App\Model\Admin\Menu::updateOrCreate(
            [
                'slug'      => "state/{id?}",
                'routeName' => "$main.state",
            ],
            [
                'icon'        => 'fas fa-plus',
                'displayName' => 'State',
                'action'      => '\App\Plugins\Deliveries\DeliveryController@changeState',
                'inMenu'      => '0',
                'sequence'    => 0,
                'parent_id'   => $mainCat->id,
                'method'      => 'POST',
            ]
        );

        \App\Model\Admin\Menu::updateOrCreate(
            [
                'slug'      => "sort",
                'routeName' => "$main.sort",
            ],
            [
                'icon'        => 'fas fa-arrows-alt-v',
                'displayName' => 'Sort',
                'action'      => '\App\Plugins\Deliveries\DeliveryController@setOrder',
                'inMenu'      => '0',
                'sequence'    => 0,
                'parent_id'   => $mainCat->id,
                'method'      => 'POST',
            ]
        );
    }
}
