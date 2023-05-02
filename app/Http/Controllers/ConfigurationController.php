<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Student;
use App\Institution;
use App\Http\Requests\StudentRequest;
use Carbon\Carbon;
use Illuminate\Support\Facades\Redirect;
use Sentinel;
use App\Administrative;
use App\ConfiguracionSistema;
use App\Rol;
use App\Area;
use App\Matter;
use App\Usuario;

class ConfigurationController extends Controller
{
	public function home(){
        try {
            $activar_pagos = ConfiguracionSistema::pagos();
            $user = Sentinel::getUser();
            $user_profile = Administrative::findBySentinelid($user->id);
            session()->put('user_data',$user_profile);
        if($user_profile)

            return view(session('rol')->slug.'.configuraciones.index', compact('activar_pagos'));
        } catch (Exception $e) {
            logout();

            return Redirect::back()->withErrors(['login_fail' => 'Ha ocurrido un error.']);
        }
    }

    public function switchRoles(Request $request){

        $this->validate($request,[
            'rol'   =>  'required|integer|in:4,5'
		]);

		$user = Usuario::find($request->user);
		$role = Sentinel::findRoleByName($request->rolName == 'Docente' ? 'Docente' : 'Representante');
		$role->users()->detach($user);

		$role = Sentinel::findRoleByName($request->rolName == 'Docente' ? 'Representante' : 'Docente');
		$role->users()->attach($user);
		$user->profile->cargo = $request->rolName == 'Docente' ? 'Representante' : 'Docente';
		$user->profile->save();
		session()->put('rol',Sentinel::findRoleById($request->rolName == 'Docente' ? 5 : 4));
		return redirect('/perfil');
    }


    /*
        Configuraciones por Sección
    */
    public function configSecciones() {
        return view('UsersViews.administrador.configuraciones.configuracionPorSeccion');
    }
    /**/


    /*
        Configuraciones por Área
    */
    public function areas() {
        $regimen = ConfiguracionSistema::regimen();
		$areas = Area::getAllAreas();
        $areaEI = Area::areasBySection('EI');
        $areaEGB = Area::areasBySection('EGB');
        $areaBGU = Area::areasBySection('BGU');

        return view('UsersViews.administrador.configuraciones.areas.index', compact(
			'areaEI', 'areaEGB', 'areaBGU', 'areas', 'regimen'
		));
    }
        public function orden($area) {
        $areasOrden = Area::areasBySection($area);
        return view('layouts.modals.OrderAreas',
            compact('areasOrden','area'));
    }
    public function ordenEdit(Request $request, $area) {

        $area_pos= null;
        $areasOrden = Area::areasBySection($area);
        $this->validate($request,[
            'posicion'    =>  'required',
        ]);
        $nombreArea = explode(",", $request->posicion);
        foreach ($nombreArea as $key => $nombre) {
          $area_pos = $areasOrden->where('nombre',$nombre)->first();
         // dd($area_pos);
          if($area_pos!= null){
            $area_pos->posicion = $key+1;
            $area_pos->save();
          }
        }

        return redirect()->back()->with('message', ['type'=> 'success', 'text' =>  "El Orden de las Areas: ".$area.", se actualizo correctamente" ]);
    }

    public function areasPost(Request $request) {
        $areasOrden = Area::where('seccion',$request->seccionArea)
        ->where('idPeriodo', $this->idPeriodoUser())
        ->max('posicion');
        $data = request()->all();
        Area::create([
            'nombre' => $data['nombreArea'],
            'observacion' => $data['observacionArea'],
			'idPeriodo' => $this->idPeriodoUser(),
            'seccion' => $data['seccionArea'],
            'posicion' => $areasOrden+1,
            'dependiente' => isset($data['dependiente'])
        ]);

        return redirect()->route('configuracionesAreas');
    }

    public function areasEdit(Area $area) {

        $area->nombre = request()->nombreArea;
		$area->observacion = request()->observacionArea;
		$area->seccion = request()->seccionArea;
		$area->dependiente = isset(request()->dependiente);
		$area->save();

		return redirect()->route('configuracionesAreas');
	}

	public function areasDelete(Area $area) {
		$materias = Matter::where('area', $area->nombre)->get();
		for ($i=0; $i < count($materias); $i++) {
			$materias[$i]->area = null;
			$materias[$i]->save();
		}
        $area->delete();
        return redirect()->route('configuracionesAreas');
    }
}
