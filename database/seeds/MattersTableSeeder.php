<?php

use Illuminate\Database\Seeder;
use App\Course;
use App\PeriodoLectivo;

class MattersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $periodo = PeriodoLectivo::where('nombre', '2019-2020')->first();

        //Inicial 1 y 2
        $matters = array('DESCUBRIMIENTO Y COMPRENSIÓN DEL MEDIO NATURAL Y CULTURAL','INGLES','COMPRENSIÓN Y EXPRESIÓN ARTÍSTICA','COMPRENSIÓN Y EXPRESIÓN ORAL Y ESCRITA','CONVIVENCIA','EXPRESIÓN CORPORAL','IDENTIDAD Y AUTONOMÍA','RELACIONES LÓGICO MATEMÁTICO','COMPUTACION','PROYECTOS ESCOLARES');
        $courses1 = Course::where('idPeriodo', $periodo->id)
                ->where(function($q) {
                    $q->where('grado', 'Inicial 1')
                    ->orWhere('grado', 'Inicial 2');
                })->get();
        foreach ($courses1 as $course) {
            foreach ($matters as $key => $value) {
                \DB::table('matters')->insert(array(
                    'nombre'    => $value,
                    'idCurso'   => $course->id,
                    'idDocente' => null,
                    'visible'   => 1,
                    'principal' => 1,
                    'idArea'    => null,
                    'idPeriodo' => $periodo->id
                ));
            }
        }
        echo count($courses1).'  ';

        //Primero
        $matters = array('RELACIONES LÓGICO MATEMÁTICO','DESCUBRIMIENTO Y COMPRENSIÓN DEL MEDIO NATURAL Y CULTURAL','COMPRENSIÓN Y EXPRESIÓN ORAL Y ESCRITA','COMPRENSIÓN Y EXPRESIÓN ARTÍSTICA','EXPRESIÓN CORPORAL','CULTURA FISICA','INGLES','CONVIVENCIA','IDENTIDAD Y AUTONOMÍA','COMPUTACION','PROYECTOS ESCOLARES');
        $courses2 = Course::where(['idPeriodo'=>$periodo->id,'grado'=>'Primero'])->get();
        foreach ($courses2 as $course) {
            foreach ($matters as $key => $value) {
                \DB::table('matters')->insert(array(
                    'nombre'    => $value,
                    'idCurso'   => $course->id,
                    'idDocente' => null,
                    'visible'   => 1,
                    'principal' => 1,
                    'idArea'    => null,
                    'idPeriodo' => $periodo->id
                ));
            }
        }
        echo count($courses2).'  ';

        //Segundo a Séptimo
        $matters = array('LENGUA Y LITERATURA','MATEMATICA','CIENCIAS NATURALES','ESTUDIOS SOCIALES','EDUCACION CULTURAL Y ARTISTICA','CULTURA FISICA','INGLES','COMPUTACION','PROYECTOS ESCOLARES');
        $courses3 =Course::where('idPeriodo', $periodo->id)
                ->where(function($q) {
                    $q->Where('grado', 'Segundo')
                    ->orWhere('grado', 'Tercero')
                    ->orWhere('grado', 'Cuarto')
                    ->orWhere('grado', 'Quinto')
                    ->orWhere('grado', 'Sexto')
                    ->orWhere('grado', 'Septimo');
                })->get();
        foreach ($courses3 as $course) {
            foreach ($matters as $key => $value) {
                \DB::table('matters')->insert(array(
                    'nombre'    => $value,
                    'idCurso'   => $course->id,
                    'idDocente' => null,
                    'visible'   => 1,
                    'principal' => 1,
                    'idArea'    => null,
                    'idPeriodo' => $periodo->id
                ));
            }
        }
        echo count($courses3).'  ';

        //Octavo a Decimo
        $matters = array('LENGUA Y LITERATURA','MATEMATICA','CIENCIAS NATURALES','ESTUDIOS SOCIALES','EDUCACION CULTURAL Y ARTISTICA','CULTURA FISICA','INGLES','COMPUTACION','PROYECTOS ESCOLARES','COMERCIO');
        $courses4 =Course::where('idPeriodo', $periodo->id)
                ->where(function($q) {
                    $q->Where('grado', 'Octavo')
                    ->orWhere('grado', 'Noveno')
                    ->orWhere('grado', 'Decimo');
                })->get();
        foreach ($courses4 as $course) {
            foreach ($matters as $key => $value) {
                \DB::table('matters')->insert(array(
                    'nombre'    => $value,
                    'idCurso'   => $course->id,
                    'idDocente' => null,
                    'visible'   => 1,
                    'principal' => 1,
                    'idArea'    => null,
                    'idPeriodo' => $periodo->id
                ));
            }
        }
        echo count($courses4).'  ';        

        //1ro  a 3ro de bachillerato
        $courses5 =Course::where('idPeriodo', $periodo->id)
                ->where(function($q) {
                    $q->Where('grado', 'Primero de Bachillerato')
                    ->orWhere('grado', 'Segundo de Bachillerato')
                    ->orWhere('grado', 'Tercero de Bachillerato');
                })->get();
        echo count($courses5).'  ';         
       

    }
}
