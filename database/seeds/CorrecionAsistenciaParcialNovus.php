<?php

use App\AsistenciaParcial;
use App\Course;
use App\PeriodoLectivo;
use App\Student2Profile;
use Illuminate\Database\Seeder;

class CorrecionAsistenciaParcialNovus extends Seeder
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

        $totalStudents = 0;
        foreach ($courses as $course) {
            $students = Student2Profile::where('idCurso', $course->id)->get();

            foreach ($students as $student) {
                foreach ($parciales as $parcial) {
                    $asistencia = $student->asistenciaParcial($parcial);

                    if ($asistencia == null) {
                        $totalStudents++;
                        AsistenciaParcial::create([
                            'idStudent' => $student->id,
                            'parcial' => $parcial,
                            'idPeriodo' => $periodo->id,
                        ]);
                    }
                }
            }
        }

        echo "Se creo un total de $totalStudents registros en la tabla asistencia parcial. \n";
    }
}
