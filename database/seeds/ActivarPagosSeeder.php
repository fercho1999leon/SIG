<?php

use Illuminate\Database\Seeder;
use App\ConfiguracionSistema;

class ActivarPagosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /*
        $configuraciones = 
            array('ACTIVAR_PAGOS', 'Se activa el módulo de COLECTURÍA', 'ADMINISTRADOR', '1');

        for ($i=0; $i < count($configuraciones); $i++) { 
            $cs = new ConfiguracionSistema();

            $cs->nombre = $configuraciones[$i][0];
            $cs->descripcion = $configuraciones[$i][1];
            $cs->categoria  = $configuraciones[$i][2];
            $cs->valor  = $configuraciones[$i][3];
            
            $cs->save();
        }
        */
        ////////////
        $configuraciones = array(
            //Docentes
            [   'nombre'  =>  'ACTIVAR_PAGOS',
                'descripcion' =>  'Se activa el módulo de COLECTURÍA',       
                'categoria'  =>   'ADMINISTRADOR', 
                'valor' => '1'
            ],
            [   'nombre'  =>  'NUEVA_MATRICULA',
                'descripcion' =>  'Se activa el módulo de Nueva Matrícula',
                'categoria'  =>   'ADMINISTRADOR',   
                'valor' => '1'
            ]   
        );
        foreach ($configuraciones as $key) {
            \DB::table('configuracionessistema')->insert(array(
                'nombre'   =>  $key['nombre'],
                'descripcion'   =>  $key['descripcion'],
                'categoria'   =>  $key['categoria'],
                'valor'   =>  $key['valor']
            ));
        } 

    }
}
