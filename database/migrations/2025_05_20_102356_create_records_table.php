<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRecordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('records', function (Blueprint $table) {
            $table->id();
            $table->char('user_id', 7);
            $table->char('year_m', 7);
            $table->integer('day');
            $table->char('day_of_week', 1);
            $table->time('start_time');
            $table->time('end_time');
            $table->boolean('absense');
            $table->boolean('out_of_fs');
            $table->boolean('meal');
            $table->tinyInteger('physical_condition');
            $table->double('body_temperature');
            $table->boolean('going');
            $table->boolean('coming');
            $table->boolean('home');
            $table->text('note');
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
        Schema::dropIfExists('records');
    }
}
