<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Course;
use App\Student2;
use App\User;
use App\Pago;
use App\PagoRealizado;
use App\BecasYDescuentos;
use App\PaymentStudent;
use App\Factura;
use Carbon\Carbon;
use App\Fechas;

class PaymentStudentController extends Controller
{
	//EL $idPago corresponde al pago que debe realizar el estudiante
	//Metodo para mostrar el historico correspondiente a un pago a realizar

    //EL $idPago corresponde al pago que debe realizar el estudiante
    //Metodo para crear el pago realizado del estudiante
    public function create($idPago){
    	$pago = PagoRealizado::find($idPago);
    	$registroPago = Pago::find($pago->idPago);
    	$student = Student2::findOrFail($pago->idEstudiante);
    	$course = Course::findOrFail($student->idCurso);
    	$tutor = User::findOrFail($course->idProfesor);

        //Becas
        $beca = BecasYDescuentos::find($pago->beca);
        $cantidadBeca = 0;
        $valorHastaBeca = 0;

        //Descuentos
        $descuento = BecasYDescuentos::find($pago->descuento);
        $cantidadDescuento = 0;
        $valorHastaDescuento = 0;

        $pagosEstudiantes = PaymentStudent::where('idEstudiante', $student->id)
                                                ->where('idPago', $idPago)
                                                ->get();
        $cantidadPagosAnteriores = 0;
        $valorHastaPagosAnteriores = 0;

    	return view('UsersViews.colecturia.pagos.pagosEstudiantes.pagoEstudiante-Realizar', compact('pago', 'registroPago', 'student', 'course', 'tutor', 'beca', 'cantidadBeca', 'valorHastaBeca', 'descuento', 'cantidadDescuento', 'valorHastaDescuento', 'pagosEstudiantes', 'cantidadPagosAnteriores'));
    }


    //Metodo para crear el pago realizado del estudiante
    public function store(Request $request, $idStudent, $idPago){
        $student = Student2::find($idStudent);
        $pagoEstudiante = new PaymentStudent();
        //Datos Factura
        $pagoEstudiante->idPago = $idPago;
        $pagoEstudiante->idEstudiante = $idStudent;
        $pagoEstudiante->nombres = $request->nombres;
        $pagoEstudiante->apellidos = $request->apellidos;
        //$pagoEstudiante->ciRUC = $request->ciRUC;
        $pagoEstudiante->telefono = $request->telefono;
        $pagoEstudiante->ciudad = $request->ciudad;
        $pagoEstudiante->direccion = $request->direccion;
        $pagoEstudiante->correo = $request->correo;
        $pagoEstudiante->tipoPago = $request->tipoPago;

        //Pago Caja
        if( $request->tipoPago=='Caja' ){
            $pagoEstudiante->cantidad = $request->cantidadCaja;
        }

        //Pago Deposito_Transferencia
        if( $request->tipoPago=='Deposito/Transferencia' ){
            $pagoEstudiante->numeroTransaccion = $request->numeroDeposito;
            $pagoEstudiante->cantidad = $request->cantidadDeposito;
        }

        //Pago Cheque
        if( $request->tipoPago=='Cheque' ){
            $pagoEstudiante->nCheque = $request->numeroCheque;
            $pagoEstudiante->bancoEmisor = $request->bancoCheque;
            $pagoEstudiante->cantidad = $request->cantidadCheque;
        }

        //Pago Tarjeta
        if( $request->tipoPago=='Tarjeta' ){
            $pagoEstudiante->datosTarjeta = $request->datosTarjeta;
            $pagoEstudiante->numeroTarjeta = $request->numeroTarjeta;
            $pagoEstudiante->cantidad = $request->cantidadTarjeta;
        }
        
        $pagoEstudiante->save();

        //Información
        $pago = PagoRealizado::find($idPago);
        $registroPago = Pago::find($pago->idPago);
        $valorACancelar = $registroPago->valor;

        //Beca
        $beca = BecasYDescuentos::find($pago->beca);
        $cantidadBeca = 0;
        $valorHastaBeca = 0; 
        if( $pago->beca!=null ){
            if($beca->valor!=null){
                $cantidadBeca=$beca->valor;
            }else{
                $cantidadBeca=bcdiv(($beca->porcentaje/100)*$valorACancelar, '1',2);
            }
        }
        $valorHastaBeca = $valorACancelar-$cantidadBeca; 
        
        //Descuento
        $descuento = BecasYDescuentos::find($pago->descuento);
        $cantidadDescuento = 0;
        $valorHastaDescuento = 0;
        if( $pago->descuento!=null ){
            if($descuento->valor!=null){
                $cantidadDescuento=$descuento->valor;
            }else{
                $cantidadDescuento=bcdiv(($descuento->porcentaje/100)*$valorHastaBeca, '1',2);
            }
        }

        //Pagos Anteriores
        $pagosAnteriores = PaymentStudent::where('idEstudiante', $student->id)
                                                    ->where('idPago', $idPago)
                                                    ->get();
        $cantidadPagosAnteriores = 0;
        foreach ($pagosAnteriores as $pA) {
            $cantidadPagosAnteriores = $cantidadPagosAnteriores+$pA->cantidad;
        }
        
        if( bcdiv($valorACancelar, '1', 2)==bcdiv($cantidadPagosAnteriores+$cantidadBeca+$cantidadDescuento, '1', 2)){
            $pago->estado ="Pagado";
            $pago->save(); 

            //return $request->tipoPago;
            //Se genera la factura
            $factura = new Factura();
            $factura->idPago = $idPago;
            $factura->nombres = $request->nombres;
            $factura->apellidos = $request->apellidos; 
            $factura->ci = $request->ciRUC;;
            $factura->telefono = $request->telefono;
            $factura->ciudad = $request->ciudad;
            $factura->direccion = $request->direccion;
            $factura->correo = $request->correo;
            //$factura->fechaEmision ;
            //$factura->horaEmision;
            $factura->tipoPago = $request->tipoPago;
            

            if( $request->tipoPago=="Caja"){
                $factura->valor = $registroPago->valor-$cantidadBeca-$cantidadDescuento;
            }
            if( $request->tipoPago=="Deposito/Transferencia"){
                $factura->numeroTransaccion = $request->numeroDeposito; 
                $factura->valor = $registroPago->valor-$cantidadBeca-$cantidadDescuento;
            }
            if( $request->tipoPago=='Cheque'){
                $factura->nCheque = $request->numeroCheque;;
                $factura->bancoEmisor = $request->bancoCheque;;
                $factura->valor = $registroPago->valor-$cantidadBeca-$cantidadDescuento;
            }
            if( $request->tipoPago=='Tarjeta'){
                $factura->datosTarjeta = $request->datosTarjeta;
                $factura->numeroTarjeta = $request->numeroTarjeta;
                $factura->valor = $registroPago->valor-$cantidadBeca-$cantidadDescuento;
            }
            
            $factura->save();
        }

        return redirect()->route('pagosCursoEstudiante', $idStudent);
    }

    public function historico($idPago){ 
        //Registro del pago a realizarse
        $pago = PagoRealizado::find($idPago);
        $student = Student2::find($pago->idEstudiante);
        $course = Course::find($student->idCurso);
        $tutor = User::findOrFail($course->idProfesor);
        
        //Registro del pago a cubrirse
        $pagoACancelar = Pago::find($pago->idPago);

        //Valor a Cancelar
        $valorACancelar = bcdiv($pagoACancelar->valor, '1',2);
        
        //Becas
        $beca = BecasYDescuentos::find($pago->beca);

        //Descuentos
        $descuento = BecasYDescuentos::find($pago->descuento);

        $pagosEstudiantes = PaymentStudent::where('idEstudiante', $student->id)
                                                ->where('idPago', $idPago)
                                                ->get();
        //return "Hola";
        return view('UsersViews.colecturia.pagos.pagosEstudiantes.pagoEstudiante-Historico', compact('pago', 'student', 'course', 'tutor', 'pagoACancelar', 'valorACancelar', 'beca', 'descuento', 'pagosEstudiantes'));
    }
}
