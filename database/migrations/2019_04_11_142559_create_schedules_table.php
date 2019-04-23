<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSchedulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('schedules', function (Blueprint $table) {
            $table->increments('id');
            $table->string('type');
            $table->string('filename');
            $table->integer('total_lines')->nullable();
            $table->integer('stopped_at')->default(0);
            $table->boolean('running')->default(0);
            $table->boolean('finished')->default(0);
            $table->boolean('result_state')->default(0);
            $table->string('result_message')->default('Task Scheduled');
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
        Schema::dropIfExists('schedules');
    }
}
