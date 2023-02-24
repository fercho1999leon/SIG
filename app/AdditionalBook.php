<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Sentinel;

class AdditionalBook extends Model
{
	protected $table = 'additional_books'; 
	protected $guarded = [];
	
	public static function allBooks() {
		return AdditionalBook::where('idPeriodo', Sentinel::getUser()->idPeriodoLectivo)->get();
	} 
}
