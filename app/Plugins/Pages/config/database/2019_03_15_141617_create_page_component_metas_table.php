<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePageComponentMetasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('page_component_metas', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('owner_id')->references('id')->on('page_components')->onDelete('cascade');
            $table->string('owner')->default('page_components');
            $table->string('meta_name');
            $table->text('meta_value');
            $table->string('language');
            $table->timestamps();
        });
        Artisan::call('db:seed', ["--class" => 'PageAdminMenu']);

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('page_component_metas');
    }
}
