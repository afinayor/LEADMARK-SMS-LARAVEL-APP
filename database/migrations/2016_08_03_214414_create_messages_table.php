<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('messages', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->integer('campaign_id')->unsigned();
            $table->string('subject');
            $table->longText('content');
            $table->longText('recipients')->nullable();
            $table->string('type',50);
            $table->string('send_date_time');
            $table->string('status');
            $table->string('message_characters');
            $table->string('message_pages');
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
        Schema::drop('messages');
    }
}
