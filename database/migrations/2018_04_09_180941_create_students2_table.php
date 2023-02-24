<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudents2Table extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students2', function (Blueprint $table) {
            $table->increments('id');
            $table->string('ci', 10);
            /*General*/
            $table->string('nombres', 255);
            $table->string('apellidos', 255);
            $table->enum('sexo', ['Masculino', 'Femenino']);
            $table->string('fechaNacimiento');
            $table->string('ciudad', 100);
            $table->string('direccion', 100);
            $table->string('telefono')->nullable();
            $table->integer('numeroMatricula')->nullable();

            /*Adicional*/
            $table->string('nacionalidad', 100)->nullable();
            $table->string('lugarNacimiento', 100)->nullable();
            $table->string('tipoVivienda', 100)->nullable();
            $table->string('institucionAnterior', 255)->nullable();
            $table->string('razonCambio', 255)->nullable();
            $table->string('observaciones', 1000)->nullable();

            /*Emergencias*/
            $table->string('clinica')->nullable();
            $table->string('indicaciones', 1000)->nullable();
            $table->string('tipoSangre')->nullable();
            $table->string('contactoEmergencia')->nullable();
            $table->string('telefonoEmergencia')->nullable();

            /*Año Lectivo*/
            $table->enum('matricula', ['Ordinaria', 'Extraordinaria', 'Pre Matricula']);
            $table->string('retirado', 2)->nullable();
            //$table->boolean('retirado');

            /*Año Lectivo*/
            $table->enum('seccion', ['EI', 'EGB', 'BGU']);

            /* Id al curso*/
            $table->integer('idCurso')->unsigned()->nullable();

            /* Id al padre*/
            $table->integer('idPadre')->unsigned()->nullable();

            /* Id a la madre*/
            $table->integer('idMadre')->unsigned()->nullable();

            /* Id al representante*/
            $table->integer('idRepresentante')->unsigned()->nullable();

            $table->timestamps();

            //foreign keys
            $table->foreign('idCurso')->references('id')->on('courses')
                ->onDelete('cascade')->nullable();

            /*

        $table->integer('idCurso')->unsigned();
        //foreign keys
        $table->foreign('idCurso')->references('id')->on('courses');
        ->onDelete('cascade');
        $table->timestamps();*/
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
        Schema::dropIfExists('students2');
    }
}
