<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_infos', function (Blueprint $table) {
            $table->id();
            $table->string('user_id');
            //$table->string('school_name')->nullable();
            $table->string('father')->nullable();
            $table->string('mother')->nullable();
            $table->string('guardian_mobile',20)->nullable();
            $table->string('own_mobile',20)->nullable();
            $table->string('email')->nullable();
            $table->string('bkash_number',20)->nullable();
            $table->string('whatsapp_number',20)->nullable();
            $table->string('facebook_id')->nullable();
            $table->text('address')->nullable();
            $table->text('notes')->nullable();
            $table->tinyInteger('status')->nullable();  
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
        Schema::dropIfExists('student_infos');
    }
}
