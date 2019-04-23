<?php

use Illuminate\Database\Seeder;

class OrderAdminMenu extends Seeder
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
                'slug'      => 'sales',
                'routeName' => 'sales',
            ],
            [
                'icon'        => 'fas fa-money-bill-alt',
                'displayName' => 'Sales',
                'action'      => '',
                'inMenu'      => '1',
                'sequence'    => $currentMenu->last,
                'parent_id'   => null,
                'method'      => 'GET',
            ]);

        $main = "orders";

        $mainCat = \App\Model\Admin\Menu::updateOrCreate(
            [
                'slug'      => $main,
                'routeName' => $main,
            ],
            [
                'icon'        => 'fas fa-box',
                'displayName' => 'Orders',
                'action'      => '\App\Plugins\Orders\OrderController@index',
                'inMenu'      => '1',
                'sequence'    => 0,
                'parent_id'   => $mainMenu->id,
                'method'      => 'GET',
            ]);

        \App\Model\Admin\Menu::updateOrCreate(
            [
                'slug'      => 'search:{search}',
                'routeName' => "$main.search",
            ],
            [
                'icon'        => 'fas fa-search',
                'displayName' => 'Search',
                'action'      => '\App\Plugins\Orders\OrderController@index',
                'inMenu'      => '0',
                'sequence'    => 0,
                'parent_id'   => $mainCat->id,
                'method'      => 'GET',
            ]);

        \App\Model\Admin\Menu::updateOrCreate(
            [
                'slug'      => 'destroy',
                'routeName' => "$main.destroy",
            ],
            [
                'icon'        => 'fas fa-trash',
                'displayName' => 'Remove Order',
                'action'      => '\App\Plugins\Orders\OrderController@destroy',
                'inMenu'      => '0',
                'sequence'    => 0,
                'parent_id'   => $mainCat->id,
                'method'      => 'POST',
            ]);
        \App\Model\Admin\Menu::updateOrCreate(
            [
                'slug'      => 'setpaid/{id}',
                'routeName' => "$main.setpaid",
            ],
            [
                'icon'        => 'fas fa-',
                'displayName' => 'Set Paid',
                'action'      => '\App\Plugins\Orders\OrderController@setPaid',
                'inMenu'      => '0',
                'sequence'    => 0,
                'parent_id'   => $mainCat->id,
                'method'      => 'POST',
            ]);
        \App\Model\Admin\Menu::updateOrCreate(
            [
                'slug'      => 'changeState/{id}',
                'routeName' => "$main.changeState",
            ],
            [
                'icon'        => 'fas fa-',
                'displayName' => 'Change State',
                'action'      => '\App\Plugins\Orders\OrderController@changeState',
                'inMenu'      => '0',
                'sequence'    => 0,
                'parent_id'   => $mainCat->id,
                'method'      => 'POST',
            ]);
        \App\Model\Admin\Menu::updateOrCreate(
            [
                'slug'      => 'view/{id}',
                'routeName' => "$main.view",
            ],
            [
                'icon'        => 'fas fa-fa-folder-open',
                'displayName' => 'View',
                'action'      => '\App\Plugins\Orders\OrderController@showOrder',
                'inMenu'      => '0',
                'sequence'    => 0,
                'parent_id'   => $mainCat->id,
                'method'      => 'GET',
            ]);
        \App\Model\Admin\Menu::updateOrCreate(
            [
                'slug'      => 'viewOriginal/{id}',
                'routeName' => "$main.viewOriginal",
            ],
            [
                'icon'        => 'fas fa-fa-folder-open',
                'displayName' => 'View',
                'action'      => '\App\Plugins\Orders\OrderController@showOriginal',
                'inMenu'      => '0',
                'sequence'    => 0,
                'parent_id'   => $mainCat->id,
                'method'      => 'GET',
            ]);

        /*
        $main = 'orderHistory';
        $mainCat = \App\Model\Admin\Menu::updateOrCreate(
            [
                'slug'      => $main,
                'routeName' => $main,
            ],
            [
                'icon'        => 'fas fa-box',
                'displayName' => 'Order Archive',
                'action'      => '\App\Plugins\Orders\OrderController@index',
                'inMenu'      => '1',
                'sequence'    => 0,
                'parent_id'   => $mainMenu->id,
                'method'      => 'GET',
            ]);
        \App\Model\Admin\Menu::updateOrCreate(
            [
                'slug'      => 'destroy',
                'routeName' => "$main.destroy",
            ],
            [
                'icon'        => 'fas fa-trash',
                'displayName' => 'Remove Archived Order',
                'action'      => '\App\Plugins\Orders\OrderController@removeOrder',
                'inMenu'      => '1',
                'sequence'    => 0,
                'parent_id'   => $mainCat->id,
                'method'      => 'POST',
            ]);
*/
    }
}
