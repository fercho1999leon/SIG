<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Sentinel;

class BecaDescuento extends Model
{
    protected $table ="becas_descuentos";

    public function student(){
        return $this->hasMany('App\BecaDetalle','idBeca');
	}

	public static function getAllDiscounts() {
		return BecaDescuento::where('idPeriodo', Sentinel::getUser()->idPeriodoLectivo)
			->get();
	}
}
