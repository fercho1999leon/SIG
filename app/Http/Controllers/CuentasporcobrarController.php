<?php

namespace App\Http\Controllers;

use App\Cuentasporcobrar;
use App\FacturaDetalles;
use App\Facturas;
use App\HistoricosPagos;
use App\Placa;
use App\Placa_Cliente;
use App\Productos;
use App\Usuarios;
use Illuminate\Http\Request;
use App\Clientes;
use App\Student2Profile;
use App\Student2;
use App\Course;
use App\Career;
use App\RequestUser;
use Illuminate\Support\Facades\View;
use test\Mockery\ReturnTypeObjectTypeHint;
use Illuminate\Support\Facades\Session;
use Validator;
use Illuminate\Support\Facades\DB;
use Yajra\Datatables\Datatables;

class CuentasporcobrarController extends Controller
{
    public function tablaCuentasPorCobrar()
    {
        /*
        $model = DB::table('cuentas_por_cobrar')
            ->join('factura_detalles', 'factura_detalles.idCliente','=','cuentas_por_cobrar.cliente_id')
            ->join('students2','students2.id','=','factura_detalles.idEstudiante')
            ->join('pagos_factura','pagos_factura.idCliente','=','factura_detalles.idCliente')
            ->join('pago_estudiante_detalles','pago_estudiante_detalles.idEstudiante','=','factura_detalles.idEstudiante')
            ->join('users_profile','users_profile.id','=','pagos_factura.idUsuario')
            ->join('students2_profile_per_year','students2_profile_per_year.idStudent','=','pago_estudiante_detalles.idEstudiante')
            
            ->select('cuentas_por_cobrar.id as idCuenta'
                    ,'cuentas_por_cobrar.fecha_emision as fecha_emision',
                    'cuentas_por_cobrar.fecha_vencimiento as fecha_vencimiento',
                    'cuentas_por_cobrar.comprobante_id as comprobante_id',
                    DB::raw("CONCAT(students2.nombres, ' ', students2.apellidos) AS full_name"),
                    'cuentas_por_cobrar.concepto as concepto',
                    'cuentas_por_cobrar.saldo as saldo',
                    'cuentas_por_cobrar.debito as debito',
                    DB::raw("cuentas_por_cobrar.saldo - cuentas_por_cobrar.debito as deuda"),
                    'students2.ci as cedulaEstudiante',
                    'students2.id as IDEstudiante',
                    'pago_estudiante_detalles.estado as estado')
            //->where('students2.ci','like',"%$valor%")
            ->groupBy('cuentas_por_cobrar.id')
            ->get();
*/
       // $model2 = DB::table('cuentas_por_cobrar')->get();
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
                ->where('cuentas_por_cobrar.status','!=','0')
                ->get();
            
       // dd($model);
        return Datatables::of($model)
        ->addColumn('btn', 'UsersViews.colecturia.cuentas_cobrar.accion')
        ->rawColumns(['btn'])
            ->make(true);
    }

    public  function verificacionPago($id){

        $cuentaxpagar = Cuentasporcobrar::find($id);
        //$contador_matricula = ConfiguracionSistema::contadorMatricula();
        $cliente = Student2Profile::where('id','=',$cuentaxpagar->cliente_id)->first();
        $studiante = Student2::where('id','=',$cliente->idStudent)->first();
        $curso = Course::find($cliente->idCurso);
        $carrera = Career::find($curso->id_career);
       
        
        //dd($studiante,$cliente, $cuentaxpagar,$carrera,$curso);
        //dd($carrera, $curso);
        return view('UsersViews.colecturia.cuentas_cobrar.pagos.index',compact('cuentaxpagar','studiante','cliente','carrera','curso'));
    }

    public function verificacionPagoStore(Request $request){
      // dd($request);
        $cxc = Cuentasporcobrar::find($request->idCuenta);
        $cliente = Student2Profile::where('id','=',$cxc->cliente_id)->first();
        //dd($cxc,$cliente);
        $comprobante_temp = $cxc->comprobante_img;
        $cxc->credito  = $cxc->credito + $cxc->valor_comprobante;
        $cxc->saldo = $cxc->debito - $cxc->credito;
        $fechaComprobante = $cxc->fecha_comprobante;
        $valorComprobante = $cxc->valor_comprobante;
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
        $cxc->save();

        $historicopago = new HistoricosPagos();
        $historicopago->fecha_vencimiento = $cxc->fecha_vencimiento;
        $historicopago->fecha =  $fechaComprobante;
        $historicopago->concepto = $cxc->concepto;
        $historicopago->imagen = $comprobante_temp;
        $historicopago->formapago_id = $request->forma_pago;
        $historicopago->valor = $valorComprobante;
        $historicopago->observacion = $request->observaciones_pago;
        $historicopago->cuentacobrar_id = $cxc->id;
        $historicopago->num_factura = $request->num_factura;
        $historicopago->save();
        $solicitud = RequestUser::where('cxc','=',$cxc->id)->first();
       
       
        if($solicitud == null){
            Session::flash('alert', "Pago Procesado de Forma Correcta");
         
            return redirect()->route('cuentasporcobrar');
        }else{
            $solicitud->status = 2;
            $solicitud->save();
            Session::flash('alert', "Pago Procesado de Forma Correcta");
         
            return redirect()->route('cuentasporcobrar')->with('message', '¡Pago Procesado Correctamente!')->with('type','success');
        }

       
       
    
       

    }


    
    public function comprobantesC(Request $request)
    {
        $valor = $request->busqueda;  
        //dd($valor) ;
        if ($valor != "")
        {
            /*
            Oscar Cornejo             
            Query para cargar todos los datos de 
            - cuentas_por_cobras
            - factura_detalles 
            - students2 
            - pagos_factura
            - users
            filtrando por cedula de estudiante
            */
            $model = DB::table('cuentas_por_cobrar')
            ->join('factura_detalles', 'factura_detalles.idCliente','=','cuentas_por_cobrar.cliente_id')
            ->join('students2','students2.id','=','factura_detalles.idEstudiante')
            ->join('pagos_factura','pagos_factura.idCliente','=','factura_detalles.idCliente')
            ->join('pago_estudiante_detalles','pago_estudiante_detalles.idEstudiante','=','factura_detalles.idEstudiante')
            ->join('users','users.id','=','pagos_factura.idUsuario')
            ->select('cuentas_por_cobrar.*','factura_detalles.*','users.*')
            ->where('students2.ci','like',"%$valor%")
            ->where('cuentas_por_cobrar.status','!=','0')
            ->get();
        }else{
            /*
            Query cuando no se filtra y se devuelve todos las cuentas por cobrar
            */
            $model = DB::table('cuentas_por_cobrar')
            ->join('factura_detalles', 'factura_detalles.idCliente','=','cuentas_por_cobrar.cliente_id')
            ->join('students2','students2.id','=','factura_detalles.idEstudiante')
            ->join('pagos_factura','pagos_factura.idCliente','=','factura_detalles.idCliente')
            ->join('pago_estudiante_detalles','pago_estudiante_detalles.idEstudiante','=','factura_detalles.idEstudiante')
            ->join('users_profile','users_profile.id','=','pagos_factura.idUsuario')
            ->join('students2_profile_per_year','students2_profile_per_year.idStudent','=','pago_estudiante_detalles.idEstudiante')
            
            ->select('students2.*','cuentas_por_cobrar.*','factura_detalles.*','pagos_factura.*','users_profile.*','pago_estudiante_detalles.*','students2_profile_per_year.*')
            ->where('cuentas_por_cobrar.status','!=',"0")
            ->get();
                            /*
                            $model = DB::table('cuentasporcobrar')
                                ->join('clientes', 'clientes.id','=', 'cuentasporcobrar.cliente_id')
                                ->join('facturas', 'facturas.id','=', 'cuentasporcobrar.comprobante_id')
                                ->join('facturadetalles', 'facturadetalles.id_factura','=', 'facturas.id')
                                ->join('productos', 'productos.id','=', 'facturadetalles.id_producto')
                            
                                ->join('usuarios', 'usuarios.id','=', 'facturas.id_vendedor')
                                ->select('cuentasporcobrar.*', 'facturas.id_vendedor as vendedor_id', 'placas.numero as placa', 'facturas.id_cliente as factura_clienteid', 'productos.nombre as producto', 'clientes.creditopermitido as cupo_autorizado', 'clientes.deudacredito as cupo_debitado', 'usuarios.nombre as vendedor', 'clientes.identificacion as ruc', 'clientes.razonsocial as cliente')
                                ->where('cuentasporcobrar.estado', '=', 1)
                                ->where('clientes.identificacion', 'like', "%$valor%" )
                                ->get();
                        }else {
                            //dd($valor);
                            $model = DB::table('cuentasporcobrar')
                                ->join('clientes', 'clientes.id', '=', 'cuentasporcobrar.cliente_id')
                                ->join('facturas', 'facturas.id', '=', 'cuentasporcobrar.comprobante_id')
                                ->join('facturadetalles', 'facturadetalles.id_factura', '=', 'facturas.id')
                                ->join('productos', 'productos.id', '=', 'facturadetalles.id_producto')
                                ->join('placas', 'placas.id', '=', 'facturas.id_placa')
                                ->join('usuarios', 'usuarios.id', '=', 'facturas.id_vendedor')
                                ->select('cuentasporcobrar.*', 'facturas.id_vendedor as vendedor_id', 'placas.numero as placa', 'facturas.id_cliente as factura_clienteid', 'productos.nombre as producto', 'clientes.creditopermitido as cupo_autorizado', 'clientes.deudacredito as cupo_debitado', 'usuarios.nombre as vendedor', 'clientes.identificacion as ruc', 'clientes.razonsocial as cliente')
                                ->where('cuentasporcobrar.estado', '=', 1)
                                //->where('clientes.identificacion', 'like', "%$valor%")
                                ->get();
                        }*/
        }   
     //dd($model);
    $estudiantes = DB::table('students2')->select('id','nombres','apellidos','ci')->get();
       
        return view('UsersViews.colecturia.cuentas_cobrar.index',["comprobantes" => $model, "estudiantes" => $estudiantes]);
    }


//        $comprobantes = Cuentasporcobrar::where('estado', '=', 1)->get();
//        $comprobantesArray = array();
//
//        foreach ($comprobantes as $comprobante)
//        {
//            $ruCliente = Clientes::where('id', '=', $comprobante->cliente_id )->get();
//            $facturas = Facturas::where('id', '=', $comprobante->comprobante_id)->get();
//            $dettfacturas = FacturaDetalles::where('id_factura', '=', $comprobante->comprobante_id)->get();
//
//            $new['id']                   = $comprobante->id;
//            $new['fecha_emision']        = $comprobante->fecha_emision;
//            $new['fecha_vencimiento']    = $comprobante->fecha_vencimiento;
//            $new['comprobante_id']       = $comprobante->comprobante_id;
//            $new['debito']               = $comprobante->debito;
//            $new['cliente']              = nombreCliente($comprobante->cliente_id);
//            $new['cliente_id']           = $comprobante->cliente_id;
//            $new['credito']              = $comprobante->credito;
//            $new['saldo']                = $comprobante->saldo;
//            $new['concepto']             = $comprobante->concepto;
//
//            foreach ($ruCliente as $item)
//            {
//                $new['ruc_cliente'] = $item->identificacion;
//                $new['permitido_cliente'] = $item->creditopermitido;
//                $new['credito_cliente'] = $item->deudacredito;
//            }
//
//            foreach ($facturas as $item)
//            {
//                $vende = Usuarios::where('id', '=', $item->id_vendedor)->get();
//                foreach ($vende as $item3)
//                {
//                    $new['vendedor'] = $item3->nombre;
//                }
//                //$new['vendedor'] = $item->id_vendedor;
//
//                $placa = Placa::where('id', '=', $item->id_placa)->get();
//                foreach ($placa as $item2)
//                {
//                    $new['placa'] = $item2->numero;
//                }
//
//            }
//
//            foreach ($dettfacturas as $item)
//            {
//                $product = Productos::where('id', '=', $item->id_producto)->get();
//                foreach ($product as $item2)
//                {
//                    $new['producto'] = $item2->nombre;
//                }
//
//            }
//
//            array_push($comprobantesArray, $new);
//        }
//
//        return view('cuentasporcobrar.comprobantes',["comprobantes" => $comprobantesArray]);

    


    public function verpagos(Request $request)
    {
        $idcxc = $request->idcxc;
        $historicopago = HistoricosPagos::where('cuentacobrar_id', '=', $idcxc)->get();
        return ["respuesta"=>true, "historicopago"=>$historicopago];

    }
    

    public function realizarpago(Request $request)
    {
        $id         = $request->id;
        $cliente_id = $request->cliente_id;      
        $path = $request->file('pago_archivo')->store('pagos');
        $pago_fecha = $request->pago_fecha;
        $pago_concepto = $request->pago_concepto;
        $pago_formapago = $request->pago_formapago;
        $pago_valor = $request->pago_valor;
        $pago_observacion = $request->pago_observacion;
        $cuentasporcobrar_id = $request->cuentasporcobrar_id;
        /*
        $cliente               = Clientes::where('id','=', $cliente_id )->where("estado","=",1)->first();
        $cliente->deudacredito = $cliente->deudacredito - $pago_valor;
        $cliente->save();
        */
        $cxc = Cuentasporcobrar::where('id', '=', $cuentasporcobrar_id)
                        ->where('status', '=', 1)->first();
  
        $cxc->credito  = $cxc->credito + $pago_valor;
        $cxc->saldo = $cxc->debito - $cxc->credito;
        $cxc->save();

        $historicopago = new HistoricosPagos();
        $historicopago->fecha_vencimiento = $pago_fecha;
        $historicopago->fecha = $pago_fecha;
        $historicopago->concepto = $pago_concepto;
        $historicopago->imagen = $path;
        $historicopago->formapago_id = $pago_formapago;
        $historicopago->valor = $pago_valor;
        $historicopago->observacion = $pago_observacion;
        $historicopago->cuentacobrar_id = $cuentasporcobrar_id;
        $historicopago->save();
        return ['respuesta'=>true, 'id_comprobante'=> $cuentasporcobrar_id, 'tipo_comprobante' => 1];
        //return redirect()->route('cuentasporcobrar.comprobantes',$historicopago);


    }


   /* public function historypagos(Request $request)
    {

        $newpagos = HistoricoPago::where('estado', '=', 1)->get();
        $newpagosArray = array();

        foreach ($newpagos as $newpago) {

            $new['id']                       = $newpago->id;
            $new['path']                     = $newpago->file('foto')->store('pagos');
            $new['fecha_pago']               = $newpago->pago_fecha;
            $new['pago_concepto']            = $newpago->pago_concepto;
            $new['pago_formapago']           = $newpago->pago_formapago;
            $new['pago_valor']               = $newpago->pago_valor;
            $new['pago_observacion']         = $newpago->pago_observacion;
            $new['cuentasporcobrar_id']      = $newpago->cuentasporcobrar_id;
            array_push($newpagosArray, $new);

        }
        return ["newpagos" => $newpagosArray];
        //return ['respuesta'=>true, 'test'=>$new,$newpagosArray];
        //return redirect()->route('cuentasporcobrar.comprobantes',$historicopago);


    }*/

   public function mostrarPagos()
    {
        $pagos = Cuentasporcobrar::where('estado', '=', 1)->get();
        $pagosArray = array();

        foreach ($pagos as $pago)
        {
            $new['id']                   = $pago->id;
            $new['fecha_emision']        = $pago->fecha_emision;
            $new['fecha_vencimiento']    = $pago->fecha_vencimiento;
            $new['comprobante_id']       = $pago->comprobante_id;
            $new['debito']               = $pago->debito;
            $new['credito']              = $pago->credito;
            $new['saldo']                = $pago->saldo;
            $new['concepto']             = $pago->concepto;
            array_push($pagosArray, $new);
        }

        return view('cuentasporcobrar.comprobantes',["pagos" => $pagosArray]);

    }

    public function filtrar(Request $request)
    {
        $valor = $request->valor;
        //$valor = '06037244';
        $model = DB::table('cuentasporcobrar')
            ->join('clientes', 'clientes.id','=', 'cuentasporcobrar.cliente_id')
            ->join('facturas', 'facturas.id','=', 'cuentasporcobrar.comprobante_id')
                ->join('facturadetalles', 'facturadetalles.id_factura','=', 'facturas.id')
                ->join('productos', 'productos.id','=', 'facturadetalles.id_producto')
                ->join('placas', 'placas.id','=', 'facturas.id_placa')
                ->join('usuarios', 'usuarios.id','=', 'facturas.id_vendedor')
            ->select('cuentasporcobrar.*', 'facturas.id_vendedor as vendedor_id', 'placas.numero as placa', 'facturas.id_cliente as factura_clienteid', 'productos.nombre as producto', 'clientes.creditopermitido as cupo_autorizado', 'clientes.deudacredito as cupo_debitado', 'usuarios.nombre as vendedor', 'clientes.identificacion as ruc')
            ->where('cuentasporcobrar.estado', '=', 1)
            ->where('clientes.identificacion', 'like', "%$valor%" )
            ->get();

        return $model;
        //return view('cuentasporcobrar.comprobantes', ["comprobantes" => $model]);
        //return view('cuentasporcobrar.comprobantes',["comprobantes" => $model]);
    }

    public function getEstudiante(){
        $estudiante= DB::table('students2')->all();
        //dd($estudiante);
        return response($estudiante);

    }




}


