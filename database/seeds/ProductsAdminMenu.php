<?php

use Illuminate\Database\Seeder;

class ProductsAdminMenu extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $currentMenu = \App\Model\Admin\Menu::where('slug','!=','config')->orderBy('sequence', 'desc')->first();

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

        $main = "products";

        $mainCat = \App\Model\Admin\Menu::updateOrCreate(
            [
                'slug'      => $main,
                'routeName' => $main,
            ],
            [
                'icon'        => 'fas fa-database',
                'displayName' => 'Products',
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
                'action'      => '\App\Plugins\Products\ProductController@index',
                'inMenu'      => '1',
                'sequence'    => 0,
                'parent_id'   => $mainCat->id,
                'method'      => 'GET',
            ]);
        \App\Model\Admin\Menu::updateOrCreate(
            [
                'slug'      => "search/{search?}",
                'routeName' => "$main.search",
            ],
            [
                'icon'        => 'fas fa-list',
                'displayName' => 'Search',
                'action'      => '\App\Plugins\Products\ProductController@index',
                'inMenu'      => '0',
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
                'action'      => '\App\Plugins\Products\ProductController@add',
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
                'action'      => '\App\Plugins\Products\ProductController@edit',
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
                'action'      => '\App\Plugins\Products\ProductController@store',
                'inMenu'      => '0',
                'sequence'    => 0,
                'parent_id'   => $mainCat->id,
                'method'      => 'POST',
            ]);

        \App\Model\Admin\Menu::updateOrCreate(
            [
                'slug'      => "export",
                'routeName' => "$main.export",
            ],
            [
                'icon'        => 'fas fa-download',
                'displayName' => 'Export',
                'action'      => '\App\Plugins\Products\ProductController@export',
                'inMenu'      => '0',
                'sequence'    => 0,
                'parent_id'   => $mainCat->id,
                'method'      => 'GET',
            ]);
        \App\Model\Admin\Menu::updateOrCreate(
            [
                'slug'      => "import",
                'routeName' => "$main.import",
            ],
            [
                'icon'        => 'fas fa-upload',
                'displayName' => 'Import',
                'action'      => '\App\Plugins\Products\ProductController@import',
                'inMenu'      => '0',
                'sequence'    => 0,
                'parent_id'   => $mainCat->id,
                'method'      => 'POST',
            ]);

        \App\Model\Admin\Menu::updateOrCreate(
            [
                'slug'      => "state/{id}",
                'routeName' => "$main.state",
            ],
            [
                'icon'        => 'fas fa-eye',
                'displayName' => 'State',
                'action'      => '\App\Plugins\Products\ProductController@state',
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
                'action'      => '\App\Plugins\Products\ProductController@destroy',
                'inMenu'      => '0',
                'sequence'    => 0,
                'parent_id'   => $mainCat->id,
                'method'      => 'POST',
            ]);
        \App\Model\Admin\Menu::updateOrCreate(
            [
                'slug'      => "calc",
                'routeName' => "$main.calc",
            ],
            [
                'icon'        => 'fas fa-calculator',
                'displayName' => 'Calculate Price',
                'action'      => '\App\Plugins\Products\ProductController@calculatePrice',
                'inMenu'      => '0',
                'sequence'    => 0,
                'parent_id'   => $mainCat->id,
                'method'      => 'POST',
            ]);
        \App\Model\Admin\Menu::updateOrCreate(
            [
                'slug'      => "makeDisplay",
                'routeName' => "$main.makedisplay",
            ],
            [
                'icon'        => 'fas fa-calculator',
                'displayName' => 'Make Display String',
                'action'      => '\App\Plugins\Products\ProductController@makeDisplayString',
                'inMenu'      => '0',
                'sequence'    => 0,
                'parent_id'   => $mainCat->id,
                'method'      => 'POST',
            ]);

        \App\Model\Admin\Menu::updateOrCreate(
            [
                'slug'      => "variations/load",
                'routeName' => "$main.variations.load",
            ],
            [
                'icon'        => 'fas fa-calculator',
                'displayName' => 'Load variation',
                'action'      => '\App\Plugins\Products\ProductController@makeDisplayString',
                'inMenu'      => '0',
                'sequence'    => 0,
                'parent_id'   => $mainCat->id,
                'method'      => 'POST',
            ]);
        \App\Model\Admin\Menu::updateOrCreate(
            [
                'slug'      => "variations/store",
                'routeName' => "$main.variations.store",
            ],
            [
                'icon'        => 'fas fa-calculator',
                'displayName' => 'Store variation',
                'action'      => '\App\Plugins\Products\ProductController@storeVariation',
                'inMenu'      => '0',
                'sequence'    => 0,
                'parent_id'   => $mainCat->id,
                'method'      => 'POST',
            ]);
        \App\Model\Admin\Menu::updateOrCreate(
            [
                'slug'      => "attributes/load",
                'routeName' => "$main.attributes.load",
            ],
            [
                'icon'        => 'fas fa-edit',
                'displayName' => 'Load product attribute Values',
                'action'      => '\App\Plugins\Products\ProductController@getAttributes',
                'inMenu'      => '0',
                'sequence'    => 0,
                'parent_id'   => $mainCat->id,
                'method'      => 'POST',
            ]);
        \App\Model\Admin\Menu::updateOrCreate(
            [
                'slug'      => "attributes/format",
                'routeName' => "$main.attributes.format",
            ],
            [
                'icon'        => 'fas fa-edit',
                'displayName' => 'Load product attribute Values',
                'action'      => '\App\Plugins\Products\ProductController@formatAttributes',
                'inMenu'      => '0',
                'sequence'    => 0,
                'parent_id'   => $mainCat->id,
                'method'      => 'POST',
            ]);
    }
}
