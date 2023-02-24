<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTablePagoEstudianteDetallesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pago_estudiante_detalles', function (Blueprint $table) {
			$table->increments('id');
			$table->datetime('prorroga')->nullable();
			$table->string('estado')->nullable();
            $table->integer('idEstudiante')->unsigned();
            $table->integer('idPago')->unsigned();
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
        Schema::dropIfExists('pago_estudiante_detalles');
    }
}
