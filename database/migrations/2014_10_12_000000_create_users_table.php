<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('order_count')->nullable();
            $table->integer('user_group_id')->default(1)->nullable();
            $table->string('username')->unique()->nullable();
            $table->string('name');
            $table->string('last_name')->nullable();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password')->nullable();
            $table->boolean('registered')->default(false);
            $table->string('phone');
            $table->boolean('is_legal')->default(false);
            $table->string('legal_name')->nullable();
            $table->string('legal_address')->nullable();
            $table->string('legal_reg_nr')->nullable();
            $table->string('legal_vat_reg_nr')->nullable();
            $table->string('address');
            $table->string('city');
            $table->string('postal_code');
            $table->boolean('newsletter')->default(false);
            $table->boolean('isAdmin')->default(false);
            $table->string('address_comments')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });

        App\User::firstOrCreate([
            'username'    => 'admin',
            'name'        => 'Admin',
            'password'    => 'admin',
            'email'       => 'admin@example.com',
            'registered'  => true,
            'isAdmin'     => true,
            'last_name'   => 'admin',
            'phone'       => 'admin',
            'address'     => 'admin',
            'city'        => 'admin',
            'postal_code' => 'admin',
        ]);
        App\User::firstOrCreate([
            'id'       => 99,
            'username' => 'temp_user_for_orders',
            'name'     => 'Temporary Order User',
            'email'    => 'temp@user.local',
            'last_name'   => 'temp',
            'phone'       => 'temp',
            'address'     => 'temp',
            'city'        => 'temp',
            'postal_code' => 'temp',
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
