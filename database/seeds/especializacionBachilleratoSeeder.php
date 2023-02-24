<?php

use Illuminate\Database\Seeder;
use App\Course;

class especializacionBachilleratoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $cursos = Course::getAllCourses();
        foreach ($cursos as $curso) {
			
			if( $curso->grado=='Primero de Bachillerato'){
				$curso->especializacion = $curso->paralelo;
				//$curso->paralelo='';
				$curso->save();
			}
			if( $curso->grado=='Segundo de Bachillerato'){
				$curso->especializacion = $curso->paralelo;
				//$curso->paralelo='';
				$curso->save();
			}
			if( $curso->grado=='Tercero de Bachillerato'){
				$curso->especializacion = $curso->paralelo;
				//$curso->paralelo='';
				$curso->save();
			}

        }
    }
}
