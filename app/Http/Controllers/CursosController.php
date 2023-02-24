<?php

namespace App\Http\Controllers;
use Sentinel;

use Illuminate\Http\Request;
use Session;

use App\Career;
use App\Semesters;
use App\Matters;
use App\Cursos;
use App\Course;
use App\Matter;
use App\PeriodoLectivo;
use App\User;
use App\Area;
use App\estructuraCualitativa;
use Illuminate\Support\Facades\DB;


class CursosController extends Controller
{
    //private $prueba;
    public function index(){
        
        return view('UsersViews.administrador.materias.index');
        //return view('UsersViews.administrador.carreras.index',compact('careers'));
        //return view('UsersViews.administrador.semestres.index',compact('careers'));
    }

    /*public function GetMatterFlux(){
		//echo 'entra';
		//echo $id;
		echo json_encode(DB::table('Matter')->where('estado','=','1')->get());
        //echo json_encode(DB::table('Matter')->where('estado','=','1')->where('career_id',$id)->get());

   }*/
    /*
   public function GetMatterFlux(Request $request){
       $search = $request->search;
    //echo 'entra';
    //echo $id;
    //echo json_encode(DB::table('Matter')->where('estado','=','1')->get());
    


        if($search == ''){
            $materias = Matter ::all()->where('estado','=','1')->get();

        }else{
            $materias = Matter ::all()->where('estado','=','1')->where('nombre','like','%'.$search.'%')->get();
        }




        $response = array();

        foreach($materias as $matter){
            $response[] = array(
                "id"=> $matter->id,
                "text"=> $matter->nombre
            );
        }
        echo json_encode($response);
    



    //echo json_encode(DB::table('Matter')->where('estado','=','1')->where('career_id',$id)->get());
    //echo json_encode(DB::table('Matter')->where('estado','=','1')->get());

    }
    */


    


    
    //$id
    public function postAccedeCurso(Request $request, $id)
    {
        $data = Semesters::find($id);
        $curst = course::where("id_semester", $id)
                        ->first();
        if($curst == null){
            $cursto = new course();
            $cursto->nombre ="NO DEFINIDO";
        }else{
           
            $cursto =$curst;
        }

        $cursos = course::where("id_semester", $id)
                         ->where('estado','=','1')->get();
        $docentes = User::all() ->where('cargo', 'Docente');

 
        $idCurso = Matter::select('Career.id')->where('Career.estado','=','1')->where('courses.id_career','=',$id)
        ->join('courses', 'matters.idCurso', '=','courses.id')
        ->join('Semesters','courses.id_career','=','Semesters.id')
        ->join('Career','Semesters.career_id','=','Career.id')
        ->first();      
      

        $areas = Area::where('idPeriodo',  Sentinel::getUser()->idPeriodoLectivo)->get();
        $cualitativas = estructuraCualitativa::All();
        
  
        return view('UsersViews.administrador.cursos.index', compact('matters','data', 'id','cursos','cursto','docentes','areas','cualitativas','materias'));
        //return view('UsersViews.administrador.cursos.index', compact('matters','data', 'career_id','cursos','curst','docentes','areas','cualitativas'));

    }

    public function GetMatterFlux(Request $request)
    {   //$var = $this->postAccedeCurso($idCurso);
        //$var = $this->postAccedeCurso($id);
        //$role = $this->postAccedeCurso($id);
        $probando=Session::get('prueba');
        //$id_carrera = \Session::get('idcarrera');
        //echo($id_carrera);
        //dd($id_carrera);
        //$idCurso = $request->$idCurso;
        //$var=$this->prueba->id;

        //$value = session('idCurso');

        $data = [];

        
        /*
        $data = DB::table("matters")
            		->select("id","nombre")->where('estado','=','1')
            		->get();
        */
        
        

        
        $idCurso = Matter::select('Career.id')->where('Career.estado','=','1')->where('courses.id_career','=',$probando)
        ->join('courses', 'matters.idCurso', '=','courses.id')
        ->join('Semesters','courses.id_career','=','Semesters.id')
        ->join('Career','Semesters.career_id','=','Career.id')
        ->first();
        

        //$data = DB::table("matters")
        //    ->select("id","nombre")->where('matters.estado','=','1')
       
       $data = Matter::select('matters.id','matters.nombre')->where('matters.estado','=','1')
            ->where('Career.id','=', $idCurso->id)
            ->join('courses', 'matters.idCurso', '=','courses.id')
            ->join('Semesters','courses.id_career','=','Semesters.id')
            ->join('Career','Semesters.career_id','=','Career.id')
            ->get();
          
        
        return response()->json($data);
    }

    public function listarOpcionesMaterias(){
        return view('UsersViews.administrador.materias.opcionesCarreras');
    }
   
    public function creaSemestreCurso($id){
        
        $periodos = PeriodoLectivo::all();
        $semesters = Semesters::where('career_id', '=', \Session::get('idcarrera'))
                               ->where('estado', '=', 1)
                               ->get();
        return view('UsersViews.administrador.cursos.crear', compact('id','periodos', 'semesters'));
    }

    //agregue
    public function createMaterias(){
        return view('UsersViews.administrador.materias.crear');
    }

    

    public function cursoPost(Request $request)
    {   
            $semesterId       = $request->semester_id;
            $esprimersemestre = 0;
            if(request('esprimersemestre') != null)
            {
                $esprimersemestre = 1;
            }
            $periodos = PeriodoLectivo::all();
            $id_carrera = \Session::get('idcarrera');
            course::create([
                'grado'             =>  request('grado'),
                'id_career'         =>  $id_carrera, 
                'paralelo'          =>  request('paralelo'),
                'nEstudiantes'      =>  request('nEstudiantes'),             
                'idPeriodo'         =>  request('idPeriodo'), 
                'cupos'             =>  request('nEstudiantes'),
                'esprimersemestre'  =>  $esprimersemestre,
                'id_semester'       =>  $semesterId
            ]);
            return redirect()->route('cursos_accede_post', $semesterId);


    }



    public function postUpdateCurso(course $curso)
    {
        $periodos = PeriodoLectivo::all();
        $grados = [
            '1' => 'Primer Semestre',
            '2' => 'Segundo Semestre',    
            '3' => 'Tercer Semestre',    
            '4' => 'Cuarto Semestre',    
            '5' => 'Quinto Semestre',    
            '6' => 'Sexto Semestre',    
            '7' => 'Septimo Semestre',    
            '8' => 'Octavo Semestre',    
            '9' => 'Noveno Semestre',    
            '10' => 'Decimo Semestre',    
        ];
        return view('UsersViews.administrador.cursos.edit', compact('curso','periodos','grados'));
    }

    public function UpdateCurso(Request $request, course $curso)
    {
        $esprimersemestre = 0;
        if($request->esprimersemestre != null)
        {
            $esprimersemestre = 1;
        }
        //$courseid = request('id_career');
        $curso->grado = $request->grado;
        $curso->id_career = $request->id_career;
        $curso->paralelo = $request->paralelo;
        $curso->nEstudiantes = $request->nEstudiantes;
        $curso->idPeriodo = $request->idPeriodo;
        $curso->esprimersemestre = $esprimersemestre;
        $curso->save();
        //dd($curso,$request->grado,$request);
        //$data = Semesters::find($courseid);      
        //$cursos = course::where('id_career','=',$courseid )->where('estado','=','1')->get();
        return redirect()->route('cursos_accede_post', $curso->id_semester);
    }




    
    public function postDeleteCurso($id)
    {
        $data = course::findOrFail($id);
        $data->estado=0;
        $data->save();
        return redirect()->back()->with('message', ['type' => 'success', 'text' =>  "Curso Eliminado."]);   
    }
    /*
    public function postDeleteCareer(Career $career)
    {
        try {
            
            //$career_Sentinel = Sentinel::findById($carrera->carrerid);  
            //$career_Sentinel->delete();
            $career->delete();
            return redirect()->back()->with('message', ['type' => 'success', 'text' =>  "Materia Eliminada."]);
        } catch (Exception $e) {
            return redirect()->back()->with('message', ['type' => 'danger', 'text' =>  "Algo salió mal."]);
        }
    }

    public function postUpdateCareer(Career $career)
    {
        return view( 'UsersViews.administrador.carreras.edit',[
            'career'->$career
        ]);
    }*/
}
