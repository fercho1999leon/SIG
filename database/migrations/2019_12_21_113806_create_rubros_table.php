<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRubrosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rubros', function (Blueprint $table) {
			$table->increments('id');
			$table->string('tipo_rubro');
			$table->string('tipo_emision');
			$table->integer('idPeriodo')->unsigned();
			$table->foreign('idPeriodo')->references('id')->on('periodo_lectivo');

            $table->timestamps();
		});
		
		Schema::table('modulo_pagos', function (Blueprint $table) {
			$table->integer('idRubro')->unsigned()->nullable();
			$table->foreign('idRubro')->references('id')->on('rubros');
		});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rubros');
    }
}
