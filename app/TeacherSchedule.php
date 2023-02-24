<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TeacherSchedule extends Model
{
    protected $table = 'teacherschedules';

    protected $fillable = [
    	'horaInicio','horaFin','dia1', 'dia2', 'dia3', 'dia4', 'dia5', 'dia6','idDia1', 'idDia2', 'idDia3', 'idDia4', 'idDia5', 'idDia6',
    ];
}
