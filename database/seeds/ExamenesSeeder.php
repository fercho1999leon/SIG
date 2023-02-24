<?php

use Illuminate\Database\Seeder;
use App\Supply;
use App\Matter;
use App\Parcial;
use App\Activity;
class ExamenesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $matters = Matter::all();

        $configuracion = Parcial::find(1);

        foreach($matters as $matter)
        {
            $supply = Supply::where(['idMateria' => $matter->id, 'nombre' => 'EXAMEN QUIMESTRAL'])->first();

            if($supply == null){
                $supply = new Supply();
                $supply->nombre = "EXAMEN QUIMESTRAL";
                $supply->idCurso = $matter->idCurso;
                $supply->idMateria = $matter->id;
                $supply->idDocente = $matter->idDocente;
    
                $supply->save();    
            }
            
            if($configuracion->exq1FI != null && $configuracion->exq1FF != null){
            
                $activity = new Activity();

                $activity->nombre = "EXAMEN QUIMESTRAL";
                $activity->descripcion = "";
                $activity->fechaInicio = $configuracion->exq1FI;
                $activity->fechaEntrega = $configuracion->exq1FF;
                $activity->idInsumo = $supply->id;
                $activity->parcial = "q1";
                $activity->calificado = 1;
                $activity->refuerzo = 0;
                $activity->save();
            }

            if($configuracion->exq2FI != null && $configuracion->exq2FF != null){
            
                $activity = new Activity();

                $activity->nombre = "EXAMEN QUIMESTRAL";
                $activity->descripcion = "";
                $activity->idInsumo = $supply->id;
                $activity->fechaInicio = $configuracion->exq2FI;
                $activity->fechaEntrega = $configuracion->exq2FF;
                $activity->parcial = "q2";
                $activity->calificado = 1;
                $activity->refuerzo = 0;
                $activity->save();
            }
        }
    }
}
