<?php

use App\ConfiguracionesParcial;
use App\Institution;
use App\PeriodoLectivo;
use App\Student2;
use App\Student2Profile;
use App\Traits\tablasIdPeriodo;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PeriodoLectivo2020 extends Seeder
{
	use tablasIdPeriodo;
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		// Se elimina periodo lectivo 2018
		$periodo2018 = PeriodoLectivo::where('nombre', '2018-2019')->first();
		if ($periodo2018 != null) {
			$periodo2018->delete();
		}

		// Se agrega configuracion parcial
		$periodos = PeriodoLectivo::all();
		$parciales = ConfiguracionesParcial::all();
		foreach ($periodos as $periodo) {
			foreach ($parciales as $parcial) {
				if ($parcial->idPeriodo != $periodo->id) {
					DB::table('configuracionesparcial')->insert([
						'p1q1FI' => null,
						'p1q1FF' => null,
						'p2q1FI' => null,
						'p2q1FF' => null,
						'p3q1FI' => null,
						'p3q1FF' => null,
			
						'p1q2FI' => null,
						'p1q2FF' => null,
						'p2q2FI' => null,
						'p2q2FF' => null,
						'p3q2FI' => null,
						'p3q2FF' => null,
						'idPeriodo' => $periodo->id
					]);
				}
			}
		}
		// agregando idPeriodo a las tablas que les faltan
		$institution = Institution::first();
		foreach ($this->tablasSinIdPeriodo() as $tabla) {
			DB::table($tabla)->update(['idPeriodo' => $institution->periodoLectivo]);
		}

		// Agregando el valor del idPeriodo a Configuraciones Sistema
		DB::table('configuracionessistema')->update(['idPeriodo' => $institution->periodoLectivo]);
		
		// agregando el valor del idPeriodo a las tablas que les faltan, algunas
		// tienen NULL
		foreach ($this->tablasConIdPeriodo() as $tabla) {
			DB::table($tabla)->update(['idPeriodo' => $institution->periodoLectivo]);
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
		
		// activando que sea requerido idRubro
		// DB::statement("ALTER TABLE modulo_pagos ALTER `idRubro` DROP DEFAULT");
		// DB::statement("ALTER TABLE modulo_pagos
		// CHANGE COLUMN `idRubro` `idRubro` INT(10) UNSIGNED NOT NULL");


		DB::statement("ALTER TABLE `clientes`
		CHANGE COLUMN `nombres` `nombres` VARCHAR(191) NULL DEFAULT NULL;");
		DB::statement("ALTER TABLE `clientes`
		CHANGE COLUMN `apellidos` `apellidos` VARCHAR(191) NULL DEFAULT NULL;");
		DB::statement("ALTER TABLE `clientes`
		CHANGE COLUMN `cedula_ruc` `cedula_ruc` VARCHAR(191) NULL DEFAULT NULL;");

		// activando las llaves foraneas
		DB::statement('SET FOREIGN_KEY_CHECKS = 1;');

		// se agrega el valor del idPeriodoLectivo
		DB::table('users')->update(['idPeriodoLectivo' => $institution->periodoLectivo]);

		// Creando el registro del estudiante del año actual
		$students = Student2::all();
		foreach ($students as $student) {
			Student2Profile::create([
				'fecha_matriculacion' => $student->fecha_matriculacion,
				'numero_matriculacion' => $student->numeroMatricula,
				'idPeriodo' => $institution->periodoLectivo,
				'idCurso' => $student->idCurso,
				'idRepresentante' => $student->idRepresentante,
				'idStudent' => $student->id,
				'transporte_id' => $student->transporte_id,
				'tipo_matricula' => $student->matricula,
				'ciudad_domicilio' => $student->ciudad,
				'direccion_domicilio' => $student->direccion,
				'telefono_movil' => $student->telefono,
				'tipo_vivienda' => $student->tipoVivienda,
				'nacionalidad' => $student->nacionalidad,
				'hospital' => $student->clinica,
				'indicaciones' => $student->indicaciones,
				'seccion' => $student->seccion,
				'nombre_contacto_emergencia' => $student->contactoEmergencia,
				'movil_contacto_emergencia' => $student->telefonoEmergencia,
				'ficha_medica' => $student->ficha_medica,
				'retirado' => $student->retirado == 'NO' ? 'NO' : 'SI',
			]);
		}

		$periodosLectivos = [
			[
				'fecha_inicial' => '2019-04-22',
				'fecha_final' => '2020-02-07',
				'nombre' => '2019-2020',
				'regimen' => 'COSTA',
			],
			[
				'fecha_inicial' => '2020-04-22',
				'fecha_final' => '2021-02-07',
				'nombre' => '2020-2021',
				'regimen' => 'COSTA',
			],
		];

		foreach ($periodosLectivos as $periodo) {
			$nuevoPeriodo = PeriodoLectivo::where('nombre', $periodo['nombre'])->first();
			if ($nuevoPeriodo == null) {
				PeriodoLectivo::create([
					'fecha_inicial' => $periodo['fecha_inicial'],
					'fecha_final' => $periodo['fecha_final'],
					'nombre' => $periodo['nombre'],
					'regimen' => $periodo['regimen'],
				]);

				echo "Se agrego periodo del año {$periodo['nombre']}\n";
			}
		}

		$this->call(ConfiguracionesSistemaSeeder::class);
		$this->call(IngresoDeFaltasParcial::class);
		$this->call(RubrosSeeder::class);
    }
}
