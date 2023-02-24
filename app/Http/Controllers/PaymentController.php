<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Cuentasporcobrar;
use App\Student2Profile;
use App\Student2;
use App\Career;
use App\Course;
use App\HistoricosPagos;
use Carbon\Carbon;
use App\User;
use Sentinel;
use App\PeriodoLectivo;
use App\ConfiguracionSistema;
use App\RequestUser;
use Illuminate\Support\Facades\DB;
use Yajra\Datatables\Datatables;
class PaymentController extends Controller
{
    //
    public function listPay(){
        return view('UsersViews.estudiante.pagos.index');
    }
    public function tablaPagosEstudiante($id){
        $id_cliente = Student2Profile::where('idStudent','=',$id)->pluck('id');
        /*$data = Cuentasporcobrar::join('students2_profile_per_year','students2_profile_per_year.id','=','cuentas_por_cobrar.cliente_id')        
        ->join('students2','students2.id','=','students2_profile_per_year.idStudent')
        ->select('students2.nivelAcademicoQueCursa')
        ->where('students2_profile_per_year.id','=',$id_cliente)->get();
        dd($data);*/
        //dd(Student2Profile::where('idStudent','=',$id)->get());
        $model = Cuentasporcobrar::
        join('students2_profile_per_year','students2_profile_per_year.id','=','cuentas_por_cobrar.cliente_id')        
        ->join('students2','students2.id','=','students2_profile_per_year.idStudent')
        ->join('courses', 'students2_profile_per_year.idCurso', '=', 'courses.id')
        ->join('Semesters', 'cuentas_por_cobrar.id_semesters','=', 'Semesters.id')
        ->select(
        'cuentas_por_cobrar.id as idCuenta'
        ,'cuentas_por_cobrar.fecha_emision as fecha_emision',
        'cuentas_por_cobrar.fecha_vencimiento as fecha_vencimiento',
        'cuentas_por_cobrar.comprobante_id as comprobante_id',
        'Semesters.nombsemt as semestre',
        DB::raw("CONCAT(students2.nombres, ' ', students2.apellidos) AS full_name"),
        'cuentas_por_cobrar.concepto as concepto',
        'cuentas_por_cobrar.saldo as saldo',
        'cuentas_por_cobrar.debito as debito',
        'cuentas_por_cobrar.credito as credito',
        
        \DB::raw('(CASE
                        WHEN cuentas_por_cobrar.status = "1" THEN "POR VENCER"                        
                        WHEN cuentas_por_cobrar.status = "2" THEN "PAGADA"                        
                        WHEN cuentas_por_cobrar.status = "3" THEN "ABONADO"                        
                        WHEN cuentas_por_cobrar.status = "4" THEN "EN PROCESO DE VERIFICACION"   
                        WHEN cuentas_por_cobrar.status = "0" THEN "ELIMINADA"                        
                        WHEN cuentas_por_cobrar.status = "10" THEN "PAGO RECHAZADO POR INCONSISTENCIA"                        
                        END) AS estado'),
        DB::raw("cuentas_por_cobrar.saldo - cuentas_por_cobrar.debito as deuda"),
        'students2.ci as cedulaEstudiante',
        'students2.id as IDEstudiante'
    )->orderBy('cuentas_por_cobrar.status')
    ->where('students2_profile_per_year.id','=',$id_cliente)
    ->get();

        //dd($model);
        return Datatables::of($model)
        ->addColumn('btn', 'UsersViews.estudiante.pagos.accion')
        ->rawColumns(['btn'])
        ->make(true);
    }
    public function pagoEstudianteCreate($id){
        $cuentaxpagar = Cuentasporcobrar::find($id);
        $cliente = Student2Profile::where('id','=',$cuentaxpagar->cliente_id)->first();
        $studiante = Student2::where('id','=',$cliente->idStudent)->first();
        $curso = Course::find($cliente->idCurso);
        $carrera = Career::find($curso->id_career);
        //dd($studiante,$cliente, $cuentaxpagar,$carrera,$curso);
        //dd($cuentaxpagar);
        return view('UsersViews.estudiante.pagos.pago_estudiante',compact('cuentaxpagar','studiante','cliente','carrera','curso'));
    }
    public function pagoEstudianteStore(Request $request){
       
       if($request->file('comprobante_img') == null){
       // dd($request);
        Session::flash('alert', "Debe de Subir una foto del comprobante ");
        return redirect()->route('pagosEstudiante');
       }else{
        $documento = $request->file('comprobante_img');
        $extencion = $request->file('comprobante_img')->extension();
        $nombre_comprobante = $request->cedulaEstudiante.'-'.$request->idCuenta.' ' . $request->conceptoPagoEstudiante.'.'.$extencion;
        $documento->move('img/comprobantesPago', $nombre_comprobante);
        //dd($request,$nombre_comprobante,$nombre_comprobante,$extencion);
        //$document->uri = $nombre_documento;
        $cuentaxpagar = Cuentasporcobrar::find($request->idCuenta);
        $cuentaxpagar->valor_comprobante = $request->valor_cancelar;
        $cuentaxpagar->comprobante_img = $nombre_comprobante;
        $fecha_comprobante =  Carbon::now()->format('Y-m-d');
        /*$cuentaxpagar->fecha_comprobante = $request->fecha_pago;*/
        $cuentaxpagar->fecha_comprobante = Carbon::now()->format('Y-m-d');
        $cuentaxpagar->status = 4;
        $cuentaxpagar->save();
        Session::flash('alert2', "Se han enviado el pago de Forma Correcta");
        
        return redirect()->route('pagosEstudiante');
       }
        
    }
    
    public function pagoEstudianteManualCreate($id){        
        $cuentaxpagar = Cuentasporcobrar::find($id);
        $cliente = Student2Profile::where('id','=',$cuentaxpagar->cliente_id)->first();
        $studiante = Student2::where('id','=',$cliente->idStudent)->first();
        $curso = Course::find($cliente->idCurso);
        $carrera = Career::find($curso->id_career);        
        return view('UsersViews.colecturia.cuentas_cobrar.pagos.indexPago',compact('cuentaxpagar','studiante','cliente','carrera','curso'));    
    }

    public function pagoEstudianteManualStore(Request $request){
        //dd($request);
        
       
        $cxc = Cuentasporcobrar::find($request->idCuenta);
        $cliente = Student2Profile::where('id','=',$cxc->cliente_id)->first();
        if($request->conceptoPagoEstudiante == "Matricula del Semestre"){
            $periodoLectivo = PeriodoLectivo::findOrFail($this->idPeriodoUser());
            $cont = Student2Profile::where('tipo_matricula', '!=', 'Pre Matricula')
            ->where('idPeriodo', $this->idPeriodoUser())
            ->get()
            ->count();
            $cliente->numero_matriculacion = substr($periodoLectivo->fecha_inicial, 0, 4) . "-" . sprintf("%04d", $cont + 1);
           // dd($periodoLectivo,$cliente->numero_matriculacion);   
           $cliente->tipo_matricula = "Ordinaria" ;
           $cliente->save();
        }        
            $cxc->credito  = $cxc->credito + $request->valor_cancelar;
            $cxc->saldo = $cxc->debito - $cxc->credito;
            $cxc->valor_comprobante = $request->valor_cancelar;
            $cxc->fecha_comprobante = $request->fecha_pago;
            $cxc->num_factura = $request->num_factura;
            
            if($cxc->saldo > 0){
                $cxc->status = 3;
                $cxc->comprobante_img = "";
                $cxc->valor_comprobante = "";
                $cxc->fecha_comprobante = "";
            }else{
                $cxc->status = 2;
                $cxc->comprobante_img = "";
                $cxc->valor_comprobante = "";
                $cxc->fecha_comprobante = "";
            }        
           // $this->crearMatricular($request->idCuenta);
            //dd($cxc);
            $cxc->save();
            
            
            $historicopago = new HistoricosPagos();
            $historicopago->fecha_vencimiento = $cxc->fecha_vencimiento;
            $historicopago->fecha = $request->fecha_pago;
            $historicopago->concepto = $cxc->concepto;
            //$historicopago->imagen = $cxc->comprobante_img;
            $historicopago->formapago_id = $request->forma_pago;
            $historicopago->valor = $request->valor_cancelar;
            $historicopago->observacion = $request->observaciones;
            $historicopago->cuentacobrar_id = $cxc->id;
            $historicopago->num_factura = $request->num_factura;
            $historicopago->save();

            $solicitud = RequestUser::where('cxc','=',$cxc->id)->first();
            
                if($solicitud == null){
                    Session::flash('alertTrue', "Se han procesado el pago de Forma Correcta");
                
                    return redirect()->route('cuentasporcobrar');
                }else{
                    $solicitud->status = 2;
                    $solicitud->save();
                    Session::flash('alertTrue', "Se han procesado el pago de Forma Correcta");
                
                    return redirect()->route('cuentasporcobrar');
                }

             
    }

    public function crearMatricular($id){
        //dd("aqui");
        $cuentaxpagar = Cuentasporcobrar::find($id);
        $contador_matricula = ConfiguracionSistema::contadorMatricula();
        $cliente = Student2Profile::where('id','=',$cuentaxpagar->cliente_id)->first();
        $studiante = Student2::where('id','=',$cliente->idStudent)->first();
        $curso = Course::find($cliente->idCurso);
        $carrera = Career::find($curso->id_career);

        $estadoAnterior = $studiante->matricula;
        //dd($studiante);
        //dataProfile = cliente
        //data = studiante
        //if ($request->matricula != 'Pre Matricula') {
        if ($studiante->matricula == 'Pre Matricula') {
            $periodoLectivo = PeriodoLectivo::findOrFail($this->idPeriodoUser());
            if ($contador_matricula->valor == 'G') {
                $cont = Student2Profile::where('tipo_matricula', '!=', 'Pre Matricula')
                    ->where('idPeriodo', $this->idPeriodoUser())
                    ->get()
                    ->count();
                $cliente->numero_matriculacion = substr($periodoLectivo->fecha_inicial, 0, 4) . "-" . sprintf("%04d", $cont + 1);
            } else {
                $cont = Student2Profile::where('seccion', $cliente->seccion)
                    ->where('tipo_matricula', '!=', 'Pre Matricula')
                    ->where('idPeriodo', $this->idPeriodoUser())
                    ->get()
                    ->count();
                $cliente->numero_matriculacion = substr($periodoLectivo->fecha_inicial, 0, 4) . "-" . sprintf("%04d", $cont + 1);
            }
            $cliente->fecha_matriculacion = Carbon::now()->format('Y-m-d');

            if ($studiante->idProfile == null) {
                // Creando el usuario
                $user = new User;
                $nombres = explode(" ", $studiante->nombres);
                $apellidos = explode(" ", $studiante->apellidos);
                $primerNombre = strtolower($nombres[0]);
                $primerApellido = strtolower($apellidos[0]);

                $user_sentinel = [
                    'email' => $request->correo ?? $primerNombre . '.' . $primerApellido . $studiante->id . "@pined.ec",
                    'password' => "12345",
                ];
                $user = Sentinel::registerAndActivate($user_sentinel);
                $user->idPeriodoLectivo = $this->idPeriodoUser();
                $user->save();

                //registra el rol de los usuarios
                $role = Sentinel::findRoleByName("Estudiante");
                $role->users()->attach($user);
                $idProfile = DB::table('users_profile')
                    ->insertGetId([
                        'ci' => $studiante->ci,
                        'nombres' => $studiante->nombres,
                        'apellidos' => $studiante->apellidos,
                        'sexo' => $studiante->sexo,
                        'fNacimiento' => $studiante->fechaNacimiento,
                        'correo' => $dataProfile->correo ?? $user->email,
                        'dDomicilio' => $studiante->dDomicilio,
                        'tDomicilio' => $studiante->tDomicilio,
                        'cargo' => "Estudiante",
                        'userid' => $user->id,
                        'created_at' => date("Y-m-d H:i:s"),
                    ]);
                $studiante->idProfile = $idProfile;
               // dd($studiante);
                $data->save();
            }else{
                dd($studiante,"AAAA");    
            }

//dd($studiante);
        } 
      //  dd($studiante);
    }

    public function cancelarPago($id){
        $cuentaxpagar = Cuentasporcobrar::find($id);
        $cuentaxpagar->status = "10";
        $cuentaxpagar->comprobante_img = "";
        $cuentaxpagar->valor_comprobante = "";
        $cuentaxpagar->fecha_comprobante = "";
        $cuentaxpagar->save();
        Session::flash('alertTrue', "El Pago ha sido rechazado");
             
        return redirect()->route('cuentasporcobrar');

    }
}
