<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFeeCollectionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fee_collections', function (Blueprint $table) {
            $table->id();            	
            $table->integer('student_id')->nullable();
            $table->integer('user_id')->nullable();
            $table->integer('class_id')->nullable();
            $table->integer('session_id')->nullable();
            //$table->integer('batch_id')->nullable();
            $table->integer('section_id')->nullable();
            
            $table->integer('batch_setting_id')->nullable();
    
            $table->decimal('payment_amount', 5, 2)->nullable();

            $table->integer('fee_cat_id')->nullable();
            $table->integer('fee_setting_id')->nullable();
            
            $table->integer('payment_method_id')->nullable();		
            $table->integer('account_id')->nullable();
            
            $table->string('receive_date',30)->nullable();		
            $table->tinyInteger('receive_month_id')->nullable();
    
            $table->text('payment_note')->nullable();
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
        Schema::dropIfExists('fee_collections');
    }
}
