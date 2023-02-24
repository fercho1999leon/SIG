<?php

use Illuminate\Database\Seeder;

class factoryEstudiante extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		$user = factory(App\Usuario::class)->create();
		$user_profile = factory(App\User::class)->create(['userid' => $user->id, 'cargo' => 'Estudiante']);
		$student = factory(App\Student2::class)->create(['idProfile' => $user_profile]);
		factory(App\Student2Profile::class)->create([
			'fecha_matriculacion' => null,
			'numero_matriculacion' => null,
			'idCurso' => $student->idCurso,
			'idPeriodo' => App\Institution::first()->periodoLectivo,
			'idRepresentante' => $student->idRepresentante,
			'idStudent' => $student->id,
			'transporte_id' => $student->transporte_id,
			'tipo_matricula' => $student->matricula,
			'seccion' => $student->seccion,
			'ciudad_domicilio' => $student->ciudad,
			'direccion_domicilio' => $student->direccion,
			'telefono_movil' => $student->telefono,
			'tipo_vivienda' => $student->tipoVivienda,
			'nacionalidad' => $student->nacionalidad,
			'hospital' => $student->clinica,
			'indicaciones' => $student->indicaciones,
			'nombre_contacto_emergencia' => $student->contactoEmergencia,
			'movil_contacto_emergencia' => $student->telefonoEmergencia,
			'ficha_medica' => null,
			'retirado' => $student->retirado,
		]);
    }
}
