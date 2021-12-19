<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMcqQuestionOptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mcq_question_options', function (Blueprint $table) {
            $table->id();
            $table->integer('mcq_subject_id')->nullable();
            $table->integer('mcq_question_id')->nullable();
            $table->string('pattern',30)->nullable();
            $table->text('option')->nullable();
            $table->tinyInteger('answer')->nullable(); 
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
        Schema::dropIfExists('mcq_question_options');
    }
}
