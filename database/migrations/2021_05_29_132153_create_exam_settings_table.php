<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExamSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exam_settings', function (Blueprint $table) {
            $table->id();
            $table->integer('fee_cat_id')->nullable();
            $table->integer('batch_setting_id')->nullable();
            $table->integer('batch_type_id')->nullable();

            $table->integer('class_id')->nullable();
            $table->integer('session_id')->nullable();
            $table->integer('examination_type_id')->nullable();

            $table->integer('subject_id')->nullable();
            $table->integer('question_subject_id')->nullable();
            
            $table->string('exam_start_date',30)->nullable();
            $table->string('exam_start_time',10)->nullable();
            $table->string('exam_end_time',10)->nullable();
            $table->string('total_exam_time',10)->nullable();
            $table->tinyInteger('exam_status')->nullable();

            $table->integer('created_by')->nullable();
            $table->string('verified',25)->nullable();
            $table->tinyInteger('status')->nullable();          /*  1 for active 2 for deactive 0 for delete */
            $table->softDeletes();
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
        Schema::dropIfExists('exam_settings');
    }
}
