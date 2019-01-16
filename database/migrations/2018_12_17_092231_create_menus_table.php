<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMenusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menus', function (Blueprint $table) {
            $table->increments('id');
            $table->string('routeName')->unique();
            $table->string('slug');
            $table->string('icon');
            $table->string('displayName');
            $table->string('action');
            $table->boolean('inMenu')->default(true);
            $table->integer('sequence');
            $table->integer('parent_id')->nullable();
            $table->enum('method', ['PUT', 'DELETE', 'GET', 'POST']);
            $table->timestamps();

            $table->unique(["routeName", "slug"]);
        });

        $defaultMenus = [
            [
                'routeName'   => 'dashboard',
                'slug'        => '',
                'icon'        => 'fa fa-fw fa-user-circle',
                'displayName' => 'Dashboard',
                'action'      => 'AdminController@index',
                'inMenu'      => 1,
                'sequence'    => 0,
                'parent_id'   => null,
                'method'      => 'GET',
            ],
            [
                'routeName'   => 'uploadFile',
                'slug'        => 'uploadFile',
                'icon'        => 'fa fa-upload',
                'displayName' => 'Upload File',
                'action'      => '\App\Plugins\Admin\AdminController@uploadFile',
                'inMenu'      => 0,
                'sequence'    => 0,
                'parent_id'   => null,
                'method'      => 'POST',
            ],

        ];
        foreach($defaultMenus as $menu) {
            \App\Model\Admin\Menu::firstOrCreate($menu);
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('menus');
    }
}
