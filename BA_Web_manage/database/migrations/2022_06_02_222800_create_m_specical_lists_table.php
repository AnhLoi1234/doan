<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMSpecicalListsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('m_specical_lists', function (Blueprint $table) {
            $table->increments('id');
            $table->string('namespecical');
            $table->string('thumbnail');
            $table->text('description_specical');
            $table->string('slugspecical');
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
        Schema::dropIfExists('m_specical_lists');
    }
}
