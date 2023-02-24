<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableBecasDescuentosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('becas_descuentos', function (Blueprint $table) {
			$table->increments('id');
            $table->integer('idPago')->unsigned()->nullable();
            $table->integer('idEstudiante')->unsigned()->nullable();
			$table->string('tipo');
			$table->float('valor');
            $table->timestamps();
            
            $table->foreign('idEstudiante')->references('id')->on('students2')
            ->onDelete('cascade')->nullable();

            $table->foreign('idPago')->references('id')->on('modulo_pagos')
            ->onDelete('cascade')->nullable();
		});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('becas_descuentos');
    }
}
