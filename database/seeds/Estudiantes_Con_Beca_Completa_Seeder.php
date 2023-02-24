<?php

use Illuminate\Database\Seeder;
use App\Student2;
use App\PagoEstudianteDetalle;
use App\Course;
use Carbon\Carbon;
use App\Payment;
use App\Factura;
use App\Cliente;
use App\FacturaDetalle;
use App\BecaDescuento;
use App\BecaDetalle;
use App\Abono;

class Estudiantes_Con_Beca_Completa_Seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /*
        	Cambio de estados
        */
        $estudiantes = BecaDetalle::where('idBeca', 15)->get();

        foreach ($estudiantes as $estudiante) {

        	$student= Student2::findOrFail($estudiante->id);
        	echo "Estudiante".$student->id.": ";
        	$pagos = PagoEstudianteDetalle::where('idEstudiante', $student->id)->get();

			
        	foreach ($pagos as $pago) {
        		$evaluador = Payment::find($pago->idPago);
        		//echo $evaluador->tipo;
        		if( $evaluador->tipo=='Pension'){
        			echo $pago->idPago."_";
        		}
        		
        	}
        	echo "     ";
        	
        }



    }
}
