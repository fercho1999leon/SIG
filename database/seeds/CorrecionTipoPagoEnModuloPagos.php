<?php

use App\Payment;
use App\Rubro;
use Illuminate\Database\Seeder;

class CorrecionTipoPagoEnModuloPagos extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		$pagos = Payment::all();
		$rubros = Rubro::all();
		foreach ($pagos as $pago) {
			foreach ($rubros as $rubro) {
				if ((int)$pago->tipo == $rubro->id) {
					$pago->tipo = $rubro->tipo_rubro;
					$pago->save();
				}
			}
		}
    }
}
