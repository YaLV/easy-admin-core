<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Frontendmenuitems extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('frontend_menu_items', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('frontend_menu_id')->references('id')->on('frontent_menus');
            $table->string('menu_owner');
            $table->text('owner_id');
            $table->integer('sequence');
            $table->integer('frontend_menu_item_id')->nullable();
            $table->timestamps();
            $table->unique(['id', 'sequence']);
        });

        \Illuminate\Support\Facades\Artisan::call("db:seed", ["--class" => "MenuBuilderAdminMenu"]);
        \Illuminate\Support\Facades\Artisan::call("db:seed", ["--class" => "DefaultMenus"]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('frontend_menu_items');
    }
}
