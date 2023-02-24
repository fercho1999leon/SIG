<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class NuevoCamposParaMatriculacion extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('students2_profile_per_year', function (Blueprint $table) {
			$table->string('nombre_contacto_emergencia2', 100)->nullable()->after('movil_contacto_emergencia');
			$table->string('parentezco_contacto_emergencia2', 100)->nullable()->after('nombre_contacto_emergencia2');
			$table->string('movil_contacto_emergencia2', 100)->nullable()->after('parentezco_contacto_emergencia2');
			$table->string('parentezco_contacto_emergencia', 100)->nullable()->after('nombre_contacto_emergencia');
			$table->string('enfermedad', 255)->nullable()->after('alergias');
			$table->string('con_quien_vive', 100)->nullable()->after('tipo_vivienda');
			$table->string('disciplina_practica', 255)->nullable()->after('tipo_matricula');
			$table->string('actividad_artistica', 255)->nullable()->after('tipo_matricula');
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
			$table->dropColumn('nombre_contacto_emergencia2');
			$table->dropColumn('parentezco_contacto_emergencia2');
			$table->dropColumn('movil_contacto_emergencia2');
			$table->dropColumn('parentezco_contacto_emergencia');
			$table->dropColumn('enfermedad');
			$table->dropColumn('con_quien_vive');
			$table->dropColumn('disciplina_practica');
			$table->dropColumn('actividad_artistica');
		});
    }
}
