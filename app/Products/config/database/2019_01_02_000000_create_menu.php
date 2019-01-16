<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMenu extends Migration
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
            'routeName'   => 'products',
            'slug'        => 'products',
            'icon'        => 'fab fa-product-hunt',
            'displayName' => 'Products',
            'action'      => '\App\Plugins\Products\ProductsController@index',
            'inMenu'      => '1',
            'sequence'    => $currentMenu->last,
            'parent_id'   => null,
            'method'      => 'GET',
        ]);
        $menu->save();

        $mainMenuId = $menu->id;

        \App\Model\Admin\Menu::insert([
                [ // List
                    'routeName'   => 'productsList',
                    'slug'        => 'list',
                    'icon'        => 'fas fa-list',
                    'displayName' => 'List',
                    'action'      => '\App\Plugins\Products\ProductsController@index',
                    'inMenu'      => '1',
                    'sequence'    => 0,
                    'parent_id'   => $mainMenuId,
                    'method'      => 'GET',
                    'created_at'  => \Carbon\Carbon::now(),
                    'updated_at'  => \Carbon\Carbon::now(),
                ],
                [ // New Product Form
                    'routeName'   => 'productsAdd',
                    'slug'        => 'add',
                    'icon'        => 'fas fa-plus-square',
                    'displayName' => 'Add',
                    'action'      => '\App\Plugins\Products\ProductsController@newProductForm',
                    'inMenu'      => '1',
                    'sequence'    => 1,
                    'parent_id'   => $mainMenuId,
                    'method'      => 'GET',
                    'created_at'  => \Carbon\Carbon::now(),
                    'updated_at'  => \Carbon\Carbon::now(),
                ],
            ]
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $mainMenu = \App\Model\Admin\Menu::where('routeName', 'products')->first();

        \App\Model\Admin\Menu::where('parent_id', $mainMenu->id)->delete();
        $mainMenu->delete();
    }
}
