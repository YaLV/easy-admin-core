<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ExtraDataOrderlines extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('order_lines', function (Blueprint $table) {
            $table->decimal('price_raw', 8, 2);
            $table->decimal('vat_raw', 8, 2);
            $table->decimal('cost', 8, 2);
            $table->decimal('markup', 8, 2);
            $table->decimal('markup_amount', 8, 2);
        });

        Schema::table('order_headers', function (Blueprint $table) {
            $table->text('svaigi_comment_invoice')->nullable();
            $table->text('svaigi_comment_stats')->nullable();
            $table->text('discount_items')->nullable();
            $table->dropColumn('discount_target');
        });

        Schema::table('order_headers', function (Blueprint $table) {
            $table->enum('discount_target', ['product', 'delivery', 'category', 'none'])->nullable();
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('order_lines', function (Blueprint $table) {
            $table->dropColumn('price_raw');
            $table->dropColumn('vat_raw');
            $table->dropColumn('cost');
            $table->dropColumn('markup');
            $table->dropColumn('markup_amount');
        });
        Schema::table('order_headers', function (Blueprint $table) {
            $table->dropColumn('svaigi_comment_invoice');
            $table->dropColumn('svaigi_comment_stats');
            $table->dropColumn('discount_items');
            $table->dropColumn('discount_target');
        });
        Schema::table('order_headers', function (Blueprint $table) {
            $table->enum('discount_target', ['product', 'delivery', 'all', 'none'])->nullable();
        });
    }
}
