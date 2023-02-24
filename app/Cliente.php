<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    protected $table ="clientes";
	protected $guarded = [];
    public static function getClienteByCedula($cedula){
        return Cliente::where('cedula_ruc', $cedula)->first();
	}
	
	public static function getClients() {
		return Cliente::orderBy('apellidos')->get();
	}
	public static function getTransaccion() {
		return Cliente::orderBy('apellidos')->get();
	}
	
	public function scopeSearch($query, $search) {
		$query->when($search, function($query, $search) {
			$query->where('nombres', 'like', "%{$search}%")
			->orWhere('apellidos', 'like', "%{$search}%");
		});
	}
	
}
