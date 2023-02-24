<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Matters extends Model
{
    protected $table = 'Matters';

	protected $fillable = ['nombmatter','semest_id'];

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