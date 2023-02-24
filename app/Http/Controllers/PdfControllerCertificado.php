<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Student2;
use App\Administrative;
use App\Parents;
use App\Course;
use App\Institution;
use App\PeriodoLectivo;
use App\Fechas;
use App\Certificado;
use App\Matter;
use App\Notificaciones;
use App\Activity;
use App\Supply;
use App\Calificacion;
use App\ConfiguracionSistema;
use App\Student2Profile;
use NumerosEnLetras;
use Sentinel;
use PDF;
use DB;
use Exception;
use Illuminate\Support\Facades\Redirect;
use App\UnidadPeriodica;
use App\ParcialPeriodico;


class PdfControllerCertificado extends Controller
{
    /*
    Certificado de Matrícula por estudiante
    */

    public function CertificadoMatricula($idAlumno){
        $students = Student2Profile::getStudent($idAlumno);
        $course = Course::find($students->idCurso);
        $educacion = "";
        $educacion = Calificacion::nombreSeccionDetallada($course);
        $institution = Institution::find(1);
        $periodo = PeriodoLectivo::findOrFail($this->idPeriodoUser());
        $hoy = Fechas::fechaActual();
        $fechaMatricula = Fechas::fechaMatricula($students->fecha_matriculacion ?? $students->created_at);
        $certificado_matricula = ConfiguracionSistema::certificadoMatricula();
        $students = array($students);
        if ($certificado_matricula->valor==='2') {
            $pdf =  PDF::loadView('pdf.reportes-por-curso.estudiantes.certificado-matricula',
                compact('educacion', 'students', 'course', 'institution', 'periodo', 'hoy',
                'fechaMatricula'));
        } else if ($certificado_matricula->valor==='1') {
            $pdf =  PDF::loadView('pdf.reportes-por-curso.estudiantes.certificado',
                compact('educacion', 'students', 'course', 'institution', 'periodo', 'hoy',
                'fechaMatricula'));
        }
        return $pdf->download('Certificado de Matricula.pdf');
    }

    // Certificado de Matrícula por curso

    public function CertificadoMatriculaCurso($idCurso){
        $students = Student2Profile::getStudentsByCourse($idCurso);
        $course = Course::find($idCurso);
        $educacion = Calificacion::nombreSeccionDetallada($course);
        $institution = Institution::find(1);
        $periodo = PeriodoLectivo::findOrFail($this->idPeriodoUser());
        $hoy = Fechas::fechaActual();
        $certificado_matricula = ConfiguracionSistema::certificadoMatricula();
        if ($certificado_matricula->valor==='2') {
            $pdf =  PDF::loadView('pdf.reportes-por-curso.estudiantes.certificado-matricula',
                compact('educacion', 'students', 'course', 'institution', 'periodo', 'hoy' ));
        } else if ($certificado_matricula->valor==='1') {
            $pdf =  PDF::loadView('pdf.reportes-por-curso.estudiantes.certificado',
                compact('educacion', 'students', 'course', 'institution', 'periodo', 'hoy' ));
        }
        return $pdf->download('Certificado de Matricula.pdf');
    }

    public function invoiceFecha($idAlumno,$fecha){
        $student = Student2::find($idAlumno);
        $course = Course::find($student->idCurso);
        $educacion = "";
        switch($course->grado){
            case "Inicial 1":
                $educacion = $course->seccion." - Educacion Inicial";
            break;
            case "Inicial 2":
                $educacion = $course->seccion." - Educacion Inicial";
            break;
            case "Primero":
                $educacion = $course->seccion." - Preparatoria";
            break;
            case "Segundo":
                $educacion = $course->seccion." - Basica Elemental";
            break;
            case "Tercero":
                $educacion = $course->seccion." - Basica Elemental";
            break;
            case "Cuarto":
                $educacion = $course->seccion." - Basica Elemental";
            break;
            case "Quinto":
                $educacion = $course->seccion." - Basica Media";
            break;
            case "Sexto":
                $educacion = $course->seccion." - Basica Media";
            break;
            case "Septimo":
                $educacion = $course->seccion." - Basica Media";
            break;
            case "Octavo":
                $educacion = $course->seccion." - Basica Superior";
            break;
            case "Noveno":
                $educacion = $course->seccion." - Basica Superior";
            break;
            case "Decimo":
                $educacion = $course->seccion." - Basica Superior";
            break;
            case "Primero de Bachillerato":
                $educacion = $course->seccion." - Bachillerato General Unificado";
            break;
            case "Segundo de Bachillerato":
                $educacion = $course->seccion." - Bachillerato General Unificado";
            break;
            case "Tercero de Bachillerato":
                $educacion = $course->seccion." - Bachillerato General Unificado";
            break;

        }

        $institucion = Institution::find(1);

        setlocale(LC_TIME, 'Spanish');
        Carbon::setUtf8(true);

        $now = Carbon::parse($fecha);

        $lectivo = Carbon::now();
        $year = $lectivo->year. " - ".$lectivo->addYear()->year;


        $pdf =  PDF::loadView('pdf.certificado',
        compact('educacion', 'year', 'student', 'course', 'institucion',
        'now'));

        return $pdf->download('certificado_matricula.pdf');
    }
    /**/


    /*
    Certificado de Asistencia
    */
    public function certificadoAsistencia($idAlumno){
        $student = Student2Profile::getStudent($idAlumno);
        if($student!=null){
			$course = Course::findOrFail($student->idCurso);
            $educacion = "";
                    switch ($course->grado){
            case'Inicial 1':
                $educacion= "$course->grado $course->paralelo";
                break;
            case'Inicial 2':
                $educacion= ($course->paralelo == "A (3-4 AÑOS)") ? "Inicial 2 Grupo 3 años" : "Inicial  2 Grupo 4 años";
                break;
            case'Primero':
                $educacion="Primer Grado de Educación General Básica Preparatoria Paralelo {$course->paralelo}";
                break;
            case'Segundo':
                $educacion="Segundo Grado de Educación General Básica Elemental Paralelo {$course->paralelo}";
                break;
            case'Tercero':
                $educacion="Tercer Grado de Educación General Básica Elemental Paralelo {$course->paralelo}";
                break;
            case'Cuarto':
                $educacion="Cuarto Grado de Educación General Básica Elemental Paralelo {$course->paralelo}";
                break;
            case'Quinto':
                $educacion="Quinto Grado de Educación General Básica Media Paralelo {$course->paralelo}";
                break;
            case'Sexto':
                $educacion="Sexto Grado de Educación General Básica Media Paralelo {$course->paralelo}";
                break;
            case'Septimo':
                $educacion="Septimo Grado de Educación General Básica Media Paralelo {$course->paralelo}";
                break;
            case'Octavo':
                $educacion="Octavo Grado de Educación General Básica Superior Paralelo {$course->paralelo}";
                break;
            case'Noveno':
                $educacion="Noveno Grado de Educación General Básica Superior Paralelo {$course->paralelo}";
                break;
            case'Decimo':
                $educacion="Décimo Grado de Educación General Básica Superior Paralelo {$course->paralelo}";
                break;
            case'Primero de Bachillerato':
                $educacion="Primer Curso de Bachillerato General Unificado  {$course->especializacion} Paralelo {$course->paralelo}";
                break;
            case'Segundo de Bachillerato':
                $educacion="Segundo Curso de Bachillerato General Unificado  {$course->especializacion} Paralelo {$course->paralelo}";
                break;
            case'Tercero de Bachillerato':
                $educacion="Tercer Curso de Bachillerato General Unificado  {$course->especializacion} Paralelo {$course->paralelo}";
                break;
            }
            $certAsistencia = ConfiguracionSistema::certAsistencia()->valor;
            $institution = Institution::first();
            $periodo = PeriodoLectivo::getPeriodo(Sentinel::getUser()->idPeriodoLectivo);
            $hoy = Fechas::fechaActual();
            if ($certAsistencia=='1') {
                $pdf =  PDF::loadView('pdf.reportes-por-curso.estudiantes.certificado-asistencia',
            compact('educacion', 'student', 'course', 'institution', 'periodo',
            'hoy'));
            }elseif($certAsistencia=='2'){
            $pdf =  PDF::loadView('pdf.reportes-por-curso.estudiantes.certificado-asistencia2',
            compact('educacion', 'student', 'course', 'institution', 'periodo',
            'hoy'));
            }


            return $pdf->download('Certificado de Asistencia.pdf');
        }
    }
    /**/


    /*
    Certificado de Comportamiento
    */
    public function certificadoComportamiento($idAlumno, $parcial){
		try {
			$periodo = PeriodoLectivo::find(Sentinel::getUser()->idPeriodoLectivo);
            $student = Student2::find($idAlumno);
            $student2peryear = $student->profilePerYear()->where('idPeriodo', $periodo->id)->first();
			if ($student->comportamientos()->where('parcial', $parcial)->first() == null) {
				throw new Exception("Lo sentimos, el comportamiento del ".Notificaciones::obtenerParcialActual($parcial)." aún no se ha ingresado.");
			}
			$course = Course::find($student2peryear->idCurso);
			$educacion = "";
			switch($course->grado){
				case "Inicial 1":
				$educacion = $course->seccion." - Educacion Inicial";
				break;
				case "Inicial 2":
					$educacion = $course->seccion." - Educacion Inicial";
				break;
				case "Primero":
					$educacion = $course->seccion." - Preparatoria";
				break;
				case "Segundo":
					$educacion = $course->seccion." - Basica Elemental";
				break;
				case "Tercero":
					$educacion = $course->seccion." - Basica Elemental";
				break;
				case "Cuarto":
					$educacion = $course->seccion." - Basica Elemental";
				break;
				case "Quinto":
					$educacion = $course->seccion." - Basica Media";
				break;
				case "Sexto":
					$educacion = $course->seccion." - Basica Media";
				break;
				case "Septimo":
					$educacion = $course->seccion." - Basica Media";
				break;
				case "Octavo":
					$educacion = $course->seccion." - Basica Superior";
				break;
				case "Noveno":
					$educacion = $course->seccion." - Basica Superior";
				break;
				case "Decimo":
					$educacion = $course->seccion." - Basica Superior";
				break;
				case "Primero de Bachillerato":
					$educacion = $course->seccion." - Bachillerato General Unificado";
				break;
				case "Segundo de Bachillerato":
					$educacion = $course->seccion." - Bachillerato General Unificado";
				break;
				case "Tercero de Bachillerato":
					$educacion = $course->seccion." - Bachillerato General Unificado";
				break;

			}
			$institution = Institution::find(1);
			$hoy = Fechas::fechaActual();

			$grado = Certificado::curso($student2peryear->idCurso);
			$pdf = PDF::loadView('pdf.reportes-por-curso.estudiantes.certificado-comportamiento',
			compact('educacion', 'student', 'course',
			'institution', 'periodo', 'hoy', 'grado', 'parcial'));

				return $pdf->download('Certificado de Comportamiento.pdf');
		} catch (Exception $e) {
			return Redirect::back()->withErrors(['error' => $e->getMessage()]);
		}
    }
    /**/


    /*
    Hoja de Vida
    */
    public function hojaDeVida($idEstudiante){
        $institution = Institution::find(1);
		$estudiante = Student2Profile::getStudent($idEstudiante);
		$representante = Administrative::find($estudiante->idRepresentante);
		if ($representante == null)
			$representante = new Administrative();
		$padre = Parents::find($estudiante->idPadre);
		if($padre == null)
			$padre = new Parents();
		$madre = Parents::find($estudiante->idMadre);
		if($madre == null)
			$madre = new Parents();
		$periodo = PeriodoLectivo::findOrFail($this->idPeriodoUser());
		$periodoAnterior = Carbon::createFromFormat('Y', substr($periodo->nombre,0,4))->addYears(-1)->format('Y');
		$periodoActual = Carbon::createFromFormat('Y', substr($periodo->nombre,0,4))->format('Y');
		$periodoAnterior = PeriodoLectivo::where('nombre', "$periodoAnterior-$periodoActual")->first();
		$gradoAnterior = null;
		if($periodoAnterior != null) {
			$gradoAnterior = Student2Profile::where('idStudent', $idEstudiante)->where('idPeriodo', $periodoAnterior->id)->first();
		}

		$course = Course::findOrFail($estudiante->idCurso);
        $educacion = "";
        switch($course->grado){
            case "Inicial 1":
                $educacion = $course->seccion." - Educacion Inicial";
                break;
            case "Inicial 2":
                    $educacion = $course->seccion." - Educacion Inicial";
                break;
            case "Primero":
                    $educacion = $course->seccion." - Preparatoria";
                break;
            case "Segundo":
                    $educacion = $course->seccion." - Basica Elemental";
                break;
            case "Tercero":
                    $educacion = $course->seccion." - Basica Elemental";
                break;
            case "Cuarto":
                    $educacion = $course->seccion." - Basica Elemental";
                break;
            case "Quinto":
                    $educacion = $course->seccion." - Basica Media";
                break;
            case "Sexto":
                    $educacion = $course->seccion." - Basica Media";
                break;
            case "Septimo":
                    $educacion = $course->seccion." - Basica Media";
                break;
            case "Octavo":
                    $educacion = $course->seccion." - Basica Superior";
                break;
            case "Noveno":
                    $educacion = $course->seccion." - Basica Superior";
                break;
            case "Decimo":
                    $educacion = $course->seccion." - Basica Superior";
                break;
            case "Primero de Bachillerato":
                    $educacion = $course->seccion." - Bachillerato General Unificado";
                break;
            case "Segundo de Bachillerato":
                    $educacion = $course->seccion." - Bachillerato General Unificado";
                break;
            case "Tercero de Bachillerato":
                    $educacion = $course->seccion." - Bachillerato General Unificado";
                break;
        }

		$pdf = PDF::loadView('pdf.hoja-de-vida', compact(
			'institution', 'estudiante', 'representante', 'padre', 'madre', 'course', 'educacion',
			'gradoAnterior'
		));

        return $pdf->download('Hoja de vida.pdf');
    }
    /**/


    /*
    Certificado de Promoción
    */
    public function certificadoPromocionEstudiante($idCurso){
            $unidad = UnidadPeriodica::all();
            $students = Student2Profile::getStudentsByCourse($idCurso);            
            $curso = Course::find($idCurso);
            $tutor = Administrative::find($curso->idProfesor);
            $institution = Institution::first();
            $notasMenores = ConfiguracionSistema::notasRojo()->valor;
            $nota_menor = ConfiguracionSistema::notaMenorRojo();
            $confComportamiento = ConfiguracionSistema::comportamientoQuimestral();
            $periodo = PeriodoLectivo::where('id', Sentinel::getUser()->idPeriodoLectivo)->first();
            
            //Grado Actual
            $educacion = "";
            switch($curso->grado){
                case "Inicial 1":$educacion = " - Educacion Inicial";break;
                case "Inicial 2":$educacion = " - Educacion Inicial";break;
                case "Primero":$educacion = "DE EDUCACIÓN GENERAL BÁSICA - Preparatoria";break;
                case "Segundo":$educacion = "Segundo Grado DE EDUCACIÓN GENERAL BÁSICA - Basica Elemental";break;
                case "Tercero":$educacion = "Tercer Grado DE EDUCACIÓN GENERAL BÁSICA - Basica Elemental";break;
                case "Cuarto":$educacion = "Cuarto Grado DE EDUCACIÓN GENERAL BÁSICA - Basica Elemental";break;
                case "Quinto": $educacion = "Quinto Grado DE EDUCACIÓN GENERAL BÁSICA - Basica Media"; break;
                case "Sexto": $educacion = "Sexto Grado DE EDUCACIÓN GENERAL BÁSICA - Basica Media"; break;
                case "Septimo": $educacion = "Septimo Grado DE EDUCACIÓN GENERAL BÁSICA - Basica Media"; break;
                case "Octavo": $educacion = "Octavo Grado DE EDUCACIÓN GENERAL BÁSICA - Basica Superior"; break;
                case "Noveno": $educacion = "Noveno Grado DE EDUCACIÓN GENERAL BÁSICA - Basica Superior"; break;
                case "Decimo": $educacion = "Decimo Grado DE EDUCACIÓN GENERAL BÁSICA - Basica Superior"; break;
                case "Primero de Bachillerato":
                    if($curso->especializacion != "Ciencias")
                        $educacion = "Primer Año De Bachillerato General Unificado, Especialización: ";
                    else
                        $educacion = "Primer Año De Bachillerato General Unificado, ";
                    break;
                case "Segundo de Bachillerato":
                    if($curso->especializacion != "Ciencias")
                        $educacion = "Segundo Año De Bachillerato General Unificado, Especialización: ";
                    else
                        $educacion = "Segundo Año De Bachillerato General Unificado, ";
                    break;
                case "Tercero de Bachillerato":
                    if ($curso->especializacion == null){
                        $educacion = "Tercer Año De Bachillerato General Unificado, ";
                        break;
                    }else if($curso->especializacion != "Ciencias"){
                        $educacion = "Tercer Año De Bachillerato General Unificado, Especialización: ";
                    }else {
                        $educacion = "Tercer Año De Bachillerato General Unificado, ";
                    }
            }

            //Grado Siguiente
            $gradoSiguiente = "";
            $especializacionSig = "";
            switch($curso->grado){
                case "Inicial 1": $gradoSiguiente = "Inicial 2"; break;
                case "Inicial 2": $gradoSiguiente = "Primer Año de Educación Básica"; break;
                case "Primero":
                    $gradoSiguiente = "Segundo Grado DE EDUCACIÓN GENERAL BÁSICA - Basica Elemental";
                break;
                case "Segundo":
                    $gradoSiguiente = "Tercer Grado DE EDUCACIÓN GENERAL BÁSICA - Basica Elemental";
                break;
                case "Tercero":
                    $gradoSiguiente = "Cuarto Grado DE EDUCACIÓN GENERAL BÁSICA - Basica Elemental";
                break;
                case "Cuarto":
                    $gradoSiguiente = "Quinto Grado DE EDUCACIÓN GENERAL BÁSICA - Basica Media";
                break;
                case "Quinto":
                    $gradoSiguiente = "Sexto Grado DE EDUCACIÓN GENERAL BÁSICA - Basica Media";
                break;
                case "Sexto":
                    $gradoSiguiente = "Septimo Grado DE EDUCACIÓN GENERAL BÁSICA - Basica Media";
                break;
                case "Septimo":
                    $gradoSiguiente = "Octavo Grado DE EDUCACIÓN GENERAL BÁSICA - Basica Superior";
                break;
                case "Octavo":
                    $gradoSiguiente = "Noveno Grado DE EDUCACIÓN GENERAL BÁSICA - Basica Superior";
                break;
                case "Noveno":
                    $gradoSiguiente = "Decimo Grado DE EDUCACIÓN GENERAL BÁSICA - Basica Superior";
                break;
                case "Decimo":
                    $gradoSiguiente = "Primer Año de Bachillerato";
                break;
                case "Primero de Bachillerato":
                    $gradoSiguiente = "Segundo Año de Bachillerato";
                    $especializacionSig = $curso->especializacion;
                break;
                case "Segundo de Bachillerato":
                    $gradoSiguiente = "Tercer Año de Bachillerato";
                    $especializacionSig = $curso->especializacion;
                break;
                case "Tercero de Bachillerato":
                    $gradoSiguiente = "Culminando la instrucción Secundaria";
                break;
            }
            $areas = DB::table('matters')->where([
            ['idCurso', '=', $idCurso],
            ['visible', '=', 1]])
            ->leftJoin('areas', 'matters.idArea', '=', 'areas.id')
            ->select('areas.nombre AS nombreArea')
            ->selectRaw('count(*) as numero')
            ->orderBy('matters.posicion')
            ->groupBy('nombreArea')->get();
            $matters = DB::table('matters')->where([
            ['idCurso', '=', $idCurso],
            ['visible', '=', 1]])
            ->leftJoin('areas', 'matters.idArea', '=', 'areas.id')
            ->select('matters.*', 'areas.nombre AS nombreArea')
            ->orderBy('matters.posicion')->get();
            $data2 = new \Illuminate\Support\Collection(json_decode(file_get_contents('http://'. config('app.api_host_name') .':8081/libreta/anual/'. $this->idPeriodoUser().'/curso/'.$idCurso)));
            $dhi = Matter::where(['idCurso' => $idCurso, 'area' => 'DESARROLLO HUMANO INTEGRAL',
                'visible' => 0, 'principal' => 0 ])->first();                
            $contPasado = 0;
            $contNoPasado = 0;
            $count = 0;
            $fechaA = $institution->fechaCertificadoPromocion;
            $certificado_promocion = ConfiguracionSistema::certPromocion();

            if ($certificado_promocion->valor == 0){
                $pdf = PDF::loadView('pdf.reportes-por-curso.cursos.anual.nuevo-certificado-promocion',
                    compact('students','curso','tutor','matters','institution','faltasJustificadas','faltasInjustificadas',
                    'atrasos','educacion', 'count','contPasado','contNoPasado','fechaA','gradoSiguiente','especializacionSig',
                    'confComportamiento','areas','data2','dhi'));
            }else {
                $pdf = PDF::loadView('pdf.reportes-por-curso.cursos.anual.certificado-promocion-formato2', 
                    compact('students','curso','tutor','matters','institution',
                    'educacion', 'count','contPasado','contNoPasado','fechaA','gradoSiguiente','especializacionSig', 'confComportamiento',
                    'areas','data2','dhi'));
            }

            return $pdf->download('Certificado de Promoción.pdf');
    }
    public function OldcertificadoPromocionEstudiante($idCurso){
            #datosgenerales
            $unidad = UnidadPeriodica::all();
            $students = Student2Profile::getStudentsByCourse($idCurso);
            $curso = Course::find($idCurso);
            $tutor = Administrative::find($curso->idProfesor);
            $institution = Institution::first();
            $notasMenores = ConfiguracionSistema::notasRojo()->valor;
            $nota_menor = ConfiguracionSistema::notaMenorRojo();
			$confComportamiento = ConfiguracionSistema::comportamientoQuimestral();

            //Grado Actual
            $educacion = "";
            switch($curso->grado){
                case "Inicial 1":$educacion = " - Educacion Inicial";break;
                case "Inicial 2":$educacion = " - Educacion Inicial";break;
                case "Primero":$educacion = "DE EDUCACIÓN GENERAL BÁSICA - Preparatoria";break;
                case "Segundo":$educacion = "Segundo Grado DE EDUCACIÓN GENERAL BÁSICA - Basica Elemental";break;
                case "Tercero":$educacion = "Tercer Grado DE EDUCACIÓN GENERAL BÁSICA - Basica Elemental";break;
                case "Cuarto":$educacion = "Cuarto Grado DE EDUCACIÓN GENERAL BÁSICA - Basica Elemental";break;
                case "Quinto": $educacion = "Quinto Grado DE EDUCACIÓN GENERAL BÁSICA - Basica Media"; break;
                case "Sexto": $educacion = "Sexto Grado DE EDUCACIÓN GENERAL BÁSICA - Basica Media"; break;
                case "Septimo": $educacion = "Septimo Grado DE EDUCACIÓN GENERAL BÁSICA - Basica Media"; break;
                case "Octavo": $educacion = "Octavo Grado DE EDUCACIÓN GENERAL BÁSICA - Basica Superior"; break;
                case "Noveno": $educacion = "Noveno Grado DE EDUCACIÓN GENERAL BÁSICA - Basica Superior"; break;
                case "Decimo": $educacion = "Decimo Grado DE EDUCACIÓN GENERAL BÁSICA - Basica Superior"; break;
                case "Primero de Bachillerato":
                    if($curso->especializacion != "Ciencias")
                        $educacion = "Primer Año De Bachillerato General Unificado, Especialización: ";
                    else
                        $educacion = "Primer Año De Bachillerato General Unificado, ";
                    break;
                case "Segundo de Bachillerato":
                    if($curso->especializacion != "Ciencias")
                        $educacion = "Segundo Año De Bachillerato General Unificado, Especialización: ";
                    else
                        $educacion = "Segundo Año De Bachillerato General Unificado, ";
                    break;
                case "Tercero de Bachillerato":
                    if($curso->especializacion != "Ciencias")
                        $educacion = "Tercer Año De Bachillerato General Unificado, Especialización: ";
                    else
                        $educacion = "Tercer Año De Bachillerato General Unificado, ";
                    break;
            }

            //Grado Siguiente
            $gradoSiguiente = "";
            $especializacionSig = "";
            switch($curso->grado){
                case "Inicial 1": $gradoSiguiente = "Inicial 2"; break;
                case "Inicial 2": $gradoSiguiente = "Primer Año de Educación Básica"; break;
                case "Primero":
                    $gradoSiguiente = "Segundo Grado DE EDUCACIÓN GENERAL BÁSICA - Basica Elemental";
                break;
                case "Segundo":
                    $gradoSiguiente = "Tercer Grado DE EDUCACIÓN GENERAL BÁSICA - Basica Elemental";
                break;
                case "Tercero":
                    $gradoSiguiente = "Cuarto Grado DE EDUCACIÓN GENERAL BÁSICA - Basica Elemental";
                break;
                case "Cuarto":
                    $gradoSiguiente = "Quinto Grado DE EDUCACIÓN GENERAL BÁSICA - Basica Media";
                break;
                case "Quinto":
                    $gradoSiguiente = "Sexto Grado DE EDUCACIÓN GENERAL BÁSICA - Basica Media";
                break;
                case "Sexto":
                    $gradoSiguiente = "Septimo Grado DE EDUCACIÓN GENERAL BÁSICA - Basica Media";
                break;
                case "Septimo":
                    $gradoSiguiente = "Octavo Grado DE EDUCACIÓN GENERAL BÁSICA - Basica Superior";
                break;
                case "Octavo":
                    $gradoSiguiente = "Noveno Grado DE EDUCACIÓN GENERAL BÁSICA - Basica Superior";
                break;
                case "Noveno":
                    $gradoSiguiente = "Decimo Grado DE EDUCACIÓN GENERAL BÁSICA - Basica Superior";
                break;
                case "Decimo":
                    $gradoSiguiente = "Primer Año de Bachillerato";
                break;
                case "Primero de Bachillerato":
                    $gradoSiguiente = "Segundo Año de Bachillerato";
                    $especializacionSig = $curso->especializacion;
                break;
                case "Segundo de Bachillerato":
                    $gradoSiguiente = "Tercer Año de Bachillerato";
                    $especializacionSig = $curso->especializacion;
                break;
                case "Tercero de Bachillerato":
                    $gradoSiguiente = "Culminando la instrucción Secundaria";
                break;
            }

            #materias
            $matters = Matter::query()
                ->where(['idCurso' => $curso->id])
                ->orderBy('area')
                ->get();
            $materias = [
                'LENGUA Y LITERATURA', 'LENGUA EXTRANJERA', 'MATEMÁTICA',
                'CIENCIAS NATURALES', 'CIENCIAS SOCIALES', 'ESTUDIOS SOCIALES', 'EDUCACIÓN FÍSICA',
                'EDUCACIÓN CULTURAL Y ARTÍSTICA', 'COMPUTACIÓN'
            ];
            $materiasFijas = Matter::where(['idCurso' => $idCurso, 'visible' => 1, 'principal' => 1])
                ->orderByRaw("FIELD(area,'LENGUA Y LITERATURA','MATEMÁTICA','CIENCIAS NATURALES','CIENCIAS SOCIALES','EDUCACIÓN CULTURAL Y ARTÍSTICA','EDUCACIÓN FÍSICA','LENGUA EXTRANJERA','COMPUTACIÓN')")
                ->get();
                $matters = $materiasFijas;

            if( count($materiasFijas) == 0)
            {
                throw new Exception("No se registran materias fijas");
            }

            $proyecto = null;
            if( $curso->seccion != 'BGU'){
                $proyecto = Matter::where(['idCurso' => $idCurso, 'visible' => 1])
                ->where('nombre', 'LIKE', '%PROYECTO%')
                ->whereNotIn('area', $materias)->first();
            }

            #calificaciones
                $pp1q1 = [];
                $pp2q1 = [];
                $pp3q1 = [];
                $pExamenesQ1 = [];
                $pPromediosQ1 = [];
                $faltasJustificadas = [];
                $faltasInjustificadas = [];
                $atrasos = [];

                foreach($students as $student){
                    $pp1q1[$student->idStudent] = 0;
                    $pp2q1[$student->idStudent] = 0;
                    $pp3q1[$student->idStudent] = 0;
                    $pExamenesQ1[$student->idStudent] = 0;
                    $pPromediosQ1[$student->idStudent] = 0;

                    $atrasos[$student->idStudent]["q1"] = $student->p1q1A + $student->p2q1A + $student->p3q1A;
                    $atrasos[$student->idStudent]["q2"] = $student->p1q2A + $student->p2q2A + $student->p3q2A;
                    $atrasos[$student->idStudent]["total"] = $atrasos[$student->idStudent]["q1"] + $atrasos[$student->idStudent]["q2"];

                    $faltasJustificadas[$student->idStudent]["q1"] = $student->p1q1FJ + $student->p2q1FJ + $student->p3q1FJ;
                    $faltasJustificadas[$student->idStudent]["q2"] = $student->p1q2FJ + $student->p2q2FJ + $student->p3q2FJ;
                    $faltasJustificadas[$student->idStudent]["total"] = $faltasJustificadas[$student->idStudent]["q1"] + $faltasJustificadas[$student->idStudent]["q2"];

                    $faltasInjustificadas[$student->idStudent]["q1"] = $student->p1q1FI + $student->p2q1FI + $student->p3q1FI;
                    $faltasInjustificadas[$student->idStudent]["q2"] = $student->p1q2FI + $student->p2q2FI + $student->p3q2FI;
                    $faltasInjustificadas[$student->idStudent]["total"] = $faltasInjustificadas[$student->idStudent]["q1"] + $faltasInjustificadas[$student->idStudent]["q2"];
                }

                foreach($matters as $matter){

                    $promediosP1Q1[$matter->id] = Calificacion::getPromedioMatterParcial($matter->id,'p1q1');
                    $promediosP2Q1[$matter->id] = Calificacion::getPromedioMatterParcial($matter->id,'p2q1');
                    $promediosP3Q1[$matter->id] = Calificacion::getPromedioMatterParcial($matter->id,'p3q1');

                    $examenesQ1[$matter->id] = Calificacion::getExamenesMateria($matter->id,'q1');
                    $recuperacionQ1[$matter->id] = Calificacion::getRecuperacionMateria($matter->id,'q1');
                    $promediosTotalQ1[$matter->id] = [];
                    $promediosFinalQ1[$matter->id] = [];
                    foreach($students as $s){
                        if($promediosP1Q1[$matter->id][$s->idStudent]['promedio'] !=0 &&
                        $promediosP2Q1[$matter->id][$s->idStudent]['promedio'] !=0 &&
                        $promediosP3Q1[$matter->id][$s->idStudent]['promedio'] !=0 &&
                        $examenesQ1[$matter->id][$s->idStudent] != 0){
                            $parciales = bcdiv( ($promediosP1Q1[$matter->id][$s->idStudent]['promedio'] +
                            $promediosP2Q1[$matter->id][$s->idStudent]['promedio'] +
                            $promediosP3Q1[$matter->id][$s->idStudent]['promedio'])/3, '1', 2);
                            $promediosTotalQ1[$matter->id][$s->idStudent] =  bcdiv( ($parciales *0.8) + ($examenesQ1[$matter->id][$s->idStudent]*0.2), '1', 2);
                            $ex = ($examenesQ1[$matter->id][$s->idStudent] < $recuperacionQ1[$matter->id][$s->idStudent])?$recuperacionQ1[$matter->id][$s->idStudent]:$examenesQ1[$matter->id][$s->idStudent];

                            $promediosFinalQ1[$matter->id][$s->idStudent] =  bcdiv( ($parciales *0.8) + ($ex*0.2), '1', 2);
                        }else{
                            $promediosTotalQ1[$matter->id][$s->idStudent] = 0;
                            $promediosFinalQ1[$matter->id][$s->idStudent] = 0;
                        }
                        $pp1q1[$s->idStudent] += $promediosP1Q1[$matter->id][$s->idStudent]['promedio'];
                        $pp2q1[$s->idStudent] += $promediosP2Q1[$matter->id][$s->idStudent]['promedio'];
                        $pp3q1[$s->idStudent] += $promediosP3Q1[$matter->id][$s->idStudent]['promedio'];
                        $pExamenesQ1[$student->idStudent] += $examenesQ1[$matter->id][$s->idStudent];
                        $pPromediosQ1[$student->idStudent] += $promediosTotalQ1[$matter->id][$s->idStudent];
                    }
                }


                $pp1q2 = [];
                $pp2q2 = [];
                $pp3q2 = [];
                $pExamenesQ2 = [];
                $pPromediosQ2 = [];
                $pPromediosTotal = [];
                $pPromediosTotalRecup = [];
                $pPromediosTotalFinal = [];
                foreach($students as $student){
                    $pp1q2[$student->idStudent] = 0;
                    $pp2q2[$student->idStudent] = 0;
                    $pp3q2[$student->idStudent] = 0;
                    $pExamenesQ2[$student->idStudent] = 0;
                    $pPromediosQ2[$student->idStudent] = 0;
                    $pPromediosTotal[$student->idStudent] = 0;
                    $pPromediosTotalRecup[$student->idStudent] = 0;
                    $pPromediosTotalFinal[$student->idStudent] = 0;
                }

                foreach($matters as $matter){
                    $promediosP1Q2[$matter->id] = Calificacion::getPromedioMatterParcial($matter->id,'p1q2');
                    $promediosP2Q2[$matter->id] = Calificacion::getPromedioMatterParcial($matter->id,'p2q2');
                    $promediosP3Q2[$matter->id] = Calificacion::getPromedioMatterParcial($matter->id,'p3q2');
                    $examenesQ2[$matter->id] = Calificacion::getExamenesMateria($matter->id,'q2');
                    $recuperacionQ2[$matter->id] = Calificacion::getRecuperacionMateria($matter->id,'q2');

                    $promediosTotalQ2[$matter->id] = [];
                    $promediosFinalQ2[$matter->id] = [];
                    foreach($students as $s){
                        if($promediosP1Q2[$matter->id][$s->idStudent]['promedio'] !=0 &&
                        $promediosP2Q2[$matter->id][$s->idStudent]['promedio'] !=0 &&
                        $promediosP3Q2[$matter->id][$s->idStudent]['promedio'] !=0 &&
                        $examenesQ2[$matter->id][$s->idStudent] != 0){
                            $parciales =bcdiv( ($promediosP1Q2[$matter->id][$s->idStudent]['promedio'] +
                            $promediosP2Q2[$matter->id][$s->idStudent]['promedio'] +
                            $promediosP3Q2[$matter->id][$s->idStudent]['promedio'])/3, '1', 2);
                            $promediosTotalQ2[$matter->id][$s->idStudent] =  bcdiv( ($parciales *0.8) + ($examenesQ2[$matter->id][$s->idStudent]*0.2), '1', 2);
                            $ex = ($examenesQ2[$matter->id][$s->idStudent] < $recuperacionQ2[$matter->id][$s->idStudent])?$recuperacionQ2[$matter->id][$s->idStudent]:$examenesQ2[$matter->id][$s->idStudent];

                            $promediosFinalQ2[$matter->id][$s->idStudent] =  bcdiv( ($parciales *0.8) + ($ex*0.2), '1', 2);
                        }else{
                            $promediosTotalQ2[$matter->id][$s->idStudent] = 0;
                            $promediosFinalQ2[$matter->id][$s->idStudent] = 0;
                        }
                        $pp1q2[$s->idStudent] += $promediosP1Q2[$matter->id][$s->idStudent]['promedio'];
                        $pp2q2[$s->idStudent] += $promediosP2Q2[$matter->id][$s->idStudent]['promedio'];
                        $pp3q2[$s->idStudent] += $promediosP3Q2[$matter->id][$s->idStudent]['promedio'];
                        $pExamenesQ2[$student->idStudent] += $examenesQ2[$matter->id][$s->idStudent];
                        $pPromediosQ2[$student->idStudent] += $promediosTotalQ2[$matter->id][$s->idStudent];
                    }
                }

                foreach($students as $key => $student){
                    $materiasIncompletas = false;
                    foreach($matters->where('principal', 1) as $matter)
                    {
                        if($promediosTotalQ2[$matter->id][$s->idStudent] == 0 || $promediosTotalQ1[$matter->id][$s->idStudent] == 0)
                        {
                            $materiasIncompletas = true;
                        }
                    }
                    // if ($materiasIncompletas){
                    //     $students->forget($key);
                    // }
                }

                $promedioGeneral = [];
                $promedioGeneralRecup = [];
                $supletorios = [];
                $remediales = [];
                $gracias = [];
                $promedioFinalQuimestre =[];
                foreach($matters as $matter){
                    $supletorios[$matter->id] = Calificacion::getSupletorioMateria($matter->id);
                    $remediales[$matter->id] = Calificacion::getRemedialMateria($matter->id);
                    $gracias[$matter->id] = Calificacion::getGraciaMateria($matter->id);
                }

                foreach($students as $student){

                    foreach($matters as $matter){
                        if( $promediosTotalQ1[$matter->id][$student->idStudent] != 0 && $promediosTotalQ2[$matter->id][$student->idStudent] != 0 )
                        {
                            $promedioGeneral[$matter->id][$student->idStudent] = bcdiv( ($promediosTotalQ1[$matter->id][$student->idStudent] + $promediosTotalQ2[$matter->id][$student->idStudent])/2, '1', 2);
                            $promedioGeneralRecup[$matter->id][$student->idStudent] = bcdiv( ($promediosFinalQ1[$matter->id][$student->idStudent] + $promediosFinalQ2[$matter->id][$student->idStudent])/2, '1', 2);
                        }else{
                            $promedioGeneral[$matter->id][$student->idStudent] = 0;
                            $promedioGeneralRecup[$matter->id][$student->idStudent] = 0;
                        }
                        if($promedioGeneralRecup [$matter->id][$student->idStudent] < $supletorios[$matter->id][$student->idStudent] &&
                                $remediales[$matter->id][$student->idStudent] < $supletorios[$matter->id][$student->idStudent] &&
                                $gracias[$matter->id][$student->idStudent] < $supletorios[$matter->id][$student->idStudent]){

                            $promedioFinalQuimestre[$matter->id][$student->idStudent] = $supletorios[$matter->id][$student->idStudent];

                        }else if($promedioGeneralRecup [$matter->id][$student->idStudent] < $remediales[$matter->id][$student->idStudent] &&
                                $supletorios[$matter->id][$student->idStudent] < $remediales[$matter->id][$student->idStudent] &&
                                $gracias[$matter->id][$student->idStudent] < $remediales[$matter->id][$student->idStudent]){

                            $promedioFinalQuimestre[$matter->id][$student->idStudent] = $remediales[$matter->id][$student->idStudent];

                        }else if($promedioGeneralRecup [$matter->id][$student->idStudent] < $gracias[$matter->id][$student->idStudent] &&
                                $remediales[$matter->id][$student->idStudent] < $gracias[$matter->id][$student->idStudent] &&
                                $supletorios[$matter->id][$student->idStudent] < $gracias[$matter->id][$student->idStudent]){
                                $promedioFinalQuimestre[$matter->id][$student->idStudent] = $gracias[$matter->id][$student->idStudent];
                        }else{
                            $promedioFinalQuimestre[$matter->id][$student->idStudent] = $promedioGeneralRecup[$matter->id][$student->idStudent];
                        }
                        $pPromediosTotal[$student->idStudent] += $promedioGeneral[$matter->id][$student->idStudent];
                        $pPromediosTotalRecup[$student->idStudent] += $promedioGeneralRecup[$matter->id][$student->idStudent];
                        $pPromediosTotalFinal[$student->idStudent] += $promedioFinalQuimestre[$matter->id][$student->idStudent];
                    }
                }
            #endsection
            $contPasado = 0;
            $contNoPasado = 0;
            $count = 0;
            $fechaA = $institution->fechaCertificadoPromocion;

            $pdf = PDF::loadView('pdf.reportes-por-curso.cursos.anual.nuevo-certificado-promocion',
			compact('students','curso','tutor','materiasFijas','institution','proyecto','promedioGeneral','promedioGeneralRecup','supletorios',
			'remediales','gracias','promedioFinalQuimestre','notasMenores','pp1q1','pp2q1','pp3q1','pp1q2','pp2q2','pp3q2','pExamenesQ1',
			'pExamenesQ2','pPromediosQ1','pPromediosQ2','nota_menor','pPromediosTotal','pPromediosTotalRecup','pPromediosTotalFinal',
			'faltasJustificadas','faltasInjustificadas','atrasos','educacion', 'count','contPasado','contNoPasado','fechaA','iguiente',
			'especializacionSig', 'confComportamiento', 'promediosFinalQ1', 'promediosFinalQ2'));

            return $pdf->download('Certificado de Promoción.pdf');
    }
    /**/


    /*
    Certificado de Pase de Año
    */
    public function certificadoPaseEstudiante($idCurso) {
        $unidad = UnidadPeriodica::where('activo',1)->where('idPeriodo',Sentinel::getUser()->idPeriodoLectivo)->orderByDESC('id')->first();
        $parcialP = ParcialPeriodico::parcialP($unidad->id);
        // se realiza en caso que el comportamiento este configurado para repetir calificación segun el parcial
        for ($i=count($parcialP)-2; $i < count($parcialP)-1 ; $i++) {
         $ultimoP= $parcialP[$i];
        }
        $curso = Course::find($idCurso);
        $students = Student2Profile::getStudentsByCourse($idCurso);
        $tutor = Administrative::find($curso->idProfesor);
        $institution = Institution::find(1);
        $data2 = new \Illuminate\Support\Collection(json_decode(file_get_contents('http://'. config('app.api_host_name') .':8081/libreta/anual/'. $this->idPeriodoUser().'/curso/'.$idCurso)));
        Carbon::setUtf8(true);
        $now = Carbon::now();
        $fechaA = Fechas::fechaActual($now);
        $confComportamiento = ConfiguracionSistema::comportamientoQuimestral();
        $educacion = "";
        switch($curso->grado){
            case "Inicial 1":
                $educacion = " - Educacion Inicial";
            break;
            case "Inicial 2":
                $educacion = " - Educacion Inicial";
            break;
            case "Primero":
                $educacion = "DE EDUCACIÓN GENERAL BÁSICA - Preparatoria";
            break;
            case "Segundo":
                $educacion = "Segundo Grado ".$curso->paralelo." DE EDUCACIÓN GENERAL BÁSICA - Basica Elemental";
            break;
            case "Tercero":
                $educacion = "Tercer Grado ".$curso->paralelo." DE EDUCACIÓN GENERAL BÁSICA - Basica Elemental";
            break;
            case "Cuarto":
                $educacion = "Cuarto Grado ".$curso->paralelo." DE EDUCACIÓN GENERAL BÁSICA - Basica Elemental";
            break;
            case "Quinto":
                $educacion = "Quinto Grado ".$curso->paralelo." DE EDUCACIÓN GENERAL BÁSICA - Basica Media";
            break;
            case "Sexto":
                $educacion = "Sexto Grado ".$curso->paralelo." DE EDUCACIÓN GENERAL BÁSICA - Basica Media";
            break;
            case "Septimo":
                $educacion = "Septimo Grado ".$curso->paralelo." DE EDUCACIÓN GENERAL BÁSICA - Basica Media";
            break;
            case "Octavo":
                $educacion = "Octavo Grado ".$curso->paralelo." DE EDUCACIÓN GENERAL BÁSICA - Basica Superior";
            break;
            case "Noveno":
                $educacion = "Noveno Grado ".$curso->paralelo." DE EDUCACIÓN GENERAL BÁSICA - Basica Superior";
            break;
            case "Decimo":
                $educacion = "Decimo Grado ".$curso->paralelo." DE EDUCACIÓN GENERAL BÁSICA - Basica Superior";
            break;
            case "Primero de Bachillerato":
                $educacion = "Primer Año De Bachillerato General Unificado ".$curso->paralelo.", Especialización: ";
            break;
            case "Segundo de Bachillerato":
                $educacion = "Segundo Año De Bachillerato General Unificado ".$curso->paralelo.", Especialización: ";
            break;
            case "Tercero de Bachillerato":
                if ($curso->especializacion == null){
                    $educacion = "TERCER AÑO DE BACHILLERATO GENERAL UNIFICADO, paralelo \"".$curso->paralelo."\";";
                }else{
                    $educacion = 'TERCER AÑO DE BACHILLERATO GENERAL UNIFICADO, paralelo '.$curso->paralelo.', Especialización: ';
                }
            break;
        }

        //Grado Siguiente
        $iguiente = "";
        switch($curso->grado){
            case "Inicial 1":
                $iguiente = "Inicial 2";
            break;
            case "Inicial 2":
                $iguiente = "Primer Año de Educación Básica";
            break;
            case "Primero":
                $iguiente = "Segundo Grado DE EDUCACIÓN GENERAL BÁSICA - Basica Elemental";
            break;
            case "Segundo":
                $iguiente = "Tercer Grado DE EDUCACIÓN GENERAL BÁSICA - Basica Elemental";
            break;
            case "Tercero":
                $iguiente = "Cuarto Grado DE EDUCACIÓN GENERAL BÁSICA - Basica Elemental";
            break;
            case "Cuarto":
                $iguiente = "Quinto Grado DE EDUCACIÓN GENERAL BÁSICA - Basica Media";
            break;
            case "Quinto":
                $iguiente = "Sexto Grado DE EDUCACIÓN GENERAL BÁSICA - Basica Media";
            break;
            case "Sexto":
                $iguiente = "Septimo Grado DE EDUCACIÓN GENERAL BÁSICA - Basica Media";
            break;
            case "Septimo":
                $gradoSiguiente = "Octavo Grado DE EDUCACIÓN GENERAL BÁSICA - Basica Superior";
            break;
            case "Octavo":
                $gradoSiguiente = "Noveno Grado DE EDUCACIÓN GENERAL BÁSICA - Basica Superior";
            break;
            case "Noveno":
                $gradoSiguiente = "Decimo Grado DE EDUCACIÓN GENERAL BÁSICA - Basica Superior";
            break;
            case "Decimo":
                $gradoSiguiente = "Primer Año de Bachillerato";
            break;
            case "Primero de Bachillerato":
                $gradoSiguiente = "Segundo Año de Bachillerato";
            break;
            case "Segundo de Bachillerato":
                $gradoSiguiente = "Tercer Año de Bachillerato";
            break;
            case "Tercero de Bachillerato":
                $gradoSiguiente = "Culminando la instrucción Secundaria";
            break;
        }
        $formato = ConfiguracionSistema::PaseDeAnioFormato($this->idPeriodoUser());
        $pdf =  PDF::loadView('pdf.reportes-por-curso.cursos.anual.nuevo-certificado-pase',
        compact('students','curso','tutor','materiasFijas','materiasExtra','institution','data2','educacion','gradoSiguiente','fechaA',
            'confComportamiento','ultimoP','formato'));
        return $pdf->download('Certificado pase de año.pdf');
    }

    public function OldcertificadoPaseEstudiante($idCurso) {
        #datosgenerales
        $curso = Course::find($idCurso);

        $students = Student2Profile::getStudentsByCourse($idCurso);
         dd($students);
        $tutor = Administrative::find($curso->idProfesor);
        $institution = Institution::find(1);

        //Grado Actual
        $educacion = "";
        switch($curso->grado){
            case "Inicial 1":
                $educacion = " - Educacion Inicial";
            break;
            case "Inicial 2":
                $educacion = " - Educacion Inicial";
            break;
            case "Primero":
                $educacion = "DE EDUCACIÓN GENERAL BÁSICA - Preparatoria";
            break;
            case "Segundo":
                $educacion = "Segundo Grado ".$curso->paralelo." DE EDUCACIÓN GENERAL BÁSICA - Basica Elemental";
            break;
            case "Tercero":
                $educacion = "Tercer Grado ".$curso->paralelo." DE EDUCACIÓN GENERAL BÁSICA - Basica Elemental";
            break;
            case "Cuarto":
                $educacion = "Cuarto Grado ".$curso->paralelo." DE EDUCACIÓN GENERAL BÁSICA - Basica Elemental";
            break;
            case "Quinto":
                $educacion = "Quinto Grado ".$curso->paralelo." DE EDUCACIÓN GENERAL BÁSICA - Basica Media";
            break;
            case "Sexto":
                $educacion = "Sexto Grado ".$curso->paralelo." DE EDUCACIÓN GENERAL BÁSICA - Basica Media";
            break;
            case "Septimo":
                $educacion = "Septimo Grado ".$curso->paralelo." DE EDUCACIÓN GENERAL BÁSICA - Basica Media";
            break;
            case "Octavo":
                $educacion = "Octavo Grado ".$curso->paralelo." DE EDUCACIÓN GENERAL BÁSICA - Basica Superior";
            break;
            case "Noveno":
                $educacion = "Noveno Grado ".$curso->paralelo." DE EDUCACIÓN GENERAL BÁSICA - Basica Superior";
            break;
            case "Decimo":
                $educacion = "Decimo Grado ".$curso->paralelo." DE EDUCACIÓN GENERAL BÁSICA - Basica Superior";
            break;
            case "Primero de Bachillerato":
                $educacion = "Primer Año De Bachillerato General Unificado ".$curso->paralelo.", Especialización: ";
            break;
            case "Segundo de Bachillerato":
                $educacion = "Segundo Año De Bachillerato General Unificado ".$curso->paralelo.", Especialización: ";
            break;
            case "Tercero de Bachillerato":
                $educacion = "Tercer Año De Bachillerato General Unificado ".$curso->paralelo.", Especialización: ";
            break;
        }

        //Grado Siguiente
        $gradoSiguiente = "";
        switch($curso->grado){
            case "Inicial 1":
                $gradoSiguiente = "Inicial 2";
            break;
            case "Inicial 2":
                $gradoSiguiente = "Primer Año de Educación Básica";
            break;
            case "Primero":
                $gradoSiguiente = "Segundo Grado DE EDUCACIÓN GENERAL BÁSICA - Basica Elemental";
            break;
            case "Segundo":
                $gradoSiguiente = "Tercer Grado DE EDUCACIÓN GENERAL BÁSICA - Basica Elemental";
            break;
            case "Tercero":
                $gradoSiguiente = "Cuarto Grado DE EDUCACIÓN GENERAL BÁSICA - Basica Elemental";
            break;
            case "Cuarto":
                $gradoSiguiente = "Quinto Grado DE EDUCACIÓN GENERAL BÁSICA - Basica Media";
            break;
            case "Quinto":
                $gradoSiguiente = "Sexto Grado DE EDUCACIÓN GENERAL BÁSICA - Basica Media";
            break;
            case "Sexto":
                $gradoSiguiente = "Septimo Grado DE EDUCACIÓN GENERAL BÁSICA - Basica Media";
            break;
            case "Septimo":
                $gradoSiguiente = "Octavo Grado DE EDUCACIÓN GENERAL BÁSICA - Basica Superior";
            break;
            case "Octavo":
                $gradoSiguiente = "Noveno Grado DE EDUCACIÓN GENERAL BÁSICA - Basica Superior";
            break;
            case "Noveno":
                $gradoSiguiente = "Decimo Grado DE EDUCACIÓN GENERAL BÁSICA - Basica Superior";
            break;
            case "Decimo":
                $gradoSiguiente = "Primer Año de Bachillerato";
            break;
            case "Primero de Bachillerato":
                $gradoSiguiente = "Segundo Año de Bachillerato";
            break;
            case "Segundo de Bachillerato":
                $gradoSiguiente = "Tercer Año de Bachillerato";
            break;
            case "Tercero de Bachillerato":
                $gradoSiguiente = "Culminando la instrucción Secundaria";
            break;
        }

        #materias
        $matters = Matter::getMattersByCourse($idCurso);
        $materias = [
            'LENGUA Y LITERATURA', 'LENGUA EXTRANJERA', 'MATEMÁTICA',
            'CIENCIAS NATURALES', 'CIENCIAS SOCIALES', 'ESTUDIOS SOCIALES', 'EDUCACIÓN FÍSICA',
            'EDUCACIÓN CULTURAL Y ARTÍSTICA', 'COMPUTACIÓN'
           ];
        $materiasFijas = Matter::where(['idCurso' => $idCurso, 'visible' => 1, 'principal' => 1])
            ->orderByRaw("FIELD(area,'LENGUA Y LITERATURA','MATEMÁTICA','CIENCIAS NATURALES','CIENCIAS SOCIALES','EDUCACIÓN CULTURAL Y ARTÍSTICA','EDUCACIÓN FÍSICA','LENGUA EXTRANJERA','COMPUTACIÓN')")
            ->get();
        $matters = $materiasFijas;
        $materiasExtra = Matter::where(['idCurso' => $idCurso, 'visible' => 1, 'principal' => 0])
            ->whereNotIn('area', $materias)->where('nombre', '!=', 'PROYECTO')->get();

        $proyecto = [];
        if( $curso->grado!='Primero de Bachillerato' or $curso->grado!='Segundo de Bachillerato' or $curso->grado!='Tercero de Bachillerato'){
            $proyecto = Matter::where(['idCurso' => $idCurso, 'visible' => 1, 'nombre' => 'PROYECTOS ESCOLARES', 'nombre' => 'PROYECTO'])
            ->whereNotIn('area', $materias)->first();
        }

        #calificaciones
        $pp1q1 = [];
        $pp2q1 = [];
        $pp3q1 = [];
        $pExamenesQ1 = [];
        $pPromediosQ1 = [];
        $faltasJustificadas = [];
        $faltasInjustificadas = [];
        $atrasos = [];

        foreach($students as $student){
            $pp1q1[$student->idStudent] = 0;
            $pp2q1[$student->idStudent] = 0;
            $pp3q1[$student->idStudent] = 0;
            $pExamenesQ1[$student->idStudent] = 0;
            $pPromediosQ1[$student->idStudent] = 0;

            $atrasos[$student->idStudent]["q1"] = $student->p1q1A + $student->p2q1A + $student->p3q1A;
            $atrasos[$student->idStudent]["q2"] = $student->p1q2A + $student->p2q2A + $student->p3q2A;
            $atrasos[$student->idStudent]["total"] = $atrasos[$student->idStudent]["q1"] + $atrasos[$student->idStudent]["q2"];

            $faltasJustificadas[$student->idStudent]["q1"] = $student->p1q1FJ + $student->p2q1FJ + $student->p3q1FJ;
            $faltasJustificadas[$student->idStudent]["q2"] = $student->p1q2FJ + $student->p2q2FJ + $student->p3q2FJ;
            $faltasJustificadas[$student->idStudent]["total"] = $faltasJustificadas[$student->idStudent]["q1"] + $faltasJustificadas[$student->idStudent]["q2"];

            $faltasInjustificadas[$student->idStudent]["q1"] = $student->p1q1FI + $student->p2q1FI + $student->p3q1FI;
            $faltasInjustificadas[$student->idStudent]["q2"] = $student->p1q2FI + $student->p2q2FI + $student->p3q2FI;
            $faltasInjustificadas[$student->idStudent]["total"] = $faltasInjustificadas[$student->idStudent]["q1"] + $faltasInjustificadas[$student->idStudent]["q2"];
        }

        foreach($matters as $matter){
            $promediosP1Q1[$matter->id] = Calificacion::getPromedioMatterParcial($matter->id,'p1q1');

            $promediosP2Q1[$matter->id] = Calificacion::getPromedioMatterParcial($matter->id,'p2q1');
            $promediosP3Q1[$matter->id] = Calificacion::getPromedioMatterParcial($matter->id,'p3q1');
            $examenesQ1[$matter->id] = Calificacion::getExamenesMateria($matter->id,'q1');
            $recuperacionQ1[$matter->id] = Calificacion::getRecuperacionMateria($matter->id,'q1');
            $promediosTotalQ1[$matter->id] = [];
            $promediosFinalQ1[$matter->id] = [];
            foreach($students as $s){
                if($promediosP1Q1[$matter->id][$s->idStudent]['promedio'] !=0 &&
                $promediosP2Q1[$matter->id][$s->idStudent]['promedio'] !=0 &&
                $promediosP3Q1[$matter->id][$s->idStudent]['promedio'] !=0 &&
                $examenesQ1[$matter->id][$s->idStudent] != 0){
                    $parciales = bcdiv( ($promediosP1Q1[$matter->id][$s->idStudent]['promedio'] +
                    $promediosP2Q1[$matter->id][$s->idStudent]['promedio'] +
                    $promediosP3Q1[$matter->id][$s->idStudent]['promedio'])/3, '1', 2);
                    $promediosTotalQ1[$matter->id][$s->idStudent] =  bcdiv( ($parciales *0.8) + ($examenesQ1[$matter->id][$s->idStudent]*0.2), '1', 2);
                    $ex = ($examenesQ1[$matter->id][$s->idStudent] < $recuperacionQ1[$matter->id][$s->idStudent])?$recuperacionQ1[$matter->id][$s->idStudent]:$examenesQ1[$matter->id][$s->idStudent];

                    $promediosFinalQ1[$matter->id][$s->idStudent] =  bcdiv( ($parciales *0.8) + ($ex*0.2), '1', 2);
                }else{
                    $promediosTotalQ1[$matter->id][$s->idStudent] = 0;
                    $promediosFinalQ1[$matter->id][$s->idStudent] = 0;
                }
                $pp1q1[$s->idStudent] += $promediosP1Q1[$matter->id][$s->idStudent]['promedio'];
                $pp2q1[$s->idStudent] += $promediosP2Q1[$matter->id][$s->idStudent]['promedio'];
                $pp3q1[$s->idStudent] += $promediosP3Q1[$matter->id][$s->idStudent]['promedio'];
                $pExamenesQ1[$student->idStudent] += $examenesQ1[$matter->id][$s->idStudent];
                $pPromediosQ1[$student->idStudent] += $promediosTotalQ1[$matter->id][$s->idStudent];
            }
        }


        $pp1q2 = [];
        $pp2q2 = [];
        $pp3q2 = [];
        $pExamenesQ2 = [];
        $pPromediosQ2 = [];
        $pPromediosTotal = [];
        $pPromediosTotalRecup = [];
        $pPromediosTotalFinal = [];
        foreach($students as $student){
            $pp1q2[$student->idStudent] = 0;
            $pp2q2[$student->idStudent] = 0;
            $pp3q2[$student->idStudent] = 0;
            $pExamenesQ2[$student->idStudent] = 0;
            $pPromediosQ2[$student->idStudent] = 0;
            $pPromediosTotal[$student->idStudent] = 0;
            $pPromediosTotalRecup[$student->idStudent] = 0;
            $pPromediosTotalFinal[$student->idStudent] = 0;
        }

        foreach($matters as $matter){
            $promediosP1Q2[$matter->id] = Calificacion::getPromedioMatterParcial($matter->id,'p1q2');
            $promediosP2Q2[$matter->id] = Calificacion::getPromedioMatterParcial($matter->id,'p2q2');
            $promediosP3Q2[$matter->id] = Calificacion::getPromedioMatterParcial($matter->id,'p3q2');
            $examenesQ2[$matter->id] = Calificacion::getExamenesMateria($matter->id,'q2');
            $recuperacionQ2[$matter->id] = Calificacion::getRecuperacionMateria($matter->id,'q2');

            $promediosTotalQ2[$matter->id] = [];
            $promediosFinalQ2[$matter->id] = [];
            foreach($students as $s){
                if($promediosP1Q2[$matter->id][$s->idStudent]['promedio'] !=0 &&
                $promediosP2Q2[$matter->id][$s->idStudent]['promedio'] !=0 &&
                $promediosP3Q2[$matter->id][$s->idStudent]['promedio'] !=0 &&
                $examenesQ2[$matter->id][$s->idStudent] != 0){
                    $parciales =bcdiv( ($promediosP1Q2[$matter->id][$s->idStudent]['promedio'] +
                    $promediosP2Q2[$matter->id][$s->idStudent]['promedio'] +
                    $promediosP3Q2[$matter->id][$s->idStudent]['promedio'])/3, '1', 2);;
                    $promediosTotalQ2[$matter->id][$s->idStudent] =  bcdiv( ($parciales *0.8) + ($examenesQ2[$matter->id][$s->idStudent]*0.2), '1', 2);
                    $ex = ($examenesQ2[$matter->id][$s->idStudent] < $recuperacionQ2[$matter->id][$s->idStudent])?$recuperacionQ2[$matter->id][$s->idStudent]:$examenesQ2[$matter->id][$s->idStudent];

                    $promediosFinalQ2[$matter->id][$s->idStudent] =  bcdiv( ($parciales *0.8) + ($ex*0.2), '1', 2);
                }else{
                    $promediosTotalQ2[$matter->id][$s->idStudent] = 0;
                    $promediosFinalQ2[$matter->id][$s->idStudent] = 0;
                }
                $pp1q2[$s->idStudent] += $promediosP1Q2[$matter->id][$s->idStudent]['promedio'];
                $pp2q2[$s->idStudent] += $promediosP2Q2[$matter->id][$s->idStudent]['promedio'];
                $pp3q2[$s->idStudent] += $promediosP3Q2[$matter->id][$s->idStudent]['promedio'];
                $pExamenesQ2[$student->idStudent] += $examenesQ2[$matter->id][$s->idStudent];
                $pPromediosQ2[$student->idStudent] += $promediosTotalQ2[$matter->id][$s->idStudent];
            }
        }

        $aprobados = [];
        foreach($students as $key => $student){
            $materiasIncompletas = false;
            $aprobados[$student->idStudent] = true;
            foreach($matters->where('principal', 1) as $matter)
            {
                if( ($promediosTotalQ2[$matter->id][$s->idStudent] + $promediosTotalQ1[$matter->id][$s->idStudent])/2 < 7)
                {
                    $materiasIncompletas = true;
                }
            }
            if ($materiasIncompletas){
                $students->forget($key);
            }
        }

        $promedioGeneral = [];
        $promedioGeneralRecup = [];
        $supletorios = [];
        $remediales = [];
        $gracias = [];
        $promedioFinalQuimestre =[];

        foreach($matters as $matter){
            $supletorios[$matter->id] = Calificacion::getSupletorioMateria($matter->id);
            $remediales[$matter->id] = Calificacion::getRemedialMateria($matter->id);
            $gracias[$matter->id] = Calificacion::getGraciaMateria($matter->id);
            foreach($students as $student){
                if( $promediosTotalQ1[$matter->id][$student->idStudent] != 0 && $promediosTotalQ2[$matter->id][$student->idStudent] != 0 )
                {
                    $promedioGeneral[$matter->id][$student->idStudent] = bcdiv( ($promediosTotalQ1[$matter->id][$student->idStudent] + $promediosTotalQ2[$matter->id][$student->idStudent])/2, '1', 2);
                    $promedioGeneralRecup[$matter->id][$student->idStudent] = bcdiv( ($promediosFinalQ1[$matter->id][$student->idStudent] + $promediosFinalQ2[$matter->id][$student->idStudent])/2, '1', 2);
                }else{
                    $promedioGeneral[$matter->id][$student->idStudent] = 0;
                    $promedioGeneralRecup[$matter->id][$student->idStudent] = 0;
                }
                // $promedioGeneral[$matter->id][$student->idStudent] = bcdiv( ($promediosTotalQ1[$matter->id][$student->idStudent] + $promediosTotalQ2[$matter->id][$student->idStudent])/2, '1', 2);
                // $promedioGeneralRecup[$matter->id][$student->idStudent] = bcdiv( ($promediosFinalQ1[$matter->id][$student->idStudent] + $promediosFinalQ2[$matter->id][$student->idStudent])/2, '1', 2);

                if($promedioGeneralRecup [$matter->id][$student->idStudent] < $supletorios[$matter->id][$student->idStudent]){
                    $promedioFinalQuimestre[$matter->id][$student->idStudent] = $supletorios[$matter->id][$student->idStudent];
                }else if($promedioGeneralRecup [$matter->id][$student->idStudent] < $remediales[$matter->id][$student->idStudent]){
                    $promedioFinalQuimestre[$matter->id][$student->idStudent] = $remediales[$matter->id][$student->idStudent];
                }else if($promedioGeneralRecup [$matter->id][$student->idStudent] < $gracias[$matter->id][$student->idStudent]){
                    $promedioFinalQuimestre[$matter->id][$student->idStudent] = $gracias[$matter->id][$student->idStudent];
                }else{
                    $promedioFinalQuimestre[$matter->id][$student->idStudent] = $promedioGeneralRecup[$matter->id][$student->idStudent];
                }
                $pPromediosTotal[$student->idStudent] += $promedioGeneral[$matter->id][$student->idStudent];
                $pPromediosTotalRecup[$student->idStudent] += $promedioGeneralRecup[$matter->id][$student->idStudent];
                $pPromediosTotalFinal[$student->idStudent] += $promedioFinalQuimestre[$matter->id][$student->idStudent];
                if($matter->principal == 1){
                    if($promedioFinalQuimestre[$matter->id][$student->idStudent] < 7)
                        $aprobados[$student->idStudent] = false;
                }

            }
        }
        $contPasado = 0;
        $contNoPasado = 0;
        $count = 0;
        Carbon::setUtf8(true);
        $now = Carbon::now();
        $fechaA = Fechas::fechaActual($now);
        //$pdf =  PDF::load
        return View('pdf.reportes-por-curso.cursos.anual.nuevo-certificado-pase',
        compact('students','curso','tutor','materiasFijas','materiasExtra','institution',
        'promediosP1Q1','promediosP2Q1','promediosP3Q1','examenesQ1','promediosTotalQ1','recuperacionQ1','promediosFinalQ1','promediosP1Q2',
        'promediosP2Q2','promediosP3Q2','examenesQ2','promediosTotalQ2','recuperacionQ2','promediosFinalQ2','promedioGeneral','promedioGeneralRecup',
        'supletorios','remediales','gracias','promedioFinalQuimestre', 'aprobados','pp1q1','pp2q1','pp3q1','pp1q2','pp2q2','pp3q2','pExamenesQ1',
        'pExamenesQ2','pPromediosQ1','pPromediosQ2','pPromediosTotal', 'pPromediosTotalRecup','pPromediosTotalFinal','faltasJustificadas',
        'faltasInjustificadas','atrasos','educacion','proyecto','count','contPasado','contNoPasado','now','fechaA','gradoSiguiente'));

        // return view('pdf.reportes-por-curso.cursos.anual.nuevo-certificado-pase',
        // compact('students','curso','tutor','materiasFijas','materiasExtra','institution',
        // 'promediosP1Q1','promediosP2Q1','promediosP3Q1','examenesQ1','promediosTotalQ1','recuperacionQ1','promediosFinalQ1','promediosP1Q2','promediosP2Q2','promediosP3Q2','examenesQ2','promediosTotalQ2','recuperacionQ2','promediosFinalQ2','promedioGeneral','promedioGeneralRecup','supletorios','remediales','gracias','promedioFinalQuimestre', 'aprobados','pp1q1','pp2q1','pp3q1','pp1q2','pp2q2','pp3q2','pExamenesQ1','pExamenesQ2','pPromediosQ1','pPromediosQ2','pPromediosTotal', 'pPromediosTotalRecup','pPromediosTotalFinal','faltasJustificadas','faltasInjustificadas','atrasos','educacion','proyecto','count','contPasado','contNoPasado','now','fechaA','gradoSiguiente'));

        return $pdf->download('Certificado pase de año.pdf');
    }
    /**/

    // CERTIFICADO DE PROMOCION PARA EDUCACION INICIAL
    public function CertificadoPromocionEi($idCurso){
        $students = Student2Profile::getStudentsByCourse($idCurso);
        $course = Course::find($idCurso);
        $educacion = Calificacion::nombreSeccionDetallada($course);
        $institution = Institution::find(1);
        $inst = explode(" ", $institution->nombre);
        $periodo = PeriodoLectivo::findOrFail($this->idPeriodoUser());
        $hoy = Fechas::fechaActual();
        $docente = Administrative::find($course->idProfesor);
        $pdf =  PDF::loadView('pdf.reportes-por-curso.estudiantes.certificado-promocion-ei',
            compact('educacion', 'students', 'course', 'institution', 'periodo', 'hoy', 'docente', 'inst' ))
            ->setOrientation('landscape');

        return $pdf->download('Certificado de Matricula.pdf');
    }
}
