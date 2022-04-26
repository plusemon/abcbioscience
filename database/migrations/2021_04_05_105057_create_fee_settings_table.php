<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFeeSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fee_settings', function (Blueprint $table) {
            $table->id();            	
            $table->integer('fee_cat_id')->nullable();
            $table->integer('class_id')->nullable();
            $table->integer('session_id')->nullable();
            //$table->integer('batch_id')->nullable();
            $table->integer('batch_setting_id')->nullable();
            $table->integer('section_id')->nullable();

            $table->decimal('amount', 5, 2)->nullable();
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
        Schema::dropIfExists('fee_settings');
    }
}
