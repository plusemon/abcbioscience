<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateActivismModulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('activism_modules', function (Blueprint $table) {
            $table->id();            			
            $table->integer('student_id')->nullable();
            $table->integer('user_id')->nullable();
            $table->integer('class_id')->nullable();
            $table->integer('session_id')->nullable();
           //$table->integer('batch_id')->nullable();
            $table->integer('section_id')->nullable();

            $table->integer('batch_setting_id')->nullable();

            $table->integer('fee_cat_id')->nullable();
            $table->integer('month_id')->nullable();
            $table->string('activate_code',150)->nullable();
            
            $table->tinyInteger('activate_status')->nullable();          /*  1 for active 2 for deactive 0 for delete */
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
        Schema::dropIfExists('activism_modules');
    }
}
