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
            $table->timestamps();
            $table->string('user_id');            #ユーザID
            $table->integer('year');                  #年
            $table->integer('month');                 #月
            $table->integer('date');                  #日
            $table->string('day_of_week');        #曜日
            $table->string('start_time');         #開始時間
            $table->string('end_time');           #終了時間
            $table->boolean('absense');           #欠席加算
            $table->boolean('meal');              #食事提供
            $table->integer('physical_condition');    #体調
            $table->float('body_temperature');    #検温
            $table->boolean('going');             #公共交通機関使用・行き
            $table->boolean('return');            #公共交通機関使用・帰り
            $table->boolean('home');              #在宅
            $table->string('note');               #備考
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
