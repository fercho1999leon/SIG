<?php

use App\ConfiguracionesParcial;
use App\Institution;
use App\PeriodoLectivo;
use App\Student2;
use App\Student2Profile;
use App\Traits\tablasIdPeriodo;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CosasAdicionales extends Seeder
{
	use tablasIdPeriodo;
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		// Se crean registros para configuracion parcial dependiendo cuantos años existan en el periodo lectivo.
		$periodos = PeriodoLectivo::all();
		foreach ($periodos as $periodo) {
			$confParcial = ConfiguracionesParcial::where('idPeriodo', $periodo->id)->first();
			if ($confParcial == null) {
				$confParcial = new ConfiguracionesParcial;
				$confParcial->idPeriodo = $periodo->id;
				$confParcial->save();
			}
		}

		// desactivando las llaves foraneas
		DB::statement('SET FOREIGN_KEY_CHECKS = 0;');

		// restrigiendo que el campo idPeriodo sea obligatorio para cualquier registro de la base de datos.
		foreach ($this->tablasConIdPeriodo() as $tabla) {
			DB::statement("ALTER TABLE $tabla ALTER `idPeriodo` DROP DEFAULT");
			DB::statement("ALTER TABLE $tabla
			CHANGE COLUMN `idPeriodo` `idPeriodo` INT(10) UNSIGNED NOT NULL");
		}

		foreach ($this->tablasSinIdPeriodo() as $tabla) {
			DB::statement("ALTER TABLE $tabla ALTER `idPeriodo` DROP DEFAULT");
			DB::statement("ALTER TABLE $tabla
			CHANGE COLUMN `idPeriodo` `idPeriodo` INT(10) UNSIGNED NOT NULL");
		}

		DB::statement("ALTER TABLE `clientes`
		CHANGE COLUMN `nombres` `nombres` VARCHAR(191) NULL DEFAULT NULL;");
		DB::statement("ALTER TABLE `clientes`
		CHANGE COLUMN `apellidos` `apellidos` VARCHAR(191) NULL DEFAULT NULL;");
		DB::statement("ALTER TABLE `clientes`
		CHANGE COLUMN `cedula_ruc` `cedula_ruc` VARCHAR(191) NULL DEFAULT NULL;");

		// activando las llaves foraneas
		DB::statement('SET FOREIGN_KEY_CHECKS = 1;');
    }
}
