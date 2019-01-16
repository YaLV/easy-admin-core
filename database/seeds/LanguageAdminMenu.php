<?php

use Illuminate\Database\Seeder;

class LanguageAdminMenu extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $menu = \App\Model\Admin\Menu::firstOrCreate(
            [
                'slug'      => 'config',
                'routeName' => 'config',
            ],
            [
                'icon'        => 'fas fa-cogs',
                'displayName' => 'Configurations',
                'action'      => '',
                'inMenu'      => '1',
                'sequence'    => 99,
                'parent_id'   => null,
                'method'      => 'GET',
            ]);

        $lastSeq = \App\Model\Admin\Menu::where('parent_id', $menu->id)->orderBy('sequence', 'DESC')->first()->sequence ?? 0;

        $lastSeq++;

        $main = 'languages';

        $languages = \App\Model\Admin\Menu::firstOrCreate(
            [
                'slug'      => $main,
                'routeName' => $main,
            ],
            [
                'icon'        => 'fas fa-flag',
                'displayName' => 'Languages',
                'action'      => '\App\Plugins\Languages\LanguageController@index',
                'inMenu'      => '1',
                'sequence'    => $lastSeq,
                'parent_id'   => $menu->id,
                'method'      => 'GET',
            ]);

        $lastSeq++;
        \App\Model\Admin\Menu::firstOrCreate(
            [
                'slug'      => "edit/{id}",
                'routeName' => "$main.edit",
            ],
            [
                'icon'        => 'fas fa-edit',
                'displayName' => 'Edit',
                'action'      => '\App\Plugins\Languages\LanguageController@editLanguage',
                'inMenu'      => '0',
                'sequence'    => $lastSeq,
                'parent_id'   => $languages->id,
                'method'      => 'GET',
            ]);

        $lastSeq++;
        \App\Model\Admin\Menu::firstOrCreate(
            [
                'slug'      => "add",
                'routeName' => "$main.add",
            ],
            [
                'icon'        => 'fas fa-plus',
                'displayName' => 'Add',
                'action'      => '\App\Plugins\Languages\LanguageController@addLanguage',
                'inMenu'      => '0',
                'sequence'    => $lastSeq,
                'parent_id'   => $languages->id,
                'method'      => 'GET',
            ]);

        $lastSeq++;
        \App\Model\Admin\Menu::firstOrCreate(
            [
                'slug'      => "store/{id?}",
                'routeName' => "$main.store",
            ],
            [
                'icon'        => 'fas fa-edit',
                'displayName' => 'Save',
                'action'      => '\App\Plugins\Languages\LanguageController@storeLanguage',
                'inMenu'      => '0',
                'sequence'    => $lastSeq,
                'parent_id'   => $languages->id,
                'method'      => 'POST',
            ]);
        $lastSeq++;
        \App\Model\Admin\Menu::firstOrCreate(
            [
                'slug'      => "destroy/{id?}",
                'routeName' => "$main.destroy",
            ],
            [
                'icon'        => 'fas fa-trash-alt',
                'displayName' => 'Delete',
                'action'      => '\App\Plugins\Languages\LanguageController@destroyLanguage',
                'inMenu'      => '0',
                'sequence'    => $lastSeq,
                'parent_id'   => $languages->id,
                'method'      => 'POST',
            ]);
    }
}
