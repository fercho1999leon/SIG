<?php

namespace App\Http\Controllers;
use Sentinel;
use App\Insumo;
use App\Career;
use App\Matter;
use App\Course;
use App\Semesters;
use App\Supply;
use App\Http\Controllers\SupplyController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class InsumoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //dd($this->idPeriodoUser())

        $careers = Career::all()->where('estado','=','1');


        //$insumos = Insumo::where('idPeriodo',$this->idPeriodoUser())->OrderBy('seccion')->get();
        $insumos = Supply::where('idPeriodo',Sentinel::getUser()->idPeriodoLectivo)
                    ->groupBy('nombre')
                    ->get();

        //dd($insumos,$careers);
        //$insumos = Insumo::all()->get();

        //$courses=DB::table('courses')->join('Semesters','Semesters.id','=','courses.id_career')->where('Semesters.career_id','=',$id_carrera)->where('Semesters.estado','=','1')->where('courses.estado','=','1')->select("courses.id", "courses.grado","courses.id_career")->get();
        $courses=DB::table('insumos')->join('Career','Career.id','=','insumos.id_carrers')
                                    ->where('insumos.id_carrers','=','Career.id')
                                    ->where('Career.estado','=','1')
                                    ->select("Career.nombre")
                                    ->first();

                                    
      

        
        return view('layouts.modals.InsumosGenerales',compact('insumos','careers','courses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $career = Career::where('id',$request->carrera)->where('estado','=','1')->first();
        $semesters = Semesters::where('career_id',$career->id)
                    ->where('estado','=','1')->get();
        foreach($semesters as $semester){
            $courses = Course::where('id_semester',$semester->id)
                            ->where('idPeriodo',Sentinel::getUser()->idPeriodoLectivo)
                            ->where('estado','=','1')
                            ->get();
            foreach($courses as $course){
                $matters = Matter::where('idCurso',$course->id)
                        ->where('idPeriodo',Sentinel::getUser()->idPeriodoLectivo)
                        ->where('estado','=','1')
                        ->get();
                foreach($matters as $matter){
                    $addinsumo = new SupplyController();
                    $request->request->add(['idPeriodo'=> $this->idPeriodoUser(),'idMateria'=>$matter->id,'idCurso'=>$course->id]);
                    $addinsumo->postaddInsumo($request);
                }
            }          
                            
        }
        return ('<div class="alert alert-success" style="margin-top: 2rem">INSUMOS CREADOS</div>');
        //dd($request,$matters,$career,$semesters,$courses);
        /*-----------$request->request->add(['idPeriodo'=> $this->idPeriodoUser()]);
        $this->validate($request,[
            'nombre' => 'required|string|min:3',
            'seccion'   =>  'required|string|min:1',
            //'carrera' => 'string|min:1',
        ]);
        $existe= Insumo::whereIn('nombre', ['todos',$request->nombre])->where('nombre',$request->nombre)
        ->where('idPeriodo', $this->idPeriodoUser())->exists();
        if ($existe) {
            return '<div class="alert alert-danger" role="alert">Insumo duplicado.</div>';
        }
        return redirect()->route('insumos.index');
        $insumo = Insumo::create($request->all());
            ----------------*/    
        /*$insumo = Insumo::create([
            'nombre' => $request->nombre,
            'id_carrers' => $request->carrera,
            'seccion' => $request->carrera,
            'idPeriodo' => $this->idPeriodoUser(),


        ]);
        //dd($insumo);
        $insumo->save();
        */
        //return '<div class="alert alert-success" role="alert">Insumo Creado con exito.</div>';
       // dd($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Insumo  $insumo
     * @return \Illuminate\Http\Response
     */
    public function show(Insumo $insumo)
    {
           return view('layouts.modals.InsumoEditarGeneral', compact('insumo'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Insumo  $insumo
     * @return \Illuminate\Http\Response
     */
    public function edit(Insumo $insumo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Insumo  $insumo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Insumo $insumo)
    {   if ($insumo->nombre =='EXAMEN QUIMESTRAL' || $insumo->nombre =='RECUPERATORIO') {
       return '<div class="alert alert-danger" role="alert">Este insumo no puede ser Actualizado</div>';
        }else{
        $insumo->update($request->all());
         return '<div class="alert alert-success" role="alert">Insumo Actualizado con exito.</div>';
     }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Insumo  $insumo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Insumo $insumo)
    {


    }
    public function ver($id)
    {
        //echo $id;
       //$insumos = Insumo::where('idPeriodo',$this->idPeriodoUser())->OrderBy('seccion')->get();
       $insumos = Insumo::where('idPeriodo',$this->idPeriodoUser())->OrderBy('id_carrers')->get();
       
      
       
      
       return view('layouts.modals.ShowInsumosGenerales', compact('insumos'));
    }
    public function deleteInsumo(Insumo $insumo)
    {   if ($insumo->nombre =='EXAMEN QUIMESTRAL' || $insumo->nombre =='RECUPERATORIO') {
            return '<div class="alert alert-danger" role="alert">Este insumo no puede ser Eliminado</div>';
        }else{
            try {
                 $insumo->delete();
                 return '<div class="alert alert-success" role="alert">Insumo Eliminado con exito.</div>';

            } catch (Exception $e) {
                return view('layouts.messages')->with('message', [
                    'type' => 'danger', 'text' => "Algo salió mal."
                ]);
            }
        }
    }
}
