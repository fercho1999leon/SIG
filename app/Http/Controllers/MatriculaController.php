<?php

namespace App\Http\Controllers;
use App\Cuentasporcobrar;
use App\Administrative;
use App\AsistenciaParcial;
use App\BecaDescuento;
use App\BecaDetalle;
use App\Calificacion;
use App\Career;
use App\Cliente;
use App\ConfiguracionSistema;
use App\Course;
use App\Deber;
use App\Fechas;
use App\Http\Requests\StudentRequest;
use App\Http\Requests\UpdateStudentRequest;
use App\Semesters;
use App\Institution;
use App\Matter;
use App\Nivel;
use App\PagoEstudianteDetalle;
use App\Parents;
use App\Payment;
use App\PeriodoLectivo;
use App\Student2;
use App\Student2Profile;
use App\Student;
use App\Supply;
use App\TipoBloqueo;
use App\Transporte;
use App\User;
use App\Usuario;

use Carbon\Carbon;
use Exception;
use App\Http\Controllers\PayController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use PDF;
use Sentinel;
use Yajra\Datatables\Datatables;

//use App\DataTables\Student2DataTable;

class MatriculaController extends Controller
{
    public function pasarDePeriodoLectivo(Student2 $student, Request $request)
    {
       // dd($student);
        //dd($request);

        DB::beginTransaction();
        try {
            $institution = Institution::first();
            $user = Sentinel::getUser();
            
            $user_profile = Administrative::findBySentinelid($user->id);
            $course = Course::findOrFail($request->idCurso);
            $PaseDeAnio = ConfiguracionSistema::PaseDeAnio(Sentinel::getUser()->idPeriodoLectivo)->valor;
            if ($PaseDeAnio == 0) {
                throw new Exception("Debe Configurar el pase de año desde Configuraciones Generales");
            }
            $cantidadAlumnos = Student2Profile::getStudentsByCourse($course->id)->count();
            if ($cantidadAlumnos >= $course['cupos']) {
                throw new Exception("Cupo de estudiantes alcanzado en el curso " . Course::nombreCurso($course));
            }
           //dd($student->id, $PaseDeAnio);
            $existe = Student2Profile::where('idStudent', $student->id)->where('idPeriodo', $PaseDeAnio)->exists();
            //dd($existe);
            if ($existe) {
                throw new Exception("El estudiante ya esta registrado en el siguiente Periodo Lectivo. ");
            }
           
            $newStudent = Student2Profile::create([
                'numero_matriculacion' => null,
                'idPeriodo' => $PaseDeAnio,
                'idCurso' => $request->idCurso,
                'idCliente' => $student->profilePerYear()->where('idPeriodo', $this->idPeriodoUser())->first()->idCliente,
                'idRepresentante' => $student->idRepresentante,
                'idStudent' => $student->id,
                'transporte_id' => $request->transporte,
                'tipo_matricula' => $request->tipo_matricula,
                'actividad_artistica' => $request->actividad_artistica,
            'disciplina_practica' => $request->disciplina_practica,
            
                'ciudad_domicilio' => $student->ciudad,
                'direccion_domicilio' => $student->direccion,
                'telefono_movil' => $student->telefono,
                'tipo_vivienda' => $student->tipoVivienda,
                'nacionalidad' => $student->nacionalidad,
                'hospital' => $student->clinica,
                'indicaciones' => $student->indicaciones,
                'seccion' => $course->seccion,
                'fecha_matriculacion' => Carbon::now(),
                'nombre_contacto_Emergencia' => $student->contactoEmergencia,
                'movil_contacto_emergencia' => $student->telefonoEmergencia,
                'parentezco_contacto_emergencia' => $request->parentezco_contacto_emergencia,
                'nombre_contacto_emergencia2' => $request->contactoEmergencia2,
                'movil_contacto_emergencia2' => $request->telefonoEmergencia2,
                'parentezco_contacto_emergencia2' => $request->parentezco_contacto_emergencia2,

                'se_va_solo' => $request->se_va_solo != null ? 1 : 0,
                'ingreso_familiar' => $request->ingreso_familiar,
                'observacion_retirado' => $request->observacion_retirado,
                'condicionado' => $request->condicionado,
                'discapacidad' => $request->discapacidad,
    
                'Etnia_estudiante' => $request->Etnia_Estudiante,
                'pueblo_nacionalidad' => $request->pueblo_nacionalidad,
                'provincia' => $request->provincia_nacimiento,
                'canton' => $request->canton_nacimiento,
    
                'pais_residencia' => $request->pais_recidencia,
                'provincia_residencia' => $request->provincia_recidencia,
                'canton_residencia' => $request->canton_recidencia,
                'ciudad_domicilio' => $request->ciudad,
                'direccion_domicilio' => $request->direccion,
    
                'tipos_de_sangre' => $request->Tipos_Sangre,
   
                
                'seguro_institucional' => $request->seguro_institucional,
                'nombre_seguro' => $request->nombre_seguro,
                
                
                'inclusion' => $request->inclusion == 'Si' ? 1 : 0,
                'alergias' => $request->alergias,
                'enfermedad' => $request->enfermedad,
    
                'fecha_expiracion_pasaporte' => $request->fecha_expiracion_pasaporte,
                'fecha_caducidad_pasaporte' => $request->fecha_caducidad_pasaporte,
                'fecha_ingreso_pais' => $request->fecha_ingreso_pais,
                'celular' => $request->celular_estudiante,
                'estado_civil_padres' => $request->estado_civil_padres,
                'idCliente' => $request->idCliente,
                'estado_civil' =>$request->Estado_Civil,
                'sexo' => $request->sexo,
                'genero' => $request->genero,
                'documentos_informacion' => $request->documentos_informacion,


                'ficha_medica' => $student->ficha_medica,
                'retirado' => 'NO',
            ]);

           
          
     
            $this->creacionPagos($request->idCurso, $student, $PaseDeAnio);
            $this->creacionDeAsistenciaParcial($newStudent->id, $PaseDeAnio);
            $this->creacionNumeroDeMatricula($newStudent->id, $PaseDeAnio);

            $insumos = Supply::where('idCurso', $request->idCurso)->get();
            if ($request->tipo_matricula != 'Pre Matricula') {
                foreach ($insumos as $insumo) {
                    if ($insumo->activities->isNotEmpty()) {
                        foreach ($insumo->activities as $activity) {
                            if ($activity->recibirTareas === 1) {
                                $materia = Matter::where('id', $insumo->idMateria)->first();
                                $existe_deber = Deber::where('idProfesor', $materia->user->profile->id)
                                    ->where('idActividad', $activity->id)
                                    ->where('idPeriodo', $PaseDeAnio)
                                    ->where('idEstudiante', $newStudent->idStudent)
                                    ->exists();
                                if (!$existe_deber) {
                                    $deber = new Deber;
                                    $deber->idActividad = $activity->id;
                                    $deber->idPeriodo = $PaseDeAnio;
                                    $deber->idEstudiante = $newStudent->idStudent;
                                    $deber->idProfesor = $materia->user->profile->id;
                                    $deber->save();
                                }
                            }
                        }
                    }
                }
            }

            // if ($institution->correoAdmisiones != null){
            //     $this->informacionPersonalMatriculaAdmision($newStudent->idStudent, $PaseDeAnio);
            //     Mail::to($institution->correoAdmisiones)->send(new EnvioDocumentos($newStudent, $newStudent->representante()->first()));
            // }
            DB::commit();
            if ($user_profile->cargo == 'Representante') {
                $user->idPeriodoLectivo = $PaseDeAnio;
                $user->save();
            }
           // dd($newStudent->id);
            $matriculaCuotas = new PayController;
            $matriculaCuotas->getStudentPase($newStudent->idStudent, $request->idCurso);
            return back()->with('message', ['type' => 'success', 'text' => 'El estudiante a sido pasado al siguiente periodo lectivo con un estatus de: ' . $request->tipo_matricula]);
        } catch (Exception $e) {
            return back()->withErrors($e->getMessage());
        }
    }

    public function pasarDePeriodoLectivoall()
    {
        try {
            $user = Sentinel::getUser();
            $periodo = PeriodoLectivo::findOrFail($user->idPeriodoLectivo);
            $courses = Course::where('idPeriodo', $periodo->id)->get();
            $PaseDeAnio = ConfiguracionSistema::PaseDeAnio($periodo->id)->valor;

            if ($PaseDeAnio == 0) { //confirma que este vinculado un periodo lectivo en configuraciones al cual se pasara el estudiante
                throw new Exception("Debe Configurar el pase de año desde Configuraciones Generales");
            }

            foreach ($courses as $curso) {

                $data = new \Illuminate\Support\Collection(json_decode(file_get_contents('http://' . config('app.api_host_name') . ':8081/libreta/anual/' . $this->idPeriodoUser() . '/curso/' . $curso->id)));
                $siguienteCurso = Calificacion::gradoSiguienteAdmision($curso->grado)['buscar'];
                $CursoNew = Course::where('grado', $siguienteCurso)->where('idPeriodo', $PaseDeAnio)->first();

                if ($CursoNew != null) {

                    $students = Student2Profile::getStudentsByCourse($curso->id);

                    foreach ($students as $student) {

                        $promedio = "";

                        if ($curso->grado != 'Inicial 2' && $curso->grado != 'Inicial 1' && $curso->grado != 'Primero') {
                            $promedio = $data->where('estudianteId', $student->idStudent)->first();
                        }

                        $existe = Student2Profile::where('idStudent', $student->idStudent)->where('idPeriodo', $PaseDeAnio)->exists();

                        if (!$existe && $promedio != "" && $promedio->promedioEstudiante >= 7) {

                            $newStudent = Student2Profile::create([
                                'numero_matriculacion' => null,
                                'idPeriodo' => $PaseDeAnio,
                                'idCurso' => $CursoNew->id,
                                'idCliente' => $student->idCliente,
                                'idRepresentante' => $student->idRepresentante,
                                'idStudent' => $student->idStudent,
                                'tipo_matricula' => 'Pre Matricula',
                                'ciudad_domicilio' => $student->ciudad_domicilio,
                                'direccion_domicilio' => $student->direccion_domicilio,
                                'telefono_movil' => $student->telefono_movil,
                                'tipo_vivienda' => $student->tipo_vivienda,
                                'nacionalidad' => $student->nacionalidad,
                                'hospital' => $student->hospital,
                                'indicaciones' => $student->indicaciones,
                                'seccion' => $CursoNew->seccion,
                                'fecha_matriculacion' => null,
                                'nombre_contacto_Emergencia' => $student->nombre_contacto_Emergencia,
                                'movil_contacto_emergencia' => $student->movil_contacto_emergencia,
                                'ficha_medica' => $student->ficha_medica,
                                'retirado' => 'NO',
                            ]);

                            $this->creacionPagos($CursoNew->id, $student->student()->first(), $PaseDeAnio);
                            $this->creacionDeAsistenciaParcial($newStudent->id, $PaseDeAnio);

                        }
                    }
                }
            }

            return back()->with('message', ['type' => 'success', 'text' => 'Los estudiantes han sido pasados al siguiente periodo lectivo con un estatus de: PRE-MATRICULA']);

        } catch (Exception $e) {
            return back()->withErrors($e->getMessage());
        }
    }

    public function homeNew()
    {
        $PaseDeAnio = ConfiguracionSistema::PaseDeAnio(Sentinel::getUser()->idPeriodoLectivo)->valor;
        $courses = Course::where('estado',1)
                            ->where('idPeriodo',Sentinel::getUser()->idPeriodoLectivo)
                            ->get();
        $careers = Career::all()->where('estado', '=', '1');
        return view('UsersViews.administrador.matricula.home', compact('PaseDeAnio','courses', 'careers'));
    }
    public function tablaEstudiantes()
    {
        /*$data = Student2::select('courses.*')->join('students2_profile_per_year', 'students2.id', '=', 'students2_profile_per_year.idStudent')
        ->join('courses', 'students2_profile_per_year.idCurso', '=', 'courses.id')
        ->join('Career', 'courses.id_career', '=', 'Career.id')
        ->leftjoin('users_profile as R', 'students2.id', '=', 'R.id')
        ->leftjoin('students2_profile_per_year_tipo_bloqueos as TB', 'students2_profile_per_year.id', '=', 'TB.idStudent')
        ->leftjoin('tipo_bloqueos as TBN', 'TB.idBloqueo', '=', 'TBN.id')
        ->where('students2_profile_per_year.idPeriodo', Sentinel::getUser()->idPeriodoLectivo)
        ->where('Career.estado', 1)  
        ->groupBy('students2.id')->get();
        dd($data);*/

        $students = Student2::select('students2.id', 'students2.ci', 'students2.apellidos',
            'students2.nombres', 'students2.retirado', 'students2_profile_per_year.tipo_matricula as matricula',
            'students2_profile_per_year.numero_matriculacion as numeroMatricula', 'Semesters.nombsemt as nameSemester','students2_profile_per_year.idPeriodo',
            'students2_profile_per_year.fecha_matriculacion','Career.nombre as carrera', 'Career.id as idCarrera', 'courses.grado as grado', 'courses.paralelo as paralelo',
            'R.ci AS cedula_Representante', 'R.nombres as nombre_representante', 'R.apellidos as apellidos_representante',
            'R.correo as correo_Representante', 'R.movil as Celular_Representante', \DB::raw('(CASE
                        WHEN students2.bloqueado = "1" THEN "SI"
                        ELSE "NO"
                        END) AS bloqueado'), 'TBN.nombre as nombreBloqueo')
            ->join('students2_profile_per_year', 'students2.id', '=', 'students2_profile_per_year.idStudent')
            ->join('courses', 'students2_profile_per_year.idCurso', '=', 'courses.id')
            ->join('Career', 'courses.id_career', '=', 'Career.id')
            ->join('Semesters', 'courses.id_semester','=', 'Semesters.id')
            ->leftjoin('users_profile as R', 'students2.id', '=', 'R.id')
            ->leftjoin('students2_profile_per_year_tipo_bloqueos as TB', 'students2_profile_per_year.id', '=', 'TB.idStudent')
            ->leftjoin('tipo_bloqueos as TBN', 'TB.idBloqueo', '=', 'TBN.id')
            ->where('students2_profile_per_year.idPeriodo', Sentinel::getUser()->idPeriodoLectivo)
            ->where('Career.estado', 1)  
            ->groupBy('students2.id')->get();
        return Datatables::of($students)
            ->addColumn('btn', 'UsersViews.administrador.matricula.accion')
            ->rawColumns(['btn'])
            ->make(true);
    }

    public function tablaEstudiantesPrueba()
    {

        $students = Student2::select('students2.id', 'students2.ci', 'students2.apellidos',
            'students2.nombres', 'students2.retirado', 'students2_profile_per_year.tipo_matricula as matricula',
            'students2_profile_per_year.numero_matriculacion as numeroMatricula', 'students2_profile_per_year.idPeriodo',
            'students2_profile_per_year.fecha_matriculacion', 'Career.nombre as carrera', 'Career.id as idCarrera', 'courses.grado as grado', 'courses.paralelo as paralelo',
            'R.ci AS cedula_Representante', 'R.nombres as nombre_representante', 'R.apellidos as apellidos_representante',
            'R.correo as correo_Representante', 'R.movil as Celular_Representante', \DB::raw('(CASE
                        WHEN students2.bloqueado = "1" THEN "SI"
                        ELSE "NO"
                        END) AS bloqueado'), 'TBN.nombre as nombreBloqueo')
            ->join('students2_profile_per_year', 'students2.id', '=', 'students2_profile_per_year.idStudent')
            ->join('courses', 'students2_profile_per_year.idCurso', '=', 'courses.id')
            ->join('Career', 'courses.id_career', '=', 'Career.id')
            ->leftjoin('users_profile as R', 'students2.idProfile', '=', 'R.id')
            ->leftjoin('students2_profile_per_year_tipo_bloqueos as TB', 'students2_profile_per_year.id', '=', 'TB.idStudent')
            ->leftjoin('tipo_bloqueos as TBN', 'TB.idBloqueo', '=', 'TBN.id')
            ->where('students2_profile_per_year.idPeriodo', Sentinel::getUser()->idPeriodoLectivo)
            ->where('Career.estado', 1)
            ->groupBy('students2.id')->get();

        //dd(json_encode($students));

        return response()->json($students);
        /*return Datatables::of($students)
    ->addColumn('btn', 'UsersViews.administrador.matricula.accion')
    ->rawColumns(['btn'])
    ->make(true);
     */
    }

    public function home()
    {
        $institution = Institution::first();
        $students = Student2::select('students2.id', 'students2.apellidos', 'students2.nombres', 'students2.nivelDeIngles',
            'students2_profile_per_year.tipo_matricula as matricula')
            ->join('students2_profile_per_year', 'students2.id', '=', 'students2_profile_per_year.idStudent')
            ->search(request('search'))
            ->courses(request('courses'))
            ->matricula(request('matricula'))
            ->where('students2_profile_per_year.idPeriodo', $this->idPeriodoUser())
            ->orderBy('apellidos', 'ASC')
            ->paginate(40);

        foreach ($students as $student) {
            $dataProfile = Student2Profile::where('idStudent', $student->id)->first();
            $bloqueos[$student->id] = $dataProfile->bloqueos->isNotEmpty() ? true : false;
        }
        $careers = Career::all()->where('estado', '=', '1');
        $courses = Course::getAllCourses();
        return view('UsersViews.administrador.matricula.index', compact(
            'students', 'courses', 'institution', 'bloqueos', 'careers'
        ));
    }

    public function home_admision()
    {

        return view('UsersViews.admisiones.index');
    }

    public function registro_admision()
    {


        return view('UsersViews.admisiones.registro');
    }

    public function create()
    {
        $institution = Institution::first();
        $tipo_bloqueos = TipoBloqueo::all();
        $clients = Cliente::getClients();
        $becas = BecaDescuento::getAllDiscounts();
        $configuracionPago = ConfiguracionSistema::query()
            ->where('idPeriodo', $this->idPeriodoUser())
            ->where('nombre', 'ACTIVAR_PAGOS')->first();
        $contador_matricula = ConfiguracionSistema::query()
            ->where('idPeriodo', $this->idPeriodoUser())
            ->where('nombre', 'CONTADOR_MATRICULA')->first();
        $configuracion_transporte = ConfiguracionSistema::transporte();
        $data = new Student2;
        $idPeriodo = Sentinel::getUser()->idPeriodoLectivo;
        $dataProfile = new Student2Profile;
        if ($contador_matricula->valor === '') {
            return Redirect::back()->withErrors(['login_fail' => 'Antes de matricular a un estudiante, por favor, debe definir el modo de contador de matricula en configuraciones generales.']);
        }

        $users = Administrative::orderBy('apellidos', 'ASC')->get();
        $courses = course::getAllCourses();
        $unidades = Transporte::getAllBuses();
        $unidadesPrivadas = Transporte::where('es_privado', 1)
            ->orderBy('ruta')
            ->where('idPeriodo', Sentinel::getUser()->idPeriodoLectivo)
            ->get();
        $periodos = PeriodoLectivo::all();
        $padres = Parents::whereParentezco('Padre')->orderBy('apellidos', 'ASC')->get();
        $madres = Parents::whereParentezco('Madre')->orderBy('apellidos', 'ASC')->get();
        // $careers = Career::All();//where('estado', 1);
        $movilizacion = array('PROPIA', 'EXPRESO');
        $tipo_vivienda = array('PROPIA', 'ALQUILADA');
        $careers = Career::all()->where('estado', '=', '1');
        $pueblos_nacionalidades = DB::table('pueblos_nacionalidades')->get();
        $paises = DB::table('paises')->get();
        $provincias = DB::table('provincias')->get();
        $cantones = DB::table('cantones')->get();
        $cxc = new Cuentasporcobrar;
        $bod = BecaDescuento::getAllDiscounts();
        $curso = new Course;
        $cursoActual = null;
        return view('UsersViews.administrador.matricula.crear', compact(
            'users', 'periodos', 'courses', 'padres', 'madres', 'unidades', 'configuracionPago', 'data', 'dataProfile',
            'idPeriodo', 'unidadesPrivadas', 'configuracion_transporte', 'becas', 'clients', 'tipo_bloqueos','curso',
            'movilizacion', 'tipo_vivienda', 'careers','pueblos_nacionalidades','paises','provincias','cantones','cxc','bod', 'cursoActual'
        ));
    }

    public function store(StudentRequest $request)
    {       
        $institution = Institution::first();
        $contador_matricula = ConfiguracionSistema::contadorMatricula();
        if ($contador_matricula->valor === '') {
            return Redirect::back()->withErrors(['login_fail' => 'Antes de matricular a un estudiante, por favor, debe definir el modo de contador de matricula en configuraciones generales.']);
        }
        //$course =  course::all()
        //                ->where('id_career','=',$request->curso )
         //               ->where('estado','=','1')
                        //->where('id',$request->paralelo)
        //                ->first();
        $course =  course::where('id_career','=',$request->curso )
                        ->where('estado','=','1')
                        ->where('id',$request->paralelo)
                        ->first();
        $student = Student2::where('ci',$request->n_identificacion)->first();
        //dd($request->request,((object)$request->request->all())->paralelo,$course,$request->curso,$request->paralelo);	
        if($course == null ){
            return Redirect::back()->withErrors(['login_fail' => 'Antes de matricular a un estudiante, por favor, debe definir el modo de contador de matricula en configuraciones generales.']);
        }
        
        if (count(Student2::getStudentsByCourse($course->id)) >= $course->cupos) {
            return Redirect::back()->withErrors(['login_fail' => 'Cupo de estudiantes alcanzado.']);
        }

        
        if($request->tipoBecaId == 3){
            $becaSelect = 2;
            $becaText = "NA";
        }
        if($request->haRealizadoPracticasPreprofesionales == 2){
            $sectorEconomicoPracticaProfesional = "22";
            $nroHorasPracticasPreprofesionalesPorPeriodo = "NA";
            $entornoInstitucionalPracticasProfesionales = "5";
            $participaEnProyectoVinculacionSociedad = "3";
            $tipoAlcanceProyectoVinculacionId = "5";
        }
        if($request->haRealizadoPracticasPreprofesionales == 1){
            $sectorEconomicoPracticaProfesional = $request->sectorEconomicoPracticaProfesional;
            $nroHorasPracticasPreprofesionalesPorPeriodo = $request->nroHorasPracticasPreprofesionalesPorPeriodo;
            $entornoInstitucionalPracticasProfesionales = $request->entornoInstitucionalPracticasProfesionales;
            $participaEnProyectoVinculacionSociedad = $request->participaEnProyectoVinculacionSociedad;
            $tipoAlcanceProyectoVinculacionId = $request->tipoAlcanceProyectoVinculacionId;
        }
        if($student != null)
        {	
            $existeEstudiante = true;				
            $data = $student;
            $existeEnPeriodo = Student2Profile::where('idPeriodo', $this->idPeriodoUser())
                                        ->where('idStudent', $student->id)->exists();

        }else{
            $existeEstudiante = false;
            $data = new Student2();
            //curso
            $data->idCurso = $course->id;
            //-----------
            $data->ci = $request->n_identificacion;
            $data->identificacion = $request->ci;
            $data->nombres = mb_strtoupper($request->nombres, 'UTF-8');
            $data->apellidos = mb_strtoupper($request->apellidos, 'UTF-8');
            $data->sexo = $request->sexo;
            $data->fechaNacimiento = $request->fechaNacimiento;
            $data->ciudad = $request->ciudad;
            $data->direccion = $request->direccion;
            $data->telefono = $request->telefono;
            $data->nacionalidad = $request->pais;
            $data->lugarNacimiento = $request->lugarNacimiento;
            $data->tipoVivienda = $request->tipoVivienda;

            $data->matricula = $request->matricula;
            $data->institucionAnterior = $request->institucionAnterior;
            $data->razonCambio = $request->razonCambio;
            $data->observaciones = $request->observaciones;

            $data->clinica = $request->clinica;
            $data->indicaciones = $request->indicaciones;
            $data->tipoSangre = $request->tipoSangre;
            $data->contactoEmergencia = $request->contactoEmergencia;
            $data->telefonoEmergencia = $request->telefonoEmergencia;
            //$data->matricula = $request->matricula;
            $data->retirado = 'NO';
            $data->bloqueado = $request->bloqueado;
            //$data->seccion = $request->seccion;
            $data->transporte_id = $request->transporte;
            $data->nivelDeIngles = $request->nivelEstudiante;
            $data->idPadre = $request->idPadre;
            $data->idMadre = $request->idMadre;
            $data->idRepresentante = $request->idRepresentante;
            $data->provincia = $request->provincia;
            $data->canton = $request->canton;
            $data->parroquia = $request->parroquia;

            $data->tipoColegioId = $request->tipoColegioId;
            $data->modalidadCarrera = $request->modalidadCarrera;
            $data->jornadaCarrera = $request->jornadaCarrera;
            $data->fechaInicioCarrera = $request->fechaInicioCarrera;
            $data->fecha_matriculacion = $request->fecha_matriculacion;
            $data->matricula = $request->tipo_matricula;
            $data->nivelAcademicoQueCursa = $request->nivelAcademicoQueCursa;
            $data->duracionPeriodoAcademico = $request->duracionPeriodoAcademico;
            $data->haRepetidoAlMenosUnaMateria = $request->haRepetidoAlMenosUnaMateria;
            $data->haPerdidoLaGratuidad = $request->haPerdidoLaGratuidad;
            
            
            $data->haRealizadoPracticasPreprofesionales = $request->haRealizadoPracticasPreprofesionales;
            $data->sectorEconomicoPracticaProfesional = $sectorEconomicoPracticaProfesional;
            $data->nroHorasPracticasPreprofesionalesPorPeriodo = $nroHorasPracticasPreprofesionalesPorPeriodo;
            $data->entornoInstitucionalPracticasProfesionales = $entornoInstitucionalPracticasProfesionales;
            $data->participaEnProyectoVinculacionSociedad = $participaEnProyectoVinculacionSociedad;
            $data->tipoAlcanceProyectoVinculacionId = $tipoAlcanceProyectoVinculacionId;
            

            $data->recibePensionDiferenciada = $request->recibePensionDiferenciada;
            $data->estudianteocupacionId = $request->estudianteocupacionId;
            $data->ingresosestudianteId = $request->ingresosestudianteId;
            $data->bonodesarrolloId = $request->bonodesarrolloId;
            $data->ingresoTotalHogar = $request->ingresoTotalHogar;
            $data->cantidadMiembrosHogar = $request->cantidadMiembrosHogar;
            $data->nivelFormacionPadre = $request->nivelFormacionPadre;
            $data->nivelFormacionMadre = $request->nivelFormacionMadre;
            $data->facturacion_correo = $request->correo_personal;
            if($request->tipoBecaId == "" || $request->tipoBecaId == null || $request->tipoBecaId == 3){
                $data->tipoBecaId = $request->tipoBecaId;
                $data->primeraRazonBecaId = 2;
                $data->segundaRazonBecaId = 2;
                $data->terceraRazonBecaId = 2;
                $data->cuartaRazonBecaId = 2;
                $data->quintaRazonBecaId = 2;
                $data->sextaRazonBecaId = 2;
                $data->porcientoBecaCoberturaArancel = 2;
                $data->porcientoBecaCoberturaManuntencion = "NA";
                $data->financiamientoBeca = 2;
                $data->montoAyudaEconomica = "NA";
                $data->montoCreditoEducativo = "NA";
            }else{
                        $data->tipoBecaId = $request->tipoBecaId;
                        $data->primeraRazonBecaId = $request->primeraRazonBecaId;
                        $data->segundaRazonBecaId = $request->segundaRazonBecaId;
                        $data->terceraRazonBecaId = $request->segundaRazonBecaId;
                        $data->cuartaRazonBecaId = $request->cuartaRazonBecaId;
                        $data->quintaRazonBecaId = $request->quintaRazonBecaId;
                        $data->sextaRazonBecaId = $request->sextaRazonBecaId;
                        $data->porcientoBecaCoberturaArancel = $request->porcientoBecaCoberturaArancel;
                        $data->porcientoBecaCoberturaManuntencion = $request->porcientoBecaCoberturaManuntencion;
                        $data->financiamientoBeca = $request->financiamientoBeca;
                        $data->montoAyudaEconomica = $request->montoAyudaEconomica;
                        $data->montoCreditoEducativo = $request->montoCreditoEducativo;

            }



            if ($request->hasFile('fichaMedica')) {
                $nombreAdjunto = request()->fichaMedica->getClientOriginalName();
                $nombreAdjunto = request()->fichaMedica->storeAs('public/adjuntos', $nombreAdjunto);
                $data->ficha_medica = request()->fichaMedica->getClientOriginalName();
            }
            $data->fecha_matriculacion = $request->fecha_matriculacion;
            $data->save();

            
        }
        /*
        if ($existeEnPeriodo) {
            return Redirect::back()->withErrors(['warning' => 'El numero de cédula ya esta registrado para otro estudiante']);
        }
        */
        DB::beginTransaction();

        $discapacidadResp="";
        if($request->Tiene_Discapacidad == 2){
            $discapacidadResp = 2;
            $discapacidadRespN = "NA";
            $porcentajeDiscapacidad = "NA";
            $tipo_discapacidad = "7";
            $tipo_de_enfermedad_catastrofica = "6";
        }
        if($request->Tiene_Discapacidad == 1){
            $discapacidadResp = 1;
            $discapacidadRespN = $request->Carnet_CONADIS;
            $porcentajeDiscapacidad = $request->porcentaje_discapacidad;
            $tipo_discapacidad = $request->Tipo_discapacidad;
            $tipo_de_enfermedad_catastrofica = $request->Tipo_enfermedad_catastrófica;
        }
        

        $dataProfile = Student2Profile::create([
            'fecha_matriculacion' => $request->fecha_matriculacion ?? Carbon::now()->format('Y-m-d'),
            'idCurso' => $course->id,
            'idPeriodo' => $this->idPeriodoUser(),
            'idRepresentante' => $request->idRepresentante,
            'idStudent' => $data->id,
            'transporte_id' => $request->transporte,
            //'seccion' => $request->seccion,
            'tipo_matricula' => $request->matricula,
            'actividad_artistica' => $request->actividad_artistica,
            'disciplina_practica' => $request->disciplina_practica,
        
            'telefono_movil' => $request->telefono,
            'tipo_vivienda' => $request->tipo_ivienda,
            'con_quien_vive' => $request->con_quien_vive,
            'nacionalidad' => $request->nacionalidad,
            'hospital' => $request->clinica,
            'indicaciones' => $request->indicaciones,

            'nombre_contacto_emergencia' => $request->contactoEmergencia,
            'movil_contacto_emergencia' => $request->telefonoEmergencia,
            'parentezco_contacto_emergencia' => $request->parentezco_contacto_emergencia,
            'nombre_contacto_emergencia2' => $request->contactoEmergencia2,
            'movil_contacto_emergencia2' => $request->telefonoEmergencia2,
            'parentezco_contacto_emergencia2' => $request->parentezco_contacto_emergencia2,

            'retirado' => 'NO',
            'se_va_solo' => $request->se_va_solo != null ? 1 : 0,
            'ingreso_familiar' => $request->ingreso_familiar,
            'observacion_retirado' => $request->observacion_retirado,
            'condicionado' => $request->condicionado,
            'discapacidad' => $request->discapacidad,

            'Etnia_estudiante' => $request->Etnia_Estudiante,
            'pueblo_nacionalidad' => $request->pueblo_nacionalidad,
            'provincia' => $request->provincia_nacimiento,
            'canton' => $request->canton_nacimiento,

            'pais_residencia' => $request->pais_recidencia,
            'provincia_residencia' => $request->provincia_recidencia,
            'canton_residencia' => $request->canton_recidencia,
            'ciudad_domicilio' => $request->ciudad,
            'direccion_domicilio' => $request->direccion,

            'tipos_de_sangre' => $request->Tipos_Sangre,
            'tienes_discapacidad' => $discapacidadResp,
            'carnet_conadis' => $discapacidadRespN,
            'tipo_discapacidad' => $tipo_discapacidad,
            'tipo_de_enfermedad_catastrofica' => $tipo_de_enfermedad_catastrofica,
            'porcentaje_discapacidad' => $porcentajeDiscapacidad,
            
            'seguro_institucional' => $request->seguro_institucional,
            'nombre_seguro' => $request->nombre_seguro,
            
            
            'inclusion' => $request->inclusion == 'Si' ? 1 : 0,
            'alergias' => $request->alergias,
            'enfermedad' => $request->enfermedad,

            'fecha_expiracion_pasaporte' => $request->fecha_expiracion_pasaporte,
            'fecha_caducidad_pasaporte' => $request->fecha_caducidad_pasaporte,
            'fecha_ingreso_pais' => $request->fecha_ingreso_pais,
            'celular' => $request->celular_estudiante,
            'estado_civil_padres' => $request->estado_civil_padres,
            'idCliente' => $request->idCliente,
            'estado_civil' =>$request->Estado_Civil,
            'sexo' => $request->sexo,
            'genero' => $request->genero,
            'documentos_informacion' => $request->documentos_informacion,
        ]);
        $dataProfile->save();
        $this->creacionDeAsistenciaParcial($dataProfile->id, null);
        if (true) {
            $periodoLectivo = PeriodoLectivo::findOrFail($this->idPeriodoUser());
            if ($contador_matricula->valor == 'G') {
                $cont = Student2Profile::query()
                    ->where('idPeriodo', $this->idPeriodoUser())
                    ->where('tipo_matricula', '!=', 'Pre Matricula')
                    ->where('retirado', 'NO')
                    ->count();
                $fecha = Carbon::createFromFormat('Y-m-d H:i:s', carbon::now())->year;
                // $dataProfile->numero_matriculacion = substr($periodoLectivo->fecha_inicial, 0, 4) . "-" . sprintf("%04d", $cont);
            } else {
                $cont = count(Student2Profile::getStudentsBySeccion($dataProfile->course->seccion));
                $fecha = Carbon::createFromFormat('Y-m-d H:i:s', carbon::now())->year;
                // $dataProfile->numero_matriculacion = substr($periodoLectivo->fecha_inicial, 0, 4) . "-" . sprintf("%04d", $cont);
            }

            // Comprobando si existen deberes existentes en el curso al que se haya matriculado
            $insumos = Supply::where('idCurso', $dataProfile->idCurso)->get();
            foreach ($insumos as $insumo) {
                if ($insumo->activities->isNotEmpty()) {
                    foreach ($insumo->activities as $activity) {
                        if ($activity->recibirTareas === 1) {
                            $materia = Matter::where('id', $insumo->idMateria)->first();
                            $deber = new Deber;
                            $deber->idActividad = $activity->id;
                            $deber->idPeriodo = $this->idPeriodoUser();
                            $deber->idEstudiante = $data->id;
                            $deber->idProfesor = $materia->user->profile->id;
                            $deber->save();
                        }
                    }
                }
            }
            // Creación de usuario en sentinel
            if(!$existeEstudiante)
            { 
                $user = new User;
                $nombres = explode(" ", $data->nombres);
                $apellidos = explode(" ", $data->apellidos);
                $primerNombre = strtolower($nombres[0]);
                $primerApellido = strtolower($apellidos[0]);
                $user_sentinel = [                    
                    'email' => $request->correo ?? $primerNombre . '.' . $primerApellido . $data->id . "@itred.edu.ec",
                    'password' => "12345",
                ];
            
                $user = Sentinel::registerAndActivate($user_sentinel);
                $user->idPeriodoLectivo = $this->idPeriodoUser();
                $user->save();

                //registra el rol de los usuarios
                $role = Sentinel::findRoleByName("Estudiante");
                $role->users()->attach($user);
                $idProfile = DB::table('users_profile')
                    ->insertGetId([
                        'ci' => $data->ci,
                        'nombres' => $data->nombres,
                        'apellidos' => $data->apellidos,
                        'sexo' => $data->sexo,
                        'fNacimiento' => $data->fechaNacimiento,
                        'correo' => $request->correo ?? $user->email,
                        'dDomicilio' => $data->dDomicilio,
                        'tDomicilio' => $data->tDomicilio,
                        'cargo' => "Estudiante",
                        'userid' => $user->id,
                        'created_at' => date("Y-m-d H:i:s"),
                    ]);
                $data->idProfile = $idProfile;
                $data->save();
            } else {

                $data->save();
            }
        } 
        #REGION GUARDAR BECA
        $beca = BecaDetalle::where('idEstudiante', $data->id)->first(); // Busca si el estudiante ya tiene una beca
        $request->beca = ($request->beca == null) ? 0 : $request->beca;
        if ($request->beca != "0") { // si NO se selecciono SIN BECA
            if ($beca == null) { // Si no tenia una beca registrada antes crea el nuevo registro
                $beca = new BecaDetalle;
                $beca->idEstudiante = $data->id;
                $beca->idBeca = $request->beca;
                $beca->idPeriodo = $this->idPeriodoUser();
                $beca->save();
            } else { // por falso modifica el registro
                $beca->idEstudiante = $data->id;
                $beca->idBeca = $request->beca;

                $beca->save();
            }
        } else if ($beca != null) { // SI se selecciono SIN BECA y SI tenia una beca registrada antes, la elimina
            $beca->delete();
        } // si NO tenia una beca registrada y NO se selecciono ninguna beca, no hara ningun cambio

        $descuentos = BecaDetalle::with('beca')->whereHas('beca', function ($q) {
            $q->where('tipo', 'DESCUENTO');
        })->where('idEstudiante', $data->id)->get(); // busca los descuentos del estudiante

        // elimina todos sus descuentos
        foreach ($descuentos as $beca) {
            $beca->delete();
        }

        if ($request->descuentos != null) { // si se selecciono algun descuento
            // los vuelve a generar en base a los que se selecciono
            foreach ($request->descuentos as $descuento) {
                $beca = new BecaDetalle;
                $beca->idPeriodo = $this->idPeriodoUser();
                $beca->idEstudiante = $data->id;
                $beca->idBeca = $descuento;
                $beca->save();
            }
        }
        $dataProfile->bloqueos()->attach($request->tipo_bloqueo);
        $dataProfile->save();
        $this->creacionPagos($request->curso, $data, $nextYear = null);
        DB::commit();
        
        return redirect()->route('matricula');
    }

    public function import_excel_all(StudentRequest $request)
    {       
        $request = ((object)$request->request->all());
        $institution = Institution::first();
        $contador_matricula = ConfiguracionSistema::contadorMatricula();
        if ($contador_matricula->valor === '') {
            return Redirect::back()->withErrors(['login_fail' => 'Antes de matricular a un estudiante, por favor, debe definir el modo de contador de matricula en configuraciones generales.']);
        }
        //$course =  course::all()
        //                ->where('id_career','=',$request->curso )
         //               ->where('estado','=','1')
                        //->where('id',$request->paralelo)
        //                ->first();
        $course =  course::where('id_career','=',$request->curso )
                        ->where('estado','=','1')
                        ->where('id',$request->paralelo)
                        ->first();
        $student = Student2::where('ci',$request->n_identificacion)->first();
        //dd($request->request,((object)$request->request->all())->paralelo,$course,$request->curso,$request->paralelo);	
        if($course == null ){
            return Redirect::back()->withErrors(['login_fail' => 'Antes de matricular a un estudiante, por favor, debe definir el curso y la carrera.']);
        }
        
        if (count(Student2::getStudentsByCourse($course->id)) >= $course->cupos) {
            return Redirect::back()->withErrors(['login_fail' => 'Cupo de estudiantes alcanzado.']);
        }

        
        if($request->tipoBecaId == 3){
            $becaSelect = 2;
            $becaText = "NA";
        }
        if($request->haRealizadoPracticasPreprofesionales == 2){
            $sectorEconomicoPracticaProfesional = "22";
            $nroHorasPracticasPreprofesionalesPorPeriodo = "NA";
            $entornoInstitucionalPracticasProfesionales = "5";
            $participaEnProyectoVinculacionSociedad = "3";
            $tipoAlcanceProyectoVinculacionId = "5";
        }
        if($request->haRealizadoPracticasPreprofesionales == 1){
            $sectorEconomicoPracticaProfesional = $request->sectorEconomicoPracticaProfesional;
            $nroHorasPracticasPreprofesionalesPorPeriodo = $request->nroHorasPracticasPreprofesionalesPorPeriodo;
            $entornoInstitucionalPracticasProfesionales = $request->entornoInstitucionalPracticasProfesionales;
            $participaEnProyectoVinculacionSociedad = $request->participaEnProyectoVinculacionSociedad;
            $tipoAlcanceProyectoVinculacionId = $request->tipoAlcanceProyectoVinculacionId;
        }
        if($student != null)
        {	
            $existeEstudiante = true;				
            $data = $student;
            $existeEnPeriodo = Student2Profile::where('idPeriodo', $this->idPeriodoUser())
                                        ->where('idStudent', $student->id)->exists();

        }else{
            $existeEstudiante = false;
            $data = new Student2();
            //curso
            $data->idCurso = $course->id;
            //-----------
            $data->ci = $request->n_identificacion;
            $data->identificacion = $request->ci;
            $data->nombres = mb_strtoupper($request->nombres, 'UTF-8');
            $data->apellidos = mb_strtoupper($request->apellidos, 'UTF-8');
            $data->sexo = $request->sexo;
            $data->fechaNacimiento = $request->fechaNacimiento;
            $data->ciudad = $request->ciudad;
            $data->direccion = $request->direccion;
            $data->telefono = $request->telefono;
            $data->nacionalidad = $request->pais;
            $data->lugarNacimiento = $request->lugarNacimiento;
            $data->tipoVivienda = $request->tipoVivienda;

            $data->matricula = $request->matricula;
            $data->institucionAnterior = $request->institucionAnterior;
            $data->razonCambio = $request->razonCambio;
            $data->observaciones = $request->observaciones;

            $data->clinica = $request->clinica;
            $data->indicaciones = $request->indicaciones;
            $data->tipoSangre = $request->tipoSangre;
            $data->contactoEmergencia = $request->contactoEmergencia;
            $data->telefonoEmergencia = $request->telefonoEmergencia;
            //$data->matricula = $request->matricula;
            $data->retirado = 'NO';
            $data->bloqueado = $request->bloqueado;
            //$data->seccion = $request->seccion;
            $data->transporte_id = $request->transporte;
            $data->nivelDeIngles = $request->nivelEstudiante;
            $data->idPadre = $request->idPadre;
            $data->idMadre = $request->idMadre;
            $data->idRepresentante = $request->idRepresentante;
            $data->provincia = $request->provincia;
            $data->canton = $request->canton;
            $data->parroquia = $request->parroquia;

            $data->tipoColegioId = $request->tipoColegioId;
            $data->modalidadCarrera = $request->modalidadCarrera;
            $data->jornadaCarrera = $request->jornadaCarrera;
            $data->fechaInicioCarrera = $request->fechaInicioCarrera;
            $data->fecha_matriculacion = $request->fecha_matriculacion;
            $data->matricula = $request->tipo_matricula;
            $data->nivelAcademicoQueCursa = $request->nivelAcademicoQueCursa;
            $data->duracionPeriodoAcademico = $request->duracionPeriodoAcademico;
            $data->haRepetidoAlMenosUnaMateria = $request->haRepetidoAlMenosUnaMateria;
            $data->haPerdidoLaGratuidad = $request->haPerdidoLaGratuidad;
            
            
            $data->haRealizadoPracticasPreprofesionales = $request->haRealizadoPracticasPreprofesionales;
            $data->sectorEconomicoPracticaProfesional = $sectorEconomicoPracticaProfesional;
            $data->nroHorasPracticasPreprofesionalesPorPeriodo = $nroHorasPracticasPreprofesionalesPorPeriodo;
            $data->entornoInstitucionalPracticasProfesionales = $entornoInstitucionalPracticasProfesionales;
            $data->participaEnProyectoVinculacionSociedad = $participaEnProyectoVinculacionSociedad;
            $data->tipoAlcanceProyectoVinculacionId = $tipoAlcanceProyectoVinculacionId;
            

            $data->recibePensionDiferenciada = $request->recibePensionDiferenciada;
            $data->estudianteocupacionId = $request->estudianteocupacionId;
            $data->ingresosestudianteId = $request->ingresosestudianteId;
            $data->bonodesarrolloId = $request->bonodesarrolloId;
            $data->ingresoTotalHogar = $request->ingresoTotalHogar;
            $data->cantidadMiembrosHogar = $request->cantidadMiembrosHogar;
            $data->nivelFormacionPadre = $request->nivelFormacionPadre;
            $data->nivelFormacionMadre = $request->nivelFormacionMadre;
            $data->facturacion_correo = $request->correo_personal;
            //$data->correoElectronico = $request->correo_personal;
            if($request->tipoBecaId == "" || $request->tipoBecaId == null || $request->tipoBecaId == 3){
                $data->tipoBecaId = $request->tipoBecaId;
                $data->primeraRazonBecaId = 2;
                $data->segundaRazonBecaId = 2;
                $data->terceraRazonBecaId = 2;
                $data->cuartaRazonBecaId = 2;
                $data->quintaRazonBecaId = 2;
                $data->sextaRazonBecaId = 2;
                $data->porcientoBecaCoberturaArancel = 2;
                $data->porcientoBecaCoberturaManuntencion = "NA";
                $data->financiamientoBeca = 2;
                $data->montoAyudaEconomica = "NA";
                $data->montoCreditoEducativo = "NA";
            }else{
                        $data->tipoBecaId = $request->tipoBecaId;
                        $data->primeraRazonBecaId = $request->primeraRazonBecaId;
                        $data->segundaRazonBecaId = $request->segundaRazonBecaId;
                        $data->terceraRazonBecaId = $request->segundaRazonBecaId;
                        $data->cuartaRazonBecaId = $request->cuartaRazonBecaId;
                        $data->quintaRazonBecaId = $request->quintaRazonBecaId;
                        $data->sextaRazonBecaId = $request->sextaRazonBecaId;
                        $data->porcientoBecaCoberturaArancel = $request->porcientoBecaCoberturaArancel;
                        $data->porcientoBecaCoberturaManuntencion = $request->porcientoBecaCoberturaManuntencion;
                        $data->financiamientoBeca = $request->financiamientoBeca;
                        $data->montoAyudaEconomica = $request->montoAyudaEconomica;
                        $data->montoCreditoEducativo = $request->montoCreditoEducativo;

            }



            /*if ($request->hasFile('fichaMedica')) {
                $nombreAdjunto = request()->fichaMedica->getClientOriginalName();
                $nombreAdjunto = request()->fichaMedica->storeAs('public/adjuntos', $nombreAdjunto);
                $data->ficha_medica = request()->fichaMedica->getClientOriginalName();
            }*/
            $data->fecha_matriculacion = $request->fecha_matriculacion;
            $data->save();

            
        }
        /*
        if ($existeEnPeriodo) {
            return Redirect::back()->withErrors(['warning' => 'El numero de cédula ya esta registrado para otro estudiante']);
        }
        */
        DB::beginTransaction();

        $discapacidadResp="";
        if($request->Tiene_Discapacidad == 2){
            $discapacidadResp = 2;
            $discapacidadRespN = "NA";
            $porcentajeDiscapacidad = "NA";
            $tipo_discapacidad = "7";
            $tipo_de_enfermedad_catastrofica = "6";
        }
        if($request->Tiene_Discapacidad == 1){
            $discapacidadResp = 1;
            $discapacidadRespN = $request->Carnet_CONADIS;
            $porcentajeDiscapacidad = $request->porcentaje_discapacidad;
            $tipo_discapacidad = $request->Tipo_discapacidad;
            $tipo_de_enfermedad_catastrofica = $request->Tipo_enfermedad_catastrófica;
        }
        

        $dataProfile = Student2Profile::create([
            'fecha_matriculacion' => $request->fecha_matriculacion ?? Carbon::now()->format('Y-m-d'),
            'idCurso' => $course->id,
            'idPeriodo' => $this->idPeriodoUser(),
            'idRepresentante' => $request->idRepresentante,
            'idStudent' => $data->id,
            'transporte_id' => $request->transporte,
            //'seccion' => $request->seccion,
            'tipo_matricula' => $request->matricula,
            'actividad_artistica' => $request->actividad_artistica,
            'disciplina_practica' => $request->disciplina_practica,
        
            'telefono_movil' => $request->telefono,
            'tipo_vivienda' => $request->tipo_ivienda,
            'con_quien_vive' => $request->con_quien_vive,
            'nacionalidad' => $request->nacionalidad,
            'hospital' => $request->clinica,
            'indicaciones' => $request->indicaciones,

            'nombre_contacto_emergencia' => $request->contactoEmergencia,
            'movil_contacto_emergencia' => $request->telefonoEmergencia,
            'parentezco_contacto_emergencia' => $request->parentezco_contacto_emergencia,
            'nombre_contacto_emergencia2' => $request->contactoEmergencia2,
            'movil_contacto_emergencia2' => $request->telefonoEmergencia2,
            'parentezco_contacto_emergencia2' => $request->parentezco_contacto_emergencia2,

            'retirado' => 'NO',
            'se_va_solo' => $request->se_va_solo != null ? 1 : 0,
            'ingreso_familiar' => $request->ingreso_familiar,
            'observacion_retirado' => $request->observacion_retirado,
            'condicionado' => $request->condicionado,
            'discapacidad' => $request->discapacidad,

            'Etnia_estudiante' => $request->Etnia_Estudiante,
            'pueblo_nacionalidad' => $request->pueblo_nacionalidad,
            'provincia' => $request->provincia_nacimiento,
            'canton' => $request->canton_nacimiento,

            'pais_residencia' => $request->pais_recidencia,
            'provincia_residencia' => $request->provincia_recidencia,
            'canton_residencia' => $request->canton_recidencia,
            'ciudad_domicilio' => $request->ciudad,
            'direccion_domicilio' => $request->direccion,

            'tipos_de_sangre' => $request->Tipos_Sangre,
            'tienes_discapacidad' => $discapacidadResp,
            'carnet_conadis' => $discapacidadRespN,
            'tipo_discapacidad' => $tipo_discapacidad,
            'tipo_de_enfermedad_catastrofica' => $tipo_de_enfermedad_catastrofica,
            'porcentaje_discapacidad' => $porcentajeDiscapacidad,
            
            'seguro_institucional' => $request->seguro_institucional,
            'nombre_seguro' => $request->nombre_seguro,
            
            
            'inclusion' => $request->inclusion == 'Si' ? 1 : 0,
            'alergias' => $request->alergias,
            'enfermedad' => $request->enfermedad,

            'fecha_expiracion_pasaporte' => $request->fecha_expiracion_pasaporte,
            'fecha_caducidad_pasaporte' => $request->fecha_caducidad_pasaporte,
            'fecha_ingreso_pais' => $request->fecha_ingreso_pais,
            'celular' => $request->celular_estudiante,
            'estado_civil_padres' => $request->estado_civil_padres,
            'idCliente' => $request->idCliente,
            'estado_civil' =>$request->Estado_Civil,
            'sexo' => $request->sexo,
            'genero' => $request->genero,
            'documentos_informacion' => $request->documentos_informacion,
        ]);
        $dataProfile->save();
        $this->creacionDeAsistenciaParcial($dataProfile->id, null);
        if (true) {
            $periodoLectivo = PeriodoLectivo::findOrFail($this->idPeriodoUser());
            if ($contador_matricula->valor == 'G') {
                $cont = Student2Profile::query()
                    ->where('idPeriodo', $this->idPeriodoUser())
                    ->where('tipo_matricula', '!=', 'Pre Matricula')
                    ->where('retirado', 'NO')
                    ->count();
                $fecha = Carbon::createFromFormat('Y-m-d H:i:s', carbon::now())->year;
                // $dataProfile->numero_matriculacion = substr($periodoLectivo->fecha_inicial, 0, 4) . "-" . sprintf("%04d", $cont);
            } else {
                $cont = count(Student2Profile::getStudentsBySeccion($dataProfile->course->seccion));
                $fecha = Carbon::createFromFormat('Y-m-d H:i:s', carbon::now())->year;
                // $dataProfile->numero_matriculacion = substr($periodoLectivo->fecha_inicial, 0, 4) . "-" . sprintf("%04d", $cont);
            }

            // Comprobando si existen deberes existentes en el curso al que se haya matriculado
            $insumos = Supply::where('idCurso', $dataProfile->idCurso)->get();
            foreach ($insumos as $insumo) {
                if ($insumo->activities->isNotEmpty()) {
                    foreach ($insumo->activities as $activity) {
                        if ($activity->recibirTareas === 1) {
                            $materia = Matter::where('id', $insumo->idMateria)->first();
                            $deber = new Deber;
                            $deber->idActividad = $activity->id;
                            $deber->idPeriodo = $this->idPeriodoUser();
                            $deber->idEstudiante = $data->id;
                            $deber->idProfesor = $materia->user->profile->id;
                            $deber->save();
                        }
                    }
                }
            }
            // Creación de usuario en sentinel
            if(!$existeEstudiante)
            { 
                $user = new User;
                $nombres = explode(" ", $data->nombres);
                $apellidos = explode(" ", $data->apellidos);
                $primerNombre = strtolower($nombres[0]);
                $primerApellido = strtolower($apellidos[0]);
                $user_sentinel = [                    
                    'email' => $request->correo ?? $primerNombre . '.' . $primerApellido . $data->id . "@itred.edu.ec",
                    'password' => "12345",
                ];
            
                $user = Sentinel::registerAndActivate($user_sentinel);
                $user->idPeriodoLectivo = $this->idPeriodoUser();
                $user->save();

                //registra el rol de los usuarios
                $role = Sentinel::findRoleByName("Estudiante");
                $role->users()->attach($user);
                $idProfile = DB::table('users_profile')
                    ->insertGetId([
                        'ci' => $data->ci,
                        'nombres' => $data->nombres,
                        'apellidos' => $data->apellidos,
                        'sexo' => $data->sexo,
                        'fNacimiento' => $data->fechaNacimiento,
                        'correo' => $request->correo ?? $user->email,
                        'dDomicilio' => $data->dDomicilio,
                        'tDomicilio' => $data->tDomicilio,
                        'cargo' => "Estudiante",
                        'userid' => $user->id,
                        'created_at' => date("Y-m-d H:i:s"),
                    ]);
                $data->idProfile = $idProfile;
                $data->save();
            } else {

                $data->save();
            }
        } 
        #REGION GUARDAR BECA
        $beca = BecaDetalle::where('idEstudiante', $data->id)->first(); // Busca si el estudiante ya tiene una beca
        $request->beca = ($request->beca == null) ? 0 : $request->beca;
        if ($request->beca != "0") { // si NO se selecciono SIN BECA
            if ($beca == null) { // Si no tenia una beca registrada antes crea el nuevo registro
                $beca = new BecaDetalle;
                $beca->idEstudiante = $data->id;
                $beca->idBeca = $request->beca;
                $beca->idPeriodo = $this->idPeriodoUser();
                $beca->save();
            } else { // por falso modifica el registro
                $beca->idEstudiante = $data->id;
                $beca->idBeca = $request->beca;

                $beca->save();
            }
        } else if ($beca != null) { // SI se selecciono SIN BECA y SI tenia una beca registrada antes, la elimina
            $beca->delete();
        } // si NO tenia una beca registrada y NO se selecciono ninguna beca, no hara ningun cambio

        $descuentos = BecaDetalle::with('beca')->whereHas('beca', function ($q) {
            $q->where('tipo', 'DESCUENTO');
        })->where('idEstudiante', $data->id)->get(); // busca los descuentos del estudiante

        // elimina todos sus descuentos
        foreach ($descuentos as $beca) {
            $beca->delete();
        }

        if ($request->descuentos != null) { // si se selecciono algun descuento
            // los vuelve a generar en base a los que se selecciono
            foreach ($request->descuentos as $descuento) {
                $beca = new BecaDetalle;
                $beca->idPeriodo = $this->idPeriodoUser();
                $beca->idEstudiante = $data->id;
                $beca->idBeca = $descuento;
                $beca->save();
            }
        }
        $dataProfile->bloqueos()->attach($request->tipo_bloqueo);
        $dataProfile->save();
        $this->creacionPagos($request->curso, $data, $nextYear = null);
        DB::commit();
        
        return redirect()->route('matricula');
    }

    public function show($id)
    {
        $data = Student2::findOrFail($id);
        $users = Administrative::all();
        $courses = Course::getAllCourses();
        $parents = Parents::all();
        return view('UsersViews.administrador.matricula.ver', compact('data', 'courses', 'users', 'parents'));
    }

    public function certificadoMatriculaMinisterial()
    {
        $institution = Institution::first();
        $pdf = PDF::loadView('pdf.matricula-year-escolar', compact(
            'institution'
        ));

        return $pdf->inline('--.pdf');
    }

    public function edit($id, $periodo, Request $request)
    {
        //$careers = Career::All();//where('estado', 1);
        $careers = Career::all()->where('estado', '=', '1');
        $configuracionBecas = ConfiguracionSistema::configuracionBecas();
        $PaseDeAnio = ConfiguracionSistema::PaseDeAnio(Sentinel::getUser()->idPeriodoLectivo)->valor;
        $tipo_bloqueos = TipoBloqueo::all();
        $clients = Cliente::getClients();
        $institution = Institution::first();
        $configuracion_transporte = ConfiguracionSistema::transporte();
        $configuracionPago = ConfiguracionSistema::pagos();
        $unidades = Transporte::getAllBuses();
        $unidadesPrivadas = Transporte::where('es_privado', 1)
            ->orderBy('ruta')
            ->where('idPeriodo', Sentinel::getUser()->idPeriodoLectivo)
            ->get();
        $data = Student2::with('becasDescuentos', 'curso', 'pagos')->findOrFail($id);
        $configuracionTransporte = ConfiguracionSistema::pagos();
        $becas = BecaDescuento::getAllDiscounts();
        //dd($becas);
        $beca_estudiante = BecaDetalle::where('idEstudiante', $id)->get();
        $users = Administrative::orderBy('apellidos', 'ASC')->get();
        $idPeriodo = Sentinel::getUser()->idPeriodoLectivo;
        $dataProfile = $data->profilePerYear()->where('idPeriodo', $idPeriodo)->first();
        if ($dataProfile == null) {
            abort(404);
        }
        $courses = Course::getAllCourses();
        $curso = Course::findOrFail($dataProfile->idCurso);
        $cursoActual = Course::nombreCurso($curso);
        //dd($PaseDeAnio);
        //$proximoPeriodoLectivo = PeriodoLectivo::where('nombre', '2021-2022')->first();
        $proximoPeriodoLectivo = PeriodoLectivo::find($PaseDeAnio);
        
        $nextYearCourses = Course::where('idPeriodo', $PaseDeAnio)
                                    ->where('estado',1)
                                    ->where('id_career', $request->idCarrera)->get();
        $niveles = Nivel::all()->groupBy('nivel');
        $list = Student2::where('idRepresentante', $data->idRepresentante)->get();
        $padres = Parents::whereParentezco('Padre')->orderBy('apellidos', 'ASC')->get();
        $madres = Parents::whereParentezco('Madre')->orderBy('apellidos', 'ASC')->get();
        $periodos = PeriodoLectivo::all();

        $studentCarrera = Student2::select('Career.nombre as carrera', 'Career.id as idCarrera')
            ->join('students2_profile_per_year', 'students2.id', '=', 'students2_profile_per_year.idStudent')
            ->join('Career', 'students2_profile_per_year.idCurso', '=', 'Career.id')
            ->where('students2.id', '=', $id)
            ->first();

        $movilizacion = array('PROPIA', 'EXPRESO');
        $tipo_vivienda = array('PROPIA', 'ALQUILADA');
        $student_pago =$this->estudianteConsulta($id);
       
        $cxc = Cuentasporcobrar::where('cliente_id','=',$dataProfile->id)
                                ->where('concepto','=','Matricula del Semestre')
                                ->where('id_semesters',$curso->id_semester)                             
                                ->first();
        $pueblos_nacionalidades = DB::table('pueblos_nacionalidades')->get();
        $paises = DB::table('paises')->get();
        $provincias = DB::table('provincias')->get();
        $cantones = DB::table('cantones')->get();
        $bod = BecaDescuento::getAllDiscounts();
        //dd($curso,$cxc,$dataProfile,$data);
        //dd($curso->id_career);
        return view('UsersViews.administrador.matricula.editar',
            compact('movilizacion', 'tipo_vivienda', 'data', 'users', 'courses', 'list', 'niveles', 'padres', 'madres', 'periodos', 'idPeriodo', 'dataProfile', 'clients', 'tipo_bloqueos',
                'becas', 'beca_estudiante', 'unidades', 'institution', 'configuracionTransporte', 'configuracionPago', 'nextYearCourses', 'unidadesPrivadas', 'configuracion_transporte',
                 'PaseDeAnio', 'configuracionBecas', 'cursoActual', 'careers', 'studentCarrera','pueblos_nacionalidades','paises','provincias','cantones','cxc','bod','curso'));
    }

  

    public function update(UpdateStudentRequest $request, $id)
    {

        $sectorEconomicoPracticaProfesional = "";
        $nroHorasPracticasPreprofesionalesPorPeriodo = 0;
        $entornoInstitucionalPracticasProfesionales = "";
        $participaEnProyectoVinculacionSociedad = "";
        $tipoAlcanceProyectoVinculacionId = "";

        DB::beginTransaction();
        
        $institution = Institution::first();
        $contador_matricula = ConfiguracionSistema::where('nombre', 'CONTADOR_MATRICULA')
            ->where('idPeriodo', $this->idPeriodoUser())
            ->first();
        //$paraleloId = Course::all()->where('id_career', '=', $request->curso)
        //    ->where('estado', '=', '1')
            //->where('grado', '=', 'Primer Semestre')
        //    ->pluck('id')
        //    ->first();

        $paraleloId = Course::find($request->paralelo);
        //dd($paraleloId);
        if ($contador_matricula->valor === '') {
            throw new Exception('Debe definir el modo de contador de matricula en configuraciones del sistema.');
        }

        $data = Student2::findOrFail($id);
        $dataProfile = $data->profilePerYear()->where('idPeriodo', $this->idPeriodoUser())->first();
        $cursoAnterior = $dataProfile->course;
        $estadoAnterior = $dataProfile->tipo_matricula;
        $user_profile = User::find($data->idProfile);
        if ($user_profile != null) {
            $user_profile->ci = $request->n_identificacion;
            $user_profile->nombres = $request->nombres;
            $user_profile->apellidos = $request->apellidos;
            $user_profile->sexo = $request->sexo;
            $user_profile->fNacimiento = $request->fechaNacimiento;
            $user_profile->correo = $request->correo;
            $this->validate($request, [
                'correo' => ['required', 'email', Rule::unique('users', 'email')->ignore($data->profile->user->id)],
            ], [
                'correo.unique' => 'Este correo ya a sido registrado, por favor, ingresa uno nuevo',
            ]);

            $user = Usuario::findOrFail($user_profile->userid);
            $user->email = $request->correo;
            if ($request->password != null) {
                $user = Sentinel::findById($user_profile->userid);
                $credentials = ['password' => $request->password];
                $user = Sentinel::update($user, $credentials);
            }
            $user->save();
            $user_profile->save();
        }
        if($request->haRealizadoPracticasPreprofesionales == 2){
            $sectorEconomicoPracticaProfesional = "22";
            $nroHorasPracticasPreprofesionalesPorPeriodo = "NA";
            $entornoInstitucionalPracticasProfesionales = "5";
            $participaEnProyectoVinculacionSociedad = "3";
            $tipoAlcanceProyectoVinculacionId = "5";
        }
        if($request->haRealizadoPracticasPreprofesionales == 1){
            $sectorEconomicoPracticaProfesional = $request->sectorEconomicoPracticaProfesional;
            $nroHorasPracticasPreprofesionalesPorPeriodo = $request->nroHorasPracticasPreprofesionalesPorPeriodo;
            $entornoInstitucionalPracticasProfesionales = $request->entornoInstitucionalPracticasProfesionales;
            $participaEnProyectoVinculacionSociedad = $request->participaEnProyectoVinculacionSociedad;
            $tipoAlcanceProyectoVinculacionId = $request->tipoAlcanceProyectoVinculacionId;
        }

            $data->identificacion = $request->ci;    
            $data->ci = $request->n_identificacion;
            //dd($data, $request->ci, $request->n_identificacion);
            $data->nombres = $request->nombres;
            $data->apellidos = $request->apellidos;
            $data->sexo = $request->sexo;
            $data->fechaNacimiento = $request->fechaNacimiento;
            $data->ciudad = $request->ciudad;
            $data->direccion = $request->direccion;
            $data->telefono = $request->telefono;
            $data->nacionalidad = $request->pais;
            $data->lugarNacimiento = $request->lugarNacimiento;
            $data->tipoVivienda = $request->tipoVivienda;

            $data->matricula = $request->matricula;
            $data->institucionAnterior = $request->institucionAnterior;
            $data->razonCambio = $request->razonCambio;
            $data->observaciones = $request->observaciones;

            $data->clinica = $request->clinica;
            $data->indicaciones = $request->indicaciones;
            $data->tipoSangre = $request->tipoSangre;
            $data->contactoEmergencia = $request->contactoEmergencia;
            $data->telefonoEmergencia = $request->telefonoEmergencia;
            //$data->matricula = $request->matricula;
            $data->retirado = 'NO';
            $data->bloqueado = $request->bloqueado;
            //$data->seccion = $request->seccion;
            $data->transporte_id = $request->transporte;
            $data->nivelDeIngles = $request->nivelEstudiante;
            $data->idPadre = $request->idPadre;
            $data->idMadre = $request->idMadre;
            $data->idRepresentante = $request->idRepresentante;
            $data->provincia = $request->provincia;
            $data->canton = $request->canton;
            $data->parroquia = $request->parroquia;

            $data->tipoColegioId = $request->tipoColegioId;
            $data->modalidadCarrera = $request->modalidadCarrera;
            $data->jornadaCarrera = $request->jornadaCarrera;
            $data->fechaInicioCarrera = $request->fechaInicioCarrera;
            $data->fecha_matriculacion = $request->fecha_matriculacion;
            $data->matricula = $request->tipo_matricula;
            $data->nivelAcademicoQueCursa = $request->nivelAcademicoQueCursa;
            $data->duracionPeriodoAcademico = $request->duracionPeriodoAcademico;
            $data->haRepetidoAlMenosUnaMateria = $request->haRepetidoAlMenosUnaMateria;
            $data->haPerdidoLaGratuidad = $request->haPerdidoLaGratuidad;

            $data->haRealizadoPracticasPreprofesionales = $request->haRealizadoPracticasPreprofesionales;
            $data->sectorEconomicoPracticaProfesional = $sectorEconomicoPracticaProfesional;
            $data->nroHorasPracticasPreprofesionalesPorPeriodo = $nroHorasPracticasPreprofesionalesPorPeriodo;
            $data->entornoInstitucionalPracticasProfesionales = $entornoInstitucionalPracticasProfesionales;
            $data->participaEnProyectoVinculacionSociedad = $participaEnProyectoVinculacionSociedad;
            $data->tipoAlcanceProyectoVinculacionId = $tipoAlcanceProyectoVinculacionId;
            
            $data->recibePensionDiferenciada = $request->recibePensionDiferenciada;
            $data->estudianteocupacionId = $request->estudianteocupacionId;
            $data->ingresosestudianteId = $request->ingresosestudianteId;
            $data->bonodesarrolloId = $request->bonodesarrolloId;
            $data->ingresoTotalHogar = $request->ingresoTotalHogar;
            $data->cantidadMiembrosHogar = $request->cantidadMiembrosHogar;
            $data->nivelFormacionPadre = $request->nivelFormacionPadre;
            $data->nivelFormacionMadre = $request->nivelFormacionMadre;
            
            if($request->tipoBecaId == "" || $request->tipoBecaId == null || $request->tipoBecaId == 3){
                $data->tipoBecaId = $request->tipoBecaId;
                $data->primeraRazonBecaId = 2;
                $data->segundaRazonBecaId = 2;
                $data->terceraRazonBecaId = 2;
                $data->cuartaRazonBecaId = 2;
                $data->quintaRazonBecaId = 2;
                $data->sextaRazonBecaId = 2;
                $data->porcientoBecaCoberturaArancel = 2;
                $data->porcientoBecaCoberturaManuntencion = "NA";
                $data->financiamientoBeca = 2;
                $data->montoAyudaEconomica = "NA";
                $data->montoCreditoEducativo = "NA";
            }else{
                        $data->tipoBecaId = $request->tipoBecaId;
                        $data->primeraRazonBecaId = $request->primeraRazonBecaId;
                        $data->segundaRazonBecaId = $request->segundaRazonBecaId;
                        $data->terceraRazonBecaId = $request->segundaRazonBecaId;
                        $data->cuartaRazonBecaId = $request->cuartaRazonBecaId;
                        $data->quintaRazonBecaId = $request->quintaRazonBecaId;
                        $data->sextaRazonBecaId = $request->sextaRazonBecaId;
                        $data->porcientoBecaCoberturaArancel = $request->porcientoBecaCoberturaArancel;
                        $data->porcientoBecaCoberturaManuntencion = $request->porcientoBecaCoberturaManuntencion;
                        $data->financiamientoBeca = $request->financiamientoBeca;
                        $data->montoAyudaEconomica = $request->montoAyudaEconomica;
                        $data->montoCreditoEducativo = $request->montoCreditoEducativo;
            }

            


        if ($request->hasFile('fichaMedica')) {
            $nombreAdjunto = request()->fichaMedica->getClientOriginalName();
            $nombreAdjunto = request()->fichaMedica->storeAs('public/adjuntos', $nombreAdjunto);
            $data->ficha_medica = $nombreAdjunto;
        }
        /*Año Lectivo*/
        
        $dataProfile->idCurso = $paraleloId->id;
        $data->seccion = $request->seccion;
        $data->matricula = $request->matricula;
        $data->nivelDeIngles = $request->nivelEstudiante;
        $data->retirado = $request->retirado;
        /* Id al representante*/
        $data->idRepresentante = $request->idRepresentante;
        /* Id al padre*/
        $data->idPadre = $request->idPadre;
        /* Id a la madre*/
        $data->idMadre = $request->idMadre;

        //Bloqueado
        $data->bloqueado = $request->bloqueado;

        /* Facturación */
        $data->identificacion = $request->ci;
        $data->numero_identificacion = $request->numero_identificacion;
        $data->facturacion_apellidos = $request->facturacion_apellidos;
        $data->facturacion_nombres = $request->facturacion_nombres;
        $data->facturacion_correo = $request->correo_personal;
        $data->facturacion_movil = $request->facturacion_movil;
        $data->facturacion_convencional = $request->facturacion_convencional;
        $data->facturacion_actividad = $request->facturacion_actividad;
        $data->ingreso_actividad = $request->ingreso_actividad;

        /* Otro */
        $data->fecha_matriculacion = $request->fecha_matriculacion;
        if ($request->matricula != 'Pre Matricula') {
            if ($dataProfile->tipo_matricula === 'Pre Matricula') {
                $periodoLectivo = PeriodoLectivo::findOrFail($this->idPeriodoUser());
                if ($contador_matricula->valor == 'G') {
                    $cont = Student2Profile::where('tipo_matricula', '!=', 'Pre Matricula')
                        ->where('idPeriodo', $this->idPeriodoUser())
                        ->get()
                        ->count();
                    $dataProfile->numero_matriculacion = substr($periodoLectivo->fecha_inicial, 0, 4) . "-" . sprintf("%04d", $cont + 1);
                } else {
                    $cont = Student2Profile::where('seccion', $dataProfile->seccion)
                        ->where('tipo_matricula', '!=', 'Pre Matricula')
                        ->where('idPeriodo', $this->idPeriodoUser())
                        ->get()
                        ->count();
                    $dataProfile->numero_matriculacion = substr($periodoLectivo->fecha_inicial, 0, 4) . "-" . sprintf("%04d", $cont + 1);
                }
                $dataProfile->fecha_matriculacion = Carbon::now()->format('Y-m-d');

                if ($data->idProfile == null) {
                    // Creando el usuario
                    $user = new User;
                    $nombres = explode(" ", $data->nombres);
                    $apellidos = explode(" ", $data->apellidos);
                    $primerNombre = strtolower($nombres[0]);
                    $primerApellido = strtolower($apellidos[0]);

                    $user_sentinel = [
                        'email' => $request->correo ?? $primerNombre . '.' . $primerApellido . $data->id . "@itred.edu.ec",
                        'password' => "12345",
                    ];
                    $user = Sentinel::registerAndActivate($user_sentinel);
                    $user->idPeriodoLectivo = $this->idPeriodoUser();
                    $user->save();

                    //registra el rol de los usuarios
                    $role = Sentinel::findRoleByName("Estudiante");
                    $role->users()->attach($user);
                    $idProfile = DB::table('users_profile')
                        ->insertGetId([
                            'ci' => $data->ci,
                            'nombres' => $data->nombres,
                            'apellidos' => $data->apellidos,
                            'sexo' => $data->sexo,
                            'fNacimiento' => $data->fechaNacimiento,
                            'correo' => $request->correo ?? $user->email,
                            'dDomicilio' => $data->dDomicilio,
                            'tDomicilio' => $data->tDomicilio,
                            'cargo' => "Estudiante",
                            'userid' => $user->id,
                            'created_at' => date("Y-m-d H:i:s"),
                        ]);
                    $data->idProfile = $idProfile;
                    $data->save();
                }
            }
        }
        #REGION GUARDAR BECA
        $beca = BecaDetalle::where('idEstudiante', $id)->first(); // Busca si el estudiante ya tiene una beca
        $request->beca = ($request->beca == null) ? 0 : $request->beca;
        if ($request->beca != "0") { // si NO se selecciono SIN BECA
            if ($beca == null) { // Si no tenia una beca registrada antes crea el nuevo registro
                $beca = new BecaDetalle;
                $beca->idEstudiante = $data->id;
                $beca->idBeca = $request->beca;
                $beca->idPeriodo = $this->idPeriodoUser();
                $beca->save();
            } else { // por falso modifica el registro
                $beca->idEstudiante = $data->id;
                $beca->idBeca = $request->beca;
                $beca->save();
            }
        } else if ($beca != null) { // SI se selecciono SIN BECA y SI tenia una beca registrada antes, la elimina
            $beca->delete();
        } // si NO tenia una beca registrada y NO se selecciono ninguna beca, no hara ningun cambio

        $descuentos = BecaDetalle::with('beca')->whereHas('beca', function ($q) {
            $q->where('tipo', 'DESCUENTO');
        })->where('idEstudiante', $id)->get(); // busca los descuentos del estudiante

        // elimina todos sus descuentos
        foreach ($descuentos as $beca) {
            $beca->delete();
        }

        if ($request->descuentos != null) { // si se selecciono algun descuento
            // los vuelve a generar en base a los que se selecciono
            foreach ($request->descuentos as $descuento) {
                $beca = new BecaDetalle;
                $beca->idPeriodo = $this->idPeriodoUser();
                $beca->idEstudiante = $id;
                $beca->idBeca = $descuento;

                $beca->save();
            }
        }
        $curso = Course::find($paraleloId->id);
        
        if ($estadoAnterior != 'Pre Matricula') {
            // Comprobando si existen deberes existentes en el curso al que se haya matriculado
            $insumos = Supply::where('idCurso', $dataProfile->idCurso)->get();
            foreach ($insumos as $insumo) {
                if ($insumo->activities->isNotEmpty()) {
                    foreach ($insumo->activities as $activity) {
                        if ($activity->recibirTareas === 1) {
                            $materia = Matter::where('id', $insumo->idMateria)->first();

                            $existe_deber = Deber::where('idActividad', $activity->id)
                                ->where('idPeriodo', $this->idPeriodoUser())
                                ->where('idEstudiante', $data->id)
                                ->exists();
                            if (!$existe_deber) {
                                $deber = new Deber;
                                $deber->idActividad = $activity->id;
                                $deber->idPeriodo = $this->idPeriodoUser();
                                $deber->idEstudiante = $data->id;
                                $deber->idProfesor = $materia->user == null ? "" : ($materia->user->profile == null ? "" : $materia->user->profile->id);
                                $deber->save();
                            }
                        }
                    }
                }
            }
        }

        $discapacidadResp="";
        if($request->Tiene_Discapacidad == 2){
            $discapacidadResp = "2";
            $discapacidadRespN = "NA";
            $porcentajeDiscapacidad = "NA";
            $tipo_discapacidad = "7";
            $tipo_de_enfermedad_catastrofica = "6";
        }
        if($request->Tiene_Discapacidad == 1){
            $discapacidadResp = 1;
            $discapacidadRespN = $request->Carnet_CONADIS;
            $porcentajeDiscapacidad = $request->porcentaje_discapacidad;
            $tipo_discapacidad = $request->Tipo_discapacidad;
            $tipo_de_enfermedad_catastrofica = $request->Tipo_enfermedad_catastrófica;
        }        
        $data->profilePerYear()->where('idPeriodo', $this->idPeriodoUser())->first()->update([
            'fecha_matriculacion' => $request->fecha_matriculacion ?? Carbon::now()->format('Y-m-d'),
            'idCurso'               => $paraleloId->id,
            'idPeriodo'             => $this->idPeriodoUser(),
            'idRepresentante'       => $request->idRepresentante,
            'idStudent'             => $data->id,
            'transporte_id'         => $request->transporte,
            'tipo_matricula'        => $request->matricula,
            'actividad_artistica'   => $request->actividad_artistica,
            'disciplina_practica'   => $request->disciplina_practica,        
            'telefono_movil'        => $request->telefono,
            'tipo_vivienda'         => $request->tipo_ivienda,
            'con_quien_vive'        => $request->con_quien_vive,
            'nacionalidad'          => $request->nacionalidad,
            'hospital'              => $request->clinica,
            'indicaciones'          => $request->indicaciones,
            'nombre_contacto_emergencia'        => $request->contactoEmergencia,
            'movil_contacto_emergencia'         => $request->telefonoEmergencia,
            'parentezco_contacto_emergencia'    => $request->parentezco_contacto_emergencia,
            'nombre_contacto_emergencia2'       => $request->contactoEmergencia2,
            'movil_contacto_emergencia2'        => $request->telefonoEmergencia2,
            'parentezco_contacto_emergencia2'   => $request->parentezco_contacto_emergencia2,
            'retirado'                          => 'NO',
            'se_va_solo'                        => $request->se_va_solo != null ? 1 : 0,
            'ingreso_familiar'                  => $request->ingreso_familiar,
            'observacion_retirado'              => $request->observacion_retirado,
            'condicionado'                      => $request->condicionado,
            'discapacidad'                      => $request->discapacidad,
            'pais'                              => $request->pais,
            'Etnia_estudiante'                  => $request->Etnia_Estudiante,
            'pueblo_nacionalidad'               => $request->pueblo_nacionalidad,
            'provincia'                         => $request->provincia_nacimiento,
            'canton'                            => $request->canton_nacimiento,
            'pais_residencia'                   => $request->pais_recidencia,
            'provincia_residencia'              => $request->provincia_recidencia,
            'canton_residencia'                 => $request->canton_recidencia,
            'ciudad_domicilio'                  => $request->ciudad,
            'direccion_domicilio'               => $request->direccion,
            'tipos_de_sangre'                   => $request->Tipos_Sangre,
            'tienes_discapacidad'               => $discapacidadResp,
            'carnet_conadis'                    => $discapacidadRespN,
            'tipo_discapacidad'                 => $tipo_discapacidad,
            'tipo_de_enfermedad_catastrofica'   => $tipo_de_enfermedad_catastrofica,
            'porcentaje_discapacidad'           => $porcentajeDiscapacidad,            
            'seguro_institucional'              => $request->seguro_institucional,
            'nombre_seguro'                     => $request->nombre_seguro, 
            'inclusion'                         => $request->inclusion == 'Si' ? 1 : 0,
            'alergias'                          => $request->alergias,
            'enfermedad'                        => $request->enfermedad,
            'fecha_expiracion_pasaporte'        => $request->fecha_expiracion_pasaporte,
            'fecha_caducidad_pasaporte'         => $request->fecha_caducidad_pasaporte,
            'fecha_ingreso_pais'                => $request->fecha_ingreso_pais,
            'celular'                           => $request->celular_estudiante,
            'estado_civil_padres'               => $request->estado_civil_padres,
            'idCliente'                         => $request->idCliente,
            'estado_civil'                      =>$request->Estado_Civil,
            'sexo'                              => $request->sexo,
            'genero'                            => $request->genero,
            'documentos_informacion'            => $request->documentos_informacion,            
        ]);
        if ($request->hasFile('fichaMedica')) {
            $nombreAdjunto = request()->fichaMedica->storeAs('public/adjuntos', $nombreAdjunto);
            $nombreAdjunto = request()->fichaMedica->getClientOriginalName();
            $data->profilePerYear()->where('idPeriodo', $this->idPeriodoUser())->first()->update([
                'ficha_medica' => $nombreAdjunto,
            ]);
        }
        $data->save();
        $dataProfile->bloqueos()->sync($request->tipo_bloqueo);
        if ($request->tipo_bloqueo == null) {
            $dataProfile->update(['documentos_informacion' => null]);
        }

        $dataProfile->save();
        DB::commit();
        if(isset($request->cxcCrear)){
            $matriculaCuotas = new PayController;
            $matriculaCuotas->getStudent((int)$dataProfile->idStudent);
        }

        //$matriculaCuotas = new PayController;
        //$matriculaCuotas->getStudent((int)$dataProfile->idStudent);

        return redirect()->route('matricula');
    }

    public function matriculados()
    {
        $courses = Course::getAllCourses();
        $students = Student2::join('students2_profile_per_year', 'students2.id', '=', 'students2_profile_per_year.idStudent')
            ->whereIn('students2_profile_per_year.tipo_matricula', ['Extraordinaria', 'Ordinaria'])
            ->where('idPeriodo', $this->idPeriodoUser())
            ->get();
        $institution = Institution::first();
        $now = Carbon::now();
        $fechaA = Fechas::fechaActual($now);
        $pdf = PDF::loadView('pdf.reporte-matricula', compact(
            'institution', 'students', 'courses', 'fechaA', 'now'
        ));

        return $pdf->download('Reporte de matriculados.pdf');
    }
    public function reporteBecas()
    {
        $i = 1;
        $courses = Course::getAllCourses();
        $institution = Institution::first();
        $now = Carbon::now();
        $periodo = PeriodoLectivo::findOrFail($this->idPeriodoUser());
        $beca = BecaDetalle::where('idPeriodo', $this->idPeriodoUser())->get();
        $becas = BecaDescuento::all();
        $students = Student2Profile::join('students2', 'students2_profile_per_year.idStudent', '=', 'students2.id')
            ->join('becas_detalle', 'students2_profile_per_year.idStudent', '=', 'becas_detalle.idEstudiante')
            ->whereIn('students2.id', $beca->pluck('idEstudiante'))
            ->where('students2_profile_per_year.idPeriodo', $this->idPeriodoUser())
            ->select('students2_profile_per_year.id', 'students2.apellidos', 'students2.nombres', 'students2_profile_per_year.idCurso',
                'students2.bloqueado', 'students2_profile_per_year.idPeriodo', 'students2_profile_per_year.idStudent', 'students2_profile_per_year.numero_matriculacion', 'becas_detalle.idBeca')
            ->orderBy('apellidos', 'ASC')
            ->get();
        return view('pdf.reporte-becas', compact(
            'courses', 'students', 'institution', 'now', 'i', 'becas', 'periodo'
        ));
    }

    public function matriculados2()
    {
        $institution = Institution::first();
        $students = Student2Profile::join('students2', 'students2_profile_per_year.idStudent', '=', 'students2.id')
            ->where('students2_profile_per_year.tipo_matricula', '!=', 'Pre Matricula')
            ->where('students2_profile_per_year.retirado', 'NO')
            ->where('idPeriodo', Sentinel::getUser()->idPeriodoLectivo)
            ->select('students2_profile_per_year.id', 'students2.apellidos', 'students2.nombres', 'students2_profile_per_year.idCurso',
                'students2.bloqueado', 'students2_profile_per_year.idPeriodo', 'students2_profile_per_year.idStudent', 'students2_profile_per_year.numero_matriculacion')
            ->orderBy('students2_profile_per_year.numero_matriculacion')
            ->get();
        $studentsRetirados = Student2Profile::join('students2', 'students2_profile_per_year.idStudent', '=', 'students2.id')
            ->where('students2_profile_per_year.tipo_matricula', '!=', 'Pre Matricula')
            ->where('students2_profile_per_year.retirado', 'SI')
            ->where('idPeriodo', Sentinel::getUser()->idPeriodoLectivo)
            ->select('students2_profile_per_year.id', 'students2.apellidos', 'students2.nombres', 'students2_profile_per_year.idCurso',
                'students2.bloqueado', 'students2_profile_per_year.idPeriodo', 'students2_profile_per_year.idStudent', 'students2_profile_per_year.numero_matriculacion')
            ->orderBy('students2_profile_per_year.numero_matriculacion')
            ->get();
        $pdf = PDF::loadView('pdf.reporte-de-estudiantes-matriculados', compact(
            'institution', 'students', 'studentsRetirados'
        ));

        return $pdf->download('Reporte de estudiantes matriculados.pdf');

    }

    public function obtenerBloqueos($idStudent)
    {
        $dataProfile = Student2Profile::getStudent($idStudent);
        return view('partials.matricula.modal-bloqueo', compact('dataProfile'));
    }

    public function creacionPagos($idCurso, Student2 $student, $nextYear)
    {
        $pagos = Payment::where('idCurso', $idCurso)->get();
        //dd($pagos);
        foreach ($pagos as $pago) {
            $pagoDetalle = new PagoEstudianteDetalle;
            $pagoDetalle->idPeriodo = $nextYear ?? $this->idPeriodoUser();
            $pagoDetalle->idEstudiante = $student->id;
            $pagoDetalle->estado = "PENDIENTE";
            $pago->pagoEstudianteDetalle()->save($pagoDetalle);
        }
    }

    public function creacionDeAsistenciaParcial($idStudent, $idPeriodo)
    {
        $parciales = ['p1q1', 'p2q1', 'p3q1', 'p1q2', 'p2q2', 'p3q2'];
        foreach ($parciales as $parcial) {
            AsistenciaParcial::create([
                'idStudent' => $idStudent,
                'parcial' => $parcial,
                'idPeriodo' => $idPeriodo ?? $this->idPeriodoUser(),
            ]);
        }
    }

    public function creacionNumeroDeMatricula($idStudent, $periodo)
    {
        $PaseDeAnio = ConfiguracionSistema::PaseDeAnio($periodo)->valor;
        $periodoSiguiente = PeriodoLectivo::findOrFail($PaseDeAnio);
        //$periodoSiguiente = PeriodoLectivo::where('nombre', '2020-2021')->first();
        /*    if ($periodoSiguiente == null) {
        return back()->with('message', ['type' => 'warning', 'text' => 'Lo sentimos, sucedio un error.']);
        }*/
        $contador_matricula = ConfiguracionSistema::where('nombre', 'CONTADOR_MATRICULA')
            ->where('idPeriodo', $periodoSiguiente->id)
            ->first();

        $dataProfile = Student2Profile::findOrFail($idStudent);
        if ($dataProfile->tipo_matricula != 'Pre Matricula') {
            if ($contador_matricula->valor == 'G') {
                $cont = Student2Profile::where('tipo_matricula', '!=', 'Pre Matricula')
                    ->where('idPeriodo', $periodoSiguiente->id)
                    ->get()
                    ->count();
                $dataProfile->numero_matriculacion = substr($periodoSiguiente->fecha_inicial, 0, 4) . "-" . sprintf("%04d", $cont);
            } else {
                $cont = Student2Profile::where('seccion', $dataProfile->seccion)
                    ->where('tipo_matricula', '!=', 'Pre Matricula')
                    ->where('idPeriodo', $periodoSiguiente->id)
                    ->get()
                    ->count();
                $dataProfile->numero_matriculacion = substr($periodoSiguiente->fecha_inicial, 0, 4) . "-" . sprintf("%04d", $cont);
            }
            $dataProfile->fecha_matriculacion = Carbon::now();
        }
        $dataProfile->save();
    }
    public function editarBecas(Request $request)
    {
        #REGION GUARDAR BECA
        $beca = BecaDetalle::where('idEstudiante', $request->id)->first(); // Busca si el estudiante ya tiene una beca
        $request->beca = ($request->beca == null) ? 0 : $request->beca;
        if ($request->beca != "0") { // si NO se selecciono SIN BECA
            if ($beca == null) { // Si no tenia una beca registrada antes crea el nuevo registro
                $beca = new BecaDetalle;
                $beca->idEstudiante = $request->id;
                $beca->idBeca = $request->beca;
                $beca->idPeriodo = $this->idPeriodoUser();
                $beca->save();
            } else { // por falso modifica el registro
                $beca->idEstudiante = $request->id;
                $beca->idBeca = $request->beca;
                $beca->save();
            }
        } else if ($beca != null) { // SI se selecciono SIN BECA y SI tenia una beca registrada antes, la elimina
            $beca->delete();
        } // si NO tenia una beca registrada y NO se selecciono ninguna beca, no hara ningun cambio

        $descuentos = BecaDetalle::with('beca')->whereHas('beca', function ($q) {
            $q->where('tipo', 'DESCUENTO');
        })->where('idEstudiante', $request->id)->get(); // busca los descuentos del estudiante

        // elimina todos sus descuentos
        foreach ($descuentos as $beca) {
            $beca->delete();
        }

        if ($request->descuentos != null) { // si se selecciono algun descuento
            // los vuelve a generar en base a los que se selecciono
            foreach ($request->descuentos as $descuento) {
                $beca = new BecaDetalle;
                $beca->idPeriodo = $this->idPeriodoUser();
                $beca->idEstudiante = $request->id;
                $beca->idBeca = $descuento;

                $beca->save();
            }
        }
        return redirect()->route('pagosCursoEstudiante', ['id' => $request->id]);
    }

    public function informacionPersonalMatriculaAdmision($id, $periodo)
    {
        $student = Student2Profile::getStudentAdmision($id, $periodo);
        $student2 = Student2::findOrFail($student->idStudent);
        $institution = Institution::first();
        $periodo = PeriodoLectivo::findOrFail($periodo);
        $curso = Course::find($student->idCurso);
        if (Storage::disk('local')->exists('public/admisiones/admisiones.pdf')) {
            Storage::deleteDirectory('public/admisiones');
        }
        $pdf = PDF::loadView('pdf.reporteInstitucionales.informacion-pesonal-para-matricula', compact('institution', 'student', 'student2', 'curso', 'periodo'))
            ->save(storage_path('app/public/admisiones/') . 'admisiones.pdf');
        return $path = 'admisiones.pdf';
    }

    public function estudianteConsulta($id){
      
        $students = Student2::select('students2.id', 'students2.ci', 'students2.apellidos',
        'students2.nombres', 'students2.retirado', 'students2_profile_per_year.tipo_matricula as matricula',
        'students2_profile_per_year.numero_matriculacion as numeroMatricula', 'students2_profile_per_year.idPeriodo',
        'students2_profile_per_year.fecha_matriculacion', 'Career.nombre as carrera', 'Career.id as idCarrera', 'courses.grado as grado', 'courses.paralelo as paralelo',
        'R.ci AS cedula_Representante', 'R.nombres as nombre_representante', 'R.apellidos as apellidos_representante',
        'R.correo as correo_Representante', 'R.movil as Celular_Representante', \DB::raw('(CASE
                    WHEN students2.bloqueado = "1" THEN "SI"
                    ELSE "NO"
                    END) AS bloqueado'), 'TBN.nombre as nombreBloqueo')
        ->join('students2_profile_per_year', 'students2.id', '=', 'students2_profile_per_year.idStudent')
        ->join('courses', 'students2_profile_per_year.idCurso', '=', 'courses.id')
        ->join('Career', 'courses.id_career', '=', 'Career.id')
        ->leftjoin('users_profile as R', 'students2.idProfile', '=', 'R.id')
        ->leftjoin('students2_profile_per_year_tipo_bloqueos as TB', 'students2_profile_per_year.id', '=', 'TB.idStudent')
        ->leftjoin('tipo_bloqueos as TBN', 'TB.idBloqueo', '=', 'TBN.id')
        ->where('students2_profile_per_year.idPeriodo', Sentinel::getUser()->idPeriodoLectivo)
        ->where('Career.estado', 1)
        ->where('students2.id','=',$id)
    //->where('students2.matricula','=','Pre Matricula')
    //->orwhere('students2_profile_per_year.tipo_matricula','=','Pre Matricula')
    //->orwhere('students2_profile_per_year.tipo_matricula','=','Ordinaria')
    //->orWhere('students2.matricula','=','Ordinaria')
        ->first();
        return ($students);
    }
    public function actualizarEstudiante($id){
       // dd($id);
        $careers = Career::all()->where('estado', '=', '1');
        $configuracionBecas = ConfiguracionSistema::configuracionBecas();
        
        $tipo_bloqueos = TipoBloqueo::all();
        $clients = Cliente::getClients();
        $institution = Institution::first();
        $configuracion_transporte = ConfiguracionSistema::transporte();
        $configuracionPago = ConfiguracionSistema::pagos();
        $unidades = Transporte::getAllBuses();
        
        $data = Student2::findOrFail($id);
        $configuracionTransporte = ConfiguracionSistema::pagos();
        $becas = BecaDescuento::getAllDiscounts();
        $beca_estudiante = BecaDetalle::where('idEstudiante', $id)->get();
        $users = Administrative::orderBy('apellidos', 'ASC')->get();
        
        $dataProfile = Student2Profile::where('idStudent','=',$data->id)->first();
        //$data->profilePerYear()->where('idPeriodo', $idPeriodo)->first();
        if ($dataProfile == null) {
            abort(404);
        }
        $courses = Course::getAllCourses();
        $curso = Course::findOrFail($dataProfile->idCurso);
        $cursoActual = Course::nombreCurso($curso);
        $proximoPeriodoLectivo = PeriodoLectivo::where('nombre', '2021-2022')->first();
        
        $niveles = Nivel::all()->groupBy('nivel');
        $list = Student2::where('idRepresentante', $data->idRepresentante)->get();
        $padres = Parents::whereParentezco('Padre')->orderBy('apellidos', 'ASC')->get();
        $madres = Parents::whereParentezco('Madre')->orderBy('apellidos', 'ASC')->get();
        $periodos = PeriodoLectivo::all();

        $studentCarrera = Student2::select('Career.nombre as carrera', 'Career.id as idCarrera')
            ->join('students2_profile_per_year', 'students2.id', '=', 'students2_profile_per_year.idStudent')
            ->join('Career', 'students2_profile_per_year.idCurso', '=', 'Career.id')
            ->where('students2.id', '=', $id)
            ->first();

        $movilizacion = array('PROPIA', 'EXPRESO');
        $tipo_vivienda = array('PROPIA', 'ALQUILADA');
        $student_pago =$this->estudianteConsulta($id);
       
        $cxc = Cuentasporcobrar::where('cliente_id','=',$dataProfile->id)->where('concepto','=','Matricula del Semestre')                                
                                ->pluck('id')->first();
        $pueblos_nacionalidades = DB::table('pueblos_nacionalidades')->get();
        $paises = DB::table('paises')->get();
        $provincias = DB::table('provincias')->get();
        $cantones = DB::table('cantones')->get();
        $bod = BecaDescuento::getAllDiscounts();
        //dd($curso,$cxc,$dataProfile,$data);
        ///dd($curso->id_career);
        return view('UsersViews.estudiante.actualizarDatos.index',
            compact('movilizacion', 'tipo_vivienda', 'data', 'users', 'courses', 'list', 'niveles', 'padres', 'madres', 'periodos', 'dataProfile', 'clients', 'tipo_bloqueos',
                'becas', 'beca_estudiante', 'unidades', 'institution', 'configuracionTransporte', 'configuracionPago','configuracion_transporte',
                 'configuracionBecas', 'cursoActual', 'careers', 'studentCarrera','pueblos_nacionalidades','paises','provincias','cantones','cxc','bod','curso'));
    }
    public function actualizarEstudiantePost(Request $request){
        $data = Student2::findOrFail($request->idStuden);
        $dataProfile = Student2Profile::where('idStudent','=',$data->idProfile)->first();
        $data->facturacion_correo = $request->correo_personal;
        $data->haRealizadoPracticasPreprofesionales = $request->haRealizadoPracticasPreprofesionales;
        $data->sectorEconomicoPracticaProfesional = $request->sectorEconomicoPracticaProfesional;
        $data->nroHorasPracticasPreprofesionalesPorPeriodo = $request->nroHorasPracticasPreprofesionalesPorPeriodo;
        $data->entornoInstitucionalPracticasProfesionales = $request->entornoInstitucionalPracticasProfesionales;
        $data->participaEnProyectoVinculacionSociedad = $request->participaEnProyectoVinculacionSociedad;
        $data->tipoAlcanceProyectoVinculacionId = $request->tipoAlcanceProyectoVinculacionId;
        $data->estudianteocupacionId = $request->estudianteocupacionId;
        $data->ingresosestudianteId = $request->ingresosestudianteId;
        $data->bonodesarrolloId = $request->bonodesarrolloId;
        $data->ingresoTotalHogar = $request->ingresoTotalHogar;
        $data->cantidadMiembrosHogar = $request->cantidadMiembrosHogar;
        $data->nivelFormacionPadre = $request->nivelFormacionPadre;
        $data->nivelFormacionMadre = $request->nivelFormacionMadre;
        $data->tipoVivienda = $request->tipo_ivienda;
        $data->telefono = $request->telefono;
        $data->institucionAnterior = $request->institucionAnterior;
        $data->razonCambio = $request->razon_Cambio;
        $data->observaciones = $request->observaciones;
        $data->save();
        


        $dataProfile->celular = $request->celular_estudiante;
        $dataProfile->estado_civil = $request->Estado_Civil;
        $dataProfile->Etnia_estudiante = $request->Etnia_Estudiante;
        $dataProfile->pueblo_nacionalidad = $request->pueblo_nacionalidad;
        $dataProfile->pais_residencia = $request->pais_recidencia;
        $dataProfile->provincia_residencia = $request->provincia_recidencia;
        $dataProfile->canton_residencia = $request->canton_recidencia;
        $dataProfile->ciudad_domicilio = $request->ciudad;
        $dataProfile->direccion_domicilio = $request->direccion;
        $dataProfile->nombre_contacto_emergencia = $request->contactoEmergencia;
        $dataProfile->movil_contacto_emergencia = $request->telefonoEmergencia;
        $dataProfile->parentezco_contacto_emergencia = $request->parentezco_contacto_emergencia;
        $dataProfile->nombre_contacto_emergencia2 = $request->contactoEmergencia2;
        $dataProfile->movil_contacto_emergencia2 = $request->telefonoEmergencia2;
        $dataProfile->parentezco_contacto_emergencia2 = $request->parentezco_contacto_emergencia2;
        $dataProfile->save();
        return redirect()->back();
        //dd($request,$data,$dataProfile);

    }
}
