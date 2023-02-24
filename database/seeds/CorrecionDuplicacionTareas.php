<?php

use App\Activity;
use App\Course;
use App\Matter;
use App\PeriodoLectivo;
use App\Student2Profile;
use Illuminate\Database\Seeder;

class CorrecionDuplicacionTareas extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $idPeriodo = PeriodoLectivo::where('nombre', '2020-2021')->first()->id;

        $materias = Matter::where('idPeriodo', $idPeriodo)->get();

        $totalACtividadesEliminadas = 0;
        foreach ($materias as $materia) {
            foreach ($materia->supplies as $supply) {
                foreach ($supply->activities as $activity) {
                    $course = Course::find($materia->idCurso);
                    $students = Student2Profile::where('idCurso', $course->id)
                        ->where('tipo_matricula', '!=', 'Pre Matricula')
                        ->where('retirado', 'NO')
                        ->get();
                    if ($activity->deberes->count() > $students->count()) {
                        foreach ($activity->deberes->groupBy('idEstudiante') as $id => $deberes) {
                            if ($deberes->count() > 1) {
                                for ($i = 0; $i < $deberes->count() - 1; $i++) {
                                    $totalACtividadesEliminadas++;
                                    $deberes[$i]->delete();
                                }
                            }
                        }
                    }
                }
            }
        }

        echo "Se eliminaron $totalACtividadesEliminadas actividades";
    }
}
