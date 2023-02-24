<?php

namespace App\Http\Controllers;

use App\ConfiguracionSistema;
use App\Course;
use App\DailyAssistance;
use App\Matter;
use App\Student2;
use App\Student2Profile;
use App\Traits\asistenciaDiaria;
use App\Usuario;
use Carbon\Carbon;
use Exception;
use Sentinel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class DocenteAsistenciaMateria extends Controller {

    public function index() {
		$admin = false;
		$fecha = Carbon::now()->format('Y-m-d');
		$day = Carbon::now()->dayOfWeek;
		$cursos = DB::table('courses')
			->join('matters', 'courses.id', '=', 'matterss.idCurso')
			->where('matters.idDocente', session('user_data')->userid)
			->where('courses.id', session('user_data')->userid)
			->select('courses.id', 'matters.id as materiaId', 'courses.grado', 'courses.especializacion', 'courses.paralelo', 'matters.nombre as materia')
			->get();
		$courses = Course::getAllCourses();

		return view('UsersViews.docente.asistencia.index', compact(
			'cursos', 'courses', 'fecha', 'day', 'admin'
		));
	}

    public function AsistenciaPorMaterias() {
		$user = Usuario::find(session('user_data')->userid);
		$admin = false;
		$tutor = 'false';
		$fecha = Carbon::now()->format('Y-m-d');
		$day = Carbon::now()->dayOfWeek;
		$cursos = DB::table('matters')
			->join('courses', 'matters.idCurso', '=', 'courses.id')
			->where('matters.idDocente', session('user_data')->userid)
			->select('courses.id', 'matters.id as materiaId', 'courses.grado', 'courses.especializacion', 'courses.paralelo', 'matters.nombre as materia')
			->get();

		$courses = Course::getAllCourses();

		return view('UsersViews.docente.asistencia.index', compact(
			'cursos', 'courses', 'fecha', 'day', 'admin', 'tutor'
		));
	}

	public function materia(Course $course, Matter $materia) {

		try {
			$perfil = session('user_data');
			if (request('fecha') == null || strlen(request('fecha')) < 10 )
				throw new Exception("Lo sentimos, hubo un error", 404);
			$fecha1 = Carbon::createFromDate(substr(request('fecha'),0,4),substr(request('fecha'),5,2),substr(request('fecha'),8,2));
			$tutor = request('tutor');
			$diasDeLaSemana = [
				$fecha1->startOfWeek()->format('Y-m-d') => [1 => 'Lunes'],
				$fecha1->startOfWeek()->addDay(1)->format('Y-m-d') => [2 => 'Martes'],
				$fecha1->startOfWeek()->addDay(2)->format('Y-m-d') => [3 => 'Miercoles'],
				$fecha1->startOfWeek()->addDay(3)->format('Y-m-d') => [4 => 'Jueves'],
				$fecha1->startOfWeek()->addDay(4)->format('Y-m-d') => [5 => 'Viernes'],
				$fecha1->startOfWeek()->addDay(5)->format('Y-m-d') => [6 => 'Sábado'],
				$fecha1->startOfWeek()->addDay(6)->format('Y-m-d') => [7 => 'Domingo'],
			];
			$count = 1;
			$countStudents = 1;
			$students = Student2Profile::getStudentsByCourse($course->id);
			$courses = Course::getAllCourses();
			$day = Carbon::createFromFormat('Y-m-d', request('fecha'))->dayOfWeek;
			if ($day === 0) {
				throw new Exception("Los domingos no existe ningun horario.");
			}
			$schedules = $course->schedules()->get();
			for ($i=1; $i <= 6; $i++) {
				foreach ($course->schedules()->where('dia'.$i, $materia->id)->get() as $hora) {
					$colSpan[$i] = count($course->schedules()->where('dia'.$i, $materia->id)->get());
				}
			}
			//dd($schedules,$courses);
			return view('UsersViews.docente.asistencia.materia', compact(
				'courses', 'materia', 'course', 'schedules', 'students', 'day',
				'count', 'countStudents', 'diasDeLaSemana', 'colSpan', 'fecha1', 'perfil', 'tutor'
			/*return view('UsersViews.docente.asistencia.materia', compact(
				'courses', 'materia', 'course', 'schedules', 'students', 'day', 'esUnaColeccion', 'asistencia',
				'count', 'countStudents', 'horaInicio', 'horaFin', 'diasDeLaSemana', 'colSpan', 'fecha1', 'perfil'*/

			));

		} catch (Exception $e) {
			return Redirect::back()->withErrors(['login_fail' => $e->getMessage()]);
		}
	}
	public function materiaCrear(Course $course, Matter $materia) {
		$newStudent = null;
		$courses = Course::getAllCourses();
		/*$students = DB::table('students2')
			->join('students2_profile_per_year as EP', 'students2.id', '=', 'EP.idStudent')
			->join('asistencia', 'EP.id', '=', 'asistencia.idEstudiante')
			->join('matters', 'asistencia.idMateria', '=', 'matters.id')
			->join('courses', 'EP.idCurso', '=', 'courses.id')
			->where('asistencia.fecha', request('fecha'))
			->where('asistencia.idCurso', $course->id)
			->where('asistencia.idMateria', $materia->id)
			->where('asistencia.idSchedule', request('schedule'))
			->where('EP.tipo_matricula', '!=', 'Pre Matricula')
			->select('EP.id', 'students2.apellidos', 'students2.nombres', 'asistencia.estado', 'asistencia.observacion',
					'asistencia.id as asistenciaId')
            ->get();*/
		$students = Student2::getStudentsByCourseAsistenciaNew($course->id,request('fecha'),request('schedule'));
		//dd($students);
		/**
		 * Determinar si exites nuevo estudiante
		 */
		$studentsAll = Student2Profile::where('students2_profile_per_year.idCurso', $course->id)
        ->join('students2', 'students2_profile_per_year.idStudent', '=', 'students2.id')
        ->select('students2.id as idStudent')
        ->where('students2_profile_per_year.tipo_matricula', '!=', 'Pre Matricula')
        ->where('students2_profile_per_year.idPeriodo', Sentinel::getUser()->idPeriodoLectivo)
        ->where('students2_profile_per_year.retirado', 'NO')
        ->get()->pluck('idStudent');
		//dd($studentsAll,$students);
		if(count($studentsAll)>count($students)){
			$newStudent = array_diff($studentsAll->toArray(),$students->pluck('id')->toArray());
			//dd($newStudent);
		}
		$day = Carbon::createFromFormat('Y-m-d', request('fecha'))->dayOfWeek;
		if($day == 0){
			$day = 7;
		}
		$schedules = $course->schedules()->where('dia'.$day, $materia->id)->get();
	
		$fecha = request('fecha');
		$asistencia = DailyAssistance::query()
			->where('idCurso', $course->id)
			->where('idMateria', $materia->id)
			->where('fecha', request('fecha'))
			//->where('idEstudiante', $students->pluck('id'))
			->whereIn('idSchedule', $schedules->where('id',request('schedule'))->pluck('id'))
			//->groupBy('idSchedule')
			->get();
		//dd($schedules,$asistencia,$schedules,$students,$schedules->where('id',request('schedule'))->pluck('id'));
		if ($asistencia->isEmpty()) {
			$esUnaColeccion = true;
		} else {
			$esUnaColeccion = false;
		}
		return view('UsersViews.docente.asistencia.materia-crear', compact(
			'materia', 'schedules', 'day', 'esUnaColeccion', 'course', 'students',
			'courses', 'asistencia','fecha', 'newStudent'
		));
	}

	public function upDateListStudents(Course $course, Matter $materia, Request $request){
		$this->postAsistencia($course,$materia,$request);
		return redirect()->route('docente.asistenciaMateria.materia', [$course->id, $materia->id, 'fecha='.request('fecha')]);
	}

	public function editarMateria(Course $course, Matter $materia) {
		try {
			if (request('fecha') == null || strlen(request('fecha')) != 10)
				throw new Exception("Lo sentimos, hubo un error", 404);
			$courses = Course::getAllCourses();
			$day = Carbon::now()->dayOfWeek;
			$schedules = $course->schedules()->where('dia'.$day, $materia->id)->get();
			$students = DB::table('students2')
			->join('asistencia', 'students2.id', '=', 'asistencia.idEstudiante')
			->join('matters', 'asistencia.idMateria', '=', 'matters.id')
			->join('courses', 'students2.idCurso', '=', 'courses.id')
			->select('students2.id', 'students2.apellidos', 'students2.nombres', 'asistencia.estado', 'asistencia.observacion',
				'asistencia.id as asistenciaId')
			->get();
			return view('UsersViews.docente.asistencia.materia-editar', compact(
				'courses', 'materia', 'course', 'schedules', 'students'));
		} catch (Exception $e) {
			return Redirect::back()->withErrors(['login_fail' => $e->getMessage()]);
		}
	}

	public function postAsistencia(Course $course, Matter $materia, Request $request) {
		try {
            $students = DB::table('students2')
			->join('students2_profile_per_year', 'students2.id', '=', 'students2_profile_per_year.idStudent')
			->join('asistencia', 'students2.id', '=', 'asistencia.idEstudiante')
			->join('matters', 'asistencia.idMateria', '=', 'matters.id')
			->join('courses', 'students2.idCurso', '=', 'courses.id')
			->where('asistencia.fecha', request('fecha'))
			->where('asistencia.idCurso', $course->id)
			->where('asistencia.idMateria', $materia->id)
			->where('asistencia.idSchedule', request('schedule'))
			->select('students2.id', 'students2.apellidos', 'students2.nombres', 'asistencia.estado', 'asistencia.observacion',
					'asistencia.id as asistenciaId')
			->get();
			$flagSTUDENTSNEW = true;
			$studentsTEMP = Student2::getStudentsByCourseAsistenciaNew($course->id,request('fecha'),request('schedule'));
			/**
			 * Determinar si exites nuevo estudiante
			 */
			$studentsAllTEMP = Student2Profile::where('students2_profile_per_year.idCurso', $course->id)
			->join('students2', 'students2_profile_per_year.idStudent', '=', 'students2.id')
			->select('students2.id as idStudent')
			->where('students2_profile_per_year.tipo_matricula', '!=', 'Pre Matricula')
			->where('students2_profile_per_year.idPeriodo', Sentinel::getUser()->idPeriodoLectivo)
			->where('students2_profile_per_year.retirado', 'NO')
			->get()->pluck('idStudent');
			//dd($studentsTEMP,$studentsAllTEMP);
			if(count($studentsAllTEMP)>count($studentsTEMP)){
				$flagSTUDENTSNEW=false;
			}
			if ($students->isNotEmpty() && $flagSTUDENTSNEW) {
				throw new Exception("Lo sentimos, alguien más acabo de crear esta asistencia");
            }
			foreach ($request->idStudents as $key => $value) {
				DailyAssistance::create([
					'idCurso' => $course->id,
					'idMateria' => $materia->id,
					'idPeriodo' => $this->idPeriodoUser(),
					'idEstudiante' => $value,
					'idSchedule' => request('schedule'),
					'fecha' => $request->fecha,
					'estado' => $request->estado[$key],
					'observacion' => $request->observacion[$key]
				]);
			}

			return redirect()->route('docente.asistenciaMateria.materia', [$course->id, $materia->id, 'fecha='.request('fecha')]);

		} catch (Exception $e) {
			//dd($e->getMessage());
			return Redirect::back()->withErrors(['error' => $e->getMessage()]);
		}
	}

	public function updateAsistencia(Course $course, Matter $materia, Request $request) {
		foreach ($request->asistenciaId as $key => $value) {
			$asistencia = DailyAssistance::find($value);
			$asistencia->estado = $request->estado[$key];
			$asistencia->observacion = $request->observacion[$key];
			$asistencia->save();
		}
		return redirect()->route('docente.asistenciaMateria.materia', [$course->id, $materia->id, 'fecha='.request('fecha')]);
	}
}
