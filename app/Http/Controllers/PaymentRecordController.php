<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Course;
use App\Student2;
use App\User;
use App\Pago;
use App\PagoRealizado;
use App\BecasYDescuentos;

class PaymentRecordController extends Controller
{
	//Se debe crear el registro de pagos de una estudiante al crearlo

	//Metodo para editar un registro de pago de un estudiante
	public function edit($id){
		$pago = PagoRealizado::find($id);
		$registroPago = Pago::find($pago->idPago);
		$student = Student2::findOrFail($pago->idEstudiante);
		$course = Course::findOrFail($student->idCurso);
		$tutor = User::findOrFail($course->idProfesor);
		$bod = BecasYDescuentos::where('tipo', 'Beca')->get();
		$descuentos = BecasYDescuentos::where('tipo', 'Descuento')->get();

		return view('UsersViews.colecturia.pagos.registroPagoEstudiante.edit', compact('student', 'pago', 'registroPago', 'course', 'tutor', 'bod', 'descuentos'));
	}

	//Metodo para editar un registro de pago de un estudiante
	public function update(Request $request, $id){
		$pago = PagoRealizado::findOrFail($id);
		$student = Student2::findOrFail($pago->idEstudiante);

		$pago->beca = $request->beca; 
		$pago->descuento = $request->descuento; 
		$pago->prorroga = $request->prorroga;

		$pago->save();

		return redirect()->route('pagosCursoEstudiante', $student->id);
	}
}
