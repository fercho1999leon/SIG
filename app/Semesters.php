<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Semesters extends Model
{
    protected $table = 'Semesters';

	protected $fillable = ['nombsemt','career_id', 'cuotas', 'costo_semestre','vencimiento_cuotas','inicio_semestre'];

    //
    //public function getRouteKeyName()
    //{
    //    return redirect()->route('UsersViews.administrador.carreras.index');
    //}
    public function Career()
    {
        return $this->hasMany('App\Career');
    }
}