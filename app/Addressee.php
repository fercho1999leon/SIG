<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Addressee extends Model
{
    protected $table = 'addressee_tbl';

	protected $fillable = ['addressee_title','addressee_name','addressee_departament'];


    //
    //public function getRouteKeyName()
    //{
    //    return redirect()->route('UsersViews.administrador.carreras.index');
    //}
}
