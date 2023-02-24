<?php

use Illuminate\Database\Seeder;
use App\Calificacion;
use App\Course;
use App\Supply;


class LLenadoNotasTercerParcialQuimetre2 extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //$cursosInstitucion = Course::where('idPeriodo', 1)->get();
        $parcial = 'p3q2';
        $insumos = ['TAREAS', 'ACT. GRUPAL', 'ACT. INDIVIDUAL', 'LECCION', 'EVALUACION'];
        
        for($i=0;$i<5;$i++){
            echo count($insumosAnio = Supply::where('nombre',$insumos[$i])->get()).' ';

            //echo $insumos[$i];
        }
        
        /*
            echo count($insumosAnio = Supply::where('nombre','TAREAS')->get());
            echo count($insumosAnio = Supply::where('nombre','ACT. GRUPAL')->get());
            echo count($insumosAnio = Supply::where('nombre','ACT. INDIVIDUAL')->get());
            echo count($insumosAnio = Supply::where('nombre','LECCION')->get());
            echo count($insumosAnio = Supply::where('nombre','EVALUACION')->get());
        */
    }
}



