<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMTimeDoctorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('m_time_doctors', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('idadmin')->index()->unsigned();
            $table->integer('dayofweek');
            $table->integer('day');
            $table->integer('month');
            $table->integer('year');
            $table->string('name');
            $table->timestamps();

            $table->foreign('idadmin')->references('id')->on('m__admins')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('m_time_doctors');
    }
}
