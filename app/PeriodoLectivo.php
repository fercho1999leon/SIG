<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PeriodoLectivo extends Model
{
    protected $table = "periodo_lectivo";
      protected $fillable = [
        'nombre', 'regimen', 'fecha_inicial', 'fecha_final'
    ];

    public static function getPeriodo($periodo){
    	if ($periodo==NULL){
    		return "";
    	}else{
    		$periodoLectivo = PeriodoLectivo::find($periodo);
    		return $periodoLectivo->nombre;
    	}
    }
}
