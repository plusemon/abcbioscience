<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBatchDayTimesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('batch_day_times', function (Blueprint $table) {
            $table->id();
            $table->integer('batch_setting_id');     /*Batches table id */
            $table->integer('day_id');       /*Days table id */
            $table->string('start_time');   /*Start Time */
            $table->string('end_time');     /* End Time */
            $table->integer('status');       /*1 for active 2 for deactive 0 for delete */
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
        Schema::dropIfExists('batch_day_times');
    }
}
