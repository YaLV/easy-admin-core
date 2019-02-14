<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderLinesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_lines', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('order_header_id');
            $table->integer('supplier_id');
            $table->string('supplier_name');
            $table->integer('product_id');
            $table->string('product_name');
            $table->integer('vat_id');
            $table->decimal('vat', 8, 2);
            $table->decimal('price', 8, 2);
            $table->decimal('vat_amount', 8, 2);
            $table->decimal('discount', 8, 2);
            $table->integer('amount');
            $table->string("display_name");
            $table->float("variation_size");
            $table->integer('variation_id');
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
        Schema::dropIfExists('order_lines');
    }
}
