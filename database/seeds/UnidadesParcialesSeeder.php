<?php

use Illuminate\Database\Seeder;
use App\ParcialPeriodico;
use App\UnidadPeriodica;
use Faker\Factory as Faker;
use App\PeriodoLectivo;

class UnidadesParcialesSeeder extends Seeder{
    public function run(){
        $idPeriodos = PeriodoLectivo::all();
        $unidades = array(
            array('Quimestre 1', 'q1', '1'),
            array('Quimestre 2', 'q2', '1'),);
        foreach ($idPeriodos as $periodo) {
            foreach ($unidades as $key) {
                $existe = UnidadPeriodica::where('nombre',$key[0])
                    ->where('idPeriodo',$periodo->id )->exists();
                if (!$existe) {
                    $unidad_p = \DB::table('unidad_periodicas')->insertGetId(array(
                        'nombre'   =>  $key[0],
                        'identificador'      =>  $key[1],
                        'idPeriodo'   => $periodo->id,
                        'activo'   =>  $key[2]
                    ));
                }
                if ($key[1]=='q1') {
                    $parciales = array(
                        array('Q1 Parcial 1', 'p1q1', '1'),
                        array('Q1 Parcial 2', 'p2q1', '1'),
                        array('Q1 Parcial 3', 'p3q1', '0'),
                        array('Q1 Examen', 'q1', '1')
                    );
                }
                if($key[1]=='q2'){
                    $parciales = array(
                        array('Q2 Parcial 1', 'p1q2', '1'),
                        array('Q2 Parcial 2', 'p2q2', '1'),
                        array('Q2 Parcial 3', 'p3q2', '0'),
                        array('Q2 Examen', 'q2', '1')
                    );
                }
                foreach ($parciales as $key1) {
                    $existe1 = ParcialPeriodico::where('nombre',$key1[0])
                        ->where('idUnidad', $unidad_p)->exists();
                    if (!$existe1) {
                        \DB::table('parcial_periodicos')->insert(array(
                            'nombre'   =>  $key1[0],
                            'identificador'   =>  $key1[1],
                            'idUnidad'   => $unidad_p,
                            'activo'   =>  $key1[2]
                        ));
                    }
                }
            }
        }
    }
}