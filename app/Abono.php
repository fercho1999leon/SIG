<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Abono extends Model
{
    protected $table = "abonos";

    public function factura()
    {
        return $this->belongsTo('App\Factura', 'idFactura');
    }
    public function pagoDetalle()
    {
        return $this->belongsTo('App\PagoEstudianteDetalle', 'idPagoDetalle');
    }
    public function tipoPago()
    {
        return $this->hasMany('App\TipoPago', 'idRecibo');
    }
}
