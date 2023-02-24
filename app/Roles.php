<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Rol;
class Roles extends Model
{
    protected $table = 'role_users';

	protected $fillable = ['user_id','role_id'];
	
	public function rol() {
		return $this->belongsTo(Rol::class, 'role_id');
	}
}
