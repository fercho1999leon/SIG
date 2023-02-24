<?php

use Illuminate\Database\Seeder;
use App\PeriodoLectivo;
use App\Course;
use App\Matter;
use Illuminate\Support\Facades\DB;

class ListadoDestrezasSeeder extends Seeder
{
    public function run()
    {
        $destrezasI1 = array(
            ['nombre','descripcion']

        );
        $destrezasI2 = array(

        );
        $destrezasP = array(

        );


        $periodo = PeriodoLectivo::where('nombre', '2020-2021')->first()->id; //periodo lectivo especifico
        $cursos = Course::where('grado','Primero')->orWhere('seccion','EI')->get();//Cursos de inicial y primero

        foreach($cursos as $key){    
            $destrezas = $destrezasI1;
            $ambitos = Matter::where(['idCurso'=>$key->id,'idPeriodo'=>$periodo])->get(); //materias

            if (!is_null($ambitos)) {

                foreach($ambitos as $s){

                    foreach($destrezas as $destreza){
                        DB::table('users')->insert(array(
                            'nombre' => $destreza[0],
                            'descripcion' => $destreza[0],
                            'idMateria' => $destreza[0],
                            'grado' => $destreza[0],
                            'created_at' => $destreza[0],
                            'updated_at' => $destreza[0],
                            'idPeriodo' => $periodo,
                        ));
                    }
                }

            }else{
                echo 'No hay ambitos';
            }
        }
    }
}
