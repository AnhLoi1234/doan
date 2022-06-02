<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMInfoUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('m_info_users', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('idspecicallist')->index()->unsigned();
            $table->integer('iduser')->index()->unsigned();
            $table->string('address');
            $table->string('position');
            $table->string('description');
            $table->string('avatar');
            $table->timestamps();

            $table->foreign('idspecicallist')->references('id')->on('m_specical_lists')->onDelete('cascade');
            $table->foreign('iduser')->references('id')->on('m_users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('m_info_users');
    }
}
