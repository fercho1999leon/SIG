<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Sentinel;

class Rubro extends Model
{
	protected $table = 'rubros';
	protected $guarded = [''];
    public static function getRubros() {
		return Rubro::where('idPeriodo', Sentinel::getUser()->idPeriodoLectivo)
			->get();
	}

	public function setTipoRubroAttribute($value) {
		$this->attributes['tipo_rubro'] = ucfirst(strtolower($value));
	}

	public function setTipoEmisionAttribute($value) {
		$this->attributes['tipo_emision'] = strtoupper($value);
	}

}
