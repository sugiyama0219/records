<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MakeNullalbeAtRecordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('records', function (Blueprint $table) {
            $table->time('start_time')->nullable()->change();
            $table->time('end_time')->nullable()->change();
            $table->boolean('absense')->nullable()->change();
            $table->boolean('out_of_fs')->nullable()->change();
            $table->boolean('meal')->nullable()->change();
            $table->integer('physical_condition')->nullable()->change();
            $table->float('body_temperature')->nullable()->change();
            $table->boolean('going')->nullable()->change();
            $table->boolean('coming')->nullable()->change();
            $table->boolean('home')->nullable()->change();
            $table->text('note')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('records', function (Blueprint $table) {
            //
        });
    }
}
