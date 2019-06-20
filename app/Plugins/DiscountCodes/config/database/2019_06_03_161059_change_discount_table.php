<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeDiscountTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('discount_codes', function (Blueprint $table) {
            $table->dropColumn('applied');
        });

        Schema::table('discount_codes', function (Blueprint $table) {
            $table->enum('applied', ['category', 'product', 'delivery']);
            $table->text('items')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('discount_codes', function (Blueprint $table) {
            $table->dropColumn('applied');
            $table->dropColumn('items');
        });

        Schema::table('discount_codes', function (Blueprint $table) {
            $table->enum('applied', ['all', 'product', 'delivery']);
        });
    }
}


