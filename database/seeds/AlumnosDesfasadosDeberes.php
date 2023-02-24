<?php

use App\Supply;
use App\Matter;
use App\Deber;
use App\Activity;
use App\Student2Profile;
use Illuminate\Database\Seeder;
use App\PeriodoLectivo;

class AlumnosDesfasadosDeberes extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       	$c=0;
        $periodos = PeriodoLectivo::all();
        foreach ($periodos as $periodo) {
         $activities = Activity::all();
         foreach ($activities as $actividad ) {
           
                $supply = Supply::FindOrFail($actividad->idInsumo);
                $matter = Matter::find($supply->idMateria);
                $students = Student2Profile::getStudentsByCourseSeed($supply->idCurso,$periodo->id);
                foreach ($students as $estudiante) {
                            $existe_deber = Deber::where('idActividad',$actividad->id)
                            ->where('idPeriodo',$periodo->id) 
                            ->where('idEstudiante',$estudiante->idStudent)
                            ->exists(); 

                            if(!$existe_deber && $actividad->id!='' && $estudiante->idStudent!=''&& $supply->idDocente!='' && $matter->idDocente!=''){      
                                $c++;                       
                                $deber = new Deber;
                                $deber->idActividad = $actividad->id;
                                $deber->idPeriodo = $periodo->id;
                                $deber->idEstudiante = $estudiante->idStudent;
                                $deber->idProfesor = $matter->user->profile->id;
                                $deber->save();
                                }
                }
               
            }
        }
    }
    
}
