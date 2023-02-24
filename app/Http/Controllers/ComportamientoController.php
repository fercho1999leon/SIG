<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Student2;
use Illuminate\Support\Facades\DB;
use App\Comportamiento;
use PDF;
use App\UnidadPeriodica;
use App\ParcialPeriodico;
use Sentinel;
use App\CourseSchedule;
use Illuminate\Support\Facades\Redirect;
use App\Course;
use App\Calificacion;
use App\Matter;
use App\Institution;
use App\comportamientoMateria;
use App\Administrative;
use App\ConfiguracionSistema;
use App\Notificaciones;
use App\PeriodoLectivo;
use App\Student2Profile;
use App\Traits\mensajeNotificaciones;
use Illuminate\Support\Facades\Response;

class ComportamientoController extends Controller
{
	use mensajeNotificaciones;
    /*
        A D M I N I S T R A D O R
    */
	/*Obtengo el listado de estudiante del curso a realizar el reporte*/
    public function getCourse($id){
    	$students = Student2::getStudentsByCourse($id);
    	$count = 1;
    	return view('UsersViews.administrador.grados.calificaciones.comportamiento.index', compact('students', 'count'));
    }

    /*Método para editar el reporte de un estudiante*/
    public function editStudent($id,$parcial){
    	//return "Hola";
    	$student = Student2::findOrFail($id);
    	return view('UsersViews.administrador.grados.calificaciones.comportamiento.comportamientoEdit', compact('student','parcial'));
    }

    /*Método para actualizar la información del estudiante*/
    public function updateStudent(Request $request, $id){
        $student = Student2::findOrFail($id);

        if($request->p1q1C != null)
            $student->p1q1C = $request->p1q1C;
		if($request->p1q1O != null)
            $student->p1q1O = $request->p1q1O;
        if($request->p1q1R != null)
            $student->p1q1R = $request->p1q1R;

        if($request->p2q1C != null)
            $student->p2q1C = $request->p2q1C;
        if($request->p2q1O != null)
            $student->p2q1O = $request->p2q1O;
        if($request->p2q1R != null)
            $student->p2q1R = $request->p2q1R;

        if($request->p3q1C != null)
            $student->p3q1C = $request->p3q1C;
        if($request->p3q1O != null)
            $student->p3q1O = $request->p3q1O;
        if($request->p3q1R != null)
            $student->p3q1R = $request->p3q1R;

        if($request->p1q2C != null)
            $student->p1q2C = $request->p1q2C;
        if($request->p1q2O != null)
        	$student->p1q2O = $request->p1q2O;
        if($request->p1q2R != null)
            $student->p1q2R = $request->p1q2R;

        if($request->p2q2C != null)
            $student->p2q2C = $request->p2q2C;
        if($request->p2q2O != null)
            $student->p2q2O = $request->p2q2O;
        if($request->p2q2R != null)
            $student->p2q2R = $request->p2q2R;

        if($request->p3q2C != null)
            $student->p3q2C = $request->p3q2C;
        if($request->p3q2O != null)
            $student->p3q2O = $request->p3q2O;
        if($request->p3q2R != null)
            $student->p3q2R = $request->p3q2R;

		$student->save();
        return redirect()->route('reporteComportamientoCurso', $student->idCurso);
    }


    /* COMPORTAMIENTO TUTORIA */
	public function tutorHome($idCurso, $parcial) {
		$unidad = UnidadPeriodica::unidadP();
		$count = 1;
		$courses = Course::getAllCourses();
		$periodo = Sentinel::getUser()->idPeriodoLectivo;
		$confComportamiento = ConfiguracionSistema::comportamientoQuimestral();
		if ($confComportamiento->valor == "crear"){
			$parcialP = ParcialPeriodico::whereIn('idUnidad', $unidad->pluck('id'))->where('activo', 1)->get();
		} else {
			$parcialP = ParcialPeriodico::whereIn('idUnidad', $unidad->pluck('id'))->where('activo', 1)->where('identificador', '!=', 'q1')->where('identificador', '!=', 'q2')->get();
		}
		$course = Course::find($idCurso);
		$comportamientoEstudiantes = Comportamiento::all();
		$tutor = session('user_data');
		$students = Student2Profile::getStudentsByCourse($idCurso);
		return view('UsersViews.docente.tutoria.comportamiento.index', compact(
			'course', 'courses', 'parcial', 'students', 'count', 'comportamientoEstudiantes', 'confComportamiento', 'periodo',
			'unidad', 'parcialP'
		));
	}
	public function tutorEstudiante($idCurso, $parcial, $idEstudiante) {
		$unidad = UnidadPeriodica::unidadP();
		$comportamientoPorMaterias = comportamientoMateria::where(['idStudent' => $idEstudiante])->get();
		$courses = Course::getAllCourses();
		$comportamientoNotas = ['A', 'B', 'C', 'D', 'E'];
		$confComportamiento = ConfiguracionSistema::comportamientoQuimestral();
		if ($confComportamiento->valor == "crear"){
			$parcialP = ParcialPeriodico::whereIn('idUnidad', $unidad->pluck('id'))->where('activo', 1)->get();
		} else {
			$parcialP = ParcialPeriodico::whereIn('idUnidad', $unidad->pluck('id'))->where('activo', 1)->where('identificador', '!=', 'q1')->where('identificador', '!=', 'q2')->get();
		}
		$student = Student2::find($idEstudiante);
		$parcial = $parcial;
		$matters = Matter::where('idCurso', $idCurso)->get();
		$schedules = CourseSchedule::where('idCurso', $idCurso)->orderBy('horaInicio')->get();
		$course = Course::find($idCurso);
		//comportamiento-materia//
		$comp = $student->comporMateriaEstudiante($parcial);
		//fin comportamiento materia//
		$comportamientoEstudiante = Comportamiento::where(['idStudent'=> $idEstudiante, 'parcial'=> $parcial , 'idPeriodo' => Sentinel::getUser()->idPeriodoLectivo])->Orderby('id','DESC')->first();
		return view('UsersViews.docente.tutoria.comportamiento.estudiante', compact(
			'course', 'courses', 'parcial', 'student', 'schedules', 'matters', 'comportamientoEstudiante',
			'comportamientoNotas', 'comportamientoPorMaterias', 'confComportamiento','comp', 'parcialP', 'unidad'

		));
	}

	public function tutorStore(Request $request, $idCurso, $parcial, $idEstudiante) {
		$comportamientoEstudiante = Comportamiento::where(['idStudent' => $idEstudiante,
			'idPeriodo' => $this->idPeriodoUser(),
			'parcial' => $parcial])->first();
		if ($comportamientoEstudiante == null) {
			$data = Comportamiento::create([
				'idStudent' => $request->idEstudiante,
				'parcial' => $request->parcial,
				'idPeriodo' => $this->idPeriodoUser(),
				'observacion' => $request->observacion,
				'nota' => $request->nota
			]);
			// Notificaciones
			$student = Student2::find($data->idStudent);
			$this->mensajeComportamiento($request->parcial, $student, $data);
			return redirect()->route('tutor-comportamiento', ['course' => $idCurso, 'parcial' => $parcial]);
		} else {
			return Redirect::back()->withErrors(['error' => 'Alguien ya ha ingresado el comportamiento para este estudiante.']);
		}
	}

	public function tutorUpdate(Request $request, $idCurso, $parcial, $idEstudiante) {

		$data = Comportamiento::where('idStudent', $idEstudiante)->where('parcial', $parcial)
        ->where('idPeriodo', Sentinel::getUser()->idPeriodoLectivo)->first();
		$data->nota = $request->nota;
		$data->observacion = $request->observacion;
		$data->save();
		return redirect()->route('tutor-comportamiento', ['course' => $idCurso, 'parcial' => $parcial]);
	}

	/* COMPORTAMIENTO ADMINISTRADOR */
	public function home() {
		$regimen = ConfiguracionSistema::regimen();
		$coursesEI = Course::getCourse('EI');
		$coursesEGB = Course::getCourse('EGB');
		$coursesBGU = Course::getCourse('BGU');
		return view('UsersViews.administrador.comportamiento.index', compact(
			'coursesEGB', 'coursesEI', 'coursesBGU', 'regimen'
		));
	}

	public function curso($id, $parcial) {
		$count = 1;
		$periodo = Sentinel::getUser()->idPeriodoLectivo;
		$course = Course::find($id);
		$comportamientoEstudiantes = Comportamiento::where('parcial', $parcial)->get();
		$parcial = $parcial;
        $students = Student2Profile::getStudentsByCourse($id);
		$confComportamiento = ConfiguracionSistema::comportamientoQuimestral();
		return view('UsersViews.administrador.comportamiento.curso', compact(
			'course', 'students', 'count', 'parcial', 'comportamientoEstudiantes', 'confComportamiento', 'periodo'
		));
	}

	public function estudiante($idEstudiante, $parcial, $idCurso) {
		$confComportamiento = ConfiguracionSistema::comportamientoQuimestral();
		$comportamientoPorMaterias = comportamientoMateria::where(['idStudent' => $idEstudiante])->get();
		$comportamientoNotas = ['A', 'B', 'C', 'D', 'E'];
		$parcial = $parcial;
		$course = Course::find($idCurso);
		$schedules = CourseSchedule::where('idCurso', $idCurso)->orderBy('horaInicio')->get();
		$matters = Matter::where('idCurso', $idCurso)->get();
		$comportamientoEstudiante = Comportamiento::where(['idStudent'=> $idEstudiante, 'parcial'=> $parcial, 'idPeriodo' => Sentinel::getUser()->idPeriodoLectivo])->Orderby('id','DESC')->first();
		$student = Student2::find($idEstudiante);
		return view('UsersViews.administrador.comportamiento.estudiante', compact(
			'course', 'student', 'parcial', 'comportamientoEstudiante', 'comportamientoNotas',
			'matters', 'schedules', 'comportamientoPorMaterias', 'confComportamiento'
		));
	}

	public function store($idEstudiante, $parcial, Request $request) {
		$studentConComportamiento = Comportamiento::where(['idStudent' => $idEstudiante, 'parcial' => $parcial, 'idPeriodo' => Sentinel::getUser()->idPeriodoLectivo])->first();
		if ($studentConComportamiento == null) {
			$student = Student2::find($idEstudiante);
			$studentProfile = Student2Profile::where('idStudent',$idEstudiante)
			->where('idPeriodo',Sentinel::getUser()->idPeriodoLectivo)
			->first();
			$data = new Comportamiento();
			$course = Course::find($studentProfile->idCurso);

			$data->idStudent = $request->idEstudiante;
			$data->parcial = $request->parcial;
			$data->idPeriodo = $this->idPeriodoUser();
			$data->observacion = $request->observacion;
			$data->nota = $request->nota;
			$data->save();

			// Notificaciones
			$this->mensajeComportamiento($request->parcial, $student, $data);
			return redirect()->route('comportamiento-curso', ['idCurso' => $course->id, 'parcial' => $parcial]);
		} else {
			return Redirect::back()->withErrors(['error' => 'Alguien ya ha ingresado el comportamiento para este estudiante.']);
		}

	}

	public function update($idEstudiante, $parcial, Request $request) {
		$data = Comportamiento::where('idStudent', $idEstudiante)->where('parcial', $parcial)->first();
		$student = Student2Profile::where('idStudent',$idEstudiante)
		->where('idPeriodo',Sentinel::getUser()->idPeriodoLectivo)
		->first();
		$course = Course::find($student->idCurso);
		$data->parcial = $request->parcial;
		$data->observacion = $request->observacion;
		$data->nota = $request->nota;
		$data->save();

		return redirect()->route('comportamiento-curso', ['idCurso' => $course->id, 'parcial' => $parcial]);
	}
	public function reportePorParcial(Course $course, $parcial) {
		$i = 1;
		$periodo = PeriodoLectivo::findOrFail(Sentinel::getUser()->idPeriodoLectivo);
		$institution = Institution::first();
		$tutor = Administrative::find($course->idProfesor);
		$comportamientos = Comportamiento::where('parcial', $parcial)->get();
		$students = Student2Profile::getStudentsByCourse($course->id);
		$pdf = PDF::loadView('pdf.comportamiento-por-parcial', compact(
			'institution', 'course', 'parcial', 'tutor', 'students', 'i', 'comportamientos', 'periodo'));
		return $pdf->download("Reporte de comportamiento por parcial {$parcial}.pdf");
	}

	/* COMPORTAMIENTO DOCENTE */
	public function docenteHome() {
		try {
			$materias = Matter::with('curso')->where('idDocente', session('user_data')->userid)->get()->groupBy('curso.grado');
			$docenteId = session('user_data')->userid;
			$courses = Course::getAllCourses();
			return view('UsersViews.docente.comportamiento.index', compact(
				'materias', 'courses', 'docenteId'
			));
		} catch (Exception $e) {
			return ('Error: ' . $e->getMessage());
		}
	}

	public function docenteEstudiante($idCurso, $idMateria, $parcial) {
		$courses = Course::getAllCourses();
		$count = 1;
		$materia = Matter::find($idMateria);
		$students = Student2::where('idCurso', $idCurso)->get();
		$comportamientoEstudiantes = comportamientoMateria::all();
		return view('UsersViews.docente.comportamiento.estudiante', compact(
			'students', 'courses', 'materia', 'count', 'comportamientoEstudiantes', 'parcial'
		));
	}

	public function docenteMateria($idCurso, $idMateria, $parcial, $idStudent) {
		$courses = Course::getAllCourses();
		$comportamientoNotas = ['A', 'B', 'C', 'D', 'E'];
		$comportamientoEstudiante = comportamientoMateria::where(['idStudent'=> $idStudent, 'parcial'=> $parcial, 'idMateria' => $idMateria])->first();
		$student = Student2::find($idStudent);
		$materia = Matter::find($idMateria);
		$course = Course::find($idCurso);
		$parcial = $parcial;
		return view('UsersViews.docente.comportamiento.materia', compact(
			'materia', 'parcial', 'course', 'courses', 'comportamientoNotas', 'comportamientoEstudiante', 'student'
		));
	}

	public function docenteStore(Request $request, $idCurso, $idMateria, $parcial, $idStudent) {
		$comportamientoEstudiante = comportamientoMateria::where(['idStudent' => $idStudent, 'parcial' => $parcial])->first();
		if ($comportamientoEstudiante == null) {
			$data = new comportamientoMateria;
			$student = Student2::find($idStudent);
			$data->idStudent = $request->idStudent;
			$data->idMateria = $request->idMateria;
			$data->parcial = $request->parcial;
			$data->nota = $request->nota;
			$data->observacion = $request->observacion;
			$data->idPeriodo = $student->idPeriodo;
			$data->save();
			return redirect()->route('comportamiento_docente-estudiante', ['idCurso' => $idCurso, 'idMateria' => $idMateria, 'parcial' => $parcial]);
		} else {
			return Redirect::back()->withErrors(['error' => 'Alguien ya ha ingresado el comportamiento para este estudiante.']);
		}
	}

	public function docenteUpdate(Request $request, $idCurso, $idMateria, $parcial, $idStudent) {
		$data = comportamientoMateria::where('idStudent', $idStudent)->where('parcial', $parcial)->where('idMateria', $idMateria)->first();
		$data->nota = $request->nota;
		$data->parcial = $request->parcial;
		$data->observacion = $request->observacion;
		$data->save();
		return redirect()->route('comportamiento_docente-estudiante', ['idCurso' => $idCurso, 'idMateria' => $idMateria, 'parcial' => $parcial]);
	}
	public function DocenteComportamiento(){
		 $courses = Course::getAllCourses();
        try {
			$materias = Matter::with('curso')
				->where('idPeriodo', $this->idPeriodoUser())
				->where('idDocente', session('user_data')->userid)->get()
				->groupBy('curso.grado');
               return view('UsersViews.docente.comportamiento.general', compact('courses', 'materias'));
        } catch (Exception $e) {

            return $e->getMessage();
        }
	}
	public function DocenteComportamientoCurso(Request $request, $id, $parcial){
			$courses = Course::getAllCourses();
			$materia = Matter::FindOrFail($id);
			$confComportamiento = ConfiguracionSistema::comportamientoQuimestral();
			$count = 1;
            $students = Student2Profile::getStudentsByCourse($materia->idCurso);
            $course = Course::getCoursesByCourse($materia->idCurso);
			$view = \View::make('UsersViews.docente.comportamiento.general-listar-curso')->with(['course' => $course, 'parcial' => $parcial, 'students' => $students, 'confComportamiento' => $confComportamiento,'count' => $count,'courses' => $courses,'materia'=>$materia]);
        if($request->ajax()){
            $sections = $view->renderSections();
            return Response::json($sections['contentPanel']);
        }else {
           return View('UsersViews.docente.comportamiento.general-curso')->with(['course' => $course, 'parcial' => $parcial, 'students' => $students,'confComportamiento' => $confComportamiento,'count' => $count,'courses' => $courses,'materia'=>$materia]);
		}

	}
	public function storeComportamientosNew(Request $request){
		$i= 0;
		foreach ($request->descripcion as $descripcion) {
			list($studiante,$nota,$desc) = explode("|*|", $descripcion);
			$comportamientoPromedio = ConfiguracionSistema::comportamientoPro();

            comportamientoMateria::updateOrCreate(
                [ 'idStudent'=> $studiante, 'idMateria' => $request->id_materia, 'parcial' => $request->parcial, 'idPeriodo' => $this->idPeriodoUser() ],
                [ 'observacion' => $desc, 'nota' => $nota, ]
            );
                
            if ($comportamientoPromedio->valor == 1 ){
                $comportamientoTutor = Comportamiento::ComportamientoCualitativo($studiante, $request->parcial);
                $promedioComportamiento =  Calificacion::notaComportamientoPromedio($studiante, $request->parcial);
                if ($comportamientoTutor == null){
                    $comportamientoTutor = new Comportamiento();
                    $comportamientoTutor->idPeriodo = Sentinel::getUser()->idPeriodoLectivo;
                    $comportamientoTutor->parcial = $request->parcial;
                    $comportamientoTutor->idStudent = $studiante;
                }
                $comportamientoTutor->nota = $promedioComportamiento;
                $comportamientoTutor->save();
            }
		}
		return ['mensaje'=>'Actualizado'];
	}
	public function eliminarComportamientosNew($id){
		$comportamiento = comportamientoMateria::findOrFail($id);
		$comportamiento->delete();
	}

}

