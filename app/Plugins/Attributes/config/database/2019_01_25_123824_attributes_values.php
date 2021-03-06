<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AttributesValues extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attribute_values', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('attribute_id')->nullable();
            $table->timestamps();
        });

        \Illuminate\Support\Facades\Artisan::call('db:seed', ['--class' => 'AttributeAdminMenu']);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('attribute_values');
    }
}
