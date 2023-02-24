<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class comportamientoMateria extends Model
{
    protected $table = 'comportamientoMateria';
    protected $fillable = ['id','idStudent', 'parcial', 'nota', 'idPeriodo', 'observacion','idMateria'];
    public function ComportamientoEstudiante(){
        //return $this->belongsToMany('App\Student2','id','idStudent');
        return $this->hasOne('App\Student2','id','Student2');
    }
}