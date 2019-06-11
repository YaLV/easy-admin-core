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
                'slug'      => 'search/{search?}',
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
                'slug'      => 'destroy/{id?}',
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
        $viewCat = \App\Model\Admin\Menu::updateOrCreate(
            [
                'slug'      => 'view/{id}/{original?}',
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
                'slug'      => 'setFilters',
                'routeName' => "$main.setfilters",
            ],
            [
                'icon'        => 'fas fa-',
                'displayName' => 'Set Filters',
                'action'      => '\App\Plugins\Orders\OrderController@setFilters',
                'inMenu'      => '0',
                'sequence'    => 0,
                'parent_id'   => $mainCat->id,
                'method'      => 'POST',
            ]);

        \App\Model\Admin\Menu::updateOrCreate(
            [
                'slug'      => 'clearFilters',
                'routeName' => "$main.clearfilters",
            ],
            [
                'icon'        => 'fas fa-',
                'displayName' => 'Clear Filters',
                'action'      => '\App\Plugins\Orders\OrderController@clearFilters',
                'inMenu'      => '0',
                'sequence'    => 0,
                'parent_id'   => $mainCat->id,
                'method'      => 'POST',
            ]);
        \App\Model\Admin\Menu::updateOrCreate(
            [
                'slug'      => 'export',
                'routeName' => "$main.exportOrders",
            ],
            [
                'icon'        => 'fas fa-',
                'displayName' => 'Export Orders',
                'action'      => '\App\Plugins\Orders\OrderController@exportOrders',
                'inMenu'      => '0',
                'sequence'    => 0,
                'parent_id'   => $mainCat->id,
                'method'      => 'POST',
            ]);

        \App\Model\Admin\Menu::updateOrCreate(
            [
                'slug'      => 'send',
                'routeName' => "$main.sendEmails",
            ],
            [
                'icon'        => 'fas fa-envelope',
                'displayName' => 'Send Emails to suppliers',
                'action'      => '\App\Plugins\Orders\OrderController@doSendEmails',
                'inMenu'      => '0',
                'sequence'    => 0,
                'parent_id'   => $mainCat->id,
                'method'      => 'POST',
            ]);

        \App\Model\Admin\Menu::updateOrCreate(
            [
                'slug'      => 'updateOrderField',
                'routeName' => "$main.updateOrderField",
            ],
            [
                'icon'        => 'fas fa-envelope',
                'displayName' => 'Update text fields',
                'action'      => '\App\Plugins\Orders\OrderController@updateField',
                'inMenu'      => '0',
                'sequence'    => 0,
                'parent_id'   => $viewCat->id,
                'method'      => 'POST',
            ]);

        \App\Model\Admin\Menu::updateOrCreate(
            [
                'slug'      => 'summaryExport',
                'routeName' => "$main.summary",
            ],
            [
                'icon'        => 'fas fa-book',
                'displayName' => 'Create order summary',
                'action'      => '\App\Plugins\Orders\OrderController@createSummary',
                'inMenu'      => '0',
                'sequence'    => 0,
                'parent_id'   => $mainCat->id,
                'method'      => 'POST',
            ]);

        \App\Model\Admin\Menu::updateOrCreate(
            [
                'slug'      => 'changeDelivery/{id}',
                'routeName' => "$main.changeDelivery",
            ],
            [
                'icon'        => 'fas fa-',
                'displayName' => 'Change Order Delivery',
                'action'      => '\App\Plugins\Orders\OrderController@changeDelivery',
                'inMenu'      => '0',
                'sequence'    => 0,
                'parent_id'   => $mainCat->id,
                'method'      => 'POST',
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
