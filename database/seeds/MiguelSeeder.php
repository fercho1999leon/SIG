<?php

use Illuminate\Database\Seeder;
use App\Institution;
use App\Course;
use App\Usuario;
use App\Student2;
use App\Payment;
use App\PagoEstudianteDetalle;
use App\BecaDescuento;
use App\ConfiguracionSistema;
use App\Transporte;
use Illuminate\Support\Facades\DB;

class MiguelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
	
    public function run()
    {
		$contador = ConfiguracionSistema::where('nombre', 'CONTADOR_MATRICULA')->first();
		$contador->valor = 'G';
		$contador->save();

		// $institution = Institution::first();
		// $nombres = 'Miguel Vinicio';
		// $apellidos = 'Bonifaz Calderon';
		// $course = factory(Course::class)->create([
		// 	'grado' => 'Segundo',
		// 	'especializacion' => '',
		// 	'paralelo' => 'A',
		// ]);
		// $user = factory(Usuario::class)->create();
		// $idPeriodo = $institution->periodoLectivo;
		// $user->profile()->create([
		// 	'userid' => $user->id,
		// 	'nombres' => $nombres,
		// 	'apellidos' => $apellidos,
		// ]);
		// $student = factory(Student2::class)->create([
		// 	'nombres' => $nombres,
		// 	'apellidos' => $apellidos,
		// 	'idProfile' => $user->profile->id,
		// 	'idCurso' => $course->id,
		// 	'idPeriodo' => $idPeriodo
		// ]);

		// $payment = factory(Payment::class)->create([
		// 	'idCurso' => $course->id,
		// 	'idPeriodo' => $idPeriodo,
		// 	'valor_autorizado' => 190,
		// 	'valor_cancelar' => 190
		// ]);

		// factory(PagoEstudianteDetalle::class)->create([
		// 	'idPago' => $payment->id,
		// 	'idEstudiante' => $student->id,
		// ]);
		// factory(Transporte::class)->create();
		// DB::statement('SET FOREIGN_KEY_CHECKS = 0;');
		// DB::table('students2')->truncate();
		// DB::statement('SET FOREIGN_KEY_CHECKS = 1;');
	}
}
