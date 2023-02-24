<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Course;
use App\Matter;
use App\Activity;
use Carbon\Carbon;
use Sentinel;
use App\User;
use App\Supply;
use App\Insumo;
use Illuminate\Support\Facades\DB;
use App\Parameters\General;
use App\Area;
use App\Administrative;
use App\ConfiguracionSistema;
use App\estructuraCualitativa;
use Illuminate\Support\Facades\Storage;

use App\MatterFlux;


class MatterController extends Controller
{
    public function edit(){
        try {
			$user = Sentinel::getUser();
			$areas = Area::getAllAreas();
            $user_profile = Administrative::findBySentinelid($user->id);
            session()->put('user_data',$user_profile);
        if($user_profile)
            $regimen = ConfiguracionSistema::regimen();
            $courses = Course::getAllCourses();
            $docentes = User::getDocentes();
            $cualitativas = estructuraCualitativa::All();
            //dd($cualitativas); m
			return view(session('rol')->slug.'.configuraciones.materiasEdicion',
			compact('courses','docentes', 'areas', 'regimen', 'cualitativas')
		);
        } catch (Exception $e) {
            logout();
            return Redirect::back()->withErrors(['login_fail' => 'Ha ocurrido un error.']);
        }
    }

    public function show(){
		$courses = Course::getAllCourses();
		$regimen = ConfiguracionSistema::regimen();

        return view('UsersViews.administrador.institucion.materias.index', compact('courses','regimen'));
    }

    public function showByGrade($idCurso){
		$course = Course::findOrFail($idCurso);
		$materiasFijas = Matter::where(['idPeriodo' => $this->idPeriodoUser(),
			'idCurso' => $idCurso])->get();
		$materiasOptativas = Matter::where(['idPeriodo' => $this->idPeriodoUser(),
			'idCurso' => $idCurso,
			'principal' => 0,
			'visible' => 1])->get();
		$materiasInternas = Matter::where(['idPeriodo' => $this->idPeriodoUser(),
			'idCurso' => $idCurso,
			'principal' => 0,
			'visible' => 0])->get();
		$teachers = User::getDocentes();
        return view('UsersViews.administrador.institucion.materias.verMaterias', compact(
			'course', 'teachers', 'materiasFijas', 'materiasOptativas', 'materiasInternas'
		));
    }

	public function postaddMatter(Request $request) {
        $this->validate($request,[
            'idCurso'   => 'required|exists:courses,id',
			'nombre'    =>  'required|string|between:3,100',
		]);
        if(isset($request->t_calif)){
         $this->validate($request,[
            'idEstructura'   => 'required',
        ]);}
        //validacion si se asigna docente
        if(isset($request->idDocente) && $request->idDocente != "null" ){
            $this->validate($request,['idDocente' =>  'exists:users,id',]);
        }
        // Se usa transaction para asegurar la integridad de los datos en ambas tablas
        DB::beginTransaction();
        $matters_pos = Matter::getMattersByCourseConfig($request->idCurso)->max('posicion');// obtengo el ultimo numero de posicion
        try {
            $area = Area::find($request->area);
            $matter = Matter::create( ['nombre' => $request->nombre,
                'idDocente' =>  $request->idDocente == 'null' ? null : $request->idDocente,
                'idCurso'   =>  $request->idCurso,
				'idArea' => $request->area,
				'idPeriodo' => $this->idPeriodoUser(),
				'visible' => $request->visible == 'true' ? 1 : 0,
				'principal' => $request->principal == 'true' ? 1 : 0,
                'nombre_abreviado' => $request->nombre_abreviado != null ? $request->nombre_abreviado : null,
				'observacion' => $request->observacion != null ? $request->observacion : null,
				'area' => $area->nombre ?? null,
                'posicion' => $matters_pos+1,
                'idEstructura' => $request->idEstructura ?? null,
            ]);
            //dd($matter);
            //echo ($matter);
            //agr$itemName = $request->input('itemat'),
            if(!empty($request->itemat)){
                foreach ($request->itemat as $key ) {
                    //echo $value->id;
                    //dd($request->itemat);
                    if(!empty($key))
                    {
                        $fluxmatter = MatterFlux::create([ 
                        
                        
                        'matter_id'=>$matter->id,
                        //$itemName = $request->input('itemat'),
                        //$arritem = implode(',',$itemName),               
                        //'id_m_predecessors' => implode(',', $itemName)
                        'id_m_predecessors' =>$key
        
                        ]);
                        //dd( $fluxmatter);
                        $fluxmatter->save();
                }
                }
            }
            
            //$fluxmatter->id_m_predecessors()->sync($request->itemName);
            //dd($fluxmatter);                     
            //$fluxmatter->save();
            //
            //$supplies = General::$supplies;
            $curso = Course::findOrFail($request->idCurso);
            $insumos = Insumo::whereIn('seccion',[$curso->seccion,'todos'])
            ->where('idPeriodo',$this->idPeriodoUser())->get();
            //dd($insumos);
            foreach ($insumos as $insumo) {
               $supply = Supply::create([
                    'nombre'    =>  $insumo->nombre,
					'idCurso'   =>  $matter->idCurso,
					'idPeriodo' => $this->idPeriodoUser(),
                    'idMateria' =>  $matter->id,
                    'idDocente' =>  $matter->idDocente
                    //'es_aporte' => ($key == 'EVALUACION') ? true : false
                ]);
                if ($insumo->nombre =='RECUPERATORIO') {
                     $activity = new Activity();

            $activity->nombre = "RECUPERACION";
            $activity->descripcion = "";
            $activity->fechaInicio = Carbon::now();
            $activity->fechaEntrega = Carbon::now();
            $activity->idPeriodo = $this->idPeriodoUser();
            $activity->idInsumo = $supply->id;
            $activity->parcial = "q1";
            $activity->calificado = 1;
            $activity->refuerzo = 0;
            $activity->save();

            $activity = new Activity();

            $activity->nombre = "RECUPERACION";
            $activity->descripcion = "";
            $activity->fechaInicio = Carbon::now();
            $activity->fechaEntrega = Carbon::now();
            $activity->idPeriodo = $this->idPeriodoUser();
            $activity->idInsumo = $supply->id;
            $activity->parcial = "q2";
            $activity->calificado = 1;
            $activity->refuerzo = 0;
            $activity->save();


            $activity = new Activity();

            $activity->nombre = "SUPLETORIO";
            $activity->descripcion = "";
            $activity->fechaInicio = Carbon::now();
            $activity->fechaEntrega = Carbon::now();
            $activity->idPeriodo = $this->idPeriodoUser();
            $activity->idInsumo = $supply->id;
            $activity->parcial = "supletorio";
            $activity->calificado = 1;
            $activity->refuerzo = 0;
            $activity->save();

            $activity = new Activity();

            $activity->nombre = "REMEDIAL";
            $activity->descripcion = "";
            $activity->fechaInicio = Carbon::now();
            $activity->fechaEntrega = Carbon::now();
            $activity->idPeriodo = $this->idPeriodoUser();
            $activity->idInsumo = $supply->id;
            $activity->parcial = "remedial";
            $activity->calificado = 1;
            $activity->refuerzo = 0;
            $activity->save();

            $activity = new Activity();

            $activity->nombre = "GRACIA";
            $activity->descripcion = "";
            $activity->fechaInicio = Carbon::now();
            $activity->fechaEntrega = Carbon::now();
            $activity->idPeriodo = $this->idPeriodoUser();
            $activity->idInsumo = $supply->id;
            $activity->parcial = "gracia";
            $activity->calificado = 1;
            $activity->refuerzo = 0;
            $activity->save();
                }elseif($insumo->nombre =='EXAMEN QUIMESTRAL'){
                     $activity = new Activity();

            $activity->nombre = "EXAMEN QUIMESTRAL";
            $activity->descripcion = "";
            $activity->fechaInicio = Carbon::now()->format('Y-m-d');
            $activity->fechaEntrega = Carbon::now()->format('Y-m-d');
            $activity->idPeriodo = $this->idPeriodoUser();
            $activity->idInsumo = $supply->id;
            $activity->parcial = "q1";
            $activity->calificado = 1;
            $activity->refuerzo = 0;
            $activity->save();

            $activity = new Activity();

            $activity->nombre = "EXAMEN QUIMESTRAL";
            $activity->descripcion = "";
            $activity->idInsumo = $supply->id;
            $activity->fechaInicio = Carbon::now()->format('Y-m-d');
            $activity->fechaEntrega = Carbon::now()->format('Y-m-d');
            $activity->idPeriodo = $this->idPeriodoUser();
            $activity->parcial = "q2";
            $activity->calificado = 1;
            $activity->refuerzo = 0;
            $activity->save();
                }
            }
        } catch(ValidationException $e)
        {
            // Error de validaciones redirecciona
            DB::rollback();
            return redirect()->back()->with('message', ['type'=> 'danger', 'text' =>  "Algo salio mal. 1 " ]);
        } catch(\Exception $e)
        {   //Error de Base
            DB::rollback();
            return redirect()->back()->with('message', ['type'=> 'danger', 'text' =>  $e->getMessage() ]);
        }
            //Si llega aqui no ha ocurrido ningun error
            DB::commit();
            return redirect()->back()->with('message', ['type'=> 'success', 'text' =>  "Materia $matter->nombre creada con éxito." ]);
    }
    public function getMatter($matter){
        //echo 'entraaaa';
		$matter =Matter::with('area')->find($matter);
        //$areas = Area::all();
        $docentes=DB::table('users_profile')->where('cargo', 'Docente')->orderBy('apellidos', 'ASC')->get();
        $areas = Area::where('idPeriodo',  Sentinel::getUser()->idPeriodoLectivo)->get();
		$courses = Course::getAllCourses();
        $cualitativas = estructuraCualitativa::All();
		return view('layouts.modals.EditMatter',
			compact('matter','docentes','areas', 'courses', 'cualitativas')
		);
    }
     public function getMatterOrder($curso){
        $courses = Course::findOrFail($curso);
        $matters = Matter::getMattersByCourseConfig($curso);
        return view('layouts.modals.OrderMatter',
            compact('matters','courses')
        );
    }
    public function putMatterOrder(Request $request)
    {   $materia_pos= null;
        $matters = Matter::getMattersByCourseConfig($request->idCurso);

        $this->validate($request,[
            'Orden_materia'    =>  'required',
            'idCurso'    =>  'required'
        ]);
        $nomMaterias = explode(",", $request->Orden_materia);
        foreach ($nomMaterias as $key => $materia) {
          $materia_pos = $matters->where('nombre',$materia)->first();
          if($materia_pos!= null){
            $materia_pos->posicion = $key+1;
            $materia_pos->save();
          }
        }

        return redirect()->back()->with('message', ['type'=> 'success', 'text' =>  "El Orden de las materias se actualizo correctamente" ]);
    }

    public function putMatter(Request $request, Matter $matter)
    {
         $this->validate($request,[
            'nombre'    =>  'required|string|between:3,100'
        ]);
         if(isset($request->t_calif)){
         $this->validate($request,[
            'idEstructura'   => 'required',
        ]);}
        //validacion si se asigna docente
        if(isset($request->idDocente) && $request->idDocente != "null" ){
            $this->validate($request,['idDocente' =>  'exists:users,id',]);
        }
        // Se usa transaction para asegurar la integridad de los datos en ambas tablas
        DB::beginTransaction();
        if($matter->nombre != $request->nombre){ //renombro el directorio donde se almacenan los deberes adjuntos en caso de que se cambie el nombre de la materia:::::
            //dd($matter);
            $directory = 'public/deberes_adjuntos/curso_'.$matter->idCurso.'/'.substr($matter->nombre, 0 ,25);
            $exists = Storage::disk('local')->exists($directory);
            if($exists){
                Storage::move($directory, 'public/deberes_adjuntos/curso_'.$matter->idCurso.'/'.substr($request->nombre, 0 ,25));
            }
        }

		$area = Area::find($request->area);
        try {
            $matter->update(['nombre' => $request->nombre,
                              'nivel' => $request->nivel,
                              'idDocente' =>  $request->idDocente == 'null' ? null : $request->idDocente,
                              'visible' => $request->visible == 'true' ? true : false,
                              'principal' => $request->principal == 'true' ? true : false,
                              'nombre_abreviado' => $request->nombre_abreviado != null ? $request->nombre_abreviado : null,
                              'observacion' => $request->observacion != null ? $request->observacion : null,
							  'idArea' => $request->area,
							  'area' => $area->nombre ?? null,
                              'idEstructura' => $request->idEstructura ?? null,
						]);

            $supplies = Supply::getSuppliesByMatter($matter->id);

            foreach ($supplies as $key) {
                $key->update(['idDocente' =>    $matter->idDocente]);
            }


        } catch(ValidationException $e)
        {
            // Error de validaciones redirecciona
            DB::rollback();
            return redirect()->back()->with('message', ['type'=> 'danger', 'text' =>  "Algo salió mal." ]);
        } catch(\Exception $e)
        {   //Error de Base
            DB::rollback();
            return redirect()->back()->with('message', ['type'=> 'danger', 'text' =>  "Algo salió mal." ]);
        }
            //Si llega aqui no ha ocurrido ningun error
            DB::commit();
            return redirect()->back()->with('message', ['type'=> 'success', 'text' =>  "Materia $matter->nombre actualizada con éxito." ]);
    }


    public function destroy($id)
    {
        //echo 'entra';
        //Matter::destroy($id);
        $data = Matter::findOrFail($id);
        $data->visible=0;        
        $data->estado=0;       
        $data->save();
        return redirect('materiasEdicion');
    }
}