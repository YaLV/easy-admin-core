<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AttributesAttributeValue extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attribute_attribute_value', function (Blueprint $table) {
            $table->integer('attribute_id');
            $table->integer('attribute_value_id');
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
        Schema::dropIfExists('attribute_attribute_value');
    }
}
