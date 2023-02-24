<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SeCreaNuevaTablaQuizSchedule extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quiz_schedule', function (Blueprint $table) {
			$table->increments('id');
			$table->string('tipo', 12);
			$table->string('horaInicio', 10);
			$table->string('horaFin', 10);
			$table->string('dia1', 10)->nullable();
			$table->string('dia2', 10)->nullable();
			$table->string('dia3', 10)->nullable();
			$table->string('dia4', 10)->nullable();
			$table->string('dia5', 10)->nullable();
			$table->string('dia6', 10)->nullable();
			$table->timestamps();
		});

		Schema::table('quiz_schedule', function (Blueprint $table) {
			$table->integer('idCurso')->unsigned();
			$table->foreign('idCurso')->references('id')->on('courses');
			$table->integer('idPeriodo')->unsigned();
			$table->foreign('idPeriodo')->references('id')->on('periodo_lectivo');
		});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('quiz_schedule');
    }
}
