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
use App\ArchivosInfo;
use App\ConfiguracionSistema;
use App\Rol;
use App\Area;
use App\Usuario;
use App\Matter;
use App\Course;
use App\Career;
use App\DocumentsPeas;
use App\PeriodoLectivo;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

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

    /**
     * Funciones para el modulo de peas
     */

    private function getPeas(){
        return DocumentsPeas::join('archivos_info','documents_peas.idArchivoInfo','=','archivos_info.id')
        ->join('matters','documents_peas.idMetter','=','matters.id')
        ->join('users_profile','matters.idDocente','=','users_profile.userid')
        ->join('periodo_lectivo','archivos_info.idPeriodo','=','periodo_lectivo.id')
        ->join('courses','matters.idCurso','=','courses.id')
        ->join('Semesters','courses.id_semester','=','Semesters.id')
        ->join('Career','Semesters.career_id','=','Career.id')
        ->select('documents_peas.id as id', 'documents_peas.name as name', 
                'documents_peas.state as state', 'documents_peas.idArchivoInfo as idArchivoInfo', 
                'documents_peas.idMetter as idMetter', 'matters.nombre as nombreMateria',
                'periodo_lectivo.nombre as nombrePeriodo', 'periodo_lectivo.id as idPeriodo',
                'courses.paralelo as nombreCurso','Semesters.nombsemt as nombreSemestre',
                'Career.nombre as nombreCarrera', 'users_profile.nombres as nombresDocente',
                'users_profile.apellidos as apellidosDocente'
                )
        ->where('archivos_info.idPeriodo',$this->idPeriodoUser())
        ->get();
    }

    public function peasIndex (Request $request){
        $carreras = Career::where('estado',1)->get();
        $peas = $this->getPeas();
        return view('UsersViews.administrador.configuraciones.configuracionPeas',compact('carreras','peas'));
    }

    public function peasStore (Request $request){
        $carreras = Career::where('estado',1)->get();
        $peas = $this->getPeas();
        $documentoPEA = new DocumentsPeas();
        $file = $request->file('filePea');
        $extension = $file->extension();
        $materia = Matter::find($request->asignaturaId);
        $name = $materia->nombre.'-'.$request->nombre_pea;
        $periodo = PeriodoLectivo::find($materia->idPeriodo);
        $fileExists = $peas->where('name',$name)->where('idMetter',$materia->id)->first();

        //Verifica que no exita peas activos para esa materia
        $peaActive = DocumentsPeas::where('idMetter',$materia->id)->where('state',1)->count();
        if($peaActive > 0 && $request->estado==1){
            return redirect()->route('getPeaIndex',compact('carreras','peas'))->withErrors(['error'=>'Se encontraron PEAS activos para esta materia.']);
        }
        //Verifica que no exista un archivo con el mismo nombre en el mismo periodo.
        if(!empty($fileExists) && Storage::disk('public')->exists($fileExists->ruta_archivo)){
            return redirect()->route('getPeaIndex',compact('carreras','peas'))->withErrors(['error'=>'El archivo ya existe con ese nombre en el periodo actual.']);
        }
        //Guarda el archivo en la ruta fisica
        $path = Storage::disk('public')->put('DocumentosPEA/'.$periodo->nombre,$file);
        //Guarda el archivo en la base de datos como respaldo.
        $respSql = StorageController::StorageSql($file,$path,$name,$extension,Sentinel::getUser()->id,$periodo->id);
        //Ingresa si hay error
        if($respSql->getStatusCode()===501){
            return redirect()->route('getPeaIndex',compact('carreras','peas'))->withErrors(['error'=>$respSql->getContent()]);
        }
        //Obtiene el archivo almacenado anteriormente
        $fileSQL = ArchivosInfo::where('ruta_archivo',$path)
            ->where('user_id',Sentinel::getUser()->id)
            ->where('idPeriodo',$periodo->id)
            ->first();
        //Crear el registro en la tabla de los peas
        $documentoPEA->name = $name;
        $documentoPEA->state = $request->estado;
        $documentoPEA->idArchivoInfo = $fileSQL->id;
        $documentoPEA->idMetter = $materia->id;
        $documentoPEA->save();

        return redirect()->route('getPeaIndex',compact('carreras','peas'));
    }

    public function delectPea(Request $request){
        $fileInfo = ArchivosInfo::find($request->id);
        if(!empty($fileInfo)){
            $resp = StorageController::DelectSqlStorageId($request->id);
            if(Storage::disk('public')->exists($fileInfo->ruta_archivo))
                Storage::disk('public')->delete($fileInfo->ruta_archivo);
            return $resp;
        }
        return response('El archivo no existe',404);
    }

    public function downloadDocumentPEA($id){
        $document = DocumentsPeas::find($id);
        $fileinfo = ArchivosInfo::find($document->idArchivoInfo);
        $filepath = $fileinfo->ruta_archivo;
        if(!Storage::disk('public')->exists($fileinfo->ruta_archivo)){
            if(!empty($fileinfo)){
                $resp = StorageController::DownloadSqlStorageId($fileinfo->archivos_base64_id);
                if($resp->getStatusCode() === 501){
                    response()->view('errors.404', [], 404);
                }
                Storage::disk('public')->put($fileinfo->ruta_archivo,$resp->getContent());
            }else{
                response()->view('errors.404', [], 404);
            }
        }
        $file = Storage::disk('public')->get($filepath);
        $response = new Response($file, 200);
        $response->header('Content-Type', 'application/pdf')
            ->header('Content-Disposition', 'inline; filename="' . $document->name . '"');
        return $response;
    }

    public function viewDocumentPEA(Request $request){
        $url = route('getPeaView',$request->id);
        return view('partials.modals.viewFilePDF',compact('url'));
    }
    
    public function viewModalPEA(Request $request){
        $flagUpdate = $request->update;
        $idUpdate = $request->idUpdate;
        $carreras = Career::where('estado',1)->get();
        if($flagUpdate){
            $document = DocumentsPeas::join('archivos_info','documents_peas.idArchivoInfo','=','archivos_info.id')
            ->join('matters','documents_peas.idMetter','=','matters.id')
            ->join('users_profile','matters.idDocente','=','users_profile.userid')
            ->join('periodo_lectivo','archivos_info.idPeriodo','=','periodo_lectivo.id')
            ->join('courses','matters.idCurso','=','courses.id')
            ->join('Semesters','courses.id_semester','=','Semesters.id')
            ->join('Career','Semesters.career_id','=','Career.id')
            ->select('documents_peas.id as id', 'documents_peas.name as name', 
                    'documents_peas.state as state', 'documents_peas.idMetter as idMetter', 
                    'matters.nombre as nombreMateria', 'courses.paralelo as idCurso',
                    'courses.paralelo as nombreCurso','Semesters.nombsemt as nombreSemestre',
                    'Semesters.id as idSemestre', 'Career.id as idCarrera',
                    'Career.nombre as nombreCarrera'
                    )
            ->where('documents_peas.id',$request->idUpdate)
            ->first();
            return view('partials.modals.formPEAS',compact('flagUpdate','document', 'carreras'));
        }
        return view('partials.modals.formPEAS',compact('flagUpdate','carreras'));
    }
}
