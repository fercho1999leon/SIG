<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Sentinel;

class Cronograma extends Model
{
	protected $table = 'cronograma';
	protected $fillable = ['titulo', 'parcial', 'rol', 'adjunto', 'idPeriodo'];

	public static function getAllSchedule(){
		return Cronograma::query()
			->orderBy('parcial')
			->where('idPeriodo', Sentinel::getUser()->idPeriodoLectivo)
			->get();
	}
}
