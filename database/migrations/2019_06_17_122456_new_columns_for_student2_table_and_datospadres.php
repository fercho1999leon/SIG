<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class NewColumnsForStudent2TableAndDatospadres extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('students2', function (Blueprint $table) {
			$table->string('provincia', 100)->nullable();
			$table->string('canton', 100)->nullable();
			$table->string('parroquia', 100)->nullable();
			$table->date('fecha_matriculacion')->nullable();
			$table->string('transporte_dias')->nullable();
			$table->string('transporte_observacion', 100)->nullable();
			$table->string('ficha_medica')->nullable();
			$table->string('identificacion', 100);
			$table->string('numero_identificacion', 100);
			$table->string('facturacion_apellidos', 100);
			$table->string('facturacion_nombres', 100);
			$table->string('facturacion_correo', 100)->nullable();
			$table->string('facturacion_movil', 100)->nullable();
			$table->string('facturacion_convencional', 100)->nullable();
			$table->string('facturacion_actividad', 100)->nullable();
			$table->float('ingreso_actividad')->nullable();
		});

		Schema::table('datospadres', function (Blueprint $table) {
			$table->boolean('fallecido')->nullable();
			$table->boolean('estado_civil');
			$table->boolean('autorizadoRetirarEstudiante')->nullable();
			$table->string('lugarNacimiento', 100)->nullable();
			$table->string('provincia', 100)->nullable();
			$table->string('canton', 100)->nullable();
			$table->string('parroquia', 100)->nullable();
			$table->string('clinica')->nullable();
			$table->string('indicaciones')->nullable();
			$table->string('tipoSangre')->nullable();
			$table->string('contactoEmergencia')->nullable();
			$table->string('telefonoEmergencia')->nullable();
			$table->string('observacionEmergencia')->nullable();
		});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('students2', function (Blueprint $table) {
			$table->dropColumn('provincia');
			$table->dropColumn('canton');
			$table->dropColumn('parroquia');
			$table->dropColumn('ficha_medica');
			$table->dropColumn('fecha_matriculacion');
			$table->dropColumn('transporte_dias');
			$table->dropColumn('transporte_observacion');
			$table->dropColumn('identificacion');
			$table->dropColumn('numero_identificacion');
			$table->dropColumn('facturacion_apellidos');
			$table->dropColumn('facturacion_nombres');
			$table->dropColumn('facturacion_correo');
			$table->dropColumn('facturacion_movil');
			$table->dropColumn('facturacion_convencional');
			$table->dropColumn('facturacion_actividad');
			$table->dropColumn('ingreso_actividad');
		});

		Schema::table('datospadres', function (Blueprint $table) {
			$table->dropColumn('fallecido');
			$table->dropColumn('estado_civil');
			$table->dropColumn('autorizadoRetirarEstudiante');
			$table->dropColumn('lugarNacimiento');
			$table->dropColumn('provincia');
			$table->dropColumn('canton');
			$table->dropColumn('parroquia');
			$table->dropColumn('clinica');
			$table->dropColumn('indicaciones');
			$table->dropColumn('tipoSangre');
			$table->dropColumn('contactoEmergencia');
			$table->dropColumn('telefonoEmergencia');
			$table->dropColumn('observacionEmergencia');
		});
	}
}


