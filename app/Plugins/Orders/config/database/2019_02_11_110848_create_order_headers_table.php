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
            $table->timestamp('market_day_date')->nullable();
            $table->enum("state", ["draft", "ordered", "accepted", "finished"])->default('draft');
            $table->string('discount_code')->nullable();
            $table->integer('discount_amount')->nullable();
            $table->enum('discount_target', ['product', 'delivery', 'all', 'none'])->nullable();
            $table->enum('discount_type', ['percent', 'amount'])->nullable();
            $table->integer('delivery_id')->nullable();
            $table->decimal('delivery_amount', 8, 2)->nullable();
            $table->string("comments")->nullable();
            $table->decimal('paid', 8, 2)->nullable();
            $table->string('invoice')->nullable();
            $table->enum('payment_type', ['money', 'invoice', 'card']);
            $table->string('address')->nullable();
            $table->string('city')->nullable();
            $table->string('postcode')->nullable();
            $table->timestamp('ordered_at')->nullable();
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
        Schema::dropIfExists('order_headers');
    }
}
