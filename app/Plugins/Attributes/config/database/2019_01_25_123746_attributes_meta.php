<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AttributesMeta extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attribute_metas', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('owner_id')->references('id')->on('categories')->onDelete('cascade');
            $table->string('owner')->default('attributes');
            $table->string('meta_name');
            $table->text('meta_value');
            $table->string('language');
            $table->timestamps();

            $table->unique(['owner_id', 'language', 'meta_name']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('attribute_metas');
    }
}
