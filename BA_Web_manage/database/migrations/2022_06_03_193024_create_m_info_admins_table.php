<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMInfoAdminsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('m_info_admins', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('idspecicallist')->index()->unsigned();
            $table->integer('idadmin')->index()->unsigned();
            $table->string('address');
            $table->string('position');
            $table->text('description_admin');
            $table->string('avatar');
            $table->dateTime('is_online');
            $table->timestamps();

            $table->foreign('idspecicallist')->references('id')->on('m_specical_lists')->onDelete('cascade');
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
        Schema::dropIfExists('m_info_admins');
    }
}
