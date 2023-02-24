<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePromediosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('promedios', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('idMateria')->unsigned();
            $table->integer('idCurso')->unsigned();
            $table->integer('idEstudiante')->unsigned();
            $table->text('promedio');

            $table->foreign('idMateria')->references('id')->on('matters');
            $table->foreign('idCurso')->references('id')->on('courses');
            $table->foreign('idEstudiante')->references('id')->on('students2');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('promedios');
    }
}
