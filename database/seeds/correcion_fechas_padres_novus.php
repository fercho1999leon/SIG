<?php

use Illuminate\Database\Seeder;
use App\Parents;

class correcion_fechas_padres_novus extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	//['fNacimiento','fecha_promocion','fecha_ingreso_pais','fecha_expiracion_pasaporte','fecha_caducidad_pasaporte']
        $padres=Parents::all();
        foreach ($padres as $padre) {
	        //Correcion de cédula, en caso que falte un 0
				if(strlen($padre->ci)==9){
					$padre->ci='0'.$padre->ci;
				}

			//Correcion de fecha de nacimiento, en caso que lo necesite
				if(substr($padre->fNacimiento, -5, 1)=='/'){
					$date=str_replace('/', '-', $padre->fNacimiento);
					$padre->fNacimiento=date('Y-m-d', strtotime($date));
				}

			//Correcion de fecha de promocion, en caso que lo necesite
				if(substr($padre->fecha_promocion, -5, 1)=='/'){
					$date=str_replace('/', '-', $padre->fecha_promocion);
					$padre->fecha_promocion=date('Y-m-d', strtotime($date));
				}

			//Correcion de fecha ingreso pais, en caso que lo necesite
				if(substr($padre->fecha_ingreso_pais, -5, 1)=='/'){
					$date=str_replace('/', '-', $padre->fecha_ingreso_pais);
					$padre->fecha_ingreso_pais=date('Y-m-d', strtotime($date));
				}

			//Correcion de fecha expiracion pasaporte, en caso que lo necesite
				if(substr($padre->fecha_expiracion_pasaporte, -5, 1)=='/'){
					$date=str_replace('/', '-', $padre->fecha_expiracion_pasaporte);
					$padre->fecha_expiracion_pasaporte=date('Y-m-d', strtotime($date));
				}

			//Correcion de fecha caducidad pasaporte, en caso que lo necesite
				if(substr($padre->fecha_caducidad_pasaporte, -5, 1)=='/'){
					$date=str_replace('/', '-', $padre->fecha_caducidad_pasaporte);
					$padre->fecha_caducidad_pasaporte=date('Y-m-d', strtotime($date));
				}

			$padre->save();
		}
    }
}
