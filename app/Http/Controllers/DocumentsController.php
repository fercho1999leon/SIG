<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DocumentStudens;
use App\DocumentType;
use App\Status;
use App\Student2Profile;
use Sentinel;
use Carbon\Carbon;
use App\Student2;
use App\User;
use Illuminate\Support\Facades\DB;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use App\Administrative;

class DocumentsController extends Controller
{
    //
    public  function index(){
        return view('UsersViews.administrador.documentacion.index');
    }
    public function getTableDocumentation(){
        $user = Sentinel::getUser();
        $user_profile = Administrative::findBySentinelid($user->id);
        $student = Student2::where('idProfile', $user_profile->id)->first();

        if($student != null){
            $model = DocumentStudens::join('students2_profile_per_year','students2_profile_per_year.idStudent','=','document_studens.id_studen')
            ->join('students2','students2.id','=','students2_profile_per_year.idStudent')
            ->join('status','status.id','=','document_studens.id_status')
            ->join('document_type','document_type.id','=','document_studens.id_document_type')    
            ->select(
                DB::raw("CONCAT(students2.nombres, ' ', students2.apellidos) AS full_name"),
                'students2.ci',
                'document_type.name_type as document_type','document_studens.document_name','document_studens.update_date','status.name'
                ,'document_studens.id as id','document_studens.url as url')
            ->where('students2.id', $student->id)    
            ->orderBy('students2.ci')
            ->get();
        }else{
            $model = DocumentStudens::join('students2_profile_per_year','students2_profile_per_year.idStudent','=','document_studens.id_studen')
            ->join('students2','students2.id','=','students2_profile_per_year.idStudent')
            ->join('status','status.id','=','document_studens.id_status')
            ->join('document_type','document_type.id','=','document_studens.id_document_type')    
            ->select(
                DB::raw("CONCAT(students2.nombres, ' ', students2.apellidos) AS full_name"),
                'students2.ci',
                'document_type.name_type as document_type','document_studens.document_name','document_studens.update_date','status.name'
                ,'document_studens.id as id','document_studens.url as url')
            ->orderBy('students2.ci')
            ->get();
        }
      
        return Datatables::of($model)
        ->addColumn('btn', 'UsersViews.administrador.documentacion.acciones.indexDocuments')
        ->rawColumns(['btn'])
        ->make(true);
    }

    public function autorizarDocumento($id){
        $documento = DocumentStudens::find($id);
        $status = Status::all();
        return view('UsersViews.administrador.documentacion.autorizarDocummento', compact('documento','status'));
    }
    public function documentoAutorizado(Request $request){
        //dd($request);
        $documento = DocumentStudens::find($request->idDoc);
        $documento->id_status = $request->documentType;
        $documento->save();
        Session::flash('alert', "Actualización Realizada...");
                return redirect()->route('manejoDocumentos');
    }


    //Seccion de Estado 
    public function statusIndex(){
        return view('UsersViews.administrador.documentacion.statusIndex');
    }
    public function getTableStatus(){
        $model = Status::where('id','!=','10')->get();
        //$model = Status::
        return Datatables::of($model)
        ->addColumn('btn', 'UsersViews.administrador.documentacion.acciones.status')
        ->rawColumns(['btn'])
        ->make(true);
    }
    public function editStatus($id,$seccion,$typeDocument){
        $seccion = 2;
        $type = 2;
        $typeDocument = 2;
        $statusDoc = Status::findOrFail($id);
        return view('UsersViews.administrador.repositorio.ajustesStatusAdd',compact('seccion','type','typeDocument','statusDoc'));
    }
    public function newStatusDoc(){
        $seccion = 1;
        $typeDocument = 2;
        return view('UsersViews.administrador.repositorio.ajustesStatusAdd',compact('seccion','typeDocument'));
    }
    public function newStatusStoreDoc(Request $request){
        
        $status = new Status();
        $status->name = $request->name;
        $status->save();
        //dd($status);
        Session::flash('alert', "Se han Agregado el Estado de Forma Correcta");
        return  redirect()->route('statusIndex');
    }

    public function editStatusUpdate(Request $request){
        $status = Status::findOrFail($request->id);
        $status->name = $request->name;
        $status->save();
        Session::flash('alert', "Se Actualizo el Estado de Forma Correcta");
        return  redirect()->route('statusIndex');
    }
    public function deleteStatus($id){
        try {
            $status = Status::find($id);
            $status->delete();
            return redirect()->route('statusIndex')->with('message', '¡Eliminado Correctamente!')->with('type','success'); 
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    ///Secccion de Tipo de Documentos 
    public function typeDocumentIndex(){
        return view('UsersViews.administrador.documentacion.typeDocumentIndex');
    }

    public function tdCreate(){
        $seccion = 1;
        $status = Status::all();
        return view('UsersViews.administrador.documentacion.typeDocumentAdd',compact('seccion','status'));
    }
    public function getTableTypeDocument(){
      
        $model = DocumentType::join('status','status.id','=','document_type.id_status')
                ->select('status.name','document_type.name_type as document_type','document_type.id as id')
                ->orderBy('document_type.name_type')
                ->get();
        return Datatables::of($model)
            ->addColumn('btn', 'UsersViews.administrador.documentacion.acciones.typeDocument')
            ->rawColumns(['btn'])
            ->make(true);
    }
    public function tdStore(Request $request){
       // dd($request);
        if($request->file('docMuestra') == null){
            $typeDocument = new DocumentType;
            $typeDocument->name_type = $request->name;
            $typeDocument->id_status = $request->status;
            $typeDocument->save();
       }else{

            $documento = $request->file('docMuestra');
            $nombreDocumento1 = $documento->getClientOriginalName();
            $nombreDocumento = str_replace(' ', '', $nombreDocumento1);
            //dd($nombreDocumento);
            $extencion = $request->file('docMuestra')->extension();
            $nombreDocumento = $nombreDocumento.'.'.$extencion;
            if(File::exists(public_path('img/documentosCargados/'.$nombreDocumento))){
               Session::flash('alert', "No puede agregar el mismo tipo de documento 2 veces...");
               return redirect()->route('tdCreate');
            }else{
               $documento->move('img/documentosCargados/', $nombreDocumento);
               
               $typeDocument = new DocumentType;
               $typeDocument->name_type = $request->name;
               $typeDocument->docMuestra = 'img/documentosCargados/'.$nombreDocumento;
               $typeDocument->id_status = $request->status;
               
               $typeDocument->save();    
               
           }
           
       }
      
        
        //dd($typeDocument);
        return  redirect()->route('typeDocumentIndex');
    }
    public function tdEdit($id){
        $seccion = 2;
        $status = Status::all();
        $typeDocument = DocumentType::findOrFail($id);
        return view('UsersViews.administrador.documentacion.typeDocumentAdd',compact('seccion','typeDocument','status'));
    }
    
    public function tdUpdate(Request $request){
        $typeDocument = DocumentType::findOrFail($request->id);
        $typeDocument->name_type = $request->name;
        $typeDocument->id_status = $request->status;
        $typeDocument->save();
        Session::flash('alert', "Se Actualizo el Tipo de Documente de Forma Correcta");
        return  redirect()->route('typeDocumentIndex');
    }
    public function tdDelete($id){
        try {
            $status = DocumentType::find($id);
            $status->delete();
            return redirect()->route('typeDocumentIndex')->with('message', '¡Eliminado Correctamente!')->with('type','success'); 
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    // Seccion de Documentacion estudiantil 
    public function documentacionEstudiantil(){
        return view('UsersViews.estudiante.documentos.index');
    }

    public function getTableDocumentationEstudiante(){
        $user = Sentinel::getUser();
        $userprofile = User::where('userid', $user->id)->first();
        $student = Student2::where('idProfile', $userprofile->id)->first();
        if($student != null){
            $model = DocumentStudens::join('students2_profile_per_year','students2_profile_per_year.idStudent','=','document_studens.id_studen')
            ->join('students2','students2.id','=','students2_profile_per_year.idStudent')
            ->join('status','status.id','=','document_studens.id_status')
            ->join('document_type','document_type.id','=','document_studens.id_document_type')
            ->where('students2.id', $student->id)
            ->select('students2_profile_per_year.idStudent as idStudent',
                'document_type.name_type as document_type','document_studens.document_name','document_studens.update_date','status.name'
                ,'document_studens.id as id','document_studens.url as url' )
            ->orderBy('document_studens.document_name')
            ->get();

        }else{
            $model = DocumentStudens::join('students2_profile_per_year','students2_profile_per_year.idStudent','=','document_studens.id_studen')
            ->join('students2','students2.id','=','students2_profile_per_year.idStudent')
            ->join('status','status.id','=','document_studens.id_status')
            ->join('document_type','document_type.id','=','document_studens.id_document_type')
            ->select('students2_profile_per_year.idStudent as idStudent',
                'document_type.name_type as document_type','document_studens.document_name','document_studens.update_date','status.name'
                ,'document_studens.id as id','document_studens.url as url' )
            ->orderBy('document_studens.document_name')
            ->get();
        }
        
        
        return Datatables::of($model)
        ->addColumn('btn', 'UsersViews.estudiante.documentos.acciones.index')
        ->rawColumns(['btn'])
        ->make(true);
            
    }
    public function documentStudentCreate(){
        $documentType = DocumentType::all();
        return view('UsersViews.estudiante.documentos.nuevoDocumento',compact('documentType'));
    }
    public function documentStudentStore(Request $request){
        //dd(DocumentType::where('id',$request->documentType)->first());
        $document_type = DocumentType::where('id',$request->documentType)->first();
        $idStudent = $request->studen;
        $ciStudent = $request->cedula;
        if($request->file('documento') == null){
             return redirect()->route('addDocument');
        }else{
             $documento = $request->file('documento');
             $extencion = $request->file('documento')->extension();
             $nombre_comprobante = $ciStudent.'-Doc-'.$request->documentType.'.'.$extencion;
             if(File::exists(public_path('img/documentsStudents/'.$nombre_comprobante))){
                Session::flash('alert', "No puede agregar el mismo tipo de documento 2 veces...");
                return redirect()->route('addDocument');
            }else{
                $documento->move('img/documentsStudents/', $nombre_comprobante);
                $model = new DocumentStudens;
                $model->id_studen = $idStudent;
                $model->id_document_type = $document_type->id;
                $model->url = 'img/documentsStudents/'.$nombre_comprobante;
                $model->document_name = $nombre_comprobante;
                $model->document_extension = $extencion;
                $model->update_date = Carbon::now();
                $model->id_status = $document_type->id_status;
                $model->save();
                return redirect()->route('documentacionEstudiantil');
            }
             
        }
       
    }
    public function deleteDocument($id){
       // dd($id);
        $documento = DocumentStudens::find($id);
        if(File::exists(public_path($documento->url))){
            File::delete(public_path($documento->url));
        }
        $documento->delete();
        return redirect()->route('documentacionEstudiantil')->with('message', '¡Eliminado Correctamente!')->with('type','success');        
    }

    public function rutaDocumento($id){
        
        $documentType = DocumentType::find($id);
        //dd($documentType->docMuestra);
        return $documentType->docMuestra;
    }
 
}
