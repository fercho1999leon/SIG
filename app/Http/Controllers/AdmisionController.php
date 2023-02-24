<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Student2;
use App\Parents;
use App\User;
use App\Student2Profile;
use App\Cliente;
use App\Administrative;
use App\Institution;
use App\ConfiguracionSistema;
use App\BecaDescuento;
use App\TipoBloqueo;
use App\Course;
use App\Payment;
use Sentinel;
Use DB;
use Mail;
use PDF;
use App\Mail\EnvioDocumentos;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\File;
use App\Http\Requests\StudentRequest;
use Carbon\Carbon;
use App\PeriodoLectivo;
use App\PagoEstudianteDetalle;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Response;

use App\Career;
use App\Semesters;
//use App\Course;
use App\careerStudents;


class AdmisionController extends Controller
{
    //
    public function index(Request $request){
    	$conf_ver_nuevo = ConfiguracionSistema::nuevoEstudianteAdmision();
    return view('UsersViews.admisiones.index');
	}
	public function actDatos(){
    return view('UsersViews.admisiones.actualizarDatos');
	}

	public function creacionPagos($idCurso, Student2 $student, $nextYear) {
		$pagos = Payment::where('idCurso', $idCurso)->get();
		foreach($pagos as $pago) {
			$pagoDetalle = new PagoEstudianteDetalle;
			$pagoDetalle->idPeriodo = $nextYear ?? $this->idPeriodoUser();
			$pagoDetalle->idEstudiante = $student->id;
			$pagoDetalle->estado = "PENDIENTE";
			$pago->pagoEstudianteDetalle()->save($pagoDetalle);
		}
	}
	public function searchStudents(Request $request){

			$students =  Student2::select('students2.id','students2.ci','students2.nombres', 'students2.apellidos', 'students2.idPadre', 'students2.idMadre', 'students2.idRepresentante','students2.bloqueado')
			->where('students2.ci',$request->search)
			->get();
			if($students->isNotEmpty()) {

				foreach ($students as $student) {
					if ($student['bloqueado']!='0') {
					return Redirect::back()->withErrors(['warning' => 'El estudiante se encuentra bloqueado. Por favor comuniquese con la institución en este caso']);
					}
				$padres = Parents::where('id',$student['idPadre'])->get();
				$madres = Parents::where('id',$student['idMadre'])->get();
				//return $madres;

			}
			if($padres=='') {
				$padres[]='';
			}
			if($madres=='') {
				$madres[]='';
			}
			$students = $students->first();
			//$periodo = PeriodoLectivo::where('nombre', '2020-2021')->first();
			$ModuloAdmisiones = ConfiguracionSistema::admisiones();
			$periodo = $ModuloAdmisiones->idPeriodo;
			//dd($periodo);
			//dd($ModuloAdmisiones->id);
			$dataProfile = Student2Profile::where('idStudent', $student['id'])
			->where('idPeriodo',$ModuloAdmisiones->idPeriodo)
			->first();
			if ($dataProfile==null) {
				return Redirect::back()->withErrors(['warning' => 'El estudiante no se encuentra en el Nuevo periodo, comuniquese con la institución.']);
			}
				$representantes = $dataProfile->representante;
				$clientes = $dataProfile->cliente;
			if ($dataProfile->actDesdeAdmisiones!=1) { // verifico si ya se actualizo anteriormente el estudiante desde el modulo de admisiones
				//return view('UsersViews.admisiones.registro', compact('students','padres','madres','representantes','clientes'));
				return view('UsersViews.admisiones.actualizarDatos', compact('students','padres','madres','representantes','clientes','periodo'));
				}else{
					return Redirect::back()->withErrors(['warning' => 'El estudiante ya fue actualizado. Por favor comuniquese con la institución en este caso']);
				}
			}else

		return Redirect::back()->withErrors(['warning' => 'El estudiante no fue encontrado en los registros. Por favor comuniquese con la institución en este caso']);

	}
	public function datos_estudiante(Request $request, $cedula){
		$students =  Student2::select('students2.id','students2.ci','students2.nombres', 'students2.apellidos', 'students2.idPadre', 'students2.idMadre', 'students2.idRepresentante','students2.bloqueado')
			->where('students2.ci',$cedula)
			->get();
			//dd($students);
			if($students->isNotEmpty()) {

				foreach ($students as $student) {
					if ($student['bloqueado']!='0') {
					return Redirect::back()->withErrors(['warning' => 'El estudiante se encuentra bloqueado. Por favor comuniquese con la institución en este caso']);
					}
				$padres = Parents::where('id',$student['idPadre'])->get();
				$madres = Parents::where('id',$student['idMadre'])->get();
				//return $madres;

			}
			if($padres=='') {
				$padres[]='';
			}
			if($madres=='') {
				$madres[]='';
			}
			//$periodo = PeriodoLectivo::where('nombre', '2020-2021')->first();
			$students = $students->first();
			//$periodo = PeriodoLectivo::where('nombre', '2020-2021')->first();
			$ModuloAdmisiones = ConfiguracionSistema::admisiones();
			//dd($students, $ModuloAdmisiones);
			$periodo = $ModuloAdmisiones->idPeriodo;
			//dd($periodo);
			$dataProfile = Student2Profile::where('idStudent', $student['id'])
			->where('idPeriodo',$ModuloAdmisiones->idPeriodo)
			->first();
			//dd($dataProfile);
			if ($dataProfile==null) {
				return Redirect::back()->withErrors(['warning' => 'El estudiante no se encuentra en el Nuevo periodo, comuniquese con la institución.']);
			}
				$representantes = $dataProfile->representante;
				$clientes = $dataProfile->cliente;
				//dd($dataProfile);

			if ($dataProfile->actDesdeAdmisiones!=1) { // verifico si ya se actualizo anteriormente el estudiante desde el modulo de admisiones
				//return view('UsersViews.admisiones.registro', compact('students','padres','madres','representantes','clientes'));
				//dd($dataProfile->actDesdeAdmisiones);
				return view('UsersViews.admisiones.actualizarDatos', compact('students','padres','madres','representantes','clientes','periodo'));
				}else{
					return Redirect::back()->withErrors(['warning' => 'El estudiante ya fue actualizado. Por favor comuniquese con la institución en este caso']);
				}
			}else

		return Redirect::back()->withErrors(['warning' => 'El estudiante no fue encontrado en los registros. Por favor comuniquese con la institución en este caso']);
	}
	public function ActualizarAdmision(Request $request) {
			$this->validate($request,[
			'estudiante' =>  'required|max:4',
		]);
			//dd($request);

			//$periodo = PeriodoLectivo::where('nombre', '2020-2021')->first();
			$ModuloAdmisiones = ConfiguracionSistema::admisiones();
			$dataProfile = Student2Profile::where('idStudent', $request->estudiante)
			->where('idPeriodo', $ModuloAdmisiones->idPeriodo)
			->first();
		DB::update('update students2 set idRepresentante = ? , idPadre = ?, idMadre = ? where id = ?', [$request->id_representante,$request->id_padre,$request->id_madre, $request->estudiante]);
		DB::update('update students2_profile_per_year set idCliente = ?, idRepresentante = ? where id = ?', [$request->id_financiero, $request->id_representante, $dataProfile->id]);


				$estudiante=Student2::findOrFail($request->estudiante);
				Session::flash('message', 'El estudiante ha sido actualizado.');
				//return redirect()->route('admision_datos', [$estudiante->ci]);
				return 'Estudiante Actualizado';



			//return ->with('message', ['type'=> 'success', 'text' =>  "Se actualizo con exito." ]);
		}
		public function representanteAdmision() {
        if ($search = \Request::get('q')) {
        	$id_est = \Request::get('estu');
        	$estudiante = Student2::findOrFail($id_est);
				$representante = User::query()
				->where('id',$search)
				->first();

                	return view('UsersViews.admisiones.modal-representante', compact('representante','estudiante'));
                }

		}
		public function clienteAdmision() {

        if ($search = \Request::get('q')) {
        	$estudiante = \Request::get('estu');
			$cliente = Cliente::findOrFail($search);
                	return view('UsersViews.admisiones.modal-cliente', compact('cliente','estudiante'));
                }

		}
		public function padresAdmision() {
        if ($search = \Request::get('q')) {
        	$estudiante = \Request::get('estu');
        	$parentezco =\Request::get('paren');
					$data = Parents::findOrFail($search);
				   	return view('UsersViews.admisiones.modal-padres', compact('data','estudiante','parentezco'));
                }

		}
		public function editRepresentanteAdmision() {
		if ($search = \Request::get('repre')) {
			$cedula = \Request::get('estu');
			$data =User::findOrFail($search);
			return view('UsersViews.admisiones.modal-edit-representante', compact('data','cedula'));
			}
		}
		public function representanteEdit(Administrative $representante,Request $request) {
			$this->validate($request,[
			'ci' =>  'required|string|max:14',
			'nombres'    =>  'required|string|between:2,30',
			'apellidos'    =>  'required|string|between:2,30',
			'sexo'  =>  'required|in:Femenino,Masculino',
			'fNacimiento' =>  'required|date',
			'correo'  =>  [
				'email', 'required',
				Rule::unique('users', 'email')->ignore($representante->user->id),
			],
			'movil' =>  'string|max:10|nullable',
			'bio' =>  'string||between:3,300|nullable',
			'dDomicilio'  =>  'string|between:3,200|nullable',
			'tDomicilio'  =>  'string|max:10|nullable',
			'cargo' =>  'string|nullable',
			'password'  =>  'string|min:3|max:20|nullable',
			'url_imagen' =>  'string|nullable',
			'es_representante' => 'nullable'
		  ]);

		if ($request->hasFile('image') ) {
			$path = Storage::disk('public')->putFile('avatars', $request->image,'public');
			$representante->url_imagen = $path;
			$representante->save();
		}
		$representante->update([
			'ci'	=>	$request->ci,
			'nombres'	=>	$request->nombres,
			'apellidos'	=>	$request->apellidos,
			'sexo'	=>		$request->sexo,
			'fNacimiento'	=>	$request->fNacimiento,
			'correo'	=>	$request->correo,
			'movil'	=>	$request->movil,
			'bio'	=>	$request->bio,
			'dDomicilio'	=>	$request->dDomicilio,
			'tDomicilio'	=>	$request->tDomicilio,
			'profesion' => $request->profesion,
			'lugar_trabajo' => $request->lugar_trabajo,
			'telefono_trabajo' => $request->telefono_trabajo,
			'ex_alumno' => $request->ex_alumno == 'Si' ? 1 : 0,
			'fecha_promocion' => $request->fecha_promocion,
			'fecha_ingreso' => $request->fecha_ingreso,
			'fecha_estado_migratorio' => $request->fecha_estado_migratorio,
			'fecha_exp_pasaporte' => $request->fecha_exp_pasaporte,
			'fecha_caducidad_pasaporte' => $request->fecha_caducidad_pasaporte,
			'nacionalidad' => $request->nacionalidad,
		]);



		//$periodo = PeriodoLectivo::where('nombre', '2020-2021')->first();
		$ModuloAdmisiones = ConfiguracionSistema::admisiones();
		$estudiante=Student2::findOrFail($request->id_estudiante);
		$dataProfile = Student2Profile::where('idStudent', $estudiante->id)
			->where('idPeriodo', $ModuloAdmisiones->idPeriodo)
			->first();
		//actualizo el representante de las tablas students2 y  students2_profile_per_year
			DB::update('update students2 set idRepresentante = ? where id = ?', [$representante->id,$request->id_estudiante]);
			DB::update('update students2_profile_per_year set idRepresentante = ? where id = ?', [$representante->id, $dataProfile->id]);

    Session::flash('message', 'El representante se actualizo exitosamente.');
		 return redirect()->route('admision_datos', [$estudiante->ci]);

	}
	public function representante($id, $estudiante) {
			$data =User::findOrFail($id);
			$estudiante = Student2::findOrFail($estudiante);
			return view('UsersViews.admisiones.EditarRepresentanteModal', compact('data','estudiante'));

	}
	public function cliente(Request $request, $id, $estudiante) {
			$cliente =Cliente::findOrFail($id);
			$estudiante = Student2::findOrFail($estudiante);
			//return view('UsersViews.admisiones.clientes', compact('cliente','estudiante'));
			return view('UsersViews.admisiones.EditarClientesModal', compact('cliente','estudiante'));

	}
	public function clienteupdate(Request $request) {
		$cliente = Cliente::findOrFail($request->id_cliente);
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
		//$periodo = PeriodoLectivo::where('nombre', '2020-2021')->first();
        //$ModuloAdmisiones = ConfiguracionSistema::admisiones();
		$estudiante=Student2::findOrFail($request->id_estudiante);
        $this->act_clien($cliente->id,$request->id_estudiante);
		Session::flash('message', 'El representante financiero se actualizo exitosamente.');
		 return redirect()->route('admision_datos', [$estudiante->ci]);

	}
		public function padres(Request $request, $id, $estudiante,$parentezco) {

			$padre =Parents::findOrFail($id);
			$estudiante = Student2::findOrFail($estudiante);
			//return view('UsersViews.admisiones.padres', compact('padre','estudiante','parentezco'));
			return view('UsersViews.admisiones.EditarPadresModal', compact('padre','estudiante','parentezco'));


	}
	public function padresupdate(Request $request) {
		$padre = Parents::findOrFail($request->id_padre);
		// General
        $padre->ci = $request->ci;
        $padre->nombres = $request->nombres;
        $padre->apellidos = $request->apellidos;
        $padre->sexo = $request->sexo;
        $padre->parentezco = $request->parentezco;
		$padre->fNacimiento = $request->fNacimiento;
		$padre->estado_civil = $request->estado_civil;
		$padre->fallecido = $request->fallecido == 'Si' ? 1 : 0;
        $padre->correo = $request->correo;
        $padre->movil = $request->movil;
		$padre->bio = $request->bio;
		$padre->autorizadoRetirarEstudiante = $request->autorizacion_retirar_estudiante == 'Si' ? 1 : 0;
		$padre->religion = $request->religion;
        //Domicilio
        $padre->ciudadDomicilio = $request->ciudadDomicilio;
        $padre->direccionDomicilio = $request->direccionDomicilio;
        $padre->telefonoDomicilio = $request->telefonoDomicilio;
        //Trabajo
        $padre->ciudadTrabajo = $request->ciudadTrabajo;
        $padre->direccionTrabajo = $request->direccionTrabajo;
        $padre->telefonoTrabajo = $request->telefonoTrabajo;
        $padre->cargoTrabajo = $request->cargoTrabajo;
		$padre->lugarTrabajo = $request->lugarTrabajo;
		$padre->profesion = $request->profesion;
        $padre->ex_alumno = $request->ex_alumno == 'Si' ? 1 : 0;
        $padre->fecha_promocion = $request->fecha_promocion;
        $padre->fecha_ingreso_pais = $request->fecha_ingreso_pais;
        $padre->fecha_expiracion_pasaporte = $request->fecha_expiracion_pasaporte;
        $padre->fecha_caducidad_pasaporte = $request->fecha_caducidad_pasaporte;
		// Nacionalidad
		$padre->nacionalidad = $request->nacionalidad;
		$padre->lugarNacimiento = $request->lugar_nacimiento;
		$padre->provincia = $request->provincia;
		$padre->canton = $request->canton;
		$padre->parroquia = $request->parroquia;
		// Instrucción
		$padre->estudios = $request->estudios;
		// Datos Médicos
		$padre->clinica = $request->clinica;
		$padre->indicaciones = $request->indicaciones;
		$padre->tipoSangre = $request->tipo_sangre;
		$padre->contactoEmergencia = $request->contacto_emergencia;
		$padre->telefonoEmergencia = $request->telefono_emergencia;
		$padre->observacionEmergencia = $request->observacion_emergencia;
		$padre->save();

        $search = $request->search;
		$students =  Student2::select('students2.id','students2.ci','students2.nombres', 'students2.apellidos', 'students2.idPadre', 'students2.idMadre', 'students2.idRepresentante','students2_profile_per_year.id as idrepre')
			->join('students2_profile_per_year', 'students2.id', '=', 'students2_profile_per_year.idStudent')
			->where('students2.ci',$search)
			->get();

				foreach ($students as $student) {
				//actualizo el padre de la tabla students2
				if ($request->t_padre=='M') {

				DB::update('update students2 set idMadre = ? where id = ?', [$request->id_padre, $student['id']]);
				$madres = Parents::where('id',$request->id_padre)->get();
				$padres = Parents::where('id',$student['idPadre'])->get();
				Session::flash('message', 'La Madre se actualizo exitosamente.');
				}elseif($request->t_padre=='P'){

				DB::update('update students2 set idPadre = ? where id = ?', [$request->id_padre, $student['id']]);
				$madres = Parents::where('id',$student['idMadre'])->get();
				$padres = Parents::where('id',$request->id_padre)->get();
				Session::flash('message', 'El Padre se actualizo exitosamente.');
				}
								//return $madres;
				$dataProfile = Student2Profile::findOrFail($student['idrepre']);
				$representantes = $dataProfile->representante;
				$clientes = $dataProfile->cliente;
			}
			if($padres=='') {
				$padres[]='';
			}
			if($madres=='') {
				$madres[]='';
			}


		return view('UsersViews.admisiones.registro', compact('students','padres','madres','representantes','clientes'));
	}
	public function edit_estudiante($id) {
			$ModuloAdmisiones = ConfiguracionSistema::admisiones();
			$periodo = $ModuloAdmisiones->idPeriodo;
			$institution = Institution::first();
			$data = Student2::findOrFail($id);
			$dataProfile = Student2Profile::where('idStudent', $id)->where('idPeriodo', $periodo)->first();
			$users = Administrative::orderBy('apellidos', 'ASC')->get();
			$padres = Parents::whereParentezco('Padre')->orderBy('apellidos', 'ASC')->get();
			$madres = Parents::whereParentezco('Madres')
			->orwhere('parentezco', 'LIKE', 'Madre')->orderBy('apellidos', 'ASC')->get();
			//$becas = BecaDescuento::all();
			$clients = Cliente::all();
			return view('UsersViews.admisiones.EditarEstudianteModal', compact('data','institution','dataProfile','users','padres','madres','clients'));


	}	public function update_estudiante(Request $request, $id) {
		//dd($request);
		$this->validate($request,[
			'ci' =>  'required|string|max:14',
			'nombres'    =>  'required|string|between:2,30',
			'apellidos'    =>  'required|string|between:2,30',
			'sexo'  =>  'required|in:Femenino,Masculino',
			'fechaNacimiento' =>  'required|date',
			'direccion' => 'required',
			'ciudad' => 'required',
			]);
		$data = Student2::findOrFail($id);
		$data->ci = $request->ci;
		$data->nombres = $request->nombres;
		$data->apellidos = $request->apellidos;
		$data->sexo = $request->sexo;
		$data->fechaNacimiento = $request->fechaNacimiento;
		$data->nacionalidad = $request->nacionalidad;
		$data->lugarNacimiento = $request->lugarNacimiento;
		$data->provincia = $request->provincia;
		$data->canton = $request->canton;
		$data->parroquia = $request->parroquia;
		$data->tipoSangre = $request->tipoSangre;
		$data->tipoVivienda = $request->tipoVivienda;
		$data->direccion = $request->direccion;
		$data->telefono = $request->telefono;
		$data->save();
		$ModuloAdmisiones = ConfiguracionSistema::admisiones();

		$data_perfil = Student2Profile::where('idStudent',$id)
			->where('idPeriodo', $ModuloAdmisiones->idPeriodo)
			->first();
		$data_perfil->actividad_artistica= $request->actividad_artistica;
		$data_perfil->disciplina_practica= $request->disciplina_practica;
		$data_perfil->ciudad_domicilio= $request->ciudad;
		$data_perfil->direccion_domicilio=$request->direccion;
		$data_perfil->telefono_movil=$request->celular_estudiante;
		$data_perfil->tipo_vivienda=$request->tipoVivienda;
		$data_perfil->con_quien_vive=$request->con_quien_vive;
		$data_perfil->nacionalidad=$request->nacionalidad;
		$data_perfil->hospital=$request->clinica;
		$data_perfil->ingreso_familiar=$request->ingreso_familiar;
		$data_perfil->discapacidad=$request->discapacidad;
		$data_perfil->numero_carnet=$request->numero_carnet;
		$data_perfil->inclusion=$request->inclusion;
		$data_perfil->alergias=$request->alergias;
		$data_perfil->enfermedad=$request->enfermedad;
		$data_perfil->fecha_caducidad_pasaporte=$request->fecha_caducidad_pasaporte;
		$data_perfil->fecha_expiracion_pasaporte=$request->fecha_expiracion_pasaporte;
		$data_perfil->fecha_ingreso_pais=$request->fecha_ingreso_pais;
		$data_perfil->estado_civil_padres=$request->estado_civil_padres;
		$data_perfil->se_va_solo= $request->se_va_solo !=null ? 1 : 0;
		$data_perfil->porcentaje_discapacidad=$request->porcentaje_discapacidad;
		//dd($data_perfil);
		$data_perfil->save();
	Session::flash('message', 'El estudiante ha sido actualizado.');
   // return redirect()->route('admision_datos', [$request->ci]);
    return 'Estudiante Actualizado';
    
	}
	public function nuevo_estudiante(){
		$ModuloAdmisiones = ConfiguracionSistema::admisiones();
		$institution = Institution::first();
		$courses = Course::where('idPeriodo', $ModuloAdmisiones->idPeriodo)->where('estado', 1)->get();
        $data = new Student2;
		$careers = Career::all()->where('estado','=','1');
        $movilizacion = array('PROPIA', 'EXPRESO');
        $tipo_vivienda = array('PROPIA', 'ALQUILADA');
        $dataProfile = new Student2Profile;
		
		//echo $ModuloAdmisiones->idPeriodo;
        $users = Administrative::orderBy('apellidos', 'ASC')->get();
        $padres = Parents::whereParentezco('Padre')->orderBy('apellidos', 'ASC')->get();
        $madres = Parents::whereParentezco('Madres')->orwhere('parentezco', 'LIKE', 'Madre')->orderBy('apellidos', 'ASC')->get();
        $clients = Cliente::all();
		$paises = DB::table('paises')->get();
        $provincias = DB::table('provincias')->get();
        $cantones = DB::table('cantones')->get();
		$pueblos_nacionalidades = DB::table('pueblos_nacionalidades')->get();
        //dd($ModuloAdmisiones,$careers,$dataProfile,$courses);
		return view('UsersViews.admisiones.nuevo_estudiante', compact('pueblos_nacionalidades','paises','provincias','cantones','tipo_vivienda','movilizacion', 'data','institution','dataProfile','users','padres','madres','courses','clients','careers'));
    }
    
	public function GetSemestreCarrera($id){
		//echo 'entra';
		//echo $id;
		echo json_encode(DB::table('Semesters')->where('estado','=','1')->where('career_id',$id)->get());
   }

	public function GetCursoSemestre($id){
	//echo 'entra';
	//echo 'entra';
		echo json_encode(DB::table('courses')->where('estado','=','1')->where('id_career',$id)->get());
	}


	public function crear_estudiante(Request $request) {  
		$existeEstudiante 	= false;
		$existePerfil 		= false;
		$existeEnPeriodo	= false;
		DB::beginTransaction();
			$ModuloAdmisiones = ConfiguracionSistema::admisiones();	
			//dd($ModuloAdmisiones);
			$paraleloId =  course::all()->where('id_career','=',$request->curso )
										->where('estado','=','1')
										->where('esprimersemestre','=', 1)
										->pluck('id')
										->first();
			$student = Student2::where('ci',$request->n_identificacion)->first();
			if($student != null)
			{	
				$existeEstudiante = true;				
				$data = $student;
				$existeEnPeriodo = Student2Profile::where('idPeriodo', $ModuloAdmisiones->idPeriodo)
								 		 ->where('idStudent', $student->id)->exists();
			}else{
				$data = new Student2();
				$data->ci = $request->n_identificacion;
				$data->identificacion = $request->ci;
				$data->nombres = mb_strtoupper($request->nombres,"UTF-8");
				$data->apellidos = mb_strtoupper($request->apellidos,"UTF-8");
				$data->sexo = $request->genero;
				$data->fechaNacimiento = $request->fechaNacimiento;
				$data->ciudad = mb_strtoupper($request->ciudad,"UTF-8");
				$data->direccion = mb_strtoupper($request->direccion,"UTF-8");
				$data->telefono = $request->celular_estudiante;
				$data->nacionalidad = $request->pais;
				$data->lugarNacimiento = $request->provincia_nacimiento;
				$data->institucionAnterior = mb_strtoupper($request->institucionAnterior,"UTF-8");
				$data->razonCambio = mb_strtoupper($request->razon_Cambio,"UTF-8");
				$data->observaciones = mb_strtoupper($request->observaciones,"UTF-8");
				$data->contactoEmergencia = $request->contactoEmergencia;
				$data->telefonoEmergencia = $request->telefonoEmergencia;
				$data->matricula = $request->matricula;
				$data->retirado = 'NO';
				$data->bloqueado = $request->bloqueado == null ? 0 : 1 ;
				$data->seccion = $request->seccion;
				$data->provincia = $request->provincia_nacimiento;
				$data->canton = $request->canton_nacimiento;
				$data->idCurso = $paraleloId;
				$data->fecha_matriculacion = $request->fecha_matriculacion;	
				$data->tipoColegioId = $request->tipoColegioId;
				$data->modalidadCarrera = $request->modalidadCarrera;
				$data->jornadaCarrera = $request->jornadaCarrera;
				$data->correoElectronico = $request->correoElectronico;
				$data->save();
			}
			
			if ($existeEnPeriodo) {
				return Redirect::back()->withErrors(['warning' => 'El numero de cédula ya esta registrado para otro estudiante']);
			}

		

			$dataProfile = Student2Profile::create([
				'fecha_matriculacion' => $request->fecha_matriculacion ?? Carbon::now()->format('Y-m-d'),
				'idCurso' => $paraleloId,
				
				'idPeriodo' => $ModuloAdmisiones->idPeriodo,
				'idStudent' => $data->id,
				'direccion_domicilio' => $request->direccion,
				'telefono_movil' => $request->celular_estudiante,
				'nacionalidad' => $request->pais,
				'Etnia_estudiante' => $request->Etnia_Estudiante,
				'pueblo_nacionalidad' => $request->pueblo_nacionalidad,
				'nombre_contacto_emergencia' => $request->contactoEmergencia,
				'movil_contacto_emergencia' => $request->telefonoEmergencia,
				'parentezco_contacto_emergencia' => $request->parentezco_contacto_emergencia,
				'nombre_contacto_emergencia2' => $request->contactoEmergencia2,
				'movil_contacto_emergencia2' => $request->telefonoEmergencia2,
				'parentezco_contacto_emergencia2' => $request->parentezco_contacto_emergencia2,
				'tipo_matricula' => $request->matricula,
				'retirado' => 'NO',			
				'fecha_expiracion_pasaporte' => $request->fecha_expiracion_pasaporte,
				'fecha_caducidad_pasaporte' => $request->fecha_caducidad_pasaporte,
				'fecha_ingreso_pais' => $request->fecha_ingreso_pais,
				'celular' => $request->celular_estudiante,
				'fecha_nacimiento' => $request ->fechaNacimiento,
				'provincia_residencia' => $request ->provincia_residencia,
				'pais_residencia' => $request ->pais_recidencia,
				'canton' => $request ->canton_recidencia,
				'provincia' => $request ->provincia_recidencia,
				'pais' => $request ->pais,	
				'provincia_residencia' =>$request->provincia_recidencia,
				'canton_residencia' => $request->canton_recidencia, 
				'ciudad_domicilio' => $request->ciudad, 
				'estado_civil' => $request ->Estado_Civil,
				'genero'  => $request ->genero,
				'sexo' => $request->sexo,			

			]);
			if(!$existeEstudiante)
			{
				$user = new User;
				$nombres = explode(" ", $data->nombres);
				$apellidos = explode(" ", $data->apellidos);
				$primerNombre = strtolower($nombres[0]);
				$primerApellido = strtolower($apellidos[0]);
				$user_sentinel = [
					'email'	=>	$request->correo ?? $primerNombre.'.'.$primerApellido.$data->id."@itred.edu.ec",
					'password'	=>	"12345"
				];
				$user = Sentinel::registerAndActivate($user_sentinel);
				$user->idPeriodoLectivo = $ModuloAdmisiones->idPeriodo;
				//dd($user);
				$user->save();
				//registra el rol de los usuarios
				$role = Sentinel::findRoleByName("Estudiante");
				$role->users()->attach($user);
				$idProfile = DB::table('users_profile')
										->insertGetId([
											'ci'	=>	$data->ci,
											'nombres'	=>	$data->nombres,
											'apellidos'	=>	$data->apellidos,
											'sexo'	=>		$data->sexo,
											'fNacimiento'	=>	$data->fechaNacimiento,
											'correo'	=> $request->correo ?? $user->email,
											'dDomicilio'	=>	$data->dDomicilio,
											'tDomicilio'	=>	$data->tDomicilio,
											'cargo'	=>	"Estudiante",
											'userid'   =>  $user->id,
											'created_at'	=>	date("Y-m-d H:i:s"),
										]);		

				$data->idProfile = $idProfile;				
				$data->save();
			}
			$dataProfile->save();
                
				  
		$estudiante=Student2::findOrFail($data->id);
		$this->creacionPagos( $paraleloId, $estudiante,  $ModuloAdmisiones->idPeriodo);
		Session::flash('message', 'El estudiante se creo correctamente.');
		DB::commit();
        return redirect()->route('admision_datos', [$estudiante->ci]);
    }
        
		public function cliente_crear($estudiante){
			$cliente = new Cliente;
			$estudiante = Student2::findOrFail($estudiante);
			 //return view('UsersViews.admisiones.crear_cliente',compact('cliente','estudiante'));
			return view('UsersViews.admisiones.crearClienteModal',compact('cliente','estudiante'));
		}
		public function storeCliente(Request $request){
			//$id_periodoElectivo = PeriodoLectivo::where('nombre', '2020-2021')->first();
			$ModuloAdmisiones = ConfiguracionSistema::admisiones();
			DB::beginTransaction();
			$existe = Cliente::where('cedula_ruc', $request->cedula_ruc)->exists();
			if(!$existe){//verifico si el cliente existe para que me deje crear el padre en caso de que no exista
		$this->validate($request, [
			'cedula_ruc' => 'required|unique:clientes,cedula_ruc',
		], ['cedula_ruc.unique' => 'Lo sentimos, ya existe esta cédula registrada.']);
		$cliente = Cliente::create([
			'cedula_ruc' => $request->cedula_ruc,
			'nombres' => $request->nombres,
			'apellidos' => $request->apellidos,
			'correo' => $request->correo,
			'telefono' => $request->telefono,
			'direccion' => $request->direccion,
			'parentezco' => $request->parentezco,
			'idPeriodo' => $ModuloAdmisiones->idPeriodo,
			'fecha_nacimiento' => $request->fecha_nacimiento,
			'telefono_domicilio' => $request->telefono_domicilio,
			'profesion' => $request->profesion,
			'lugar_trabajo' => $request->lugar_trabajo,
			'telefono_trabajo' => $request->telefono_trabajo,
			'nacionalidad' => $request->nacionalidad,
		]);
			}
		if ($request->crearPadre != null) {
			$validator = Validator::make($request->all(), [
				'cedula_ruc' => 'required|unique:datospadres,ci',
				'fecha_nacimiento' => 'required',
				'nacionalidad' => 'required',
				'parentezco' => 'required',
			], ['cedula_ruc.unique' => 'Lo sentimos, el número de cédula ya se encuentra registrado en padres.',
				'fecha_nacimiento.required' => 'El campo fecha de nacimiento es requerida para crear el padre.',
				'parentezco.required' => 'El campo parentezco es requerido para crear el padre.']);
			if ($validator->fails()) {
				DB::rollback();
				return redirect()->back()
					->withErrors($validator)
					->withInput($request->all());
			}
			$this->crearUsuarioPadre($request);
		}
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
		$estudiante=Student2::findOrFail($request->id_estudiante);
			$this->act_clien($cliente->id,$request->id_estudiante);
		DB::commit();
		Session::flash('message', 'El cliente se creo correctamente.');
		 return redirect()->route('admision_datos', [$estudiante->ci]);
    }public function crearUsuarioPadre(Request $request) {
    	//$id_periodoElectivo = PeriodoLectivo::where('nombre', '2020-2021')->first();
    	$ModuloAdmisiones = ConfiguracionSistema::admisiones();
		DB::beginTransaction();
		$pariente = Parents::create([
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
			'idPeriodo' =>  $ModuloAdmisiones->idPeriodo,
		]);
		$this->act_padre($request->parentezco,$request->id_estudiante,$pariente->id);
		DB::commit();
	}public function padre_crear($estudiante,$parentezco){
		$padre = new Parents();
		$estudiante = Student2::findOrFail($estudiante);
		//dd($padre);
       // return view('UsersViews.admisiones.crear_padre', compact('padre','estudiante','parentezco'));
        return view('UsersViews.admisiones.CrearPadreModal', compact(
			'padre','estudiante','parentezco'));
	}
	public function storePadre(Request $request){
		DB::beginTransaction();
		//$id_periodoElectivo = PeriodoLectivo::where('nombre', '2020-2021')->first();
		$ModuloAdmisiones = ConfiguracionSistema::admisiones();
		$existe = Parents::where('ci', $request->ci)->exists();
		if (!$existe) {
		$padre = new Parents();
		// General
		$padre->ci = $request->ci;
		$padre->nombres = $request->nombres;
		$padre->apellidos = $request->apellidos;
		$padre->sexo = $request->sexo;
		$padre->parentezco = $request->parentezco;
		$padre->fNacimiento = $request->fNacimiento;
		$padre->estado_civil = $request->estado_civil;
		$padre->fallecido = $request->fallecido == 'Si' ? 1 : 0;
		$padre->correo = $request->correo;
		$padre->movil = $request->movil;
		$padre->bio = $request->bio;
		$padre->autorizadoRetirarEstudiante = $request->autorizacion_retirar_estudiante == 'Si' ? 1 : 0;
		$padre->religion = $request->religion;
		//Domicilio
		$padre->ciudadDomicilio = $request->ciudadDomicilio;
		$padre->direccionDomicilio = $request->direccionDomicilio;
		$padre->telefonoDomicilio = $request->telefonoDomicilio;
		//Trabajo
		$padre->ciudadTrabajo = $request->ciudadTrabajo;
		$padre->direccionTrabajo = $request->direccionTrabajo;
		$padre->telefonoTrabajo = $request->telefonoTrabajo;
		$padre->cargoTrabajo = $request->cargoTrabajo;
		$padre->lugarTrabajo = $request->lugarTrabajo;
		$padre->profesion = $request->profesion;
		$padre->ex_alumno = $request->ex_alumno == 'Si' ? 1 : 0;
		$padre->fecha_promocion = $request->fecha_promocion;
		$padre->fecha_ingreso_pais = $request->fecha_ingreso_pais;
		$padre->fecha_expiracion_pasaporte = $request->fecha_expiracion_pasaporte;
		$padre->fecha_caducidad_pasaporte = $request->fecha_caducidad_pasaporte;
		// Nacionalidad
		$padre->nacionalidad = $request->nacionalidad;
		$padre->lugarNacimiento = $request->lugar_nacimiento;
		$padre->provincia = $request->provincia;
		$padre->canton = $request->canton;
		$padre->parroquia = $request->parroquia;
		// Instrucción
		$padre->estudios = $request->estudios;
		// Datos Médicos
		$padre->clinica = $request->clinica;
		$padre->indicaciones = $request->indicaciones;
		$padre->tipoSangre = $request->tipo_sangre;
		$padre->contactoEmergencia = $request->contacto_emergencia;
		$padre->telefonoEmergencia = $request->telefono_emergencia;
		$padre->observacionEmergencia = $request->observacion_emergencia;
		$padre->idPeriodo = $ModuloAdmisiones->idPeriodo;
		$padre->save();
		$this->act_padre($request->parentezco,$request->id_estudiante,$padre->id);

		}

		if ($request->crearCliente != null)  {
			$validator = Validator::make($request->all(), [
				'ci' => 'required|unique:clientes,cedula_ruc'
			], ['ci.unique' => 'Lo sentimos, el número de cédula ya se encuentra registrado en clientes.']);
			if ($validator->fails()) {
				DB::rollback();
				return redirect()->back()
					->withErrors($validator)
					->withInput($request->all());
			}
			$this->creacionUsuarioCliente($request);
		}
		if ($request->crearRepresentante != null) {
			$validator = Validator::make($request->all(), [
				'ci' => 'required|unique:users_profile,ci',
				'correo' => 'required|unique:users,email'
			], ['ci.unique' => 'Lo sentimos, el número de cédula ya se encuentra registrado en perfil representante.',
				'correo.unique' => 'Lo sentimos, el correo ingresado ya se encuentra registrado en perfil representante.']);
			if ($validator->fails()) {
				DB::rollback();
				return back()
					->withErrors($validator)
					->withInput($request->all());
			}
			$this->creacionUsuarioRepresentante($request);
		}
		DB::commit();
		$estudiante=Student2::findOrFail($request->id_estudiante);
		Session::flash('message', 'El pariente se creo correctamente.');
		 return redirect()->route('admision_datos', [$estudiante->ci]);
	}
	public function creacionUsuarioCliente($request) {
		DB::beginTransaction();
		//$periodo = PeriodoLectivo::where('nombre', '2020-2021')->first();
		$ModuloAdmisiones = ConfiguracionSistema::admisiones();
		 $cliente = Cliente::create([
			'cedula_ruc' => $request->ci,
			'nombres' => $request->nombres,
			'apellidos' => $request->apellidos,
			'correo' => $request->correo,
			'telefono' => $request->movil,
			'direccion' => $request->direccionDomicilio,
			'parentezco' => $request->parentezco,
			'idPeriodo' => $ModuloAdmisiones->idPeriodo,
			'fecha_nacimiento' => $request->fNacimiento,
			'telefono_domicilio' => $request->telefonoDomicilio,
			'profesion' => $request->profesion,
			'lugar_trabajo' => $request->lugarTrabajo,
			'telefono_trabajo' => $request->telefonoTrabajo,
			'nacionalidad' => $request->nacionalidad,
		]);
		 $estudiante=Student2::findOrFail($request->id_estudiante);
			$this->act_clien($cliente->id,$request->id_estudiante);
			DB::commit();
	}
	public function creacionUsuarioRepresentante($request) {
		DB::beginTransaction();
		$user_sentinel = ['email' => $request->correo,'password' => $request->ci];
		$user= Sentinel::registerAndActivate($user_sentinel);
		//$periodo = PeriodoLectivo::where('nombre', '2020-2021')->first();
		$ModuloAdmisiones = ConfiguracionSistema::admisiones();
		//registra el rol de los usuarios
		$role= Sentinel::findRoleByName('Representante');
		$role->users()->attach($user);
		$user->idPeriodoLectivo = $ModuloAdmisiones->idPeriodo;
		$user->save();
		$path = null;

		if ($request->hasFile('image')) {
			$path = Storage::disk('public')->putFile('avatars', $request->image,'public');
		}

		DB::table('users_profile')->insert([
			'ci'	=>	$request->ci,
			'nombres'	=>	$request->nombres,
			'apellidos'	=>	$request->apellidos,
			'sexo'	=>		$request->sexo,
			'fNacimiento'	=>	$request->fNacimiento,
			'correo'	=>	$request->correo,
			'movil'	=>	$request->movil,
			'bio'	=>	$request->bio,
			'dDomicilio'	=>	$request->direccionDomicilio,
			'tDomicilio'	=>	$request->telefonoDomicilio,
			'cargo'	=>	'Representante',
			'userid'   =>  $user->id,
			'es_representante'   =>  $request->es_representante == 'true' ? 1 : 0,
			'created_at'	=>	date("Y-m-d H:i:s"),
			'url_imagen' => $path,
			'profesion' => $request->profesion,
			'lugar_trabajo' => $request->lugarTrabajo,
			'ex_alumno' => $request->ex_alumno == 'Si' ? 1 : 0,
			'telefono_trabajo' => $request->telefonoTrabajo,
			'fecha_promocion' => $request->fecha_promocion,
			'fecha_ingreso' => $request->fecha_ingreso_pais,
			'fecha_estado_migratorio' => $request->fecha_estado_migratorio,
			'fecha_exp_pasaporte' => $request->fecha_expiracion_pasaporte,
			'fecha_caducidad_pasaporte' => $request->fecha_caducidad_pasaporte,
			'nacionalidad' => $request->nacionalidad,
		]);
		$representante = User::all()->last();
		$this->act_repre($representante->id,$request->id_estudiante);
		DB::commit();
	}
	public function crearUsuarioRepresentante($request) {
		DB::beginTransaction();
		$user_sentinel = ['email' => $request->correo,'password' => $request->cedula_ruc];
		$user= Sentinel::registerAndActivate($user_sentinel);
		//$periodo = PeriodoLectivo::where('nombre', '2020-2021')->first();
		$ModuloAdmisiones = ConfiguracionSistema::admisiones();
		//registra el rol de los usuarios
		$role= Sentinel::findRoleByName('Representante');
		$role->users()->attach($user);
		$user->idPeriodoLectivo = $ModuloAdmisiones->idPeriodo;
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
			$representante = User::all()->last();
			$estudiante=Student2::findOrFail($request->id_estudiante);
			$this->act_repre($representante->id,$request->id_estudiante);
			DB::commit();
	}public function representante_crear($estudiante)
	{		$data = new Cliente;
			$estudiante = Student2::findOrFail($estudiante);
			 //return view('UsersViews.admisiones.crear_representante',compact('data','estudiante'));
			 return view('UsersViews.admisiones.CrearRepresentanteModal',compact('data','estudiante'));

	}
	public function storeRepresentante(Request $request){
		DB::beginTransaction();
		$this->validate($request,[
			'ci' => 'required|string|max:14|unique:users_profile,ci',
			'nombres' => 'required|string|between:2,30',
			'apellidos' =>  'required|string|between:2,30',
			'sexo' => 'required|in:Femenino,Masculino',
			'fNacimiento' => 'required|date',
			'correo' => 'email|required|unique:users,email',
			'movil' => 'string|max:10|nullable',
			'bio' => 'string|between:3,300|nullable',
			'dDomicilio' => 'string|between:3,200|nullable',
			'tDomicilio' => 'string|max:10|nullable',
			'cargo' => 'string|nullable',
			'tipo_usuario' => 'required|in:Administrador,Docente,Representante'],
			['ci.unique' => 'Lo sentimos, el número de cédula ya se encuentra registrado en representantes.',
				'ci.unique' => 'Lo sentimos, el número de cédula ya se encuentra registrado en representantes.']);
		$user_sentinel = ['email' => $request->correo,'password' => $request->ci];
		$user= Sentinel::registerAndActivate($user_sentinel);
		//$periodo = PeriodoLectivo::where('nombre', '2020-2021')->first();
		$ModuloAdmisiones = ConfiguracionSistema::admisiones();
		//registra el rol de los usuarios
		$role= Sentinel::findRoleByName('Representante');
		$role->users()->attach($user);
		$user->idPeriodoLectivo = $ModuloAdmisiones->idPeriodo;
		$user->save();
		$path = null;

		if ($request->hasFile('image')) {
			$path = Storage::disk('public')->putFile('avatars', $request->image,'public');
		}

		DB::table('users_profile')
				->insert([
				'ci'	=>	$request->ci,
				'nombres'	=>	$request->nombres,
				'apellidos'	=>	$request->apellidos,
				'sexo'	=>		$request->sexo,
				'fNacimiento'	=>	$request->fNacimiento,
				'correo'	=>	$request->correo,
				'movil'	=>	$request->movil,
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
			if ($request->crearCliente != null) {
			$validator = Validator::make($request->all(), [
				'ci' => 'required|unique:clientes,cedula_ruc',
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
				'ci' => 'required|unique:datospadres,ci',
				'parentezco_padre' => 'required'
				], ['ci.unique' => 'Lo sentimos, el número de cédula ya se encuentra registrado en padres.',
					'parentezco_padre.required' => 'Debe selecionar el parentezco para poder crear los padres.']);
			if ($validator->fails()) {
				DB::rollback();
				return back()
					->withErrors($validator)
					->withInput($request->all());
			}
			$this->creacionUsuarioPadre($request);
		}
		$representante = User::all()->last();
		 $estudiante=Student2::findOrFail($request->id_estudiante);
		$this->act_repre($representante->id,$request->id_estudiante);
			DB::commit();
			return 'representante creado';
		//Session::flash("message", "El representante se creo correctamente (Usuario: ".$request->correo.") (Contraseña: ".$request->ci.")");
		 //return redirect()->route('admision_datos', [$estudiante->ci]);


	}
	  public function creacionUsuarioPadre($request) {
		DB::beginTransaction();
		//$periodo = PeriodoLectivo::where('nombre', '2020-2021')->first();
		$ModuloAdmisiones = ConfiguracionSistema::admisiones();
		$padre=Parents::create([
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
			'idPeriodo' => $ModuloAdmisiones->idPeriodo,
		]);
		$this->act_padre($request->parentezco_padre,$request->id_estudiante,$padre->id);
		DB::commit();
	}public function act_repre($id_rep,$id_est)
	{	DB::beginTransaction();
			//$periodo = PeriodoLectivo::where('nombre', '2020-2021')->first();
		$ModuloAdmisiones = ConfiguracionSistema::admisiones();
		 	$dataProfile = Student2Profile::where('idStudent', $id_est)
			->where('idPeriodo', $ModuloAdmisiones->idPeriodo)
			->first();
			DB::update('update students2 set idRepresentante = ? where id = ?', [$id_rep, $dataProfile->idStudent]);
			DB::update('update students2_profile_per_year set idRepresentante = ? where id = ?', [$id_rep, $dataProfile->id]);
			DB::commit();
	}
	public function act_clien($id_cli,$id_est)
	{	DB::beginTransaction();
			//$periodo = PeriodoLectivo::where('nombre', '2020-2021')->first();
		$ModuloAdmisiones = ConfiguracionSistema::admisiones();
		 	$dataProfile = Student2Profile::where('idStudent', $id_est)
			->where('idPeriodo', $ModuloAdmisiones->idPeriodo)
			->first();
			DB::update('update students2_profile_per_year set idCliente = ? where id = ?', [$id_cli, $dataProfile->id]);
			DB::commit();
	}public function act_padre($parentezco,$id_est,$id_padre)
	{	DB::beginTransaction();
			if ($parentezco=='Madre') {

				DB::update('update students2 set idMadre = ? where id = ?', [$id_padre, $id_est]);
		}elseif ($parentezco=='Padre') {

				DB::update('update students2 set idPadre = ? where id = ?', [$id_padre, $id_est]);
		}
			DB::commit();
	}
	public function finalizar($id)
	{
        $institucion = Institution::first();
	    $ModuloAdmisiones = ConfiguracionSistema::admisiones();
        $dataProfile = Student2Profile::where('idStudent', $id)
            ->where('idPeriodo', $ModuloAdmisiones->idPeriodo)
            ->first();
		$comprobacion = Student2Profile::where('idStudent', $id)
			->get();
		//	dd($institucion, $ModuloAdmisiones, $dataProfile, $comprobacion);
		$noenviar = false;
		foreach ($comprobacion as $item){
			$per = PeriodoLectivo::find($item->idPeriodo);
			//dd($per);
			if ($per->nombre == "2020-2021") {
				$noenviar = true;
			}
			//agre 
			if ($per->nombre == "2021-2022") {
				$noenviar = true;
			}
			//dd($noenviar);
		}
        //guardo la fecha de matriculación
        $dataProfile->fecha_matriculacion= Carbon::now();
        $dataProfile->actDesdeAdmisiones= 1;

		//dd($dataProfile->actDesdeAdmisiones);
        $dataProfile->save();
		//dd($dataProfile);
/*
        if ($institucion->correoAdmisiones != null && $noenviar==false){ //Se envia correo cuando este registrado
            $this->informacionPersonalMatriculaAdmision($dataProfile->idStudent, $ModuloAdmisiones->idPeriodo);
            Mail::to($institucion->correoAdmisiones)->send(new EnvioDocumentos($dataProfile, $dataProfile->representante()->first()));
        }
*/
        Session::flash('message', 'La actualización ha finalizado');
            
		return redirect()->route('home');

	}
	public function verDatos(Student2 $students)
	{
		$padres = Parents::where('id',$students->idPadre)->get();
		$madres = Parents::where('id',$students->idMadre)->get();
		$ModuloAdmisiones = ConfiguracionSistema::admisiones();
		//dd($ModuloAdmisiones->id);
		$dataProfile = Student2Profile::where('idStudent', $students->id)
		->where('idPeriodo',$ModuloAdmisiones->idPeriodo)
		->first();
		$representantes = $dataProfile->representante;
		$clientes = $dataProfile->cliente;
		return view('UsersViews.admisiones.datosGenerales', compact('students','padres','madres','representantes','clientes'));
	}
	public function verPasos(Request $request, Student2 $students)
	{
				$padres = Parents::where('id',$students->idPadre)->get();
				$madres = Parents::where('id',$students->idMadre)->get();
			$ModuloAdmisiones = ConfiguracionSistema::admisiones();
			$periodo = $ModuloAdmisiones->idPeriodo;
			//dd($ModuloAdmisiones->id);
			$dataProfile = Student2Profile::where('idStudent', $students->id)
			->where('idPeriodo',$ModuloAdmisiones->idPeriodo)
			->first();
			$representantes = $dataProfile->representante;
			$clientes = $dataProfile->cliente;
			$view = \View::make('UsersViews.admisiones.pasoaPaso')->with(['students' => $students,'padres' => $padres,'madres' => $madres,'representantes' => $representantes,'clientes' => $clientes, 'activo'=>$request->activo,'periodo'=>$periodo]);
        if($request->ajax()){
            $sections = $view->renderSections();
            return Response::json($sections['PasoAPaso']);
        }
    }

    public function informacionPersonalMatriculaAdmision($id,$periodo) {
		$student = Student2Profile::getStudentAdmision($id,$periodo);
		$student2 = Student2::findOrFail($student->idStudent);
		$institution = Institution::first();
		$periodo = PeriodoLectivo::findOrFail($periodo);
        $curso = Course::find($student->idCurso);
		$carrera = Career::where("id", $curso->id_career)->first();
		/*$carrera = careerStudents::join("students2", "students2.id", "=", "career_students.students_id")->join("Career", "Career.id", "=", "career_students.career_id")
        ->select("Career.nombre")->where("career_students.students_id","=",$id)                     
        ->first();*/

/*
		$carrera = careerStudents::join("students2", "students2.id", "=", "career_students.students_id")->join("Career", "Career.id", "=", "career_students.career_id")
			->join("Semesters", "Semesters.id", "=", "career_students.semestre_id")
			->join("courses", "courses.id", "=", "career_students.curso_id")
			->select("*")->where("career_students.students_id","=",$id)                     
			->first();
			dd($carrera);
		*/
		$semestre = careerStudents::join("students2", "students2.id", "=", "career_students.students_id")->join("Career", "Career.id", "=", "career_students.career_id")
        ->select("Career.nombre")->where("career_students.students_id","=",$id)                     
        ->first();


		/*$semestre = careerStudents::join("students2", "students2.id", "=", "career_students.students_id")->join("Semesters", "Semesters.id", "=", "career_students.semestre_id")
        ->select("Semesters.nombsemt")->where("career_students.students_id","=",$id)                     
        ->first();*/

		$paralelo = careerStudents::join("students2", "students2.id", "=", "career_students.students_id")->join("courses", "courses.id", "=", "career_students.curso_id")
        ->select("courses.paralelo")->where("career_students.students_id","=",$id)                     
        ->first();


        if(Storage::disk('local')->exists('public/admisiones/admisiones.pdf'))
        {
            Storage::deleteDirectory('public/admisiones');
        }
        $pdf = PDF::loadView('pdf.reporteInstitucionales.informacion-pesonal-para-matricula', compact('semestre','institution', 'student', 'student2', 'curso','periodo','carrera','paralelo'))
            ->save(storage_path('app/public/admisiones/') . 'admisiones.pdf');
		return $path = 'admisiones.pdf';
	}

/*
Funcion para crear la cuenta por cobrar de matricula
*/

	public function create_cuenta_por_cobrar($id,$valor,$concepto){
        $data = Student2::where('id',$id)->first();
        $estudiante = Student2Profile::where('idStudent',$data->id)->first();
        $cuentasxcobrar = Cuentasporcobrar::where('cliente_id','=',$estudiante->id )->get();
        $semestre = Course::where('id','=',$estudiante->idCurso)->where('estado', 1)->first();
        $periodos = PeriodoLectivo::where('id','=',$semestre->idPeriodo)->first();
        $semestreCarrera = Semesters::where('career_id','=',$semestre->id_career)->first();
                    $fechaPago = Carbon::now();
                    $cxc = new Cuentasporcobrar();
                    $fecha = $fechaPago;
                    $cxc->fecha_emision  =  Carbon::now();
                    $cxc->fecha_vencimiento  =  $fecha->addDay(10);
                    $cxc->comprobante_id  =  11;
                    $cxc->debito  =  $valor;
                    $cxc->credito  =  0;
                    $cxc->cliente_id  =  $estudiante->id ;                
                    $cxc->saldo = $valor;
                    $cxc->concepto  =  "Matricula estudiante: ";
                    $cxc->save();
                    DB::commit();
    }
}