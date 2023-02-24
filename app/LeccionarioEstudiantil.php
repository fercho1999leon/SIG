<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LeccionarioEstudiantil extends Model
{
	
	protected $table = 'leccionario_estudiantil';
	protected $guarded = [];
	
	public function student() {
		return $this->belongsTo('App\Student2', 'idEstudiante');
	}
	public function activity() {
		return $this->belongsTo('App\Lectionary', 'idLectionary');
	}
}
