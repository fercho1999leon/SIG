<?php

use Illuminate\Database\Seeder;

class AreasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        // Bachillerato General Unificado y Educacion General Basica
        $areas = array('Lengua y Literatura', 'Lengua Extranjera', 'Matemática', 'Ciencias Naturales',
        'Ciencias Sociales', 'Educasión Física', 'Educasión Cultural y Artística');
        //$seccion = array('BGU', 'EGB');
        $seccion = array('EGB');
        foreach ($areas as $key => $value) {
            foreach ($seccion as $keysecc => $valuesecc) {
                \DB::table('areas')->insert(array(
                    'nombre' => $value,
                    'seccion'   =>  $valuesecc,
                    'observacion'  => '',                  
                    'especializacion' => '',
                    'idPeriodo' => 2
                ));
            }
        }          


        // Bachillerato General Unificado materia faltante
        $areas = array('Interdisciplinar');
        $seccion = array('BGU');
        foreach ($areas as $key => $value) {
            foreach ($seccion as $keysecc => $valuesecc) {
                \DB::table('areas')->insert(array(
                    'nombre' => $value,
                    'seccion'   =>  $valuesecc,
                    'observacion'  => '',                  
                    'especializacion' => '',
                    'idPeriodo' => 2
                ));
            }
        }


        // Educacion Inicial
        $areas = array('Identidad y autonomía','Convivencia',
        'Descubrimiento y comprensión del medio natural y cultural',
        'Relaciones con el medio natura y cultural', 'Relaciones lógico-matemáticas',
        'Comprensión y expresión oral y escrita','Comprensión y expresión del lenguaje',
        'Comprensión y expresión artística', 'Expresión artística ', 'Expresión corporal y motricidad',
        'Expresión corporal');
        $seccion = array('EI');
        foreach ($areas as $key => $value) {
            foreach ($seccion as $keysecc => $valuesecc) {
                \DB::table('areas')->insert(array(
                    'nombre' => $value,
                    'seccion'   =>  $valuesecc,
                    'observacion'  => '',                  
                    'especializacion' => '',
                    'idPeriodo' => 2
                ));
            }
        }

    }
}
