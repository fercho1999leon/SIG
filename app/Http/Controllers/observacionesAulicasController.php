<?php

namespace App\Http\Controllers;

use App\Matter;
use App\ObservacionesAulicas;
use App\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class observacionesAulicasController extends Controller
{
    public function index() {
		$docentes = DB::table('users_profile')
		->join('users', 'users_profile.userid', '=', 'users.id')
		->leftJoin('observaciones_aulicas', 'users.id', '=', 'observaciones_aulicas.idDocente')
		->leftJoin('courses', 'users.id', '=', 'courses.idProfesor')
		->select('users_profile.id', 'users_profile.userid', 'users_profile.apellidos', 'users_profile.nombres', 'observaciones_aulicas.status', 'courses.grado',
		'courses.especializacion', 'courses.paralelo', 'observaciones_aulicas.id AS observacionId')
		->where('cargo', 'Docente')
		->orderBy('users_profile.apellidos', 'ASC')
		->get();

		return view('UsersViews.administrador.observacionesAulicas.index', compact(
			'docentes'
		));
	}

    public function create(User $docente) {
		$materias = Matter::where('idDocente', $docente->userid)->get();
		return view('UsersViews.administrador.observacionesAulicas.generar', compact(
			'docente', 'materias'
		));
	}

    public function edit(User $docente) {
		try {
			$docente = DB::table('users_profile')
			->join('users', 'users_profile.userid', '=', 'users.id')
			->leftJoin('observaciones_aulicas', 'users.id', '=', 'observaciones_aulicas.idDocente')
			->leftJoin('courses', 'users.id', '=', 'courses.idProfesor')
			->select('users_profile.id', 'users_profile.userid', 'users_profile.apellidos', 'users_profile.nombres', 'observaciones_aulicas.status', 'courses.grado',
			'observaciones_aulicas.id AS observacionId', 'observaciones_aulicas.*')
			->where('cargo', 'Docente')
			->where('users_profile.id', $docente->id)
			->orderBy('users_profile.apellidos', 'ASC')
			->first();
			
			if ($docente->status == 1) {
				throw new Exception('Este usuario no puede volver a editarse, comunicarse con soporte.');
			}
			
			$materias = Matter::where('idDocente', $docente->userid)->get();
			return view('UsersViews.administrador.observacionesAulicas.edit', compact(
				'docente', 'materias'
			));
		} catch (\Exception $e) {
			return Redirect::back()->withErrors([$e->getMessage()]);
		}
	}

    public function show(User $docente) {
		try {
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

			$materias = Matter::where('idDocente', $docente->userid)->get();
			return view('UsersViews.administrador.observacionesAulicas.show', compact(
				'docente', 'materias'
			));
		} catch (\Exception $e) {
			return Redirect::back()->withErrors([$e->getMessage()]);
		}
	}

	public function store(Request $request, User $docente) {
		ObservacionesAulicas::create([
			'fecha' => $request->fecha,
			'hora_inicio' => $request->hora_inicio,
			'hora_fin' => $request->hora_fin,
			'idAsignatura' => $request->asignatura,
			'grado' => $request->grado,
			'tema' => $request->tema,
			'objetivo' => $request->objetivo,
			'observaciones' => $request->observaciones,
			'recomendaciones' => $request->recomendaciones,
			'idInstitucion' => 1,
			'idArchivo' => 1,
			'idDocente' => $docente->userid,
			'idUsuario' => session('user_data')->userid,
			'status' => $request->status == 'true' ? 1 : 0,
		]);
		
		return Redirect()->route('aulicas.index');
	}

	public function update(Request $request, User $docente) {
		$observacion = ObservacionesAulicas::find($request->observacionId);
		$observacion->fecha = $request->fecha;
		$observacion->hora_inicio = $request->hora_inicio;
		$observacion->hora_fin = $request->hora_fin;
		$observacion->idAsignatura = $request->asignatura;
		$observacion->grado = $request->grado;
		$observacion->tema = $request->tema;
		$observacion->objetivo = $request->objetivo;
		$observacion->observaciones = $request->observaciones;
		$observacion->recomendaciones = $request->recomendaciones;
		$observacion->idDocente = $docente->userid;
		$observacion->idUsuario = session('user_data')->userid;
		$observacion->status = $request->status == 'true' ? 1 : 0;
		$observacion->save();

		if ($observacion->status == 1) {
			return Redirect()->route('aulicas.index');
		}
		return back();
	}
}
