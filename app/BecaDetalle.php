<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BecaDetalle extends Model
{
	protected $table = "becas_detalle";
	
	public function student() {
		return $this->belongsTo('App\Student2', 'idEstudiante');
	}
	
	public function students() {
		return $this->hasMany('App\Student2', 'idEstudiante');
	}
	
	public function beca() {
		return $this->belongsTo('App\BecaDescuento', 'idBeca');
	}
}
