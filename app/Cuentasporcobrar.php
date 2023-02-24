<?php

namespace App;

use App\Matter;
use App\Student2;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Sentinel;

class Cuentasporcobrar extends Model
{
    protected $table = 'cuentas_por_cobrar';

	protected $fillable = ['concepto','saldo','cliente_id','credito','debito',
    'comprobante_id','fecha_emision','fecha_vencimiento','num_factura' , 'id_semesters'];
    public $timestamps = false;
}