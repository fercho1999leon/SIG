<?php

namespace App\Http\Controllers;

use App\Activity;
use App\Administrative;
use App\Calificacion;
use App\ConfiguracionesParcial;
use App\ConfiguracionSistema;
use App\Course;
use App\Deber;
use App\Matter;
use App\Parcial;
use App\ParcialPeriodico;
use App\Student2;
use App\Student2Profile;
use App\Supply;
use App\Traits\mensajeNotificaciones;
use App\UnidadPeriodica;
use Carbon\Carbon;
use Illuminate\Http\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use \Validator;

class ScoreController extends Controller
{
    use mensajeNotificaciones;
    public function materia($idMateria, $parcial)
    {
        //dd($parcial);
        $courses = Course::getAllCourses();
        $teachers = Administrative::all();
        if ($parcial == null) {
            $parcial = "p1q1";
        }

        try {
            //Validar si el docente es dueño de la materia
            $validar = Matter::FindOrFail($idMateria);
            // dd($validar);
            if ($validar->idDocente == session('user_data')->userid) {
                $unidad = UnidadPeriodica::unidadP();
                $PromedioInsumo = ConfiguracionSistema::PromedioInsumo();
                $students = Student2Profile::getStudentsByCourse($validar->idCurso);
                $course = Course::findOrFail($validar->idCurso);
                $supplies = Supply::getSuppliesByMatter($idMateria);
                $ingresa_evaluacion = ConfiguracionSistema::ingresaEvaluacion();
                $ingresa_examen = ConfiguracionSistema::ingresaExamen();
                $ingresa_recuperacion = ConfiguracionSistema::ingresaRecuperacion();
                $data = new \Illuminate\Support\Collection(json_decode(file_get_contents('http://' . config('app.api_host_name') . ':8081/libreta/periodo/' . $this->idPeriodoUser() . '/parcial/' . $parcial . '/curso/' . $validar->idCurso)));
                return view('UsersViews.docente.calificaciones.materia',
                    compact('courses', 'data', 'teachers', 'ingresa_evaluacion',
                        'ingresa_examen', 'ingresa_recuperacion', 'unidad', 'PromedioInsumo'
                    ))->with(['Students' => $students, 'Course' => $course
                    , 'Matter' => $validar, 'parcial' => $parcial, 'Supplies' => $supplies,
                ]);
            } else {
                return redirect()->back()->withErrors(['denied' => 'Materia Solicitada no pertenece a Docente.']);
            }

        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return redirect()->back()->withErrors(['denied' => 'Materia Solicitada no pertenece a Docente.']);
        }
    }

    public function materiaInsumo($idMateria, $idInsumo, $parcial)
    {
        $courses = Course::getAllCourses();
        $teachers = Administrative::all();
        $parcialActual = ConfiguracionesParcial::parcialActual();
        $nota_minima = ConfiguracionSistema::notaMinima();
        try {
            //Validar si el docente es dueño de la materia
            $validar = Matter::FindOrFail($idMateria);
            if ($validar->idDocente == session('user_data')->userid) {
                $students = Student2::getStudentsByCourse($validar->idCurso);
                $course = Course::getCoursesByCourse($validar->idCurso);
                $validar = Matter::FindOrFail($idMateria);
                $insumoporcentual = ConfiguracionSistema::InsumoPorcentual();
                $refuerzo = Activity::where(['idInsumo' => $idInsumo, 'parcial' => $parcial, 'refuerzo' => 1])->first();
                $configuracion = ConfiguracionSistema::editaCalificaciones();
                $supply = Supply::FindOrFail($idInsumo);
                $activities = Activity::where(['idInsumo' => $idInsumo, 'parcial' => $parcial, 'refuerzo' => 0])->get();
                $calificaciones = Calificacion::where('idInsumo', $idInsumo)->get();
                return view('UsersViews.docente.calificaciones.materiaInsumo',
                    compact('courses', 'configuracion', 'refuerzo', 'teachers', 'idMateria', 'idInsumo', 'parcialActual', 'nota_minima',
                        'insumoporcentual'))
                    ->with(['Students' => $students,
                        'Course' => $course
                        , 'Matter' => $validar,
                        'Supply' => $supply,
                        'Activities' => $activities,
                        'calificaciones' => $calificaciones,
                        'parcial' => $parcial]);
            } else {
                return redirect()->back()->withErrors(['denied' => 'Materia Solicitada no pertenece a Docente.']);
            }

        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return redirect()->back()->withErrors(['denied' => 'Materia Solicitada no pertenece a Docente.']);
        }
    }
    public function activarRefuerzoAcademico($idInsumo, $parcial)
    {
        $newactivity = new Activity();
        $newactivity->nombre = "REFUERZO ACADEMICO";
        $newactivity->descripcion = "REFUERZO ACADEMICO";
        $newactivity->fechaInicio = Carbon::now();
        $newactivity->fechaEntrega = Carbon::now();
        $newactivity->idInsumo = $idInsumo;
        $newactivity->parcial = $parcial;
        $newactivity->refuerzo = 1;
        $newactivity->calificado = 1;
        $newactivity->idPeriodo = $this->idPeriodoUser();

        $newactivity->save();
        return redirect()->back();
    }

    public function desactivarRefuerzoAcademico($idInsumo, $parcial)
    {
        $refuerzo = Activity::where(['idInsumo' => $idInsumo, 'parcial' => $parcial, 'nombre' => "REFUERZO ACADEMICO", 'refuerzo' => 1])->first();
        $refuerzo->delete();
        return redirect()->back();
    }

    public function getCalificaciones($parcial)
    {
        $courses = Course::getAllCourses();
        try {
            $docente = session('user_data');
            $materias = Matter::with('curso')
                ->where('idDocente', session('user_data')->userid)
                ->where('idPeriodo', $this->idPeriodoUser())
                ->get()
                ->groupBy('curso.grado');
            return view('UsersViews.docente.calificaciones.index', compact(
                'courses', 'materias', 'parcial', 'docente'
            ));
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    /*
    Administrador
    Grados/Calificaciones/Mis Clases
     */
    public function getCalificaciones_MisClases()
    {
        $courses = Course::getAllCourses();
        try {

            $matters = Matter::getMattersByProfessor(session('user_data')->userid);

            return view('UsersViews.administrador.grados.calificaciones.misClases.index', compact('courses'))->with(['Matters' => $matters]);
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    //Redirecciona a un curso en Grado/Calificaciones
    /*No esta en funcionamiento*/
    public function getStudentsCourse()
    {
        $course = Course::find(5);
        $students = Course::getStudents(5);
        return view('UsersViews.administrador.grados.calificaciones.calificacionesCurso', compact('students', 'course'));
    }

    public function storemateriaInsumo(Request $request, $idMateria, $idInsumo, $parcial)
    {
        try {
            //Validar si el docente es dueño de la materia y el insumo pertenece a la materia
            $materia = Matter::FindOrFail($idMateria);
            $validarInsumo = Supply::FindOrFail($idInsumo);
            $validator = Validator::make($request->all(), [
                'nombre' => 'required|max:100',
                'descripcion' => 'string|max:1000|nullable',
                'adjuntos' => 'nullable',
                'fechaInicio' => 'required|Date',
                'fechaEntrega' => 'required|Date',
                'recibirTareas' => 'nullable',
            ]);
            // se realiza este ajuste para determinar la fecha maxima de cración de actividades
            $parcialP = ParcialPeriodico::where('identificador', $parcial)
                ->where('idPeriodo', $this->idPeriodoUser())->first();
            // return response()->json([ 'message' => $parcialP ], 500);

            //dd($parcialP);
            if ($parcialP != null && $parcialP->fechaF != '0000-00-00') { // esta fecha se toma desde la tabla parciales_periodicos
                $fechaF = $parcialP->fechaF;
            } else { // esta fecha se toma desde la tabla configuracionesparcial
                $configuracion = Parcial::getParcial();
                $fechaF = $configuracion[$parcial . 'FF'];
            }
            $now = Carbon::now();

            if ($validator->fails()) {

                return response()->json(['message' => view('layouts.messages')->withErrors($validator->messages())->render()], 500);
            } else {
                if ($now->lt($fechaF)) {
                    $newactivity = new Activity();
                    $newactivity->nombre = $request->nombre;
                    $newactivity->descripcion = $request->descripcion;
                    if ($request->hasFile('adjunto') && $request->file('adjunto')->isValid()) {
                        $nombre_adjunto = $request->file('adjunto')->getClientOriginalName();
                        $request->file('adjunto')->storeAs('public/actividades_adjuntos', time() . '-' . $request->file('adjunto')->getClientOriginalName());
                        $newactivity->adjuntos = time() . '-' . $nombre_adjunto;
                    }
                    $newactivity->fechaInicio = $request->fechaInicio;
                    $newactivity->idPeriodo = $this->idPeriodoUser();
                    $newactivity->fechaEntrega = $request->fechaEntrega;
                    $newactivity->idInsumo = $idInsumo;
                    $newactivity->parcial = $parcial;
                    $newactivity->recibirTareas = isset($request->recibirTareas) ? 1 : 0;

                    if (isset($request->refuerzo)) {
                        $newactivity->refuerzo = isset($request->refuerzo) ? 1 : 0;
                        $newactivity->calificado = 1;
                    } else {
                        $newactivity->calificado = isset($request->calificado) ? 1 : 0;
                    }

                    $newactivity->save();
                    $students = Student2Profile::getStudentsByCourse($request->idCurso);

                    if (isset($request->recibirTareas) != null) {
                        $deberes = Deber::where('idActividad', $newactivity->id)->get();
                        if ($deberes->isEmpty()) {
                            foreach ($students as $student) {
                                $deber = new Deber;
                                $deber->idActividad = $newactivity->id;
                                $deber->idEstudiante = $student->idStudent;
                                $deber->idPeriodo = $this->idPeriodoUser();
                                $deber->idProfesor = $materia->user->profile->id;
                                $deber->save();
                            }
                        }
                    } else {
                        $deber = Deber::where('idActividad', $newactivity->id);
                        $deber->delete();
                    }

                    // Notificaciones
                    $this->mensajeCrearTarea($students, $newactivity);
                    return '<div class="alert alert-success" role="alert">Actividad Agregada con exito.</div>';
                } else {
                    return response()->json(['message' => '<div class="alert alert-danger" role="alert">Error, el tiempo para crear tareas ha expirado</div>'], 500);
                }

            }

        } catch (Exception $e) {
            return response()->json(['message' => 'Error'], 500);
        }
    }

    public function descargarAdjunto($archivo)
    {
        return response()->download(storage_path("app/public/actividades_adjuntos/{$archivo}"));
    }

    public function showActivity($activity, $idCurso, $idMateria, $accion)
    {

        try {
            if ($accion == 2) { // mostrar calificaciones y permitir el desbloqueo para entregar tareas
                $display = 'display: none;';
            } else {
                $display = '';
            }

            $temp = Activity::FindOrFail($activity);
            $i = 1;
            $today = Carbon::now()->format('Y-m-d');
            $nota_minima = ConfiguracionSistema::notaMinima();
            $configuracion = ConfiguracionSistema::editaCalificaciones();
            $deberes = DB::table('deberes')
                ->join('students2', 'deberes.idEstudiante', '=', 'students2.id')
                ->where('deberes.idActividad', $activity)
                ->select('deberes.*', 'students2.nombres', 'students2.apellidos')
                ->distinct()->get();
            $students = Student2Profile::getStudentsByCourse($idCurso);
            $validarInsumo = Supply::FindOrFail($temp->idInsumo);
            if ($validarInsumo->idDocente == session('user_data')->userid || session('rol')->id == 1) {
                $temDate = new \DateTime($temp->fechaInicio);
                $temp->fechaInicio = $temDate->format('Y-m-d');
                $temDate = new \DateTime($temp->fechaEntrega);
                $temp->fechaEntrega = $temDate->format('Y-m-d');
                return view('layouts.showActivity', ['Activity' => $temp, 'deberes' => $deberes, 'idCurso' => $idCurso,
                    'idMateria' => $idMateria, 'students' => $students, 'today' => $today, 'i' => $i, 'nota_minima' => $nota_minima,
                    'configuracion' => $configuracion, 'accion' => $display]);

            } else {
                return response()->json(['message' => 'Actividad no pertenece a Docente.'], 500);

            }} catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
        } catch (Exception $e) {
            return response()->json(['message' => $e], 500);

        }
    }

    public function destroy(Request $request)
    {
        $idMateria = $request->idMateria;
        $idInsumo = $request->idInsumo;
        $courses = Course::getAllCourses();
        $teachers = Administrative::all();
        try {
            //Validar si el docente es dueño de la materia
            $validar = Matter::FindOrFail($idMateria);
            // $user = Sentinel::getUser();
            // $user_profile = Administrative::findBySentinelid($user->id);
            if ($validar->idDocente == session('user_data')->userid) {
                Activity::destroy($request->idActivity);
                // $students = Student2::getStudentsByCourse($validar->idCurso);
                // $course = Course::getCoursesByCourse($validar->idCurso);
                // $supply = Supply::FindOrFail($idInsumo);
                // $activities = Activity::where('idInsumo',$idInsumo)->get();

                // return view('UsersViews.docente.calificaciones.materiaInsumo', compact('courses', 'teachers','idMateria','idInsumo'))->with(['Students' =>  $students,'Course' => $course
                //     ,'Matter'   =>  $validar,
                //     'Supply'  =>  $supply,
                //     'Activities'  =>  $activities]);
                return redirect()->back();
            } else {
                return redirect()->back()->withErrors(['denied' => 'Materia Solicitada no pertenece a Docente.']);
            }

        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return redirect()->back()->withErrors(['denied' => 'Materia Solicitada no pertenece a Docente.']);
        }
    }

    public function updateActivity(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'id' => 'required|integer',
                'nombre' => 'required|max:100',
                'descripcion' => 'string|max:1000|nullable',
                'fechaInicio' => 'required|Date',
                'fechaEntrega' => 'required|Date',
                'recibirTareas' => 'nullable',
                'adjuntos' => 'nullable',
            ]);
            if ($request->observacionAlumnos != null) {
                foreach ($request->observacionAlumnos as $idStudent => $observacion) {
                    $calificacion = Calificacion::query()
                        ->where('idActividad', $request->idActividad)
                        ->where('idEstudiante', $idStudent)
                        ->where('idInsumo', $request->idInsumo)
                        ->first();
                    if (($calificacion != null) && ($observacion != null)) {
                        $calificacion->observacion = $observacion;
                        $calificacion->save();
                    }
                }
            }
            if ($request->notasAlumnos != null) {
                foreach ($request->notasAlumnos as $idStudent => $nota) {
                    $calificacion = Calificacion::query()
                        ->where('idActividad', $request->idActividad)
                        ->where('idEstudiante', $idStudent)
                        ->where('idInsumo', $request->idInsumo)
                        ->first();
                    if ($calificacion == null) {
                        $calificacion = new Calificacion;
                    }
                    $calificacion->idActividad = $request->idActividad;
                    $calificacion->idEstudiante = $idStudent;
                    $calificacion->idPeriodo = $this->idPeriodoUser();
                    $calificacion->idInsumo = $request->idInsumo;
                    $calificacion->nota = $nota;
                    $calificacion->observacion = $request->observacionAlumnos[$idStudent];
                    if ($nota != 0) {
                        $calificacion->save();
                    }
                }
            }

            if ($validator->fails()) {

                return redirect()->back()->withErrors($validator->messages());
            } else {
                $temp = Activity::FindOrFail($request->id);
                $validarInsumo = Supply::FindOrFail($temp->idInsumo);
                if ($validarInsumo->idDocente == session('user_data')->userid || session('rol')->id == 1) {
                    if ($request->hasFile('adjuntos') && $request->file('adjuntos')->isValid()) {

                        $nombre_adjunto = $request->file('adjuntos')->getClientOriginalName();
                        $request->file('adjuntos')->storeAs('public/actividades_adjuntos', time() . '-' . $request->file('adjuntos')->getClientOriginalName());
                        $temp->adjuntos = time() . '-' . $nombre_adjunto;
                    }

                    if ($temp->nombre != $request->nombre) { //renombro el directorio donde se almacenan los deberes adjuntos en caso de que se cambie el nombre de la actividad:::::
                        $matNombre = Matter::findOrFail($request->idMateria);
                        $directory = 'public/deberes_adjuntos/curso_' . $request->idCurso . '/' . substr($matNombre->nombre, 0, 25) . '/parcial_' . $temp->parcial . '/Insumo_' . $validarInsumo->id . '/' . substr($temp->nombre, 0, 25);
                        $exists = Storage::disk('local')->exists($directory);
                        if ($exists) {
                            Storage::move($directory, 'public/deberes_adjuntos/curso_' . $request->idCurso . '/' . substr($matNombre->nombre, 0, 25) . '/parcial_' . $temp->parcial . '/Insumo_' . $validarInsumo->id . '/' . substr($request->nombre, 0, 25));
                        }
                    }

                    $temp->update([
                        'nombre' => $request->nombre,
                        'descripcion' => $request->descripcion,
                        'fechaInicio' => $request->fechaInicio,
                        'fechaEntrega' => $request->fechaEntrega,
                        'calificado' => isset($request->calificado) ? 1 : 0,
                        'recibirTareas' => isset($request->recibirTareas) ? 1 : 0,
                    ]);
                    $students = Student2Profile::getStudentsByCourse($request->idCurso);
                    $materia = Matter::find($request->idMateria);
                    if (isset($request->recibirTareas) != null) {
                        $deberes = Deber::where('idActividad', $temp->id)->get();
                        if ($deberes->isEmpty()) {
                            foreach ($students as $student) {
                                $deber = new Deber;
                                $deber->idActividad = $temp->id;
                                $deber->idPeriodo = $this->idPeriodoUser();
                                $deber->idEstudiante = $student->idStudent;
                                $deber->idProfesor = $materia->user->profile->id;
                                $deber->save();
                            }
                        }
                    } else {
                        $deber = Deber::where('idActividad', $temp->id);
                        $deber->delete();
                    }

                    // Creando nueva tarea o actividad
                    $this->mensajeActualizarTarea($students, $temp);

                    return redirect()->back()->with('message', ['type' => 'success', 'text' => 'Actividad actualizada.']);
                } else {
                    return redirect()->back()->withErrors(['No Actualizada.']);
                }
            }
        } catch (Exception $e) {
            return response()->json(['message' => $e], 500);
        }
    }

    public function stroreTempFiles(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'file' => 'required|file',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->messages(), 500);
        } else {

            $path = Storage::disk('public')->putFile('Adjuntos_Actividades', $request->file, 'public');
            return array('path' => $path);
        }
    }

    public function deleteFiles(Request $request, $idActivity)
    {
        $temp = Activity::FindOrFail($idActivity);
        $validarInsumo = Supply::FindOrFail($temp->idInsumo);

        if ($validarInsumo->idDocente == session('user_data')->id) {
            $array = json_decode($temp->adjuntos);
            $index = array_search($request->key, $array);
            unset($array[$index]);
            $temp->update([
                'adjuntos' => json_encode($array),
            ]);
            return response()->json(['message' => 'Actualizada.']);

        } else {
            return redirect()->back()->withErrors(['message' => 'No Eliminada.']);
        }

    }

    public function updateFiles(Request $request, $idActivity)
    {
        $validator = Validator::make($request->all(), [
            'file2' => 'required|file',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->messages(), 500);
        } else {
            return $request->all();
            $temp = Activity::FindOrFail($idActivity);
            $validarInsumo = Supply::FindOrFail($temp->idInsumo);

            if ($validarInsumo->idDocente == session('user_data')->id) {

                $array = array(json_decode($temp->adjuntos));
                if ($array[0] == null) {
                    $array = array();
                }

                // return response()->json(['message'=> $array]);;
                $path = Storage::disk('public')->putFile('Adjuntos_Actividades', $request->file2, 'public');
                array_push($array, $path);

                $temp->update([
                    'adjuntos' => json_encode($array),
                ]);
                return response()->json(['message' => 'Eliminada.']);

            } else {
                return redirect()->back()->withErrors(['message' => 'No Eliminada.']);
            }

        }
    }

    public function updateCalificaciones(Request $request, $activity, $student)
    {
        $nota_menor_rojo = ConfiguracionSistema::notaMenorRojo();
        $nota_menor_rojo = (int) $nota_menor_rojo->valor;
        $editar = ConfiguracionSistema::editaCalificaciones();
        if ($request->ajax()) {
            try {
                $calificacion = Calificacion::where(['idActividad' => $activity, 'idEstudiante' => $student])->first();
                if ($editar->valor == 0 && $calificacion != null) {
                } else {
                    if ($calificacion == null) {
                        $calificacion = new Calificacion;
                    }
                    $calificacion->idActividad = $activity;
                    $calificacion->idEstudiante = $student;
                    $calificacion->idPeriodo = $this->idPeriodoUser();
                    $calificacion->nota = $request->nota;
                    $calificacion->idInsumo = $request->supply;

                    $calificacion->save();

                    // Creando Notificacion
                    $nota = (int) $calificacion->nota;
                    if ($nota < $nota_menor_rojo) {
                        // $this->mensajeNotaRojo($calificacion);
                    }

                    return response()->json($calificacion, 200);
                }

            } catch (Exception $e) {
                return response()->json(['message' => $e], 500);
            }
        }
    }

    public function recuperaciones($idCurso, $idMateria)
    {
        $sabana = new \Illuminate\Support\Collection(json_decode(file_get_contents('http://' . config('app.api_host_name') . ':8081/sabana/anual/' . $this->idPeriodoUser() . '/curso/' . $idCurso)));
        $unidad = UnidadPeriodica::unidadP();
        $curso = Course::find($idCurso);
        $matter = Matter::find($idMateria);
        $students = Student2Profile::getStudentsByCourse($idCurso)->where('nivelDeIngles', $matter->nivel);
        $courses = Course::getAllCourses();
        $c = 0;
        $nota_minima = ConfiguracionSistema::notaMinima();
        $supRecuperacion = Supply::where(['nombre' => 'RECUPERATORIO', 'idMateria' => $matter->id])->first();
        $actRecuperacion1 = Activity::where(['idInsumo' => $supRecuperacion->id, 'parcial' => 'q1'])->first();
        $supletorio = Activity::where(['idInsumo' => $supRecuperacion->id, 'parcial' => 'supletorio'])->first();
        $remedial = Activity::where(['idInsumo' => $supRecuperacion->id, 'parcial' => 'remedial'])->first();
        $gracia = Activity::where(['idInsumo' => $supRecuperacion->id, 'parcial' => 'gracia'])->first();
        return view('UsersViews.docente.calificaciones.d-recuperaciones',
            compact('curso', 'students', 'matter', 'supRecuperacion', 'actRecuperacion1',
                'supletorio', 'remedial', 'gracia', 'courses', 'nota_minima',
                'unidad', 'sabana'));
    }

    public function examenQuimestral($materia, $quimestre)
    {
        $unidad = UnidadPeriodica::unidadP();
        $parciales = ParcialPeriodico::where('activo', 1)->get();
        $nota_minima = ConfiguracionSistema::notaMinima();
        $editar = ConfiguracionSistema::editaCalificaciones();
        $matter = Matter::find($materia);
        $supply = Supply::where(['idMateria' => $matter->id, 'nombre' => 'EXAMEN QUIMESTRAL'])->first();
        $courses = Course::getAllCourses();
        $students = Student2Profile::getStudentsByCourse($matter->idCurso);
        $calificaciones = Calificacion::where('idInsumo', $supply->id)->get();
        $activity = Activity::where(['idInsumo' => $supply->id, 'parcial' => $quimestre])->first();
        $un = $unidad->where('identificador', $quimestre)->first();
        $parcialP = $parciales->where('idUnidad', $un->id);
        $data = new \Illuminate\Support\Collection(json_decode(file_get_contents('http://' . config('app.api_host_name') . ':8081/libreta/periodo/' . $this->idPeriodoUser() . '/quimestre/' . $quimestre . '/curso/' . $matter->idCurso)));
        $c = 0;
        return view('UsersViews.docente.calificaciones.examen-quimestral',
            compact('matter', 'activity', 'courses', 'calificaciones', 'supply', 'students',
                'quimestre', 'nota_minima', 'unidad', 'parciales', 'un', 'parcialP', 'data', 'editar'));
    }
}
