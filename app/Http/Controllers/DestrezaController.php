<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Sentinel;
use App\Administrative;
use App\Matter;
use App\Student2;
use App\Course;
use App\Supply;
use App\Activity;
use App\ActivityStudent;
use App\Destreza;
use App\Clasesdestreza;
use App\Student2Profile;
use App\calificacionCualitativaAmbitos;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Input;
use App\Http\Controllers\Controller;
use DB;

class DestrezaController extends Controller
{
    /*
        D O C E N T E
    */
    public function home(){
        $courses = Course::getAllCourses();
        try {
			$materias = Matter::with('curso')
				->where('idPeriodo', $this->idPeriodoUser())
				->where('idDocente', session('user_data')->userid)->get()
				->groupBy('curso.grado');
               return view('UsersViews.docente.destrezas.index', compact('courses', 'materias'));
        } catch (Exception $e) {

            return $e->getMessage();
        }
    }

    public function showDestrezas($idMateria, $parcial){
        $courses = Course::getAllCourses();
        $teachers = Administrative::all();
        $destrezasArray=[];
        try {
            //Validar si el docente esta ligado a la materia
			$validar = Matter::FindOrFail($idMateria);
            if($validar->idDocente == session('user_data')->userid || session('user_data')->cargo=='Administrador' ){
                $students = Student2Profile::getStudentsByCourse($validar->idCurso);
                $course = Course::getCoursesByCourse($validar->idCurso);
				$destrezas = DB::table('destrezas')
                    ->join('clasesdestrezas', 'destrezas.id', '=', 'clasesdestrezas.idDestrezas')
                    ->where('destrezas.idMateria', '=', $validar->id)
                    ->where('clasesdestrezas.parcial', strtoupper($parcial))
                    ->select('destrezas.id', 'destrezas.nombre', 'clasesdestrezas.parcial', 'clasesdestrezas.id as id_destreza')
                    ->get();
                $destrezasCreadas = DB::table('destrezas')
                    ->where('idMateria', '=', $validar->id)
                    ->orderBy('id', 'DESC')
                    ->get();
                $clasedestrezas=Clasesdestreza::all();
                if(strpos($course->grado, 'Inicial') !== false || strpos($course->grado, 'Primero') !== false){
                    $jsonClases=$clasedestrezas->toJson();
                    return view('UsersViews.docente.destrezas.showDestrezas', compact('destrezasCreadas',
                        'courses', 'parcial', 'teachers','destrezas','clasedestrezas','jsonClases'))
                        ->with(['Students' =>  $students,'Course' => $course, 'Matter' =>  $validar]);
                }else
                    return redirect()->back()->withErrors(['denied' =>  'Sección solo permitida para grados iniciales y primer grado']);
            }else

            return redirect()->back()->withErrors(['denied' =>  'Materia Solicitada no pertenece a Docente.']);

        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {

            return redirect()->back()->withErrors(['denied' =>  'Materia Solicitada no pertenece a Docente.']);
        }
    }

    public function showClaseDestrezas($idMateria, $parcial, $idDestreza){
        $courses = Course::getAllCourses();
        $teachers = Administrative::all();
        $destrezasArray=[];
        try {
            //Validar si el docente esta ligado a la materia
            $validar = Matter::FindOrFail($idMateria);
            if($validar->idDocente == session('user_data')->userid || session('user_data')->cargo=='Administrador' ){
                $students = Student2::getStudentsByCourse($validar->idCurso);
                $course = Course::getCoursesByCourse($validar->idCurso);
                $destreza=Destreza::FindOrFail($idDestreza);
                $clasedestrezas=Clasesdestreza::where('idDestrezas', $destreza->id)->where('parcial', $parcial)->get();
                if(strpos($course->grado, 'Inicial') !== false || strpos($course->grado, 'Primero') !== false){
                  $jsonClases=$clasedestrezas->toJson();
                  return view('UsersViews.docente.destrezas.showClaseDestreza', compact('courses', 'parcial', 'teachers','destreza','clasedestrezas','jsonClases'))->with(['Students' =>  $students,'Course' => $course
                      ,'Matter'   =>  $validar]);
                }else
                return redirect()->back()->withErrors(['denied' =>  'Sección solo permitida para grados iniciales y primer grado']);
            }else
            return redirect()->back()->withErrors(['denied' =>  'Materia Solicitada no pertenece a Docente.']);

        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return redirect()->back()->withErrors(['denied' =>  'Materia Solicitada no pertenece a Docente.']);
        }
    }

    public function crear(){
        $courses = Course::getAllCourses();
        $arrayCourses=collect([]);
        try {
            $matters = Matter::getMattersByProfessor(session('user_data')->id);
        } catch (Exception $e) {

            return $e->getMessage();
        }
        $arrayCourses = Course::whereIn('id', $matters->pluck('idCurso'))->get();

        return view('UsersViews.docente.destrezas.crearDestrezas', compact('arrayCourses', 'matters','courses'));
    }

    public function getSubjects(){
        $input = Input::get('grado');
        $user_profile = Administrative::findBySentinelid(session('user_data')->userid);
        $subjects = DB::table('matters')
                        ->join('courses', function ($join) use ($input,$user_profile) {
                            $join->on('matters.idCurso', '=', 'courses.id')
                            ->where('courses.grado', '=', $input);
                        })
        ->select( 'matters.id', 'matters.nombre','courses.grado','courses.paralelo')
        ->get();

        return response()->json($subjects);
    }

    public function store(Request $request){
        if ($request->addToLis){
        $destreza = new Destreza();
        $destreza->grado=$request->grado;
        $destreza->idMateria=$request->idMateriaGrado;
        $destreza->nombre=$request->nombre;
        $destreza->descripcion=$request->desc;
        $destreza->idPeriodo = $this->idPeriodoUser();
        $destreza->save();
        $claseDestreza = new Clasesdestreza();
        $claseDestreza->idDestrezas=$destreza->id;
        $claseDestreza->parcial=$request->parcial;
        $claseDestreza->calificacion="{}";
        $claseDestreza->idPeriodo = $this->idPeriodoUser();
        $claseDestreza->save();
        $idMateria=$request->idMateriaGrado;

        return redirect()->route('showDestrezasMateria', ['idMateria' => $idMateria, $request->parcial]);
        }else{
        $destreza = new Destreza();
        $destreza->grado=$request->grado;
        $destreza->idMateria=$request->idMateriaGrado;
        $destreza->nombre=$request->nombre;
        $destreza->descripcion=$request->desc;
        $destreza->idPeriodo = $this->idPeriodoUser();
        $destreza->save();

        return redirect()->route('showDestrezasMateria', ['idMateria' => $request->idMateriaGrado, $request->parcial]);
    }
    }

    public function update(Request $request){
        $destreza = Destreza::FindOrFail($request->id);
        $destreza->grado=$request->grado;
        $destreza->idMateria=$request->idMateriaGrado;
        $destreza->nombre=$request->nombre;
		$destreza->descripcion=$request->desc;
		$destreza->save();
        //return 'dentro'.$request->desc;
        return redirect()->route('showDestrezasMateria', [$request->idMateriaGrado, $request->parcial]);
    }

    public function updateClaseDestreza(Request  $request){
        $clasesdestreza = Clasesdestreza::find($request->id);
        $clasesdestreza->calificacion = $request->notas;

        $clasesdestreza->save();
    }

    public function editar($id, $parcial){
        $destreza = Destreza::FindOrFail($id);
        $courses = Course::getAllCourses();
        $arrayCourses=collect([]);
        foreach($courses  as $course){
            if(strpos($course->grado, 'Inicial') !== false || $course->grado ==='Primero'){
                $arrayCourses->push($course);
            }
        }
        $arrayCourses = $arrayCourses->unique('grado');
        $matters = Matter::all();

        return view('UsersViews.docente.destrezas.editDestreza', compact('arrayCourses', 'matters','courses','destreza', 'parcial'));
    }
     public function editar_js($id, $parcial){
        $destreza = Destreza::FindOrFail($id);
        return $destreza;

       //return Response::json($id);
    }

    public function destroy($id, $parcial){
        $destreza = Destreza::FindOrFail($id);
        $idMateria=$destreza->idMateria;
        Destreza::destroy($id);

        return redirect()->route('showDestrezasMateria', [$idMateria, $parcial]);
    }
    public function enlace($id, $parcial){
         $enlace = Clasesdestreza::FindOrFail($id);
         $destreza = Destreza::FindOrFail($enlace->idDestrezas);
         $idMateria=$destreza->idMateria;
         Clasesdestreza::destroy($id);
        return redirect()->route('showDestrezasMateria', [$idMateria, $parcial]);
    }

    // public function destroyClaseDestreza(Request $request){
    //     $claseDestreza = Clasesdestreza::FindOrFail($request->idClaseDestreza);
    //     $idDestreza=$claseDestreza->idDestrezas;
    //     $destreza = Destreza::FindOrFail($idDestreza);
    //     Clasesdestreza::destroy($claseDestreza->id);

    //     return redirect()->route('showDestrezasMateria', ['idMateria' => $destreza->idMateria]);
    // }

    public function crearClaseDestreza(Request $request){
        if (is_array($request->idDestreza)){// esto para determinar si se guardan varias destrezas
            foreach ($request->idDestreza as $destreza) {
               $observacion = $request->input('obs'.$destreza);
               $existe = Clasesdestreza::where('idDestrezas',$destreza)
               ->where('parcial',$request->parcial)
               ->exists();
               if (!$existe) {
                //return'dentro';
                $claseDestreza = new Clasesdestreza();
                $claseDestreza->idDestrezas=$destreza;
                $claseDestreza->parcial=$request->parcial;
                $claseDestreza->observacion=$observacion;
                $claseDestreza->calificacion="{}";
                $claseDestreza->idPeriodo = $this->idPeriodoUser();
                $claseDestreza->save();
               }


            }

        }else{if($request->idDestreza!=null){
             $existe = Clasesdestreza::where('idDestrezas',$request->idDestreza)
               ->where('parcial',$request->parcial)
               ->exists();
               if (!$existe) {
        $claseDestreza = new Clasesdestreza();
        $claseDestreza->idDestrezas=$request->idDestreza;
        $claseDestreza->parcial=$request->idParcial.$request->idQuimestre;
        $claseDestreza->observacion=$request->observacion;
		$claseDestreza->calificacion="{}";
		$claseDestreza->idPeriodo = $this->idPeriodoUser();
        $claseDestreza->save();
        }
        }else {return Redirect::back()->withErrors(['error' => 'NO se agrego destreza.']);}
        }
         $idMateria=$request->idMateria;
         return redirect()->route('showDestrezasMateria', ['idMateria' => $idMateria, $request->parcial]);
    }


    /*

        A D M I N I S T R A D O R

    */
    public function homeAdmin(){
        $coursesEI = Course::getCourse('EI');
		$coursesPrimaria = Course::query()
			->where('idPeriodo', $this->idPeriodoUser())
			->where('grado', 'Primero')
			->get();
        return view('UsersViews.administrador.destrezas.index',  compact('coursesEI', 'coursesPrimaria'));
    }

    public function homeCurso($idCurso){
        try {
            $matters = DB::table('matters')
            ->join('courses', function ($join){
                $join->on('matters.idCurso', '=', 'courses.id');
            })
            ->select('matters.*', 'matters.id', 'matters.nombre')
            ->where('courses.grado', '=', 'Incial 1')
            ->orwhere(function ($query) {
                $query->where('courses.grado', '=', 'Inicial 1')
                      ->orwhere('courses.grado', '=', 'Inicial 2')
                      ->orwhere('courses.grado', '=', 'Primero');
			})
			->where('matters.idPeriodo', $this->idPeriodoUser())
            ->where('courses.id', $idCurso)
			->get();
			$course = Course::find($idCurso);

            return view('UsersViews.administrador.destrezas.indexCursoDestrezas', compact('course'))->with(['Matters'    =>  $matters]);
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function showDestrezasAdmin($idMateria, $parcial){
        $courses = Course::getAllCourses();
        $teachers = Administrative::all();
        $destrezasArray=[];
            $validar = Matter::FindOrFail($idMateria);
                $students = Student2Profile::getStudentsByCourse($validar->idCurso);
                $course = Course::getCoursesByCourse($validar->idCurso);
				$destrezas = DB::table('destrezas')
				->join('clasesdestrezas', 'destrezas.id', '=', 'clasesdestrezas.idDestrezas')
				->where('destrezas.idMateria', '=', $validar->id)
				->where('clasesdestrezas.parcial', strtoupper($parcial))
				->select('destrezas.id', 'destrezas.nombre', 'clasesdestrezas.parcial')
				->get();

			$destrezasCreadas = DB::table('destrezas')
                ->where('idMateria', '=', $validar->id)
				->get();

                $clasedestrezas=Clasesdestreza::all();
                if(strpos($course->grado, 'Inicial') !== false || strpos($course->grado, 'Primero') !== false){
                  $jsonClases=$clasedestrezas->toJson();
				  return view('UsersViews.administrador.destrezas.showDestrezas', compact('courses', 'course', 'teachers',
				  'destrezas','clasedestrezas','destrezasCreadas', 'jsonClases', 'parcial'))->with(['Students' =>  $students,'Course' => $course
                      ,'Matter'   =>  $validar]);
                }else
                {
                  return redirect()->back()->withErrors(['denied' =>  'Sección solo permitida para grados iniciales y primer grado']);

                }
    }

    public function showClaseDestrezasAdmin($idMateria, $parcial, $idDestreza){
        $courses = Course::getAllCourses();
        $teachers = Administrative::all();
        $destrezasArray=[];
        try {
				$validar = Matter::FindOrFail($idMateria);
                $students = Student2::getStudentsByCourse($validar->idCurso);
                $course = Course::getCoursesByCourse($validar->idCurso);
                $destreza=Destreza::FindOrFail($idDestreza);
				$clasedestrezas=Clasesdestreza::where('idDestrezas', $destreza->id)->where('parcial', $parcial)->get();
                if(strpos($course->grado, 'Inicial') !== false || strpos($course->grado, 'Primero') !== false){
                  $jsonClases=$clasedestrezas->toJson();
                  return view('UsersViews.administrador.destrezas.showClaseDestreza', compact('course', 'parcial', 'destreza','clasedestrezas','jsonClases'))->with(['Students' =>  $students,'Course' => $course
                      ,'Matter'   =>  $validar]);
                }else
                return redirect()->back()->withErrors(['denied' =>  'Sección solo permitida para grados iniciales y primer grado']);

        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return redirect()->back()->withErrors(['denied' =>  'Materia Solicitada no pertenece a Docente.']);
        }
    }

    public function crearAdmin(){
  		$courses = Course::getAllCourses();
        $arrayCourses = collect([]);
        foreach($courses  as $course){
            if(strpos($course->grado, 'Inicial') !== false || $course->grado ==='Primero'){
                $arrayCourses->push($course);
            }
        }
        $arrayCourses = $arrayCourses->unique('grado');
  		$matters = Matter::getAllSubjects();
  		return view('UsersViews.administrador.destrezas.crearDestrezas',compact('arrayCourses', 'matters','courses'));
  	}

    public function getSubjectsAdmin(){
        $input = Input::get('grado');
        $subjects = DB::table('matters')
                    ->join('courses', function ($join) use ($input) {
                        $join->on('matters.idCurso', '=', 'courses.id')
                        ->where('courses.grado', '=', $input);
					})
					->where('matters.idPeriodo', $this->idPeriodoUser())
                    ->select('matters.*', 'matters.id', 'matters.nombre','courses.grado','courses.paralelo')
                    ->get();

        return response()->json($subjects);
    }

    public function storeAdmin(Request $request){
        $destreza = new Destreza();
        $destreza->grado=$request->grado;
        $destreza->idMateria=$request->idMateriaGrado;
		$destreza->nombre=$request->nombre;
		$destreza->idPeriodo = $this->idPeriodoUser();
        $destreza->descripcion=$request->desc;
        $destreza->save();

        return redirect()->route('destrezasAdmin');
    }

    public function updateAdmin(Request $request){
        $destreza = Destreza::FindOrFail($request->id);
        $destreza->grado=$request->grado;
        $destreza->idMateria=$request->idMateriaGrado;
        $destreza->nombre=$request->nombre;
        $destreza->descripcion=$request->desc;
        $destreza->save();
        $idMateria=$request->idMateriaGrado;

        return redirect()->route('showDestrezasMateriaAdmin', [$idMateria, $request->parcial]);
    }

    public function updateClaseDestrezaAdmin(Request  $request){
        $clasesdestreza = Clasesdestreza::find($request->id);
        $clasesdestreza->calificacion = $request->notas;
        $clasesdestreza->save();
    }

    public function editarAdmin($idMateria, $parcial, $idDestreza){
        $destreza = Destreza::FindOrFail($idDestreza);
  		$courses = Course::getAllCourses();
        $arrayCourses=collect([]);
        foreach($courses  as $course){
            if(strpos($course->grado, 'Inicial') !== false || $course->grado ==='Primero'){
                $arrayCourses->push($course);
            }
        }
        $arrayCourses = $arrayCourses->unique('grado');
  		$matters = Matter::all();

  		return view('UsersViews.administrador.destrezas.editDestreza', compact('arrayCourses', 'matters','courses','parcial', 'idMateria', 'destreza'));
  	}

    public function destroyAdmin($id, $parcial){
        $destreza = Destreza::FindOrFail($id);
        $idMateria=$destreza->idMateria;
        Destreza::destroy($id);

        return redirect()->route('showDestrezasMateriaAdmin', [$idMateria, $parcial]);
    }

    // public function destroyClaseDestrezaAdmin(Request $request){
    //     $claseDestreza = Clasesdestreza::FindOrFail($request->idClaseDestreza);
    //     $idDestreza=$claseDestreza->idDestrezas;
    //     $destreza = Destreza::FindOrFail($idDestreza);
    //     Clasesdestreza::destroy($claseDestreza->id);

    //     return redirect()->route('showDestrezasMateriaAdmin', ['idMateria' => $destreza->idMateria]);
    // }

    public function crearClaseDestrezaAdmin(Request $request,$idMateria, $parcial){
        $claseDestreza = new Clasesdestreza();
        $claseDestreza->idDestrezas=$request->idDestreza;
        $claseDestreza->parcial=$request->idParcial.$request->idQuimestre;
		$claseDestreza->observacion=$request->observacion;
		$claseDestreza->idPeriodo = $this->idPeriodoUser();
        $claseDestreza->calificacion="{}";
        $claseDestreza->save();

        return redirect()->route('showDestrezasMateriaAdmin', [$idMateria, $parcial]);
    }
    public function CalificacionQuimestral(Request $request){
        foreach ($request->CQ_estudiante as $key => $studiante) {
             /* $existe = calificacionCualitativaAmbitos::where('idStudent',$studiante)
              ->where('Parcial',$request->C_parcial)
              ->where('idMateria',$request->C_materia)
              ->first();*/
              $existe = calificacionCualitativaAmbitos::NotaCualitativaQuimestral($request->C_materia,$studiante,$request->C_parcial);
              if ($existe==null) {
                $CCQ = new calificacionCualitativaAmbitos();
                $CCQ->Parcial          =$request->C_parcial;
                $CCQ->Calificacion     =$request->Calif_Cualitativa[$key];
                $CCQ->idStudent        =$studiante;
                $CCQ->idMateria        =$request->C_materia;
                $CCQ->save();
              }else{
                $CCQ =  calificacionCualitativaAmbitos::FindOrFail($existe->id);
                $CCQ->Calificacion     =$request->Calif_Cualitativa[$key];
                $CCQ->save();
              }

        }
           return redirect()->route('showDestrezasMateria', ['idMateria' => $request->C_materia, $request->C_parcial]);

    }
}
