<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Student2;
use App\Calificacion;
use App\Destreza;
use App\Course;
use App\Matter;
use App\Institution;
use DB;
use App\Administrative;
use App\ConfiguracionSistema;
use App\UnidadPeriodica;
use App\ParcialPeriodico;
use PDF;
use Carbon\Carbon;
use App\Fechas;
use App\PeriodoLectivo;
use App\Student2Profile;
use App\Area;
use App\calificacionCualitativaAmbitos;
use App\Comportamiento;
use Illuminate\Support\Str;

class PdfControllerInicialPreparatoria extends Controller
{
    /*
	Cuadro Informe (Parcial) ---cuadroInforme
    */
    public function cuadroInformeInicial($curso, $quimestre){
		$institution = Institution::find(1);
		$periodo = PeriodoLectivo::getPeriodo($institution->periodoLectivo);
		$students = Student2::getStudentsByCourse($curso);
		$destrezas = DB::table('destrezas')
			->join('matters', 'destrezas.idMateria', '=', 'matters.id')
			->join('clasesdestrezas', 'clasesdestrezas.idDestrezas', '=', 'destrezas.id')
			->where('clasesdestrezas.parcial', 'EX' . substr($quimestre, 2, 2))->where('matters.idCurso', $curso)
			->select('destrezas.*', 'matters.id', 'clasesdestrezas.calificacion')
			->get();
		$matters = Matter::where(['idCurso' => $curso, 'visible' => 1])->get();

		$pdf = PDF::loadView('pdf.reportes-por-curso.cursos.parcial.cuadro-informe-inicial', compact(
			'institution', 'data', 'date', 'invoice', 'quimestre', 'students', 'matters', 'destrezas',
			'periodo'
		));

		return $pdf->download('Cuadro Informe.pdf');
	}
    /**/


    /*
	Informe Anual Cualitativo (Anual) --informeAnualCualitativo
    */
    public function informeAnualDestrezas($curso, $parcial){
		$institution = Institution::find(1);
		$periodo = PeriodoLectivo::getPeriodo($institution->periodoLectivo);
		$students = Student2Profile::getStudentsByCourse($curso);
        $calificacionesAmbitos = calificacionCualitativaAmbitos::calificacionesCurso($curso);
		$matters = Matter::where(['idCurso' => $curso, 'visible' => 1])->get();
		$course = Course::find($curso);
        $comportamientos = Comportamiento::where('parcial', 'anual')->whereIn('idStudent', $students->pluck('idStudent'))->get();
		$tutor = Administrative::find($course->idProfesor);
		$informe = "Anual_Cualitativo";

		$pdf = PDF::loadView(
			'pdf.reportes-por-curso.cursos.anual.reporte-anual-de-aprendizaje',
			compact(
				'institution', 'students', 'course', 'matters', 'parcial', 'tutor', 'informe',
				'periodo', 'calificacionesAmbitos', 'comportamientos'
			)
        )->setOrientation('landscape');

		return $pdf->download('Informe Anual Cualitativo.pdf');
	}
    /**/


    /*
    Informe Cualitativo Final (Anual) --informeCualitativoFinal
    */
    public function informeFinalDestrezas($curso){
		$students = Student2::getStudentsByCourse($curso);
		$students2 = Student2Profile::whereIn('idStudent', $students->pluck('id'))->where('idPeriodo', $this->idPeriodoUser())->get();
		$course = Course::find($curso);
		$matters = Matter::where(['idCurso' => $curso, 'visible' => 1])->get();
		$tutor = Administrative::find($course->idProfesor);
		$representantes = Administrative::whereIn('id', $students->pluck('idRepresentante')->toArray())->get();
		$destrezas = DB::table('matters')
			->join('calificacion_cualitativa_ambitos', 'calificacion_cualitativa_ambitos.idMateria', '=', 'matters.id')
			->where('matters.idCurso', $curso)
			->where('calificacion_cualitativa_ambitos.Parcial', 'ANUAL')
			->select('matters.id', 'calificacion_cualitativa_ambitos.Calificacion', 'calificacion_cualitativa_ambitos.idStudent')
			->get();
		$institution = Institution::find(1);
		$periodo = PeriodoLectivo::getPeriodo($institution->periodoLectivo);
		$informe = "";
		$pdf = PDF::loadView('pdf.reportes-por-curso.cursos.anual.informe-cualitativo-curso',
			compact('representantes', 'tutor', 'institution', 'matters', 'course', 'students', 'destrezas',
				'informe', 'periodo', 'students2'
			)
		);
		return $pdf->download('Informe Cualitativo Final.pdf');
	}
	public function informeQuimestralDestrezas($curso,$parcial){
		$quimestre = Str::after($parcial, 'q');
        $unidad = UnidadPeriodica::unidadP()->where('identificador', 'q'.$quimestre)->first();
        $parcialP = ParcialPeriodico::parcialP($unidad->id);
		$students = Student2Profile::getStudentsByCourse($curso);
		$course = Course::find($curso);
		$area_pos = Area::areasBySection($course->seccion);//orden de las areas en el descargable
		$matters = DB::table('matters')->where([
            ['idCurso', '=', $curso],
            ['visible', '=', 1]])
            ->leftJoin('areas', 'matters.idArea', '=', 'areas.id')
            ->select('matters.*', 'areas.nombre AS nombreArea')
             ->orderBy('areas.posicion')->get();
		$tutor = Administrative::find($course->idProfesor);
		$representantes = Administrative::whereIn('id', $students->pluck('idRepresentante')->toArray())->get();
		$destrezas = DB::table('destrezas')
			->join('matters', 'destrezas.idMateria', '=', 'matters.id')
			->join('clasesdestrezas', 'clasesdestrezas.idDestrezas', '=', 'destrezas.id')
			->where('matters.idCurso', $curso)
			->select('destrezas.*', 'matters.id', 'clasesdestrezas.calificacion')
			->get();
		$institution = Institution::find(1);
		$periodo = PeriodoLectivo::getPeriodo($this->idPeriodoUser());
		$informe = "";
		$data = new \Illuminate\Support\Collection(json_decode(file_get_contents(
                    'http://'. config('app.api_host_name') .
                    ':8081/libreta/periodo/'. $this->idPeriodoUser().
                    '/quimestre/'.substr($parcial, 2, 2).'/curso/'.$curso))
                );
        $nQuimestre = substr($parcial,3,1);
		$pdf = PDF::loadView(
			'pdf.reportes-por-curso.cursos.quimestral.informe-cualitativo-quimestral-curso',
			compact( 'representantes', 'tutor', 'institution', 'matters', 'course',
			'students', 'destrezas', 'unidad', 'parcialP',
			'informe', 'periodo','quimestre','data','area_pos','nQuimestre'
		))->setOrientation('landscape');
		return $pdf->download('Informe Cualitativo Quimestral Detallado.pdf');
	}
	public function informeAnualDestrezasEstudiantes($curso,$idEstudiante)
    {   $periodo = PeriodoLectivo::getPeriodo($this->idPeriodoUser());
        $students = Student2Profile::getStudentsByCourse($curso);
        $students = $students->where('idStudent', $idEstudiante);
        $course = Course::find($curso);
        $matters = DB::table('matters')->where([
            ['idCurso', '=', $curso],
            ['visible', '=', 1]])
            ->leftJoin('areas', 'matters.idArea', '=', 'areas.id')
            ->select('matters.*', 'areas.nombre AS nombreArea')
             ->orderBy('areas.posicion')->get();
		$tutor = Administrative::find($course->idProfesor);
		$representantes = Administrative::whereIn('id', $students->pluck('idRepresentante')->toArray())->get();        
		$destrezas = DB::table('destrezas')
			->join('matters', 'destrezas.idMateria', '=', 'matters.id')
			->join('clasesdestrezas', 'clasesdestrezas.idDestrezas', '=', 'destrezas.id')
			->where('matters.idCurso', $curso)
			->select('destrezas.*', 'matters.id', 'clasesdestrezas.calificacion')
			->get();
        $unidades = UnidadPeriodica::unidadP();
		$institution = Institution::find(1);
		$periodo = PeriodoLectivo::getPeriodo($this->idPeriodoUser());
        $informe = "";
        $area_pos = Area::areasBySection($course->seccion);
        $data = new \Illuminate\Support\Collection(json_decode(file_get_contents('http://'. config('app.api_host_name') .':8081/libreta/anual/'. $this->idPeriodoUser().'/curso/'.$curso)));	
        $pdf = PDF::loadView(
			'pdf.reportes-por-curso.cursos.anual.informe-cualitativo-anual-curso',
			compact( 'representantes', 'tutor', 'institution', 'matters', 'course',
			'students', 'destrezas', 'data', 'area_pos','periodo',
			'informe','unidades'
		))->setOrientation('landscape');

        return $pdf->download('Informe Cualitativo Anual Detallado.pdf');
    }
    public function informeAnualDestrezasDetalladas($curso)
    {   $periodo = PeriodoLectivo::getPeriodo($this->idPeriodoUser());
        $students = Student2Profile::getStudentsByCourse($curso);
        $course = Course::find($curso);
        $matters = DB::table('matters')->where([
            ['idCurso', '=', $curso],
            ['visible', '=', 1]])
            ->leftJoin('areas', 'matters.idArea', '=', 'areas.id')
            ->select('matters.*', 'areas.nombre AS nombreArea')
             ->orderBy('areas.posicion')->get();
		$tutor = Administrative::find($course->idProfesor);
		$representantes = Administrative::whereIn('id', $students->pluck('idRepresentante')->toArray())->get();        
		$destrezas = DB::table('destrezas')
			->join('matters', 'destrezas.idMateria', '=', 'matters.id')
			->join('clasesdestrezas', 'clasesdestrezas.idDestrezas', '=', 'destrezas.id')
			->where('matters.idCurso', $curso)
			->select('destrezas.*', 'matters.id', 'clasesdestrezas.calificacion')
			->get();
        $unidades = UnidadPeriodica::unidadP();
		$institution = Institution::find(1);
		$periodo = PeriodoLectivo::getPeriodo($this->idPeriodoUser());
        $informe = "";
        $area_pos = Area::areasBySection($course->seccion);
        $data = new \Illuminate\Support\Collection(json_decode(file_get_contents('http://'. config('app.api_host_name') .':8081/libreta/anual/'. $this->idPeriodoUser().'/curso/'.$curso)));
        $pdf = PDF::loadView(
			'pdf.reportes-por-curso.cursos.anual.informe-cualitativo-anual-curso',
			compact( 'representantes', 'tutor', 'institution', 'matters', 'course',
			'students', 'destrezas', 'data', 'area_pos','periodo',
			'informe','unidades'
		))->setOrientation('landscape');

        return $pdf->download('Informe Cualitativo Anual Detallado.pdf');
    }
    /**/

}
