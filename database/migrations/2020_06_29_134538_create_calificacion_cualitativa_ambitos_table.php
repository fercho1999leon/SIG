<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCalificacionCualitativaAmbitosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('calificacion_cualitativa_ambitos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('Quimestre',10);
            $table->string('Parcial',10);
            $table->string('Calificacion',3);
            $table->integer('idStudent')->unsigned();
            $table->foreign('idStudent')->references('id')->on('students2')->onDelete('cascade');
            $table->integer('idMateria')->unsigned();
            $table->foreign('idMateria')->references('id')->on('matters')->onDelete('cascade');
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
        Schema::dropIfExists('calificacion_cualitativa_ambitos');
    }
}
