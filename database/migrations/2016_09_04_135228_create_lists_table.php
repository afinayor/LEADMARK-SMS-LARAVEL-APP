<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateListsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lists', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->string('name');
            $table->string('display_name');
            $table->longText('description');
            $table->string('from_name');
            $table->string('from_email');
            $table->string('reply_email');
            $table->string('subject');
            $table->string('suscribe_default');
            $table->string('suscribe');
            $table->string('suscribe_email');
            $table->string('unsuscribe');
            $table->string('unsuscribe_email');
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
        Schema::drop('lists');
    }
}
