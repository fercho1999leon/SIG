<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Sentinel;

class Parcial extends Model
{
    protected $table = 'configuracionesparcial';

    protected $fillable = [
        /* Primer Quimestre */
        'p1q1FI', 'p1q1FF', 'p2q1FI', 'p2q1FF', 'p3q1FI', 'p3q1FF',
        /* Segundo Quimestre */
        'p1q2FI', 'p1q2FF', 'p2q2FI', 'p2q2FF', 'p3q2FI', 'p3q2FF',
    ];

    public static function getParcial()
    {
        return Parcial::where('idPeriodo', Sentinel::getUser()->idPeriodoLectivo)->first();
    }

    public static function getParcialByPeriodo($idPeriodoLectivo)
    {
        return Parcial::where('idPeriodo', $idPeriodoLectivo)->first();
    }
}
