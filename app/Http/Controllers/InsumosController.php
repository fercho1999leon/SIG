<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Career;
use App\Semesters;
use App\Insumo;
class InsumosController extends Controller
{
    public function index(){
        //$semesters = Career::all();
        //$careers = Career::all();
        //return view('UsersViews.administrador.carreras.index');
        //$semesters = Semesters::find($career_id);
        //return view('UsersViews.administrador.semestres.index', compact ('semesters', 'career_id'));
        return view('UsersViews.administrador.insumos.index');
        //return view('UsersViews.administrador.carreras.index',compact('careers'));
        //return view('UsersViews.administrador.semestres.index',compact('careers'));
    }

    public function postAccedeCareer($id)
    {
        $data = Career::find($id);
        //echo $id;
        //$cursos = course::all()->where('id_career','=',$id )->where('estado','=','0');

        //$semesters = Semesters::all()->where('career_id','=',$id);
        $semesters = Semesters::all()->where('career_id','=',$id)->where('estado','=','1');
        $insumo = Insumo::all()->where('id_carrers','=','$id');
        return view('UsersViews.administrador.insumos.index', compact('data', 'id','semesters','insumo'));
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
    public function semestrePost()
    {
        //echo 'entra';
        
        //echo request('nombsemt');
        //echo request('career_id');
        // //return request('nombre');
        // //$nombre= request('nombre');
        //echo $id;
        // //return
        $courseid = request('career_id'); 

        Semesters::create([
            'nombsemt' =>  request('nombsemt'),
            'career_id' =>  request('career_id'),
            

        ]);
    		//return back()->with('message', ['type'=> 'success', 'text' =>  "Se creo con éxito el Semestre." ]);
            $data = Career::find($courseid);
           
            $semesters = Semesters::all()->where('career_id','=',$courseid)->where('estado','=','1');
            //return view('UsersViews.administrador.semestres.index',  request('career_id'));
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

        $semester->save();
        //return back()->with('message', ['type'=> 'success', 'text' =>  "Se modificó con éxito el Semestre." ]);
        $data = Career::find($courseid);
           
        $semesters = Semesters::all()->where('career_id','=',$courseid)->where('estado','=','1');
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
