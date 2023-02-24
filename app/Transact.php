<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transact extends Model
{
    protected $table = 'transact_tbl';

	protected $fillable = ['title','id_destinatatio'];


   
    //
    //public function getRouteKeyName()
    //{
    //    return redirect()->route('UsersViews.administrador.carreras.index');
    //}
}
