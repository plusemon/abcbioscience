<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMcqExamStudentAnswersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mcq_exam_student_answers', function (Blueprint $table) {
            $table->id();
            $table->integer('student_id')->nullable();
            $table->integer('batch_setting_id')->nullable();

            $table->integer('mcq_exam_student_ans_summary_id')->nullable();
            $table->integer('mcq_exam_setting_id')->nullable();
            $table->integer('mcq_subject_id')->nullable();
            $table->integer('mcq_question_subject_id')->nullable();

            $table->integer('mcq_question_id')->nullable();
            $table->integer('given_option_id')->nullable();
            $table->integer('correct_option_id')->nullable();
            $table->tinyInteger('result')->nullable();
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
        Schema::dropIfExists('mcq_exam_student_answers');
    }
}
