<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Notificaciones extends Model
{
	protected $table = 'notificaciones';
	protected $fillable = ['seccion', 'idUser', 'idEstudiante', 'mensaje', 'ruta', 'leido', 'perfil','idActivity', 'tipoActividad', 'idPeriodo'];

	public static function obtenerParcialActual($parcial) {
		switch ($parcial) {
			case 'p1q1':
				return $parcial = 'Primer Parcial del Primer Quimestre';
				break;
			case 'p2q1':
				return $parcial = 'Segundo Parcial del Primer Quimestre';
				break;
			case 'p3q1':
				return $parcial = 'Tercer Parcial del Primer Quimestre';
				break;
			case 'p1q2':
				return $parcial = 'Primer Parcial del Segundo Quimestre';
				break;
			case 'p2q2':
				return $parcial = 'Segundo Parcial del Segundo Quimestre';
				break;
			case 'p3q2':
				return $parcial = 'Tercer Parcial del Segundo Quimestre';
				break;
			default:
				# code...
				break;
		}
	}
	
	public static function fechaActual($year, $month, $day) {
		$fecha = Carbon::createFromDate($year, $month,  $day)->format('d/m/Y');
		return $fecha;
	}

	public function actividad() {
		return $this->belongsTo('App\Activity', 'idActivity');
	}

	public function leccionarioEstudiantil() {
		return $this->belongsTo('App\LeccionarioEstudiantil', 'idLeccionarioEstudiantil');
	}

	public function comportamiento() {
		return $this->belongsTo('App\Comportamiento', 'idComportamiento');
	}
}
