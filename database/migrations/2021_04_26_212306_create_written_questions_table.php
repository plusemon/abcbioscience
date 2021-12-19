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
            $table->integer('class_id')->nullable();
            $table->integer('session_id')->nullable();
            $table->integer('batch_setting_id')->nullable();
            $table->string('attachment');
            $table->text('description')->nullable();
            $table->integer('subject_id');
            $table->string('question_type');   /*1 free 2 paid*/
            $table->string('amount')->nullable();
            $table->integer('status');
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
