<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Student2;
use App\PagoRealizado;

class BecasYDescuentos extends Model
{
    protected $table = 'descybecas';

    protected $fillable = [
    	'tipo', 'nombre', 'descripcion', 'valor', 'porcentaje' 
    ];

    public static function beca($id){
    	$student = Student2::findOrFail($id);
    	$pagos = PagoRealizado::where('idEstudiante', $id)->get();
    	$becas = BecasYDescuentos::all();

    	$beca = 0;
    	$idBeca = 0;

    	//Iteración para extraer id de la beca
    	foreach ($pagos as $p) {
    		if( $p->beca!=null){
    			$idBeca = $p->beca;
    		}
    	}

    	//Iteración para extraer la beca
    	foreach ($becas as $b) {
    		if( $b->id==$idBeca ){
    			$beca = $b;
    		}
    	}
    	return $beca;
    }

}
