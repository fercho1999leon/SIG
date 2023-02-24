<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Facades\Excel;
use App\PeriodoLectivo;
use App\Student2;
use App\Student2Profile;
use App\Student;
use App\Institution;
use App\Course;
use App\Libro;
use App\Career;
use Carbon\Carbon;
use App\TiempoSession;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\DB;
use Sentinel;
use Response;
use App\User;
use App\Usuario;
use App\RegistryTimeLibraryVirtual;
use App\Bibliotecavirtual;
use PDF;

class BibliotecaReportController extends Controller
{
    /**
     * Llamado a la vista principal de administracion de biblioteca 
     */
    public function index(){
        try {
            return view('UsersViews.administrador.biblioteca.students.index');
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    /**
     * Método para rellenar la tabla de los estudiantes en la sección de biblioteca
     * Se conecta con eel metodo queryStudents que realiza el query.
     */
    public function tablaEstudiantes()
    {
        $students = $this->queryStudents();
        return Datatables::of($students)
            ->addColumn('btn', 'UsersViews.administrador.biblioteca.students.accion')
            ->rawColumns(['btn'])
            ->make(true);
    }

    /**
     * Método que realiza la consulta de loos datoos del estudiante desde la tabla.
     */
    public function estudianteBiblioteca($id){
        $datos = $this->datosEstudiante($id);
        return response::json($datos, 200);
    }

    /**
     * Método para realizar la exportación del reporte en Excel desde el Modal de vista previa
     * individual por estudiante. 
     */
    public function reporteExcelindividual(Request $request){
        Excel::create('Regisstro Biblioteca Estudiante', function ($excel) use($request) {
            $datosBibliotecaEstudiante = $this->datosBibliotecaEstudiante($request->idEstudianteExcel);
            $datosEstudiante = $this->datosEstudiante($request->idEstudianteExcel);
            $titulo=['Nombre Estudiante','Numero Matricula','Nivel - Semestre', 'Fecha Ingreso','Tiempo de Lectura','Libro'];
            $excel->setTitle('Estudiante');
            $excel->setCreator('Oscar Cornejo')->setCompany('PINED');
            $excel->setDescription('Datos de Ingrso y uso de Biblioteca');
            $excel->sheet('Estudiante', function ($sheet) use ($datosBibliotecaEstudiante,$datosEstudiante,$titulo) {
                $sheet->setOrientation('landscape');
                $sheet->row(1, $titulo);
                    foreach ($datosBibliotecaEstudiante as $index => $estudiante) {
                        $sheet->row($index+2, [
                    ($datosEstudiante->nombres.' '.$datosEstudiante->apellidos), 
                    $datosEstudiante->numero_matriculacion, 
                    $datosEstudiante->grado, 
                    $estudiante->last_entry,
                    $estudiante->minutos, 
                    $estudiante->slug,
                    ]);
                    }                
            });
        })->export('xls');
        return view('UsersViews.administrador.biblioteca.imports.index');
    }

    /**
     * Método para general un reporte PDF individual por estudiante desde la vista previa.
     */
    public function reportePDFindividual(Request $request){
        $datosEstudiante = $this->datosEstudiante($request->idEstudiante);
        $datosBiblitecaEstudiante = $this->datosBibliotecaEstudiante($request->idEstudiante);
        $pdf = PDF::loadView('UsersViews.administrador.biblioteca.ebookReports.studenReport', compact(
            'datosEstudiante','datosBiblitecaEstudiante'));
        return $pdf->stream("Reporte uso de Biblioteca $datosEstudiante->ci.pdf");
    }

    /**
     * Método que realiza la consulta del tiempo de visita a la biblioteca por estudiante.
     */
    public function datosBibliotecaEstudiante($id){
           $first = DB::table('tiempoSession')->leftJoin('ebooks', 'tiempoSession.ebook_id', '=', 'ebooks.id')
       ->where('id_user','=',$id)->get();
       return  $first;
    }

    /**
     * Método que permite consultar los datos del estudiante, el tiempo y la cantidad de libros
     * que el estudiantte ha leido. 
     */
    public function datosEstudiante($id){
        $datos = Student2::select('students2.id','students2.ci','students2.nombres','students2.apellidos',
        'students2_profile_per_year.numero_matriculacion','students2_profile_per_year.idCurso',
        'students2_profile_per_year.idPeriodo','students2_profile_per_year.idStudent',
        'students2_profile_per_year.idCurso',
        'courses.grado as grado', 'courses.paralelo as paralelo','courses.id_career',
        'Career.id as idCarrer','Career.nombre as nombreCarrera')
            ->join('students2_profile_per_year', 'students2.id', '=', 'students2_profile_per_year.idStudent')
            ->join('courses', 'students2_profile_per_year.idCurso', '=', 'courses.id')
            ->join('Career', 'courses.id_career', '=', 'Career.id')
            ->where('students2.id', $id)
            ->first();
            $datos['cantidadLibros'] = TiempoSession::select(
                                                    DB::raw('count(*) as librosLeidos'))
                                                    ->where('id_user','=',$id)->pluck('librosLeidos')->first();
            $datos['tiempo'] = TiempoSession::select(
                                                DB::raw('SUM(minutos) as minutos'))
                                            ->where('id_user','=',$id)->pluck('minutos')->first();
            $datos['last_entry'] = TiempoSession::select(
                                                DB::raw('MAX(last_entry) as fecha'))
                                            ->where('id_user','=',$id)->pluck('fecha')->first();
            /**
             * Datos para reporte de biblioteca virtual
             */
            $user_id = Student2::select('users.id')
            ->join('students2_profile_per_year', 'students2.id', '=', 'students2_profile_per_year.idStudent')
            ->join('users_profile', 'students2.idProfile', '=', 'users_profile.id')
            ->join('users', 'users_profile.userid', '=', 'users.id')
            ->where('students2.id',$id)
            ->first();
            
            $seconds = intval((RegistryTimeLibraryVirtual::select(DB::raw('SUM(time_second) as time_second_sum'))
                        ->where('idUser',$user_id->id)
                        ->get())[0]->time_second_sum);
            $datos['library_time_virtual'] = sprintf('%02d:%02d:%02d', ($seconds/ 3600),($seconds/ 60 % 60), $seconds% 60);
            $datos['last_entry_virtual'] = (RegistryTimeLibraryVirtual::select(DB::raw('MAX(created_at) as last_entry'))
                                            ->where('idUser',$user_id->id)
                                            ->get())[0]->last_entry;
            $bibliotecas = RegistryTimeLibraryVirtual::where('idUser',$user_id->id)
            ->groupBy('idBibliotecavirtual')
            ->get();
            //dd($bibliotecas);
            $reporte_biblioteca_virtual = array();
            foreach($bibliotecas as $biblioteca){
                $name_biblioteca = Bibliotecavirtual::where('id',$biblioteca->idBibliotecavirtual)->pluck('name')->first();
                $seconds = intval((RegistryTimeLibraryVirtual::select(DB::raw('SUM(time_second) as time_second_sum'))
                            ->where('idBibliotecavirtual',$biblioteca->idBibliotecavirtual)
                            ->where('idUser',$user_id->id)
                            ->first())->time_second_sum);
                $library_time_virtual = sprintf('%02d:%02d:%02d', ($seconds/ 3600),($seconds/ 60 % 60), $seconds% 60);
                $last_session = (RegistryTimeLibraryVirtual::select(DB::raw('MAX(created_at) as last_entry'))
                                            ->where('idBibliotecavirtual',$biblioteca->idBibliotecavirtual)
                                            ->first())->last_entry;
                array_push($reporte_biblioteca_virtual,['name' => $name_biblioteca, 'time' => $library_time_virtual,'session' => $last_session]);
            }
            $datos['library_virtual_report'] = $reporte_biblioteca_virtual;
            //dd($datos['library_virtual_report']);
        return $datos;
    }

    
    /**
     * Método que genera un reporte general de todos los estudiantes que han ingresado a la biblioteca
     * en formato Excel, se conecta al método queryTiempoSession para obtener la consulta.
     */
    public function reportAllExcel(){
        Excel::create('Registro General de Biblioteca', function ($excel) {
            $datos = $this->queryTiempoSession();  
            $titulo=['Nombre Estudiante','Numero Matricula','Nivel - Semestre', 'Fecha Ingreso','Tiempo de Lectura','Libro'];
            $excel->setTitle('Estudiante');
            $excel->setCreator('Oscar Cornejo')->setCompany('PINED');
            $excel->setDescription('Datos de Ingreso y uso de Biblioteca');
            $excel->sheet('Estudiante', function ($sheet) use ($datos,$titulo) {
                $sheet->setOrientation('landscape');
                $sheet->row(1, $titulo);
                    foreach ($datos as $index => $dato) {
                        $sheet->row($index+2, [
                    ($dato->nombres.' '.$dato->apellidos), 
                    $dato->numero_matriculacion, 
                    $dato->grado, 
                    $dato->last_entry,
                    $dato->minutos, 
                    $dato->slug,
                    ]);
                    }                
            });
        })->export('xls');
        return view('UsersViews.administrador.biblioteca.imports.index');
}

    /**
     * Método que permite consultar todos los registros de los estudiantes que han ingresado a la biblioteca
     * y su tiempo de permanencia. 
     */
    public function reportAllPDF(){
        $datos = $this->queryTiempoSession(); 
        $i=1;
        $pdf = PDF::loadView('UsersViews.administrador.biblioteca.ebookReports.studentsReport', compact(
            'datos','i'));
        $pdf->setPaper('a4', 'landscape');
        return $pdf->stream("Reporte uso General de Biblioteca.pdf");
    }

    /**
     * Método para guardar el contador de tiempo dentro de cada método para realizar el calculo de 
     * permanencia del usuario al leer un libro. 
     */
    public function sessionHora(){
        
        $user = session('user');
        $libro = session('libro');
        $validarUsuario_libro = TiempoSession::where('id_user','=',$user)
                                            ->where('ebook_id','=',$libro)
                                            ->first();
        if($validarUsuario_libro != null){
            if($validarUsuario_libro->id_user == $user && $validarUsuario_libro->ebook_id != $libro){
                $minutos = 0;
            }else{
                $minutos = TiempoSession::where('ebook_id','=',$libro) 
                                        ->where('id_user','=',$user)
                                        ->pluck('minutos')
                                        ->first();
            }
        }else{
            $minutos = 0;
        }
        $hora = session('horaInicio');
        session(['horaInicio' => Carbon::now()]);
        $horaFin = session('horaInicio');
        $userFin = session('user');
        $minutos= $minutos+$hora->diffInMinutes($horaFin);
        $userTime = TiempoSession::where('id_user','=',$user)->where('ebook_id','=',$libro)->first();
          if($userTime != null )  {
                if($userTime->id_user == $user && $userTime->minutos >= 0 && $userTime->ebook_id == $libro){
                    $userTime->minutos =  $minutos;
                    $userTime->last_entry = $hora;
                    $userTime->save();
                }
                if($userTime->id_user == $user && $userTime->ebook_id != $libro){
        //            $minutosGuardados = $this->nuevoTiempoLectura($user,$minutos,$libro,$hora);
                    $minutosGuardados = new TiempoSession();
                    $minutosGuardados->id_user = $user;
                    $minutosGuardados->minutos = $minutos;
                    $minutosGuardados->ebook_id = $libro;
                    $userTime->last_entry = $hora;
                    $minutosGuardados->save(); 
                }
          }else{
        //    $minutosGuardados = $this->nuevoTiempoLectura($user,$minutos,$libro,$hora);
            $minutosGuardados = new TiempoSession();
                $minutosGuardados->id_user = $user;
                $minutosGuardados->minutos = $minutos;
                $minutosGuardados->ebook_id = $libro;
                //$userTime->last_entry = $hora;
                $minutosGuardados->save(); 
          }
        $minutos = 0;
        $null = null;
        session(['tiempo' =>$minutos]);
        session(['user' =>$null]);
        session(['libro' =>$null]);
    }

    /**
     * Método para crear un nuevo guardado de tiempo de lectura
     */
    public function nuevoTiempoLectura($user,$minutos,$libro,$hora){
       //dd($user,$minutos,$libro,$hora);
        $minutosGuardados = new TiempoSession();
        $minutosGuardados->id_user = $user;
        $minutosGuardados->minutos = $minutos;
        $minutosGuardados->ebook_id = $libro;
        $userTime->last_entry = $hora;
        $minutosGuardados->save(); 
        return $minutosGuardados;
    }

    /**
     * Método para iniciar el contador de tiempo dentro de cada método para realizar el calculo de 
     * permanencia del usuario al leer un libro. 
     */
    public function iniciarContador($id_ebook){
        session(['horaInicio' => Carbon::now(),
        'user' => User::where('userid','=',Sentinel::getUser()->id)->pluck('id')->first(),
        'libro' => $id_ebook
        ]);
    }

    /**
     * Método query de datos generales de los estudiantes 
     */
    public function queryStudents(){
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
            ->where('students2_profile_per_year.numero_matriculacion','!=','')
            ->where('Career.estado', 1)

            ->groupBy('students2.id')->get();
        return $students;
    }

    /**
     * Método query de datos de tiempo de sesion de los estudiantes. 
     */
    public function queryTiempoSession(){
        $datos = TiempoSession::select('students2.nombres','students2.apellidos', 
                'students2_profile_per_year.numero_matriculacion','students2_profile_per_year.idCurso',
                'courses.grado as grado', 'courses.paralelo as paralelo','courses.id_career',
                'Career.id as idCarrer','Career.nombre as nombreCarrera',
                'tiempoSession.*','ebooks.slug')
                    ->join('students2', 'tiempoSession.id_user', '=', 'students2.id')
                    ->join('students2_profile_per_year', 'students2.id', '=', 'students2_profile_per_year.idStudent')
                    ->join('courses', 'students2_profile_per_year.idCurso', '=', 'courses.id')
                    ->join('Career', 'courses.id_career', '=', 'Career.id')
                    ->leftJoin('ebooks', 'tiempoSession.ebook_id', '=', 'ebooks.id')
                    ->get(); 
        return $datos;
    }
}
