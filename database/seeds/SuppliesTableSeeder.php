<?php

use Illuminate\Database\Seeder;
use App\PeriodoLectivo;

class SuppliesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $periodo = PeriodoLectivo::where('nombre', '2019-2020')->first();
        $supplies = array('TAREAS','ACT. GRUPAL','ACT. INDIVIDUAL','LECCION','EVALUACION');

        $materias = \DB::table('matters')->get();
        foreach($materias as $materia){
            foreach ($supplies as $key => $value) {
                \DB::table('supplies')->insert(array(
                    'nombre'    =>  $value,
                    'idCurso'   =>  $materia->idCurso,
                    'idMateria' =>  $materia->id,
                    'idDocente' =>  $materia->idDocente,
                    'idPeriodo' =>  $periodo->id,
                ));
            }
        }
    }
}
