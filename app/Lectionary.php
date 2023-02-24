<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Matter;

class Lectionary extends Model
{
    protected $table = 'lectionaries';

    protected $fillable = [
    	'idMateria','idCurso', 'descripcion', 'observacion', 'adjuntos'
    ];

    public function getLectionayByTeacher($id){
    	return  Matter::where('idDocente', $id)->get();
	}

	public function materia() {
		return $this->belongsTo('App\Matter', 'idMateria'); 
	}

	public function scopeFecha($query, $fecha) {
		$query->when($fecha, function($query, $fecha) {
			$query->where('fecha', $fecha);
		});
	}
	
	public function observaciones() {
		return $this->hasMany('App\LeccionarioEstudiantil', 'idLectionary');
	}
	public function observacionEstudiantes() {
		return $this->hasMany('App\LeccionarioEstudiantil', 'idLectionary');
	}

}
