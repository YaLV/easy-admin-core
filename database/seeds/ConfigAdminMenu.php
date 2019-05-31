<?php

use Illuminate\Database\Seeder;

class ConfigAdminMenu extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $currentMenu = \App\Model\Admin\Menu::orderBy('sequence', 'desc')->first();

        \App\Model\Admin\Menu::updateOrCreate(
            [
                'slug'      => 'config',
                'routeName' => 'config',
            ],
            [
                'icon'        => 'fas fa-cogs',
                'displayName' => 'Configurations',
                'action'      => '',
                'inMenu'      => '1',
                'sequence'    => $currentMenu->last,
                'parent_id'   => null,
                'method'      => 'GET',
            ]);
        \App\Model\Admin\Menu::updateOrCreate(
            [
                'slug'      => 'download/{direcotry}/{filename}',
                'routeName' => 'download',
            ],
            [
                'icon'        => 'fas fa-download',
                'displayName' => 'Download',
                'action'      => '\App\Plugins\Admin\AdminController@downloadFile',
                'inMenu'      => '0',
                'sequence'    => 0,
                'parent_id'   => null,
                'method'      => 'GET',
            ]);
    }
}
