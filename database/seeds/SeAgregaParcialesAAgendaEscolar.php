<?php

use App\ConfiguracionesParcial;
use App\Lectionary;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class SeAgregaParcialesAAgendaEscolar extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		$p1q1FI = Carbon::createFromFormat('Y-m-d', ConfiguracionesParcial::find(1)->p1q1FI);
		$p1q1FF = Carbon::createFromFormat('Y-m-d', ConfiguracionesParcial::find(1)->p1q1FF);

		$p2q1FI = Carbon::createFromFormat('Y-m-d', ConfiguracionesParcial::find(1)->p2q1FI);
		$p2q1FF = Carbon::createFromFormat('Y-m-d', ConfiguracionesParcial::find(1)->p2q1FF);

		$p3q1FI = Carbon::createFromFormat('Y-m-d', ConfiguracionesParcial::find(1)->p3q1FI);
		$p3q1FF = Carbon::createFromFormat('Y-m-d', ConfiguracionesParcial::find(1)->p3q1FF);
		$p1q1 = 0;
		$p2q1 = 0;
		$p3q1 = 0;
		$agendaEscolar = Lectionary::where('parcial', null)->get();
		foreach ($agendaEscolar as $actividad) {
			$fechaActividad = Carbon::createFromFormat('Y-m-d', substr($actividad->created_at,0,4).'-'.substr($actividad->created_at,5,2).'-'.substr($actividad->created_at,8,2));
			if ($fechaActividad >= $p1q1FI && $fechaActividad <= $p1q1FF) {
				$p1q1++;
				$actividad->parcial = 'P1Q1';
				$actividad->save();
			} else if($fechaActividad >= $p2q1FI && $fechaActividad <= $p2q1FF) {
				$p2q1++;
				$actividad->parcial = 'P2Q1';
				$actividad->save();
			} else if($fechaActividad >= $p3q1FI && $fechaActividad <= $p3q1FF){
				$p3q1++;
				$actividad->parcial = 'P3Q1';
				$actividad->save();
			}
		}
		echo "Primer parcial se ingresaron: $p1q1, Segundo Parcial se ingresaron: $p2q1, Tercer Parcial se ingresaron: $p3q1, ";
		echo 'Total:', $p1q1+$p2q1+$p3q1;
    }
}
