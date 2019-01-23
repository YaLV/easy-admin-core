<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Products extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->string('sku')->unique();
            $table->integer('main_category');
            $table->boolean('state')->nullable();
            $table->boolean('is_bio')->nullable();
            $table->boolean('is_lv')->nullable();
            $table->boolean('is_suggested')->nullable();
            $table->boolean('is_highlighted')->nullable();
            $table->boolean('supplier');
            $table->integer('times_bought')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
