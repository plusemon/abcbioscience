<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOldQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('old_questions', function (Blueprint $table) {
            $table->id();
            $table->string('question_type_id');  /*== 1 for school question 2 for board question */
            $table->string('schoolname')->nullable();
            $table->integer('year_id')->nullable();
            $table->integer('class_id')->nullable();
            $table->integer('exam_type_id')->nullable();  /* ============ 1. final yearly 2 final */
            $table->integer('subject_id')->nullable();  /* ============  subject table */
            $table->integer('board_question_type_id')->nullable();  /* ============  1 psc 2 jsc 3 ssc 4 hsc */
            $table->string('questionfile')->nullable();
            $table->integer('status')->nullable();   /* ========== 1 active 2 daft 0 deleted*/
            $table->integer('user_id');
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
        Schema::dropIfExists('old_questions');
    }
}
