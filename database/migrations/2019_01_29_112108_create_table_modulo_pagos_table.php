<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableModuloPagosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('modulo_pagos', function (Blueprint $table) {
			$table->increments('id');
            $table->integer('idCurso')->unsigned();
            $table->integer('mes');
            $table->integer('anio');            
			$table->string('tipo');            
			$table->string('anio_lectivo');            
			$table->text('descripcion')->nullable();
			$table->float('valor_autorizado');
			$table->float('valor_cancelar');
            $table->timestamps();
            
            $table->foreign('idCurso')->references('id')->on('courses')
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
        Schema::dropIfExists('modulo_pagos');
    }
}
