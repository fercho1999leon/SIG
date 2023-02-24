<?php

namespace App\Http\Controllers;
  
use Illuminate\Http\Request;
use Sentinel; 
use App\Student2;
use App\PagoEstudianteDetalle;
use App\Student2Profile;
use App\ConfiguracionSistema;
use App\PeriodoLectivo;
use App\BecaDescuento;
use App\Course;
use Carbon\Carbon;
use App\User;

class representantePagosController extends Controller
{
    public function index(Student2 $hijo) {
        $hijo = Student2Profile::getStudent($hijo->id);
		$user = Sentinel::getUser();
		$pagos = PagoEstudianteDetalle::getDetailPaymentsByStudent($hijo->idStudent, $hijo->idCurso);
		return view('UsersViews.representante.pagos.index', compact(
			'pagos', 'hijo'
		));
	} public function pendientes(Student2 $hijo) {
		$c = 1;
        $dia_pago = (int)ConfiguracionSistema::diaDePago()->valor;
        
        $periodos = PeriodoLectivo::all();
		$student = Student2::with('becasDescuentos')
			->join('students2_profile_per_year', 'students2.id', '=', 'students2_profile_per_year.idStudent')
			->where('students2_profile_per_year.idPeriodo', $this->idPeriodoUser())
			->where('students2_profile_per_year.idStudent', $hijo->id)
			->select('students2.id', 'students2_profile_per_year.idCurso', 'students2.apellidos', 'students2.nombres', 'students2_profile_per_year.idPeriodo')
			->first();
		$becas = BecaDescuento::all();
        $course = Course::find($student->idCurso);
        $pagosPendientes = PagoEstudianteDetalle::getDetailPaymentsByStudent($hijo->id, $student->idCurso)->where('estado', 'PENDIENTE');
        $student_cliente = Student2Profile::getStudent($hijo->id);
       
        if( count($pagosPendientes) > 0){
            foreach($pagosPendientes as $key => $pago ){
                $pago_mes = $pago->pago;
                if($pago_mes != null) {

                    if($pago->prorroga == null)
                        $fecha_pago = Carbon::createFromDate($pago_mes->anio, $pago_mes->mes+1, $dia_pago);
                    else
                        $fecha_pago = Carbon::createFromDate($pago_mes->anio, $pago_mes->mes+1, $dia_pago+$pago->prorroga);
                    $now = Carbon::now();
                    if($fecha_pago >= $now){
                        $pagosPendientes->forget($key);
                    }
                }
            }
        }
        $pagos = PagoEstudianteDetalle::getDetailPaymentsByStudent($hijo->id, $student->idCurso);
        $tutor = User::find($course->idProfesor);
        return view('UsersViews.colecturia.pagos.pagosEstudiante', 
        compact('student', 'course', 'tutor', 'pagos', 'becas', 'periodos', 'pagosPendientes', 'c','student_cliente'));
    }
    /**/


		/*
        $hijo = Student2Profile::getStudent($hijo->id);
		$user = Sentinel::getUser();
		$pagos = PagoEstudianteDetalle::getDetailPaymentsByStudent($hijo->idStudent, $hijo->idCurso);
		return view('UsersViews.representante.pagos.pagos_pendientes', compact(
			'pagos', 'hijo'
		));*/
	
}
