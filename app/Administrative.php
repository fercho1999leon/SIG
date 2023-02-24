<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Administrative extends Model
{
    //referencia a tabla users_profile dettale de los usuarios
    protected $table = 'users_profile';

    protected $guarded = [];
	
	public function user() {
		return $this->belongsTo('App\Usuario', 'userid');
	}
	
    public static function findBySentinelid($id){
        return Administrative::where('userid',$id)->first();
	}
	
	public function scopeSearch($query, $search) {
		$query->when($search, function($query, $search) {
			$query->where('nombres', 'like', "%{$search}%")
			->orWhere('apellidos', 'like', "%{$search}%");
		});
	}

	public function scopePerfil($query, $perfil) {
		$query->when($perfil, function ($query, $perfil) {
			$query->where('cargo', $perfil);
		});
	}
	
	public function hijos() {
		return $this->hasMany('App\Student2', 'idRepresentante');
	}

	public function caja() {
		return $this->hasOne('App\Caja', 'idUser')->withDefault();
	}

	public function rolPivot() {
		return $this->hasOne(Roles::class, 'user_id', 'userid');
	}
}
