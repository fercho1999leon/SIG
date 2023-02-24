<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Course;
use App\PagoRealizado;
use App\Student2;
use App\Administrative;
use App\Institution;
use PDF;
use App\Payment;
use App\PaymentStudent;
use App\PagoEstudianteDetalle;
use App\BecasYDescuentos;
use App\Factura;
use App\Cliente;
use App\FacturaDetalle;
use Sentinel;
use App\Abono;
use App\Calificacion;
use App\ConfiguracionSistema;
use App\Fechas;
use App\PeriodoLectivo;
use App\Student2Profile;
use Luecano\NumeroALetras\NumeroALetras;

class FacturaController extends Controller
{
	/** Este método realiza la descarga de la factura del estudiante sobre un pagos específico(un pago a realizar)
	*/
    public function invoice($idPago, $idEstudiante) {
        try {
            $formatter = new NumeroALetras();// numeros en letras
			$confFormatoFactura = ConfiguracionSistema::formatoFacturas();
			$factura = Factura::with('facturaDetalle', 'cliente', 'user', 'tipoPago')->find($idPago);
            $pagos = PagoEstudianteDetalle::with('pago')->whereIn('id', $factura->facturaDetalle->pluck('idPagoDetalle'))->get();
			$student = Student2Profile::getStudent($idEstudiante);
			$institution = Institution::find(1);
			$curso = $student->course;
            $nameCurso = Calificacion::nombreCursoFactura4($curso).' - '.Calificacion::nombreSeccion($curso);
            $nameRubro = $factura->facturaDetalle->first()->pagoEstudianteDetalle->pago->descripcion;
			$valorTotal = 0;
            $periodo = PeriodoLectivo::find($this->idPeriodoUser());
			$user = Administrative::where('userid', Sentinel::getUser()->id)->first();
            $represent = Administrative::find($factura->idUsuario);
			$numeroDeFactura = $this->crearNumeroDeFactura($factura->numeroFactura);
            $descuento = $factura->subtotal - $factura->total;

			if ($confFormatoFactura->valor == '0') {
            // formato 1
				$pdf = PDF::loadView('pdf.factura-pension',
				    compact('institution', 'student', 'pagos', 'factura', 'curso', 'valorTotal'));

			}else if ($confFormatoFactura->valor == '3') {// valido para el jroldos por que tienen una factura personalizada a ser llenada por el sistema
            //"formato 2 sin encabezado"    
                $pdf = PDF::loadView('pdf.factura-pension3',
                    compact('institution', 'student', 'pagos', 'factura', 'curso', 'numeroDeFactura', 'user', 'valorTotal'))
                    ->setOption('page-width', '110')
                    ->setOption('margin-right',10)
                    ->setOption('margin-left',20)
                    ->setOption('margin-top',45)
                    ->setOption('margin-bottom',0)
                    ->setOption('page-height', '150');

            }else if ($confFormatoFactura->valor == '1') {
            // Formato 2
			$pdf = PDF::loadView('pdf.factura-pension2',
				compact('institution', 'student', 'pagos', 'factura', 'curso', 'numeroDeFactura', 'user', 'valorTotal'))
					->setOption('page-width', '70')
					->setOption('margin-right',0)
					->setOption('margin-left',0)
					->setOption('margin-top',0)
					->setOption('margin-bottom',0)
					->setOption('page-height', '250');

            }else if ($confFormatoFactura->valor == '2') {
            // Formato 2 doble
                $pdf = PDF::loadView('pdf.factura-pension2-doble',
				compact('institution', 'student', 'pagos', 'factura', 'curso', 'numeroDeFactura', 'user', 'valorTotal'))
					->setOption('page-width', '150')
					->setOption('margin-right',0)
					->setOption('margin-left',0)
					->setOption('margin-top',0)
					->setOption('margin-bottom',0)
                    ->setOption('page-height', '250');
            }else if ($confFormatoFactura->valor == '4') {
            // Formato 3 doble
                $pdf = PDF::loadView('pdf.factura-pension4-doble',
                compact('institution', 'student', 'pagos', 'factura', 'curso', 'numeroDeFactura', 'user', 'valorTotal',
                    'nameCurso', 'periodo', 'nameRubro', 'represent', 'formatter', 'descuento'));
            }

			return $pdf->download('factura pension.pdf');

        } catch (Exception $e) {
            return Redirect::back()->withErrors(['Factura' => 'Ha ocurrido un error.']);
        }

	}

	public function recibo($id) {
        try{
            $factura = Factura::with('facturaDetalle', 'cliente', 'user', 'tipoPago', 'abonos')->find($id);
            $cliente = $factura->cliente;
			$student = Student2Profile::getStudent($factura->facturaDetalle->first()->idEstudiante);
			$user = Factura::findOrFail($id);
	        $user_profile = Administrative::findBySentinelid($user->idUsuario);
            $institution = Institution::first();
			// $pdf = PDF::load


			/*
			Oscar Cornejo 
			Creación de Cuentas por Cobrar 
			*/
			$cxc = new Cuentasporcobrar();
                $cxc->fecha_emision  =  Carbon::now();
                $cxc->fecha_vencimiento  =  Carbon::now()->addDays(30);
                $cxc->comprobante_id  =  $factura->id;
                $cxc->debito  =  $factura->total;
                $cxc->credito  =  0;
				$cxc->cliente_id  =  $cliente->id;
                $cxc->saldo = $factura->total;
                $cxc->concepto  =  'Factura ' . $factura->secuencial;
            $cxc->save();
            DB::commit();

            return View('pdf.colecturia.recibo',
				compact('institution', 'factura', 'cliente', 'user_profile', 'student'
			));

            return $pdf->download('recibo.pdf');
        } catch (Exception $e) {
            return Redirect::back()->withErrors(['Factura' => 'Ha ocurrido un error.']);
        }
    }

    public function abono($id) {
        try{
			$abono = Abono::with('factura', 'pagoDetalle', 'tipoPago')->findOrFail($id);
			$factura = Factura::findOrFail($abono->idFactura);
			$pagos = PagoEstudianteDetalle::with('pago')->whereIn('id', $factura->facturaDetalle->pluck('idPagoDetalle'))->get();
            $cliente = Cliente::find($abono->factura->idCliente);
            $pago = Payment::find($abono->pagoDetalle->idPago);
            $student = Student2Profile::getStudent($abono->pagoDetalle->idEstudiante);
            $mes = Fechas::obtenerMes($pago->mes);
	        $user = Administrative::findBySentinelid(Sentinel::getUser()->id);
            $institution = Institution::first();
			$pdf = PDF::loadView('pdf.colecturia.abono',
				compact('institution', 'abono', 'cliente', 'pago', 'mes', 'user', 'student', 'factura', 'pagos'))
				->setOption('page-width', '70')
				->setOption('margin-right',0)
				->setOption('margin-left',0)
				->setOption('margin-top',0)
				->setOption('margin-bottom',0)
				->setOption('page-height', '250');
            return $pdf->download('abono.pdf');
        } catch (Exception $e) {
            return Redirect::back()->withErrors(['Factura' => 'Ha ocurrido un error.']);
        }
	}

	public function reciboDePago() {

		$pdf = PDF::loadView('pdf.recibo-de-pago')
			->setOption('page-width', '70')
			->setOption('margin-right',0)
			->setOption('margin-left',0)
			->setOption('margin-top',0)
			->setOption('margin-bottom',0)
			->setOption('page-height', '250');
		return $pdf->inline('Recibo de pago.pdf');
	}

	public function crearNumeroDeFactura($numeroFactura) {
		$numeroDeFactura = $numeroFactura;
		$totalDigitos = 9;
		$cantidadNumeroEnFactura = strlen($numeroDeFactura);
		$totalDigitos -= $cantidadNumeroEnFactura;
		$total = '';
		for ($i=0; $i < $totalDigitos; $i++) {
			$total .= "0";
		}
		return $total .= $numeroDeFactura;
	}

}
