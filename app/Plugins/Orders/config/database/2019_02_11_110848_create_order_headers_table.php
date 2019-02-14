<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderHeadersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_headers', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->integer('market_day_id');
            $table->timestamp('market_day_date');
            $table->enum("state", ["draft", "ordered", "accepted", "finished"])->default('draft');
            $table->string('discount_code');
            $table->enum('discount_target', ['product', 'delivery', 'all']);
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
        Schema::dropIfExists('order_headers');
    }
}
