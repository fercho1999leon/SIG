<?php

use App\Course;
use App\PagoEstudianteDetalle;
use App\PeriodoLectivo;
use App\Student2Profile;
use Illuminate\Database\Seeder;

class EliminacionPagosEstudiantes extends Seeder
{
    public function run()
    {

        $periodo = PeriodoLectivo::where('nombre', '2020-2021')->first();
        $cursos = Course::where('idPeriodo', $periodo->id)->get();

        foreach ($cursos as $curso) {

            $students = Student2Profile::getStudentsByCourseSeed($curso->id, $periodo->id);

            foreach ($students as $student) {

                $pagosCobrados = PagoEstudianteDetalle::where('idEstudiante', $student->idStudent)->where('estado', 'PAGADO')->get();
                $pagos = PagoEstudianteDetalle::where('idEstudiante', $student->idStudent)->where('estado', 'PENDIENTE')->get();

                foreach ($pagos as $deut) {
                    
                    foreach ($pagosCobrados as $cobrado) {

                        if ( ($deut->pago()->first()->mes == $cobrado->pago()->first()->mes) && ($deut->pago()->first()->anio == $cobrado->pago()->first()->anio) ) {

                            $deut->delete();
                        }
                    }
                }
            }
        }
    }
}