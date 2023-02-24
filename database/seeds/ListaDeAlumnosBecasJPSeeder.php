<?php

use Illuminate\Database\Seeder;
use App\PagoRealizado;
use App\BecasYDescuentos;

class ListaDeAlumnosBecasJPSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$opcionBeca1 = array(579);
        //Opción de Beca Id-1
        foreach ($opcionBeca1 as $key) {
       		\DB::table('pagosrealizar')
                    ->where('idEstudiante', $key)
                    ->update(['beca'    => 1]);
        }

    	$opcionBeca2 = array();
        //Opción de Beca Id-2

        $opcionBeca3 = array();
        //Opción de Beca Id-3

        $opcionBeca4 = array();
        //Opción de Beca Id-4

        $opcionBeca5 = array();
        //Opción de Beca Id-5

        $opcionBeca6 = array();
    	//Opción de Beca Id-6

    	$opcionBeca7 = array();
        //Opción de Beca Id-7

        $opcionBeca8 = array();
        //Opción de Beca Id-8

        $opcionBeca9 = array();
        //Opción de Beca Id-9

        $opcionBeca10 = array();
        //Opción de Beca Id-10

        $opcionBeca11 = array();
        //Opción de Beca Id-11

        $opcionBeca12 = array();
    	//Opción de Beca Id-12

    	$opcionBeca13 = array();
        //Opción de Beca Id-13

        $opcionBeca14 = array();
        //Opción de Beca Id-14

        $opcionBeca15 = array();
        //Opción de Beca Id-15

        $opcionBeca16 = array();
        //Opción de Beca Id-16

        $opcionBeca17 = array();
        //Opción de Beca Id-17

        $opcionBeca18 = array();
        //Opción de Beca Id-18

        $opcionBeca19 = array();
        //Opción de Beca Id-19

        $opcionBeca20 = array();
        //Opción de Beca Id-20

        $opcionBeca21 = array();
        //Opción de Beca Id-21

        $opcionBeca22 = array();
        //Opción de Beca Id-22

        $opcionBeca23 = array();
        //Opción de Beca Id-23

        $opcionBeca24 = array();
        //Opción de Beca Id-24
    }
}
