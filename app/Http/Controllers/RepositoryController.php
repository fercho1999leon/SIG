<?php

namespace App\Http\Controllers;
use App\Cuentasporcobrar;
use App\TypeDocument;
use App\Document;
use App\Repository;
use App\Career;
use App\StatusDocument;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Yajra\Datatables\Datatables;
use Illuminate\Http\Request;
use Carbon\Carbon;


class RepositoryController extends Controller
{
    public function index(){
        return view('UsersViews.administrador.repositorio.index');
    }

    public function indexGeneral(){
        
        return view('UsersViews.administrador.repositorio.index-general');
    }
    public function indexTesis(){
        return view('UsersViews.administrador.repositorio.index-tesis');
    }
    public function indexTesinas(){
        return view('UsersViews.administrador.repositorio.index-tesinas');
    }
    public function tablaGeneral()
    {
        $model = Repository::join('document','document.id','=','repository.id_document')        
                    ->join('type_document','type_document.id','=','repository.id_documente_type')
                    ->join('status_document','status_document.id','=','document.id_status')
                    
                    ->join('Career', 'repository.id_carrer', '=', 'Career.id')
                    ->select(
                        'repository.id','repository.id_student','repository.id_carrer','repository.status',
                        'type_document.name as type_document_name','Career.nombre as carrera',
                        DB::raw("CONCAT(document.author_primary, ' ', document.author_secondary, ' ', document.author_auxiliary) AS authores"),
                        'document.id as id_document','document.title as title_document','document.author_primary','document.author_secondary','document.author_auxiliary',
                        'document.tutor as tutor','document.keywords','document.editorial','document.summary','document.uri as link',
                        'document.upload_date as fecha_publicacion','status_document.name as estado','document.activation_date')
                    
                    ->get();
        //dd($model);
        return Datatables::of($model)
        ->addColumn('btn', 'UsersViews.administrador.repositorio.accion-general')
        ->rawColumns(['btn'])
            ->make(true);
    }

    public function tablaTesis()
    {
                $model = Repository::join('document','document.id','=','repository.id_document')        
                ->join('type_document','type_document.id','=','repository.id_documente_type')
                ->join('status_document','status_document.id','=','document.id_status')
                
                ->join('Career', 'repository.id_carrer', '=', 'Career.id')
                ->select(
                    'repository.id','repository.id_student','repository.id_carrer','repository.status','repository.id_documente_type as tipo_documento',
                    'type_document.name as type_document_name','Career.nombre as carrera',
                    DB::raw("CONCAT(document.author_primary, ' ', document.author_secondary, ' ', document.author_auxiliary) AS authores"),
                    'document.id as id_document','document.title as title_document','document.author_primary','document.author_secondary','document.author_auxiliary',
                    'document.tutor as tutor','document.keywords','document.editorial','document.summary','document.uri as link',
                    'document.upload_date as fecha_publicacion','status_document.name as estado','document.activation_date')
                ->where('repository.id_documente_type','=',1)
                ->get();
        //dd($model);
        return Datatables::of($model)
        ->addColumn('btn', 'UsersViews.administrador.repositorio.accion-general')
        ->rawColumns(['btn'])
        ->make(true);
    }

    public function tablaTesinas()
    {
                $model = Repository::join('document','document.id','=','repository.id_document')        
                ->join('type_document','type_document.id','=','repository.id_documente_type')
                ->join('status_document','status_document.id','=','document.id_status')
                
                ->join('Career', 'repository.id_carrer', '=', 'Career.id')
                ->select(
                    'repository.id','repository.id_student','repository.id_carrer','repository.status','repository.id_documente_type as tipo_documento',
                    'type_document.name as type_document_name','Career.nombre as carrera',
                    DB::raw("CONCAT(document.author_primary, ' ', document.author_secondary, ' ', document.author_auxiliary) AS authores"),
                    'document.id as id_document','document.title as title_document','document.author_primary','document.author_secondary','document.author_auxiliary',
                    'document.tutor as tutor','document.keywords','document.editorial','document.summary','document.uri as link',
                    'document.upload_date as fecha_publicacion','status_document.name as estado','document.activation_date')
                ->where('repository.id_documente_type','=',2)
                ->get();
        //dd($model);
        return Datatables::of($model)
        ->addColumn('btn', 'UsersViews.administrador.repositorio.accion-general')
        ->rawColumns(['btn'])
        ->make(true);
    }

    public function newRepositorio(){
        $typeDocument = TypeDocument::all();
        $repositorio = new Repository;
        $document = new Document;
        $careers = Career::all()->where('estado', '=', '1');
        return view('UsersViews.administrador.repositorio.repositorio_doc.crear', compact('typeDocument','careers','document','repositorio'));
    }
    public function newRepositorioCreate(Request $request){
        //dd($request);
        //dd($request->file('uri')->extension());
        try {
            if($request!=null){
                if ($request->hasFile('uri')) {
                    $document = new Document;
                    $repository = new Repository;
                    $document->title = $request->title;
                    $document->author_primary = $request->primaryAutthor;
                    $document->author_secondary = $request->secundaryAutthor;
                    $document->author_auxiliary = $request->auxiliaryAutthor;
                    $document->id_tutor = $request->id_tutor;
                    $document->tutor = $request->name_addressee;
                    $document->keywords = $request->keywords;
                    $document->editorial = $request->editorial;
                    $document->summary = $request->summary;
                    $document->numberOfPages = $request->numberOfPages;
                    $document->promotion = $request->promocion;
                    $document->documentFormat =  $request->file('uri')->extension();
                    $documento = $request->file('uri');
                    $nombre_documento = $documento->getClientOriginalName();
                    $documento->move('repositorios', $nombre_documento);
                    
                    $document->uri = $nombre_documento;
                    $document->upload_date = Carbon::now();
                    $document->id_status = 2;

                    $document->save();
                    $repository->id_documente_type = $request->typeDocument;
                    $repository->id_document = $document->id;
                    $repository->id_carrer = $request->curso;
                    $repository->status = $request->estado;

                    $repository->save();
                    return redirect()->route('repositorioGeneral')->with('message', '¡Agregado Correctamente!')->with('type','success');
                }else{
                    $document = new Document;
                    $repository = new Repository;
                    $document->title = $request->title;
                    $document->author_primary = $request->primaryAutthor;
                    $document->author_secondary = $request->secundaryAutthor;
                    $document->author_auxiliary = $request->auxiliaryAutthor;
                    $document->id_tutor = $request->id_tutor;
                    $document->tutor = $request->name_addressee;
                    $document->keywords = $request->keywords;
                    $document->editorial = $request->editorial;
                    $document->summary = $request->summary;
                    $document->numberOfPages = $request->numberOfPages;
                    $document->promotion = $request->promocion;
                    
                    $document->id_status = 3;

                    $document->save();
                    $repository->id_documente_type = $request->typeDocument;
                    $repository->id_document = $document->id;
                    $repository->id_carrer = $request->curso;
                    $repository->status = $request->estado;

                    $repository->save();
                    return redirect()->route('repositorioGeneral')->with('message', '¡Agregado Correctamente! Sin Archivo')->with('type','warning');
                }
            }
        } catch (Exception $e) {
            return $e->getMessage();
        }

    }
    public function editRepositorio($id){
        $repositorio = Repository::where('id','=',$id)->first();
        $document = Document::where('id','=',$repositorio['id_document'])->first();
        //dd($repositorio, $document);
        $typeDocument = TypeDocument::all();
        $careers = Career::all()->where('estado', '=', '1');
        return view('UsersViews.administrador.repositorio.repositorio_doc.crear', compact('typeDocument','careers','document','repositorio'));
    }
    public function editRepositorioUpdate(Request $request){
        //dd($request);
        try {
            if($request!=null){
                if ($request->hasFile('uri')) {
                    
                    $repository = Repository::findOrFail($request->idRepositorio);
                    $document = Document::findOrFail($request->idDocument);
                    //dd($document,$repository);
                    $document->title = $request->title;
                    $document->author_primary = $request->primaryAutthor;
                    $document->author_secondary = $request->secundaryAutthor;
                    $document->author_auxiliary = $request->auxiliaryAutthor;
                    $document->id_tutor = $request->id_tutor;
                    $document->tutor = $request->name_addressee;
                    $document->keywords = $request->keywords;
                    $document->editorial = $request->editorial;
                    $document->summary = $request->summary;
                    $document->numberOfPages = $request->numberOfPages;
                    $document->promotion = $request->promocion;
                    $document->documentFormat =  $request->file('uri')->extension();

                    $documento = $request->file('uri');
                    $nombre_documento = $documento->getClientOriginalName();
                    $documento->move('repositorios', $nombre_documento);
                    
                    $document->uri = $nombre_documento;
                    $document->upload_date = Carbon::now();
                    
                    $document->id_status = 2;

                    $document->save();
                    
                    $repository->id_documente_type = $request->typeDocument;
                    $repository->id_document = $document->id;
                    $repository->id_carrer = $request->curso;
                    $repository->status = $request->estado;

                    $repository->save();
                    return redirect()->route('repositorioGeneral')->with('message', '¡Actualizado Correctamente!')->with('type','success');
                }else{
                    $repository = Repository::findOrFail($request->idRepositorio);
                    $document = Document::findOrFail($request->idDocument);
                    $document->title = $request->title;
                    $document->author_primary = $request->primaryAutthor;
                    $document->author_secondary = $request->secundaryAutthor;
                    $document->author_auxiliary = $request->auxiliaryAutthor;
                    $document->id_tutor = $request->id_tutor;
                    $document->tutor = $request->name_addressee;
                    $document->keywords = $request->keywords;
                    $document->editorial = $request->editorial;
                    $document->summary = $request->summary;
                    $document->numberOfPages = $request->numberOfPages;
                    $document->promotion = $request->promocion;
                    
                    $document->id_status = 3;

                    $document->save();
                    $repository->id_documente_type = $request->typeDocument;
                    $repository->id_document = $document->id;
                    $repository->id_carrer = $request->curso;
                    $repository->status = $request->estado;

                    $repository->save();
                    return redirect()->route('repositorioGeneral')->with('message', '¡Actualizado Correctamente! Sin Archivo')->with('type','warning');
                }
            }
        } catch (Exception $e) {
            return $e->getMessage();
        }

    }






    //Seccion Ajustes 
    public function repositorioAjustes(){
        return view('UsersViews.administrador.repositorio.ajustesIndex');
    }
    //Seccion Ajustes Tipo de Documentos
    public function tipoDocumentos(){
        
        return view('UsersViews.administrador.repositorio.ajustesType');
    }
    public function tipoDocumentoEdit($id, $seccion){
        $typeDocument = TypeDocument::where('id','=',$id)->first();
        return view('UsersViews.administrador.repositorio.ajustesTypeAdd', compact('seccion','typeDocument'));
    }

    public function listTypeDocument(){
        $typeDocument = TypeDocument::all();
        return Datatables::of($typeDocument)
        ->addColumn('btn', 'UsersViews.administrador.repositorio.accionesAjustes.accionesType')
        ->rawColumns(['btn'])
            ->make(true);
    }

    public function newDocument(){
        $seccion = 1;
        return view('UsersViews.administrador.repositorio.ajustesTypeAdd',compact('seccion'));
    }
    
    public function newDocumentStore(Request $request){
        $document_type = new TypeDocument();
        $document_type->name = $request->name;
        $document_type->save();
        Session::flash('alert', "Se han Agregado el Tipo de Documento de Forma Correcta");
        return  redirect()->route('tipoDocumentos');
    }
    public function tipoDocumentoUpdate(Request $request){
        $status_type = TypeDocument::where('id','=',$request->id)->first();
        $status_type->name = $request->name;
        $status_type->save();
        Session::flash('alert', "Se han Actualizado el Estado de Forma Correcta");
        return  redirect()->route('tipoDocumentos');
    }

    //Seccion ajustes Estados 
    public function listStatusDocument(){
        return view('UsersViews.administrador.repositorio.ajustesStatus');
    }
    public function newStatus(){
        $seccion = 1;
        $typeDocument = 1;
        return view('UsersViews.administrador.repositorio.ajustesStatusAdd',compact('seccion','typeDocument'));
    }
    public function editStatus($id,$seccion){
        $typeDocument = StatusDocument::where('id','=',$id)->first();
        return view('UsersViews.administrador.repositorio.ajustesStatusAdd',compact('seccion','typeDocument'));
    }
    public function newStatusStore(Request $request){
        $status_type = new StatusDocument();
        $status_type->name = $request->name;
        $status_type->save();
        Session::flash('alert', "Se han Agregado el Estado de Forma Correcta");
        return  redirect()->route('listStatusDocument');
    }
    public function editStatusUpdate(Request $request){
        $status_type = StatusDocument::where('id','=',$request->id)->first();
        $status_type->name = $request->name;
        $status_type->save();
        Session::flash('alert', "Se han Actualizado el Estado de Forma Correcta");
        return  redirect()->route('listStatusDocument');
    }

    public function listStatusTbl(){
        $typeDocument = StatusDocument::all();
        return Datatables::of($typeDocument)
        ->addColumn('btn', 'UsersViews.administrador.repositorio.accionesAjustes.accionesStatus')
        ->rawColumns(['btn'])
            ->make(true);
    }
    

    //Seccion estudiantes
    public function indexEstudiante(){
        return view('UsersViews.estudiante.repositorio.index');
    }

    public function tablaEstudiantes()
    {
        $model = Repository::join('document','document.id','=','repository.id_document')        
        ->join('type_document','type_document.id','=','repository.id_documente_type')
        ->join('status_document','status_document.id','=','document.id_status')
        
        ->join('Career', 'repository.id_carrer', '=', 'Career.id')
        ->select(
            'repository.id','repository.id_student','repository.id_carrer','repository.status',
            'type_document.name as type_document_name','Career.nombre as carrera',
            DB::raw("CONCAT(document.author_primary, ' ', document.author_secondary, ' ', document.author_auxiliary) AS authores"),
            'document.id as id_document','document.title as title_document','document.author_primary','document.author_secondary','document.author_auxiliary',
            'document.tutor as tutor','document.keywords','document.editorial','document.summary','document.uri as link',
            'document.upload_date as fecha_publicacion','status_document.name as estado','document.activation_date')
        
        ->get();
        //dd($model);
        return Datatables::of($model)
        ->addColumn('btn', 'UsersViews.estudiante.repositorio.acciones')
        ->rawColumns(['btn'])
        ->make(true);
    }

    public function previewRepository($id){
        $model = $this->dataPreview($id);
        $tipoUser = 1;
        return view('UsersViews.estudiante.repositorio.preview', compact('model','tipoUser'));
    }
    public function previewRepositoryAdmin($id){
        $model = $this->dataPreview($id);
        $tipoUser = 2;
        return view('UsersViews.estudiante.repositorio.preview', compact('model','tipoUser'));
    }
    public function downloadDocument($uri){
        $file = Storage::disk('public/repositorios')->get($uri);
        
        return $file;
    }

    public function dataPreview($id){
        $model = Repository::join('document','document.id','=','repository.id_document')        
                ->join('type_document','type_document.id','=','repository.id_documente_type')
                ->join('status_document','status_document.id','=','document.id_status')
                
                ->join('Career', 'repository.id_carrer', '=', 'Career.id')
                ->select(
                    'repository.*',
                    'type_document.name as type_document_name','Career.nombre as carrera',
                    DB::raw("CONCAT(document.author_primary, ' - ', document.author_secondary, ' - ', document.author_auxiliary) AS authores"),
                    'document.id as id_document','document.title as title_document','document.author_primary','document.author_secondary','document.author_auxiliary',
                    'document.tutor as tutor','document.keywords','document.editorial','document.summary','document.uri as link',
                    'document.upload_date as fecha_publicacion','status_document.name as estado','document.activation_date',
                    'document.promotion','document.numberOfPages','document.documentFormat')
                ->where('repository.id_document','=',$id)
                ->first();
                return $model;
    }
}
