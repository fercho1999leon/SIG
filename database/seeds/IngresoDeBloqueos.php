<?php

use App\TipoBloqueo;
use Illuminate\Database\Seeder;

class IngresoDeBloqueos extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		$bloqueos = ['Condicionado', 'Comportamiento', 'Asistencia', 'Colecturia', 'DECE', 'Academico'];
		foreach ($bloqueos as $bloqueo) {
			TipoBloqueo::create([
				'nombre' => $bloqueo
			]);
		}
    }
}
