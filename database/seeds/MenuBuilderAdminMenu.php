<?php

use Illuminate\Database\Seeder;

class MenuBuilderAdminMenu extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $currentMenu = \App\Model\Admin\Menu::orderBy('sequence', 'desc')->first();

        $menu = \App\Model\Admin\Menu::firstOrCreate([
            'routeName'   => 'menus',
            'slug'        => 'menu',
            ],[
            'icon'        => 'fas fa-list',
            'displayName' => 'Menu',
            'action'      => '',
            'inMenu'      => '1',
            'sequence'    => $currentMenu->last,
            'parent_id'   => null,
            'method'      => 'GET',
        ]);

        \App\Model\Admin\Menu::firstOrCreate([
            'routeName'   => 'menus.edit',
            'slug'        => 'edit/{id?}',
        ],[
            'icon'        => 'fas fa-edit',
            'displayName' => 'Edit',
            'action'      => '\App\Plugins\Menu\MenuAdminController@edit',
            'inMenu'      => '0',
            'sequence'    => 0,
            'parent_id'   => $menu->id,
            'method'      => 'GET',
        ]);

        \App\Model\Admin\Menu::firstOrCreate([
            'routeName'   => 'menus.list',
            'slug'        => 'list',
        ],[
            'icon'        => 'fas fa-list',
            'displayName' => 'List',
            'action'      => '\App\Plugins\Menu\MenuAdminController@index',
            'inMenu'      => '1',
            'sequence'    => 1,
            'parent_id'   => $menu->id,
            'method'      => 'GET',
        ]);

        \App\Model\Admin\Menu::firstOrCreate([
            'routeName'   => 'menus.add',
            'slug'        => 'add',
        ],[
            'icon'        => 'fas fa-plus',
            'displayName' => 'Add',
            'action'      => '\App\Plugins\Menu\MenuAdminController@add',
            'inMenu'      => '1',
            'sequence'    => 2,
            'parent_id'   => $menu->id,
            'method'      => 'GET',
        ]);

        \App\Model\Admin\Menu::firstOrCreate([
            'routeName'   => 'menus.store',
            'slug'        => 'store/{id?}',
        ],[
            'icon'        => 'fas fa-plus',
            'displayName' => 'Store',
            'action'      => '\App\Plugins\Menu\MenuAdminController@store',
            'inMenu'      => '0',
            'sequence'    => 0,
            'parent_id'   => $menu->id,
            'method'      => 'POST',
        ]);

        \App\Model\Admin\Menu::firstOrCreate([
            'routeName'   => 'menus.store.item',
            'slug'        => 'store/item/{id}',
        ],[
            'icon'        => 'fas fa-plus',
            'displayName' => 'Store menu Item',
            'action'      => '\App\Plugins\Menu\MenuAdminController@storeMenuItem',
            'inMenu'      => '0',
            'sequence'    => 0,
            'parent_id'   => $menu->id,
            'method'      => 'POST',
        ]);

        \App\Model\Admin\Menu::firstOrCreate([
            'routeName'   => 'menus.destroy.item',
            'slug'        => 'destroy/item/{id}',
        ],[
            'icon'        => 'fas fa-plus',
            'displayName' => 'Destroy Menu Item',
            'action'      => '\App\Plugins\Menu\MenuAdminController@destroyMenuItem',
            'inMenu'      => '0',
            'sequence'    => 0,
            'parent_id'   => $menu->id,
            'method'      => 'POST',
        ]);
    }
}
