<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDiscountCodesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('discount_codes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('code');
            $table->integer('uses')->nullable();
            $table->decimal('amount', 8, 2);
            $table->enum('unit', ['amount', 'percent']);
            $table->enum('applied', ['all', 'product', 'delivery']);
            $table->date('valid_from')->nullable();
            $table->date('valid_to')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });

        Artisan::call('db:seed', ['--class' => 'DiscountCodesAdminMenu']);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('discount_codes');
    }
}
