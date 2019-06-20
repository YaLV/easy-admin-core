<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->decimal('amount', 8, 2);
            $table->text('discount_to');
            $table->text('discount_target');
            $table->text('user_group');
            $table->date('valid_from');
            $table->date('valid_to');
            $table->timestamps();
        });

        \Illuminate\Support\Facades\Artisan::call('db:seed', ['--class' => 'SalesAdminMenu']);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sales');
    }
}
