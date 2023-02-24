<?php

use App\Course;
use App\PagoEstudianteDetalle;
use App\Payment;
use App\PeriodoLectivo;
use App\Student2;
use App\Student2Profile;
use Illuminate\Database\Seeder;

class CorrecionPagosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		$periodo = PeriodoLectivo::where('nombre', '2020-2021')->first();
		$students = Student2Profile::where('retirado', 'NO')
		->where('idPeriodo', $periodo->id)
		->get();

		foreach ($students as $student) {
			foreach ($student->student->pagos as $pago) {
				$pago->delete();
			}
		}

		$courses = Course::whereIn('id', [69, 39, 41, 43, 45, 55])->get();
		foreach ($students as $student) {
			foreach ($courses as $course) {
				$pagos = Payment::where('idCurso', $course->id)->get();
				if ($student->idCurso === $course->id) {
					foreach($pagos as $pago) {
						$pagoDetalle = new PagoEstudianteDetalle;
						$pagoDetalle->idPeriodo = $periodo->id;
						$pagoDetalle->idEstudiante = $student->idStudent;
						$pagoDetalle->estado = "PENDIENTE";
						$pago->pagoEstudianteDetalle()->save($pagoDetalle);
					}
				}
			}
		}
    }
}
