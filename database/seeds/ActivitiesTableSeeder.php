<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Student2 as Student;

class ActivitiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

      /*$faker = Faker::create();
       	$insumos = \DB::table('supplies')->get();
        foreach ($insumos as $key => $value) {
        	for($i = 1 ;$i < 4; $i++){
            $students = \DB::table('students2')->where('idCurso','=',$value->idCurso)->get();
              $notas = array();
              foreach ($students as $keystudent => $valuestudent) {
               $notas[$valuestudent->id] = rand(6,10);
              }
            	\DB::table('activities')->insert([
        			'nombre' => 'Actividad '.$i,
        			'idInsumo'	=>	$value->id,
              'fechaInicio' => $faker->date($format = 'Y-m-d',$min= '2018-01-01', $max = '2018-04-28'),
              'fechaEntrega' => $faker->date($format = 'Y-m-d',$min= '2018-01-01', $max = '2018-04-28'),
              'calificaciones'  => json_encode($notas)
        		]);
        	}
        }*/

       /*	$insumos = \DB::table('supplies')->get();
       			foreach ($insumos as $keyinsumo => $valueinsumo) {
       				$Activities = \DB::table('activities')->where('idInsumo','=',$valueinsumo->id)->get();
       				foreach ($Activities as $key => $value) {
       					$students = \DB::table('students2')->where('idCurso','=',$valueinsumo->idCurso)->get();
       				foreach ($students as $keystudent => $valuestudent) {
       					\DB::table('calificacionesactividad')->insert([
       				 'idEstudiante'	=>	$valuestudent->id,
               'idActividad'	=>	$value->id,
               'idInsumo' => $valueinsumo->id,
       				 'nota'	=>	rand(6.5,10),
       			]);
       				}

       				}

             }*/

      // Algoritmo para migracion de calificaciones 
            
        $activities = \DB::table('activities')->get();
        //echo $activities;
        foreach ($activities as $keyactivity => $valueactivity) {
          $cali = (array) json_decode($valueactivity->calificaciones);
           
          foreach($cali as $key => $value){
            //echo ' '.$key.' => '.$value;
            $exist = Student::where('id',$key)->get()->first();
            if($exist){
            \DB::table('calificacionesactividad')->insert([
              'idActividad' =>    $valueactivity->id,
              'idEstudiante'  =>  $key,
              'nota'        =>    $value,
              'idInsumo'  =>    $valueactivity->idInsumo
            ]);
            }
          }
        }
        

    }
}
