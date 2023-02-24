<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTeacherSchedulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('teacherschedules', function (Blueprint $table) {
            $table->increments('id');
            
            $table->time('horaInicio')->nullable();
            $table->time('horaFin')->nullable();
            $table->string('dia1')->nullable();
            $table->integer('idDia1')->unsigned()->nullable();
            $table->string('dia2')->nullable();
            $table->integer('idDia2')->unsigned()->nullable();
            $table->string('dia3')->nullable();
            $table->integer('idDia3')->unsigned()->nullable();
            $table->string('dia4')->nullable();
            $table->integer('idDia4')->unsigned()->nullable();
            $table->string('dia5')->nullable();
            $table->integer('idDia5')->unsigned()->nullable();
            $table->string('dia6')->nullable();
            $table->integer('idDia6')->unsigned()->nullable();
            
            $table->integer('idProfesor')->unsigned()->nullable();

            /*Las llaves foraneas con la tabla porfesor(si la hay)*/
            
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
        Schema::dropIfExists('teacherschedules');
    }
}
