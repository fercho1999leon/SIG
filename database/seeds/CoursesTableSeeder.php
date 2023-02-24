<?php

use Illuminate\Database\Seeder;

class CoursesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
     
    	$sentences = array('PRIMERO','SEGUNDO','TERCERO','CUARTO','QUINTO','SEXTO','SEPTIMO',
    		'OCTAVO','NOVENO','DECIMO');
        for ($i=1; $i < 3; $i++){
            \DB::table('courses')->insert(array(
            'grado'     =>  'Inicial '.$i,
            'paralelo'  =>  'A',
            'seccion'   =>  'EI',
            
            ));
        }

        $sentences_1 = array('PRIMERO','SEGUNDO');
        foreach($sentences_1 as $key => $value){
        \DB::table('courses')->insert(array(
            'grado' =>  $value,
            'paralelo'  =>  'A',
            'seccion'   =>  'EGB',
            
            )); 
        }

        
        $sentences_2 = array('TERCERO');
        foreach($sentences_2 as $key => $value){
        \DB::table('courses')->insert(array(
            'grado' =>  $value,
            'paralelo'  =>  'A',
            'seccion'   =>  'EGB',
            
            )); 
        }


        $sentences_3 = array('TERCERO');
        foreach($sentences_3 as $key => $value){
        \DB::table('courses')->insert(array(
            'grado' =>  $value,
            'paralelo'  =>  'B',
            'seccion'   =>  'EGB',
            
            )); 
        }
        
        
        $sentences_4 = array('CUARTO','QUINTO','SEXTO','SEPTIMO', 'OCTAVO','NOVENO');        
        foreach($sentences_4 as $key => $value){
        \DB::table('courses')->insert(array(
        	'grado'	=>	$value,
        	'paralelo'	=>	'A',
        	'seccion'	=>	'EGB',
            
        	));	
        }

        /*
        $sentences_4 = array('CUARTO','QUINTO','SEXTO','SEPTIMO', 'OCTAVO','NOVENO', 'DECIMO');        
        foreach($sentences_4 as $key => $value){
        \DB::table('courses')->insert(array(
            'grado' =>  $value,
            'paralelo'  =>  'A',
            'seccion'   =>  'EGB',
            
            )); 
        }
        
        $sentences_5 = array('Primero de Bachillerato','Segundo de Bachillerato','Tercero de Bachillerato');        
        foreach($sentences_5 as $key => $value){
        \DB::table('courses')->insert(array(
            'grado' =>  $value,
            'paralelo'  =>  ' Informática',
            'seccion'   =>  'BGU',
            
            )); 
        }    

        $sentences_6 = array('Primero de Bachillerato','Segundo de Bachillerato','Tercero de Bachillerato');        
        foreach($sentences_6 as $key => $value){
        \DB::table('courses')->insert(array(
            'grado' =>  $value,
            'paralelo'  =>  ' Contabilidad',
            'seccion'   =>  'BGU',
            
            )); 
        }      

        $sentences_7 = array('Primero de Bachillerato','Segundo de Bachillerato','Tercero de Bachillerato');        
        foreach($sentences_7 as $key => $value){
        \DB::table('courses')->insert(array(
            'grado' =>  $value,
            'paralelo'  =>  ' Ciencias',
            'seccion'   =>  'BGU',
            
            )); 
        } 
        */     

    }
}
