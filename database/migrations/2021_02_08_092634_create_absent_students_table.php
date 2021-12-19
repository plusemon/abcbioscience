<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAbsentStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('absent_students', function (Blueprint $table) {
            $table->id();
            $table->integer('student_id')->nullable();
            $table->integer('user_id')->nullable();
            $table->integer('class_id')->nullable();
            $table->integer('session_id')->nullable();
            //$table->integer('batch_id')->nullable();

            $table->integer('batch_setting_id')->nullable();

            $table->integer('section_id')->nullable();
            $table->integer('month_id')->nullable();
            $table->string('reason')->nullable();
            $table->string('notes')->nullable();
            $table->tinyInteger('status')->nullable();          /*  1 for active 2 for deactive 0 for delete */
            $table->integer('created_by')->nullable();
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
        Schema::dropIfExists('absent_students');
    }
}
