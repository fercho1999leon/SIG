<?php

namespace App\Http\Controllers;
use App\Administrative;
use Illuminate\Http\Request;
use App\Transact;
use App\Addressee;
use App\TypeRequest;
use App\RequestUser;
use App\Course;
use App\Career;
use App\Student2Profile;
use Illuminate\Support\Facades\DB;
use App\Student2;
use App\Semesters;
use App\Cuentasporcobrar;
use Carbon\Carbon;
use App\PeriodoLectivo;
use Sentinel;
use Validator;
use App\Http\Controllers\BibliotecaReportController;
use Yajra\Datatables\Datatables;
class AcademicRequestsController extends Controller
{
    public function index(){

        //$tipo_Solicitud = TypeRequest::all();
        $tipo_Solicitud = DB::table("request_type_tbl")
        ->join("transact_tbl", "transact_tbl.id", "=", "request_type_tbl.id_transact")
        ->join("addressee_tbl", "addressee_tbl.id", "=", "request_type_tbl.id_addressee")
        ->get();
       
        return view('UsersViews.administrador.solicitudes.index')->with('tipo_Solicitud',$tipo_Solicitud);
      
    }

    public function create_requests(){
      
        return view('UsersViews.administrador.solicitudes.crear');
      
    }
    public function post_requests_create(Request $request){
        //Inserta el Titulo en la tabla de transaccion 
        //dd($request);
        Transact::create([
            'title' =>  request('name_transact'),
            'id_destinatatio' => request('id_destinatarrio'),
        ]);
        //inserta los datos en la tabla de encabezado
        Addressee::create([
            'addressee_title' => request('title_addressee'),
            'addressee_name' => request('name_addressee'),
            'addressee_departament' => request('department_responsible'),
        ]);
        
        //consulta el ultimo registro y se obtine el ID (el ultimo id ingresado es el que esta enviando
        //el usuario 
        $transact = Transact::latest('id')->first();
        $addressee = Addressee::latest('id')->first();
        $id_transact = $transact->pluck('id')->last();
        $id_addressee = $addressee->pluck('id')->last();
        
        //Inserta los id generados en las tablas de transact y de encabezado 
        TypeRequest::create([
            'id_transact' => $id_transact,
            'id_addressee' => $id_addressee,
            'amount' => request('transact_amount'),
        ]);

        return redirect()->route('solicitudes');
    }

    public function getAll(){
        $tipo_Solicitud = DB::table("request_type_tbl")
        ->join("transact_tbl", "transact_tbl.id", "=", "request_type_tbl.id_transact")
        ->join("addressee_tbl", "addressee_tbl.id", "=", "request_type_tbl.id_addressee")
        
        ->get();
       
        return view('UsersViews.administrador.solicitudes.index')->with('tipo_Solicitud',$tipo_Solicitud);
    }
    public function get($id){
        $tipo_Solicitud = DB::table("request_type_tbl")
        ->join("transact_tbl", "transact_tbl.id", "=", "request_type_tbl.id_transact")
        ->join("addressee_tbl", "addressee_tbl.id", "=", "request_type_tbl.id_addressee")
        ->where("request_type_tbl.id", "=", $id)
        ->get();
        return $tipo_Solicitud;

    }
    public function edit($id){
        $tipo_Solicitud = DB::table("request_type_tbl")
        ->join("transact_tbl", "transact_tbl.id", "=", "request_type_tbl.id_transact")
        ->join("addressee_tbl", "addressee_tbl.id", "=", "request_type_tbl.id_addressee")
        ->where("request_type_tbl.id","=",$id)
        ->get();
       
        return view('UsersViews.administrador.solicitudes.edit')->with('tipo_Solicitud',$tipo_Solicitud);
    }
    public function post_requests_edit(Request $request, $id){
        //Actualiza el Titulo en la tabla de transaccion 
        $post = Transact::find($id);
        $post->title = request('name_transact');
        $post->save();

       
        //inserta los datos en la tabla de encabezado
        $post2 = Addressee::find($id);
        $post2->addressee_title = request('title_addressee');
        $post2->addressee_name = request('name_addressee');
        $post2->addressee_departament = request('department_responsible');
        $post2->save();
                
        //consulta el ultimo registro y se obtine el ID (el ultimo id ingresado es el que esta enviando
        //el usuario 
        $transact = Transact::latest('id')->first();
        $addressee = Addressee::latest('id')->first();
        $id_transact = $transact->pluck('id')->last();
        $id_addressee = $addressee->pluck('id')->last();
        
        $post3 = TypeRequest::find($id);
        $post3->amount = request('transact_amount');
        $post3->save();

       
        //$tipo_Solicitud = TypeRequest::with('transact','addressee');
        $tipo_Solicitud = DB::table("request_type_tbl")
        ->join("transact_tbl", "transact_tbl.id", "=", "request_type_tbl.id_transact")
        ->join("addressee_tbl", "addressee_tbl.id", "=", "request_type_tbl.id_addressee")
        
        ->get();
   
        return view('UsersViews.administrador.solicitudes.index')->with('tipo_Solicitud',$tipo_Solicitud);
    }
    public function solicitudesDelete($id){

        $typeRequest = TypeRequest::find($id);
        $typeRequest->delete();
    
        $transact = Transact::find($id);
        $transact->delete();
        $addressee = Addressee::find($id);
        $addressee->delete();
     
        return redirect()->route('solicitudes');
    }



    // seccion para solicitudes de estudiantes
    public function estudiantesIndex(){
        if(session('horaInicio') != null && session('user') != null){
            $sessionHora = new BibliotecaReportController;
            $sessionHora->sessionHora();
          }
        $user = Sentinel::getUser();
        $user_profile = Administrative::findBySentinelid($user->id);
        $estudiante = Student2::where('idProfile',$user_profile->id)->first();
        
        //dd($estudiante->id);
        $solicitud = RequestUser::all()->where('id_student','=',$estudiante->id);
        //dd($solicitud);
        return view('UsersViews.administrador.solicitudesEstudiante.index')->with('solicitud',$solicitud);
    }

    public function estudiantesCreate_requests($id){
        
        $solicitud = DB::table("request_type_tbl")
        ->join("transact_tbl", "transact_tbl.id", "=", "request_type_tbl.id_transact")
        ->join("addressee_tbl", "addressee_tbl.id", "=", "request_type_tbl.id_addressee")
        ->get();
        
        $data = Student2::where('id',$id)->first();
        //dd($id,$data);
        $estudiante = Student2Profile::where('idStudent','=',$data->id)->first();
        $semestre = Course::where('id','=',$estudiante->idCurso)->first();
        $career = Career::find($semestre->id_career);
        $estudiante_id = $estudiante->idStudent;
        
        return view('UsersViews.administrador.solicitudesEstudiante.crear', compact(
			'solicitud', 'career','estudiante','estudiante_id'
		));
    }

    public function postStudent_requests_create(Request $request){
        //dd($request);
        Validator::make($request->all(), [
            'descriptions' => 'required',
            'valor' => 'required'
        ],[
            'required'    => 'El campo :attribute es requerido',
        ],[
            'descriptions' => 'descripcón',
            'valor' => 'solicitud',
        ])->validate();
        $cxc= $this->create_cuenta_por_cobrar($request->id_student,$request->valor,$request->title_transact);
        RequestUser::create([
            'title_transact' => request('title_transact'),
            'title_addressee' => request('title_addressee'),
            'name_addressee' => request('name_addressee'),
            'department_addressee' => request('department_addressee'),
            'ci_student' => request('ci_student'),
            'name_student' => request('name_student'),
            'career_student' => request('career'),
            'detail_transact' => mb_strtoupper(request('descriptions'), 'UTF-8'),
            'valor' => request('valor'),
            'id_student'=>request('id_student'),
            'cxc' => $cxc,
            'id_destinatario' =>  request('id_destinarario'),
        ]);
        
        return redirect()->route('solicitudesEstudiantes');
    }
    public function create_cuenta_por_cobrar($id,$valor,$concepto){
        $data = Student2::where('id',$id)->first();
        $estudiante = Student2Profile::where('idStudent',$data->id)->first();
        $cuentasxcobrar = Cuentasporcobrar::where('cliente_id','=',$estudiante->id )->get();
        $semestre = Course::where('id','=',$estudiante->idCurso)->first();
        $periodos = PeriodoLectivo::where('id','=',$semestre->idPeriodo)->first();
        $semestreCarrera = Semesters::where('career_id','=',$semestre->id_career)->first();
                    $fechaPago = Carbon::now();
                    $cxc = new Cuentasporcobrar();
                    $fecha = $fechaPago;
                    $cxc->fecha_emision  =  Carbon::now();
                    $cxc->fecha_vencimiento  =  $fecha->addDay(10);
                    $cxc->comprobante_id  =  11;
                    $cxc->debito  =  $valor;
                    $cxc->credito  =  0;
                    $cxc->cliente_id  =  $estudiante->id ;                
                    $cxc->saldo = $valor;
                    $cxc->concepto  =  $concepto;
                    $cxc->id_semesters = $semestre->id;
                    $cxc->save();
                    DB::commit();
                    return $cxc->id;
    }
    
    public function estudiantesPDF(){
        $solicitud = RequestUser::all();
        return view('UsersViews.administrador.solicitudesEstudiante.index')->with('solicitud',$solicitud);
    }

    public function solicitudesEstudiantesDelete($id){
        $requestUser = RequestUser::find($id);
        $requestCxC =   Cuentasporcobrar::where('id','=',$requestUser->cxc)->first();
        $requestCxC->status = "0";
        $requestCxC->save();
        $requestUser->delete();
        return redirect()->route('solicitudesEstudiantes');
    }

    public function solicitudesRecibidas(){
        return view('UsersViews.docente.solicitudes.index');
    }
    public function solicitudesPorDestinatario($id){
        $model = RequestUser::
        select('id','title_transact','name_student','career_student','ci_student','detail_transact','date_creation')
    ->where('id_destinatario','=',$id)
    ->where('status','=','2')
    ->get();

    // dd($model);
    return Datatables::of($model)
    ->addColumn('btn', 'UsersViews.docente.solicitudes.accion')
    ->rawColumns(['btn'])
    ->make(true);

    }
    public function solicitudesRecibidasSecretaria(){
        return view('UsersViews.secretaria.solicitudes.index');
    }
    public function solicitudesGeneralSecretaria(){
        $model = RequestUser::
        select('id','title_transact','name_student','career_student','ci_student','detail_transact','date_creation')
        ->where('status','=','1')
        ->get();

    //dd($model);
    return Datatables::of($model)
    ->addColumn('btn', 'UsersViews.secretaria.solicitudes.accion')
    ->rawColumns(['btn'])
    ->make(true);

    }

}
