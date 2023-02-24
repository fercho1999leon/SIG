<?php

use App\AsistenciaParcial;
use App\PeriodoLectivo;
use App\Student2;
use Illuminate\Database\Seeder;

class IngresoDeFaltasParcial extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		$parciales = ['p1q1', 'p2q1', 'p3q1', 'p1q2', 'p2q2', 'p3q2'];
		$periodoLectivo = PeriodoLectivo::where('nombre', '2019-2020')->first();
		$students = Student2::join('students2_profile_per_year', 'students2.id', '=', 'students2_profile_per_year.idStudent')
			->select('students2_profile_per_year.id', 'students2.p1q1A', 'students2.p1q1FJ', 'students2.p1q1FI',
				'students2.p2q1A', 'students2.p2q1FJ', 'students2.p2q1FI', 'students2.p3q1A', 'students2.p3q1FJ', 'students2.p3q1FI',
				'students2.p1q2A', 'students2.p1q2FJ', 'students2.p1q2FI', 'students2.p2q2A', 'students2.p2q2FJ', 'students2.p2q2FI',
				'students2.p3q2A', 'students2.p3q2FJ', 'students2.p3q2FI')
			->get();
		
		foreach ($parciales as $parcial) {
			if ($parcial == 'p1q1') {
				foreach ($students as $student) {
					AsistenciaParcial::create([
						'asistencia' => 0,
						'idStudent' => $student->id,
						'parcial' => $parcial,
						'idPeriodo' => $periodoLectivo->id,
						'atrasos' => $student->p1q1A ?? 0,
						'faltas_justificadas' => $student->p1q1FJ ?? 0,
						'faltas_injustificadas' => $student->p1q1FI ?? 0
					]);
				}
			} elseif($parcial == 'p2q1') {
				foreach ($students as $student) {
					AsistenciaParcial::create([
						'asistencia' => 0,
						'idStudent' => $student->id,
						'parcial' => $parcial,
						'idPeriodo' => $periodoLectivo->id,
						'atrasos' => $student->p2q1A ?? 0,
						'faltas_justificadas' => $student->p2q1FJ ?? 0,
						'faltas_injustificadas' => $student->p2q1FI ?? 0
					]);
				}
			} elseif($parcial == 'p3q1') {
				foreach ($students as $student) {
					AsistenciaParcial::create([
						'asistencia' => 0,
						'idStudent' => $student->id,
						'parcial' => $parcial,
						'idPeriodo' => $periodoLectivo->id,
						'atrasos' => $student->p3q1A ?? 0,
						'faltas_justificadas' => $student->p3q1FJ ?? 0,
						'faltas_injustificadas' => $student->p3q1FI ?? 0
					]);
				}
			} elseif($parcial == 'p1q2') {
				foreach ($students as $student) {
					AsistenciaParcial::create([
						'asistencia' => 0,
						'idStudent' => $student->id,
						'parcial' => $parcial,
						'idPeriodo' => $periodoLectivo->id,
						'atrasos' => $student->p1q2A ?? 0,
						'faltas_justificadas' => $student->p1q2FJ ?? 0,
						'faltas_injustificadas' => $student->p1q2FI ?? 0
					]);
				}
			} elseif($parcial == 'p2q2') {
				foreach ($students as $student) {
					AsistenciaParcial::create([
						'asistencia' => 0,
						'idStudent' => $student->id,
						'parcial' => $parcial,
						'idPeriodo' => $periodoLectivo->id,
						'atrasos' => $student->p2q2A ?? 0,
						'faltas_justificadas' => $student->p2q2FJ ?? 0,
						'faltas_injustificadas' => $student->p2q2FI ?? 0
					]);
				}
			} elseif($parcial == 'p3q2') {
				foreach ($students as $student) {
					AsistenciaParcial::create([
						'asistencia' => 0,
						'idStudent' => $student->id,
						'parcial' => $parcial,
						'idPeriodo' => $periodoLectivo->id,
						'atrasos' => $student->p3q2A ?? 0,
						'faltas_justificadas' => $student->p3q2FJ ?? 0,
						'faltas_injustificadas' => $student->p3q2FI ?? 0
					]);
				}
			}
		}
    }
}
