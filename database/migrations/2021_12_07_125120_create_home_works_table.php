<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHomeWorksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('home_works', function (Blueprint $table) {
            $table->id();
            $table->integer('classes_id')->nullable();
            $table->integer('sessiones_id')->nullable();
            $table->integer('batch_setting_id')->nullable();
            $table->integer('subject_id')->nullable();
            $table->integer('chapter_id')->nullable();
            $table->string('topic')->nullable();
            $table->string('dead_line')->nullable();
            $table->text('attachment')->nullable();
            $table->integer('total_student')->nullable();
            $table->integer('total_present')->nullable();
            $table->integer('total_absent')->nullable();
            $table->integer('is_admin')->nullable();
            $table->integer('status')->default(1);
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
        Schema::dropIfExists('home_works');
    }
}
