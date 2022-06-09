<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMChatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('m_chats', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('idgroupchat')->index()->unsigned();
            $table->string('content_chat');
            $table->integer('idadmin')->index()->unsigned();
            $table->integer('is_seen');
            $table->integer('is_read');
            $table->string('is_user');
            $table->integer('type_chat');
            $table->timestamps();

            $table->foreign('idgroupchat')->references('id')->on('m_group_chats')->onDelete('cascade');
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
        Schema::dropIfExists('m_chats');
    }
}
