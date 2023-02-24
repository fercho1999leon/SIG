<?php

use Illuminate\Database\Seeder;
use App\Course;
use App\PeriodoLectivo;
use App\CourseAssistance;


class CursosAsistenciaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$courses = Course::all();
        $periodo = PeriodoLectivo::whereNombre('2020-2021')->first();
        $parciales = ['p1q1', 'p2q1', 'p3q1', 'p1q2', 'p2q2', 'p3q2'];
        $totalCA = 0;
        foreach ($courses as $course) {
                foreach ($parciales as $parcial) {
							$asistenciaDelCurso = CourseAssistance::query()
							->where('idCurso', $course->id)
							->where('parcial', $parcial)
							->where('idPeriodo',$periodo->id) 
							->first();
                    if ($asistenciaDelCurso == null) {
                        $totalCA++;
						CourseAssistance::create([
						'idCurso'=> $course->id,
						'parcial' => $parcial,
						'idPeriodo' => $periodo->id,
       				 ]);                                     
                }
            }
        }

        echo "Se creo un total de $totalCA registros en la tabla course_assistances. \n";
        //
    }
}
