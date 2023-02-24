<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCalificacionesActividadTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('calificacionesactividad', function (Blueprint $table) {            
            $table->increments('id');
            $table->integer('idActividad')->unsigned();
            $table->integer('idEstudiante')->unsigned();
            $table->integer('idInsumo')->unsigned();
            $table->integer('nota');
            $table->timestamps();

            $table->foreign('idActividad')->references('id')->on('activities')->onDelete('cascade');
            $table->foreign('idInsumo')->references('id')->on('supplies')->onDelete('cascade');
            $table->foreign('idEstudiante')->references('id')->on('students2')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('calificacionesactividad');
    }
}