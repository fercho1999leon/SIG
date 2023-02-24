<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class TypeRequest extends Model
{
    protected $table = 'request_type_tbl';

	protected $fillable = ['id_transact', 'id_addressee', 'amount'];

    public function transact() {
		return $this->hasmany(Transact::class, 'id_transact');
	}
    public function addressee() {
		return $this->hasmany(Transact::class, 'id_addressee');
	}
    
   
    //
    //public function getRouteKeyName()
    //{
    //    return redirect()->route('UsersViews.administrador.carreras.index');
    //}
}