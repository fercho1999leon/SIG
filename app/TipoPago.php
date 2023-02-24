<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TipoPago extends Model
{
    protected $table = "tipos_pago";

    public function factura()
    {
        return $this->belongsTo('App\Factura', 'idFactura');
    }

    public function abono() 
    {
        return $this->belongsTo('App\Abono', 'idRecibo');
    }
}
