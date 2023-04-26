<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Career;
use Illuminate\Support\Facades\DB;
use Sentinel;
class CarrerasController extends Controller
{
    public function index(){

        //$cursos = course::all()->where('id_career','=',$id )->where('estado','=','0');
        $user = Sentinel::getUser();
        $cursos = DB::table('matters')
			->join('courses', 'matters.idCurso', '=', 'courses.id')
			->where('matters.idDocente', $user->id)
			//->select('courses.id', 'matters.id as materiaId', 'courses.grado', 'courses.especializacion', 'courses.paralelo', 'matters.nombre as materia')
			->get();
        $careers = Career::all()->where('estado','=','1')->whereIn('id',$cursos->pluck('id_career'));
        //dd($careers);
        //$careers = Career::all();
        //----ORIGINAL----$careers = Career::all()->where('estado','=','1');
        //return view('UsersViews.administrador.carreras.index');
        return view('UsersViews.administrador.carreras.index',compact('careers'));
    }


    public function reportes(){

        //$cursos = course::all()->where('id_career','=',$id )->where('estado','=','0');

        //$careers = Career::all();
        $careers = Career::all()->where('estado','=','1');
        //return view('UsersViews.administrador.carreras.index');
        return view('UsersViews.secretaria.carreras.index',compact('careers'));
    }


    public function listaCarrera(){ 
        
        $careers = Career::all()->where('estado','=','1');
        return view('UsersViews.administrador.configuraciones.listacarrera',compact('careers'));
    }

    public function listarOpcionesCarrerasReporte(Request $request){
        $idcarrera = $request->idcarrera;
        \Session::put('idcarrera', $idcarrera);
        return view('UsersViews.secretaria.carreras.opcionesCarreras', compact('idcarrera'));
    }   



    public function listarOpcionesCarreras(Request $request){
        $idcarrera = $request->idcarrera;
        \Session::put('idcarrera', $idcarrera);
        return view('UsersViews.administrador.carreras.opcionesCarreras', compact('idcarrera'));
    }
   
    //agregue
    public function createCarreras(){
        return view('UsersViews.administrador.carreras.crear');
    }    

    //Request $request
    public function carreraPost()
    {
        //return request('nombre');
        //$nombre= request('nombre');

        //return
        Career::create([
            'nombre' =>  request('nombre'),
            'costo_matricula' =>  request('precioMatricula'),

        ]);
    		return back()->with('message', ['type'=> 'success', 'text' =>  "Se creo con éxito la carrera." ]);
            //$careers = Career::all()->where('estado','=','1');

        //return view('UsersViews.administrador.carreras.index',compact('careers'));
            //return view('UsersViews.administrador.configuraciones.cursosEdicion',compact('careers'));


    }

    public function postDeleteCareer($id)
    {
        $data = Career::findOrFail($id);
        //echo ('valorest');
        //echo ($data->estado);
        $data->estado=0;
        //echo('vac');
        //echo($data->estado);
        $data->save();
        return redirect()->back()->with('message', ['type' => 'success', 'text' =>  "Carrera Eliminada."]);
       
        //try {
            
            //$career_Sentinel = Sentinel::findById($carrera->carrerid);  
            //$career_Sentinel->delete();
        //    $data = Career::findOrFail($id);

        //    $data->delete();
            //$career->delete();
        //    return redirect()->back()->with('message', ['type' => 'success', 'text' =>  "Carrera Eliminada."]);
        //} catch (Exception $e) {
        //    return redirect()->back()->with('message', ['type' => 'danger', 'text' =>  "Algo salió mal."]);
        //}
    }

    /*public function postUpdateCareer(Career $career)
    {
        return view( 'UsersViews.administrador.carreras.edit',[
            'career'->$career
        ]);
    }
    */
    public function postUpdateCareer(Career $career)
    {
        //$data = Career::find($id);
        return view('UsersViews.administrador.carreras.edit', compact('career'));
        //return $career;
    }
    public function UpdateCareer(Request $request, Career $career)
    {
        //echo 'en';
        //return $career;
        //return $request->all();
        $career->nombre = $request->nombre;
        $career->costo_matricula = $request->precioMatricula;

        //return $career;
        $career->save();
        return back()->with('message', ['type'=> 'success', 'text' =>  "Se modificó con éxito la carrera." ]);
        //$careers = Career::all()->where('estado','=','1');

        //return view('UsersViews.administrador.carreras.index',compact('careers'));
        //return view('UsersViews.administrador.configuraciones.cursosEdicion',compact('careers'));
    }

    

}
