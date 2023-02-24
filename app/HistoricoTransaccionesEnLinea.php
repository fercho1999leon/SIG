<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HistoricoTransaccionesEnLinea extends Model
{	

	protected $table = 'historico_transacciones_en_lineas';
	protected $guarded = [];
    //
   
     public function ClientePEL()
    {
       // return $this->hasOne(HistoricoTransaccionesEnLinea::class);
        return $this->hasOne('App\Cliente','id','idCliente');
    }
}
