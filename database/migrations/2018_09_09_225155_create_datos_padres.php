<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDatosPadres extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('datospadres', function (Blueprint $table) {
            $table->increments('id');
            $table->string('ci', 10);
            /*General*/
            $table->string('nombres', 255);
            $table->string('apellidos', 255);
            $table->enum('sexo', ['Masculino', 'Femenino']);
            $table->string('fNacimiento');
            $table->string('nacionalidad');
            /*General-2*/
            $table->string('correo', 100)->nullable();
            $table->string('movil', 100)->nullable();
            $table->enum('parentezco', ['Padre', 'Madres'])->nullable();
            $table->string('bio')->nullable();
            /*General-3*/
            $table->string('estudios')->nullable();
            $table->string('religion')->nullable();
            /*Domicilio*/    
            $table->string('ciudadDomicilio', 255)->nullable();
            $table->string('direccionDomicilio', 255)->nullable();
            $table->string('telefonoDomicilio', 100)->nullable();
            /*Trabajo*/
            $table->string('ciudadTrabajo', 255)->nullable();
            $table->string('direccionTrabajo', 255)->nullable();
            $table->string('telefonoTrabajo', 100)->nullable();
            $table->string('cargoTrabajo', 100)->nullable();
            $table->string('lugarTrabajo', 255)->nullable();

            //Enlace a estudiante
            
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
        Schema::dropIfExists('datospadres');
    }
}
