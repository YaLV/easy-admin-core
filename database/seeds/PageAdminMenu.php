<?php

use Illuminate\Database\Seeder;

class PageAdminMenu extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $currentMenu = \App\Model\Admin\Menu::where('slug', '!=', 'config')->orderBy('sequence', 'desc')->first();

        $mainMenu = \App\Model\Admin\Menu::firstOrCreate(
            [
                'slug'      => 'content',
                'routeName' => 'content',
            ],
            [
                'icon'        => 'far fa-newspaper',
                'displayName' => 'Web Content',
                'action'      => '',
                'inMenu'      => '1',
                'sequence'    => $currentMenu->last,
                'parent_id'   => null,
                'method'      => 'GET',
            ]);

        $main = "pages";

        $mainCat = \App\Model\Admin\Menu::firstOrCreate(
            [
                'slug'      => $main,
                'routeName' => $main,
            ],
            [
                'icon'        => 'fas fa-filter',
                'displayName' => 'Pages',
                'action'      => '',
                'inMenu'      => '1',
                'sequence'    => 0,
                'parent_id'   => $mainMenu->id,
                'method'      => 'GET',
            ]);

        \App\Model\Admin\Menu::firstOrCreate(
            [
                'slug'      => "list",
                'routeName' => "$main.list",
            ],
            [
                'icon'        => 'fas fa-list',
                'displayName' => 'List',
                'action'      => '\App\Plugins\Pages\PageController@index',
                'inMenu'      => '1',
                'sequence'    => 0,
                'parent_id'   => $mainCat->id,
                'method'      => 'GET',
            ]);
        \App\Model\Admin\Menu::firstOrCreate(
            [
                'slug'      => "add",
                'routeName' => "$main.add",
            ],
            [
                'icon'        => 'fas fa-plus',
                'displayName' => 'Add',
                'action'      => '\App\Plugins\Pages\PageController@add',
                'inMenu'      => '1',
                'sequence'    => 1,
                'parent_id'   => $mainCat->id,
                'method'      => 'GET',
            ]);
        \App\Model\Admin\Menu::firstOrCreate(
            [
                'slug'      => "edit/{id}",
                'routeName' => "$main.edit",
            ],
            [
                'icon'        => 'fas fa-edit',
                'displayName' => 'Edit',
                'action'      => '\App\Plugins\Pages\PageController@edit',
                'inMenu'      => '0',
                'sequence'    => 0,
                'parent_id'   => $mainCat->id,
                'method'      => 'GET',
            ]);
        \App\Model\Admin\Menu::firstOrCreate(
            [
                'slug'      => "store/{id?}",
                'routeName' => "$main.store",
            ],
            [
                'icon'        => 'fas fa-plus',
                'displayName' => 'Store',
                'action'      => '\App\Plugins\Pages\PageController@store',
                'inMenu'      => '0',
                'sequence'    => 0,
                'parent_id'   => $mainCat->id,
                'method'      => 'POST',
            ]);
        \App\Model\Admin\Menu::firstOrCreate(
            [
                'slug'      => "destroy/{id}",
                'routeName' => "$main.destroy",
            ],
            [
                'icon'        => 'fas fa-trash-alt',
                'displayName' => 'Destroy',
                'action'      => '\App\Plugins\Pages\PageController@destroy',
                'inMenu'      => '0',
                'sequence'    => 0,
                'parent_id'   => $mainCat->id,
                'method'      => 'POST',
            ]);

        \App\Model\Admin\Menu::firstOrCreate(
            [
                'slug'      => "state/{id?}",
                'routeName' => "$main.state",
            ],
            [
                'icon'        => 'fas fa-plus',
                'displayName' => 'State',
                'action'      => '\App\Plugins\Pages\PageController@changeState',
                'inMenu'      => '0',
                'sequence'    => 0,
                'parent_id'   => $mainCat->id,
                'method'      => 'POST',
            ]
        );

        \App\Model\Admin\Menu::firstOrCreate(
            [
                'slug'      => "view/{id?}",
                'routeName' => "$main.view",
            ],
            [
                'icon'        => 'fas fa-folder-open',
                'displayName' => 'View',
                'action'      => '\App\Plugins\Pages\PageController@view',
                'inMenu'      => '0',
                'sequence'    => 0,
                'parent_id'   => $mainCat->id,
                'method'      => 'GET',
            ]
        );

        $main = "components";

        $mainCat = \App\Model\Admin\Menu::firstOrCreate(
            [
                'slug'      => "components/{page}",
                'routeName' => "$main",
            ],
            [
                'icon'        => 'fas fa-list',
                'displayName' => 'Components',
                'action'      => '\App\Plugins\Pages\ComponentController@index',
                'inMenu'      => '0',
                'sequence'    => 0,
                'parent_id'   => $mainCat->id,
                'method'      => 'GET',
            ]
        );

        \App\Model\Admin\Menu::firstOrCreate(
            [
                'slug'      => "edit/{id}",
                'routeName' => "$main.edit",
            ],
            [
                'icon'        => 'fas fa-edit',
                'displayName' => 'Edit:',
                'action'      => '\App\Plugins\Pages\ComponentController@edit',
                'inMenu'      => '0',
                'sequence'    => 0,
                'parent_id'   => $mainCat->id,
                'method'      => 'GET',
            ]
        );

        \App\Model\Admin\Menu::firstOrCreate(
            [
                'slug'      => "store/{id?}",
                'routeName' => "$main.store",
            ],
            [
                'icon'        => 'fas fa-edit',
                'displayName' => 'Store',
                'action'      => '\App\Plugins\Pages\ComponentController@store',
                'inMenu'      => '0',
                'sequence'    => 0,
                'parent_id'   => $mainCat->id,
                'method'      => 'post',
            ]
        );

        \App\Model\Admin\Menu::firstOrCreate(
            [
                'slug'      => "sort",
                'routeName' => "$main.sort",
            ],
            [
                'icon'        => 'fas fa-edit',
                'displayName' => 'SetOrder',
                'action'      => '\App\Plugins\Pages\ComponentController@setOrder',
                'inMenu'      => '0',
                'sequence'    => 0,
                'parent_id'   => $mainCat->id,
                'method'      => 'post',
            ]
        );

        \App\Model\Admin\Menu::firstOrCreate(
            [
                'slug'      => "add",
                'routeName' => "$main.add",
            ],
            [
                'icon'        => 'fas fa-edit',
                'displayName' => 'Add',
                'action'      => '\App\Plugins\Pages\ComponentController@add',
                'inMenu'      => '0',
                'sequence'    => 0,
                'parent_id'   => $mainCat->id,
                'method'      => 'get',
            ]
        );

        \App\Model\Admin\Menu::firstOrCreate(
            [
                'slug'      => "destroy/{id}",
                'routeName' => "$main.destroy",
            ],
            [
                'icon'        => 'fas fa-trash-alt',
                'displayName' => 'Destroy',
                'action'      => '\App\Plugins\Pages\ComponentController@destroy',
                'inMenu'      => '0',
                'sequence'    => 0,
                'parent_id'   => $mainCat->id,
                'method'      => 'POST',
            ]);
    }
}
