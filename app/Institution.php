<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Sentinel;

class Institution extends Model
{
    protected $table = 'institution';

    protected $fillable = [
        'lema', 'nombre',
    ];

    protected function periodoActual()
    {
        return $this->belongsTo('App\PeriodoLectivo', 'id');
    }

    public static function periodoLectivo()
    {
        $periodo = PeriodoLectivo::findOrFail(Sentinel::getUser()->idPeriodoLectivo);
        return $periodo->nombre;
    }

}
