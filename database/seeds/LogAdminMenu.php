<?php

use Illuminate\Database\Seeder;

class LogAdminMenu extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $menu = \App\Model\Admin\Menu::updateOrCreate(
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

        $main = 'logs';

        $languages = \App\Model\Admin\Menu::updateOrCreate(
            [
                'slug'      => "$main/{types?}",
                'routeName' => $main,
            ],
            [
                'icon'        => 'fas fa-flag',
                'displayName' => 'Log',
                'action'      => '\App\Plugins\Log\LogController@index',
                'inMenu'      => '1',
                'sequence'    => $lastSeq,
                'parent_id'   => $menu->id,
                'method'      => 'GET',
            ]);
    }
}
