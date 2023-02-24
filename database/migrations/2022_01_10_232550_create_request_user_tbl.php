<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRequestUserTbl extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transact_tbl', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_type_request')->unsigned();
            $table->integer('id_career')->unsigned();
            $table->integer('id_user')->unsigned();
            $table->string('descriptions', 300);
            $table->foreign('id_type_request')->references('id')->on('request_type_tbl')->onDelete('cascade');
            $table->foreign('id_career')->references('id')->on('Career')->onDelete('cascade');
            $table->foreign('id_user')->references('id')->on('users')->onDelete('cascade');
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
        //
    }
}
