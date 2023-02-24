<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pago extends Model
{
    protected $table = 'pagos';

    protected $fillable = [
    	'idCurso', 'mes', 'tipo', 'descripcion', 'valor'
    ];

    /*
		Método para obtener los pagos que se realiza en el curso
    */
    public static function pagoCurso($idCurso){
    	return Pago::where('idCurso', $idCurso)->get();
    }
}
