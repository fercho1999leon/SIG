<?php

use App\ConfiguracionSistema;
use Illuminate\Database\Seeder;

class ConfiguracionPagoAdelantadoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		$configuracionPagoAdelantado = ConfiguracionSistema::where('nombre', 'PAGO_ADELANTADO')->get();
		foreach ($configuracionPagoAdelantado as $c) {
			$c->valor = 1;
			$c->save();
		}
    }
}
