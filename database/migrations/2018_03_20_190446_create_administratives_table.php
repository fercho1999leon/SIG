<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdministrativesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users_profile', function (Blueprint $table) {
            $table->increments('id');
            //General
            $table->string('ci', 10)->nullable();
            $table->string('nombres', 255);
            $table->string('apellidos', 255);
            $table->enum('sexo', ['Masculino', 'Femenino']);
            $table->string('fNacimiento')->nullable();
            $table->string('correo')->nullable()->unique();
            $table->string('movil', 10)->nullable();
            //Adicional
            $table->string('bio', 1000)->nullable();
            //Domicilio
            $table->string('dDomicilio')->nullable();
            $table->string('tDomicilio')->nullable();
            //Cargo
            $table->string('cargo')->nullable();  
            $table->string('url_imagen',300)->nullable();        

            //foreign key for sentinel users
            $table->integer('userid')->unsigned();
            $table->foreign('userid')->references('id')->on('users')->onDelete('cascade');
             
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
        Schema::dropIfExists('users_profile');
    }
}
