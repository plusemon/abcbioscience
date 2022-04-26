<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWrittenQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('written_questions', function (Blueprint $table) {
            $table->id();
            $table->string('question_no')->nullable();
            $table->integer('class_id')->nullable();
            $table->integer('session_id')->nullable();
            $table->integer('subject_id')->nullable();
            $table->integer('chapter_id')->nullable();
            $table->integer('topic')->nullable();
            $table->integer('total_mark')->nullable();
            $table->integer('examination_type_id')->nullable();
            $table->string('attachment')->nullable();
            $table->string('solution_attachment')->nullable();
            $table->text('description')->nullable();
            $table->integer('status');
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
        Schema::dropIfExists('written_questions');
    }
}
