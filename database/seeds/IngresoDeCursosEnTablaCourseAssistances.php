<?php

use App\Course;
use App\CourseAssistance;
use App\Institution;
use Illuminate\Database\Seeder;

class IngresoDeCursosEnTablaCourseAssistances extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
		$parciales = [
			'p1q1', 'p2q1', 'p3q1',
			'p1q2', 'p2q2', 'p3q2'
		];
		$courses = Course::all();
		foreach ($parciales as $parcial) {
			foreach ($courses as $course) {
				CourseAssistance::create([
					'idCurso' => $course->id,
					'idPeriodo' => 2,
					'parcial' => $parcial
				]);
			}
		}
    }
}
