<?php

use App\ConfiguracionesParcial;
use App\PeriodoLectivo;
use Illuminate\Database\Seeder;

class ConfiguracionesParcialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Se crean registros para configuracion parcial dependiendo cuantos años existan en el periodo lectivo.
		$periodos = PeriodoLectivo::all();
		foreach ($periodos as $periodo) {
			$confParcial = ConfiguracionesParcial::where('idPeriodo', $periodo->id)->first();
			if ($confParcial == null) {
				$confParcial = new ConfiguracionesParcial;
				$confParcial->idPeriodo = $periodo->id;
				$confParcial->save();
			}
		}
    }
}
