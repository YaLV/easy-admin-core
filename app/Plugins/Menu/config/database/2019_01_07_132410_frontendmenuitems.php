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
            $table->text('urlSetup');
            $table->integer('sequence');
            $table->timestamps();
            $table->unique(['id', 'sequence']);
        });
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
