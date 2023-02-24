<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreacionTablaComportamientoMaterias extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comportamientoMateria', function (Blueprint $table) {
			$table->increments('id');
			$table->string('idStudent', 6)->nullable();
			$table->string('idMateria', 6)->nullable();
			$table->string('parcial', 4)->nullable();
			$table->string('observacion', 255)->nullable();
			$table->string('idPeriodo', 255)->nullable();
			$table->string('nota', 1)->nullable();
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
        Schema::dropIfExists('comportamientoMateria');
    }
}
