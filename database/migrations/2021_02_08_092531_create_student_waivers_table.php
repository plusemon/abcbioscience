<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentWaiversTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_waivers', function (Blueprint $table) {
            $table->id();
            $table->integer('waiver_id')->nullable();
            $table->integer('fee_cat_id')->nullable();
            $table->integer('student_id')->nullable();
            $table->integer('user_id')->nullable();
            $table->integer('class_id')->nullable();
            $table->integer('session_id')->nullable();
            $table->integer('batch_id')->nullable();
            $table->integer('section_id')->nullable();

            $table->integer('batch_setting_id')->nullable();
            $table->integer('batch_type_id')->nullable();

            $table->tinyInteger('waiver_type_id')->nullable(); //[percent,fixed]
            $table->decimal('waiver_value')->nullable();  	
            $table->decimal('waiver_amount', 5, 2)->nullable();	
            $table->tinyInteger('end_month_id')->nullable();
            $table->tinyInteger('activate_status')->nullable();          /*  1 for active 2 for deactive 0 for delete */
            $table->integer('created_by')->nullable();

            $table->decimal('fee_setting_amount', 5, 2)->nullable();
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
        Schema::dropIfExists('student_waivers');
    }
}
