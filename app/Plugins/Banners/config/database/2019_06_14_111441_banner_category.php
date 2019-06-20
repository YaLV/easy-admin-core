<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class BannerCategory extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('banner_category', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('banner_id');
            $table->integer('category_id');
            $table->timestamps();
        });

        Artisan::call("db:seed", ['--class' => 'BannerAdminMenu']);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('banner_category');
    }
}
