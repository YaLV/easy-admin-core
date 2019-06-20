<?php

use Illuminate\Database\Seeder;

class AttributeAdminMenu extends Seeder
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

        $main = "attributes";

        $mainCat = \App\Model\Admin\Menu::updateOrCreate(
            [
                'slug'      => $main,
                'routeName' => $main,
            ],
            [
                'icon'        => 'fas fa-filter',
                'displayName' => 'Attributes',
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
                'action'      => '\App\Plugins\Attributes\AttributeController@index',
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
                'action'      => '\App\Plugins\Attributes\AttributeController@add',
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
                'action'      => '\App\Plugins\Attributes\AttributeController@edit',
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
                'action'      => '\App\Plugins\Attributes\AttributeController@store',
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
                'action'      => '\App\Plugins\Attributes\AttributeController@destroy',
                'inMenu'      => '0',
                'sequence'    => 0,
                'parent_id'   => $mainCat->id,
                'method'      => 'POST',
            ]);

        \App\Model\Admin\Menu::updateOrCreate(
            [
                'slug'      => "value/store/{id?}",
                'routeName' => "$main.value.store",
            ],
            [
                'icon'        => 'fas fa-plus',
                'displayName' => 'Add Value',
                'action'      => '\App\Plugins\Attributes\AttributeController@storeAttributeValue',
                'inMenu'      => '0',
                'sequence'    => 0,
                'parent_id'   => $mainCat->id,
                'method'      => 'POST',
            ]
        );

        \App\Model\Admin\Menu::updateOrCreate(
            [
                'slug'      => "value/load/{id?}",
                'routeName' => "$main.value.load",
            ],
            [
                'icon'        => 'fas fa-plus',
                'displayName' => 'Add Value',
                'action'      => '\App\Plugins\Attributes\AttributeController@loadAttributeValue',
                'inMenu'      => '0',
                'sequence'    => 0,
                'parent_id'   => $mainCat->id,
                'method'      => 'POST',
            ]
        );
    }
}
