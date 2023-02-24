<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use App\rangosCualitativo;

class EstructuraCualitativaSeeder extends Seeder {
    public function run(){
        DB::beginTransaction();
            //Estructura y rangos para Desarrollo Humano Integral
            $estructura1 = DB::table('estructura_cualitativas')->insertGetId([
                'nombre' => 'DHI',
                'created_at' => Carbon::now()->format('Y-m-d'),
                'updated_at' => Carbon::now()->format('Y-m-d'),
            ]);
            $rango = new rangosCualitativo;
            $rango->rangoI = 0.01;
            $rango->rangoF = 6.99;
            $rango->nota = "Crítica";
            $rango->idEstructura = $estructura1;
            $rango->save();

            $rango = new rangosCualitativo;
            $rango->rangoI = 7;
            $rango->rangoF = 8.50;
            $rango->nota = "Media";
            $rango->idEstructura = $estructura1;
            $rango->save();

            $rango = new rangosCualitativo;
            $rango->rangoI = 8.51;
            $rango->rangoF = 10;
            $rango->nota = "Positiva";
            $rango->idEstructura = $estructura1;
            $rango->save();

            //Estructura y rangos para Proyectos Escolares
            $estructura2 = DB::table('estructura_cualitativas')->insertGetId([
                'nombre' => 'Proyectos Escolares',
                'created_at' => Carbon::now()->format('Y-m-d'),
                'updated_at' => Carbon::now()->format('Y-m-d'),
            ]);
            $rango = new rangosCualitativo;
            $rango->rangoI = 0.01;
            $rango->rangoF = 4;
            $rango->nota = "R";
            $rango->idEstructura = $estructura2;
            $rango->save();

            $rango = new rangosCualitativo;
            $rango->rangoI = 4.01;
            $rango->rangoF = 6.99;
            $rango->nota = "B";
            $rango->idEstructura = $estructura2;
            $rango->save();

            $rango = new rangosCualitativo;
            $rango->rangoI = 7;
            $rango->rangoF = 8.99;
            $rango->nota = "MB";
            $rango->idEstructura = $estructura2;
            $rango->save();

            $rango = new rangosCualitativo;
            $rango->rangoI = 9;
            $rango->rangoF = 10;
            $rango->nota = "EX";
            $rango->idEstructura = $estructura2;
            $rango->save();
        DB::commit();
    }
}