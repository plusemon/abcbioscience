<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentQuestionSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_question_settings', function (Blueprint $table) {
            $table->id();

            $table->integer('student_id')->nullable();
            $table->integer('batch_setting_id')->nullable();
            $table->integer('batch_type_id')->nullable();

            $table->integer('fee_cat_id')->nullable();
            $table->integer('origin_id')->nullable();
            $table->integer('exam_setting_id')->nullable();
            
            $table->integer('fee_amount_setting_id')->nullable();

            $table->integer('class_id')->nullable();
            $table->integer('session_id')->nullable();

            $table->tinyInteger('exam_capability')->nullable();

            $table->integer('created_by')->nullable();
            $table->string('verified',25)->nullable();
            $table->tinyInteger('status')->nullable();
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
        Schema::dropIfExists('student_question_settings');
    }
}
