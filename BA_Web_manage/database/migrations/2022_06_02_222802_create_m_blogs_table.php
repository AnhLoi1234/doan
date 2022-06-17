<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMBlogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('m_blogs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->integer('view');
            $table->string('thumbnail');
            $table->integer('type_blog');
            $table->string('slug_blog');
            $table->text('content');
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
        Schema::dropIfExists('m_blogs');
    }
}
