<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Sentinel;

class ConfiguracionesParcial extends Model
{
	protected $table = 'configuracionesparcial';
	
	public static function parcialActual() {
		$fechaActual = Carbon::now()->format('Y-m-d');
		$parcial1 = ConfiguracionesParcial::query()
			->where('idPeriodo', Sentinel::getUser()->idPeriodoLectivo)
			->whereDate('p1q1FI', '<=', $fechaActual)
			->whereDate('p1q1FF', '>=', $fechaActual)
			->first();

		$parcial2 = ConfiguracionesParcial::query()
			->where('idPeriodo', Sentinel::getUser()->idPeriodoLectivo)
			->whereDate('p2q1FI', '<=', $fechaActual)
			->whereDate('p2q1FF', '>=', $fechaActual)
			->first();

		$parcial3 = ConfiguracionesParcial::query()
			->where('idPeriodo', Sentinel::getUser()->idPeriodoLectivo)
			->whereDate('p3q1FI', '<=', $fechaActual)
			->whereDate('p3q1FF', '>=', $fechaActual)
			->first();

		$parcial4 = ConfiguracionesParcial::query()
			->where('idPeriodo', Sentinel::getUser()->idPeriodoLectivo)
			->whereDate('p1q2FI', '<=', $fechaActual)
			->whereDate('p1q2FF', '>=', $fechaActual)
			->first();

		$parcial5 = ConfiguracionesParcial::query()
			->where('idPeriodo', Sentinel::getUser()->idPeriodoLectivo)
			->whereDate('p2q2FI', '<=', $fechaActual)
			->whereDate('p2q2FF', '>=', $fechaActual)
			->first();

		$parcial6 = ConfiguracionesParcial::query()
			->where('idPeriodo', Sentinel::getUser()->idPeriodoLectivo)
			->whereDate('p3q2FI', '<=', $fechaActual)
			->whereDate('p3q2FF', '>=', $fechaActual)
			->first();

		if($parcial1 != null) {
			return $parcial_actual = "p1q1";
		} else if($parcial2 != null) {
			return $parcial_actual = "p2q1";
		} else if($parcial3 != null) {
			return $parcial_actual = "p3q1";
		} else if($parcial4 != null) {
			return $parcial_actual = "p1q2";
		} else if($parcial5 != null) {
			return $parcial_actual = "p2q2";
		} else if($parcial6 != null) {
			return $parcial_actual = "p3q2";
		} else {
			return $parcial_actual = null;
		}
    }
    
    public static function getParcial() {
        return ConfiguracionesParcial::query()
            ->where('idPeriodo', Sentinel::getUser()->idPeriodoLectivo)
            ->first();
    }
}
