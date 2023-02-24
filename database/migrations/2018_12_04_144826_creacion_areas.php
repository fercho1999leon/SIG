<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreacionAreas extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('areas', function (Blueprint $table) {
			$table->increments('id');
			$table->string('nombre', 255);
			$table->string('observacion', 1000)->nullable();
			$table->enum('seccion', ['EI', 'EGB', 'BGU'])->nullable();
			$table->enum('grado', ['Inicial 1', 'Inicial 2', 'Primero', 'Segundo', 'Tercero', 'Cuarto', 'Quinto', 'Sexto', 'Septimo', 'Octavo', 'Noveno', 'Decimo', 'Primero de Bachillerato', 'Segundo de Bachillerato', 'Tercero de Bachillerato'])->nullable();
			$table->string('especializacion', 255);
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
		Schema::dropIfExists('areas');
	}
}
