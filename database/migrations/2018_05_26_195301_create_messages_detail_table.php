<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMessagesDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('messages_detail', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_from')->unsigned();
            $table->foreign('id_from')->references('id')->on('users')->onDelete('cascade');
            $table->integer('id_to')->unsigned();
            $table->foreign('id_to')->references('id')->on('users')->onDelete('cascade');
            $table->integer('message_id')->unsigned();
            $table->foreign('message_id')->references('id')->on('messages')->onDelete('cascade');
            $table->boolean('visto');
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
        Schema::dropIfExists('messages_detail');
    }
}
