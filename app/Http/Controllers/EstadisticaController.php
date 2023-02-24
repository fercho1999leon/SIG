<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Calificacion;
use App\Administrative;
use App\Matter;
use App\Institution;
use App\Course;
use PDF;
use Sentinel;
use App\PeriodoLectivo;
use App\Student2;
class EstadisticaController extends Controller
{
	public function invoice($idCurso,$parcial)
	{
		$students = Student2::getStudentsByCourse($idCurso);
		$promedios = json_decode(file_get_contents('http://'. config('app.api_host_name') .':8081/promedio/periodo/'. $this->idPeriodoUser().'/parcial/'.$parcial.'/curso/'.$idCurso));
		$matters = Matter::getMattersByCourse($idCurso);
		$proyecto = $matters->where('area', 'PROYECTOS ESCOLARES');
		if ( count($proyecto) > 0 )
			$matters = $matters->where('principal', 1)->merge($proyecto);
		else
			$matters = $matters->where('principal', 1);
		$mattersProm = [];
		$total = 0;
		$notasCompletas = true;
        $quimestre = substr($parcial,3,1);
		$n_parcial =  substr($parcial,1,1);
		$mat = 0;
		foreach($matters as $matter) {
			$mattersProm[$matter->id]['promedio'] = 0;
			$mattersProm[$matter->id]['completo'] = true;
			$c = 0;
			foreach($promedios as $promedio) {
				if( $students->find($promedio->alumno->ID) ){
					foreach( $promedio->materias as $materia ) {
						if($materia->materiaId == $matter->id ) {
							$mattersProm[$matter->id]['promedio'] += bcdiv($materia->promedioFinal, '1', 2);
							$c++;
							if ($mattersProm[$matter->id]['promedio'] == 0) {
								$mattersProm[$matter->id]['completo'] = false;
								$notasCompletas = false;
								$mat++;
							}
							break;
						}
					}
				}
			}
			if($mattersProm[$matter->id]['promedio'] != 0 && $c != 0) {
				$mattersProm[$matter->id]['promedio'] = $mattersProm[$matter->id]['promedio'] / $c;
				$total += $mat == 0 ? $mattersProm[$matter->id]['promedio'] / (count($matters)-$mat) : 0;
			}
		}
		$institution = Institution::find(1);
		$periodo = PeriodoLectivo::findOrFail(Sentinel::getUser()->idPeriodoLectivo);
		$course = Course::find($idCurso);
		return view('pdf.reportes-por-curso.cursos.parcial.estadisticas-por-parcial',
			compact('matters', 'parcial', 'institution', 'course', 'periodo', 'mattersProm', 'notasCompletas',
			'quimestre', 'n_parcial', 'total'
		));
	}

	public function EstadisticasQuimestre($idCurso,$parcial)
	{
        //$calificaciones = Calificacion::getPromedioGeneralMateriasQuimestre($idCurso, $parcial);
        $data = new \Illuminate\Support\Collection(json_decode(file_get_contents('http://'. config('app.api_host_name') .':8081/promedio/periodo/'. $this->idPeriodoUser().'/quimestre/'.substr( $parcial,2,2).'/curso/'.$idCurso)));
        dd($data);
        $institution = Institution::find(1);
		$periodo = PeriodoLectivo::getPeriodo($institution->periodoLectivo);
		$matters = Matter::getMattersByCourse($idCurso);
        $course = Course::find($idCurso);
        $n_parcial = substr( $parcial,1,1);
        $quimestre = substr( $parcial,3,1);

		return view('pdf.reportes-por-curso.cursos.quimestral.estadisticas-por-quimestre',
		compact('matters', 'data', 'parcial', 'institution', 'course', 'periodo', 'quimestre', 'n_parcial') );

	}

	public function EstadisticasParcialDocente($idDocente,$parcial)
	{

		$calificaciones = json_decode(file_get_contents('http://'. config('app.api_host_name') .':8081/promedio/parcial/'.$parcial.'/docente/'.$idDocente));
		$notas = Calificacion::getPromedioGeneralMateriasDocente($idDocente,$parcial);


		$teacher = Administrative::find($idDocente);
		$institution = Institution::find(1);
		$periodo = PeriodoLectivo::getPeriodo($institution->periodoLectivo);

		$matters = Matter::getMattersByProfessor($idDocente);
		$proyecto = $matters->where('area', 'PROYECTOS ESCOLARES');
		if ( count($proyecto)>0)
			$matters = $matters->where('principal', 1)->merge($proyecto);
		else
			$matters = $matters->where('principal', 1);
		$courses = Course::getCoursesByDocente($teacher->userid);
		$n_parcial = "";
		$quimestre = "";
		switch ($parcial){
			case "p1q1":
				$n_parcial = "1";
				$quimestre = "1";
			break;
			case "p2q1":
				$n_parcial = "2";
				$quimestre = "1";
			break;
			case "p3q1":
				$n_parcial = "3";
				$quimestre = "1";
			break;
			case "p1q2":
				$n_parcial = "1";
				$quimestre = "2";
			break;
			case "p2q2":
				$n_parcial = "2";
				$quimestre = "2";
			break;
			case "p3q2":
				$n_parcial = "3";
				$quimestre = "2";
			break;

		}

		$tituloParcial = "Quimestre $quimestre - Parcial $n_parcial";

		return view('pdf.reportes-por-curso.docentes.estadisticas-docente',
		compact('matters', 'calificaciones', 'parcial', 'institution', 'courses', 'tituloParcial',
			'periodo', 'notas'
		));
	}

	public function EstadisticasQuimestreDocente($idDocente,$parcial)
	{
		$calificaciones = Calificacion::getPromedioGeneralMateriasQuimestreDocente($idDocente, $parcial);
		$teacher = Administrative::find($idDocente);
		$institution = Institution::find(1);
		$periodo = PeriodoLectivo::getPeriodo($institution->periodoLectivo);
		$matters = Matter::getMattersByProfessor($idDocente);
		$courses = Course::getCoursesByDocente($teacher->userid);

		$n_parcial = "";
		$quimestre = "";
		switch ($parcial){
			case "p1q1":
				$n_parcial = "1";
				$quimestre = "1";
			break;
			case "p2q1":
				$n_parcial = "2";
				$quimestre = "1";
			break;
			case "p3q1":
				$n_parcial = "3";
				$quimestre = "1";
			break;
			case "p1q2":
				$n_parcial = "1";
				$quimestre = "2";
			break;
			case "p2q2":
				$n_parcial = "2";
				$quimestre = "2";
			break;
			case "p3q2":
				$n_parcial = "3";
				$quimestre = "2";
			break;

		}

		$tituloParcial = "Quimestre $quimestre";

		return view('pdf.reportes-por-curso.docentes.estadisticas-docente',
		compact('matters', 'calificaciones', 'parcial', 'institution', 'courses', 'tituloParcial',
			'periodo'
		));
	}

	public function EstadisticasAnualDocente($idDocente)
	{
		$calificaciones = Calificacion::getPromedioGeneralMateriasAnualDocente($idDocente);
		$teacher = Administrative::find($idDocente);
		$institution = Institution::find(1);
		$periodo = PeriodoLectivo::getPeriodo($institution->periodoLectivo);
		$matters = Matter::getMattersByProfessor($idDocente);
		$courses = Course::getCoursesByDocente($teacher->userid);
		$tituloParcial = 'Anual';

		return view('pdf.reportes-por-curso.docentes.estadisticas-docente',
		compact('matters', 'calificaciones', 'institution', 'courses', 'tituloParcial', 'periodo') );

	}
}
