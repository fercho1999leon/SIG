<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AsistenciaParcial extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('asistencia_parcial', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->integer('asistencia')->unsigned()->default(0);
			$table->integer('idStudent')->unsigned();
			$table->foreign('idStudent')->references('id')->on('students2_profile_per_year')->onDelete('cascade');
			$table->string('parcial');
			$table->integer('idPeriodo')->unsigned();
			$table->foreign('idPeriodo')->references('id')->on('periodo_lectivo')->onDelete('cascade');
			$table->integer('atrasos')->unsigned()->default(0);
			$table->integer('faltas_justificadas')->unsigned()->default(0);
			$table->integer('faltas_injustificadas')->unsigned()->default(0);
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
        Schema::dropIfExists('asistencia_parcial');
    }
}
