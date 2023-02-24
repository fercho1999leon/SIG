<?php

namespace App\Http\Controllers;
require_once "../kushki/autoload.php";
use Response;
use File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Course;
use App\Student2;
use App\Career;
use App\User;
use App\Cuentasporcobrar;
use App\Semesters;
//use App\Course;
use App\Payment;
use App\Cliente;
use App\PagoRealizado;
use App\BecaDescuento;
use App\PaymentStudent;
use App\PagoEstudianteDetalle;
use App\ConfiguracionSistemaController;
use App\Factura;
use Sentinel;
use Carbon\Carbon;
use App\Abono;
use App\FacturaDetalle;
use App\Administrative;
use App\PeriodoLectivo;
use App\TipoPago;
use App\ConfiguracionSistema;
use App\Institution;
use App\Rubro;
use DB;
use App\Student2Profile;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Spatie\ArrayToXml\ArrayToXml;
use App\Supply;
//use App\Career;
use App\Matter;
use App\Deber;
use App\BecaDetalle;
use App\Activity;
use App\AsistenciaParcial;
/* kushki */
use \Kushki\lib\Amount;
use \Kushki\lib\Kushki;
use \Kushki\lib\KushkiEnvironment;
use \Kushki\lib\Transaction;
use \Kushki\lib\ExtraTaxes;
use \Kushki\lib\KushkiLanguage;
use \Kushki\lib\KushkiCurrency;
use App\HistoricoTransaccionesEnLinea;

class PayController extends Controller
{
    public function index(Request $request) {
        //$idcarrera = 1;
        //\Session::put('idcarrera', $idcarrera);
        $carrers = Career::where('estado',1)->get();
        $courses = Course::where('idPeriodo', Sentinel::getUser()->idPeriodoLectivo)
                    //->where('id_career',  $idcarrera)
                    ->get();
        $pays = Payment::getAllPayments();
        return view('UsersViews.administrador.configuraciones.configuracionesPagos.index',
        compact('courses', 'pays', 'carrers'));
    }

    public function listarCarrerasPagos(Request $request) {
        $careers = Career::all()->where('estado','=','1');
        return view('UsersViews.colecturia.pagos',compact('careers'));
    }

    /*
        Colecturia
    */
    //Index
    public function getCourses(Request $request){
        $idcarrera = $request->idcarrera;
        \Session::put('idcarrera', $idcarrera);
        $pago_adelantado = ConfiguracionSistema::pagoAdelantado();
        $institution = Institution::first();
        $coursesAll = Course::where('id_career', $idcarrera )->get();      
        $rubros = Rubro::where('idPeriodo', $this->idPeriodoUser())->get();
        $estudianteConPagosPendientes=true;
        $becasDescuentos = BecaDescuento::query()
            ->where('tipo_pago', 'PORCENTAJE')
            ->where('valor', 100)
            ->get();
        return view('UsersViews.colecturia.pagos.historial', compact(
                    'coursesAll', 'becasDescuentos',
                    'institution', 'rubros','estudianteConPagosPendientes','idcarrera'
                    ));
    }

    public function darBajaFactura($idFactura){
        try {
            $factura = Factura::with('facturaDetalle')->findOrFail($idFactura);
            $factura->estatus = "BAJA";
            foreach($factura->facturaDetalle as $fd){
                $pago = PagoEstudianteDetalle::findOrFail($fd->idPagoDetalle);
                $pago->estado = "PENDIENTE";
                $pago->save();
                $abonos = Abono::where('idPagoDetalle', $pago->id)->where('estatus', '!=' , 'BAJA')->get();
                foreach($abonos as $abono){
                    $abono->estatus = 'BAJA';
                    $abono->save();
                }
            }
            $factura->save();
            return Redirect::back();
        }catch(Exception $e){
            return Redirect::back()->withErrors(['Factura' => 'Ha ocurrido un error.']);
        }
    }

    public function darBajaRecibo($idRecibo){
        try {
            $recibo = Abono::findOrFail($idRecibo);

            $recibo->estatus = "BAJA";
            $recibo->save();
            return redirect()->back();
        }catch(Exception $e){
            return Redirect::back()->withErrors(['Recibo' => 'Ha ocurrido un error.']);
        }
    }

    public function getCourse($id) {
        $id_carrera = \Session::get('idcarrera');
        $rubros = Rubro::where('idPeriodo', $this->idPeriodoUser())->get();
        $students = Student2::query()
            ->join('students2_profile_per_year', 'students2.id', '=', 'students2_profile_per_year.idStudent')
            ->select('students2.id', 'students2.apellidos', 'students2.nombres')
            ->where('students2_profile_per_year.idCurso', $id)
            ->orderBy('students2.apellidos')
            ->get();
        $count = 1;
        $course = Course::findOrFail($id);
        return view('UsersViews.colecturia.pagos.pagosCurso', compact('students', 'count', 'course', 'rubros', 'id_carrera'));
    }
    //no se esta usando
    public function generarFacturas(Request $request, $idEstudiante) {
        $pagos = Payment::whereIn('id', $request->pagos_id)->get();
        if(count($pagos) > 3) {
            return Redirect::back()->withErrors(['error' => 'Solo se puede realizar un total máximo de 3 pagos a la vez.']);
        }
        $student = Student2Profile::getStudent($idEstudiante);
        $periodo = PeriodoLectivo::find($student->idPeriodo);
        $pagos_detalle = PagoEstudianteDetalle::where('idEstudiante', $idEstudiante)->whereIn('idPago', $request->pagos_id)->get();
        $abonos = Abono::whereIn('idPagoDetalle', $pagos_detalle->pluck('id'))->get();
        $cliente = null;
        $factura = null;
        $becas = BecaDescuento::all();
        $course = Course::find($student->idCurso);
        $tutor = User::find($course->idProfesor);
        // Busco si exista datos del Cliente a Facturar en los registros del estudiante
        if( $student->numero_identificacion!=NULL ){
            $clienteBuscado = Cliente::where('cedula_ruc', $student->numero_identificacion)->first();
            if( $clienteBuscado==null ){
                //return "El cliente no existe en la base de datos";
                $cliente_nuevo = new Cliente();
                $cliente_nuevo->nombres = $student->facturacion_nombres;
                $cliente_nuevo->apellidos = $student->facturacion_apellidos;
                $cliente_nuevo->cedula_ruc = $student->numero_identificacion;
                $cliente_nuevo->direccion = '';
                $cliente_nuevo->telefono = $student->facturacion_movil.'  '.$student->facturacion_convencional;
                $cliente_nuevo->correo = $student->facturacion_correo;
                $cliente_nuevo->save();
                $cliente = Cliente::where('cedula_ruc', $student->numero_identificacion)->first();
            }else{
                $cliente = $clienteBuscado;
            }
        }
        return view('UsersViews.colecturia.pagos.factura.createMultiple', compact(
                    'student', 'course', 'tutor', 'pagos', 'becas', 'pagos_detalle', 'abonos',
                    'factura','cliente', 'periodo'
                    ));
    }

    public function factura(Request $request, $idEstudiante) {

        if($request->has("cedula_ruc")) {
            $cliente_res = Cliente::getClienteByCedula($request->cedula_ruc);
            if($cliente_res == null){
                $cliente_res = new Cliente;
                $cliente_res->nombres = $request->nombre1.' '.$request->nombre2;
                $cliente_res->apellidos = $request->apellidos;
                $cliente_res->cedula_ruc = $request->cedula_ruc;
                $cliente_res->direccion = $request->direccion;
                $cliente_res->idPeriodo = $this->idPeriodoUser();
                $cliente_res->correo = $request->email;
                $cliente_res->telefono = $request->telefono;
                $cliente_res->save();
                $dataProfile = Student2Profile::where('idStudent', $idEstudiante)
                    ->where('idPeriodo', $this->idPeriodoUser())
                    ->first();
                DB::update('update students2_profile_per_year set idCliente = ? where id = ?', [$cliente_res->id, $dataProfile->id]);
            }else{
                $cliente_res->nombres = $request->nombre1.' '.$request->nombre2;
                $cliente_res->apellidos = $request->apellidos;
                $cliente_res->cedula_ruc = $request->cedula_ruc;
                $cliente_res->direccion = $request->direccion;
                $cliente_res->correo = $request->email;
                $cliente_res->telefono = $request->telefono;
                $cliente_res->save();
                $dataProfile = Student2Profile::where('idStudent', $idEstudiante)
                    ->where('idPeriodo',$this->idPeriodoUser())
                    ->first();
                DB::update('update students2_profile_per_year set idCliente = ? where id = ?', [$cliente_res->id, $dataProfile->id]);
            }
        }

        $responseData='';
        $student = Student2Profile::getStudent($idEstudiante);
        $pagos = Payment::whereIn('id', $request->pagos_id)->get();
        $pagos_detalle = PagoEstudianteDetalle::where('idEstudiante', $idEstudiante)->whereIn('idPago', $request->pagos_id)->get();
        $abonos = Abono::whereIn('idPagoDetalle', $pagos_detalle->pluck('id'))->where('estatus', null)->get();
        $periodo = PeriodoLectivo::find($this->idPeriodoUser());
        $cliente = null;
        if($abonos->isNotEmpty()){
            $factura = Factura::with('facturaDetalle')->findOrFail($abonos->last()->idFactura);
            if($factura->estatus == "BAJA"){
                $factura = null;
                $abonos =  collect(new Abono);
            }else{
                $abonos = $abonos->where('idFactura', $factura->id)->where('estatus','!=', 'BAJA');
                $cliente = Cliente::find($factura->idCliente);
            }
        } else{
            $factura = null;
            $cliente = null;
        }

        if($request->has("cedula_ruc")) {
            if ($factura==null) {
                $numero_factura = Factura::select('numeroFactura')->get()->last();
                $numero_factura =$numero_factura->numeroFactura+1;
            }
            $i=0;
            $j=0;
            $ip = $this->getUserIpAddr();

            //funcion para mostrar el boton de pago
            $total = $pagos->sum('valor_cancelar');
            $descuentoTotal = 0;
            foreach ($pagos as $pago) {
                $totalPago = $pago->valor_cancelar;
                $becaTotal = 0;
                $rubro = Rubro::find($pago->idRubro);
                $descuento = 0;
                if( strtoupper($rubro->tipo_rubro) == 'PENSION') {
                    if(count($student->student->becasDescuentos) != 0) {
                        foreach($student->student->becasDescuentos as $beca){
                            $bd = BecaDescuento::find($beca->idBeca);
                            if($bd->tipo == 'BECA'){
                                if($bd->tipo_pago == "USD"){
                                    $becaTotal = $bd->valor;
                                }else if($bd->tipo_pago == "PORCENTAJE"){
                                    $becaTotal = $totalPago*($bd->valor/100);
                                }
                            }
                        }
                        $totalPago = $totalPago - $becaTotal;
                        foreach($student->student->becasDescuentos as $beca){
                            $bd = BecaDescuento::find($beca->idBeca);
                            if($bd->tipo == 'DESCUENTO'){
                                if($bd->tipo_pago == "USD"){
                                    $descuento = $bd->valor;
                                }else if($bd->tipo_pago == "PORCENTAJE"){
                                    $descuento = $totalPago*($bd->valor/100);
                                }
                            }
                        }
                    }
                }
                $descuentoTotal += (bcdiv($totalPago, '1', 2) - $descuento);
            }

            //arreglo de los montos :::::::::::::::::::::::::::::::;
            $descuentoTotal =  number_format((float)$descuentoTotal, 2, '.', '');//todos los valores los paso con dos decimales
            $total=str_replace('.', '', $descuentoTotal);
            $valor_total_base0 = str_pad($total,12,'0', STR_PAD_LEFT);//valor total a pagar
            $valueIva = '004012000000000000';
            $valueTotalIva= '053012000000000000';
            $merchterm='1000000505_PD100406';
            // boton de fase I::::::::::::::::::::::::::::
            $url = "https://test.oppwa.com/v1/checkouts";
            $data = "entityId=8ac7a4c971df15330171e05eb0810592" .
                "&amount=$descuentoTotal" .
                "&currency=USD" .
                "&paymentType=DB".
                "&customer.givenName=$request->nombre1".
                "&customer.middleName=$request->nombre2".
                "&customer.surname=$request->apellidos".
                "&customer.ip=$ip".
                "&customer.merchantCustomerId=".$cliente_res->id.'__'.$idEstudiante .
                "&merchantTransactionId=transaction__$numero_factura".
                "&customer.email=$request->email".
                "&customer.identificationDocType=IDCARD".
                "&customer.identificationDocId=$request->cedula_ruc".
                "&customer.phone=$request->telefono".
                "&shipping.street1=$request->direccion".
                "&billing.street1=$request->direccion".
                "&billing.country=EC".
                "&testMode=EXTERNAL".
                "&risk.parameters[USER_DATA2]=PINED".
                "&customParameters[".$merchterm."]=0081003007010391000401200000000000005100817913101052012".$valor_total_base0."053012000000000000";

            $historico = HistoricoTransaccionesEnLinea::where('idCliente',$cliente_res->id)
                ->whereNotNull('registrationId')
                ->groupby('registrationId')
                ->distinct()
                ->get();
            foreach ($historico as $hist) {
                $data.="&registrations[".$j."].id=".$hist->registrationId;
                $j++;
            }
            foreach ($pagos as $c) {
                $pagos_detalle_id = PagoEstudianteDetalle::where('idEstudiante', $idEstudiante)->where('idPago', $c['id'])->first();
                $data.="&cart.items[".$i."].name=".$c["tipo"];
                $data.="&cart.items[".$i."].description="."Descripción: ".$c["descripcion"]."__".$c["id"].'__'.$pagos_detalle_id->id;
                $data.="&cart.items[".$i."].price=".$c["valor_cancelar"];
                $data.="&cart.items[".$i."].quantity=1";
                $i++;
            }
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization:Bearer OGE4Mjk0MTg1YTY1YmY1ZTAxNWE2YzhjNzI4YzBkOTV8YmZxR3F3UTMyWA=='));
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);// this should be set to true in production
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $responseData = curl_exec($ch);
            if(curl_errno($ch)) {
                return curl_error($ch);
            }
        }
        $becas = BecaDescuento::all();
        $course = Course::find($student->idCurso);
        $tutor = User::find($course->idProfesor);
        $cuadroAbonos = count($request->pagos_id) == 1 ? true : false;
        return view('UsersViews.colecturia.pagos.factura.create',
            compact('student',  'course',  'tutor',  'pagos',  'becas',  'pagos_detalle',
                    'abonos', 'factura', 'periodo', 'cuadroAbonos','responseData'));
    }


    public function facturaMultiplePost(Request $request){
        $cliente = Cliente::getClienteByCedula($request->cedula_ruc);
        if($cliente == null){
            $cliente = new Cliente;
            $cliente->nombres = $request->nombres;
            $cliente->apellidos = $request->apellidos;
            $cliente->cedula_ruc = $request->cedula_ruc;
            $cliente->direccion = $request->direccion;
            $cliente->idPeriodo = $this->idPeriodoUser();
            $cliente->correo = $request->email;
            $cliente->telefono = $request->telefono;
            $cliente->save();
        }else{
            $cliente->nombres = $request->nombres;
            $cliente->apellidos = $request->apellidos;
            $cliente->cedula_ruc = $request->cedula_ruc;
            $cliente->direccion = $request->direccion;
            $cliente->correo = $request->email;
            $cliente->telefono = $request->telefono;
            $cliente->save();
        }
        $factura = Factura::find($request->idFactura);
        if($factura == null){
            $factura = new Factura;
            $factura->idCliente = $cliente->id;
            $factura->numeroFactura = $request->numero_factura;
            $factura->subtotal = $request->subtotal;
            $factura->idPeriodo = $this->idPeriodoUser();
            $factura->tipo_pago = $request->tipo_pago;
            $factura->total = $request->valor_pagar;
            $user = Sentinel::getUser();
            $user_profile = Administrative::findBySentinelid($user->id);
            $factura->idUsuario = $user_profile->id;
            $factura->save();
            foreach($request->idPagoDetalle as $pd){
                $detalle = new FacturaDetalle;
                $pago_detalle =  PagoEstudianteDetalle::with('pago')->find($pd);
                $detalle->idCliente = $cliente->id;
                $detalle->idPagoDetalle = $pago_detalle->id;
                $detalle->idEstudiante = $request->idEstudiante;
                $detalle->idPeriodo = $this->idPeriodoUser();
                $detalle->subtotal = $pago_detalle->pago->valor_cancelar;
                $detalle->total = $pago_detalle->pago->valor_cancelar;
                $detalle->idFactura = $factura->id;
                $pago_detalle->estado = "PAGADO";
                $pago_detalle->save();
                $detalle->save();
                $rubro = Rubro::find($pago_detalle->pago->idRubro);
                if($rubro->tipo_emision == "RECIBO"){
                    $abono = new Abono;
                    $abono->cantidad = $request->valor_pagar;
                    $abono->idFactura = $factura->id;
                    $abono->idPeriodo = $this->idPeriodoUser();
                    $abono->idPagoDetalle = $pd;
                    $abono->save();
                }
            }
            $tipoPago = new TipoPago;
            $tipoPago->tipo_pago = $request->tipo_pago;
            $tipoPago->banco = $request->banco;
            $tipoPago->idPeriodo = $this->idPeriodoUser();
            $tipoPago->numero_descripcion = $request->numero_descripcion;
            $tipoPago->nombre_tarjeta = $request->nombre_tarjeta;
            $tipoPago->idFactura = $factura->id;
            $tipoPago->save();
        }
        $data = request()->all();
        $idStudent = $data['idEstudiante'];
        $student = Student2::find($idStudent);
        return redirect()->route('pagosCursoEstudiante', ['id' => $idStudent]);
    }

    public function setProrroga(Request $request){
        $pago = PagoEstudianteDetalle::where(['idPago' => $request->idPago, 'idEstudiante' => $request->idEstudiante])->first();
        $pago->prorroga = $request->diasProrroga;
        $pago->estado = 'PRORROGA';
        $pago->save();
        return $pago;
    }

    public function getProrroga($idPago, $idStudent){
        $pago = PagoEstudianteDetalle::where(['idPago' => $idPago, 'idEstudiante' => $idStudent, 'estado' => 'PRORROGA'])->first();
        if($pago != null)
            return $pago->prorroga;
        else
            return 0;
    }


    public function getCliente($idCliente) {
        $cliente = Cliente::getClienteByCedula($idCliente);
        return $cliente;
    }


    public function facturaPost(Request $request){
        $estudiante = Student2Profile::getStudent($request->idEstudiante);
        $this->validate($request, [
            'cedula_ruc' => 'required',
            'nombres' => 'required',
            'apellidos' => 'required',
            'telefono' => 'required',
            'direccion' => 'required',
            'email' => 'required',
            'valor_pagar' => 'required',
        ]);
        $ab_total = Abono::where(['idPagoDetalle'=> $request->idPagoDetalle[0], 'estatus' => null])->get()->sum('cantidad');
        if((count($request->idPagoDetalle)) > 1 && strval($request->total - $ab_total) > $request->valor_pagar){
            $data = request()->all();
            $idStudent = $data['idEstudiante'];
            return redirect()->route('pagosCursoEstudiante', ['id' => $idStudent])->withErrors(['Factura' => 'Valor erroneo, PAGOS MULTIPLES solo acepta el valor completo de los rubros seleccionados']);
        }
        if( strval($request->total - $ab_total) >= ($request->valor_pagar)){
            DB::beginTransaction();
            $student = Student2Profile::getStudent($request->idEstudiante);
            $cliente = $student->cliente;
            #region clientes
            if($cliente->id == null){
                $cliente = new Cliente;
                $cliente->nombres = $request->nombres;
                $cliente->apellidos = $request->apellidos;
                $cliente->cedula_ruc = $request->cedula_ruc;
                $cliente->direccion = $request->direccion;
                $cliente->idPeriodo = $this->idPeriodoUser();
                $cliente->correo = $request->email;
                $cliente->telefono = $request->telefono;
                $cliente->save();
                $student->idCliente = $cliente->id;
                $student->save();
            }else{
                $cliente->nombres = $request->nombres;
                $cliente->apellidos = $request->apellidos;
                $cliente->cedula_ruc = $request->cedula_ruc;
                $cliente->direccion = $request->direccion;
                $cliente->correo = $request->email;
                $cliente->telefono = $request->telefono;
                $cliente->save();
            }

            #region factura
            $factura = Factura::find($request->idFactura); // si se creo un abono, la factura estara creada pero el pago aun no esta cancelado
            if($factura == null) {
                $todasLasFacturas = Factura::all()->count();
                $factura = new Factura;
                $factura->idCliente = $cliente->id;
                if ($todasLasFacturas == 0) {
                    $numeroDeFactura = "1";
                } else {
                    $ultimoRegistro = Factura::orderBy('created_at', 'DESC')->first();
                    $numeroDeFactura = (int)Factura::orderBy('created_at', 'DESC')->first()->numeroFactura;
                    $numeroDeFactura++;
                    $numeroDeFactura = $numeroDeFactura."";
                }
                $factura->numeroFactura = $numeroDeFactura;
                $factura->subtotal = $request->subtotal;
                $factura->idPeriodo = $this->idPeriodoUser();
                $factura->tipo_pago = $request->tipo_pago;
                $factura->total = $request->total;
                $user = Sentinel::getUser();
                $user_profile = Administrative::findBySentinelid($user->id);
                $factura->idUsuario = $user_profile->id;
                $factura->save();
                $c = 0;
                foreach($request->idPagoDetalle as $pd) {
                    $detalle = new FacturaDetalle;
                    $pago_detalle = PagoEstudianteDetalle::with('pago')->find($pd);
                    $detalle->idCliente = $cliente->id;
                    $detalle->idPagoDetalle = $pago_detalle->id;
                    $detalle->idEstudiante = $request->idEstudiante;
                    $detalle->subtotal = $request->subtotal;
                    $detalle->idPeriodo = $this->idPeriodoUser();
                    $detalle->total = $request->valor_pagar;
                    $detalle->idFactura = $factura->id;
                    $detalle->save();
                    if($request->total == $request->valor_pagar){// si voy a pagar el valor completo se marcara como pagado en pago_detalle,
                        $pago_detalle->estado = "PAGADO";
                        $pago_detalle->save();
                        $idAbono = null;
                        $rubro = Rubro::find($pago_detalle->pago->idRubro);
                        if($rubro->tipo_emision == "RECIBO"){ // si el tipo de emision es de recibo se creara un abono
                            $abono = new Abono;
                            $abono->cantidad = Payment::calcularDescuentoEstudiante($request->idEstudiante, $pago_detalle->idPago);
                            $abono->idFactura = $factura->id;
                            $abono->idPeriodo = $this->idPeriodoUser();
                            $abono->idPagoDetalle = $pd;
                            $abono->estatus = "PAGADO";
                            $abono->save();
                            $idAbono = $abono->id;
                        }
                        $tipoPago = new TipoPago;
                        $tipoPago->tipo_pago = $request->tipo_pago;
                        $tipoPago->banco = $request->banco;
                        $tipoPago->idPeriodo = $this->idPeriodoUser();
                        $tipoPago->numero_descripcion = $request->numero_descripcion;
                        $tipoPago->nombre_tarjeta = $request->nombre_tarjeta;
                        $tipoPago->idFactura = $factura->id;
                        $tipoPago->idRecibo = $idAbono;
                        //Si se debe emitir factura lo genera
                        if($rubro->tipo_emision == "FACTURA") {
                            /*Jorge Fierro 9 de marzo*/
                            //Verificacion de un pago o multiples
                            if(count($request->idPago)==1){
                                // Genera xml de la factura. Descomentar en el caso de ser necesario.
                                //Se envia la primera posicion  \/
                                //return $cliente;
                                $this->generar($request->idPago,
                                $request->cedula_ruc,
                                $factura->numeroFactura,
                                $cliente,
                                $request->tipo_pago,
                                $cliente->correo,
                                $cliente->telefono,
                                $request->tipo_pagoBD,
                                $request->valorBD);
                            }else{
                                // Genera xml de la factura. Descomentar en el caso de ser necesario.
                                //Se envia el arreglo de los pagos\/
                                $this->generarMultiple($request->idPago,
                                $request->cedula_ruc,
                                $factura->numeroFactura,
                                $cliente,
                                $request->tipo_pago,
                                $cliente->correo,
                                $cliente->telefono,
                                $request->tipo_pagoBD,
                                $request->valorBD);
                            }
                        }
                        $tipoPago->save();
                    }else { // si voy a pagar solo una porcion se creara un abono
                        $abono = new Abono;
                        $abono->cantidad = $request->valor_pagar;
                        $abono->idFactura = $factura->id;
                        $abono->idPeriodo = $this->idPeriodoUser();
                        $abono->idPagoDetalle = $pd;
                        $abono->save();
                        $tipoPago = new TipoPago;
                        $tipoPago->tipo_pago = $request->tipo_pago;
                        $tipoPago->banco = $request->banco;
                        $tipoPago->idPeriodo = $this->idPeriodoUser();
                        $tipoPago->numero_descripcion = $request->numero_descripcion;
                        $tipoPago->nombre_tarjeta = $request->nombre_tarjeta;
                        $tipoPago->idFactura = $factura->id;
                        $tipoPago->idRecibo = $abono->id;
                        $tipoPago->save();
                    }
                    $c++;
                }
            } else { // si la factura ya existe, es por que se le ha creado abonos
                $ab_total = Abono::where(['idPagoDetalle'=> $request->idPagoDetalle[0], 'estatus' => null])->get()->sum('cantidad'); // busco todos los abonos y sumo lo que se ha acumulado
                $suma =(bcdiv($request->valor_pagar, '1', 2) + bcdiv( $ab_total, '1', 2));
                if( (bcdiv( $request->total, '1', 2)) <= (bcdiv($suma, '1', 2)) ){ // si la suma de todos los abonos completa el total a pagar
                    $pago_detalle =  PagoEstudianteDetalle::getDetailPaymentsByStudent($request->idEstudiante, $estudiante->idCurso)
                                                            ->where('idPago', $request->idPago[0])->first();
                    $pago_detalle->estado = "PAGADO";
                    $pago_detalle->save();
                    $abono = new Abono;
                    $abono->cantidad = bcdiv($request->valor_pagar, '1', 2);
                    $abono->idFactura = $request->idFactura;
                    $abono->idPeriodo = $this->idPeriodoUser();
                    $abono->idPagoDetalle = $pago_detalle->id;
                    $abono->save();
                    $tipoPago = new TipoPago;
                    $tipoPago->tipo_pago = $request->tipo_pago;
                    $tipoPago->banco = $request->banco;
                    $tipoPago->numero_descripcion = $request->numero_descripcion;
                    $tipoPago->idPeriodo = $this->idPeriodoUser();
                    $tipoPago->nombre_tarjeta = $request->nombre_tarjeta;
                    $tipoPago->idFactura = $factura->id;
                    $tipoPago->idRecibo = $abono->id;
                    $rubro = Rubro::find($pago_detalle->pago->idRubro);
                    if($rubro->tipo_emision == "FACTURA") {
                        // Genera xml de la factura. Descomentar \/ en el caso de ser necesario.
                        $this->generar($request->idPago,
                        $request->cedula_ruc,
                        $factura->numeroFactura,
                        $cliente,
                        $request->tipo_pago,
                        $cliente->correo,
                        $cliente->telefono,
                        $request->tipo_pagoBD,
                        $request->valorBD);
                    }
                    $tipoPago->save();
                }else{ // si solo paga otra porcion se creara otro abono pero no se marcara como pagado
                    $pago_detalle =  PagoEstudianteDetalle::getDetailPaymentsByStudent($request->idEstudiante,$estudiante->idCurso)
                                                            ->where('idPago', $request->idPago[0])->first();
                    $abono = new Abono;
                    $abono->cantidad = $request->valor_pagar;
                    $abono->idFactura = $request->idFactura;
                    $abono->idPeriodo = $this->idPeriodoUser();
                    $abono->idPagoDetalle = $pago_detalle->id;
                    $abono->save();
                    $tipoPago = new TipoPago;
                    $tipoPago->tipo_pago = $request->tipo_pago;
                    $tipoPago->banco = $request->banco;
                    $tipoPago->idPeriodo = $this->idPeriodoUser();
                    $tipoPago->numero_descripcion = $request->numero_descripcion;
                    $tipoPago->nombre_tarjeta = $request->nombre_tarjeta;
                    $tipoPago->idFactura = $factura->id;
                    $tipoPago->idRecibo = $abono->id;
                    $tipoPago->save();
                }
            }
            $this->cambioDeMatricula($request->idEstudiante);
            $data = request()->all();
            $idStudent = $data['idEstudiante'];
            DB::commit();
            return redirect()->route('pagosCursoEstudiante', ['id' => $idStudent]);
        }
        $data = request()->all();
        $idStudent = $data['idEstudiante'];
        return redirect()->route('pagosCursoEstudiante', ['id' => $idStudent])->withErrors(['Factura' => 'Valor de pago maximo excedido, vuelva a ingresar el valor correcto']);
    }


    public function reiniciarContadorFactura(Request $request) {
        $num = $request->numeroFactura - 1;
        $confContadorFactura = ConfiguracionSistema::reiniciarContadorFactura();
        if ($confContadorFactura->valor === '1') {
            $factura = new Factura;
            $factura->idCliente = 1;
            $factura->idUsuario = session('user_data')->id;
            $factura->subtotal = 0.00;
            $factura->total = 0.00;
            $factura->created_at = Carbon::now();
            $factura->numeroFactura = $num;
            $factura->idPeriodo = $this->idPeriodoUser();
            $factura->save();
            $confContadorFactura->valor = '0';
            $confContadorFactura->save();
        }
    }

    /*Jorge Fierro 8 de enero de 2020 */
    public function generar($idPago,$cedula_ruc,$numero_factura,$cliente,$tipo_pago,$correo,$telefono,$tipoPagoBD,$valorBD){
        $fac = Factura::where('numeroFactura', $numero_factura)->first() ;
        $institution = Institution::first();
        $rucCED='';
        $now = Carbon::now()->format('d/m/Y');
        $replaceSymbolDate=str_replace('/', '', $now); //Deja la fecha en este formato ddmmyyyy
        $nombres='';
        $apellidos='';
        $direccion='';
        $comp=0;
        $tipoPagoFactura='';
        $periodoLectivo = PeriodoLectivo::find($this->idPeriodoUser());
        $pago = Payment::findOrFail($idPago[0]);
        $mes='';
        $tipoRubro=$pago->rubro->tipo_rubro;
        $subtotal=$pago->valor_cancelar;
        $valorcancelar=0.0;
        $cedulaRUC='';
        /* Obtencion de la cantidad de caracteres en un factura y valida si hay 9 digitos, si tiene menos agrega ceros por delante */
        $numero_factura=$numero_factura;
        $lengthNumFactura=strlen ( $numero_factura );
        if($lengthNumFactura<9){
            $diff=9-$lengthNumFactura;
            for($i = 0;$i<$diff;$i++){
                $numero_factura = '0'.$numero_factura;
            }
        }
        /* Validacion de cedula, ruc o consumidor final. */
        $comp=strlen($cedula_ruc);
        //Consumidor final
        if($comp==0){
            $rucCED='07';
            $cliente->nombres='CONSUMIDOR';
            $cliente->apellidos='FINAL';
            $cliente->cedula_ruc='9999999999999‬';
        }
        //RUC
        if($comp==13){
            $rucCED='04';
        }
        //Cedula(10 digitos)
        if($comp==10){
            $rucCED='05';
        }
        //Cedula(9 digitos)
        if($comp==9){
            $rucCED='05';
            $cliente->cedula_ruc='0'.$cliente->cedula_ruc;
        }
        //Cedula(menos de 9 digitos)
        if($comp<9){
            $diff2=10-$comp;
            for($i = 0;$i<$diff2;$i++)
            {
                $cliente->cedula_ruc='0'.$cliente->cedula_ruc;
            }
            $rucCED='05';
        }
        // HECTOR FUENTES
        /* Punto de emision dinamico.
            Variable que servira en caso de que manejen solo una caja caso contrario enviar la variable con nombre $ptoemi y comentar la linea */
        $ptoemi='003';
        /* Tipo de pago del comprador.
            Variable tipoPagoFactura almacena codigo de tipo de pago.
                EFECTIVO 01
                CHEQUE 20
                TAREJETA DE CREDITO 19
                TARJETA DEBITO 16 */
        if($tipo_pago=="EFECTIVO"){
            $tipoPagoFactura='01';
        }
        if($tipo_pago=="CHEQUE" || $tipo_pago=="DEPOSITO"){
            $tipoPagoFactura='20';
        }
        if($tipo_pago=="TARJETACREDITO"){
            $tipoPagoFactura='19';
        }
        if($tipo_pago=="TARJETADEBITO"){
            $tipoPagoFactura='16';
        }
        if($tipo_pago=="DEPOSITO"){
            $tipoPagoFactura='20';
        }
        /*Identificación del mes de pago */
        switch ($pago->mes){
            case '1' : $mes='Enero'     ; break;
            case '2' : $mes='Febrero'   ; break;
            case '3' : $mes='Marzo'     ; break;
            case '4' : $mes='Abril'     ; break;
            case '5' : $mes='Mayo'      ; break;
            case '6' : $mes='Junio'     ; break;
            case '7' : $mes='Julio'     ; break;
            case '8' : $mes='Agosto'    ; break;
            case '9' : $mes='Septiembre'; break;
            case '10': $mes='Octubre'   ; break;
            case '11': $mes='Noviembre' ; break;
            case '12': $mes='Diciembre' ; break;
        }
        /*Construcción de clave de acceso.
        Fecha+tipodecomprobante+ruc/cedula001(debe ir los 13 digitos)+Tipo de ambient (1 o 2)+
        Serie+numeroscuencial(Factura)+Codigo numero explicado arriba+Tipo de emision (1)+Digito Modulo 11 explicado mas abajo.*/

        /*Codigo numerico.
        Se toma los primeros 8 digitos de la institucion para la respectiva identificacion */
        $codNum=substr($institution->ruc, 0, 8);
        if($rucCED=='05'){
            //Clave de acceso en el caso de cedula   ->  cedula+001
            $claveacceso=''.$replaceSymbolDate.'01'.$institution->ruc.'2'.$institution->establecimiento.$ptoemi.$numero_factura.''.$codNum.'1';
        }
        else{
            $claveacceso=''.$replaceSymbolDate.'01'.$institution->ruc.'2'.$institution->establecimiento.$ptoemi.$numero_factura.''.$codNum.'1';
        }

        /*Digito  modulo 11.
        Proceso definido por el SRI*/
        $claveacceso=$claveacceso.$this->generaDigitoModulo11($claveacceso);
        /*Termina construccion clave de acceso*/

        $descuento=0.0;
        if($tipoPagoBD==="PORCENTAJE"){
            $descuento=($subtotal*$valorBD)/100;
            $descuento= bcdiv($descuento, '1', 2);
            $valorcancelar=$subtotal-$descuento;
        }
        if($tipoPagoBD==="USD"){
            $descuento=$valorBD;
            $valorcancelar=$subtotal-$descuento;
        }
        if($tipoPagoBD!="PORCENTAJE" && $tipoPagoBD!="USD"){
            $valorcancelar=$subtotal;
            $descuento=0.0;
        }

        /*Arreglo donde se ubican los campos para posterior coversion a xml */
        $array = [
            'infoTributaria' => [
                'ambiente' => '2',//Cambiar aqui en el caso que sea pruebas (1) o produccion (2)
                'tipoEmision' => '1',
                'razonSocial' => $institution->razon_social,//Cambiar aqui la razon social de la institucion
                'nombreComercial' => $institution->nombre_comercial,//Cambiar aqui el nombre comercial de la institucion
                'ruc' => $institution->ruc,//Cambiar aqui el RUC de la institucion JP
                'claveAcceso' => $claveacceso,
                'codDoc' => '01',
                'estab' => $institution->establecimiento,//Cambiar aqui en el caso de tener otra sucursal de la institucion
                'ptoEmi' => $ptoemi,//Cambiar aqui en el caso de tener varias cajas
                'secuencial' => $numero_factura,//Ingreso manual
                'dirMatriz' => $institution->direccion_matriz,//Cambiar aqui direccion de sucursal o matriz de institcion
            ],
            'infoFactura' => [
                'fechaEmision' => $now,
                'dirEstablecimiento' => $institution->direccion_matriz,//Cambiar aqui direccion de sucursal o matriz de institcion
                'obligadoContabilidad' => 'SI',
                'tipoIdentificacionComprador' => $rucCED,//'1-2-3-4-5-6-7'
                'razonSocialComprador' => $cliente->nombres.' '.$cliente->apellidos,//Razon Social
                'identificacionComprador' => $cliente->cedula_ruc,//'Cedula o RUC'
                'totalSinImpuestos' =>bcdiv($valorcancelar, '1', 2),
                'totalSubsidio' =>'0',
                'totalDescuento' =>bcdiv($descuento, '1', 2),
                'totalComprobantesReempolso' =>'0',
                'totalBaseImponibleReembolso' =>'0',
                'totalImpuestoReembolso' =>'0',
                'totalConImpuestos' => [
                    'totalImpuesto' => [
                        'codigo' => '2',
                        'codigoPorcentaje' => '0',
                        'baseImponible' => bcdiv($valorcancelar, '1', 2),
                        'valor' => '0'
                    ]
                ],
                'propina' => '0.0',
                'importeTotal' => bcdiv($valorcancelar, '1', 2),
                'moneda' => 'DOLAR',
                'pagos' => [
                    'pago' => [
                        // Elegir tipo de pago
                        //codigo - forma de pago
                        // 01 - sin sistema financiero,
                        // 15 - compensacion de deudas,
                        // 16 - Tarjeta de debito,
                        // 17 - dinero electronico,
                        // 18 - tarjeta prepago,
                        // 19 - tarjeta de credito,
                        // 20 - otros,
                        // 21 - endoso de titulos.
                        'formaPago' => $tipoPagoFactura,
                        'total' => bcdiv($valorcancelar, '1', 2),
                        'plazo' =>'0',
                        'unidadTiempo' =>'dias'
                    ]
                ]
            ],
            'detalles' => [
                'detalle' => [
                    // Pensiones / pined-001
                    // Matricula / pined-002
                    // Separacion de matricula / pined-003
                    // Robotica educativa / pined-004
                    // Ambiente digital / pined-005
                    'codigoPrincipal' =>'pined35135',
                    'codigoAuxiliar' =>'pined35135',
                    'descripcion' => $tipoRubro.' '.$mes.' Periodo:'.$periodoLectivo->nombre  ,
                    'cantidad' => '1.0',
                    'precioUnitario' => $subtotal,
                    'descuento' => bcdiv($descuento, '1', 2),
                    'precioTotalSinImpuesto' => bcdiv($valorcancelar, '1', 2),
                    'detallesAdicionales'=>[
                        'detAdicional'=>[
                            '_attributes' => [
                                'nombre'=>'Categoria',
                                'valor' => 'GENERAL'
                            ]
                        ]
                    ],
                    'impuestos' => [
                        'impuesto' => [
                            'codigo' => '2',
                            'codigoPorcentaje' => '0',
                            'tarifa' => '0',
                            'baseImponible' => bcdiv($valorcancelar, '1', 2),
                            'valor' => '0',
                        ]
                    ]
                ],
            ]
        ];/*termina*/


        /*Detalle descuento
        Jorge Fierro 11 de enero de 2020*/

        //Detalle descuento porcentaje
        if($tipoPagoBD=="PORCENTAJE"){
            // $detallesAdicionales=array();
            // $tmp=$array["detalles"]["detalle"];
            // $detalleBD=[
                // 'detallesAdicionales'=>[
                //     'detAdicional'=>[

                //         '_attributes' =>
                //         [
                //             'nombre'=>'Ayuda Becaria',
                //             'valor' => 'Descuento '.$valorBD.'%'
                //         ]
                //     ]

                // ]
            // ];
            // $res = array_slice($tmp, 0, 5, true) +
            // $detalleBD +
            // array_slice($tmp, 5, count($tmp) - 1, true);
            // $array["detalles"]["detalle"]=$res;
            $tmp=$array["detalles"]["detalle"]["descripcion"];
            $tmp=$tmp.' - Ayuda Becaria: Descuento'.$valorBD.'%';
            $array["detalles"]["detalle"]["descripcion"]=$tmp;
        }

        //Detalle descuento por valor
        if($tipoPagoBD=="USD"){
            $tmp=$array["detalles"]["detalle"]["descripcion"];
            $tmp=$tmp.' - Ayuda Becaria: Descuento $'.$valorBD;
            $array["detalles"]["detalle"]["descripcion"]=$tmp;
            // $detalleBD=[
            //     'detallesAdicionales'=>[
            //         'detAdicional'=>[
            //             '_attributes' =>
            //             [
            //                 'nombre'=>'Ayuda Becaria',
            //                 'valor' =>'Descuento $'.$valorBD
            //             ]
            //         ]
            //     ]
            // ];
            // $res = array_slice($tmp, 0, 5, true) +
            // $detalleBD +
            // array_slice($tmp, 5, count($tmp) - 1, true);
            // $array["detalles"]["detalle"]=$res;
        }
        /*Termina*/

        /*Direccion de comprador*/
        if($direccion){
            $tmp=$array["infoFactura"];
            $res =  array_slice($tmp, 0, 6, true) +
                    array("direccionComprador" => $direccion) +
                    array_slice($tmp, 6, count($tmp) - 1, true);
            $array["infoFactura"]=$res;
        }

        /*Campos adicionales: Correo, telefono*/
        $campoadicional=array();
        if($correo){
            if($correo!="sincorreo@gmail.com"){
                $adicionalcorreo = ['_attributes' => ['nombre' => 'correo'],'_value'=>$correo];
                $campoadicional[]=$adicionalcorreo;
            }
        }
        if($telefono){
            $adicionaltelefono = ['_attributes' =>['nombre' => 'telefono'],'_value'=>$telefono];
            $campoadicional[]=$adicionaltelefono;
        }
        if(count($campoadicional)>0){
            $campAD=["campoAdicional"=>$campoadicional];
            $array["infoAdicional"]=$campAD;
        }/*Termina campos adicionales*/

        /*Conversion de array a xml*/
        $result = ArrayToXml::convert(
            $array, ['rootElementName' => 'factura','_attributes' => ['id' => 'comprobante','version' => '1.1.0'],],
            true, 'UTF-8',"1.0",['formatOutput' => true]);
        $xml = new \SimpleXMLElement($result);
        /*Termina*/
        $activacionFacturacionElectronica = ConfiguracionSistema::facturacionElectronica();
        /*Almacenamiento en servidor y ftp*/
        Storage::disk('local')->put('/public/xml/'.$claveacceso.'.xml', $xml->asXML());

        //Para configurar alamacenamiento en servidor ftp configurar en el archivo config/filesystems.php
        if ($activacionFacturacionElectronica->valor === '1') {
            Storage::disk('custom-ftp')->put($claveacceso.'.xml', $xml->asXML());
        }
        // SE AÑADE LA CLAVE DE ACCESO EN LA TABLA PAGOS_FACTURA
        $fac->claveAcceso = $claveacceso;
        $fac->save();
    }

    /*Jorge Fierro 9 de marzo de 2020 */
    public function generarMultiple($idPago,$cedula_ruc,$numero_factura,$cliente,$tipo_pago,$correo,$telefono,$tipoPagoBD,$valorBD){
        $fac = Factura::where('numeroFactura', $numero_factura)->first() ;
        $institution = Institution::first();
        $rucCED='';
        $now = Carbon::now()->format('d/m/Y');
        $replaceSymbolDate=str_replace('/', '', $now); //Deja la fecha en este formato ddmmyyyy
        $nombres='';
        $apellidos='';
        $direccion='';
        $comp=0;
        $tipoPagoFactura='';
        $periodoLectivo = PeriodoLectivo::find($this->idPeriodoUser());
        $pago = Payment::findOrFail($idPago);
        $cedulaRUC='';
        $subtotal=0.0;
        $valorcancelar=0.0;
        $sumDesc=0.0;

        /* Obtencion de la cantidad de caracteres en un factura y valida si hay
        9 digitos, si tiene menos agrega ceros por delante  */
        $numero_factura=$numero_factura;
        $lengthNumFactura=strlen ( $numero_factura );
        if($lengthNumFactura<9){
            $diff=9-$lengthNumFactura;
            for($i = 0;$i<$diff;$i++)
            {
                $numero_factura = '0'.$numero_factura;
            }
        }
        /* Termina */

        /*
            Validacion de cedula, ruc o consumidor final.
        */
        $comp=strlen($cedula_ruc);
        //Consumidor final
        if($comp==0){
            $rucCED='07';
            $cliente->nombres='CONSUMIDOR';
            $cliente->apellidos='FINAL';
            $cliente->cedula_ruc='9999999999999‬';
        }
        //RUC
        if($comp==13){
            $rucCED='04';
        }
        //Cedula(10 digitos)
        if($comp==10){
            $rucCED='05';
        }
        //Cedula(9 digitos)
        if($comp==9){
            $rucCED='05';
            $cliente->cedula_ruc='0'.$cliente->cedula_ruc;
        }
        //Cedula(menos de 9 digitos)
        if($comp<9){
            $diff2=10-$comp;
            for($i = 0;$i<$diff2;$i++)
            {
                $cliente->cedula_ruc='0'.$cliente->cedula_ruc;
            }
            $rucCED='05';
        }

        // HECTOR FUENTES
        /*Punto de emision dinamico.
        Variable que servira en caso de que manejen solo una caja
        caso contrario enviar la variable con nombre $ptoemi y comentar la linea*/

        $ptoemi='003';

        //Fin

        /* Tipo de pago del comprador.
        Variable tipoPagoFactura almacena codigo de tipo de pago.
        EFECTIVO 01
        CHEQUE 20
        TAREJETA DE CREDITO 19
        TARJETA DEBITO 16*/
        if($tipo_pago=="EFECTIVO"){
            $tipoPagoFactura='01';
        }
        if($tipo_pago=="CHEQUE" || $tipo_pago=="DEPOSITO"){
            $tipoPagoFactura='20';
        }
        if($tipo_pago=="TARJETACREDITO"){
            $tipoPagoFactura='19';
        }
        if($tipo_pago=="TARJETADEBITO"){
            $tipoPagoFactura='16';
        }
        /* */

        $descuento=0.0;

        /*Construcción de clave de acceso.
        Fecha+tipodecomprobante+ruc/cedula001(debe ir los 13 digitos)+Tipo de ambient (1 o 2)+
        Serie+numeroscuencial(Factura)+Codigo numero explicado arriba+Tipo de emision (1)+Digito Modulo 11 explicado mas abajo.
        */

        /*Codigo numerico.
        Se toma los primeros 8 digitos de la institucion para la respectiva identificacion */
        $codNum=substr($institution->ruc, 0, 8);
        if($rucCED=='05'){
            //Clave de acceso en el caso de cedula   ->  cedula+001
            $claveacceso=''.$replaceSymbolDate.'01'.$institution->ruc.'2'.$institution->establecimiento.$ptoemi.$numero_factura.''.$codNum.'1';
        }
        else{
            $claveacceso=''.$replaceSymbolDate.'01'.$institution->ruc.'2'.$institution->establecimiento.$ptoemi.$numero_factura.''.$codNum.'1';
        }

        /*Digito  modulo 11.
        Proceso definido por el SRI*/
        $claveacceso=$claveacceso.$this->generaDigitoModulo11($claveacceso);
        /*Termina construccion clave de acceso*/

        /*Arreglo donde se ubican los campos para posterior coversion a xml */
        $array = [
            'infoTributaria' => [
                'ambiente' => '2',//Cambiar aqui en el caso que sea pruebas (1) o produccion (2)
                'tipoEmision' => '1',
                'razonSocial' => $institution->razon_social,//Cambiar aqui la razon social de la institucion
                'nombreComercial' => $institution->nombre_comercial,//Cambiar aqui el nombre comercial de la institucion
                'ruc' => $institution->ruc,//Cambiar aqui el RUC de la institucion JP
                'claveAcceso' => $claveacceso,
                'codDoc' => '01',
                'estab' => $institution->establecimiento,//Cambiar aqui en el caso de tener otra sucursal de la institucion
                'ptoEmi' => $ptoemi,//Cambiar aqui en el caso de tener varias cajas
                'secuencial' => $numero_factura,//Ingreso manual
                'dirMatriz' => $institution->direccion_matriz,//Cambiar aqui direccion de sucursal o matriz de institcion
            ],
            'infoFactura' => [
                'fechaEmision' => $now,
                'dirEstablecimiento' => $institution->direccion_matriz,//Cambiar aqui direccion de sucursal o matriz de institcion
                'obligadoContabilidad' => 'SI',
                'tipoIdentificacionComprador' => $rucCED,//cedula o ruc
                'razonSocialComprador' => $cliente->nombres.' '.$cliente->apellidos,//Razon Social
                'identificacionComprador' => $cliente->cedula_ruc,
                'totalSinImpuestos' => bcdiv($valorcancelar, '1', 2),
                'totalSubsidio' =>'0',
                'totalDescuento' =>bcdiv($descuento, '1', 2),
                'totalComprobantesReempolso' =>'0',
                'totalBaseImponibleReembolso' =>'0',
                'totalImpuestoReembolso' =>'0',
                'totalConImpuestos' => [
                    'totalImpuesto' => [
                        'codigo' => '2',
                        'codigoPorcentaje' => '0',
                        'baseImponible' => bcdiv($valorcancelar, '1', 2),
                        'valor' => '0'
                    ]
                ],
                'propina' => '0.0',
                'importeTotal' => bcdiv($valorcancelar, '1', 2),
                'moneda' => 'DOLAR',
                'pagos' => [
                    'pago' => [
                        // Elegir tipo de pago
                        //codigo - forma de pago
                        // 01 - sin sistema financiero,
                        // 15 - compensacion de deudas,
                        // 16 - Tarjeta de debito,
                        // 17 - dinero electronico,
                        // 18 - tarjeta prepago,
                        // 19 - tarjeta de credito,
                        // 20 - otros,
                        // 21 - endoso de titulos.
                        'formaPago' => $tipoPagoFactura,
                        'total' => bcdiv($valorcancelar, '1', 2),
                        'plazo' =>'0',
                        'unidadTiempo' =>'dias'
                    ]
                ]
            ]
            ,
            'detalles' => ['detalle'=>[]]
        ];
        /*termina*/

        /*Iteracion a los pagos multiples*/
        foreach($pago as $p)
        {
            $tipoRubro=$p->rubro->tipo_rubro;
            $mes='';
            $sbttl=$p->valor_cancelar;
            $desc=0.0;
            if($tipoPagoBD==="PORCENTAJE"){
                $desc=($sbttl*$valorBD)/100;
                $desc=bcdiv($desc, '1', 2);
                $sbttl=$sbttl-$desc;
            }
            if($tipoPagoBD==="USD"){
                $desc=$valorBD;
                $sbttl=$sbttl-$desc;
            }
            if($tipoPagoBD!="PORCENTAJE" && $tipoPagoBD!="USD"){
                $sbttl=$sbttl;
                $desc=0.0;
            }

            $sumDesc=$sumDesc+$desc;
            $subtotal=$subtotal+$p->valor_cancelar;
            /*Identificación del mes de pago */
            switch ($p->mes){
                case '1' : $mes='Enero'     ; break;
                case '2' : $mes='Febrero'   ; break;
                case '3' : $mes='Marzo'     ; break;
                case '4' : $mes='Abril'     ; break;
                case '5' : $mes='Mayo'      ; break;
                case '6' : $mes='Junio'     ; break;
                case '7' : $mes='Julio'     ; break;
                case '8' : $mes='Agosto'    ; break;
                case '9' : $mes='Septiembre'; break;
                case '10': $mes='Octubre'   ; break;
                case '11': $mes='Noviembre' ; break;
                case '12': $mes='Diciembre' ; break;
            }
            $arr=['detalle' => [
                // Pensiones / pined-001
                // Matricula / pined-002
                // Separacion de matricula / pined-003
                // Robotica educativa / pined-004
                // Ambiente digital / pined-005
                'codigoPrincipal' =>'pined35135',
                'codigoAuxiliar' =>'pined35135',
                'descripcion' => $tipoRubro.' '.$mes.' Periodo:'.$periodoLectivo->nombre  ,
                'cantidad' => '1.0',
                'precioUnitario' => $p->valor_cancelar,
                'descuento' => bcdiv($desc, '1', 2),
                'precioTotalSinImpuesto' => bcdiv($sbttl, '1', 2),
                'detallesAdicionales'=>[
                    'detAdicional'=>['_attributes' => ['nombre'=>'Categoria','valor' => 'GENERAL']  ]
                ],
                'impuestos' => [
                    'impuesto' => [
                        'codigo' => '2',
                        'codigoPorcentaje' => '0',
                        'tarifa' => '0',
                        'baseImponible' => bcdiv($sbttl, '1', 2),
                        'valor' => '0',
                    ]
                ]
            ]];

            if( strtoupper($p->rubro->tipo_rubro) == 'PENSION'){
                /*Detalle descuento
                Jorge Fierro 11 de enero de 2020*/

                //Detalle descuento porcentaje
                if($tipoPagoBD=="PORCENTAJE"){
                    // $detallesAdicionales=array();
                    // $tmp=$array["detalles"]["detalle"];
                    // $detalleBD=[
                        // 'detallesAdicionales'=>[
                        //     'detAdicional'=>[

                        //         '_attributes' =>
                        //         [
                        //             'nombre'=>'Ayuda Becaria',
                        //             'valor' => 'Descuento '.$valorBD.'%'
                        //         ]
                        //     ]

                        // ]
                    // ];
                    // $res = array_slice($tmp, 0, 5, true) +
                    // $detalleBD +
                    // array_slice($tmp, 5, count($tmp) - 1, true);
                    // $array["detalles"]["detalle"]=$res;
                    $tmp=$arr["detalle"]["descripcion"];
                    $tmp=$tmp.' - Ayuda Becaria: Descuento'.$valorBD.'%';
                    $arr["detalle"]["descripcion"]=$tmp;
                }

                //Detalle descuento por valor
                if($tipoPagoBD=="USD"){
                    $tmp=$arr["detalle"]["descripcion"];
                    $tmp=$tmp.' - Ayuda Becaria: Descuento $'.$valorBD;
                    $arr["detalle"]["descripcion"]=$tmp;
                    // $detalleBD=[
                    //     'detallesAdicionales'=>[
                    //         'detAdicional'=>[
                    //             '_attributes' =>
                    //             [
                    //                 'nombre'=>'Ayuda Becaria',
                    //                 'valor' =>'Descuento $'.$valorBD
                    //             ]
                    //         ]
                    //     ]
                    // ];
                    // $res = array_slice($tmp, 0, 5, true) +
                    // $detalleBD +
                    // array_slice($tmp, 5, count($tmp) - 1, true);
                    // $array["detalles"]["detalle"]=$res;
                }
                /*Termina*/
            }
            array_push($array['detalles']['detalle'], $arr['detalle']);
        }
        /*Termina*/

        $valorcancelar=$subtotal-$sumDesc;
        $array['infoFactura']['totalSinImpuestos']=bcdiv($valorcancelar, '1', 2);
        $array['infoFactura']['totalDescuento']=bcdiv($sumDesc, '1', 2);
        $array['infoFactura']['totalConImpuestos']['totalImpuesto']['baseImponible']=bcdiv($valorcancelar, '1', 2);
        $array['infoFactura']['importeTotal']=bcdiv($valorcancelar, '1', 2);
        $array['infoFactura']['pagos']['pago']['total']=bcdiv($valorcancelar, '1', 2);

        /*Direccion de comprador*/
        if($direccion){
            $tmp=$array["infoFactura"];
            $res = array_slice($tmp, 0, 6, true) +
                array("direccionComprador" => $direccion) +
                array_slice($tmp, 6, count($tmp) - 1, true);
            $array["infoFactura"]=$res;
        }

        /*Campos adicionales: Correo, telefono*/
        $campoadicional=array();
        if($correo){
            if($correo!="sincorreo@gmail.com"){
                $adicionalcorreo = ['_attributes' => ['nombre' => 'correo'],'_value'=>$correo];
                $campoadicional[]=$adicionalcorreo;
            }
        }
        if($telefono){
            $adicionaltelefono = ['_attributes' =>['nombre' => 'telefono'],'_value'=>$telefono];
            $campoadicional[]=$adicionaltelefono;
        }
        if(count($campoadicional)>0){
            $campAD=["campoAdicional"=>$campoadicional];
            $array["infoAdicional"]=$campAD;
        }
        /*Termina campos adicionales*/

        /*Conversion de array a xml*/
        $result = ArrayToXml::convert(
        $array, ['rootElementName' => 'factura','_attributes' => ['id' => 'comprobante','version' => '1.1.0'],
            ], true, 'UTF-8',"1.0",['formatOutput' => true]);
        $xml = new \SimpleXMLElement($result);
        /*Termina*/
        $activacionFacturacionElectronica = ConfiguracionSistema::facturacionElectronica();

        /*Almacenamiento en servidor y ftp*/
        Storage::disk('local')->put('/public/xml/'.$claveacceso.'.xml', $xml->asXML());
        //Para configurar alamacenamiento en servidor ftp configurar en el archivo config/filesystems.php
        if ($activacionFacturacionElectronica->valor === '1') {
            Storage::disk('custom-ftp')->put($claveacceso.'.xml', $xml->asXML());
        }
        // SE AÑADE LA CLAVE DE ACCESO EN LA TABLA PAGOS_FACTURA
        $fac->claveAcceso = $claveacceso;
        $fac->save();
    }


    /*Digito modulo 11.
    Algoritmo definido por el SRI. */
    public function generaDigitoModulo11($cadena) {
        $baseMultiplicador = 7;
        $length = strlen($cadena);
        $aux = array_fill(0, $length, 0);
        $multiplicador = 2;
        $total = 0;
        $verificador = 0;
        for ( $i = $length - 1; $i >= 0; $i--) {
            $aux[$i] = (int)$cadena[$i];
            $aux[$i] = $aux[$i] * $multiplicador;
            $multiplicador++;
            if ($multiplicador > $baseMultiplicador){
                $multiplicador = 2;
            }
            $total += $aux[$i];
        }
        if ($total == 0 || $total == 1) {
            $verificador = 0;
        } else {
            $verificador = (11 - $total % 11 == 11) ? 0 : (11 - $total % 11);
        }
        if ($verificador == 10)
            $verificador = 1;
        return $verificador;
    }
    /*Termina */

    //Pagos que debe realizar un estudiante
    public static function getStudent($id) {
      /*
        $c = 1;
        $dia_pago = (int)ConfiguracionSistema::diaDePago()->valor;
        $periodos = PeriodoLectivo::all();
        $student = Student2::with('becasDescuentos')
            ->join('students2_profile_per_year', 'students2.id', '=', 'students2_profile_per_year.idStudent')
            ->where('students2_profile_per_year.idPeriodo', $this->idPeriodoUser())
            ->where('students2_profile_per_year.idStudent', $id)
            ->select('students2.id', 'students2_profile_per_year.idCurso', 'students2.apellidos', 'students2.nombres', 'students2_profile_per_year.idPeriodo')
            ->first();
        $becas = BecaDescuento::all();
        $course = Course::find($student->idCurso);
        $pagosPendientes = PagoEstudianteDetalle::getDetailPaymentsByStudent($id, $student->idCurso)->where('estado', 'PENDIENTE');
        if( count($pagosPendientes) > 0){
            foreach($pagosPendientes as $key => $pago ){
                $pago_mes = $pago->pago;
                if($pago_mes != null) {
                    if($pago->prorroga == null){
                        $fecha_pago = Carbon::createFromDate($pago_mes->anio, $pago_mes->mes+1, $dia_pago);
                    }else{
                        $fecha_pago = Carbon::createFromDate($pago_mes->anio, $pago_mes->mes+1, $dia_pago+$pago->prorroga);
                        $now = Carbon::now();
                        if($fecha_pago >= $now){
                            $pagosPendientes->forget($key);
                        }
                    }
                }
            }
        }
        $beca_estudiante = BecaDetalle::where('idEstudiante', $student->id)->get();
        $pagos = PagoEstudianteDetalle::getDetailPaymentsByStudent($id, $student->idCurso);
        $tutor = User::find($course->idProfesor);
*/
        //Creacion de cuentas por pagar
        $dataProfile = Student2Profile::where('idStudent','=',$id)->first();
        
        $data = Student2::where('id','=',$dataProfile->idStudent)->first();
        //dd($dataProfile, $data);
        $cuentasxcobrar_id = Cuentasporcobrar::latest('id')->first();
        if($cuentasxcobrar_id == null){
            $cuentasxcobrar_id = new \stdClass();
            $cuentasxcobrar_id->id = 1;
        }
         //dd($cuentasxcobrar_id);
        $cxc = new Cuentasporcobrar();
        $curso = Course::where('id','=',$dataProfile->idCurso)->first();
        $carrera = Career::where('id','=',$curso->id_career)->first();        
        $semester = Semesters::where('id', '=', $curso->id_semester)->first();
        $fechaEmision = Carbon::createFromFormat('Y-m-d',$semester->inicio_semestre);
        //dd((Cuentasporcobrar::where('id_semesters',$semester->id)->where('cliente_id',$dataProfile->id)->get())->isEmpty());
        if((Cuentasporcobrar::where('id_semesters',$semester->id)->where('cliente_id',$dataProfile->id)->get())->isEmpty()){
            $cxc = new Cuentasporcobrar();
            $cxc->fecha_emision         =  Carbon::createFromFormat('Y-m-d',$semester->inicio_semestre);
            $cxc->fecha_vencimiento     =  $fechaEmision->addDay($semester->vencimiento_cuotas);
            $cxc->comprobante_id        =  $cuentasxcobrar_id->id+1;
            $cxc->credito               =  0;
            $cxc->cliente_id            =  $dataProfile->id ;    
            $cxc->id_semesters          =  $curso->id_semester;
            $cxc->concepto              =  'Matricula del Semestre';
            if($data->tipoBecaId == 3){   
                $cxc->debito  =  $carrera->costo_matricula;                
                $cxc->saldo = $carrera->costo_matricula;
                PayController::generarCuotas($semester->cuotas,$semester->inicio_semestre,
                $cuentasxcobrar_id->id+1,$semester->costo_semestre,$dataProfile->id,$curso->id_semester);
    
            }
            if($data->tipoBecaId == 1){
                $porcentajeDescuento = $data->porcientoBecaCoberturaArancel / 100;
                $descuento = $carrera->costo_matricula * $porcentajeDescuento;
                $descuentoSemestre = $semester->costo_semestre * $porcentajeDescuento;
                $costoMatricula = $carrera->costo_matricula - $descuento;
                $costoSemestre = $semester->costo_semestre - $descuentoSemestre;
                $cxc->debito  =  $carrera->costo_matricula;
                $cxc->saldo = $carrera->costo_matricula;
                PayController::generarCuotas($semester->cuotas,$semester->inicio_semestre,
                $cuentasxcobrar_id->id+1,$costoSemestre,$dataProfile->id,$curso->id_semester);
            }
            if($data->tipoBecaId == 2){
                //dd("beca parcial");
                $porcentajeDescuento = $data->porcientoBecaCoberturaArancel / 100;
                $descuento = $carrera->costo_matricula * $porcentajeDescuento;
                $descuentoSemestre = $semester->costo_semestre * $porcentajeDescuento;
                $costoMatricula = $carrera->costo_matricula - $descuento;
                $costoSemestre = $semester->costo_semestre - $descuentoSemestre;
            
                $cxc->debito  =  $carrera->costo_matricula;               
                $cxc->saldo = $carrera->costo_matricula;
                PayController::generarCuotas($semester->cuotas,$semester->inicio_semestre,
                $cuentasxcobrar_id->id+1,$costoSemestre,$dataProfile->id,$curso->id_semester);
    
                //dd($carrera->costo_matricula,$porcentajeDescuento,$descuento,$costoMatricula);
            }
            $cxc->save();
        }
       // return view('UsersViews.colecturia.pagos.pagosEstudiante',
        //compact('student', 'course', 'tutor', 'pagos', 'becas', 'periodos', 'pagosPendientes', 'c','dia_pago','beca_estudiante'));
       // return redirect()->route('matricula');
    }

    public static function getStudentPase($id, $curso) {
        /*
          $c = 1;
          $dia_pago = (int)ConfiguracionSistema::diaDePago()->valor;
          $periodos = PeriodoLectivo::all();
          $student = Student2::with('becasDescuentos')
              ->join('students2_profile_per_year', 'students2.id', '=', 'students2_profile_per_year.idStudent')
              ->where('students2_profile_per_year.idPeriodo', $this->idPeriodoUser())
              ->where('students2_profile_per_year.idStudent', $id)
              ->select('students2.id', 'students2_profile_per_year.idCurso', 'students2.apellidos', 'students2.nombres', 'students2_profile_per_year.idPeriodo')
              ->first();
          $becas = BecaDescuento::all();
          $course = Course::find($student->idCurso);
          $pagosPendientes = PagoEstudianteDetalle::getDetailPaymentsByStudent($id, $student->idCurso)->where('estado', 'PENDIENTE');
          if( count($pagosPendientes) > 0){
              foreach($pagosPendientes as $key => $pago ){
                  $pago_mes = $pago->pago;
                  if($pago_mes != null) {
                      if($pago->prorroga == null){
                          $fecha_pago = Carbon::createFromDate($pago_mes->anio, $pago_mes->mes+1, $dia_pago);
                      }else{
                          $fecha_pago = Carbon::createFromDate($pago_mes->anio, $pago_mes->mes+1, $dia_pago+$pago->prorroga);
                          $now = Carbon::now();
                          if($fecha_pago >= $now){
                              $pagosPendientes->forget($key);
                          }
                      }
                  }
              }
          }
          $beca_estudiante = BecaDetalle::where('idEstudiante', $student->id)->get();
          $pagos = PagoEstudianteDetalle::getDetailPaymentsByStudent($id, $student->idCurso);
          $tutor = User::find($course->idProfesor);
  */
          //Creacion de cuentas por pagar
          $dataProfile = Student2Profile::where('idStudent','=',$id)->first();
          
          $data = Student2::where('id','=',$dataProfile->idStudent)->first();
          //dd($dataProfile, $data);
          $cuentasxcobrar_id = Cuentasporcobrar::latest('id')->first();
          if($cuentasxcobrar_id == null){
              $cuentasxcobrar_id = new \stdClass();
              $cuentasxcobrar_id->id = 1;
          }
           //dd($cuentasxcobrar_id);
          $cxc = new Cuentasporcobrar();
          $curso = Course::where('id','=',$curso)->first();
          $carrera = Career::where('id','=',$curso->id_career)->first();        
          $semester = Semesters::where('id', '=', $curso->id_semester)->first();
          $fechaEmision = Carbon::createFromFormat('Y-m-d',$semester->inicio_semestre);
          $cxc->fecha_emision         =  Carbon::createFromFormat('Y-m-d',$semester->inicio_semestre);
          $cxc->fecha_vencimiento     =  $fechaEmision->addDay($semester->vencimiento_cuotas);
          $cxc->comprobante_id        =  $cuentasxcobrar_id->id+1;
          $cxc->credito               =  0;
          $cxc->cliente_id            =  $dataProfile->id ;    
          $cxc->id_semesters = $curso->id_semester;
          $cxc->concepto              =  'Matricula del Semestre';
          if($data->tipoBecaId == 3){   
              $cxc->debito  =  $carrera->costo_matricula;                
              $cxc->saldo = $carrera->costo_matricula;
              PayController::generarCuotas($semester->cuotas,$semester->inicio_semestre,
              $cuentasxcobrar_id->id+1,$semester->costo_semestre,$dataProfile->id,$curso->id_semester);
  
          }
          if($data->tipoBecaId == 1){
              $porcentajeDescuento = $data->porcientoBecaCoberturaArancel / 100;
              $descuento = $carrera->costo_matricula * $porcentajeDescuento;
              $descuentoSemestre = $semester->costo_semestre * $porcentajeDescuento;
              $costoMatricula = $carrera->costo_matricula - $descuento;
              $costoSemestre = $semester->costo_semestre - $descuentoSemestre;
              $cxc->debito  =  $carrera->costo_matricula;
              $cxc->saldo = $carrera->costo_matricula;
              PayController::generarCuotas($semester->cuotas,$semester->inicio_semestre,
              $cuentasxcobrar_id->id+1,$costoSemestre,$dataProfile->id,$curso->id_semester);
          }
          if($data->tipoBecaId == 2){
              //dd("beca parcial");
              $porcentajeDescuento = $data->porcientoBecaCoberturaArancel / 100;
              $descuento = $carrera->costo_matricula * $porcentajeDescuento;
              $descuentoSemestre = $semester->costo_semestre * $porcentajeDescuento;
              $costoMatricula = $carrera->costo_matricula - $descuento;
              $costoSemestre = $semester->costo_semestre - $descuentoSemestre;
          
              $cxc->debito  =  $carrera->costo_matricula;               
              $cxc->saldo = $carrera->costo_matricula;
              PayController::generarCuotas($semester->cuotas,$semester->inicio_semestre,
              $cuentasxcobrar_id->id+1,$costoSemestre,$dataProfile->id,$curso->id_semester);
  
              //dd($carrera->costo_matricula,$porcentajeDescuento,$descuento,$costoMatricula);
          }
          $cxc->save();
  
         // return view('UsersViews.colecturia.pagos.pagosEstudiante',
          //compact('student', 'course', 'tutor', 'pagos', 'becas', 'periodos', 'pagosPendientes', 'c','dia_pago','beca_estudiante'));
         // return redirect()->route('matricula');
      }
    public static function generarCuotas($cuotas,$fechaInicial,$comprobante,$costoSemestre,$estudiante,$id_semester){
        $j=1;
        //dd($fechaInicial);
        $fechaPago = Carbon::createFromFormat('Y-m-d',$fechaInicial)->addDay(30);
        for ($i=0; $i < $cuotas ; $i++) { 
            $cxc = new Cuentasporcobrar();
            $fecha = $fechaPago;
            $cxc->fecha_emision  =  Carbon::createFromFormat('Y-m-d',$fechaInicial);
            $cxc->fecha_vencimiento  =  $fecha->addDay(30);
            $cxc->comprobante_id  =  $comprobante;
            $cxc->debito  =  $costoSemestre/$cuotas;
            $cxc->credito  =  0;
            $cxc->cliente_id  =  $estudiante;
            $cxc->saldo = $costoSemestre/$cuotas;
            $cxc->id_semesters = $id_semester;
            $cxc->concepto  =  'Cuota de Semestre';
            $cxc->save();
            DB::commit();
            $j++;
        }
    }
    public function getAbonos($idFactura) {
        try {
            $factura = Factura::with('abonos')->findOrFail($idFactura);
            return $factura;
        } catch (Exception $e) {
            return Redirect::back()->withErrors(['Factura' => 'Ha ocurrido un error.']);
        }
    }

    /*  Administrador  */
    //Metodo para crear un registro a pagar, se lo realiza por curso
    public function create($idCurso){
        $courses = Course::getAllCourses();
        $periodos = PeriodoLectivo::all();
        $rubros = Rubro::getRubros();
        return view('UsersViews.administrador.configuraciones.configuracionesPagos.crearPago',
            compact('idCurso', 'courses', 'periodos', 'rubros'));
    }

    //Metodo para crear un registro a pagar, se lo realiza por curso
    public function store(Request $request, $idCurso){
        DB::beginTransaction();
        $rubro = Rubro::findOrFail($request->tipo);
        $data = new Payment();
        $data->idCurso = $idCurso;
        $data->mes = $request->mes;
        $data->idPeriodo = $this->idPeriodoUser();
        $data->anio_lectivo = PeriodoLectivo::find($this->idPeriodoUser())->first()->nombre;
        $data->anio = $request->ano;
        $data->tipo = $request->tipo;
        $data->idRubro = $rubro->id;
        $data->idPeriodo = $this->idPeriodoUser();
        $data->tipo_emision = $request->tipo_emision;
        $data->descripcion = $request->descripcion;
        $data->valor_autorizado = $request->valor_autorizado;
        $data->valor_cancelar = $request->valor_cancelar;
        $data->save();
        $students = Student2::query()
            ->join('students2_profile_per_year', 'students2.id', '=', 'students2_profile_per_year.idStudent')
            ->where('students2_profile_per_year.idCurso', $idCurso)
            ->where('idPeriodo', $this->idPeriodoUser())
            ->select('students2.id')
            ->get();
        foreach($students as $student) {
            $pagoDetalle = new PagoEstudianteDetalle;
            $pagoDetalle->idEstudiante = $student->id;
            $pagoDetalle->idPeriodo = $this->idPeriodoUser();
            $pagoDetalle->estado = "PENDIENTE";
            $data->pagoEstudianteDetalle()->save($pagoDetalle);
        }
        DB::commit();
        return redirect()->route('configuracionesPagos');
    }

    //Metodo para editar un registro a pagar, se lo realiza por curso
    public function edit($id){
        $rubros = Rubro::getRubros();
        $pago = Payment::findOrFail($id);
        $course = Course::findOrFail($pago->idCurso);
        return view('UsersViews.administrador.configuraciones.configuracionesPagos.editarPago', compact('pago', 'course', 'id', 'rubros'));
    }

    //Metodo para editar un registro a pagar, se lo realiza por curso
    public function update(Request $request, $id){
        $data = Payment::findOrFail($id);
        $rubro =$data->rubro->tipo_rubro;
        $data->mes = $request->mes;
        $data->anio = $request->ano;
        $data->tipo = $rubro;
        $data->tipo_emision = $request->tipo_emision;
        $data->descripcion = $request->descripcion;
        $data->valor_autorizado = $request->valor_autorizado;
        $data->valor_cancelar = $request->valor_cancelar;
        $data->save();
        return redirect()->route('configuracionesPagos');
    }

    //Metodo para eliminar un registro a pagar, se lo realiza por curso
    public function destroy($id){
        $data = Payment::findOrFail($id);
        $data->delete();
        return redirect()->route('configuracionesPagos');
    }

    public function rubroStore(Request $request) {
        Rubro::create([
            'tipo_rubro' => $request->tipo_rubro,
            'tipo_emision' => $request->tipo_emision,
            'idPeriodo' => $this->idPeriodoUser()
        ]);
        return back();
    }

    public function rubroShow(Rubro $rubro) {
        return $rubro;
    }

    public function rubroDestroy(Rubro $rubro) {
        $rubro->delete();
        return back();
    }

    //Metodo que muestra el index de becas y descuentos, se lo realiza en general
    public function BOD(){
        $bod = BecaDescuento::getAllDiscounts();
        return view('UsersViews.administrador.configuraciones.configuracionesPagos.becasODescuentos.index',
        compact( 'bod'));
    }

    //Metodo para crear una beca o descuento, se lo realiza en general
    public function createBOD(){
        // if(count($pagos) == 0 )
        //     return redirect()->back()->with('message', ['type'=> 'danger', 'text' =>  "No tiene registrado pagos el curso" ]);
        // else
        return view('UsersViews.administrador.configuraciones.configuracionesPagos.becasODescuentos.crearBOD');
    }

    //Metodo para crear una beca o descuento, se lo realiza en general
    public function storeBOD(Request $request){
        $bod = new BecaDescuento();
        $bod->tipo = $request->tipo;
        $bod->tipo_pago = $request->tipo_pago;
        $bod->nombre = $request->nombre;
        $bod->descripcion = $request->descripcion;
        $bod->valor = $request->valor;
        $bod->idPeriodo = $this->idPeriodoUser();
        $bod->save();
        return redirect()->route('becas');
    }

    //Metodo para editar una beca o descuento, se lo realiza en general
    public function editBOD($id){
        $bod = BecaDescuento::findOrFail($id);
        return view('UsersViews.administrador.configuraciones.configuracionesPagos.becasODescuentos.editarBOD', compact('bod'));
    }

    //Metodo para editar una beca o descuento, se lo realiza en general
    public function updateBOD(Request $request, $id){
        $bod = BecaDescuento::findOrFail($id);
        $bod->tipo = $request->tipo;
        $bod->nombre = $request->nombre;
        $bod->tipo_pago = $request->tipo_pago;
        $bod->descripcion = $request->descripcion;
        $bod->valor = $request->valor;
        $bod->save();
        return redirect()->back();
    }

    //Metodo para eliminar una beca o descuento, se lo realiza en general
    public function destroyBOD($id){
        $bod = BecaDescuento::findOrFail($id);
        $bod->delete();
        return redirect()->back();
    }

    public function storeEstudianteBecas100() {
        foreach (request()->idStudents as $key => $value) {
            $pagosEstudiante = Student2::find($key);
            foreach ($pagosEstudiante->pagos as $pago) {
                $pagos = Payment::find($pago->idPago);
                if ($pagos->tipo == 'Pension' || $pagos->tipo == 4) {
                    $pago->estado = 'PAGADO';
                    $pago->save();
                }
            }
        }
        return back();
    }

    public function facturacionIndex() {
        $user = Sentinel::getUser();
        if ($user->email !== 'soporte@pined.ec') {
            abort(404);
        }
        $institution = Institution::first();
        return view('UsersViews.administrador.facturacionElectronica.index', compact('institution'));
    }

    public function facturacionUpdate(Request $request) {
        $this->validate($request, [
            'razon_social' => 'required',
            'nombre_comercial' => 'required',
            'ruc' => 'numeric|required',
            'establecimiento' => 'numeric|required',
            'direccion_matriz' => 'required'
        ]);
        $institution = Institution::first();
        $institution->razon_social = $request->razon_social;
        $institution->nombre_comercial = $request->nombre_comercial;
        $institution->ruc = $request->ruc;
        $institution->establecimiento = $request->establecimiento;
        $institution->direccion_matriz = $request->direccion_matriz;
        $institution->aula_virtual = $request->aula_virtual;
        $institution->save();
        return back();
    }

    public function cambioDeMatricula($idEstudiante) {
        $student = Student2Profile::getStudent($idEstudiante);
        if ($student->tipo_matricula === 'Pre Matricula') {
            $periodoLectivo = PeriodoLectivo::findOrFail($student->idPeriodo);
            $contador_matricula = ConfiguracionSistema::contadorMatricula();
            if($contador_matricula->valor == 'G') {
                $cont = Student2Profile::where('tipo_matricula', '!=', 'Pre Matricula')
                    ->where('idPeriodo', $this->idPeriodoUser())
                    ->get()
                    ->count();
                $student->numero_matriculacion = substr($periodoLectivo->fecha_inicial,0,4)."-".sprintf("%04d", $cont+1);
            } else {
                $cont = Student2Profile::where('seccion', $student->seccion)
                    ->where('tipo_matricula', '!=', 'Pre Matricula')
                    ->where('idPeriodo', $this->idPeriodoUser())
                    ->get()
                    ->count();
                $student->numero_matriculacion = substr($periodoLectivo->fecha_inicial,0,4)."-".sprintf("%04d", $cont+1);
            }
            $student->fecha_matriculacion = Carbon::now()->format('Y-m-d');
            if($student->student->idProfile == null) {
                // Creando el usuario
                $user = new User;
                $nombres = explode(" ", $student->nombres);
                $apellidos = explode(" ", $student->apellidos);
                $primerNombre = strtolower($nombres[0]);
                $primerApellido = strtolower($apellidos[0]);
                $user_sentinel = [
                    'email' =>  $primerNombre.'.'.$primerApellido.$student->student->id."@pined.ec",
                    'password'  =>  "12345"
                ];
                $user = Sentinel::registerAndActivate($user_sentinel);
                $user->idPeriodoLectivo = $this->idPeriodoUser();
                $user->save();
                //registra el rol de los usuarios
                $role = Sentinel::findRoleByName("Estudiante");
                $role->users()->attach($user);
                $idProfile = DB::table('users_profile')
                    ->insertGetId([
                        'ci'    =>  $student->ci,
                        'nombres'   =>  $student->nombres,
                        'apellidos' =>  $student->apellidos,
                        'sexo'  =>      $student->sexo,
                        'fNacimiento'   =>  $student->fechaNacimiento,
                        'correo'    => $user->email,
                        'dDomicilio'    =>  $student->dDomicilio,
                        'tDomicilio'    =>  $student->tDomicilio,
                        'cargo' =>  "Estudiante",
                        'userid'   =>  $user->id,
                        'created_at'    =>  date("Y-m-d H:i:s"),
                    ]);
                $student->student->idProfile = $idProfile;
                $student->save();
            }
            $student->tipo_matricula = 'Ordinaria';
            $student->save();

            //se cambia la matricula en Student2 debido a que en asistencias toma esta tabla para asignar las mismas
            $student2 = Student2::findOrFail($student->idStudent);
            $student2->matricula = 'Ordinaria';
            $student2->save();
            $this->creacionDeAsistenciaParcial($student->id, $this->idPeriodoUser());
        }
    }
    public function creacionDeAsistenciaParcial($idStudent, $idPeriodo) {
        $parciales = ['p1q1', 'p2q1', 'p3q1', 'p1q2', 'p2q2', 'p3q2'];
        foreach ($parciales as $parcial) {
            AsistenciaParcial::create([
                'idStudent' => $idStudent,
                'parcial' => $parcial,
                'idPeriodo' => $idPeriodo ?? $this->idPeriodoUser(),
            ]);
        }
    }
    public function getUserIpAddr(){
        $ipaddress = '';
        if (isset($_SERVER['HTTP_CLIENT_IP']))
            $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
        else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
            $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
        else if(isset($_SERVER['HTTP_X_FORWARDED']))
            $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
        else if(isset($_SERVER['HTTP_FORWARDED_FOR']))
            $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
        else if(isset($_SERVER['HTTP_FORWARDED']))
            $ipaddress = $_SERVER['HTTP_FORWARDED'];
        else if(isset($_SERVER['REMOTE_ADDR']))
            $ipaddress = $_SERVER['REMOTE_ADDR'];
        else
            $ipaddress = 'UNKNOWN';
        return $ipaddress;
    }

    public function recibe_token2(Request $request)
    {
        //JOSE RAMIREZ
        //funcion para guardar el pago desde DATAFAST
        $entityId='8ac7a4c971df15330171e05eb0810592';
        $resourcePath = $request->resourcePath;
        $url = "https://test.oppwa.com".$resourcePath;
        $url .= "?entityId=".$entityId;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                    'Authorization:Bearer OGE4Mjk0MTg1YTY1YmY1ZTAxNWE2YzhjNzI4YzBkOTV8YmZxR3F3UTMyWA=='));
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);// this should be set to true in production
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $responseData = curl_exec($ch);
        if(curl_errno($ch)) {
            return curl_error($ch);
        }
        curl_close($ch);
        $data = json_decode($responseData, true);
        //separo el id del cliente y del estudiante;
        list($cliente_id,$estudiante_id) = explode("__", $data['customer']['merchantCustomerId']);
        list($nulo,$factura_transaccion) = explode("__", $data['merchantTransactionId']);
        $cliente=Cliente::findOrFail($cliente_id);
        if ($data['result']['code'] =='000.000.000' || $data['result']['code'] =='000.100.112' || $data['result']['code'] =='000.100.110') {//guardo los datos en la tabla historico_de_transacciones_en_lineas
            $historicoPEL = new HistoricoTransaccionesEnLinea();
            $historicoPEL->transaccion          =$data['id'];
            $historicoPEL->paymentype_DF        =$data['paymentType'];
            $historicoPEL->codigo_error         =$data['result']['code'];
            $historicoPEL->descripcion_error    =$data['result']['description'];
            $historicoPEL->MerchantTransactionId_DF =$factura_transaccion;
            $historicoPEL->total                =$data['amount'];
            $historicoPEL->idCliente            =$cliente_id;
            $historicoPEL->AuthCode_DF          =$data['resultDetails']['AuthCode'];
            $historicoPEL->ReferenceNbr_DF      =$data['resultDetails']['ReferenceNbr'];
            $historicoPEL->ArquirerResponse_DF  =$data['resultDetails']['AcquirerResponse'];
            $historicoPEL->customParameters_DF  =$data['customParameters']['1000000505_PD100406'];
            $historicoPEL->status  ='COMPLETADA';
            if (isset($data['customParameters']['SHOPPER_interes']) ) {
                $historicoPEL->shopper_interes_DF =$data['customParameters']['SHOPPER_interes'];
            }else{
                $historicoPEL->shopper_interes_DF= '0';
            }
            if (isset($data['customParameters']['SHOPPER_gracia']) ) {
                $historicoPEL->shopper_gacia_DF =$data['customParameters']['SHOPPER_gracia'];
            }else{
                $historicoPEL->shopper_gacia_DF= '0';
            }
            if (isset( $data['recurring']['numberOfInstallments']) ) {
                $historicoPEL->numero_diferido_DF   =$data['recurring']['numberOfInstallments'];
            }else{
                $historicoPEL->numero_diferido_DF= '0';
            }
            if (isset( $data['registrationId']) ) {
                $historicoPEL->registrationId   =$data['registrationId'];//en caso de registrar el token del cliente
            }
            $historicoPEL->save();
            $idTransaccion=$historicoPEL->id;
        }else{//en caso de que la respuesta no sea satisfactoria:::guardo en la tabla y regreso mostrando la descripción del error
            $historicoPEL = new HistoricoTransaccionesEnLinea();
            $historicoPEL->transaccion          =$data['id'];
            $historicoPEL->paymentype_DF        =$data['paymentType'];
            $historicoPEL->MerchantTransactionId_DF =$factura_transaccion;
            $historicoPEL->codigo_error         =$data['result']['code'];
            $historicoPEL->descripcion_error    =$data['result']['description'];
            $historicoPEL->total                =$data['amount'];
            $historicoPEL->idCliente            =$cliente_id;
            $historicoPEL->ArquirerResponse_DF  =$data['resultDetails']['AcquirerResponse'];
            $historicoPEL->customParameters_DF  =$data['customParameters']['1000000505_PD100406'];
            $historicoPEL->status  ='NO-COMPLETADA';
            $historicoPEL->save();
            return Redirect::route('representantePagosPendientes',['id' => $estudiante_id])->withErrors(['error' => 'Ha ocurrido un error, la transacción no se efectuo, mensaje: '.$data['result']['description']]);
            //regresar al modulo de la factura mostrando el error !!
        }
        $estudiante=Student2Profile::getStudent($estudiante_id);
        foreach ($data['cart']['items'] as $pd) {
            list($description,$id_pago,$id_Pdetalle) = explode("__", $pd['description']);
            $idPago[]=$id_pago;
        }
        DB::beginTransaction();
        $student = Student2Profile::getStudent($estudiante_id);
        $todasLasFacturas = Factura::all()->count();
        $factura = new Factura;
        $factura->idCliente = $cliente_id;
        if ($todasLasFacturas == 0) {
            $numeroDeFactura = "1";
        } else {
            $ultimoRegistro = Factura::orderBy('created_at', 'DESC')->first();
            $numeroDeFactura = (int)Factura::orderBy('created_at', 'DESC')->first()->numeroFactura;
            $numeroDeFactura++;
            $numeroDeFactura = $numeroDeFactura."";
        }
        $factura->numeroFactura = $numeroDeFactura;
        $factura->subtotal = $data['amount'];
        $factura->idPeriodo = $this->idPeriodoUser();
        $factura->tipo_pago = 'TARJETACREDITO';
        $factura->total = $data['amount'];
        $user = Sentinel::getUser();
        $user_profile = Administrative::findBySentinelid($user->id);
        $factura->idUsuario = $user_profile->id;
        $factura->idTransaccion=$idTransaccion;//  relación de la tabla historico_transacciones_en_linea
        $factura->save();
        $c = 0;
        foreach ($data['cart']['items'] as $pd) {
            list($description,$id_pago,$id_Pdetalle) = explode("__", $pd['description']);
            $detalle = new FacturaDetalle;
            $pago_detalle = PagoEstudianteDetalle::with('pago')->find($id_Pdetalle);
            $detalle->idCliente = $cliente_id;
            $detalle->idPagoDetalle = $pago_detalle->id;
            $detalle->idEstudiante = $estudiante_id;
            $detalle->subtotal = $data['amount'];
            $detalle->idPeriodo = $this->idPeriodoUser();
            $detalle->total = $data['amount'];
            $detalle->idFactura = $factura->id;
            $detalle->save();
            if($request->total == $request->valor_pagar){ // si voy a pagar el valor completo se marcara como pagado en pago_detalle,
                $pago_detalle->estado = "PAGADO";
                $pago_detalle->save();
                $idAbono = null;
                $rubro = Rubro::find($pago_detalle->pago->idRubro);
                if($rubro->tipo_emision == "RECIBO"){ // si el tipo de emision es de recibo se creara un abono
                    $abono = new Abono;
                    $abono->cantidad = $data['amount'];
                    $abono->idFactura = $factura->id;
                    $abono->idPeriodo = $this->idPeriodoUser();
                    $abono->idPagoDetalle = $id_Pdetalle;
                    $abono->save();
                    $idAbono = $abono->id;
                }
                $tipoPago = new TipoPago;
                $tipoPago->tipo_pago = 'TARJETACREDITO';
                $tipoPago->banco = $data['paymentBrand'];
                $tipoPago->idPeriodo = $this->idPeriodoUser();
                $tipoPago->idFactura = $factura->id;
                $tipoPago->idRecibo = $idAbono;
                //Si se debe emitir factura lo genera
                if($rubro->tipo_emision == "FACTURA") {
                    /*Jorge Fierro 9 de marzo*/
                    //Verificacion de un pago o multiples
                    if(count($idPago)==1){
                        // Genera xml de la factura. Descomentar en el caso de ser necesario.
                        //Se envia la primera posicion  \/
                        //return $cliente;
                        $this->generar($idPago,
                        $cliente->cedula_ruc,
                        $factura->numeroFactura,
                        $cliente,
                        'TARJETACREDITO',
                        $cliente->correo,
                        $cliente->telefono,
                        $request->tipo_pagoBD,
                        $request->valorBD);
                    }
                    else{

                        // Genera xml de la factura. Descomentar en el caso de ser necesario.
                        //Se envia el arreglo de los pagos\/
                        $this->generarMultiple($idPago,
                        $cliente->cedula_ruc,
                        $factura->numeroFactura,
                        $cliente,
                        'TARJETACREDITO',
                        $cliente->correo,
                        $cliente->telefono,
                        $request->tipo_pagoBD,
                        $request->valorBD);
                    }
                }
                $tipoPago->save();
            }
            $c++;
        }
        $this->cambioDeMatricula($estudiante_id);
        DB::commit();
        return redirect()->route('representantePagosPendientes', ['id' => $estudiante_id]);
    }

    public function facturaPostKushki(Request $request){
        $idTransaccion=null;
        /**Jose Rámirez**/
        //diferenciar si el pago se hace desde el adm o desde el representante:::::::::
        //$request->kushkiToken token enviado desde kushki para la seguridad de la transacción :::::::::
        if (isset($request->kushkiToken)) {
            //si existe la variable
            if (!empty($request->kushkiToken)) {// no esta vacia
                $nombres=$request->nombres2;
                $apellidos=$request->apellidos2;
                $email=$request->email2;
                $direccion=$request->direccion2;
                $telefono=$request->telefono2;
                $cedula_ruc=$request->cedula_ruc2;
                $merchantId = "7d18a4e5993249dd86cff3c271246949";
                $language = KushkiLanguage::ES;
                $currency = KushkiCurrency::USD; // KushkiCurrency::COP; for Colombia
                $environment = KushkiEnvironment::TESTING;
                $kushki = new Kushki($merchantId, $language, $currency, $environment);
                $token = $request->kushkiToken;
                $subtotalIva =$request->total;
                $iva = 0;
                $subtotalIva0 = 0;
                $ice = 0;
                $amount = new \Kushki\lib\Amount($subtotalIva, $iva, $subtotalIva0, $ice);
                $chargeTransaction = $kushki->charge($token, $amount);
                if ($chargeTransaction->isSuccessful()) {
                    $ticket = $chargeTransaction->getTicketNumber();
                    $historicoPEL = new HistoricoTransaccionesEnLinea();
                    $historicoPEL->transaccion = $chargeTransaction->getTicketNumber();
                    $historicoPEL->total =$request->total;
                    $historicoPEL->idCliente =$request->idCliente;
                    $historicoPEL->save();
                    $idTransaccion=$historicoPEL->id;
                }else{
                    $historicoPEL = new HistoricoTransaccionesEnLinea();
                    $historicoPEL->codigo_error = $chargeTransaction->getResponseCode();
                    $historicoPEL->descripcion_error = $chargeTransaction->getResponseText();
                    $historicoPEL->total = $request->total;
                    $historicoPEL->idCliente = $request->idCliente;
                    $historicoPEL->save();
                    // return  "Error " . $chargeTransaction->getResponseCode() . ": " . $chargeTransaction->getResponseText();
                    //regresar al modulo de la factura mostrando el error !!
                    return Redirect::route('pagosCursoEstudiante',['id' => $request->idEstudiante])->withErrors(['error' => 'Ha ocurrido un error, mensaje: '. $chargeTransaction->getResponseText()]);
                }
            }else {
                return 'error en el pago comuniquese con el administrador';
            }
        }else{
            $this->validate($request, [
                'cedula_ruc' => 'required',
                'nombres' => 'required',
                'apellidos' => 'required',
                'telefono' => 'required',
                'direccion' => 'required',
                'email' => 'required',
                'valor_pagar' => 'required',
                ]);
            $nombres=$request->nombres;
            $apellidos=$request->apellidos;
            $email=$request->email;
            $direccion=$request->direccion;
            $telefono=$request->telefono;
            $cedula_ruc=$request->cedula_ruc;
        }
        $estudiante=Student2Profile::getStudent($request->idEstudiante);
        DB::beginTransaction();
        $student = Student2Profile::getStudent($request->idEstudiante);
        $cliente = $student->cliente;
        #region clientes
        if($cliente->id == null){
            $cliente = new Cliente;
            $cliente->nombres = $nombres;
            $cliente->apellidos = $apellidos;
            $cliente->cedula_ruc = $cedula_ruc;
            $cliente->direccion = $direccion;
            $cliente->idPeriodo = $this->idPeriodoUser();
            $cliente->correo = $email;
            $cliente->telefono = $telefono;
            $cliente->save();
            $student->idCliente = $cliente->id;
            $student->save();
        }else{
            $cliente->nombres = $nombres;
            $cliente->apellidos = $apellidos;
            $cliente->cedula_ruc = $cedula_ruc;
            $cliente->direccion = $direccion;
            $cliente->correo = $email;
            $cliente->telefono = $telefono;
            $cliente->save();
        }
        #region factura
        $factura = Factura::find($request->idFactura); // si se creo un abono, la factura estara creada pero el pago aun no esta cancelado
        if($factura == null) {
            $todasLasFacturas = Factura::all()->count();
            $factura = new Factura;
            $factura->idCliente = $cliente->id;
            if ($todasLasFacturas == 0) {
                $numeroDeFactura = "1";
            } else {
                $ultimoRegistro = Factura::orderBy('created_at', 'DESC')->first();
                $numeroDeFactura = (int)Factura::orderBy('created_at', 'DESC')->first()->numeroFactura;
                $numeroDeFactura++;
                $numeroDeFactura = $numeroDeFactura."";
            }
            $factura->numeroFactura = $numeroDeFactura;
            $factura->subtotal = $request->subtotal;
            $factura->idPeriodo = $this->idPeriodoUser();
            $factura->tipo_pago = $request->tipo_pago;
            $factura->total = $request->total;
            $user = Sentinel::getUser();
            $user_profile = Administrative::findBySentinelid($user->id);
            $factura->idUsuario = $user_profile->id;
            $factura->idTransaccion=$idTransaccion;//  relación de la tabla historico_transacciones_en_linea
            $factura->save();
            $c = 0;
            foreach($request->idPagoDetalle as $pd) {
                $detalle = new FacturaDetalle;
                $pago_detalle = PagoEstudianteDetalle::with('pago')->find($pd);
                $detalle->idCliente = $cliente->id;
                $detalle->idPagoDetalle = $pago_detalle->id;
                $detalle->idEstudiante = $request->idEstudiante;
                $detalle->subtotal = $request->subtotal;
                $detalle->idPeriodo = $this->idPeriodoUser();
                $detalle->total = $request->valor_pagar;
                $detalle->idFactura = $factura->id;
                $detalle->save();
                if($request->total == $request->valor_pagar){ // si voy a pagar el valor completo se marcara como pagado en pago_detalle,
                    $pago_detalle->estado = "PAGADO";
                    $pago_detalle->save();
                    $idAbono = null;
                    $rubro = Rubro::find($pago_detalle->pago->idRubro);
                    if($rubro->tipo_emision == "RECIBO"){ // si el tipo de emision es de recibo se creara un abono
                        $abono = new Abono;
                        $abono->cantidad = $request->valor_pagar;
                        $abono->idFactura = $factura->id;
                        $abono->idPeriodo = $this->idPeriodoUser();
                        $abono->idPagoDetalle = $pd;
                        $abono->save();
                        $idAbono = $abono->id;
                    }
                    $tipoPago = new TipoPago;
                    $tipoPago->tipo_pago = $request->tipo_pago;
                    $tipoPago->banco = $request->banco;
                    $tipoPago->idPeriodo = $this->idPeriodoUser();
                    $tipoPago->numero_descripcion = $request->numero_descripcion;
                    $tipoPago->nombre_tarjeta = $request->nombre_tarjeta;
                    $tipoPago->idFactura = $factura->id;
                    $tipoPago->idRecibo = $idAbono;
                    //Si se debe emitir factura lo genera
                    if($rubro->tipo_emision == "FACTURA") {
                        /*Jorge Fierro 9 de marzo*/
                        //Verificacion de un pago o multiples
                        if(count($request->idPago)==1){
                            // Genera xml de la factura. Descomentar en el caso de ser necesario.
                            //Se envia la primera posicion  \/
                            //return $cliente;
                            $this->generar($request->idPago,
                            $request->cedula_ruc,
                            $factura->numeroFactura,
                            $cliente,
                            $request->tipo_pago,
                            $cliente->correo,
                            $cliente->telefono,
                            $request->tipo_pagoBD,
                            $request->valorBD);
                        } else{
                            // Genera xml de la factura. Descomentar en el caso de ser necesario.
                            //Se envia el arreglo de los pagos\/
                            $this->generarMultiple($request->idPago,
                            $request->cedula_ruc,
                            $factura->numeroFactura,
                            $cliente,
                            $request->tipo_pago,
                            $cliente->correo,
                            $cliente->telefono,
                            $request->tipo_pagoBD,
                            $request->valorBD);

                        }
                    }
                    $tipoPago->save();
                } else { // si voy a pagar solo una porcion se creara un abono
                    $abono = new Abono;
                    $abono->cantidad = $request->valor_pagar;
                    $abono->idFactura = $factura->id;
                    $abono->idPeriodo = $this->idPeriodoUser();
                    $abono->idPagoDetalle = $pd;
                    $abono->save();
                    $tipoPago = new TipoPago;
                    $tipoPago->tipo_pago = $request->tipo_pago;
                    $tipoPago->banco = $request->banco;
                    $tipoPago->idPeriodo = $this->idPeriodoUser();
                    $tipoPago->numero_descripcion = $request->numero_descripcion;
                    $tipoPago->nombre_tarjeta = $request->nombre_tarjeta;
                    $tipoPago->idFactura = $factura->id;
                    $tipoPago->idRecibo = $abono->id;
                    $tipoPago->save();
                }
                $c++;
            }
        } else { // si la factura ya existe, es por que se le ha creado abonos
            $ab_total = Abono::where('idPagoDetalle', $request->idPagoDetalle[0])->get()->sum('cantidad'); // busco todos los abonos y sumo lo que se ha acumulado
            if( $request->valor_pagar >= ($request->total - $ab_total) ){ // si la suma de todos los abonos completa el total a pagar
                $pago_detalle =  PagoEstudianteDetalle::getDetailPaymentsByStudent($request->idEstudiante, $estudiante->idCurso)
                                                        ->where('idPago', $request->idPago[0])->first();
                $pago_detalle->estado = "PAGADO";
                $pago_detalle->save();
                $abono = new Abono;
                $abono->cantidad = $request->valor_pagar;
                $abono->idFactura = $request->idFactura;
                $abono->idPeriodo = $this->idPeriodoUser();
                $abono->idPagoDetalle = $pago_detalle->id;
                $abono->save();
                $tipoPago = new TipoPago;
                $tipoPago->tipo_pago = $request->tipo_pago;
                $tipoPago->banco = $request->banco;
                $tipoPago->numero_descripcion = $request->numero_descripcion;
                $tipoPago->idPeriodo = $this->idPeriodoUser();
                $tipoPago->nombre_tarjeta = $request->nombre_tarjeta;
                $tipoPago->idFactura = $factura->id;
                $tipoPago->idRecibo = $abono->id;
                $rubro = Rubro::find($pago_detalle->pago->idRubro);
                if($rubro->tipo_emision == "FACTURA") {
                    // Genera xml de la factura. Descomentar \/ en el caso de ser necesario.
                    $this->generar($request->idPago,
                    $request->cedula_ruc,
                    $factura->numeroFactura,
                    $cliente,
                    $request->tipo_pago,
                    $cliente->correo,
                    $cliente->telefono,
                    $request->tipo_pagoBD,
                    $request->valorBD);
                }
                $tipoPago->save();
            }else{ // si solo paga otra porcion se creara otro abono pero no se marcara como pagado
                $pago_detalle =  PagoEstudianteDetalle::getDetailPaymentsByStudent($request->idEstudiante,$estudiante->idCurso)
                                                        ->where('idPago', $request->idPago[0])->first();
                $abono = new Abono;
                $abono->cantidad = $request->valor_pagar;
                $abono->idFactura = $request->idFactura;
                $abono->idPeriodo = $this->idPeriodoUser();
                $abono->idPagoDetalle = $pago_detalle->id;
                $abono->save();
                $tipoPago = new TipoPago;
                $tipoPago->tipo_pago = $request->tipo_pago;
                $tipoPago->banco = $request->banco;
                $tipoPago->idPeriodo = $this->idPeriodoUser();
                $tipoPago->numero_descripcion = $request->numero_descripcion;
                $tipoPago->nombre_tarjeta = $request->nombre_tarjeta;
                $tipoPago->idFactura = $factura->id;
                $tipoPago->idRecibo = $abono->id;
                $tipoPago->save();
            }
        }
        $this->cambioDeMatricula($request->idEstudiante);
        $data = request()->all();
        $idStudent = $data['idEstudiante'];
        DB::commit();
        return redirect()->route('pagosCursoEstudiante', ['id' => $idStudent]);
    }
}