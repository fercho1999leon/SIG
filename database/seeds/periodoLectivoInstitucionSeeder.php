<?php

use Illuminate\Database\Seeder;
use App\Institution;
use App\PeriodoLectivo;
class periodoLectivoInstitucionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
		
		$periodosLectivos = [
			[
				'fecha_inicial' => '2019-04-22',
				'fecha_final' => '2020-02-07',
				'nombre' => '2019-2020',
				'regimen' => 'COSTA',
			],
			[
				'fecha_inicial' => '2020-04-22',
				'fecha_final' => '2021-02-07',
				'nombre' => '2020-2021',
				'regimen' => 'COSTA',
			],
		];
		$i = 1;
		foreach ($periodosLectivos as $periodo) {
			$nuevoPeriodo = PeriodoLectivo::where('fecha_inicial', $periodo['fecha_inicial'])->first();
			if ($nuevoPeriodo == null) {
				PeriodoLectivo::create([
					'fecha_inicial' => $periodo['fecha_inicial'],
					'fecha_final' => $periodo['fecha_final'],
					'nombre' => $periodo['nombre'],
					'regimen' => $periodo['regimen'],
				]);
			}
		}
    }
}
