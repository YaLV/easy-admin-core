<?php

use Illuminate\Database\Seeder;

class TranslationAdminMenu extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $currentMenu = \App\Model\Admin\Menu::orderBy('sequence', 'desc')->first();

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

        $main = "translations";

        $mainCat = \App\Model\Admin\Menu::updateOrCreate(
            [
                'slug'      => $main,
                'routeName' => $main,
            ],
            [
                'icon'        => 'far fa-flag',
                'displayName' => 'Translations',
                'action'      => '\App\Plugins\Translations\TranslationController@index',
                'inMenu'      => '1',
                'sequence'    => 0,
                'parent_id'   => $mainMenu->id,
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
                'action'      => '\App\Plugins\Translations\TranslationController@edit',
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
                'action'      => '\App\Plugins\Translations\TranslationController@store',
                'inMenu'      => '0',
                'sequence'    => 0,
                'parent_id'   => $mainCat->id,
                'method'      => 'POST',
            ]);
        \App\Model\Admin\Menu::updateOrCreate(
            [
                'slug'      => "find",
                'routeName' => "$main.add",
            ],
            [
                'icon'        => 'fas fa-search',
                'displayName' => 'Collect',
                'action'      => '\App\Plugins\Translations\TranslationController@collect',
                'inMenu'      => '0',
                'sequence'    => 0,
                'parent_id'   => $mainCat->id,
                'method'      => 'GET',
            ]);
        \App\Model\Admin\Menu::updateOrCreate(
            [
                'slug'      => "search:{id}",
                'routeName' => "$main.search",
            ],
            [
                'icon'        => 'fas fa-search',
                'displayName' => 'Search',
                'action'      => '\App\Plugins\Translations\TranslationController@search',
                'inMenu'      => '0',
                'sequence'    => 0,
                'parent_id'   => $mainCat->id,
                'method'      => 'GET',
            ]);
    }
}
