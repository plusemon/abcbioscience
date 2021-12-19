<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('useruid')->nullable();
            $table->string('name');
            $table->string('mobile')->nullable()->unique()->nullable();
            $table->string('email')->nullable()->unique()->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password')->nullable();
            $table->rememberToken();
            $table->string('image')->nullable();
            $table->integer('role_id')->default(3);   // 1 for admin 2 for stuff 3 for student
            $table->integer('student_type_id')->nullable();  /*1 for online student 2 for offline student*/
            $table->tinyInteger('status')->default(1);  /*1 for active 2 for deactive 0 for deleted*/
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
        Schema::dropIfExists('users');
    }
}
