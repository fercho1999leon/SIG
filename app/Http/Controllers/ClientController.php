<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cliente;
use App\Parents;
use Exception;
use Sentinel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ClientController extends Controller
{
    public function index(){
		$clientes = Cliente::query()
			->orderBy('apellidos')
			->search(request('search'))
			->paginate(20);
        return view('UsersViews.administrador.fichasPersonales.Clientes.index', compact(
			'clientes'
		));
    }

    public function create() {
		$cliente = new Cliente;
        return view('UsersViews.administrador.fichasPersonales.Clientes.create', compact(
			'cliente'
		));
    }

    public function store(Request $request) {
		DB::beginTransaction();
		$this->validate($request, [
			'cedula_ruc' => 'required|unique:clientes,cedula_ruc',
		], ['cedula_ruc.unique' => 'Lo sentimos, ya existe esta cédula registrada.']);
		Cliente::create([
			'cedula_ruc' => $request->cedula_ruc,
			'nombres' => $request->nombres,
			'apellidos' => $request->apellidos,
			'correo' => $request->correo,
			'telefono' => $request->telefono,
			'direccion' => $request->direccion,
			'parentezco' => $request->parentezco,
			'idPeriodo' => $this->idPeriodoUser(),
			'fecha_nacimiento' => $request->fecha_nacimiento,
			'telefono_domicilio' => $request->telefono_domicilio,
			'profesion' => $request->profesion,
			'lugar_trabajo' => $request->lugar_trabajo,
			'telefono_trabajo' => $request->telefono_trabajo,
			'nacionalidad' => $request->nacionalidad,
		]);

		if ($request->crearRepresentante != null) {
			$validator = Validator::make($request->all(), [
				'cedula_ruc' => 'required|unique:users_profile,ci',
				'correo' => 'required|unique:users,email'
			], ['cedula_ruc.unique' => 'Lo sentimos, el número de cédula ya se encuentra registrado en perfil representante.',
				'correo.unique' => 'Lo sentimos, el correo ingresado ya se encuentra registrado en perfil representante.']);
			if ($validator->fails()) {
				DB::rollback();
				return back()
					->withErrors($validator)
					->withInput($request->all());
			}
			$this->crearUsuarioRepresentante($request);
		}
		if ($request->crearPadre != null) {
			$validator = Validator::make($request->all(), [
				'cedula_ruc' => 'required|unique:datospadres,ci',
				'fecha_nacimiento' => 'required'
			], ['cedula_ruc.unique' => 'Lo sentimos, el número de cédula ya se encuentra registrado en padres.',
				'fecha_nacimiento.required' => 'El campo fecha de nacimiento es requerida para crear el padre.']);
			if ($validator->fails()) {
				DB::rollback();
				return back()
					->withErrors($validator)
					->withInput($request->all());
			}
			$this->crearUsuarioPadre($request);
		}
		DB::commit();
		return back()->with('message', ['type'=> 'success', 'text' =>  "Se creo con exito el cliente." ]);
    }

    public function show($id) {
		$cliente = Cliente::findOrFail($id);
		return view('partials.cliente.modal-ver', compact(
			'cliente'
		));
	}
	
    public function edit($id) {
		$cliente = Cliente::findOrFail($id);
        return view('UsersViews.administrador.fichasPersonales.Clientes.edit', compact(
			'cliente'
		));
    }

    public function update(Request $request, $id) {
		$cliente = Cliente::findOrFail($id);
        $cliente->update([
			'cedula_ruc' => $request->cedula_ruc,
			'nombres' => $request->nombres,
			'apellidos' => $request->apellidos,
			'correo' => $request->correo,
			'telefono' => $request->telefono,
			'direccion' => $request->direccion,
			'parentezco' => $request->parentezco,
			'fecha_nacimiento' => $request->fecha_nacimiento,
			'telefono_domicilio' => $request->telefono_domicilio,
			'profesion' => $request->profesion,
			'lugar_trabajo' => $request->lugar_trabajo,
			'telefono_trabajo' => $request->telefono_trabajo,
			'nacionalidad' => $request->nacionalidad,
		]);

		return redirect()->route('clients.index')->with('message', ['type'=> 'success', 'text' =>  "Se actualizo con exito." ]);
    }

    public function destroy($id) {
		$cliente = Cliente::findOrFail($id);
		$cliente->delete();
		return back()->with('message', ['type'=> 'success', 'text' =>  "Se eliminó con exito." ]);
	}

	public function crearUsuarioRepresentante($request) {
		DB::beginTransaction();
		$user_sentinel = ['email' => $request->correo,'password' => $request->cedula_ruc];
		$user= Sentinel::registerAndActivate($user_sentinel);
		//registra el rol de los usuarios 
		$role= Sentinel::findRoleByName('Representante');
		$role->users()->attach($user);
		$user->idPeriodoLectivo = $this->idPeriodoUser();
		$user->save();
		$path = null;
		
		if ($request->hasFile('image')) {
			$path = Storage::disk('public')->putFile('avatars', $request->image,'public');
		}

		DB::table('users_profile')
			->insert([
				'ci'	=>	$request->cedula_ruc,
				'nombres'	=>	$request->nombres,
				'apellidos'	=>	$request->apellidos,
				'sexo'	=>		$request->sexo,
				'fNacimiento'	=>	$request->fecha_nacimiento,
				'correo'	=>	$request->correo,
				'movil'	=>	$request->telefono,
				'bio'	=>	$request->bio_representante,
				'dDomicilio'	=>	$request->direccion,
				'tDomicilio'	=>	$request->telefono_domicilio,
				'cargo'	=>	'Representante',
				'userid'   =>  $user->id,
				'es_representante'   =>  $request->es_representante == 'true' ? 1 : 0,
				'created_at'	=>	date("Y-m-d H:i:s"),
				'url_imagen' => $path,
				'profesion' => $request->profesion,
				'lugar_trabajo' => $request->lugar_trabajo,
				'ex_alumno' => $request->ex_alumno_representante == 'Si' ? 1 : 0,
				'telefono_trabajo' => $request->telefono_trabajo,
				'fecha_promocion' => $request->fecha_promocion_representante,
				'fecha_ingreso' => $request->fecha_ingreso_representante,
				'fecha_estado_migratorio' => $request->fecha_estado_migratorio,
				'fecha_exp_pasaporte' => $request->fecha_exp_pasaporte,
				'fecha_caducidad_pasaporte' => $request->fecha_caducidad_pasaporte_representante,
				'nacionalidad' => $request->nacionalidad,
			]);
			DB::commit();
	}

	public function crearUsuarioPadre($request) {
		DB::beginTransaction();
		Parents::create([
			'ci' => $request->cedula_ruc,
			'nombres' => $request->nombres,
			'apellidos' => $request->apellidos,
			'sexo' => $request->sexo,
			'parentezco' => $request->parentezco,
			'fNacimiento' => $request->fecha_nacimiento,
			'estado_civil' => $request->estado_civil,
			'fallecido' => $request->fallecido == 'Si' ? 1 : 0,
			'correo' => $request->correo,
			'movil' => $request->telefono,
			'bio' => $request->bio_padre,
			'autorizadoRetirarEstudiante' => $request->autorizacion_retirar_estudiante == 'Si' ? 1 : 0,
			'religion' => $request->religion,
			'ciudadDomicilio' => $request->ciudadDomicilio,
			'direccionDomicilio' => $request->direccion,
			'telefonoDomicilio' => $request->telefono_domicilio,
			'ciudadTrabajo' => $request->ciudadTrabajo,
			'direccionTrabajo' => $request->direccionTrabajo,
			'telefonoTrabajo' => $request->telefono_trabajo,
			'cargoTrabajo' => $request->cargoTrabajo,
			'lugarTrabajo' => $request->lugar_trabajo,
			'profesion' => $request->profesion,
			'ex_alumno' => $request->ex_alumno_padre == 'Si' ? 1 : 0,
			'fecha_promocion' => $request->fecha_promocion_padre,
			'fecha_ingreso_pais' => $request->fecha_ingreso_padre,
			'fecha_expiracion_pasaporte' => $request->fecha_expiracion_pasaporte,
			'fecha_caducidad_pasaporte' => $request->fecha_caducidad_pasaporte_padre,
			'nacionalidad' => $request->nacionalidad,
			'lugarNacimiento' => $request->lugar_nacimiento,
			'provincia' => $request->provincia,
			'canton' => $request->canton,
			'parroquia' => $request->parroquia,
			'estudios' => $request->estudios,
			'clinica' => $request->clinica,
			'indicaciones' => $request->indicaciones,
			'tipoSangre' => $request->tipo_sangre,
			'contactoEmergencia' => $request->contacto_emergencia,
			'telefonoEmergencia' => $request->telefono_emergencia,
			'observacionEmergencia' => $request->observacion_emergencia,
			'idPeriodo' => $this->idPeriodoUser(),
		]);
		DB::commit();
	}
	
}
