<?php

namespace App\Http\Controllers;

use App\Usuario;
use App\PeriodoLectivo;
use App\ConfiguracionSistema;
use App\UnidadPeriodica;
use App\ParcialPeriodico;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use DB;

class PeriodoController extends Controller
{
    public function cambioDePeriodo($user) {
		$user = Usuario::find($user);
		$this->validate(request(), [
			'idPeriodo' => 'integer|exists:periodo_lectivo,id',
		]);
		$user->idPeriodoLectivo = request()->idPeriodo;
		$user->save();
	}
    public function home(Request $request) {
        $periodos = PeriodoLectivo::all();
         $view = \View::make('UsersViews.administrador.configuraciones.PeriodoLectivo.lista')->with(['periodos' => $periodos]);
        if($request->ajax()){
            $sections = $view->renderSections();
            return Response::json($sections['contentPanel']);
        }else {
       // dd($periodos);
        return view('UsersViews.administrador.configuraciones.PeriodoLectivo.index',compact('periodos'));
        }
    }
    public function addPeriodo(Request $request){

        $this->validate($request,[
            'nombre' => 'required|string|unique:periodo_lectivo,nombre',
            'fecha_inicial' => 'required',
            'fecha_final' => 'required',
            'regimen' => 'required|string|min:3',
        ]);
        DB::beginTransaction();
        $periodo = PeriodoLectivo::create([
            'nombre' => $request->nombre,
            'fecha_inicial' =>$request->fecha_inicial,
            'fecha_final' => $request->fecha_final,
            'regimen' => $request->regimen,
            ]);
        // se copian las configuraciones del periodo lectivo actual::::::::::::::::
        $configuraciones = ConfiguracionSistema::where('idPeriodo', $this->idPeriodoUser())
        ->select('nombre','descripcion','categoria','valor')->get();
        foreach ($configuraciones as $configuracion) {
            $configuracion_nueva = new ConfiguracionSistema();
            $configuracion_nueva->nombre        =   $configuracion->nombre;
            $configuracion_nueva->descripcion   =   $configuracion->descripcion;
            $configuracion_nueva->categoria     =   $configuracion->categoria;
            $configuracion_nueva->valor         =   $configuracion->valor;
            $configuracion_nueva->idPeriodo     =   $periodo->id;
            $configuracion_nueva->save(); // se agregan las configuraciones en el nuevo periodo Lectivo::::::::::::::::
            DB::commit();

        }
        return ['mensaje'=>'Periodo Creado'];
    }
    public function deletePeriodo($id){
        if ($this->idPeriodoUser()==$id) {
            return Response::json('Cambie de Periodo para poder eliminar', 404);
        }
         $periodo = PeriodoLectivo::findOrfail($id);
        if($periodo->delete()){
            return ['mensaje'=>'Periodo Eliminado'];
        }else {
            return Response::json('Comuniquese con el administrador', 404);
        }

    }
    public function editPeriodo($id){
         $periodo = PeriodoLectivo::findOrfail($id);
        return $periodo;
    }
    public function actualizarPeriodo(Request $request){
         $periodo = PeriodoLectivo::findOrfail($request->id);
         $this->validate($request,[
            'nombre' => 'required|string|unique:periodo_lectivo,nombre,'.$periodo->id,
            'fecha_inicial' => 'required',
            'fecha_final' => 'required',
            'regimen' => 'required|string|min:3',
        ]);
       $periodo->update($request->all());
       return ['mensaje'=>'Periodo Actualizado'];
    }
    public function homeUnidades(Request $request,$id){
        $periodo = PeriodoLectivo::findOrfail($id);
        $unidades = UnidadPeriodica::where('idPeriodo',$periodo->id)->get();
         $view = \View::make('UsersViews.administrador.configuraciones.PeriodoLectivo.listaUnidades')->with(['unidades' => $unidades,'periodo' => $periodo]);
        if($request->ajax()){
            $sections = $view->renderSections();
            return Response::json($sections['UnidadesGenerales']);
        }
    }
    public function addUnidad(Request $request, UnidadPeriodica $unidadPeriodica){
        $this->validate($request,[
           // 'nombre' => 'required|string|unique:unidad_periodicas,nombre,idPeriodo,'.$unidadPeriodica->id,
            'nombre' => 'unique:unidad_periodicas,nombre,NULL,id,idPeriodo,'.$request->idPeriodo.'|required|max:100',
            'identificador' => 'unique:unidad_periodicas,identificador,NULL,id,idPeriodo,'.$request->idPeriodo.'|required|max:10',
            'idPeriodo' => 'required|integer',
        ]);
       return  $unidadPeriodica->create($request->all());
    }
    public function deleteUnidad($id){
        $unidad = UnidadPeriodica::findOrfail($id);
        $unidad->delete();
         return ['mensaje'=>'Unidad Eliminada'];
    }
     public function editarUnidad($id){
          return UnidadPeriodica::findOrfail($id);

    }
     public function actualizarUnidad(Request $request){
        $unidad = UnidadPeriodica::findOrfail($request->id);
        $this->validate($request,[
        'nombre' => 'required|max:100|string|unique:unidad_periodicas,nombre,'.$unidad->id.',id,idPeriodo,'.$unidad->idPeriodo,
        'identificador' => 'unique:unidad_periodicas,identificador,'.$unidad->id.',id,idPeriodo,'.$unidad->idPeriodo.'|required|max:10',
        'idPeriodo' => 'required|integer',
        ]);
       $unidad->update([
        'nombre' => $request->nombre,
        'identificador' => $request->identificador,
        'idPeriodo' => $request->idPeriodo,
        'activo' => $request->activo?'1':'0',
       ]);
       return ['mensaje'=>'Unidad Actualizado'];

    }
    public function homeParcialesP(Request $request,$id){
        $unidad = UnidadPeriodica::findOrfail($id);
        $periodo = PeriodoLectivo::findOrfail($unidad->idPeriodo);
        $parcialesP = ParcialPeriodico::where('idUnidad',$unidad->id)->get();
         $view = \View::make('UsersViews.administrador.configuraciones.PeriodoLectivo.listaParcialesP')->with(['unidad' => $unidad,'parciales' => $parcialesP, 'periodo' => $periodo]);
        if($request->ajax()){
            $sections = $view->renderSections();
            return Response::json($sections['parcialesP']);
        }
    }
    public function addParcialP(Request $request, ParcialPeriodico $ParcialPeriodico){
       // dd($request);
        $this->validate($request,[
            'nombre' => 'unique:parcial_periodicos,nombre,NULL,id,idUnidad,'.$request->idUnidad.'|required|max:100',
            'identificador' => 'unique:parcial_periodicos,identificador,NULL,id,idUnidad,'.$request->idUnidad.'|required|max:10',
            'idUnidad' => 'required|integer',
            'fechaI' => 'required|date',
            'fechaF' => 'required|date',
            'idPeriodo' => 'required|integer',
        ]);
       return  $ParcialPeriodico->create($request->all());
    }public function deleteParcialP($id){

        $parcial = ParcialPeriodico::findOrfail($id);
        //dd($parcial);
        $parcial->delete();
         return ['mensaje'=>'Parcial Eliminado'];
    }
    public function editarParcialP($id){
          return ParcialPeriodico::findOrfail($id);

    }
    public function actualizarParcialP(Request $request){
        if(!isset($request->activo)){ //si no esta marcado el check desde la vista agrego el campo activo al request y su valor debe ser cero
            $request->request->add(['activo' => 0]); 
        }
        $parcial = ParcialPeriodico::findOrfail($request->id);
        $this->validate($request,[
        'nombre' => 'required|max:100|string|unique:parcial_periodicos,nombre,'.$parcial->id.',id,idUnidad,'.$parcial->idUnidad,
        'identificador' => 'unique:parcial_periodicos,identificador,'.$parcial->id.',id,idUnidad,'.$parcial->idUnidad.'|required|max:10',
        'idUnidad' => 'required|integer',
        'fechaI' => 'required|date',
        'fechaF' => 'required|date',
        'idPeriodo' => 'required|integer',
        ]);
       $parcial->update($request->all());
       return ['mensaje'=>'Parcial Actualizado'];

    }
}
