<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Institution;
use App\Student2;
use App\Student2Profile;
use App\Course;
use App\ConfiguracionSistema;
use Carbon\Carbon;
use PDF;
use Exception;
use App\PeriodoLectivo;
use App\PagoEstudianteDetalle;
use App\Administrative;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;
use Sentinel;
use App\Abono;
use App\Calificacion;
use App\Fechas;
use App\Payment;
use App\Rubro;
class ColecturiaController extends Controller
{
    public function eliminarPagoDetalle($idPagoDetalle){
        try {
            $pago = PagoEstudianteDetalle::findOrFail($idPagoDetalle);
            $pago->delete();
            return Redirect::back();
        }catch(Exception $e){
            return Redirect::back()->withErrors(['Pago' => 'Ha ocurrido un error.']);
        }
    }

    public function estudiantesPagadosCurso($idCurso, $tipoPago,$mes) {
        try{
            $course = Course::with('pagos')->find($idCurso);
            $pago = $course->pagos->where('mes', $mes)->where('idRubro', $tipoPago)->first();
            if($pago == null)
                throw new Exception('No existen estudiantes con pagos realizados.');
            $institution = Institution::find(1);
            $students = Student2::getStudentsByCourse($idCurso);
            $nombreMes= '';
            switch($mes){
                case 1:  $nombreMes = 'ENERO'      ;break;
                case 2:  $nombreMes = 'FEBRERO'    ;break;
                case 3:  $nombreMes = 'MARZO'      ;break;
                case 4:  $nombreMes = 'ABRIL'      ;break;
                case 5:  $nombreMes = 'MAYO'       ;break;
                case 6:  $nombreMes = 'JUNIO'      ;break;
                case 7:  $nombreMes = 'JULIO'      ;break;
                case 8:  $nombreMes = 'AGOSTO'     ;break;
                case 9:  $nombreMes = 'SEPTIEMBRE' ;break;
                case 10: $nombreMes = 'OCTUBRE'    ;break;
                case 11: $nombreMes = 'NOVIEMBRE'  ;break;
                case 12: $nombreMes = 'DICIEMBRE'  ;break;
			}
            $cEstudiantes = 0;
            $cPendientes = 0;
            $cProrroga = 0;
			$total = 0;
            foreach($students as $key => $student){
                $p  = $student->pagos->where('idPago', $pago->id)->first();
                if(count($student->pagos)>0 && $p != null){
                    if($p->estado == 'PENDIENTE' ){
                        $cPendientes++;
                        $students->forget($key);
                    }else if($p->estado == 'PRORROGA' ){
                        $cProrroga++;		
                        $students->forget($key);
                    }else if( $p->estado == 'PAGADO' ){
                        $cEstudiantes++;
                    }
                } 
			}
            $pdf = PDF::loadView('pdf.colecturia.estudiantes-pagados-por-curso', 
                         compact('institution', 'students', 'course', 'pago', 'tipoPago', 'nombreMes', 'cEstudiantes',
                                 'cPendientes', 'cProrroga', 'total'));
            return $pdf->download("Reporte pagados por curso({$course->grado} {$course->especializacion} {$course->paralelo}).pdf");
        } catch (\Exception $e) {
            return Redirect::back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function estudiantesPendientesProrroga($idCurso, $mes, $tipoPago) {
        $course = Course::find($idCurso);
        $pago = $course->pagos->where('mes', $mes)->where('idRubro', $tipoPago)->first();
        $total = 0;
        $students = Student2Profile::where('idCurso', $course->id)->get();
        $students2 = Student2::whereIn('id',$students->pluck('id'))->get();
        $prorrogas = PagoEstudianteDetalle::whereIn('idPago', $pago->pluck('id'))->where('estado','PRORROGA')->get();
		if ($prorrogas->isEmpty()) {
			return Redirect::back()->withErrors(['login_fail' => 'No existen alumnos con prorrogas']);
		}
		$i = 1;
		$institution = Institution::first();
        $dia_pago = ConfiguracionSistema::diaDePago()->valor;
        $pdf = PDF::loadView('pdf.reporte-estudiantes-por-curso-prorroga',
            compact('institution', 'course', 'students', 'i', 'dia_pago', 'pago', 'total', 'mes', 'tipoPago','prorrogas', 'students2'
		    ));
		return $pdf->download("Reporte por estudiantes con prorroga({$course->grado} {$course->especializacion} {$course->paralelo}).pdf");
        
    }

    public function estudiantesPendientes($idCurso, $mes, $tipoPago) {
        try{
            $course = Course::with('pagos')->find($idCurso);
            $pago = $course->pagos->where('mes', $mes)->where('idRubro', $tipoPago)->first();
            
            if($pago == null)
                throw new Exception('No existen estudiantes con pagos pendientes.');

            $dia_pago = ConfiguracionSistema::diaDePago()->valor;
            $fecha_pago = Carbon::createFromDate($pago->anio, $pago->mes, $dia_pago)->format('Y-m-d');
            $total = 0;
            $institution = Institution::find(1);
            $students = Student2::getStudentsByCourse($idCurso);
            $nombreMes ="";
            switch($mes){
                case 1:  $nombreMes = 'ENERO'      ;break;
                case 2:  $nombreMes = 'FEBRERO'    ;break;
                case 3:  $nombreMes = 'MARZO'      ;break;
                case 4:  $nombreMes = 'ABRIL'      ;break;
                case 5:  $nombreMes = 'MAYO'       ;break;
                case 6:  $nombreMes = 'JUNIO'      ;break;
                case 7:  $nombreMes = 'JULIO'      ;break;
                case 8:  $nombreMes = 'AGOSTO'     ;break;
                case 9:  $nombreMes = 'SEPTIEMBRE' ;break;
                case 10: $nombreMes = 'OCTUBRE'    ;break;
                case 11: $nombreMes = 'NOVIEMBRE'  ;break;
                case 12: $nombreMes = 'DICIEMBRE'  ;break;
            }
            $cEstudiantes = 0;
            $cPendientes = 0;
            $cProrroga = 0;
            foreach($students as $key => $student){
                $p  = $student->pagos->where('idPago', $pago->id)->first();
                if(count($student->pagos)>0 && $p != null){
                    if($p->estado == 'PENDIENTE' ){
                        $cPendientes++;
                    }else if($p->estado == 'PRORROGA' ){
                        $cProrroga++;		
                        $students->forget($key);
                    }else if( $p->estado == 'PAGADO' ){
                        $cEstudiantes++;
                        $students->forget($key);
                    }else{
                        $students->forget($key);
                    }                      
				}else{
                    $students->forget($key);
                }  
            }

            $pdf = PDF::loadView('pdf.colecturia.estudiantes-pagados-por-curso',
                compact('institution', 'students', 'course', 'pago', 'tipoPago', 'nombreMes',
                        'dia_pago', 'fecha_pago', 'cEstudiantes', 'cPendientes', 'cProrroga', 'total')
            );
    
            return $pdf->download("Reporte por estudiante pagos pendientes({$course->grado} {$course->especializacion} {$course->paralelo}).pdf");
        } catch (\Exception $e) {
            return Redirect::back()->withErrors(['error' => $e->getMessage()]);
        }
        
	}
	
    public function pagosPorCurso($idCurso){
        $course = Course::with('pagos')->find($idCurso);
        $dia_pago = ConfiguracionSistema::diaDePago()->valor;
       
        $meses = array_unique( $course->pagos->pluck('mes')->toArray() );
        $tiposPago = array_unique( $course->pagos->pluck('tipo')->toArray() );
        $institution = Institution::find(1);
        $students = Student2::getStudentsByCourse($idCurso);
        $nombreMes = '';
		$tipoPago = '';
        $pago = null;
		$pdf = PDF::loadView('pdf.colecturia.pagos-por-curso',
			compact('institution', 'students', 'course', 'tiposPago', 'dia_pago', 'meses', 'tiposPago', 'nombreMes', 'tipoPago', 'pago')
        );

        return $pdf->download('Reporte Pagos Por Curspo.pdf');
	}

    public function pagosPorCursoDetallado($idCurso){

        $course = Course::with('pagos')->find($idCurso);
        $dia_pago = ConfiguracionSistema::diaDePago()->valor;
        $dia_pago = $dia_pago!=0 ?: 1;
        $meses = array_unique( $course->pagos->pluck('mes')->toArray() );
        $tiposPago = array_unique( $course->pagos->pluck('tipo')->toArray() );
        $institution = Institution::find(1);
        $students = Student2Profile::where('idCurso', $idCurso)->where('idPeriodo', $this->idPeriodoUser())->get();
        $nombreMes = '';
		$tipoPago = '';
        $pago = null;
        $hoy = Fechas::fechaActualMdY();
        $reportName = 'Pagos por curso a: '.$hoy;
        $nombreCurso = Calificacion::nombreCurso($course);
        $especializacion = $course->especializacion==null ? Calificacion::nombreSeccionDetallada($course) : Calificacion::nombreSeccionDetallada($course).' - '.$course->especializacion;

		$pdf = PDF::loadView('pdf.colecturia.pagos-por-curso-detallado',
			compact('institution', 'students', 'course', 'tiposPago', 'dia_pago', 'meses', 'tiposPago', 'nombreMes', 'tipoPago', 'pago', 'hoy', 'reportName', 'nombreCurso', 'especializacion')
        );

        return $pdf->download('Reporte Pagos Por Curspo.pdf');
	}
	
    public function pagosPorCursoRubro($idCurso){
        $course = Course::with('pagos')->find($idCurso);
        $dia_pago = ConfiguracionSistema::diaDePago()->valor;
        $meses = array_unique( $course->pagos->pluck('mes')->toArray() );
        $tiposPago = array_unique( $course->pagos->pluck('tipo')->toArray() );
        $institution = Institution::find(1);
        $students = Student2::getStudentsByCourse($idCurso);
        $nombreMes = '';
        $tipoPago = '';
		$pago = null;
        $pdf = PDF::loadView('pdf.colecturia.pagos-por-curso-rubros',
            compact('institution', 'students', 'course', 'tiposPago', 'dia_pago', 'meses', 'tiposPago', 'nombreMes', 'tipoPago', 'pago')
        );

        return $pdf->download('Reporte Pagos Por Curspo.pdf');
    }

    public function reporteDiario(Request $request) {
        $today = Carbon::today();
        $rubro = $request->rubro;
        $institution = Institution::find(1);
        $desde = $request->desde;
        $hasta = $request->hasta;
        $periodo = PeriodoLectivo::find($this->idPeriodoUser());
        $userProfile = Sentinel::getUser();
        $user = Administrative::findBySentinelid($userProfile->id);
        if($request->rubro != 'Todos'){
            $abonos = DB::table('abonos')
                ->join('pago_estudiante_detalles', 'pago_estudiante_detalles.id', '=', 'abonos.idPagoDetalle')
                ->join('tipos_pago', 'tipos_pago.idRecibo', '=', 'abonos.id')
                ->join('students2', 'pago_estudiante_detalles.idEstudiante', '=', 'students2.id')
                ->join('students2_profile_per_year', 'students2_profile_per_year.idStudent', '=', 'students2.id')
                ->join('courses', 'students2_profile_per_year.idCurso', '=', 'courses.id')
                ->join('factura_detalles', 'pago_estudiante_detalles.id', '=', 'factura_detalles.idPagoDetalle')
                ->join('pagos_factura', 'pagos_factura.id', '=', 'factura_detalles.idFactura')
                ->join('modulo_pagos', 'pago_estudiante_detalles.idPago', '=', 'modulo_pagos.id')
                ->select('students2.nombres','students2.id AS idEstudiante', 'students2.apellidos', 'pago_estudiante_detalles.estado', 'pago_estudiante_detalles.updated_at',
                        'courses.paralelo', 'courses.grado', 'courses.especializacion', 'modulo_pagos.tipo','modulo_pagos.tipo_emision', 'pagos_factura.total AS subtotal',
                        'modulo_pagos.mes', 'modulo_pagos.idRubro', 'abonos.cantidad', 'abonos.id', 'pagos_factura.numeroFactura', 'pagos_factura.id AS idFactura', 'pagos_factura.tipo_pago', 
                        'pagos_factura.idUsuario AS idUsuario', 'pagos_factura.estatus', 'modulo_pagos.id as idPayment','tipos_pago.tipo_pago as tipo_recibo')
                ->where('pagos_factura.idUsuario', $user->id)
                ->where('modulo_pagos.idRubro', $request->rubro)
                ->where('pagos_factura.estatus', null)
                ->where('abonos.estatus', null)
                ->where('pagos_factura.idPeriodo', $this->idPeriodoUser())
                ->whereDate('abonos.updated_at', '>=', $request->desde)
                ->whereDate('abonos.updated_at', '<=', $request->hasta)
                ->orderBy('id')
                ->get();
                
            $facturas = DB::table('pago_estudiante_detalles')
                ->join('students2', 'pago_estudiante_detalles.idEstudiante', '=', 'students2.id')
                ->join('students2_profile_per_year', 'students2_profile_per_year.idStudent', '=', 'students2.id')
                ->join('courses', 'students2_profile_per_year.idCurso', '=', 'courses.id')
                ->join('factura_detalles', 'pago_estudiante_detalles.id', '=', 'factura_detalles.idPagoDetalle')
                ->join('pagos_factura', 'pagos_factura.id', '=', 'factura_detalles.idFactura')
                ->join('modulo_pagos', 'pago_estudiante_detalles.idPago', '=', 'modulo_pagos.id')
                ->join('rubros', 'modulo_pagos.idRubro', '=', 'rubros.id')
                ->select('students2.nombres','students2.id AS idEstudiante', 'students2.apellidos', 'pago_estudiante_detalles.estado', 'pago_estudiante_detalles.updated_at',
                        'courses.paralelo', 'courses.grado', 'courses.especializacion', 'modulo_pagos.tipo','modulo_pagos.tipo_emision', 'pagos_factura.total AS subtotal',
                        'modulo_pagos.mes', 'modulo_pagos.idRubro', 'rubros.tipo_emision AS tipo_emision', 'factura_detalles.total', 'pagos_factura.id AS idFactura', 'pagos_factura.numeroFactura', 'pagos_factura.tipo_pago', 
                        'pagos_factura.idUsuario AS idUsuario', 'pagos_factura.estatus', 'modulo_pagos.id as idPayment')
                ->where('pagos_factura.idUsuario', $user->id)
                ->where('modulo_pagos.idRubro', $request->rubro)
                ->where('pagos_factura.estatus', null)
                ->where('pago_estudiante_detalles.estado', 'PAGADO')
                ->where('pagos_factura.idPeriodo', $this->idPeriodoUser())
                ->whereDate('pago_estudiante_detalles.updated_at', '>=', $request->desde)
                ->whereDate('pago_estudiante_detalles.updated_at', '<=', $request->hasta)
                ->whereNotIn('idFactura', $abonos->pluck('idFactura'))
                ->orderBy('idFactura')
                ->get();

        }else{
            $abonos = DB::table('abonos')
                ->join('pago_estudiante_detalles', 'pago_estudiante_detalles.id', '=', 'abonos.idPagoDetalle')
                ->join('tipos_pago', 'tipos_pago.idRecibo', '=', 'abonos.id')
                ->join('students2', 'pago_estudiante_detalles.idEstudiante', '=', 'students2.id')
                ->join('students2_profile_per_year', 'students2_profile_per_year.idStudent', '=', 'students2.id')
                ->join('courses', 'students2_profile_per_year.idCurso', '=', 'courses.id')
                ->join('factura_detalles', 'pago_estudiante_detalles.id', '=', 'factura_detalles.idPagoDetalle')
                ->join('pagos_factura', 'pagos_factura.id', '=', 'factura_detalles.idFactura')
                ->join('modulo_pagos', 'pago_estudiante_detalles.idPago', '=', 'modulo_pagos.id')
                ->select('students2.nombres','students2.id AS idEstudiante', 'students2.apellidos', 'pago_estudiante_detalles.estado', 'pago_estudiante_detalles.updated_at',
                        'courses.paralelo', 'courses.grado', 'courses.especializacion', 'modulo_pagos.tipo','modulo_pagos.tipo_emision', 'pagos_factura.total AS subtotal',
                        'modulo_pagos.mes', 'modulo_pagos.idRubro', 'abonos.cantidad', 'abonos.id', 'pagos_factura.numeroFactura', 'pagos_factura.id AS idFactura', 'pagos_factura.tipo_pago', 
                        'pagos_factura.idUsuario AS idUsuario', 'pagos_factura.estatus', 'modulo_pagos.id as idPayment','tipos_pago.tipo_pago as tipo_recibo')
                ->where('pagos_factura.idUsuario', $user->id)
                ->where('pagos_factura.estatus', null)
                ->where('abonos.estatus', null)
                ->where('pagos_factura.idPeriodo', $this->idPeriodoUser())
                ->whereDate('abonos.updated_at', '>=', $request->desde)
                ->whereDate('abonos.updated_at', '<=', $request->hasta)
                ->orderBy('id')
                ->get();
            $facturas = DB::table('pago_estudiante_detalles')
                ->join('students2', 'pago_estudiante_detalles.idEstudiante', '=', 'students2.id')
                ->join('students2_profile_per_year', 'students2_profile_per_year.idStudent', '=', 'students2.id')
                ->join('courses', 'students2_profile_per_year.idCurso', '=', 'courses.id')
                ->join('factura_detalles', 'pago_estudiante_detalles.id', '=', 'factura_detalles.idPagoDetalle')
                ->join('pagos_factura', 'pagos_factura.id', '=', 'factura_detalles.idFactura')
                ->join('modulo_pagos', 'pago_estudiante_detalles.idPago', '=', 'modulo_pagos.id')
                ->join('rubros', 'modulo_pagos.idRubro', '=', 'rubros.id')
                ->select('students2.nombres','students2.id AS idEstudiante', 'students2.apellidos', 'pago_estudiante_detalles.estado', 'pago_estudiante_detalles.updated_at',
                        'courses.paralelo', 'courses.grado', 'courses.especializacion', 'modulo_pagos.tipo','modulo_pagos.tipo_emision', 'pagos_factura.total AS subtotal', 'modulo_pagos.id as idPayment',
                        'modulo_pagos.mes', 'modulo_pagos.idRubro', 'rubros.tipo_emision AS tipo_emision', 'factura_detalles.total', 'pagos_factura.id AS idFactura', 'pagos_factura.numeroFactura', 'pagos_factura.tipo_pago', 
                        'pagos_factura.idUsuario AS idUsuario', 'pagos_factura.estatus', 'modulo_pagos.id as idPayment')
                ->where('pagos_factura.idUsuario', $user->id)
                ->where('pagos_factura.estatus', null)
                ->where('pago_estudiante_detalles.estado', 'PAGADO')
                ->where('pagos_factura.idPeriodo', $this->idPeriodoUser())
                ->whereDate('pago_estudiante_detalles.updated_at', '>=', $request->desde)
                ->whereDate('pago_estudiante_detalles.updated_at', '<=', $request->hasta)
                ->whereNotIn('idFactura', $abonos->pluck('idFactura'))
                ->orderBy('idFactura')
                ->get();
        }

        $pdf = PDF::loadView('pdf.colecturia.reporte-diario', 
            compact('institution','user', 'today', 'abonos', 'rubro', 'desde', 'hasta','facturas', 'periodo'))
            ->setOrientation('landscape');
        return $pdf->download('Reporte diario.pdf');
    }

    public function reporteDiarioGeneral(Request $request) {

        $today = Carbon::today();
        $rubro = $request->rubro;
        $institution = Institution::find(1);
        $desde = $request->desde;
        $hasta = $request->hasta;
        $periodo = PeriodoLectivo::find($this->idPeriodoUser());
        $userProfile = Sentinel::getUser();
        $user = Administrative::findBySentinelid($userProfile->id);
        if($request->rubro != 'Todos'){
            $abonos = DB::table('abonos')
                ->join('pago_estudiante_detalles', 'pago_estudiante_detalles.id', '=', 'abonos.idPagoDetalle')
                ->join('tipos_pago', 'tipos_pago.idRecibo', '=', 'abonos.id')
                ->join('students2', 'pago_estudiante_detalles.idEstudiante', '=', 'students2.id')
                ->join('students2_profile_per_year', 'students2_profile_per_year.idStudent', '=', 'students2.id')
                ->join('courses', 'students2_profile_per_year.idCurso', '=', 'courses.id')
                ->join('factura_detalles', 'pago_estudiante_detalles.id', '=', 'factura_detalles.idPagoDetalle')
                ->join('pagos_factura', 'pagos_factura.id', '=', 'factura_detalles.idFactura')
                ->join('modulo_pagos', 'pago_estudiante_detalles.idPago', '=', 'modulo_pagos.id')
                ->select('students2.nombres','students2.id AS idEstudiante', 'students2.apellidos', 'pago_estudiante_detalles.estado', 'pago_estudiante_detalles.updated_at',
                        'courses.paralelo', 'courses.grado', 'courses.especializacion', 'modulo_pagos.tipo','modulo_pagos.tipo_emision', 'pagos_factura.total AS subtotal',
                        'modulo_pagos.mes', 'modulo_pagos.idRubro', 'abonos.cantidad', 'abonos.id', 'pagos_factura.numeroFactura', 'pagos_factura.id AS idFactura', 'pagos_factura.tipo_pago', 
                        'pagos_factura.idUsuario AS idUsuario', 'pagos_factura.estatus', 'modulo_pagos.id as idPayment','tipos_pago.tipo_pago as tipo_recibo')
                ->where('modulo_pagos.idRubro', $request->rubro)
                ->where('pagos_factura.estatus', null)
                ->where(function($query) { $query->where('abonos.estatus', 'PAGADO')->orWhere('abonos.estatus', null); })
                ->where('pagos_factura.idPeriodo', $this->idPeriodoUser())
                ->whereDate('abonos.updated_at', '>=', $request->desde)
                ->whereDate('abonos.updated_at', '<=', $request->hasta)
                ->orderBy('id')
                ->get();
                
            $facturas = DB::table('pago_estudiante_detalles')
                ->join('students2', 'pago_estudiante_detalles.idEstudiante', '=', 'students2.id')
                ->join('students2_profile_per_year', 'students2_profile_per_year.idStudent', '=', 'students2.id')
                ->join('courses', 'students2_profile_per_year.idCurso', '=', 'courses.id')
                ->join('factura_detalles', 'pago_estudiante_detalles.id', '=', 'factura_detalles.idPagoDetalle')
                ->join('pagos_factura', 'pagos_factura.id', '=', 'factura_detalles.idFactura')
                ->join('modulo_pagos', 'pago_estudiante_detalles.idPago', '=', 'modulo_pagos.id')
                ->join('rubros', 'modulo_pagos.idRubro', '=', 'rubros.id')
                ->select('students2.nombres','students2.id AS idEstudiante', 'students2.apellidos', 'pago_estudiante_detalles.estado', 'pago_estudiante_detalles.updated_at',
                        'courses.paralelo', 'courses.grado', 'courses.especializacion', 'modulo_pagos.tipo','modulo_pagos.tipo_emision', 'pagos_factura.total AS subtotal',
                        'modulo_pagos.mes', 'modulo_pagos.idRubro', 'rubros.tipo_emision AS tipo_emision', 'factura_detalles.total', 'pagos_factura.id AS idFactura', 'pagos_factura.numeroFactura', 'pagos_factura.tipo_pago', 
                        'pagos_factura.idUsuario AS idUsuario', 'pagos_factura.estatus', 'modulo_pagos.id as idPayment')
                ->where('modulo_pagos.idRubro', $request->rubro)
                ->where('pagos_factura.estatus', null)
                ->where('pago_estudiante_detalles.estado', 'PAGADO')
                ->where('pagos_factura.idPeriodo', $this->idPeriodoUser())
                ->whereDate('pago_estudiante_detalles.updated_at', '>=', $request->desde)
                ->whereDate('pago_estudiante_detalles.updated_at', '<=', $request->hasta)
                ->whereNotIn('idFactura', $abonos->pluck('idFactura'))
                ->orderBy('idFactura')
                ->get();

        }else{
            $abonos = DB::table('abonos')
                ->join('pago_estudiante_detalles', 'pago_estudiante_detalles.id', '=', 'abonos.idPagoDetalle')
                ->join('tipos_pago', 'tipos_pago.idRecibo', '=', 'abonos.id')
                ->join('students2', 'pago_estudiante_detalles.idEstudiante', '=', 'students2.id')
                ->join('students2_profile_per_year', 'students2_profile_per_year.idStudent', '=', 'students2.id')
                ->join('courses', 'students2_profile_per_year.idCurso', '=', 'courses.id')
                ->join('factura_detalles', 'pago_estudiante_detalles.id', '=', 'factura_detalles.idPagoDetalle')
                ->join('pagos_factura', 'pagos_factura.id', '=', 'factura_detalles.idFactura')
                ->join('modulo_pagos', 'pago_estudiante_detalles.idPago', '=', 'modulo_pagos.id')
                ->select('students2.nombres','students2.id AS idEstudiante', 'students2.apellidos', 'pago_estudiante_detalles.estado', 'pago_estudiante_detalles.updated_at',
                        'courses.paralelo', 'courses.grado', 'courses.especializacion', 'modulo_pagos.tipo','modulo_pagos.tipo_emision', 'pagos_factura.total AS subtotal',
                        'modulo_pagos.mes', 'modulo_pagos.idRubro', 'abonos.cantidad', 'abonos.id', 'pagos_factura.numeroFactura', 'pagos_factura.id AS idFactura', 'pagos_factura.tipo_pago', 
                        'pagos_factura.idUsuario AS idUsuario', 'pagos_factura.estatus', 'modulo_pagos.id as idPayment','tipos_pago.tipo_pago as tipo_recibo')
                ->where('pagos_factura.estatus', null)
                ->where(function($query) { $query->where('abonos.estatus', 'PAGADO')->orWhere('abonos.estatus', null); })
                ->where('pagos_factura.idPeriodo', $this->idPeriodoUser())
                ->whereDate('abonos.updated_at', '>=', $request->desde)
                ->whereDate('abonos.updated_at', '<=', $request->hasta)
                ->orderBy('id')
                ->get();                      
            $facturas = DB::table('pago_estudiante_detalles')
                ->join('students2', 'pago_estudiante_detalles.idEstudiante', '=', 'students2.id')
                ->join('students2_profile_per_year', 'students2_profile_per_year.idStudent', '=', 'students2.id')
                ->join('courses', 'students2_profile_per_year.idCurso', '=', 'courses.id')
                ->join('factura_detalles', 'pago_estudiante_detalles.id', '=', 'factura_detalles.idPagoDetalle')
                ->join('pagos_factura', 'pagos_factura.id', '=', 'factura_detalles.idFactura')
                ->join('modulo_pagos', 'pago_estudiante_detalles.idPago', '=', 'modulo_pagos.id')
                ->join('rubros', 'modulo_pagos.idRubro', '=', 'rubros.id')
                ->select('students2.nombres','students2.id AS idEstudiante', 'students2.apellidos', 'pago_estudiante_detalles.estado', 'pago_estudiante_detalles.updated_at',
                        'courses.paralelo', 'courses.grado', 'courses.especializacion', 'modulo_pagos.tipo','modulo_pagos.tipo_emision', 'pagos_factura.total AS subtotal',
                        'modulo_pagos.mes', 'modulo_pagos.idRubro', 'rubros.tipo_emision AS tipo_emision', 'factura_detalles.total', 'pagos_factura.id AS idFactura', 'pagos_factura.numeroFactura', 'pagos_factura.tipo_pago', 
                        'pagos_factura.idUsuario AS idUsuario', 'pagos_factura.estatus', 'modulo_pagos.id as idPayment')
                ->where('pagos_factura.estatus', null)
                ->where('pago_estudiante_detalles.estado', 'PAGADO')
                ->where('pagos_factura.idPeriodo', $this->idPeriodoUser())
                ->whereDate('pago_estudiante_detalles.updated_at', '>=', $request->desde)
                ->whereDate('pago_estudiante_detalles.updated_at', '<=', $request->hasta)
                ->whereNotIn('idFactura', $abonos->pluck('idFactura'))
                ->orderBy('idFactura')
                ->get();
        }

        $pdf = PDF::loadView('pdf.colecturia.reporte-diario', 
        compact('institution', 'pagos', 'user', 'today', 'abonos', 'rubro', 'desde', 'hasta','facturas', 'periodo'))
            ->setOrientation('landscape');
        return $pdf->download('Reporte diario General.pdf');
    }
    
    public function totalPagos() {
        try {

            $desde = '2020-01-09';
            $hasta = '2020-02-09';
    
            $abonos = DB::table('abonos')
                ->join('pago_estudiante_detalles', 'pago_estudiante_detalles.id', '=', 'abonos.idPagoDetalle')
                ->join('students2', 'pago_estudiante_detalles.idEstudiante', '=', 'students2.id')
                ->join('students2_profile_per_year', 'students2_profile_per_year.idStudent', '=', 'students2.id')
                ->join('courses', 'students2_profile_per_year.idCurso', '=', 'courses.id')
                ->join('factura_detalles', 'pago_estudiante_detalles.id', '=', 'factura_detalles.idPagoDetalle')
                ->join('pagos_factura', 'pagos_factura.id', '=', 'factura_detalles.idFactura')
                ->join('modulo_pagos', 'pago_estudiante_detalles.idPago', '=', 'modulo_pagos.id')
                ->select('students2.nombres','students2.id AS idEstudiante', 'students2.apellidos', 'pago_estudiante_detalles.estado', 'pago_estudiante_detalles.updated_at',
                        'courses.paralelo', 'courses.grado', 'courses.especializacion', 'modulo_pagos.tipo','modulo_pagos.tipo_emision', 'pagos_factura.total AS subtotal',
                        'modulo_pagos.mes', 'modulo_pagos.idRubro', 'abonos.cantidad', 'abonos.id', 'pagos_factura.numeroFactura', 'pagos_factura.id AS idFactura', 'pagos_factura.tipo_pago', 
                        'pagos_factura.idUsuario AS idUsuario', 'pagos_factura.estatus')
                ->where('pagos_factura.estatus', null)
                ->where('pagos_factura.idPeriodo', $this->idPeriodoUser())
                ->whereDate('abonos.updated_at', '>=', $desde)
                ->whereDate('abonos.updated_at', '<=', $hasta)
                ->orderBy('id')
                ->get();        
                
            $facturas = DB::table('pago_estudiante_detalles')                
            ->join('factura_detalles', 'pago_estudiante_detalles.id', '=', 'factura_detalles.idPagoDetalle')
            ->join('pagos_factura', 'pagos_factura.id', '=', 'factura_detalles.idFactura')
            ->join('users_profile', 'pagos_factura.idUsuario', '=', 'users_profile.userid')
            ->join('modulo_pagos', 'pago_estudiante_detalles.idPago', '=', 'modulo_pagos.id')
            ->join('rubros', 'modulo_pagos.idRubro', '=', 'rubros.id')
            ->select('pagos_factura.tipo_pago', 'users_profile.userid',
                    'rubros.tipo_rubro', 'pagos_factura.tipo_pago', 'pagos_factura.total',
                    'pagos_factura.numeroFactura',
                    DB::raw("CONCAT(users_profile.apellidos, ' ', users_profile.nombres) as usuario")
                    )
            ->where('pagos_factura.estatus', null)
            ->where('pago_estudiante_detalles.estado', 'PAGADO')
            ->where('pagos_factura.idPeriodo', $this->idPeriodoUser())
            ->whereDate('pago_estudiante_detalles.updated_at', '>=', $desde)
            ->whereDate('pago_estudiante_detalles.updated_at', '<=', $hasta)
            ->whereNotIn('idFactura', $abonos->pluck('idFactura'))
            ->get()
            ->groupBy('tipo_pago');
            $data = [];
            foreach ($facturas as $key => $factura) {
               
                $grouped['tipo_pago'] = $key;
                $grouped['monto'] = bcdiv( $factura->sum('total'), '1', 2);
                array_push($data, (object)$grouped);
            }
            return $data;
        } catch (\Exception $e) {
            return  $e->getMessage();
        }   
        
    }

    public function totalDetallePagos() {
        try {

            $desde = '2020-01-09';
            $hasta = '2020-02-09';
    
            $abonos = DB::table('abonos')
                ->join('pago_estudiante_detalles', 'pago_estudiante_detalles.id', '=', 'abonos.idPagoDetalle')
                ->join('students2', 'pago_estudiante_detalles.idEstudiante', '=', 'students2.id')
                ->join('students2_profile_per_year', 'students2_profile_per_year.idStudent', '=', 'students2.id')
                ->join('courses', 'students2_profile_per_year.idCurso', '=', 'courses.id')
                ->join('factura_detalles', 'pago_estudiante_detalles.id', '=', 'factura_detalles.idPagoDetalle')
                ->join('pagos_factura', 'pagos_factura.id', '=', 'factura_detalles.idFactura')
                ->join('modulo_pagos', 'pago_estudiante_detalles.idPago', '=', 'modulo_pagos.id')
                ->select('students2.nombres','students2.id AS idEstudiante', 'students2.apellidos', 'pago_estudiante_detalles.estado', 'pago_estudiante_detalles.updated_at',
                        'courses.paralelo', 'courses.grado', 'courses.especializacion', 'modulo_pagos.tipo','modulo_pagos.tipo_emision', 'pagos_factura.total AS subtotal',
                        'modulo_pagos.mes', 'modulo_pagos.idRubro', 'abonos.cantidad', 'abonos.id', 'pagos_factura.numeroFactura', 'pagos_factura.id AS idFactura', 'pagos_factura.tipo_pago', 
                        'pagos_factura.idUsuario AS idUsuario', 'pagos_factura.estatus')
                ->where('pagos_factura.estatus', null)
                ->where('pagos_factura.idPeriodo', $this->idPeriodoUser())
                ->whereDate('abonos.updated_at', '>=', $desde)
                ->whereDate('abonos.updated_at', '<=', $hasta)
                ->orderBy('id')
                ->get();        
                
            $facturas = DB::table('pago_estudiante_detalles')                
            ->join('factura_detalles', 'pago_estudiante_detalles.id', '=', 'factura_detalles.idPagoDetalle')
            ->join('pagos_factura', 'pagos_factura.id', '=', 'factura_detalles.idFactura')
            ->join('users_profile', 'pagos_factura.idUsuario', '=', 'users_profile.userid')
            ->join('modulo_pagos', 'pago_estudiante_detalles.idPago', '=', 'modulo_pagos.id')
            ->join('rubros', 'modulo_pagos.idRubro', '=', 'rubros.id')
            ->select('rubros.tipo_emision AS tipo_emision', 'users_profile.userid',
                    'rubros.tipo_rubro', 'pagos_factura.tipo_pago', 'pagos_factura.total',
                    'pagos_factura.numeroFactura',
                    DB::raw("CONCAT(users_profile.apellidos, ' ', users_profile.nombres) as usuario")
                    )
            ->where('pagos_factura.estatus', null)
            ->where('pago_estudiante_detalles.estado', 'PAGADO')
            ->where('pagos_factura.idPeriodo', $this->idPeriodoUser())
            ->whereDate('pago_estudiante_detalles.updated_at', '>=', $desde)
            ->whereDate('pago_estudiante_detalles.updated_at', '<=', $hasta)
            ->whereNotIn('idFactura', $abonos->pluck('idFactura'))
            ->get()
            ->groupBy('usuario');
            $data = [];
            foreach ($facturas as $key => $factura) {
                foreach($factura->groupBy('tipo_rubro') as $keyRubro => $item) {
                    $grouped['usuario'] = $key;
                    $grouped['rubro'] = $keyRubro;
                    $grouped['monto'] = bcdiv( $item->sum('total'), '1', 2);
                    array_push($data, (object)$grouped);
                }
            }
            return $data;
        } catch (\Exception $e) {
            return  $e->getMessage();
        }  
    }
}