<?php

namespace App\Http\Controllers;

use App\Course;
use App\Matter;
use App\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class observacionesAulicasDocenteController extends Controller
{
    public function show(User $docente) {
		try {
			$courses = Course::getAllCourses();
			$docente = DB::table('users_profile')
			->join('users', 'users_profile.userid', '=', 'users.id')
			->leftJoin('observaciones_aulicas', 'users.id', '=', 'observaciones_aulicas.idDocente')
			->leftJoin('courses', 'users.id', '=', 'courses.idProfesor')
			->join('matters', 'observaciones_aulicas.idAsignatura', '=', 'matters.id')
			->select('users_profile.id', 'users_profile.userid', 'users_profile.apellidos', 'users_profile.nombres', 'observaciones_aulicas.status', 'courses.grado',
			'observaciones_aulicas.id AS observacionId', 'observaciones_aulicas.*', 'matters.nombre AS materia')
			->where('cargo', 'Docente')
			->where('users_profile.id', $docente->id)
			->orderBy('users_profile.apellidos', 'ASC')
			->first();
			if ($docente === null) 
				throw new Exception('No existe un registro aún');
				if ($docente->status === 0) 
					throw new Exception('El registro no está finalizado');
				
			$materias = Matter::where('idDocente', $docente->userid)->get();
			return view('UsersViews.docente.observacionesAulicas.show', compact(
				'docente', 'materias', 'courses'
			));
		} catch (\Exception $e) {
			return Redirect::back()->withErrors([$e->getMessage()]);
		}
	} 
}
