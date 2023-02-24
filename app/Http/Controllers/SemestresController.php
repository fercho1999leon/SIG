<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Career;
use App\Course;
use App\Semesters;
use App\Matter;
class SemestresController extends Controller
{
    public function index(){
        //$semesters = Career::all();
        //$careers = Career::all();
        //return view('UsersViews.administrador.carreras.index');
        //$semesters = Semesters::find($career_id);
        //return view('UsersViews.administrador.semestres.index', compact ('semesters', 'career_id'));
        return view('UsersViews.administrador.semestres.index');
        //return view('UsersViews.administrador.carreras.index',compact('careers'));
        //return view('UsersViews.administrador.semestres.index',compact('careers'));
    }

    public function postAccedeCareer($id)
    {
        \Session::put('idcarrera', $id);

        $semesters = Semesters::all()->where('career_id','=',$id)->where('estado','=','1');
        //dd($semesters);
        return view('UsersViews.administrador.semestres.index', compact( 'id','semesters'));
    }

    /*
    public function createSemestreAccede($id)
    {
        $data = Career::find($id);
        return view('UsersViews.administrador.semestres.crear', compact('data', 'id'));
    }
    */

    public function listarOpcionesSemestres(){
        return view('UsersViews.administrador.semestres.opcionesCarreras');
    }
   

    public function creaCarreraSemestre($id){        
        return view('UsersViews.administrador.semestres.prueba', compact('id'));
    }


    //agregue
    public function createSemestres(){
        return view('UsersViews.administrador.semestres.crear');
    }

    //Request $request
    public function semestrePost(Request $request)
    {
        $careerId = \Session::get('idcarrera');
        $semester =   Semesters::create([
            'nombsemt' =>  request('nombsemt'),
            'career_id' =>  $careerId,
            'cuotas' => request('cuotas'),
            'costo_semestre' => request('costo_semestre'),         
            'inicio_semestre' => request('fecha_inicio_semestre'),
            'vencimiento_cuotas' => request('tiempo_vencimiento_cuota'), 
        ]);
        $semester->save();    
        $data = Career::find($careerId);        
        $semesters = Semesters::all()->where('career_id','=',$careerId)->where('estado','=','1');
        return redirect()->route('carrera_accede_post', request('career_id')); 
    }
    
    public function postDeleteSemester($id)
    {
        $data = Semesters::findOrFail($id);
        //echo ('valorest');
        //echo ($data->estado);
        $data->estado=0;
        //echo('vac');
        //echo($data->estado);
        $data->save();
        return redirect()->back()->with('message', ['type' => 'success', 'text' =>  "Semestre Eliminado."]);
       
        //try {
            
            //$career_Sentinel = Sentinel::findById($carrera->carrerid);  
            //$career_Sentinel->delete();
        //    $data = Semesters::findOrFail($id);

        //    $data->delete();
            //$career->delete();
        //    return redirect()->back()->with('message', ['type' => 'success', 'text' =>  "Semestre Eliminado."]);
        //} catch (Exception $e) {
        //    return redirect()->back()->with('message', ['type' => 'danger', 'text' =>  "Algo salió mal."]);
        //}
    }


    public function postUpdateSemester(Semesters $semester)
    {
       
        return view('UsersViews.administrador.semestres.edit', compact('semester'));
    }

    public function UpdateSemester(Request $request, Semesters $semester)
    {
        $courseid = request('career_id'); 

        $semester->nombsemt = $request->nombsemt;
        $semester->career_id = $request->career_id;
        $semester->cuotas = $request->cuotas;
        $semester->costo_semestre = $request->costo_semestre;
        $semester->vencimiento_cuotas = $request->tiempo_vencimiento_cuota;
        $semester->inicio_semestre = $request->fecha_inicio_semestre;
 
        $semester->save();
        //return back()->with('message', ['type'=> 'success', 'text' =>  "Se modificó con éxito el Semestre." ]);
        $data = Career::find($courseid);
           
        $semesters = Semesters::all()->where('career_id','=',$courseid)->where('estado','=','1');

        $curst = course::join("Career", "Career.id", "=", "courses.id_career")
        ->select("Career.nombre")->where("courses.id_career","=", \Session::get('idcarrera'))                     
        ->first();

         $cursos = course::all()->where('id_career','=', \Session::get('idcarrera') )->where('estado','=','1');
        
         $idCurso = Matter::all()->where('idCurso', '=',1);
        
       //  dd($data->id);
 

        //dd($cursos);

            //return view('UsersViews.administrador.semestres.index',  request('career_id'));
        return redirect()->route('carrera_accede_post', request('career_id'));
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
