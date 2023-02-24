<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QuizSchedule extends Model
{
    protected $table = 'quiz_schedule';

    protected $fillable = [
    	'dia1', 'dia2', 'dia3', 'dia4', 'dia5', 'dia6', 'dia6', 'dia7', 'idCurso', 'tipo'
    ];
}
