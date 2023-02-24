<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Factura extends Model
{
    protected $table = 'pagos_factura';

    public function facturaDetalle(){
        return $this->hasMany('App\FacturaDetalle','idFactura');
    }
    public function abonos(){
        return $this->hasMany('App\Abono','idFactura');
    }
    public function tipoPago(){
        return $this->hasMany('App\TipoPago','idFactura');
    }
    public function cliente(){
        return $this->belongsTo('App\Cliente','idCliente');
    }
    public function user(){
        return $this->belongsTo('App\Administrative','idUsuario');
	}
	public function facturaEstudianteDetalle() {
		return $this->belongsTo('App\PagoEstudianteDetalle', 'id');
	}
}
