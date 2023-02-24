<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Sentinel;

class UnidadPeriodica extends Model
{
    protected $table = 'unidad_periodicas';
      protected $fillable = [
        'nombre', 'identificador', 'activo', 'idPeriodo'
    ];
    public static function unidadP() {
        return UnidadPeriodica::where('idPeriodo', Sentinel::getUser()->idPeriodoLectivo)
        ->where('activo',1)->get();
    }
}
