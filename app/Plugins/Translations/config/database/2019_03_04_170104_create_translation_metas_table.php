<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTranslationMetasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('translation_metas', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('owner_id')->references('id')->on('translations')->onDelete('cascade');
            $table->string('owner')->default('translations');
            $table->string('meta_name');
            $table->text('meta_value');
            $table->string('language');
            $table->timestamps();

            $table->unique(['owner_id', 'language', 'meta_name']);
        });

        \Illuminate\Support\Facades\Artisan::call("db:seed", ["--class" => 'TranslationAdminMenu']);

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('translation_metas');
    }
}
