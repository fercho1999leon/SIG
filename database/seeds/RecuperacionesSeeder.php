<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use App\Supply;
use App\Matter;
use App\Parcial;
use App\Activity;

class RecuperacionesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $matters = Matter::all();

        foreach($matters as $matter)
        {
            $supply = Supply::where(['idMateria' => $matter->id, 'nombre' => 'RECUPERATORIO'])->first();

            if($supply == null){
                $supply = new Supply();
                $supply->nombre = "RECUPERATORIO";
                $supply->idCurso = $matter->idCurso;
                $supply->idMateria = $matter->id;
                $supply->idDocente = $matter->idDocente;
    
                $supply->save();    
            }
            
            
            $activity = new Activity();

            $activity->nombre = "RECUPERACION";
            $activity->descripcion = "";
            $activity->fechaInicio = Carbon::now();
            $activity->fechaEntrega = Carbon::now();
            $activity->idInsumo = $supply->id;
            $activity->parcial = "q1";
            $activity->calificado = 1;
            $activity->refuerzo = 0;
            $activity->save();

            $activity = new Activity();

            $activity->nombre = "RECUPERACION";
            $activity->descripcion = "";
            $activity->fechaInicio = Carbon::now();
            $activity->fechaEntrega = Carbon::now();
            $activity->idInsumo = $supply->id;
            $activity->parcial = "q2";
            $activity->calificado = 1;
            $activity->refuerzo = 0;
            $activity->save();


            $activity = new Activity();

            $activity->nombre = "SUPLETORIO";
            $activity->descripcion = "";
            $activity->fechaInicio = Carbon::now();
            $activity->fechaEntrega = Carbon::now();
            $activity->idInsumo = $supply->id;
            $activity->parcial = "supletorio";
            $activity->calificado = 1;
            $activity->refuerzo = 0;
            $activity->save();

            $activity = new Activity();

            $activity->nombre = "REMEDIAL";
            $activity->descripcion = "";
            $activity->fechaInicio = Carbon::now();
            $activity->fechaEntrega = Carbon::now();
            $activity->idInsumo = $supply->id;
            $activity->parcial = "remedial";
            $activity->calificado = 1;
            $activity->refuerzo = 0;
            $activity->save();

            $activity = new Activity();

            $activity->nombre = "GRACIA";
            $activity->descripcion = "";
            $activity->fechaInicio = Carbon::now();
            $activity->fechaEntrega = Carbon::now();
            $activity->idInsumo = $supply->id;
            $activity->parcial = "gracia";
            $activity->calificado = 1;
            $activity->refuerzo = 0;
            $activity->save();

        }
     }
}
