<?php

namespace App\Http\Controllers;

use App\PersonasAutorizadas;
use App\Student2Profile;
use Illuminate\Http\Request;
use Sentinel;
use Illuminate\Support\Facades\DB;

class PersonasAutorizadasController extends Controller
{
    public function index() {
		$personasAutorizadas = PersonasAutorizadas::query()
			->where('idPeriodo', Sentinel::getUser()->idPeriodoLectivo)
			->search(request('search'))
			->paginate(20);
        return view('UsersViews.administrador.fichasPersonales.PersonasAutorizadas.index', compact(
			'personasAutorizadas'
		));
    }

    public function create() {
		$user = new PersonasAutorizadas;
		$students = Student2Profile::getAllStudents();
        return view('UsersViews.administrador.fichasPersonales.PersonasAutorizadas.create', compact(
			'students', 'user'
		));
    }

    public function store(Request $request) {
		$personaAutorizada = PersonasAutorizadas::create([
			'nombres' => $request->nombres,
			'telefono_domicilio' => $request->telefono_domicilio,
			'telefono_celular' => $request->telefono_celular,
			'direccion' => $request->direccion,
			'ciudad' => $request->ciudad,
			'idPeriodo' => $this->idPeriodoUser()
		]);

		$personaAutorizada->estudiantesAutorizados()->attach($request->students);

		return back();
    }

    public function show($id) {
		$user = PersonasAutorizadas::findOrFail($id);
        return view('UsersViews.administrador.fichasPersonales.PersonasAutorizadas.show', compact(
			'user'
		));
    }

    public function edit($id) {
		$students = Student2Profile::getAllStudents();
		$user = PersonasAutorizadas::findOrFail($id);
        return view('UsersViews.administrador.fichasPersonales.PersonasAutorizadas.edit', compact(
			'user', 'students'
		));
    }

    public function update(Request $request, $id) {
		$user = PersonasAutorizadas::findOrFail($id);
		$user->update([
			'nombres' => $request->nombres,
			'telefono_domicilio' => $request->telefono_domicilio,
			'telefono_celular' => $request->telefono_celular,
			'direccion' => $request->direccion,
			'ciudad' => $request->ciudad,
		]);
		$user->estudiantesAutorizados()->sync($request->students);

		return back();
    }

    public function destroy($id) {
		$user = PersonasAutorizadas::findOrFail($id);
		$user->delete();

		return back();
    }
}
