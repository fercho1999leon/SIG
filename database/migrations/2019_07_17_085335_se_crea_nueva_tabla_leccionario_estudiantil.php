<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SeCreaNuevaTablaLeccionarioEstudiantil extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('leccionario_estudiantil', function (Blueprint $table) {
			$table->increments('id');

			$table->integer('idEstudiante')->unsigned()->nullable();
			$table->foreign('idEstudiante')->references('id')->on('students2')->onDelete('SET NULL');

			$table->integer('idPeriodo')->unsigned()->nullable();
			$table->foreign('idPeriodo')->references('id')->on('periodo_lectivo');

			$table->integer('idLectionary')->unsigned()->nullable();
			$table->foreign('idLectionary')->references('id')->on('lectionaries')->onDelete('SET NULL');
			
			$table->date('fecha')->nullable();
			$table->string('parcial')->nullable();
			$table->string('observacion')->nullable();


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
        Schema::drop('leccionario_estudiantil');
    }
}
