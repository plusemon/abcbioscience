<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAttendancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attendances', function (Blueprint $table) {
            $table->id();
            $table->integer('classes_id');
            $table->integer('sessiones_id');
            $table->integer('batch_setting_id');
            $table->string('attendance_date');
            $table->integer('total_student')->nullable();
            $table->integer('total_present')->nullable();
            $table->integer('total_absent')->nullable();
            $table->integer('is_admin');
            $table->integer('status');
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
        Schema::dropIfExists('attendances');
    }
}
