<?php

namespace App;

use Cartalyst\Sentinel\Sentinel;
use Illuminate\Database\Eloquent\Model;

class calificacionCualitativaAmbitos extends Model
{
    public static function NotaCualitativaQuimestral($idMateria,$idStudent,$parcial){
        return calificacionCualitativaAmbitos::where('idStudent',$idStudent)
            ->where('Parcial',$parcial)
            ->where('idMateria',$idMateria)
            ->first();
    }

    public static function calificacionesCurso($idCurso){

        $materias = Matter::getMattersByCourseConfig($idCurso);

        return calificacionCualitativaAmbitos::whereIn('idMateria', $materias->pluck('id'))->get();
    }
}
