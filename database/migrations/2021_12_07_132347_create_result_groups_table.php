<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateResultGroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('result_groups', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->integer('class_id')->nullable();
            $table->integer('session_id')->nullable();
            $table->integer('batch_setting_id')->nullable();
            $table->integer('mcq_exam_setting_id')->nullable();
            $table->integer('mcq_exam_total_mark')->nullable();
            $table->integer('written_exam_setting_id')->nullable();
            $table->integer('written_exam_total_mark')->nullable();
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
        Schema::dropIfExists('result_groups');
    }
}
