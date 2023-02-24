<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Student2;
use App\Course;
use App\Promedio;
use App\Matter;
use App\Supply;
use App\ReportePromedios;
use App\Institution;
use DB;
use Sentinel;
use PDF;
use Carbon\Carbon;
use App\ConfiguracionSistema;
use App\Calificacion;
use App\Activity;
use App\Administrative;
use Illuminate\Support\Facades\Redirect;
use App\PeriodoLectivo;

class PdfController2 extends Controller
{

    public function RefuerzoAcademicoReporte($matter,$parcial){
        $matter = Matter::find($matter);
        $supplies = Supply::getSuppliesByMatter($matter->id);
        $promedios = Calificacion::getPromedioSupplySinRefuerzo($matter->id,$matter->idCurso,$parcial);
        $promedioFinal = Calificacion::getPromedioSupply($matter->id,$matter->idCurso,$parcial);
        $refuerzos = Calificacion::getRefuerzosAcademicos($matter->id,$matter->idCurso,$parcial);
        $course = Course::find($matter->idCurso);
		$institution = Institution::find(1);
		$periodo = PeriodoLectivo::getPeriodo(Sentinel::getUser()->idPeriodoLectivo);
        $teacher = Administrative::findBySentinelid($matter->idDocente);
        $data = new \Illuminate\Support\Collection(json_decode(file_get_contents('http://'. config('app.api_host_name') .':8081/libreta/periodo/'. $this->idPeriodoUser().'/parcial/'.$parcial.'/curso/'.$matter->idCurso)) );
        $prom = Calificacion::getPromedioMatter($matter->idCurso,$parcial);
        $students = Student2::getStudentsByCourse($matter->idCurso);
        $studentsID = [];

        foreach($students as $student){
            foreach($data as $d){
                if($d->estudiante->ID == $student->id){
                    $p = new \Illuminate\Support\Collection($d->parcial);
                    $prom = $p->where('materiaId', $matter->id)->first();
                    $pi = $prom->promedioInicial;
                    $pg = $prom->promedioFinal;
                    if($pi<7){
                        array_push($studentsID, $student->id);
                    }
                }
            }
        }

        $studentsID = array_unique($studentsID);

        $activities = Activity::whereIn('idInsumo',$supplies->pluck('id')->toArray())->where(['nombre' =>'REFUERZO ACADEMICO', 'parcial' => $parcial])->pluck('id')->toArray();
        $calificaciones = Calificacion::whereIn('idActividad', $activities); //->pluck('idEstudiante')->toArray();
        $students = Student2::whereIn('id',$studentsID)->get();
        $now = Carbon::now();


        $pdf =  PDF::loadView('pdf.refuerzo-academico',
        compact('matter', 'now', 'teacher', 'calificaciones', 'parcial', 'data',
			'students','institution', 'supplies','promedios', 'refuerzos', 'course', 'promedioFinal',
			'periodo'
		));

        return $pdf->download('Refuerzo Academico.pdf');
    }

    public function ResumenCalificaciones($curso,$parcial){
        $matters = Matter::getMattersByCourse($curso);

        $promedios = Calificacion::getPromedioMatter($curso,$parcial);
        $course = Course::find($curso);
        $institution = Institution::find(1);
		$periodo = PeriodoLectivo::getPeriodo(Sentinel::getUser()->idPeriodoLectivo);
        $students = Student2::getStudentsByCourse($curso);
        $totalEstudiantes = count($students);
		$now = Carbon::now();

        $pdf =  PDF::loadView('pdf.reportes-por-curso.cursos.parcial.resumen-de-calificaciones-por-parcial',
		compact('matters', 'now', 'parcial', 'institution', 'students', 'course', 'promedios', 'totalEstudiantes',
		'periodo'))->setOrientation('landscape');

        return $pdf->download('Resumen de Calificaciones.pdf');
    }

    public function ResumenCalificacionesQuimestre($curso,$parcial){
        $matters = Matter::getMattersByCourse($curso);
        foreach ($matters as $materia) {
                if($materia->idArea == null){
                     return Redirect::back()->withErrors(['error' => 'La materia: '.$materia->nombre.' no tiene area asignada']);
            }
            }
        $promedios = Calificacion::getPromedioFinalQuimestreCurso($curso, substr( $parcial,2,2));
        $course = Course::find($curso);
        $institution = Institution::find(1);
		$periodo = PeriodoLectivo::getPeriodo(Sentinel::getUser()->idPeriodoLectivo);
        $students = Student2::getStudentsByCourse($curso);
        $totalEstudiantes = count($students);
		$now = Carbon::now();
        $pdf =  PDF::loadView('pdf.reportes-por-curso.cursos.quimestral.resumen-calificaciones-por-quimestre',
		compact('matters', 'now', 'parcial', 'institution', 'students', 'course', 'promedios', 'totalEstudiantes',
		'periodo'))->setOrientation('landscape');

        return $pdf->download('Resumen de Calificaciones.pdf');
    }

    public function RefuerzoAcademicoReporteCurso($curso,$parcial){
        $matters = Matter::getMattersByCourse($curso);
        $promedios = [];
        $promedioFinal = [];
        $refuerzos = [];
        $ra_i = 1;
        foreach ($matters as $matter) {
            $promedios[$matter->id] = Calificacion::getPromedioSupplySinRefuerzo($matter->id,$matter->idCurso,$parcial);
            //$promedioFinal[$matter->id] = Calificacion::getPromedioSupply($matter->id,$matter->idCurso,$parcial);
            $refuerzos[$matter->id] = Calificacion::getRefuerzosAcademicos($matter->id,$matter->idCurso,$parcial);
            $teacher[$matter->id] = Administrative::findBySentinelid($matter->idDocente);        }
            $data = new \Illuminate\Support\Collection(json_decode(file_get_contents('http://'. config('app.api_host_name') .':8081/libreta/periodo/'. $this->idPeriodoUser().'/parcial/'.$parcial.'/curso/'.$curso)) );
            $studentsID = [];
            //$prom = Calificacion::getPromedioMatter($curso,$parcial);
            $supplies = Supply::where('idCurso', $curso)->where('nombre', '!=', 'RECUPERATORIO')->where('nombre', '!=', 'ENSAYO')
    		    ->where('nombre', '!=', 'EXAMEN QUIMESTRAL')->get();
            $students = Student2::getStudentsByCourse($matter->idCurso);
            $PromedioInsumo = ConfiguracionSistema::PromedioInsumo()->valor;
            $hasStudents = false;
            foreach($matters as $matter){
                $studentsID[$matter->id] = [];
                foreach($students as $student){
                    foreach($data as $d){
                        if($d->estudiante->ID == $student->id){
                            $p = new \Illuminate\Support\Collection($d->parcial);
                            $prom = $p->where('materiaId', $matter->id)->first();
                            foreach($prom->insumos as $insumos){
                            if( $insumos->refuerzo >0 ){
                                array_push($studentsID[$matter->id], $student->id);
                                $hasStudents = true;
                            }
                        }
                        }
                    }
                }
            $studentsID[$matter->id] = array_unique($studentsID[$matter->id]);
        }
        if($hasStudents){
            $course = Course::find($curso);
			$institution = Institution::find(1);
			$periodo = PeriodoLectivo::getPeriodo(Sentinel::getUser()->idPeriodoLectivo);
            $now = Carbon::now();
            $pdf =  PDF::loadView('pdf.reportes-por-curso.cursos.parcial.refuerzo-academico-curso',
            compact('matters', 'now', 'teacher', 'studentsID', 'parcial', 'students','institution',
            'supplies','promedios', 'refuerzos', 'course', 'data', 'periodo', 'ra_i','PromedioInsumo'));
            return $pdf->download('Refuerzo Academico.pdf');
        }else{
            return Redirect::back()->withErrors(['login_fail' => 'No existen alumnos con refuerzo.']);
        }
    }

	public function test() {
		$count = 1;
		$students = Student2::getStudentsByCourse(8);
		$cantidadDeEstudiantes = count($students);
		$cantidadDeEstudiantesPorHoja = 15;
		$cantidadDeEstudiantesPorHojaSumatoria = $cantidadDeEstudiantesPorHoja;
		$sliceEstudiantes = 0;
		return view('pdf.test', compact(
			'students', 'cantidadDeEstudiantes', 'cantidadDeEstudiantesPorHoja',
			'cantidadDeEstudiantesPorHojaSumatoria', 'cantidadDeEstudiantes',
			'sliceEstudiantes', 'count'
		));
	}
}
