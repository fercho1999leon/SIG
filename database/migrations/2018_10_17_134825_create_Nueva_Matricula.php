<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNuevaMatricula extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
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
            $table->enum('lectivo', ['2010-2011', '2011-2012', '2012-2013', '2013-2014', '2014-2015', '2015-2016', '2016-2017', '2017-2018', '2018-2019', '2019-2020', '2020-2021']);
            $table->enum('matricula', ['Ordinaria', 'Extraordinaria', 'Pre Matricula']);
            $table->string('retirado', 2)->nullable();
            //$table->boolean('retirado');

            /*Año Lectivo*/
            $table->enum('seccion',['EI','EGB','BGU']);

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

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('students');
    }
}
