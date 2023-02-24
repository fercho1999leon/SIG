<?php

namespace App\Http\Controllers;

use App\ConfiguracionSistema;
use App\Course;
use App\DailyAssistance;
use App\Matter;
use App\Student2;
use App\Administrative;
use Exception;
use Carbon\Carbon;
use Sentinel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class AsistenciaDiariaController extends Controller {

	public function index() {		
		
		$regimen = ConfiguracionSistema::regimen();
		$id_carrera = \Session::get('idcarrera');
		$courses = Course::where('id_career', $id_carrera)->where('estado', 1)->groupBy('paralelo')->get();	
		$user = Sentinel::getUser();
		$coursesandmetters = DB::table('courses')
					->select('courses.id as idCourse', 'matters.id as idMatter')
					->join('matters', 'courses.id', '=', 'matters.idCurso')
					->where('id_career', $id_carrera)
					->where('courses.estado', 1)
					->where('matters.idDocente', $user->id)
					->groupBy('courses.paralelo')
					->get();
		//dd($coursesandmetters,$courses);
		$user_profile = Administrative::findBySentinelid($user->id);
		$primary = Course::where('grado', 'Primero')
            ->where('idPeriodo', Sentinel::getUser()->idPeriodoLectivo)
            ->get();
		return view('UsersViews.administrador.asistenciaDiaria.index', compact(
			'regimen', 'courses','user_profile','primary', 'coursesandmetters'
		));
	}

	public function matters(Course $course) {
		$perfil = session('user_data');
		if ($perfil->cargo == 'Docente') {
			$admin = false;
			$tutor = 'true';
			$fecha = Carbon::now()->format('Y-m-d');
			$day = Carbon::now()->dayOfWeek;
			$cursos = DB::table('courses')
				->join('matters', 'courses.id', '=', 'matters.idCurso')
				->where('matters.idCurso', $course->id)
				->where('matters.idDocente', $perfil->userid)
				->select('courses.id', 'matters.id as materiaId', 'courses.grado', 'courses.especializacion', 'courses.paralelo', 'matters.nombre as materia')
				->get();

		}else {
			$admin = true;
			$tutor = 'false';
			$fecha = Carbon::now()->format('Y-m-d');
			$day = Carbon::now()->dayOfWeek;
			$cursos = DB::table('courses')
				->join('matters', 'courses.id', '=', 'matters.idCurso')
				->where('matters.idCurso', $course->id)
				->select('courses.id', 'matters.id as materiaId', 'courses.grado', 'courses.especializacion', 'courses.paralelo', 'matters.nombre as materia')
				->get();
		}
	
		$courses = Course::getAllCourses();

		return view('UsersViews.docente.asistencia.index', compact(
			'cursos', 'courses', 'fecha', 'day', 'admin', 'tutor'
		));
	}
}
