<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Career;
use App\Semesters;
use App\Matters;
use App\Course;
use App\PeriodoLectivo;
use App\Matter;
use App\User;

use Sentinel;




class MateriasController extends Controller
{
    public function index(){
        
        return view('UsersViews.administrador.materias.index');
    
    }

    public function postAccedeSemester($id)
    {
        $data = course::find($id);    
        $matter = Matter::all()->where('idCurso','=',$id)->where('estado','=','1');
        //$matter = Matter::all()->where('idCurso','=',$id);
        return view('UsersViews.administrador.materias.index', compact('data', 'id', 'matter'));
    }

    public function listarOpcionesMaterias(){
        return view('UsersViews.administrador.materias.opcionesCarreras');
    }
   
    public function creaSemestreMateria($id){
        $periodos = User::all() ->where('cargo', 'Docente');
        return view('UsersViews.administrador.materias.crear', compact('id','periodos'));
    }


    //agregue
    public function createMaterias(){
        return view('UsersViews.administrador.materias.crear');
    }


    //Request $request
    public function materiaPost(Request $request)
    {            
        $courseid = request('idCurso'); 
        Matter::create([
            'nombre' =>  request('nombre'),
            'idCurso' =>  request('idCurso'),
            'idPeriodo' =>  request('idPeriodo'),            
            'idDocente' =>  request('idDocente'),
            //Sentinel::getUser()->idPeriodoLectivo =>  request('idPeriodo'),
        ]);
    		//return back()->with('message', ['type'=> 'success', 'text' =>  "Se creo con éxito la materia." ]);
            $data = course::find($courseid);    
            $matter = Matter::all()->where('idCurso','=',$courseid)->where('estado','=','1');
            //$matter = Matter::all()->where('idCurso','=',$id);
            return redirect()->route('semestre_accede_post', request('idCurso'));            
    }

    public function postUpdateMatter(Matter $matter)
    {
        //$periodos = PeriodoLectivo::all();
        $periodos = User::all() ->where('cargo', 'Docente');
        return view('UsersViews.administrador.materias.edit', compact('matter','periodos'));
    }

    public function UpdateMatter(Request $request, Matter $matter)
    {
        $courseid = request('idCurso'); 

        $matter->nombre = $request->nombre;
        $matter->idCurso = $request->idCurso;
        $matter->idPeriodo = $request->idPeriodo;
        $matter->idDocente = $request->idDocente;

        
        $matter->save();
        //return back()->with('message', ['type'=> 'success', 'text' =>  "Se modificó con éxito la Materia." ]);
        $data = course::find($courseid);    
        $matter = Matter::all()->where('idCurso','=',$courseid)->where('estado','=','1');
        //$matter = Matter::all()->where('idCurso','=',$id);
        return redirect()->route('semestre_accede_post', request('idCurso'));            
    }


    //public function postDeleteMatter($id)
    public function postDeleteMatter($id, Request $request)
    {
        //echo ('entra');
        //echo $id;
        $data = Matter::findOrFail($id);
        //echo ('valorest');
        //echo ($data->estado);
        $data->estado=0;
        //echo('vac');
        //echo($data->estado);
        $data->save();
        return redirect()->back()->with('message', ['type' => 'success', 'text' =>  "Materia Eliminada."]);
        //try {
            
            //
            //$data = Matters::findOrFail($id);
            //$data->delete();

            //$matter->estado = $request->estado;
        //    $matter = Matter::findOrFail($id);
        //    echo($matter);
        //    $request->estado=1;
            
        //    $matter->save();
        //    return redirect()->back()->with('message', ['type' => 'success', 'text' =>  "Materia Eliminada."]);
        //} catch (Exception $e) {
        //    return redirect()->back()->with('message', ['type' => 'danger', 'text' =>  "Algo salió mal."]);
        //}
    }

}
