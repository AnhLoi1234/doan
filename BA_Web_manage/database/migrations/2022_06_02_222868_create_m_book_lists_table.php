<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMBookListsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('m_book_lists', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('iduser')->index()->unsigned();
            $table->integer('idtimebook')->index()->unsigned();
            $table->integer('idtimedoctor')->index()->unsigned();
            $table->date('datebook');
            $table->integer('iddoctor');
            $table->string('description');
            $table->integer('status');
            $table->integer('price');
            $table->string('fullname');
            $table->string('gender');
            $table->string('phone');
            $table->string('email');
            $table->date('birthday');
            $table->integer('dayofweek');
            $table->string('address');
            $table->string('type_booklist');
            $table->timestamps();

            $table->foreign('iduser')->references('id')->on('m_users')->onDelete('cascade');
            $table->foreign('idtimebook')->references('id')->on('m_time_books')->onDelete('cascade');
            $table->foreign('idtimedoctor')->references('id')->on('m_time_doctors')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('m_book_lists');
    }
}
