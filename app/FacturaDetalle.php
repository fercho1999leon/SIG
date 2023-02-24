<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FacturaDetalle extends Model
{
    protected $table ="factura_detalles";

    public function student()
    {
        return $this->belongsTo('App\Student2', 'idEstudiante');
    }

    public function factura()
    {
        return $this->belongsTo('App\Factura', 'idFactura');
	}
	
	public function pagoEstudianteDetalle() {
		return $this->belongsTo('App\PagoEstudianteDetalle', 'idPagoDetalle');
	}
}
