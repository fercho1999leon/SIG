<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Sentinel;
use App\Institution;
use Illuminate\Support\Facades\DB;
use Activation;
use App\User;
use Mail;
use Illuminate\Database\QueryException;
use PDOException;
use App\Administrative;
use App\Cliente;
use App\Parents;
use Exception;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{

    public function register_index(Request $request){
		$data = new Administrative;
		$this->validate($request,[
			'tipo_usuario' => 'required|in:Docente,Administrador,Representante',
		]);
        return view('UsersViews.administrador.fichasPersonales.'.$request->tipo_usuario.'.crear', compact('data'));
    }

    public function postRegister(Request $request) {
		DB::beginTransaction();
		//dd($request);
		$this->validate($request,[
			'ci' => 'required|string|max:14|unique:users_profile,ci',
			'nombres' => 'required|string|between:2,30',
			'apellidos' =>  'required|string|between:2,30',
			'sexo' => 'required|in:1,2',
			'fNacimiento' => 'required|date',
			'correo' => 'email|required|unique:users,email',
			'movil' => 'string|max:10|nullable',
			'bio' => 'string|between:3,300|nullable',
			'dDomicilio' => 'string|between:3,200|nullable',
			'tDomicilio' => 'string|max:10|nullable',
			'cargo' => 'string|nullable',
			'tipo_usuario' => 'required|in:Administrador,Docente,Representante',
		]);

		$user_sentinel = ['email' => $request->correo,'password' => $request->ci];
		$user= Sentinel::registerAndActivate($user_sentinel);
		//registra el rol de los usuarios
		$role= Sentinel::findRoleByName($request->tipo_usuario);
		$role->users()->attach($user);
		$user->idPeriodoLectivo = $this->idPeriodoUser();
		$user->save();
		$path = null;
		if ($request->hasFile('image')) {
			$path = Storage::disk('public')->putFile('avatars', $request->image,'public');
		}
		$institution =Institution::first();
		//dd($institution->nombre);
		$request->merge([
			'nombreUnidadAcademica' => $institution->nombre,
		]);
		if($request->discapacidad == 2){
			$request->merge([
				'porcentaje_discapacidad' => "NA",
				'numCarnetDiscapacidad' => "NA",
				'tipoDiscapacidad' => "7",
				'tipoEnfermedadCatastrofica' => "6",
			]);
		}
		if($request->estaEnPeriodoSabatico == 2){
			$request->merge([
				'fechaInicioPeriodoSabatico' => "NA",
			]);
		}
		if($request->estaCursandoEstudiosId == 8){
			$request->merge([
				'institucionDondeCursaEstudios' => "NA",
				'paisEstudiosId' => "NA",
				'tituloAObtener' => "NA",
				'poseeBecaId' => "3",
				'tipoBecaId' => "3",
				'montoBeca' => "NA",
				'financiamientoBecaId' => "5",
			]);
		}
		//dd($request);
		Administrative::create([
			'ci'	=>	$request->ci,
			'nombres'	=>	$request->nombres,
			'apellidos'	=>	$request->apellidos,
			'sexo'	=>		$request->sexo,
			'fNacimiento'	=>	$request->fNacimiento,
			'correo'	=>	$request->correo,
			'movil'	=>	$request->movil,
			'bio'	=>	$request->bio,
			'dDomicilio'	=>	$request->direccionDomiciliaria,
			'tDomicilio'	=>	$request->numDomicilio,
			'cargo'	=>	$request->tipo_usuario,
			'userid'   =>  $user->id,
			'es_representante'   =>  $request->es_representante == 'true' ? 1 : 0,
			'created_at'	=>	date("Y-m-d H:i:s"),
			'url_imagen' => $path,
			'profesion' => $request->profesion,
			'lugar_trabajo' => $request->lugar_trabajo,
			'ex_alumno' => $request->ex_alumno == 'Si' ? 1 : 0,
			'telefono_trabajo' => $request->telefono_trabajo,
			'fecha_promocion' => $request->fecha_promocion,
			'fecha_ingreso' => $request->fecha_ingreso,
			'fecha_estado_migratorio' => $request->fecha_estado_migratorio,
			'fecha_exp_pasaporte' => $request->fecha_exp_pasaporte,
			'fecha_caducidad_pasaporte' => $request->fecha_caducidad_pasaporte,
			'nacionalidad' => $request->nacionalidad,
			'tipoDocumentoId' => $request->tipoDocumentoId,
			'genero' => $request->genero,
			'estadocivilId' => $request->estadocivilId,
			'etniaId' => $request->etniaId,
			
			'pueblo_nacionalidadId' => $request->pueblo_nacionalidadId,
			'provinciaSufragio' => $request->provinciaSufragio,
			'discapacidad' => $request->discapacidad,
			'tipoDiscapacidad' => $request->tipoDiscapacidad,
			'porcentajeDiscapacidad' => $request->porcentajeDiscapacidad,
			'numCarnetDiscapacidad' => $request->numCarnetDiscapacidad,
			'tipoEnfermedadCatastrofica' => $request->tipoEnfermedadCatastrofica,
			'paisNacionalidadId' => $request->paisNacionalidadId,
			'nivelFormacion' => $request->nivelFormacion,
			'fechaIngresoIES' => $request->fechaIngresoIES,
			'fechaSalidaIES' => $request->fechaSalidaIES,
			'relacionLaboralIESId' => $request->relacionLaboralIESId,
			'ingresoConConcursoMeritos' => $request->ingresoConConcursoMeritos,
			'escalafonDocenteId' => $request->escalafonDocenteId,
			'cargoDirectivoId' => $request->cargoDirectivoId,
			'tiempoDedicacionId' => $request->tiempoDedicacionId,
			'salarioMensual' => $request->salarioMensual,
			'docenciaTecnicoSuperior' => $request->docenciaTecnicoSuperior,
			'docenciaTecnologico' => $request->docenciaTecnologico,
			'estaEnPeriodoSabatico' => $request->estaEnPeriodoSabatico,
			'estaCursandoEstudiosId' => $request->estaCursandoEstudiosId,
			'fechaInicioPeriodoSabatico' => $request->fechaInicioPeriodoSabatico,
			'institucionDondeCursaEstudios' => $request->institucionDondeCursaEstudios,
			'paisEstudiosId' => $request->paisEstudiosId,
			'tituloAObtener' => $request->tituloAObtener,
			'poseeBecaId' => $request->poseeBecaId,
			'tipoBecaId' => $request->tipoBecaId,
			'montoBeca' => $request->montoBeca,
			'financiamientoBecaId' => $request->financiamientoBecaId,
			'nombreUnidadAcademica' => $request->nombreUnidadAcademica,
			'nroasignaturasdocente' => $request->nroasignaturasdocente,
			'nroHorasLaborablesSemanaEnCarreraPrograma' => $request->nroHorasLaborablesSemanaEnCarreraPrograma,
			'nroHorasClaseSemanaCarreraPrograma' => $request->nroHorasClaseSemanaCarreraPrograma,
			'nroHorasInvestigacionSemanaCarreraPrograma' => $request->nroHorasInvestigacionSemanaCarreraPrograma,
			'nroHorasAdministrativasSemanaCarreraPrograma' => $request->nroHorasAdministrativasSemanaCarreraPrograma,
			'nroHorasOtrasActividadesSemanaCarreraPrograma' => $request->nroHorasOtrasActividadesSemanaCarreraPrograma,
			'nroHorasVinculacionSociedad' => $request->nroHorasVinculacionSociedad,
			'pubRevistasCienInIndexadasId' => $request->pubRevistasCienInIndexadasId,
			'numPubRevistasCientifIndexadas' => $request->numPubRevistasCientifIndexadas,
			

		]);
		//$usuario = Administrative::latest()->first();
		//dd($usuario);
		if ($request->crearCliente != null) {
			$validator = Validator::make($request->all(), [
				'ci' => 'required|unique:clientes,cedula_ruc'
			], ['ci.unique' => 'Lo sentimos, el número de cédula ya se encuentra registrado en clientes.']);
			if ($validator->fails()) {
				DB::rollback();
				return back()
					->withErrors($validator)
					->withInput($request->all());
			}
			$this->creacionUsuarioCliente($request);
		}
		if ($request->crearPadre != null) {
			$validator = Validator::make($request->all(), [
				'ci' => 'required|unique:datospadres,ci'
			], ['ci.unique' => 'Lo sentimos, el número de cédula ya se encuentra registrado en padres.']);
			if ($validator->fails()) {
				DB::rollback();
				return back()
					->withErrors($validator)
					->withInput($request->all());
			}
			$this->creacionUsuarioPadre($request);
		}

		DB::commit();
		if($request->tipo_usuario == 'Administrador') {
			return redirect()->route('administrativos');
		} else if($request->tipo_usuario == 'Docente') {
			return redirect()->route('docentes');
		} else if($request->tipo_usuario == 'Representante') {
			return redirect()->route('representantes');
		}
	}

	public function show($id){
		return $id;
	}

    public function creacionUsuarioCliente($request) {
		DB::beginTransaction();
		Cliente::create([
			'cedula_ruc' => $request->ci,
			'nombres' => $request->nombres,
			'apellidos' => $request->apellidos,
			'correo' => $request->correo,
			'telefono' => $request->movil,
			'direccion' => $request->dDomicilio,
			'parentezco' => $request->parentezco_cliente,
			'idPeriodo' => $this->idPeriodoUser(),
			'fecha_nacimiento' => $request->fNacimiento,
			'telefono_domicilio' => $request->tDomicilio,
			'profesion' => $request->profesion,
			'lugar_trabajo' => $request->lugar_trabajo,
			'telefono_trabajo' => $request->telefono_trabajo,
			'nacionalidad' => $request->nacionalidad,
		]);
		DB::commit();
	}

    public function creacionUsuarioPadre($request) {
		DB::beginTransaction();
		Parents::create([
			'ci' => $request->ci,
			'nombres' => $request->nombres,
			'apellidos' => $request->apellidos,
			'sexo' => $request->sexo,
			'parentezco' => $request->parentezco_padre,
			'fNacimiento' => $request->fNacimiento,
			'estado_civil' => $request->estado_civil,
			'fallecido' => $request->fallecido == 'Si' ? 1 : 0,
			'correo' => $request->correo,
			'movil' => $request->movil,
			'bio' => $request->bio,
			'autorizadoRetirarEstudiante' => $request->autorizacion_retirar_estudiante == 'Si' ? 1 : 0,
			'religion' => $request->religion,
			'ciudadDomicilio' => $request->ciudadDomicilio,
			'direccionDomicilio' => $request->dDomicilio,
			'telefonoDomicilio' => $request->tDomicilio,
			'ciudadTrabajo' => $request->ciudadTrabajo,
			'direccionTrabajo' => $request->direccionTrabajo,
			'telefonoTrabajo' => $request->telefono_trabajo,
			'cargoTrabajo' => $request->cargoTrabajo,
			'lugarTrabajo' => $request->lugar_trabajo,
			'profesion' => $request->profesion,
			'ex_alumno' => $request->ex_alumno == 'Si' ? 1 : 0,
			'fecha_promocion' => $request->fecha_promocion,
			'fecha_ingreso_pais' => $request->fecha_ingreso,
			'fecha_expiracion_pasaporte' => $request->fecha_exp_pasaporte,
			'fecha_caducidad_pasaporte' => $request->fecha_exp_pasaporte,
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

}//end RegisterController

