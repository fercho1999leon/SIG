<?php
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Course;
use App\Student2;
use App\User;
use App\Payment;
use App\Cliente;
use App\PagoRealizado;
use App\BecaDescuento;
use App\PaymentStudent;
use App\PagoEstudianteDetalle;
use App\ConfiguracionSistemaController;
use App\Factura;
use Carbon\Carbon;
use App\Abono;
use App\FacturaDetalle;
use App\Administrative;
use App\PeriodoLectivo;
use App\TipoPago;
use App\ConfiguracionSistema;
use App\Institution;
use App\Rubro;
use App\Student2Profile;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Spatie\ArrayToXml\ArrayToXml;

class XmlSeeder extends Seeder
{ //PASOS PARA CORRER EL SEEDER :
	//1 SE DEBE BUSCAR EN LA TABLA pago_estudiante_detalles EL ID DEL PAGO QUE SE QUIERE GENERAR EL XML
	//2 SE CAMBIA EN LA LINEA 44 - 102 -485 DEL PRESENTE SEEDER el numero del idPeriodo Actual
	//3 POR ULTIMO EN LA CONFIGURACION DEL SISTEMA DEBE ESTAR ACTIVO LA FACTURACION ELECTRONICA EN CASO DE QUERER ENVIAR EL XML AL FTP, SI NO ESTA ACTIVO IGUAL SE CREA EL XML EN EL LOCAL
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $pago_estudiante_detalles='4425';// CAMBIAR POR EL ACTUAL
        $pago_detalle = PagoEstudianteDetalle::findOrFail($pago_estudiante_detalles);        
        $student = Student2Profile::where('idStudent',$pago_detalle->idEstudiante)
		->where('idPeriodo', 2)->first();// CAMBIAR POR EL ACTUAL
        $idFactura = Abono::where('idPagoDetalle',$pago_estudiante_detalles)
        ->pluck('idFactura')->first();
        $factura = Factura::findOrFail($idFactura);
        $abonos = Abono::where('idPagoDetalle',$pago_estudiante_detalles)->get()->sum('cantidad');
        $fechaUltimoAbono = Abono::where('idPagoDetalle',$pago_estudiante_detalles)
        ->orderby('id','DESC')
        ->take(1)->get();
       // return($abonos.' '.$idFactura.' '.$factura);
        //$pagos = Payment::findOrFail($pago_detalle->idPago); 
        $pagos = Payment::where('id', $pago_detalle->idPago)->get();
        $pagos_id = Payment::where('id', $pago_detalle->idPago)->pluck('id');
        
         $descuentoTotal=0;
            foreach ($pagos as $pago) {
                $descuentoTotal += Payment::calcularDescuentoEstudiante($student->idStudent, $pago->id);
            }
        if( strtoupper($pago->rubro->tipo_rubro) == 'PENSION'){
        foreach($student->student->becasDescuentos as $beca){
        $bd = BecaDescuento::find($beca->idBeca);
        $tipo_pagoBD=$bd->tipo_pago;
        $valorBD=$bd->valor;
        }        
        }
            //return $factura->total.' '.$abonos;
        $cliente = Cliente::findOrFail($factura->idCliente);
        if(bcdiv($factura->total, '1', 2)<=bcdiv($abonos, '1', 2)){
           // echo 'dentro';
          //  return 'la factura pasa a estatus PAGADO'.$factura.'</br>-----cliente: '.$cliente.'</br> ---detalle_pago: '.$pago_detalle
           // .'</br> ----Estudiante: '.$student.'</br> ----becas: '.$becas;
            $this->generar_seed($pagos_id,
                                $cliente->id,
                                $factura->numeroFactura,
                                $cliente,
                                'EFECTIVO',
                                $cliente->correo,
                                $cliente->telefono,
                                $tipo_pagoBD,
                                $valorBD,
                                $fechaUltimoAbono[0]->created_at->format('d/m/Y'));
        echo 'SE GENERO CORRECTAMENTE EL XML';
        }else{
        echo 'NO OCURRIO NADA -- posiblemente los abonos no suman el valor total a pagar';
    }
    }   
    public function generar_seed($idPago,$cedula_ruc,$numero_factura,$cliente,$tipo_pago,$correo,$telefono,$tipoPagoBD,$valorBD,$fechaNueva){
        
        $institution = Institution::first();
        $rucCED='';
        //$now = Carbon::now()->format('d/m/Y');
        $replaceSymbolDate=str_replace('/', '', $fechaNueva); //Deja la fecha en este formato ddmmyyyy
        $nombres='';
        $apellidos='';
        $direccion='';
        $comp=0;
        $tipoPagoFactura='';
        $periodoLectivo = PeriodoLectivo::find(2);  // CAMBIAR POR EL ACTUAL
        $pago = Payment::findOrFail($idPago[0]);
        $mes='';
        $tipoRubro=$pago->rubro->tipo_rubro;
        $subtotal=$pago->valor_cancelar;
        $valorcancelar=0.0;
        $cedulaRUC='';
        
        /* 
            Obtencion de la cantidad de caracteres en un factura y valida si hay 9 digitos, si tiene menos agrega ceros por delante  
        */
        $numero_factura=$numero_factura;
        $lengthNumFactura=strlen ( $numero_factura );

        if($lengthNumFactura<9){

            $diff=9-$lengthNumFactura;
            for($i = 0;$i<$diff;$i++)
            {
                $numero_factura = '0'.$numero_factura;
            }

        }


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



        // HECTOR FUENTES
        /* 
            Punto de emision dinamico.
            Variable que servira en caso de que manejen solo una caja caso contrario enviar la variable con nombre $ptoemi y comentar la linea
        */
        $ptoemi='002';


        /* 
            Tipo de pago del comprador. 
            Variable tipoPagoFactura almacena codigo de tipo de pago.
                EFECTIVO 01
                CHEQUE 20
                TAREJETA DE CREDITO 19
                TARJETA DEBITO 16
        */
        if($tipo_pago=="EFECTIVO"){
            $tipoPagoFactura='01';
        }
        if($tipo_pago=="CHEQUE"){
            $tipoPagoFactura='20';
        }
        if($tipo_pago=="TARJETACREDITO"){
            $tipoPagoFactura='19';
        }
        if($tipo_pago=="TARJETADEBITO"){
            $tipoPagoFactura='16';
        }


        /*Identificación del mes de pago */
        switch ($pago->mes){
            case '1':
                $mes='Enero';
                break;
            case '2':
                $mes='Febrero';
                break;
            case '3':
                $mes='Marzo';
                break;
            case '4':
                $mes='Abril';
                break;
            case '5':
                $mes='Mayo';
                break;
            case '6':
                $mes='Junio';
                break;
            case '7':
                $mes='Julio';
                break;
            case '8':
                $mes='Agosto';
                break;
            case '9':
                $mes='Septiembre';
                break;
            case '10':
                $mes='Octubre';
                break;
            case '11':
                $mes='Noviembre';
                break;
            case '12':
                $mes='Diciembre';
                break;
        }
        
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
        $claveacceso=$claveacceso.$this->generaDigitoModulo11_seed($claveacceso);
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
            'infoTributaria' => 
            [
                'ambiente' => '1',//Cambiar aqui en el caso que sea pruebas (1) o produccion (2)
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
            'infoFactura' => 
            [
                'fechaEmision' => $fechaNueva,
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
                'totalConImpuestos' => 
                [
                    'totalImpuesto' => 
                    [
                        'codigo' => '2',
                        'codigoPorcentaje' => '0',
                        'baseImponible' => bcdiv($valorcancelar, '1', 2),
                        'valor' => '0'
                    ]
                ],
                'propina' => '0.0',
                'importeTotal' => bcdiv($valorcancelar, '1', 2),
                'moneda' => 'DOLAR',
                'pagos' => 
                [
                    'pago' => 
                    [
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
            'detalles' => 
            [
                'detalle' => 
                [
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
                        
                            '_attributes' => 
                            [
                                'nombre'=>'Categoria',
                                'valor' => 'GENERAL'
                            ]  
                        ]
                        
                    ],
                    'impuestos' => 
                    [
                        'impuesto' => 
                        [
                            'codigo' => '2',
                            'codigoPorcentaje' => '0',
                            'tarifa' => '0',
                            'baseImponible' => bcdiv($valorcancelar, '1', 2),
                            'valor' => '0',
                            
                        ]
                        
                    ]
                ],
            ]
            
        ];
        /*termina*/

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
            $res = array_slice($tmp, 0, 6, true) +
            array("direccionComprador" => $direccion) +
            array_slice($tmp, 6, count($tmp) - 1, true);
            $array["infoFactura"]=$res;
        }
        
        /*Campos adicionales: Correo, telefono*/
        $campoadicional=array();
        if($correo){
            
            if($correo!="sincorreo@gmail.com"){
                $adicionalcorreo = [
                    '_attributes' => 
                        ['nombre' => 'correo']
                        
                    ,
                    '_value'=>$correo
                    ]
                ;
                $campoadicional[]=$adicionalcorreo;

                
            }
            
        }
        if($telefono){
            $adicionaltelefono = 
                [
                    '_attributes' =>
                    ['nombre' => 'telefono']
                    ,
                    '_value'=>$telefono
                ]

            ;
            $campoadicional[]=$adicionaltelefono;

                
            
        }
        if(count($campoadicional)>0){
            $campAD=["campoAdicional"=>$campoadicional];
            $array["infoAdicional"]=$campAD;
        }
        /*Termina campos adicionales*/

        /*Conversion de array a xml*/
        $result = ArrayToXml::convert(
            $array, [
            'rootElementName' => 'factura',
            '_attributes' => [
                'id' => 'comprobante',
                'version' => '1.1.0'
            ],
        ], true, 'UTF-8',"1.0",['formatOutput' => true]);

        $xml = new \SimpleXMLElement($result);
        /*Termina*/
        $activacionFacturacionElectronica = ConfiguracionSistema::where('nombre', 'ACTIVACION_FACTURACION_ELECTRONICA')
            ->where('idPeriodo', 2)// CAMBIAR POR EL ACTUAL
            ->first();
            
        /*Almacenamiento en servidor y ftp*/
        Storage::disk('local')->put('/public/xml/'.$claveacceso.'.xml', $xml->asXML());
        
        //Para configurar alamacenamiento en servidor ftp configurar en el archivo config/filesystems.php
       if ($activacionFacturacionElectronica->valor === '1') {
        Storage::disk('custom-ftp')->put($claveacceso.'.xml', $xml->asXML());
        }
    }
    public function generaDigitoModulo11_seed($cadena) {
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
            if ($multiplicador > $baseMultiplicador)
            {
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

}
