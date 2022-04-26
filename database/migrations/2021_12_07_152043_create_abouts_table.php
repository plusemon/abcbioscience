<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAboutsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('abouts', function (Blueprint $table) {
            $table->id();
            $table->text('image')->nullable();
            $table->text('details')->nullable();
            $table->text('mission_image')->nullable();
            $table->text('mission_details')->nullable();
            $table->text('vission_image')->nullable();
            $table->text('vission_details')->nullable();
            $table->text('footer_about')->nullable();
            $table->text('body_about_title')->nullable();
            $table->text('body_about_description')->nullable();
            $table->text('body_about_image')->nullable();
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
        Schema::dropIfExists('abouts');
    }
}
