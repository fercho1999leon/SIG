<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Student2;
use App\Administrative;
use App\Usuario;

class AsistenciaComportamientoReseteoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $students = Student2::all();

        foreach ($students as $student) {
        	//Comportamiento
        	$student->p1q1C = NULL;
        	$student->p2q1C = NULL;
        	$student->p3q1C = NULL;
        	$student->p1q2C = NULL;
        	$student->p2q2C = NULL;
        	$student->p3q2C = NULL;

        	//Observacion
        	$student->p1q1O = NULL;
        	$student->p2q1O = NULL;
        	$student->p3q1O = NULL;
        	$student->p1q2O = NULL;
        	$student->p2q2O = NULL;
        	$student->p3q2O = NULL; 

        	//Recomendacion
        	$student->p1q1R = NULL;
        	$student->p2q1R = NULL;
        	$student->p3q1R = NULL;
        	$student->p1q2R = NULL;
        	$student->p2q2R = NULL;
        	$student->p3q2R = NULL; 

        	//Atrasos
			$student->p1q1A = 0;
			$student->p2q1A = 0;
			$student->p3q1A = 0;        	
			$student->p1q2A = 0;
			$student->p2q2A = 0;
			$student->p3q2A = 0;

        	//Faltas Justificadas
        	$student->p1q1FJ = 0;
			$student->p2q1FJ = 0;
			$student->p3q1FJ = 0;        	
			$student->p1q2FJ = 0;
			$student->p2q2FJ = 0;
			$student->p3q2FJ = 0;

        	//Faltas Injustificadas
        	$student->p1q1FI = 0;
			$student->p2q1FI = 0;
			$student->p3q1FI = 0;        	
			$student->p1q2FI = 0;
			$student->p2q2FI = 0;
			$student->p3q2FI = 0;

			$student->save();
        }
    }
}
