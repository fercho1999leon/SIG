<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SeAgregaCamposAdicionalesEnEstudiantePorYearTambienClientesYDatosPadres extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('students2_profile_per_year', function (Blueprint $table) {
			$table->string('estado_civil_padres',100)->nullable()->after('retirado');
			$table->string('celular',100)->nullable()->after('retirado');
			$table->date('fecha_ingreso_pais')->nullable()->after('retirado');
			$table->date('fecha_expiracion_pasaporte')->nullable()->after('retirado');
			$table->date('fecha_caducidad_pasaporte')->nullable()->after('retirado');
			$table->string('alergias', 1000)->nullable()->after('retirado');
			$table->boolean('inclusion')->nullable()->default(false)->after('retirado');
			$table->string('numero_carnet', 30)->nullable()->after('retirado');
			$table->string('seguro_institucional', 100)->nullable()->after('retirado');
			$table->string('nombre_seguro', 100)->nullable()->after('retirado');
			$table->string('discapacidad', 100)->nullable()->after('retirado');
			$table->string('condicionado', 100)->nullable()->after('retirado');
			$table->string('observacion_retirado', 1000)->nullable()->after('retirado');
			$table->string('ingreso_familiar', 20)->nullable()->after('retirado');
		});

		Schema::table('clientes', function (Blueprint $table) {
			$table->string('parentezco', 30)->nullable();
			$table->date('fecha_nacimiento')->nullable();
			$table->string('telefono_domicilio', 100)->nullable();
			$table->string('profesion', 255)->nullable();
			$table->string('lugar_trabajo', 255)->nullable();
			$table->string('telefono_trabajo', 100)->nullable();
			$table->string('nacionalidad', 100)->nullable();
		});

		Schema::table('datospadres', function (Blueprint $table) {
			$table->string('profesion', 100)->nullable();
			$table->boolean('ex_alumno')->nullable();
			$table->date('fecha_promocion')->nullable();
			$table->date('fecha_ingreso_pais')->nullable();
			$table->date('fecha_expiracion_pasaporte')->nullable();
			$table->date('fecha_caducidad_pasaporte')->nullable();
		});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
		Schema::table('students2_profile_per_year', function (Blueprint $table) {
			$table->dropColumn('estado_civil_padres');
			$table->dropColumn('celular');
			$table->dropColumn('fecha_ingreso_pais');
			$table->dropColumn('fecha_expiracion_pasaporte');
			$table->dropColumn('fecha_caducidad_pasaporte');
			$table->dropColumn('alergias');
			$table->dropColumn('inclusion');
			$table->dropColumn('numero_carnet');
			$table->dropColumn('seguro_institucional');
			$table->dropColumn('nombre_seguro');
			$table->dropColumn('discapacidad');
			$table->dropColumn('condicionado');
			$table->dropColumn('observacion_retirado');
			$table->dropColumn('ingreso_familiar');
		});

		Schema::table('clientes', function (Blueprint $table) {
			$table->dropColumn('parentezco');
			$table->dropColumn('fecha_nacimiento');
			$table->dropColumn('telefono_domicilio');
			$table->dropColumn('profesion');
			$table->dropColumn('lugar_trabajo');
			$table->dropColumn('telefono_trabajo');
			$table->dropColumn('nacionalidad');
		});

		Schema::table('datospadres', function (Blueprint $table) {
			$table->dropColumn('profesion');
			$table->dropColumn('ex_alumno');
			$table->dropColumn('fecha_promocion');
			$table->dropColumn('fecha_ingreso_pais');
			$table->dropColumn('fecha_expiracion_pasaporte');
			$table->dropColumn('fecha_caducidad_pasaporte');
		});
    }
}
