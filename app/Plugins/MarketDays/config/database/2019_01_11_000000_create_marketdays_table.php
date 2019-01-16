<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMarketdaysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('market_days', function (Blueprint $table) {
            $table->increments('id');
            $table->string('marketDay');
            $table->string('marketDaysSlug');
            $table->integer('hideBeforeDays');
            $table->string('hideBeforeHours');
            $table->softDeletes();
            $table->timestamps();
        });

        \Illuminate\Support\Facades\Artisan::call("db:seed", ["--class" => "MarketDaySeeder"]);
        \Illuminate\Support\Facades\Artisan::call("db:seed", ["--class" => "MarketDaysAdminMenu"]);

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('market_days');
    }
}
