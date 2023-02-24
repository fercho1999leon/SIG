<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Sentinel;

class CourseSchedule extends Model
{
    protected $table = 'courseschedules';

    protected $fillable = [
        'dia1', 'dia2', 'dia3', 'dia4', 'dia5', 'dia6', 'dia7', 'idCurso'
    ];

    public function asistencia()
    {
        return $this->hasMany('App\DailyAsistance', 'idSchedule');
    }

    public static function getScheduleByCourse($idCurso)
    {
        return CourseSchedule::query()
            ->where('idCurso', $idCurso)
            ->where('idPeriodo', Sentinel::getUser()->idPeriodoLectivo)
            ->orderBy('horaInicio')
            ->get();
    }
}
