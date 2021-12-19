<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBatchSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('batch_settings', function (Blueprint $table) {
            $table->id();
            $table->string('batch_uid');
            $table->string('batch_name');
            $table->integer('classes_id');
            $table->integer('sessiones_id');
            //$table->integer('batch_id');
            $table->integer('class_type_id');   /*1 for offline 2 for online*/
            $table->string('amount')->nullable();
            $table->integer('status');  /*1 for active 2 for deactive 0 for delete */
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
        Schema::dropIfExists('batch_settings');
    }
}
