<?php

use App\ConfiguracionSistema;
use App\PeriodoLectivo;
use Illuminate\Database\Seeder;

class SeAgregaNuevaConfiguracionBecas extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $idPeriodos = PeriodoLectivo::all();
        $configuraciones = array(
			array('PERMISO_ASIGNACION_BECAS', 'Permite o restringe la asignación de beca al estudiante', 'Administrador', '1'),
			array('PERMISO_ASIGNACION_BECAS', 'Permite o restringe la asignación de beca al estudiante', 'Colecturia', '1'),
			array('PERMISO_ASIGNACION_BECAS', 'Permite o restringe la asignación de beca al estudiante', 'Secretaria', '1'),
		);
		
		foreach ($idPeriodos as $periodo) {
			for ($i=0; $i < count($configuraciones); $i++) { 
				$cs = new ConfiguracionSistema();
				$cs->nombre = $configuraciones[$i][0];
				$cs->descripcion = $configuraciones[$i][1];
				$cs->categoria  = $configuraciones[$i][2];
				$cs->valor  = $configuraciones[$i][3];
				$cs->idPeriodo = $periodo->id;
				$cs->save();
			}
		}
    }
}
