<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRequestTypeTbl extends Migration
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
            $table->integer('id_transact')->unsigned();
            $table->integer('id_addressee')->unsigned();
            $table->foreign('id_transact')->references('id')->on('transact_tbl')->onDelete('cascade');
            $table->foreign('id_addressee')->references('id')->on('addressee_tbl')->onDelete('cascade');
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
