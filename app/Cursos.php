<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cursos extends Model
{
    protected $table = 'Cursos';

	protected $fillable = ['nombre','semestre_id','paralelo','num_studs','dirigente'];

    //
    //public function getRouteKeyName()
    //{
    //    return redirect()->route('UsersViews.administrador.carreras.index');
    //}
    //public function Career()
    //{
    //    return $this->hasMany('App\Career');
    //}
}