<?php

use Illuminate\Database\Seeder;

class BannerAdminMenu extends Seeder
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

        $main = "banners";

        // Blog Posts
        $mainCat = \App\Model\Admin\Menu::updateOrCreate(
            [
                'slug'      => $main,
                'routeName' => $main,
            ],
            [
                'icon'        => 'fas fa-image',
                'displayName' => 'Banners',
                'action'      => '',
                'inMenu'      => '1',
                'sequence'    => 0,
                'parent_id'   => $mainMenu->id,
                'method'      => 'GET',
            ]);

        \App\Model\Admin\Menu::updateOrCreate(
            [
                'routeName' => "$main.list",
            ],
            [
                'slug'      => 'list',
                'icon'        => 'fas fa-list',
                'displayName' => 'List Banners',
                'action'      => '\App\Plugins\Banners\BannerController@index',
                'inMenu'      => '1',
                'sequence'    => 0,
                'parent_id'   => $mainCat->id,
                'method'      => 'GET',
            ]);

        \App\Model\Admin\Menu::updateOrCreate(
            [
                'routeName' => "$main.addPopup",
            ],
            [
                'slug'      => 'add/popup',
                'icon'        => 'fas fa-plus',
                'displayName' => 'Add Popup Banner',
                'action'      => '\App\Plugins\Banners\BannerController@addPopup',
                'inMenu'      => '1',
                'sequence'    => 1,
                'parent_id'   => $mainCat->id,
                'method'      => 'GET',
            ]);

        \App\Model\Admin\Menu::updateOrCreate(
            [
                'routeName' => "$main.addMessage",
            ],
            [
                'slug'      => 'add/message',
                'icon'        => 'fas fa-plus',
                'displayName' => 'Add Message',
                'action'      => '\App\Plugins\Banners\BannerController@addMessage',
                'inMenu'      => '1',
                'sequence'    => 2,
                'parent_id'   => $mainCat->id,
                'method'      => 'GET',
            ]);

        \App\Model\Admin\Menu::updateOrCreate(
            [
                'routeName' => "$main.store",
            ],
            [
                'slug'      => 'store/{id?}',
                'icon'        => 'fas fa-plus',
                'displayName' => 'Store Banner',
                'action'      => '\App\Plugins\Banners\BannerController@store',
                'inMenu'      => '0',
                'sequence'    => 1,
                'parent_id'   => $mainCat->id,
                'method'      => 'POST',
            ]);
        \App\Model\Admin\Menu::updateOrCreate(
            [
                'routeName' => "$main.edit",
            ],
            [
                'slug'      => 'edit/{id}',
                'icon'        => 'fas fa-plus',
                'displayName' => 'Edit',
                'action'      => '\App\Plugins\Banners\BannerController@edit',
                'inMenu'      => '0',
                'sequence'    => 2,
                'parent_id'   => $mainCat->id,
                'method'      => 'GET',
            ]);
        \App\Model\Admin\Menu::updateOrCreate(
            [
                'routeName' => "$main.destroy",
            ],
            [
                'slug'      => 'destroy/{banner}',
                'icon'        => 'fas fa-trash',
                'displayName' => 'Delete Banner',
                'action'      => '\App\Plugins\Banners\BannerController@destroy',
                'inMenu'      => '0',
                'sequence'    => 1,
                'parent_id'   => $mainCat->id,
                'method'      => 'POST',
            ]);

    }
}
