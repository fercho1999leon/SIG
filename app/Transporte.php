<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Sentinel;

class Transporte extends Model
{
	protected $table = 'transportes';
	/**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
			'unidad', 'ruta', 'rutaDetalle', 'placa', 'chofer', 'correo', 'celular'
		];
	public static function getAllBuses() {
		return Transporte::where('idPeriodo', Sentinel::getUser()->idPeriodoLectivo)
			->where('es_privado', 0)
			->orderBy('ruta')
			->get();
	}
}
