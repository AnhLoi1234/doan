<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMReplyUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('m_reply_users', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('idadmin')->index()->unsigned();
            $table->integer('iduser')->index()->unsigned();
            $table->integer('idbooklist')->index()->unsigned();
            $table->string('content_reply');
            $table->integer('is_reply');
            $table->timestamps();

            $table->foreign('iduser')->references('id')->on('m_users')->onDelete('cascade');
            $table->foreign('idadmin')->references('id')->on('m__admins')->onDelete('cascade');
            $table->foreign('idbooklist')->references('id')->on('m_book_lists')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('m_reply_users');
    }
}
