<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDeliveryMetasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('delivery_metas', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('owner_id')->references('id')->on('deliveries')->onDelete('cascade');
            $table->string('owner')->default('delivery');
            $table->string('meta_name');
            $table->text('meta_value');
            $table->string('language');
            $table->timestamps();

            $table->unique(['owner_id', 'language', 'meta_name']);
        });

        Artisan::call('db:seed', ["--class" => 'DeliveriesAdminMenu']);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('delivery_metas');
    }
}
