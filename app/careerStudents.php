<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class careerStudents extends Model
{
    protected $table = 'career_students';

	protected $fillable = ['career_id','students_id','semestre_id','curso_id','estado'];


    //public function semesters()
    //{
    //    return $this->belongsTo('App\Semesters');
    //}
    //
    //public function getRouteKeyName()
    //{
    //    return redirect()->route('UsersViews.administrador.carreras.index');
    //}
}
