<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBannersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('banners', function (Blueprint $table) {
            $table->increments('id');
            $table->dateTime('dateFrom')->nullable();
            $table->dateTime('dateTo')->nullable();
            $table->string('title')->nullable();
            $table->enum('frequency', ['once_a_week', 'once_per_session', 'always']);
            $table->text('colors');
            $table->enum('type', ['message', 'popup']);
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
        Schema::dropIfExists('banners');
    }
}
