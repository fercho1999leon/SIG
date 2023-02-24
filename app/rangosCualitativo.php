<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class rangosCualitativo extends Model
{
    public static function getCalificacionCualitativa($idEstructura,$nota)
    {
        return rangosCualitativo::where('idEstructura',$idEstructura)
        ->where([
            ['rangoI', '<=',$nota],
            ['rangoF', '>=', $nota]
        ])->select('nota','descripcion')
        ->first();
    }
    public static function getCalificacionCualitativadhi($nota)
    {
        return rangosCualitativo::where('nota',$nota)
        ->first();
    }
}
