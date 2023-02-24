<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Sentinel;

class Comportamiento extends Model
{
    protected $table = 'comportamiento';
	protected $fillable = ['idStudent', 'parcial', 'nota', 'idPeriodo', 'observacion'];

	public static function ComportamientoCualitativo($idStudent,$parcial)
    {
        return Comportamiento::where('idPeriodo', Sentinel::getUser()->idPeriodoLectivo)
        	->where('parcial',$parcial)
        	->where('idStudent',$idStudent)
            ->first();
    }
}
