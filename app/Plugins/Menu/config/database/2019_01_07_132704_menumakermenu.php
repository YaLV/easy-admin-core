<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Menumakermenu extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Create Menus/Routes
        $menu = new \App\Model\Admin\Menu;

        $currentMenu = \App\Model\Admin\Menu::orderBy('sequence', 'desc')->first();

        $menu->fill([
            'routeName'   => 'menus',
            'slug'        => 'menu',
            'icon'        => 'fas fa-list',
            'displayName' => 'Menu',
            'action'      => '\App\Plugins\Menu\MenuAdminController@index',
            'inMenu'      => '1',
            'sequence'    => $currentMenu->last,
            'parent_id'   => null,
            'method'      => 'GET',
        ]);
        $menu->save();

        $id = $menu->id;

        $menu = new \App\Model\Admin\Menu;
        $menu->fill([
            'routeName'   => 'menus.edit',
            'slug'        => 'edit',
            'icon'        => 'fas fa-edit',
            'displayName' => 'Edit',
            'action'      => '\App\Plugins\Menu\MenuAdminController@edit',
            'inMenu'      => '0',
            'sequence'    => 0,
            'parent_id'   => $id,
            'method'      => 'GET',
        ]);
        $menu->save();

        $menu = new \App\Model\Admin\Menu;
        $menu->fill([
            'routeName'   => 'menus.add',
            'slug'        => 'new',
            'icon'        => 'fas fa-plus',
            'displayName' => 'Add',
            'action'      => '\App\Plugins\Menu\MenuAdminController@add',
            'inMenu'      => '0',
            'sequence'    => 0,
            'parent_id'   => $id,
            'method'      => 'GET',
        ]);
        $menu->save();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        \App\Model\Admin\Menu::where('routeName', 'like', 'menus%')->delete();
    }
}
