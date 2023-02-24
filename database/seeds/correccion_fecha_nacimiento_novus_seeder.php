<?php

use Illuminate\Database\Seeder;
use App\Student2;

class correccion_fecha_nacimiento_novus_seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $estudiantes = Student2::all();
        //echo $estudiantes;

        foreach($estudiantes as $estudiante){
      		$ci="";
			if(strlen($estudiante->ci)==9){
				$estudiante->ci='0'.$estudiante->ci;
				//$estudiante->save();
			}

			if(substr($estudiante->fechaNacimiento, -5, 1)=='/'){
				$date=str_replace('/', '-', $estudiante->fechaNacimiento);
				$estudiante->fechaNacimiento=date('Y-m-d', strtotime($date));
				//echo $estudiante->fechaNacimiento."     ";
				//$estudiante->save();
			}else{
				echo 'No debe cambiarse_'.$estudiante->fechaNacimiento.'    ';
			}
			
			$estudiante->save();
			    	
        }




    }
}
