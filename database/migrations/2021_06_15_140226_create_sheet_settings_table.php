<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSheetSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sheet_settings', function (Blueprint $table) {
            $table->id();
            $table->integer('fee_cat_id')->nullable();
            $table->integer('batch_setting_id')->nullable();
            $table->integer('batch_type_id')->nullable();
            $table->integer('class_id')->nullable();
            $table->integer('session_id')->nullable();
            $table->integer('sheet_type_id')->nullable();
            $table->integer('subject_id')->nullable();
            $table->integer('sheet_id')->nullable();
            $table->string('publish_date')->nullable();
            $table->integer('taken_by')->nullable();
            $table->integer('publish_by')->nullable();
            $table->string('download_times')->nullable();
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
        Schema::dropIfExists('sheet_settings');
    }
}
