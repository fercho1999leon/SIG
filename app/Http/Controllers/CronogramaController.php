<?php

namespace App\Http\Controllers;

use App\Cronograma;

use Illuminate\Http\Request;
use App\Http\Requests\CronogramaRequest;
use App\Http\Requests\CronogramaUpdateRequest;
use App\Course;
use App\Usuario;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use App\Http\Controllers\BibliotecaReportController;
class CronogramaController extends Controller
{
	// Estudiante
	public function estudianteIndex() {

		if(session('horaInicio') != null && session('user') != null){
			$sessionHora = new BibliotecaReportController;
			$sessionHora->sessionHora();
		  }
		$user = Sentinel::getUser();
		$student = Usuario::find($user->id);
		$roles = [
			'institucion', 'representante'
		];
		$cronogramas = Cronograma::getAllSchedule();
		return view('UsersViews.representante.cronograma.index', compact(
			'roles', 'cronogramas', 'student'
		));
	}
	// Representante
	public function representanteIndex() {
		$roles = [
			'institucion','representante'
		];
		$cronogramas = Cronograma::getAllSchedule();
		return view('UsersViews.representante.cronograma.index', compact(
			'roles', 'cronogramas'
		));
	}
	
	// Docentes
	public function docenteIndex() {
		$courses = Course::getAllCourses();
		$roles = [
			'institucion','docente'
		];
		$cronogramas = Cronograma::getAllSchedule();
		return view('UsersViews.docente.cronograma.index', compact(
			'roles', 'cronogramas', 'courses'
		));
	}
	// admin
	public function adminIndex() {
		$roles = [
			'institucion', 'institucion_interna',
			'docente'
		];
		$cronogramas = Cronograma::getAllSchedule();
		return view('UsersViews.administrador.cronograma.index', compact(
			'cronogramas', 'roles'
		));
	}

	// Configuraciones -> Cronograma
	public function configuraciones_index() {
		$roles = [
			'institucion', 'institucion_interna',
			'docente', 'representante'
		];
	$cronogramas = Cronograma::getAllSchedule();
		return view('UsersViews.administrador.configuraciones.cronograma.index', compact(
			'cronogramas', 'roles'
		));
	}

	public function configuraciones_store(CronogramaRequest $request) {
		$data = request()->all();
		$nombreAdjunto = request()->archivoCronograma->getClientOriginalName();
		$nombreAdjunto = request()->archivoCronograma->storeAs('public/adjuntos', $nombreAdjunto);
		Cronograma::create([
			'titulo' => $data['titulo'],
			'adjunto' => $nombreAdjunto,
			'idPeriodo' => $this->idPeriodoUser(),
			'parcial' => $data['parcial'],
			'rol' => $data['rol']
		]);

		return redirect()->route('configuracion_cronograma');
	}

	public function configuraciones_update(Cronograma $cronograma, CronogramaUpdateRequest $request) {
		$data = $request->all();
		if ($request->hasFile('archivoCronograma')) {
			$nombreAdjunto = request()->archivoCronograma->getClientOriginalName();
			$nombreAdjunto = request()->archivoCronograma->storeAs('public/adjuntos', $nombreAdjunto);
			$cronograma->adjunto = $nombreAdjunto;
		}
		$cronograma->update($data);

		return redirect()->route('configuracion_cronograma');
	}

	public function configuraciones_destroy(Cronograma $cronograma) {
		
		$cronograma->delete();
		return redirect()->route('configuracion_cronograma');
	}
}
