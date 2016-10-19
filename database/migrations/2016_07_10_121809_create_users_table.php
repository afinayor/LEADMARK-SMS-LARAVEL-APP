<?php

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
        Schema::create('users',function(Blueprint $table){
            $table->increments('id');
            $table->string('username',50)->unique();
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('password',100);
            $table->string('email')->unique();
            $table->string('phone')->unique();
            $table->string('birthday')->nullable();
            $table->string('title')->nullable();
            $table->string('website')->nullable();
            $table->string('facebook',100)->nullable();
            $table->string('twitter',100)->nullable();
            $table->string('google_plus',100)->nullable();
            $table->string('linkedin',100)->nullable();
            $table->string('instagram',100)->nullable();
            $table->string('address',400)->nullable();
            $table->string('remember_token');
            $table->string('profile_pic');
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
        Schema::drop('users');
    }
}
