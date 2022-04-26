<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentSheetSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_sheet_settings', function (Blueprint $table) {
            $table->id();

            $table->integer('student_id')->nullable();
            $table->integer('class_id')->nullable();
            $table->integer('session_id')->nullable();
            $table->integer('batch_setting_id')->nullable();
            $table->integer('batch_type_id')->nullable();
            $table->integer('fee_cat_id')->nullable();
            $table->integer('subject_id')->nullable();
            $table->integer('sheet_id')->nullable();
            $table->integer('sheet_type_id')->nullable();
            $table->integer('sheet_setting_id')->nullable();
            $table->integer('fee_amount_setting_id')->nullable();
            $table->tinyInteger('download_capability')->nullable();
            $table->integer('download_count')->nullable();
            $table->dateTime('download_time')->nullable();
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
        Schema::dropIfExists('student_sheet_settings');
    }
}
