<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterBecasStructure extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('becas_detalle', function (Blueprint $table) {
			$table->increments('id');
            $table->integer('idBeca')->unsigned();
            $table->integer('idEstudiante')->unsigned();
           
            $table->foreign('idBeca')->references('id')->on('becas_descuentos')
            ->onDelete('cascade')->nullable();

            $table->foreign('idEstudiante')->references('id')->on('students2')
			->onDelete('cascade')->nullable();

			$table->timestamps();
        });
        
        Schema::table('becas_descuentos', function (Blueprint $table) {
            $table->string('nombre')->nullable();
            $table->string('descripcion')->nullable();
            $table->string('estado')->nullable();
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('becas_detalle');

        Schema::table('becas_descuentos', function (Blueprint $table) {
            
            // $table->integer('idPago')->unsigned();
            // $table->integer('idEstudiante')->unsigned();

            // $table->foreign('idEstudiante')->references('id')->on('students2')
            // ->onDelete('cascade')->nullable();

            // $table->foreign('idPago')->references('id')->on('modulo_pagos')
            // ->onDelete('cascade')->nullable();

            $table->dropColumn('nombre');
            $table->dropColumn('descripcion');
            $table->dropColumn('estado');
        });
    }
}
