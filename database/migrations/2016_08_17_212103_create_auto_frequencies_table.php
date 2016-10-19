<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAutoFrequenciesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('auto_frequencies', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('autoschedule_id')->unsigned();
            $table->string('no_frequency');
            $table->string('frequency_type');
            $table->string('time');
            $table->string('start_date');
            $table->string('end_date');
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
        Schema::drop('auto_frequencies');
    }
}
