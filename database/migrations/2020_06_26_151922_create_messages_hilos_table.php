<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMessagesHilosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('messages_hilos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('idOriginal')->unsigned();
            $table->foreign('idOriginal')->references('id')->on('messages')->onDelete('cascade');
            $table->integer('idRespuesta')->unsigned();
            $table->foreign('idRespuesta')->references('id')->on('messages')->onDelete('cascade');
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
        Schema::dropIfExists('messages_hilos');
    }
}
