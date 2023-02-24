<?php

namespace App\Http\Controllers;

use App\ConfiguracionSistema;
use App\Fechas;
use App\Institution;
use App\PagoEstudianteDetalle;
use App\Payment;
use App\Student2Profile;
use App\Student2;
use App\Course;
use App\Career;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\PeriodoLectivo;
use App\UnidadPeriodica;
use App\ParcialPeriodico;
use PDF;
use Sentinel;

use App\careerStudents;

class ReportesInstitucionalesController extends Controller
{
	public function pagareConVencimientos($id) {
		$student = Student2Profile::getStudent($id);
		$pagos = PagoEstudianteDetalle::getDetailPaymentsByStudent( $student->idStudent,$student->idCurso );
		$institution = Institution::first();
		$periodoLectivo = Institution::periodoLectivo();
		$dia_pago = (int) ConfiguracionSistema::diaDePago()->valor;
		$pagoTotal = 0;

		foreach ($pagos as $pago) {
			$fecha_pago[$pago->id] = substr(Carbon::createFromDate($pago->pago->anio, $pago->pago->mes+1, $dia_pago),0,10);
			if ($pago->pago->rubro->tipo_rubro == 'Pension')
				$pagoTotal += PagoEstudianteDetalle::descuento($pago);
		}
		$valorMes = 0;
		foreach ($pagos as $pago) {
			if ($pago->pago->rubro->tipo_rubro == 'Pension') {
				$valorMes = bcdiv(PagoEstudianteDetalle::descuento($pago), '1', 2);
				break;
			}
		}
		$valor_cancelar = [];
		foreach ($pagos as $pago) {
			$pago_estudiante = PagoEstudianteDetalle::descuento($pago);
			$valor_cancelar[$pago->id] = bcdiv($pago_estudiante, '1', 2);
		}

		$pdf = PDF::loadView('pdf.reporteInstitucionales.pagare-con-vencimientos', compact(
			'institution', 'periodoLectivo', 'pagos', 'student', 'fecha_pago', 'pagoTotal', 'valorMes', 'valor_cancelar'
		));

		return $pdf->download('Pagaré con vencimientos sucesivos.pdf');
	}

	public function noAceptacionDelSeguro($id) {
		$id;
		$student = Student2Profile::getStudent($id);
		$institution = Institution::first();
		$periodoLectivo = Institution::periodoLectivo();
		$fecha = Fechas::fechaMatricula(Carbon::now());
		$pdf = PDF::loadView('pdf.reporteInstitucionales.no-aceptacion-del-seguro', compact(
			'student', 'institution', 'periodoLectivo', 'fecha'
		));

		return $pdf->download("No Aceptación del Seguro({$student->apellidos} {$student->nombres}).pdf");
	}

	public function registroDeIngresoYSalidaDeEstudiantes($id) {
		$student = Student2Profile::getStudent($id);
		$institution = Institution::first();
		$periodoLectivo = Institution::periodoLectivo();
		$pdf = PDF::loadView('pdf.reporteInstitucionales.registro-de-ingreso-y-salida-de-estudiantes', compact(
			'student', 'institution', 'periodoLectivo'
		));

		return $pdf->download("Registro de ingreso y salida de estudiantes({$student->apellidos} {$student->nombres}).pdf");
	}

	public function prestacionServiciosEducacionales($id) {
		$student = Student2Profile::getStudent($id);
        $institution = Institution::first();
		$pagosE = PagoEstudianteDetalle::where('idEstudiante', $student->idStudent)->where('idPeriodo', Sentinel::getUser()->idPeriodoLectivo)->get();
		$totalapagar = 0;
		$matricula = "________";
		foreach ($pagosE as $pagoE) {
			$tiporubro = $pagoE->pago->rubro->tipo_rubro;
			if ($tiporubro == 'Pension' || $tiporubro == 'PENSION' || $tiporubro == 'Pensión'){
				$totalapagar += PagoEstudianteDetalle::descuento($pagoE);
			} else if ($tiporubro == 'Matricula' || $tiporubro == 'MATRICULA' || $tiporubro == 'Matrícula'){
				$matricula = $pagoE->pago->valor_cancelar;
			}
		}
        $unidades = UnidadPeriodica::unidadP();
        $parcialI = ParcialPeriodico::parcialP($unidades->first()->id)->first()->fechaI;
        $parcialF = ParcialPeriodico::parcialP($unidades->last()->id)->where('identificador', '!=', ($unidades->last()->identificador) )->last()->fechaF;
        $inicio = Fechas::obtenerMes( date('m',strtotime($parcialI)) );
        $fin = Fechas::obtenerMes( date('m',strtotime($parcialF)) );
        $periodoLectivo = PeriodoLectivo::getPeriodo(Sentinel::getUser()->idPeriodoLectivo);
		$periodo = PeriodoLectivo::find(Sentinel::getUser()->idPeriodoLectivo);
		$course = Course::find($student->idCurso);
		$curso="";
		switch ($course->grado){
			case'Inicial 1':
				$curso="";
				break;
			case'Inicial 2':
				$curso= ($course->paralelo == "A (3-4 AÑOS)") ? "Grado Inicial 2 Grupo 3 años" : "Grado Inicial  2 Grupo 4 años";
				break;
			case'Primero':
				$curso="Primer Grado de Educación General Básica Preparatoria";
				break;
			case'Segundo':
				$curso="Segundo Grado de Educación General Básica Elemental";
				break;
			case'Tercero':
				$curso="Tercer Grado de Educación General Básica Elemental";
				break;
			case'Cuarto':
				$curso="Cuarto Grado de Educación General Básica Elemental";
				break;
			case'Quinto':
				$curso="Quinto Grado de Educación General Básica Media";
				break;
			case'Sexto':
				$curso="Sexto Grado de Educación General Básica Media";
				break;
			case'Septimo':
				$curso="Septimo Grado de Educación General Básica Media";
				break;
			case'Octavo':
				$curso="Octavo Grado de Educación General Básica Superior";
				break;
			case'Noveno':
				$curso="Noveno Grado de Educación General Básica Superior";
				break;
			case'Decimo':
				$curso="Décimo Grado de Educación General Básica Superior";
				break;
			case'Primero de Bachillerato':
				$curso="Primer Curso de Bachillerato General Unificado  {$course->especializacion}";
				break;
			case'Segundo de Bachillerato':
				$curso="Segundo Curso de Bachillerato General Unificado  {$course->especializacion}";
				break;
			case'Tercero de Bachillerato':
				$curso="Tercer Curso de Bachillerato General Unificado  {$course->especializacion}";
				break;
        }

        $contrato = ConfiguracionSistema::ContratoEconomico($this->idPeriodoUser())->valor;
        $dias = ConfiguracionSistema::diaDePago()->valor;
		$fechaMesAno = Fechas::fechaActualMY();

        //modular provisional
		$owner = 'Congregación de Padres Pasionistas propietaria de';
		$representativeInstitution = 'el PADRE MIGUEL MATILLA';
		$institutionSiglas = 'U.E.P.';
		$institutionType = 'Unidad Educativa Particular Católica';
        //------------------

		if ($contrato == 2){
			$pdf = PDF::loadView('pdf.reporteInstitucionales.contrato-economico-formato-2', compact(
				'student', 'institution', 'periodoLectivo', 'curso', 'contrato', 'fin', 'inicio', 'dias', 'periodo', 'totalapagar', 'matricula'
			));
		} else if ($contrato == 1){
			$pdf = PDF::loadView('pdf.reporteInstitucionales.contrato-economico-de-prestacion-de-servicios-educacionales', compact(
				'student', 'institution', 'periodoLectivo', 'curso', 'contrato', 'fin', 'inicio', 'dias'
			));
		} else if ($contrato == 3){
			$pdf = PDF::loadView('pdf.reporteInstitucionales.contrato-economico-formato-3', compact(
				'student', 'institution', 'periodoLectivo', 'curso', 'contrato', 'fin', 'inicio', 'dias', 'periodo', 'totalapagar', 'matricula', 'owner', 'representativeInstitution', 'institutionSiglas', 'institutionType', 'fechaMesAno'
			));
		}

		return $pdf->download("Contrato servicios.pdf");
	}

	public function actaDeMatricula($id) {
		$student = Student2Profile::getStudent($id);
		$institution = Institution::first();
		$periodoLectivo = Institution::periodoLectivo();
		$course = Course::find($student->idCurso);

		$curso="";
		switch ($course->grado){
			case'Inicial 1':
				$curso= "$course->grado $course->paralelo";
				break;
			case'Inicial 2':
				$curso= ($course->paralelo == "A (3-4 AÑOS)") ? "Inicial 2 Grupo 3 años" : "Inicial  2 Grupo 4 años";
				break;
			case'Primero':
				$curso="Primer Grado de Educación General Básica Preparatoria Paralelo {$course->paralelo}";
				break;
			case'Segundo':
				$curso="Segundo Grado de Educación General Básica Elemental Paralelo {$course->paralelo}";
				break;
			case'Tercero':
				$curso="Tercer Grado de Educación General Básica Elemental Paralelo {$course->paralelo}";
				break;
			case'Cuarto':
				$curso="Cuarto Grado de Educación General Básica Elemental Paralelo {$course->paralelo}";
				break;
			case'Quinto':
				$curso="Quinto Grado de Educación General Básica Media Paralelo {$course->paralelo}";
				break;
			case'Sexto':
				$curso="Sexto Grado de Educación General Básica Media Paralelo {$course->paralelo}";
				break;
			case'Septimo':
				$curso="Septimo Grado de Educación General Básica Media Paralelo {$course->paralelo}";
				break;
			case'Octavo':
				$curso="Octavo Grado de Educación General Básica Superior Paralelo {$course->paralelo}";
				break;
			case'Noveno':
				$curso="Noveno Grado de Educación General Básica Superior Paralelo {$course->paralelo}";
				break;
			case'Decimo':
				$curso="Décimo Grado de Educación General Básica Superior Paralelo {$course->paralelo}";
				break;
			case'Primero de Bachillerato':
				$curso="Primer Curso de Bachillerato General Unificado  {$course->especializacion} Paralelo {$course->paralelo}";
				break;
			case'Segundo de Bachillerato':
				$curso="Segundo Curso de Bachillerato General Unificado  {$course->especializacion} Paralelo {$course->paralelo}";
				break;
			case'Tercero de Bachillerato':
				$curso="Tercer Curso de Bachillerato General Unificado  {$course->especializacion} Paralelo {$course->paralelo}";
				break;
		}


		$pdf = PDF::loadView('pdf.reporteInstitucionales.acta-de-matricula', compact(
			'institution', 'student', 'periodoLectivo' , 'curso'
		));

		return $pdf->download("Acta de matrícula({$student->apellidos} {$student->nombres}).pdf");
	}

	public function solicitudDeAdmision($id) {
		$student = Student2Profile::getStudent($id);
		$institution = Institution::first();
		if ($student->matricula = 'Ordinaria') {
			$fNacimiento = date("d/m/Y", strtotime($student->fechaNacimiento));
	    }else{
			$fNacimiento = $student->fechaNacimiento;
		}
		$edad = Carbon::createFromFormat('d/m/Y', $fNacimiento)->diff(Carbon::now())->format('%y años');
		$fecha = Fechas::fechaActual();
		$pdf = PDF::loadView('pdf.reporteInstitucionales.solicitud-de-matricula2', compact(
			'institution', 'student', 'edad', 'fecha'
		));

		return $pdf->download("Solicitud de Matrícula({$student->apellidos} {$student->nombres}).pdf");
	}

	public function informacionPersonalMatricula($id) {
		$student = Student2Profile::getStudent($id);
		$student2 = Student2::findOrFail($student->idStudent);
		$institution = Institution::first();
		$curso = Course::find($student->idCurso);
        $carrera = Career::find($curso->id_career);

		$periodo ='';//lo uso para poder imprrimir el reporte en la siguiente funcion desde admisiones-representante
		$pdf = PDF::loadView('pdf.reporteInstitucionales.informacion-pesonal-para-matricula', compact(
			'institution', 'student', 'student2', 'curso','periodo','carrera'
		));

		return $pdf->download("Información personal para matrícula({$student->apellidos} {$student->nombres}).pdf");
	}
	public function informacionPersonalMatriculaAdmision($id,$periodo) {
		$student = Student2Profile::getStudentAdmision($id,$periodo);
		$student2 = Student2::findOrFail($student->idStudent);
		$institution = Institution::first();
		$periodo = PeriodoLectivo::findOrFail($periodo);
		$curso = Course::find($student->idCurso);
		$carrera = Career::where('id', $curso->id_career)
		->first();
		//$carrera = course::join("Semesters", "Semesters.id", "=", "courses.id_career")->join("Career", "Career.id", "=", "Semesters.career_id")
        //->select("Career.nombre")->where("courses.id_career","=",$id)                     
        //->first();
	
		$pdf = PDF::loadView('pdf.reporteInstitucionales.informacion-pesonal-para-matricula', compact(
			'institution', 'student', 'student2', 'curso','periodo','carrera'
		));

		return $pdf->download("Información personal para matrícula({$student->apellidos} {$student->nombres}).pdf");
	}

	public function informacionPersonalMatricula_vacia() {
		$institution = Institution::first();
		$pdf = PDF::loadView('pdf.reporteInstitucionales.informacion-pesonal-para-matricula-vacia', compact('institution'));

		return $pdf->download("Información personal para matrícula.pdf");
	}

	public function solicitudDeMatricula($id) {
		$student = Student2Profile::getStudent($id);
		$pagoInicial = Payment::where('idCurso', $student->idCurso)
			->where('idPeriodo', Sentinel::getUser()->idPeriodoLectivo)
			->where('tipo', 'Pension')
			->first();
		$pagoFinal = Payment::where('idCurso', $student->idCurso)
			->orderBy('id', 'DESC')
			->where('tipo', 'Pension')
			->where('idPeriodo', Sentinel::getUser()->idPeriodoLectivo)
			->first();
		// $pagoInicioFin = null;
		if ($pagoInicial != null || $pagoFinal != null) {
			$pagoInicioFin = Fechas::obtenerMes($pagoInicial->mes).' '.$pagoInicial->anio.' hasta '.Fechas::obtenerMes($pagoFinal->mes).' del '.$pagoFinal->anio;
		}
		$institution = Institution::first();
		$fecha = Fechas::fechaActual();
		$pdf = PDF::loadView('pdf.reporteInstitucionales.solicitud-de-matricula2', compact(
			'student', 'institution', 'fecha', 'pagoInicioFin'
		));

		return $pdf->download("Solicitud de matrícula({$student->apellidos} {$student->nombres}).pdf");
	}

}
