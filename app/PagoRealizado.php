<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PagoRealizado extends Model
{
    protected $table = 'pagosrealizar';

    protected $fillable = [
    	'idEstudiante', 'idPago', 'descripcion', 'factura', 'beca', 'prorroga', 'estado'
    ];

    /*
		Método para obtener los pagos realizados por el estudiante
    */
    public static function pagoARealizar($idEstudiante){
    	return PagoRealizado::where('idEstudiante', $idEstudiante)->get();
    }
}
