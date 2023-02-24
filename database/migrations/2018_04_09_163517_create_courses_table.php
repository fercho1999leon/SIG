<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
         Schema::create('courses', function (Blueprint $table) {
            $table->increments('id');

            $table->enum('grado',['Inicial 1','Inicial 2','Primero','Segundo', 'Tercero','Cuarto','Quinto','Sexto',
                'Septimo','Octavo','Noveno','Decimo', 'Primero de Bachillerato', 'Segundo de Bachillerato', 'Tercero de Bachillerato']);
            $table->string('paralelo', 100);
            $table->integer('idProfesor')->unsigned()->nullable();
            $table->string('idEstudiantes',250)->nullable();
            $table->integer('nEstudiantes')->nullable();
            $table->integer('nEstudiantesHombres')->nullable();
            $table->integer('nEstudiantesMujeres')->nullable();
            $table->string('idMaterias',255)->nullable();
            $table->enum('seccion',['EI','EGB','BGU']);
            $table->string('observacion', 500)->nullable();
            $table->integer('idAula')->nullable();

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
        //
        Schema::dropIfExists('courses');
    }
}
