<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Sentinel;
use App\ArchivosInfo;
use App\Matter;
use App\Course;
use App\Career;
use App\DocumentsPeas;
use App\PeriodoLectivo;
use App\Semesters;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class PeasController extends Controller
{
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

    public function viewIndexPEADocente (Request $request){
        try {
            //dd(session('rol')->name);
            $materias = DocumentsPeas::join('archivos_info','documents_peas.idArchivoInfo','=','archivos_info.id')
            ->join('matters','documents_peas.idMetter','=','matters.id')
            ->join('users_profile','matters.idDocente','=','users_profile.userid')
            ->join('periodo_lectivo','archivos_info.idPeriodo','=','periodo_lectivo.id')
            ->join('courses','matters.idCurso','=','courses.id')
            ->select('documents_peas.idArchivoInfo as idArchivoInfo', 'documents_peas.state as state', 
                    'documents_peas.idMetter as idMetter', 'matters.nombre as nombreMateria',
                    'courses.id as idCurso', 'courses.grado as grado', 'documents_peas.id as id',
                    'documents_peas.name as nameDocument'
                    )
            ->where('archivos_info.idPeriodo',$this->idPeriodoUser())
            ->where('matters.idDocente',session('user_data')->userid)
            ->get()
            ->groupBy('courses.grado');
            return view('UsersViews.docente.PEA.index', compact(
                'materias'
            ));
        } catch (Exception $e) {
            return $e->getMessage();
        }
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

    public function editPeaStore (Request $request){
        $rules = [
            'nombre_pea' => 'required|string',
            'carreraId' => 'required',
            'semestreId' => 'required',
            'cursoId' => 'required',
            'asignaturaId' => 'required',
            'estado' => 'required',
            'idPEA' => 'required',
        ];
        $messages = [
            'nombre_pea.required' => 'El campo nombre es obligatorio.',
            'carreraId.required' => 'El campo carrera es obligatorio.',
            'semestreId.required' => 'El campo semestre es obligatorio.',
            'cursoId.required' => 'El campo curso es obligatorio.',
            'asignaturaId.required' => 'El asignatura nombre es obligatorio.',
            'estado.required' => 'El campo estado es obligatorio.',
            'idPEA.required' => 'El id del PEA es obligatorio.'
        ];

        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        
        $materia = Matter::find($request->asignaturaId);
        $idUpdate = $request->idPEA;
        //dd($request);    
        DocumentsPeas::where('id',$idUpdate)
            ->update([
                'name' => $materia->nombre.'-'.$request->nombre_pea,
                'idMetter' => $request->asignaturaId,
                'state' => $request->estado
            ]);
        return redirect()->back();
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
        $document = null;
        if($flagUpdate=='true'){
            $document = DocumentsPeas::join('archivos_info','documents_peas.idArchivoInfo','=','archivos_info.id')
            ->join('matters','documents_peas.idMetter','=','matters.id')
            ->join('users_profile','matters.idDocente','=','users_profile.userid')
            ->join('periodo_lectivo','archivos_info.idPeriodo','=','periodo_lectivo.id')
            ->join('courses','matters.idCurso','=','courses.id')
            ->join('Semesters','courses.id_semester','=','Semesters.id')
            ->join('Career','Semesters.career_id','=','Career.id')
            ->select('documents_peas.id as id', 'documents_peas.name as name', 
                    'documents_peas.state as state', 'documents_peas.idMetter as idMetter', 
                    'matters.nombre as nombreMateria', 'courses.id as idCurso',
                    'courses.paralelo as nombreCurso','Semesters.nombsemt as nombreSemestre',
                    'Semesters.id as idSemestre', 'Career.id as idCarrera',
                    'Career.nombre as nombreCarrera'
                    )
            ->where('documents_peas.id',$idUpdate)
            ->first();
            $semestres = Semesters::where('career_id',$document->idCarrera)->get();
            $cursos = Course::where('id_semester',$document->idSemestre)->get();
            $asignaturas = Matter::where('idCurso',$document->idCurso)->get();
            return view('partials.modals.formPEAS',compact('flagUpdate','document', 'carreras', 'semestres', 'cursos', 'asignaturas', 'idUpdate'));
        }
        return view('partials.modals.formPEAS',compact('flagUpdate','carreras', 'document'));
    }
}
