<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModifyHeaders extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('order_headers', function (Blueprint $table) {
            $table->string('address')->nullable();
            $table->string('city')->nullable();
            $table->string('postcode')->nullable();
        });
        DB::statement("ALTER TABLE  `order_headers` CHANGE  `paid`  `paid` DECIMAL( 8, 2 ) NULL DEFAULT  '0';");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('order_headers', function (Blueprint $table) {
            $table->dropColumn('address');
            $table->dropColumn('city');
            $table->dropColumn('postcode');
        });
        DB::statement("ALTER TABLE  `order_headers` CHANGE  `paid`  `paid` DECIMAL( 8, 2 ) NULL;");
    }
}
