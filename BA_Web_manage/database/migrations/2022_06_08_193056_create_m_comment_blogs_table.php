<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMCommentBlogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('m_comment_blogs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('idblog')->index()->unsigned();
            $table->integer('iduser')->index()->unsigned();
            $table->string('fullname');
            $table->string('content_comment');
            $table->timestamps();

            $table->foreign('idblog')->references('id')->on('m_blogs')->onDelete('cascade');
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
        Schema::dropIfExists('m_comment_blogs');
    }
}
