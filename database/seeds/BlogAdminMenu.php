<?php

use Illuminate\Database\Seeder;

class BlogAdminMenu extends Seeder
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

        $main = "blog";

        // Blog Posts
        $mainCat = \App\Model\Admin\Menu::updateOrCreate(
            [
                'slug'      => $main,
                'routeName' => $main,
            ],
            [
                'icon'        => 'fas fa-list',
                'displayName' => 'Blog',
                'action'      => '',
                'inMenu'      => '1',
                'sequence'    => 0,
                'parent_id'   => $mainMenu->id,
                'method'      => 'GET',
            ]);


        \App\Model\Admin\Menu::updateOrCreate(
            [
                'slug'      => 'add',
                'routeName' => $main.".add",
            ],
            [
                'icon'        => 'fas fa-plus',
                'displayName' => 'Add Post',
                'action'      => '\App\Plugins\Blog\BlogController@addPosts',
                'inMenu'      => '1',
                'sequence'    => 0,
                'parent_id'   => $mainCat->id,
                'method'      => 'GET',
            ]);
        \App\Model\Admin\Menu::updateOrCreate(
            [
                'slug'      => 'edit/{id}',
                'routeName' => $main.".edit",
            ],
            [
                'icon'        => 'fas fa-edit',
                'displayName' => 'Edit',
                'action'      => '\App\Plugins\Blog\BlogController@editPosts',
                'inMenu'      => '0',
                'sequence'    => 0,
                'parent_id'   => $mainCat->id,
                'method'      => 'GET',
            ]);
        \App\Model\Admin\Menu::updateOrCreate(
            [
                'slug'      => 'posts',
                'routeName' => $main.".list",
            ],
            [
                'icon'        => 'fas fa-list',
                'displayName' => 'List Posts',
                'action'      => '\App\Plugins\Blog\BlogController@indexPosts',
                'inMenu'      => '1',
                'sequence'    => 1,
                'parent_id'   => $mainCat->id,
                'method'      => 'GET',
            ]);
        \App\Model\Admin\Menu::updateOrCreate(
            [
                'routeName' => "$main.store",
            ],
            [
                'slug'      => "store/{id?}",
                'icon'        => 'fas fa-plus',
                'displayName' => 'Store',
                'action'      => '\App\Plugins\Blog\BlogController@storePosts',
                'inMenu'      => '0',
                'sequence'    => 0,
                'parent_id'   => $mainCat->id,
                'method'      => 'POST',
            ]);
        \App\Model\Admin\Menu::updateOrCreate(
            [
                'routeName' => "$main.destroy",
            ],
            [
                'slug'      => "destroy/{id}",
                'icon'        => 'fas fa-plus',
                'displayName' => 'Delete',
                'action'      => '\App\Plugins\Blog\BlogController@destroyPost',
                'inMenu'      => '0',
                'sequence'    => 0,
                'parent_id'   => $mainCat->id,
                'method'      => 'POST',
            ]);


        // Blog Categories
        $catCat = \App\Model\Admin\Menu::updateOrCreate(
            [
                'slug'      => 'categories',
                'routeName' => $main.".categories.list",
            ],
            [
                'icon'        => 'fas fa-list',
                'displayName' => 'List Categories',
                'action'      => '\App\Plugins\Blog\BlogController@indexCategories',
                'inMenu'      => '1',
                'sequence'    => 4,
                'parent_id'   => $mainCat->id,
                'method'      => 'GET',
            ]);
        \App\Model\Admin\Menu::updateOrCreate(
            [
                'routeName' => $main.".categories.add",
            ],
            [
                'slug'      => 'add',
                'icon'        => 'fas fa-plus',
                'displayName' => 'Add Category',
                'action'      => '\App\Plugins\Blog\BlogController@addCategories',
                'inMenu'      => '0',
                'sequence'    => 3,
                'parent_id'   => $catCat->id,
                'method'      => 'GET',
            ]);
        \App\Model\Admin\Menu::updateOrCreate(
            [
                'slug'      => 'edit/{id}',
                'routeName' => $main.".categories.edit",
            ],
            [
                'icon'        => 'fas fa-edit',
                'displayName' => 'Edit',
                'action'      => '\App\Plugins\Blog\BlogController@editCategories',
                'inMenu'      => '0',
                'sequence'    => 4,
                'parent_id'   => $catCat->id,
                'method'      => 'GET',
            ]);
        \App\Model\Admin\Menu::updateOrCreate(
            [
                'routeName' => "$main.categories.store",
            ],
            [
                'slug'      => "store/{id?}",
                'icon'        => 'fas fa-plus',
                'displayName' => 'Store',
                'action'      => '\App\Plugins\Blog\BlogController@storeCategories',
                'inMenu'      => '0',
                'sequence'    => 0,
                'parent_id'   => $catCat->id,
                'method'      => 'POST',
            ]);
        \App\Model\Admin\Menu::updateOrCreate(
            [
                'routeName' => "$main.categories.destroy",
            ],
            [
                'slug'      => "destroy/{id}",
                'icon'        => 'fas fa-plus',
                'displayName' => 'Delete',
                'action'      => '\App\Plugins\Blog\BlogController@destroyCategory',
                'inMenu'      => '0',
                'sequence'    => 0,
                'parent_id'   => $catCat->id,
                'method'      => 'POST',
            ]);
    }
}
