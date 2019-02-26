<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmailChangesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('email_changes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('verifyString');
            $table->integer('invokedBy');
            $table->text('changes');
            $table->integer('joinUser')->nullable();
            $table->enum('state', ['sent', 'verified'])->default('sent');
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
        Schema::dropIfExists('email_changes');
    }
}
