<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payment_histories', function (Blueprint $table) {
            $table->id();
            $table->string('invoice_no',30)->nullable();
            $table->string('reference_no',50)->nullable();

            $table->integer('fee_cat_id')->nullable();
            $table->integer('origin_id')->nullable();
            $table->integer('fee_amount_setting_id')->nullable();
            $table->decimal('amount', 20, 2)->nullable();

            $table->integer('user_id')->nullable();
            $table->integer('student_id')->nullable();
            $table->integer('batch_setting_id')->nullable();
            $table->integer('batch_type_id')->nullable();
           
            $table->integer('class_id')->nullable();
            $table->integer('session_id')->nullable();

            $table->integer('waiver_id')->nullable();

            $table->integer('payment_method_id')->nullable();
            $table->integer('account_id')->nullable();

            $table->dateTime('receive_date');
            $table->integer('receive_by')->nullable();

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
        Schema::dropIfExists('payment_histories');
    }
}
