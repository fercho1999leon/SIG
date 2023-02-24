<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateModuloPeriodoLectivo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('periodo_lectivo', function (Blueprint $table) {
			$table->increments('id');
            $table->date('fecha_inicial');
            $table->date('fecha_final');
            $table->string('nombre');
			$table->string('regimen');
            $table->timestamps();            
            
        });
        
        Schema::table('courses', function (Blueprint $table) {

            $table->integer('idPeriodo')->unsigned()->nullable();
            $table->foreign('idPeriodo')->references('id')->on('periodo_lectivo')
            ->onDelete('cascade');
        });

        Schema::table('modulo_pagos', function (Blueprint $table) {

            $table->integer('idPeriodo')->unsigned()->nullable();
            $table->foreign('idPeriodo')->references('id')->on('periodo_lectivo')
            ->onDelete('cascade');
        });

        Schema::table('matters', function (Blueprint $table) {

            $table->integer('idPeriodo')->unsigned()->nullable();
            $table->foreign('idPeriodo')->references('id')->on('periodo_lectivo')
            ->onDelete('cascade');
        });

        Schema::table('students2', function (Blueprint $table) {

            $table->integer('idPeriodo')->unsigned()->nullable();
            $table->foreign('idPeriodo')->references('id')->on('periodo_lectivo')
            ->onDelete('cascade');
        });

       Schema::table('courseschedules', function (Blueprint $table) {

            $table->integer('idPeriodo')->unsigned()->nullable();
            $table->foreign('idPeriodo')->references('id')->on('periodo_lectivo')
            ->onDelete('cascade');
        }); 

        Schema::table('cronograma', function (Blueprint $table) {

            $table->integer('idPeriodo')->unsigned()->nullable();
            $table->foreign('idPeriodo')->references('id')->on('periodo_lectivo')
            ->onDelete('cascade');
        });

        Schema::table('teacherschedules', function (Blueprint $table) {

            $table->integer('idPeriodo')->unsigned()->nullable();
            $table->foreign('idPeriodo')->references('id')->on('periodo_lectivo')
            ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('courses', function (Blueprint $table) {
			$table->dropForeign(['idPeriodo']);
			$table->dropColumn('idPeriodo');
        });
       
        Schema::table('modulo_pagos', function (Blueprint $table) {
			$table->dropForeign(['idPeriodo']);
			$table->dropColumn('idPeriodo');
        });

        Schema::table('matters', function (Blueprint $table) {
			$table->dropForeign(['idPeriodo']);
			$table->dropColumn('idPeriodo');
        });

        Schema::table('students2', function (Blueprint $table) {
			$table->dropForeign(['idPeriodo']);
			$table->dropColumn('idPeriodo');
        });

        Schema::table('courseschedules', function (Blueprint $table) {
			$table->dropForeign(['idPeriodo']);
			$table->dropColumn('idPeriodo');
        });

        Schema::table('cronograma', function (Blueprint $table) {
			$table->dropForeign(['idPeriodo']);
			$table->dropColumn('idPeriodo');
        });

        Schema::table('teacherschedules', function (Blueprint $table) {
			$table->dropForeign(['idPeriodo']);
			$table->dropColumn('idPeriodo');
		});
		
		Schema::dropIfExists('periodo_lectivo');
    }
}
