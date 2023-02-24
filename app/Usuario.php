<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Usuario extends Model
{
	protected $table = 'users'; 

	public function scopeName($query, $name) {
		if($name) {
			$x = $query->where('nombres', 'LIKE', "%$name%")->orWhere('apellidos', 'LIKE', "%$name%");
			return $x;
		}
	}

	public function materias () {
		return $this->hasMany('App\Matter', 'idDocente');
	}

	public function profile() {
		return $this->hasOne(User::class, 'userid');
	}
	
}
