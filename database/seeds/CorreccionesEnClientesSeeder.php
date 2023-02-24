<?php

use Illuminate\Database\Seeder;
use App\Cliente;

class CorreccionesEnClientesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $clientes = Cliente::all();
        $cont = 0;
        foreach ($clientes as $cliente) {
        	if(strlen($cliente->cedula_ruc)==9){
        		$cliente->cedula_ruc='0'.$cliente->cedula_ruc;
        		$cliente->save();
        	}
        	if(strlen($cliente->cedula_ruc)==12){
        		$cliente->cedula_ruc='0'.$cliente->cedula_ruc;
        		$cliente->save();
        	}
			$cantidad=strlen($cliente->cedula_ruc);
        	if($cantidad!=10){
	        	if($cantidad!=13){
	        		echo $cliente->id.':'.$cliente->cedula_ruc.'     ';
	        		$cont++;			
	        	}
        	}
        }
        echo '___'.$cont;
    }
}
