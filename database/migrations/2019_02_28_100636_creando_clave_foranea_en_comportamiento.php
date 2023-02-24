<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreandoClaveForaneaEnComportamiento extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
		/* COMPORTAMIENTO */
        Schema::table('comportamiento', function (Blueprint $table) {
			$table->dropColumn('idStudent');
			$table->dropColumn('idPeriodo');
		});
		Schema::table('comportamiento', function (Blueprint $table) {
			$table->integer('idStudent')->unsigned()->nullable()->after('id');
			$table->foreign('idStudent')->references('id')->on('students2')->onDelete('cascade');

			$table->integer('idPeriodo')->unsigned()->nullable()->after('observacion');
			$table->foreign('idPeriodo')->references('id')->on('periodo_lectivo')->onDelete('cascade');
		});
		
		/* COMPORTAMIENTO MATERIAS */
		Schema::table('comportamientoMateria', function (Blueprint $table) {
			$table->dropColumn('idStudent');
			$table->dropColumn('idMateria');
			$table->dropColumn('idPeriodo');
		});

		Schema::table('comportamientoMateria', function (Blueprint $table) {
			$table->integer('idStudent')->unsigned()->nullable()->after('id');
			$table->foreign('idStudent')->references('id')->on('students2')->onDelete('cascade');

			$table->integer('idPeriodo')->unsigned()->nullable()->after('observacion');
			$table->foreign('idPeriodo')->references('id')->on('periodo_lectivo')->onDelete('cascade');

			$table->integer('idMateria')->unsigned()->nullable()->after('idStudent');
			$table->foreign('idMateria')->references('id')->on('matters')->onDelete('cascade');
		});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
		/* COMPORTAMIENTO */
        Schema::table('comportamiento', function (Blueprint $table) {
			$table->dropForeign(['idStudent']);
			$table->dropColumn('idStudent');
		});

        Schema::table('comportamiento', function (Blueprint $table) {
			$table->dropForeign(['idPeriodo']);
			$table->dropColumn('idPeriodo');
		});

		Schema::table('comportamiento', function (Blueprint $table) {
			$table->string('idStudent', 5)->nullable()->after('id');
			$table->string('idPeriodo', 5)->nullable()->after('observacion');
		});

		/* COMPORTAMIENTO MATERIA */
        Schema::table('comportamientoMateria', function (Blueprint $table) {
			$table->dropForeign(['idStudent']);
			$table->dropColumn('idStudent');
		});

        Schema::table('comportamientoMateria', function (Blueprint $table) {
			$table->dropForeign(['idPeriodo']);
			$table->dropColumn('idPeriodo');
		});

        Schema::table('comportamientoMateria', function (Blueprint $table) {
			$table->dropForeign(['idMateria']);
			$table->dropColumn('idMateria');
		});

		Schema::table('comportamientoMateria', function (Blueprint $table) {
			$table->string('idStudent', 5)->nullable()->after('id');
		});
		Schema::table('comportamientoMateria', function (Blueprint $table) {
			$table->string('idPeriodo', 5)->nullable()->after('observacion');
			$table->string('idMateria', 5)->nullable()->after('idStudent');
		});
    }
}
