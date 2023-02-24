<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ParcialPeriodico extends Model
{
    protected $table = 'parcial_periodicos';
     protected $fillable = [
        'nombre', 'identificador', 'activo', 'idUnidad','fechaI','fechaF','idPeriodo'
    ];
     public static function parcialP($unidad) {
        return ParcialPeriodico::where('activo',1)
        ->where('idUnidad',$unidad)->get();
    }
}
