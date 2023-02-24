<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Sentinel;
class Area extends Model
{
	protected $table = 'areas';

	protected $fillable = ['nombre', 'observacion', 'dependiente','especializacion', 'seccion', 'idPeriodo','posicion'];

	public static function getAllAreas() {
		return Area::query()
			->orderBy('nombre')
			->where('idPeriodo', Sentinel::getUser()->idPeriodoLectivo)
			->get();
	}

	public static function areasBySection($area) {
		return Area::query()
			->where('seccion', $area)
			->where('idPeriodo', Sentinel::getUser()->idPeriodoLectivo)
			->orderBy('posicion')
			->get();
	}
}
