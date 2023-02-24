<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Sentinel;
use App\Transporte;
use App\Course;
use App\Administrative;
use App\Student2;
use App\Student2Profile;
use App\Institution;
use Carbon\Carbon;
use App\Parents;
use App\Fechas;
use PDF;
use App\PeriodoLectivo;

class transporteController extends Controller
{
    public function home() {
		$unidades = Transporte::getAllBuses();
		$unidadesPrivadas = Transporte::where('es_privado', 1)
			->orderBy('ruta')
			->where('idPeriodo', Sentinel::getUser()->idPeriodoLectivo)
			->get();
		return view('UsersViews.administrador.transporte.index', compact(
			'unidades', 'unidadesPrivadas'
		));
	}
	
	public function unidad($transporte) {
		$estudiantes = Student2::where('transporte_id', $transporte)->get();
		$transporte = Transporte::find($transporte);
		$courses = Course::getAllCourses();
		return view('UsersViews.administrador.transporte.ver',compact(
			'transporte', 'courses', 'estudiantes'
		));
	}

	public function crearTransporte() {
		$transporte = new Transporte;
		return view('UsersViews.administrador.transporte.crear-ruta', compact(
			'transporte'
		));
	}

	public function store(Request $request) {
		try {
			$this->validate($request, [
				'unidad' => 'nullable|numeric',
				'placa' => 'required',
				'ruta' => 'nullable',
				'rutaDetalle' => 'nullable',
				'chofer' => 'required',
				'celular' => 'required',
			]);
			$data = new Transporte;
			if ($request->es_privado !== 'on') {
				$data->unidad = $request->unidad;
				$data->ruta = $request->ruta;
				$data->rutaDetalle = $request->rutaDetalle;
			}
			$data->placa = $request->placa;
			$data->es_privado = $request->es_privado == 'on' ? 1 : 0;
			$data->idPeriodo = $this->idPeriodoUser();
			$data->chofer = $request->chofer;
			$data->celular = $request->celular;
			$data->correo = $request->correo;
			$data->save();

			return redirect()->route('transporte');
		} catch (Exception $e) {
			return Redirect::back()->withErrors(['Error' => 'Error en el registro: '.$e->getMessage()]);
		}
	}

	public function editarTransporte($id, Request $request) {
		$transporte = Transporte::find($id);
		return view('UsersViews.administrador.transporte.editar-ruta', compact(
			'transporte'
		));
		
	}

	public function updateTransporte(Request $request, $id) {
        $transporte = Transporte::findOrFail($id);
        $transporte->unidad = $request->unidad;
        $transporte->ruta = $request->ruta;
        $transporte->rutaDetalle = $request->rutaDetalle;
		if ($request->es_privado == 'on') {
			$transporte->unidad = null;
			$transporte->ruta = null;
			$transporte->rutaDetalle = null;
        }
        $transporte->es_privado = $request->es_privado == 'on' ? 1 : 0;
		$transporte->placa = $request->placa;
		$transporte->chofer = $request->chofer;
		$transporte->celular = $request->celular;
		$transporte->correo = $request->correo;
		$transporte->save();

		return redirect()->route('transporte');
	}

	public function destroy($id) {
		$transporte = Transporte::find($id);
		$transporte->delete();
		return redirect()->route('transporte');
	}

	public function reporte($id) {
		$estudiantes = Student2Profile::join('students2', 'students2_profile_per_year.idStudent', '=', 'students2.id')
			->where('students2_profile_per_year.tipo_matricula', '!=', 'Pre Matricula')
			->where('students2_profile_per_year.retirado', 'NO')
			->where('students2_profile_per_year.idPeriodo', $this->idPeriodoUser())
			->where('students2_profile_per_year.transporte_id', $id)
            ->select('students2_profile_per_year.id','students2.apellidos', 'students2.nombres', 'students2_profile_per_year.idCurso',
                'students2.idPadre','students2.idMadre','students2.direccion','students2.bloqueado','students2_profile_per_year.idPeriodo', 
                'students2_profile_per_year.idRepresentante', 'students2_profile_per_year.idStudent', 
                'students2_profile_per_year.numero_matriculacion')
			->orderBy('students2_profile_per_year.numero_matriculacion')
			->get();
	
		$institution = Institution::first();
		$periodo = PeriodoLectivo::getPeriodo($this->idPeriodoUser());
		$unidad = Transporte::find($id);
		$users = Administrative::all();
		$padres = Parents::whereParentezco('Padre')->orderBy('apellidos', 'ASC')->get();
		$madres = Parents::whereParentezco('Madre')->orderBy('apellidos', 'ASC')->get();
		$now = Carbon::now();
		$fecha = Fechas::fechaActual($now);
		$pdf = PDF::loadView('pdf.transporte.transporte', compact(
			'unidad', 'institution', 'fecha', 'estudiantes', 'users',
			'padres', 'madres', 'periodo'
		))->setOrientation('landscape');

		return $pdf->download("Reporte Transporte.pdf");
	}
}
