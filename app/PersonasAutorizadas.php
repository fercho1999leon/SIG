<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Sentinel;
class PersonasAutorizadas extends Model
{
	protected $table = 'personas_autorizadas';
	protected $guarded = [];

	public function estudiantesAutorizados() {
		return $this->belongsToMany('App\Student2', 'personas_autorizadas_estudiantes', 'idPersonaAutorizada', 'idEstudiante');
	}

	public static function getAll() {
		return PersonasAutorizadas::where('idPeriodo', Sentinel::getUser()->idPeriodoLectivo)
		->get();
	}

	public function scopeSearch($query, $search) {
		$query->when($search, function($query, $search) {
			$query->where('nombres', 'like', "%{$search}%");
		});
	}
}
