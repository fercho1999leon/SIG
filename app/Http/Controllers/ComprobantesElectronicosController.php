<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use File;
use Illuminate\Support\Facades\Storage;
use App\Proveedor;
use App\PagoProveedor;
use App\Institution;
use App\Retencion;
use App\CodigoRetencion;
use App\CodigoIva;
use Sentinel;
use Carbon\Carbon;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Spatie\ArrayToXml\ArrayToXml;

class ComprobantesElectronicosController extends Controller
{
    
    /*Jorge Fierro 8 de enero de 2020 */
    public function generarRetencion(Request $request){
        $institution = Institution::first();
        $pago=PagoProveedor::findOrFail($request->pago);
        $proveedor=Proveedor::findOrFail($pago->id_proveedor);
        $rs=Retencion::all();
        $numero_retencion=count($rs)+1;
    
        //$cedula_ruc;
            if($proveedor->cedula!=null){
                $cedula_ruc=$proveedor->cedula;
            }
            if($proveedor->ruc!=null){
                $cedula_ruc=$proveedor->ruc;
            }
        $correo=$proveedor->email;
        $telefono=$proveedor->telefonos;
        $numDocSustento=$request->numero_documento;
        $fechaEmisionDocSustento=$request->fecha_documento;
        if($request->fecha_emision_retencion==null){
            $fechaEmision=Carbon::now()->format('d/m/Y');
            $periodoFiscal=Carbon::now()->format('m/Y');
        }else{
            $fechaEmision=Carbon::parse($request->fecha_emision_retencion)->format('d/m/Y');
            $periodoFiscal=Carbon::parse($request->fecha_emision_retencion)->format('m/Y');
        }
        $replaceSymbolDate=str_replace('/', '', $fechaEmision);

        // Campos vacios para tratarlos después
        $rucCED='';
        $razonSocial='';
        $direccion='';
        $cedulaRUC='';
        $comp=0;

        $piva=$proveedor->ret_iva;
        $pfuente=$proveedor->ret_ir;
        
        /* 
            Obtencion de la cantidad de caracteres en un factura y valida si hay 9 digitos, si tiene menos agrega ceros por delante  
        */
            $rs=Retencion::all();
            $numero_retencion=count($rs)+1;
            $lengthNumRet=strlen ( $numero_retencion );
            if($lengthNumRet<9){
                $diff=9-$lengthNumRet;
                for($i = 0;$i<$diff;$i++){
                    $numero_retencion = '0'.$numero_retencion;
                }
            }


        /* 
            Validacion de cedula, ruc o consumidor final.
            Variable rucCED almacena codigo del tipo de documento del comprador.
            RUC 04
            CEDULA 05
            COSUMIDOR FINAL 07
        */
        if(!is_null($cedula_ruc)){
            $comp=strlen ( $cedula_ruc );
        }
        else{
            // Consumidor final
                $rucCED='07';
                $razonSocial='CONSUMIDOR FINAL';
                $direccion='';
                $cedulaRUC='9999999999999‬';
        }

        if($comp==13){
            // Ruc
                $rucCED='04';
                $razonSocial=$proveedor->nombre_comercial;
                $direccion=$proveedor->direccion;
                $cedulaRUC=$proveedor->ruc;
        }

        if($comp==10){
            // Cedula
                $rucCED='05';
                $razonSocial=$proveedor->nombres.' '.$proveedor->apellidos;
                $direccion=$proveedor->direccion;
                $cedulaRUC=$proveedor->ruc;
        }


        /* 
            HECTOR FUENTES
            Punto de emision dinamico, variable que servirá en caso de que manejen solo una caja caso contrario enviar la variable con nombre $ptoemi y comentar la linea
        */
        $ptoemi='002';

        
        /*
            Construcción de clave de acceso.
            Fecha + tipodecomprobante + ruc/cedula001(debe ir los 13 digitos) + Tipo de ambient (1 o 2) + Serie + NumeroSecuencial(Factura) + Código número explicado arriba + Tipo de emision (1) + Dígito Módulo 11 explicado mas abajo.
        */

            /*
                Código numérico.
                Se toma los primeros 8 digitos de la institucion para la respectiva identificacion. 
            */
            $codNum=substr($institution->ruc, 0, 8);
            if($rucCED=='05'){
                //Clave de acceso en el caso de cedula   ->  cedula+001
                $claveacceso=''.$replaceSymbolDate.'01'.$institution->ruc.'2'.$institution->establecimiento.$ptoemi.$numero_retencion.''.$codNum.'1';
            }
            else{
                $claveacceso=''.$replaceSymbolDate.'01'.$institution->ruc.'2'.$institution->establecimiento.$ptoemi.$numero_retencion.''.$codNum.'1';
            }

            /*  
                Digito  modulo 11.
                Proceso definido por el SRI
            */
                $claveacceso=$claveacceso.$this->generaDigitoModulo11($claveacceso);        
        //Termina construccion clave de acceso


        /* 
            Informacion tag InfoTributaria 
        */
            $ambiente = 2;
            $tipoEmision = 1;
            $codDoc = '07';
            $numero_retencion=count($rs)+1;

        /*
            Informacion tag infoCompRetension
        */


        /*
            Informacion tag  impuestos
        */
            // Impuesto Renta
                if($request->retencion_fuente!=null){
                    $codigoImpuesto = 1;
                    $fuente=CodigoRetencion::findOrFail($request->retencion_fuente);
                    $valor_r_f=($fuente->porcentajes/100)*$pago->total;
                    $codigo_fuente=$fuente->id;
                        
                    $codigoRetencion = $fuente->codigo_anexo;
                    $baseImponible = $pago->total;
                    $porcentajeRetener = $fuente->porcentajes;
                    $valorRetenido = $valor_r_f;        
                }else{
                    $codigo_fuente = 0;
                }

            // Impuesto IVA
                if($request->retencion_iva!=null){
                    $codigoImpuesto = 2;
                    $iva=CodigoIva::findOrFail($request->retencion_iva);
                    $valor_r_i=($iva->porcentaje/100)*$pago->total;
                    $codigo_iva=$iva->id;
                
                    $codigoRetencion= $iva->codigo;
                    $baseImponible = $pago->total;
                    $porcentajeRetener = $iva->porcentaje;
                    $valorRetenido = $valor_r_i;
                }else{
                    $codigo_iva = 0;
                }


        // Creación de Retención Retención
            $retencion= new Retencion();
                $retencion->id_pagos_realizados=$request->pago;               
                $retencion->id_proveedores=$proveedor->id;     
                $retencion->fecha_emision=$request->fecha_emision_retencion;        
                $retencion->neto=$pago->total;   
                $retencion->retencion_fuente=$codigo_fuente;                         
                $retencion->retencion_iva=$codigo_iva;                           
                
                $retencion->total=$pago->total; 

                $retencion->retenido=$valorRetenido;                 
                $retencion->saldo=$pago->total-$valorRetenido;   

                $retencion->numero_documento=$request->numero_documento;             
                $retencion->autorizacion='';
                $retencion->save();

    
        /*Arreglo donde se ubican los campos para posterior coversion a xml */
        $array = [
            'infoTributaria' => 
            [
                'ambiente' => '2',//Cambiar aqui en el caso que sea pruebas (1) o produccion (2)
                'tipoEmision' => '1',
                'razonSocial' => $institution->razon_social,//Cambiar aqui la razon social de la institucion
                'nombreComercial' => $institution->nombre_comercial,//Cambiar aqui el nombre comercial de la institucion
                'ruc' => $institution->ruc,//Cambiar aqui el RUC de la institucion JP
                'claveAcceso' => $claveacceso,
                'codDoc' => '07',
                'estab' => $institution->establecimiento,//Cambiar aqui en el caso de tener otra sucursal de la institucion
                'ptoEmi' => $ptoemi,//Cambiar aqui en el caso de tener varias cajas
                'secuencial' => $numero_retencion,//Ingreso manual
                'dirMatriz' => $institution->direccion_matriz,//Cambiar aqui direccion de sucursal o matriz de institcion
            ],
            'infoCompRetencion' => 
            [
                'fechaEmision' => $fechaEmision,
                'dirEstablecimiento' => $institution->direccion_matriz,//Cambiar aqui direccion de sucursal o matriz de institcion
                'obligadoContabilidad' => 'SI',
                'tipoIdentificacionSujetoRetenido' => $rucCED,//cedula o ruc
                'razonSocialSujetoRetenido' => $razonSocial,
                'identificacionSujetoRetenido' => $cedulaRUC,
                'periodoFiscal' => $periodoFiscal
            ],
            'impuestos' => 
            [
                'impuesto' =>//Renta
                [
                    'codigo' => $codigoImpuesto,
                    'codigoRetencion'=>$codigoRetencion,
                    'baseImponible' => $baseImponible,
                    'porcentajeRetener' => $porcentajeRetener,
                    'valorRetenido' => $valorRetenido,
                    'codDocSustento'=>'01',//Fijo
                    'numDocSustento'=>$numDocSustento,//Referencia a la factura
                    'fechaEmisionDocSustento'=>$fechaEmisionDocSustento//Referencia a la factura
                ]
            ]        
        ];

    
        /*
            Campos adicionales: Correo, telefono
        */
            $campoadicional=array();
            if($correo){
                if($correo!="sincorreo@gmail.com"){
                    $adicionalcorreo = [
                        '_attributes' => 
                            ['nombre' => 'correo'],
                        '_value'=>$correo
                        ];
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
                    ];
                $campoadicional[]=$adicionaltelefono;
            }

            if(count($campoadicional)>0){
                $campAD=["campoAdicional"=>$campoadicional];
                $array["infoAdicional"]=$campAD;
            }


        /*Conversion de array a xml*/
        $result = ArrayToXml::convert(
            $array, [
            'rootElementName' => 'comprobanteRetencion',
            '_attributes' => [
                'id' => 'comprobante',
                'version' => '1.0.0'
            ],
        ], true, 'UTF-8',"1.0",['formatOutput' => true]);

        $xml = new \SimpleXMLElement($result);
        /*Termina*/
        
        /*Almacenamiento en servidor y ftp*/
        Storage::disk('local')->put('/public/xml/'.$claveacceso.'.xml', $xml->asXML());
        //Para configurar alamacenamiento en servidor ftp configurar en el archivo config/filesystems.php
        // Storage::disk('custom-ftp')->put($claveacceso.'.xml', $xml->asXML());
        $retenciones = Retencion::all();
        return view('UsersViews.administrador.proveedores.retenciones.index', compact('retenciones'));
    }


    /*Jorge Fierro 18 de marzo de 2020 */
    public function generarLiqudacion($idPago,$cedula_ruc,$numero_liquidacion,$proveedor,$tipo_pago,$correo,$telefono,$tipoPagoBD,$valorBD){
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
        
        /* 
            Obtencion de la cantidad de caracteres en un factura y valida si hay 9 digitos, si tiene menos agrega ceros por delante  
        */
        $numero_liquidacion=$numero_liquidacion;
        $lengthNumFactura=strlen ( $numero_liquidacion );

        if($lengthNumFactura<9){

            $diff=9-$lengthNumFactura;
            for($i = 0;$i<$diff;$i++)
            {
                $numero_liquidacion = '0'.$numero_liquidacion;
            }

        }


        /* 
            Validacion de cedula, ruc o consumidor final.
        */
        $comp=strlen($cedula_ruc);
        //Consumidor final
            if($comp==0){
                $rucCED='07';
                $proveedor->razonSocial='PROVEEDOR';
                $proveedor->cedula_ruc='9999999999999‬';
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
                $proveedor->cedula_ruc='0'.$proveedor->cedula_ruc;
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
            $claveacceso=''.$replaceSymbolDate.'01'.$institution->ruc.'2'.$institution->establecimiento.$ptoemi.$numero_liquidacion.''.$codNum.'1';
        }
        else{
            $claveacceso=''.$replaceSymbolDate.'01'.$institution->ruc.'2'.$institution->establecimiento.$ptoemi.$numero_liquidacion.''.$codNum.'1';
        }

        /*Digito  modulo 11.
        Proceso definido por el SRI*/
        $claveacceso=$claveacceso.$this->generaDigitoModulo11($claveacceso);
        /*Termina construccion clave de acceso*/

        $descuento=0.0;
        if($tipoPagoBD==="PORCENTAJE"){
            $descuento=($subtotal*$valorBD)/100;
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
                'ambiente' => '2',//Cambiar aqui en el caso que sea pruebas (1) o produccion (2)
                'tipoEmision' => '1',
                'razonSocial' => $institution->razon_social,//Cambiar aqui la razon social de la institucion
                'nombreComercial' => $institution->nombre_comercial,//Cambiar aqui el nombre comercial de la institucion
                'ruc' => $institution->ruc,//Cambiar aqui el RUC de la institucion JP
                'claveAcceso' => $claveacceso,
                'codDoc' => '01',
                'estab' => $institution->establecimiento,//Cambiar aqui en el caso de tener otra sucursal de la institucion
                'ptoEmi' => $ptoemi,//Cambiar aqui en el caso de tener varias cajas
                'secuencial' => $numero_liquidacion,//Ingreso manual
                'dirMatriz' => $institution->direccion_matriz,//Cambiar aqui direccion de sucursal o matriz de institcion
            ],
            'infoFactura' => 
            [
                'fechaEmision' => $now,
                'dirEstablecimiento' => $institution->direccion_matriz,//Cambiar aqui direccion de sucursal o matriz de institcion
                'obligadoContabilidad' => 'SI',
                'tipoIdentificacionProveedor' => $rucCED,//'1-2-3-4-5-6-7'
                'razonSocialProveedor' => $proveedor->razonSocial,//Razon Social
                'identificacionProveedor' => $proveedor->cedula_ruc,//'Cedula o RUC'
                'totalSinImpuestos' => $valorcancelar,
                'totalSubsidio' =>'0',
                'totalDescuento' => $descuento,
                'totalComprobantesReempolso' =>'0',
                'totalBaseImponibleReembolso' =>'0',
                'totalImpuestoReembolso' =>'0',
                'totalConImpuestos' => 
                [
                    'totalImpuesto' => 
                    [
                        'codigo' => '2',
                        'codigoPorcentaje' => '0',
                        'baseImponible' => $valorcancelar,
                        'valor' => '0'
                    ]
                ],
                'propina' => '0.0',
                'importeTotal' => $valorcancelar,
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
                        'total' => $valorcancelar,
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
                    'descuento' => $descuento,
                    'precioTotalSinImpuesto' => $valorcancelar,
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
                            'baseImponible' => $valorcancelar,
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
            'rootElementName' => 'liquidacionCompra',
            '_attributes' => [
                'id' => 'comprobante',
                'version' => '1.1.0'
            ],
        ], true, 'UTF-8',"1.0",['formatOutput' => true]);

        $xml = new \SimpleXMLElement($result);
        /*Termina*/
        $activacionFacturacionElectronica = ConfiguracionSistema::facturacionElectronica();
        
        /*Almacenamiento en servidor y ftp*/
        Storage::disk('local')->put('/public/xml/'.$claveacceso.'.xml', $xml->asXML());
        //Para configurar alamacenamiento en servidor ftp configurar en el archivo config/filesystems.php
        // Storage::disk('custom-ftp')->put($claveacceso.'.xml', $xml->asXML());
    }

    /*Jorge Fierro 18 de marzo de 2020 */
    public function generarLiqudacionMultiple($idPago,$cedula_ruc,$numero_liquidacion,$proveedor,$tipo_pago,$correo,$telefono,$tipoPagoBD,$valorBD){
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
        $numero_liquidacion=$numero_liquidacion;
        $lengthNumFactura=strlen ( $numero_liquidacion );

        if($lengthNumFactura<9){

            $diff=9-$lengthNumFactura;
            for($i = 0;$i<$diff;$i++)
            {
                $numero_liquidacion = '0'.$numero_liquidacion;
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
                $proveedor->razonSocial='PROVEEDOR';
                $proveedor->cedula_ruc='9999999999999‬';
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
                $proveedor->cedula_ruc='0'.$proveedor->cedula_ruc;
            }



        // HECTOR FUENTES
        /*Punto de emision dinamico.
        Variable que servira en caso de que manejen solo una caja 
        caso contrario enviar la variable con nombre $ptoemi y comentar la linea*/
        
        $ptoemi='002';

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
        if($tipo_pago=="CHEQUE"){
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
            $claveacceso=''.$replaceSymbolDate.'01'.$institution->ruc.'2'.$institution->establecimiento.$ptoemi.$numero_liquidacion.''.$codNum.'1';
        }
        else{
            $claveacceso=''.$replaceSymbolDate.'01'.$institution->ruc.'2'.$institution->establecimiento.$ptoemi.$numero_liquidacion.''.$codNum.'1';
        }

        /*Digito  modulo 11.
        Proceso definido por el SRI*/
        $claveacceso=$claveacceso.$this->generaDigitoModulo11($claveacceso);
        /*Termina construccion clave de acceso*/

        

        /*Arreglo donde se ubican los campos para posterior coversion a xml */
        $array = [
            'infoTributaria' => 
            [
                'ambiente' => '2',//Cambiar aqui en el caso que sea pruebas (1) o produccion (2)
                'tipoEmision' => '1',
                'razonSocial' => $institution->razon_social,//Cambiar aqui la razon social de la institucion
                'nombreComercial' => $institution->nombre_comercial,//Cambiar aqui el nombre comercial de la institucion
                'ruc' => $institution->ruc,//Cambiar aqui el RUC de la institucion JP
                'claveAcceso' => $claveacceso,
                'codDoc' => '01',
                'estab' => $institution->establecimiento,//Cambiar aqui en el caso de tener otra sucursal de la institucion
                'ptoEmi' => $ptoemi,//Cambiar aqui en el caso de tener varias cajas
                'secuencial' => $numero_liquidacion,//Ingreso manual
                'dirMatriz' => $institution->direccion_matriz,//Cambiar aqui direccion de sucursal o matriz de institcion
            ],
            'infoFactura' => 
            [
                'fechaEmision' => $now,
                'dirEstablecimiento' => $institution->direccion_matriz,//Cambiar aqui direccion de sucursal o matriz de institcion
                'obligadoContabilidad' => 'SI',
                'tipoIdentificacionProveedor' => $rucCED,//cedula o ruc
                'razonSocialProveedor' => $proveedor->razonSocial,//Razon Social
                'identificacionProveedor' => $proveedor->cedula_ruc,
                'totalSinImpuestos' => $valorcancelar,
                'totalSubsidio' =>'0',
                'totalDescuento' => $descuento,
                'totalComprobantesReempolso' =>'0',
                'totalBaseImponibleReembolso' =>'0',
                'totalImpuestoReembolso' =>'0',
                'totalConImpuestos' => 
                [
                    'totalImpuesto' => 
                    [
                        'codigo' => '2',
                        'codigoPorcentaje' => '0',
                        'baseImponible' => $valorcancelar,
                        'valor' => '0'
                    ]
                ],
                'propina' => '0.0',
                'importeTotal' => $valorcancelar,
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
                        'total' => $valorcancelar,
                        'plazo' =>'0',
                        'unidadTiempo' =>'dias'
                    ]
                ]
            ]
            ,
            'detalles' => 
            [
                'detalle'=>[]
            ] 
            
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

            $arr=['detalle' => 
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
                'precioUnitario' => $p->valor_cancelar,
                'descuento' => $desc,
                'precioTotalSinImpuesto' => $sbttl,
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
                        'baseImponible' => $sbttl,
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

        $array['infoFactura']['totalSinImpuestos']=$valorcancelar;
        $array['infoFactura']['totalDescuento']=$sumDesc;

        $array['infoFactura']['totalConImpuestos']['totalImpuesto']['baseImponible']=$valorcancelar;
        $array['infoFactura']['importeTotal']=$valorcancelar;

        $array['infoFactura']['pagos']['pago']['total']=$valorcancelar;

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
            'rootElementName' => 'liquidacionCompra',
            '_attributes' => [
                'id' => 'comprobante',
                'version' => '1.1.0'
            ],
        ], true, 'UTF-8',"1.0",['formatOutput' => true]);

        $xml = new \SimpleXMLElement($result);
        /*Termina*/
        $activacionFacturacionElectronica = ConfiguracionSistema::facturacionElectronica();
        
        /*Almacenamiento en servidor y ftp*/
        Storage::disk('local')->put('/public/xml/'.$claveacceso.'.xml', $xml->asXML());
        //Para configurar alamacenamiento en servidor ftp configurar en el archivo config/filesystems.php
        // Storage::disk('custom-ftp')->put($claveacceso.'.xml', $xml->asXML());
    }

    /*Jorge Fierro 20 de marzo de 2020 */
    public function generarNotaDebito($cedula_ruc,$numero_nota_debito,$cliente,$tipo_pago,$correo,$telefono,$tipoPagoBD,$valorBD,$factura_modificada,$razon_nota_debito,$valorNotaDebito){
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
        $mes='';
        $subtotal=$valorNotaDebito;
        $iva=$subtotal*0.12;
        $valorcancelar=$subtotal+$iva;
        $cedulaRUC='';
        
        /* 
            Obtencion de la cantidad de caracteres en un nota de debito y valida si hay 9 digitos, si tiene menos agrega ceros por delante  
        */
        $numero_nota_debito=$numero_nota_debito;
        $lengthNumFactura=strlen ( $numero_nota_debito );

        if($lengthNumFactura<9){

            $diff=9-$lengthNumFactura;
            for($i = 0;$i<$diff;$i++)
            {
                $numero_nota_debito = '0'.$numero_nota_debito;
            }

        }

        /*Obtencion datos de factura */
        $numDocMod=$factura_modificada->numDoc;
        $fechaDocMod=Carbon::createFromFormat('d/m/Y', $factura_modificada->fecha);

        /* 
            Validacion de cedula, ruc o consumidor final.
        */
        $comp=strlen($cedula_ruc);
        //Consumidor final
            if($comp==0){
                $rucCED='07';
                $cliente->razonSocial='CONSUMIDOR FINAL';
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
            'infoTributaria' => 
            [
                'ambiente' => '2',//Cambiar aqui en el caso que sea pruebas (1) o produccion (2)
                'tipoEmision' => '1',
                'razonSocial' => $institution->razon_social,//Cambiar aqui la razon social de la institucion
                'nombreComercial' => $institution->nombre_comercial,//Cambiar aqui el nombre comercial de la institucion
                'ruc' => $institution->ruc,//Cambiar aqui el RUC de la institucion JP
                'claveAcceso' => $claveacceso,
                'codDoc' => '05',
                'estab' => $institution->establecimiento,//Cambiar aqui en el caso de tener otra sucursal de la institucion
                'ptoEmi' => $ptoemi,//Cambiar aqui en el caso de tener varias cajas
                'secuencial' => $numero_nota_debito,//Ingreso manual
                'dirMatriz' => $institution->direccion_matriz,//Cambiar aqui direccion de sucursal o matriz de institcion
            ],
            'infoNotaDebito' => 
            [
                'fechaEmision' => $now,
                'dirEstablecimiento' => $institution->direccion_matriz,//Cambiar aqui direccion de sucursal o matriz de institcion
                'obligadoContabilidad' => 'SI',
                'tipoIdentificacionComprador' => $rucCED,//'1-2-3-4-5-6-7'
                'razonSocialComprador' => $cliente->razonSocial,//Razon Social
                'identificacionComprador' => $cliente->cedula_ruc,//'Cedula o RUC'
                'codDocModificado'=>'01',
                'numDocModificado'=>$numDocMod,
                'fechaEmisionDocSustento'=>$fechaDocMod,
                'totalSinImpuestos' => $valorcancelar,
                'impuestos' => 
                [
                    'impuesto' => 
                    [
                        'codigo' => '2',
                        'codigoPorcentaje' => '02',
                        'baseImponible' => $valorcancelar,
                        'valor' => $iva
                    ]
                ],
                'valorTotal' => $valorcancelar,
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
                        'total' => $valorcancelar,
                        'plazo' =>'0',
                        'unidadTiempo' =>'dias'
                    ]
                ]
            ],
            'motivos' => 
            [
                'motivo' => 
                [
                    'razon'=>$razon_nota_debito,
                    'valor'=>$valorNotaDebito
                ]
            ]
        ];
        /*termina*/

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
            'rootElementName' => 'notaDebito',
            '_attributes' => [
                'id' => 'comprobante',
                'version' => '1.1.0'
            ],
        ], true, 'UTF-8',"1.0",['formatOutput' => true]);

        $xml = new \SimpleXMLElement($result);
        /*Termina*/
        $activacionFacturacionElectronica = ConfiguracionSistema::facturacionElectronica();
        
        /*Almacenamiento en servidor y ftp*/
        Storage::disk('local')->put('/public/xml/'.$claveacceso.'.xml', $xml->asXML());
        //Para configurar alamacenamiento en servidor ftp configurar en el archivo config/filesystems.php
        // if ($activacionFacturacionElectronica->valor === '1') {
		// 	Storage::disk('custom-ftp')->put($claveacceso.'.xml', $xml->asXML());
        // }
    }

    /*Jorge Fierro 21 de marzo de 2020 */
    public function generarNotaCredito($idPago,$cedula_ruc,$numero_factura,$cliente,$tipo_pago,$correo,$telefono,$tipoPagoBD,$valorBD){
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

        $descuento=0.0;
        if($tipoPagoBD==="PORCENTAJE"){
            $descuento=($subtotal*$valorBD)/100;
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
                'ambiente' => '2',//Cambiar aqui en el caso que sea pruebas (1) o produccion (2)
                'tipoEmision' => '1',
                'razonSocial' => $institution->razon_social,//Cambiar aqui la razon social de la institucion
                'nombreComercial' => $institution->nombre_comercial,//Cambiar aqui el nombre comercial de la institucion
                'ruc' => $institution->ruc,//Cambiar aqui el RUC de la institucion JP
                'claveAcceso' => $claveacceso,
                'codDoc' => '04',
                'estab' => $institution->establecimiento,//Cambiar aqui en el caso de tener otra sucursal de la institucion
                'ptoEmi' => $ptoemi,//Cambiar aqui en el caso de tener varias cajas
                'secuencial' => $numero_factura,//Ingreso manual
                'dirMatriz' => $institution->direccion_matriz,//Cambiar aqui direccion de sucursal o matriz de institcion
            ],
            'infoNotaCredito' => 
            [
                'fechaEmision' => $now,
                'dirEstablecimiento' => $institution->direccion_matriz,//Cambiar aqui direccion de sucursal o matriz de institcion
                'obligadoContabilidad' => 'SI',
                'tipoIdentificacionComprador' => $rucCED,//'1-2-3-4-5-6-7'
                'razonSocialComprador' => $cliente->nombres.' '.$cliente->apellidos,//Razon Social
                'identificacionComprador' => $cliente->cedula_ruc,//'Cedula o RUC'
                'codDocModificado'=>'01',
                'numDocModificado'=>$numDocMod,
                'fechaEmisionDocSustento'=>$fechaDocMod,
                'totalSinImpuestos' => $valorcancelar,
                'valorModificacion'=>'',
                'totalSubsidio' =>'0',
                'totalDescuento' => $descuento,
                'totalComprobantesReempolso' =>'0',
                'totalBaseImponibleReembolso' =>'0',
                'totalImpuestoReembolso' =>'0',
                'totalConImpuestos' => 
                [
                    'totalImpuesto' => 
                    [
                        'codigo' => '2',
                        'codigoPorcentaje' => '0',
                        'baseImponible' => $valorcancelar,
                        'valor' => '0'
                    ]
                ],
                'importeTotal' => $valorcancelar,
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
                        'total' => $valorcancelar,
                        'plazo' =>'0',
                        'unidadTiempo' =>'dias'
                    ]
                ],
                'motivo'=>''
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
                    'codigoPrincipal' =>'',
                    'codigoAuxiliar' =>'',
                    'descripcion' => '' ,
                    'cantidad' => '1.0',
                    'precioUnitario' => $subtotal,
                    'descuento' => $descuento,
                    'precioTotalSinImpuesto' => $valorcancelar,
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
                            'baseImponible' => $valorcancelar,
                            'valor' => '0',
                            
                        ]
                        
                    ]
                ],
            ]
            
        ];
        /*termina*/

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
            'rootElementName' => 'notaCredito',
            '_attributes' => [
                'id' => 'comprobante',
                'version' => '1.1.0'
            ],
        ], true, 'UTF-8',"1.0",['formatOutput' => true]);

        $xml = new \SimpleXMLElement($result);
        /*Termina*/
        $activacionFacturacionElectronica = ConfiguracionSistema::facturacionElectronica();
        
        /*Almacenamiento en servidor y ftp*/
        Storage::disk('local')->put('/public/xml/'.$claveacceso.'.xml', $xml->asXML());
        //Para configurar alamacenamiento en servidor ftp configurar en el archivo config/filesystems.php
        // if ($activacionFacturacionElectronica->valor === '1') {
		// 	Storage::disk('custom-ftp')->put($claveacceso.'.xml', $xml->asXML());
        // }
    }

    public function generarNotaCreditoMultipleMultiple($idPago,$cedula_ruc,$numero_factura,$cliente,$tipo_pago,$correo,$telefono,$tipoPagoBD,$valorBD){
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



        // HECTOR FUENTES
        /*Punto de emision dinamico.
        Variable que servira en caso de que manejen solo una caja 
        caso contrario enviar la variable con nombre $ptoemi y comentar la linea*/
        
        $ptoemi='002';

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
        if($tipo_pago=="CHEQUE"){
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
            'infoTributaria' => 
            [
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
            'infoNotaCredito' => 
            [
                'fechaEmision' => $now,
                'dirEstablecimiento' => $institution->direccion_matriz,//Cambiar aqui direccion de sucursal o matriz de institcion
                'obligadoContabilidad' => 'SI',
                'tipoIdentificacionComprador' => $rucCED,//cedula o ruc
                'razonSocialComprador' => $cliente->nombres.' '.$cliente->apellidos,//Razon Social
                'identificacionComprador' => $cliente->cedula_ruc,
                'codDocModificado'=>'01',
                'numDocModificado'=>$numDocMod,
                'fechaEmisionDocSustento'=>$fechaDocMod,
                'totalSinImpuestos' => $valorcancelar,
                'totalSubsidio' =>'0',
                'totalDescuento' => $descuento,
                'totalComprobantesReempolso' =>'0',
                'totalBaseImponibleReembolso' =>'0',
                'totalImpuestoReembolso' =>'0',
                'totalConImpuestos' => 
                [
                    'totalImpuesto' => 
                    [
                        'codigo' => '2',
                        'codigoPorcentaje' => '0',
                        'baseImponible' => $valorcancelar,
                        'valor' => '0'
                    ]
                ],
                'importeTotal' => $valorcancelar,
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
                        'total' => $valorcancelar,
                        'plazo' =>'0',
                        'unidadTiempo' =>'dias'
                    ]
                ]
            ]
            ,
            'detalles' => 
            [
                'detalle'=>[]
            ] 
            
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
            

            $arr=['detalle' => 
            [
                // Pensiones / pined-001
                // Matricula / pined-002
                // Separacion de matricula / pined-003
                // Robotica educativa / pined-004
                // Ambiente digital / pined-005
                'codigoPrincipal' =>'',
                'codigoAuxiliar' =>'',
                'descripcion' => ''  ,
                'cantidad' => '1.0',
                'precioUnitario' => $p->valor_cancelar,
                'descuento' => $desc,
                'precioTotalSinImpuesto' => $sbttl,
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
                        'baseImponible' => $sbttl,
                        'valor' => '0',
                        
                    ]
                    
                ]
            ]];
        }
        /*Termina*/

        $valorcancelar=$subtotal-$sumDesc;

        $array['infoFactura']['totalSinImpuestos']=$valorcancelar;
        $array['infoFactura']['totalDescuento']=$sumDesc;

        $array['infoFactura']['totalConImpuestos']['totalImpuesto']['baseImponible']=$valorcancelar;
        $array['infoFactura']['importeTotal']=$valorcancelar;

        $array['infoFactura']['pagos']['pago']['total']=$valorcancelar;

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
            'rootElementName' => 'notaCredito',
            '_attributes' => [
                'id' => 'comprobante',
                'version' => '1.1.0'
            ],
        ], true, 'UTF-8',"1.0",['formatOutput' => true]);

        $xml = new \SimpleXMLElement($result);
        /*Termina*/
        $activacionFacturacionElectronica = ConfiguracionSistema::facturacionElectronica();
        
        /*Almacenamiento en servidor y ftp*/
        Storage::disk('local')->put('/public/xml/'.$claveacceso.'.xml', $xml->asXML());
        //Para configurar alamacenamiento en servidor ftp configurar en el archivo config/filesystems.php
        // if ($activacionFacturacionElectronica->valor === '1') {
        //     Storage::disk('custom-ftp')->put($claveacceso.'.xml', $xml->asXML());
        // }
    }

    /*Jorge Fierro 22 de marzo de 2020 
    public function generarGuiaRemision($idPago,$cedula_ruc,$numero_factura,$cliente,$tipo_pago,$correo,$telefono,$tipoPagoBD,$valorBD){
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
        

        // Obtencion de la cantidad de caracteres en un factura y valida si hay
        9 digitos, si tiene menos agrega ceros por delante  
        $numero_factura=$numero_factura;
        $lengthNumFactura=strlen ( $numero_factura );

        if($lengthNumFactura<9){

            $diff=9-$lengthNumFactura;
            for($i = 0;$i<$diff;$i++)
            {
                $numero_factura = '0'.$numero_factura;
            }

        }
        

        
        // Validacion de cedula, ruc o consumidor final.
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
        //Punto de emision dinamico.
        //Variable que servira en caso de que manejen solo una caja 
        //caso contrario enviar la variable con nombre $ptoemi y comentar la linea
        
        $ptoemi='002';

        //Fin

        // Tipo de pago del comprador. 
        //Variable tipoPagoFactura almacena codigo de tipo de pago.
        //EFECTIVO 01
        //CHEQUE 20
        //TAREJETA DE CREDITO 19
        //TARJETA DEBITO 16
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
    

        $descuento=0.0;
        
        //Construcción de clave de acceso.
        //Fecha+tipodecomprobante+ruc/cedula001(debe ir los 13 digitos)+Tipo de ambient (1 o 2)+
        //Serie+numeroscuencial(Factura)+Codigo numero explicado arriba+Tipo de emision (1)+Digito Modulo 11 //explicado mas abajo.
        

        //Codigo numerico.
        //Se toma los primeros 8 digitos de la institucion para la respectiva identificacion 
        $codNum=substr($institution->ruc, 0, 8);
        if($rucCED=='05'){
            //Clave de acceso en el caso de cedula   ->  cedula+001
            $claveacceso=''.$replaceSymbolDate.'01'.$institution->ruc.'2'.$institution->establecimiento.$ptoemi.$numero_factura.''.$codNum.'1';
        }
        else{
            $claveacceso=''.$replaceSymbolDate.'01'.$institution->ruc.'2'.$institution->establecimiento.$ptoemi.$numero_factura.''.$codNum.'1';
        }

        //Digito  modulo 11.
        //Proceso definido por el SRI
        $claveacceso=$claveacceso.$this->generaDigitoModulo11($claveacceso);
        //Termina construccion clave de acceso

        

        //Arreglo donde se ubican los campos para posterior coversion a xml 
        $array = [
            'infoTributaria' => 
            [
                'ambiente' => '2',//Cambiar aqui en el caso que sea pruebas (1) o produccion (2)
                'tipoEmision' => '1',
                'razonSocial' => $institution->razon_social,//Cambiar aqui la razon social de la institucion
                'nombreComercial' => $institution->nombre_comercial,//Cambiar aqui el nombre comercial de la institucion
                'ruc' => $institution->ruc,//Cambiar aqui el RUC de la institucion JP
                'claveAcceso' => $claveacceso,
                'codDoc' => '06',
                'estab' => $institution->establecimiento,//Cambiar aqui en el caso de tener otra sucursal de la institucion
                'ptoEmi' => $ptoemi,//Cambiar aqui en el caso de tener varias cajas
                'secuencial' => $numero_factura,//Ingreso manual
                'dirMatriz' => $institution->direccion_matriz,//Cambiar aqui direccion de sucursal o matriz de institcion
            ],
            'infoGuiaRemision' => 
            [
                'dirEstablecimiento'=>'',
                'dirPartida'=>'',
                'razonSocialTransportista'=>'',
                'tipoIdentificacionTransportista'=>'',
                'rucTransportista'=>'',
                'fechaIniTransporte'=>'',
                'fechaFinTransporte'=>'',
                'placa'=>'',
                
            ],
            'destinatarios' => 
            [
                'destinatario'=>
                [
                    'identificacionDestinatario'=>'',
                    'razonSocialDestinatario'=>'',
                    'dirDestinatario'=>'',
                    'motivoTraslado'=>'',
                    //opcional cuando corresponda
                    'docAduaneroUnico'=>'',
                    'codEstabDestino'=>'',
                    'ruta'=>'',
                    'codDocSustento'=>'',
                    'numDocSustento'=>'',
                    'numAutDocSustento'=>'',
                    'fechaEmisionDocSustento'=>'',
                    //Termina
                    'detalles'=>
                    [
                        'detalle'=>
                        [
                            'codigoInterno'=>'',
                            'codigoAdicional'=>'',
                            'descripcion'=>'',
                            'cantidad'=>'',
                            'detallesAdicionales'=>
                            [
                                'detAdicional'=>
                                [
                                    '_attributes' => 
                                        [
                                            'nombre' => 'ABCD',
                                            'valor' => 'EFGH'
                                        ]
                                    ]
                                ]
                            ]
                        ]
                    ]
                ]
            ]
            
            
        ];
        

        

        //Direccion de comprador
        if($direccion){
            $tmp=$array["infoFactura"];
            $res = array_slice($tmp, 0, 6, true) +
            array("direccionComprador" => $direccion) +
            array_slice($tmp, 6, count($tmp) - 1, true);
            $array["infoFactura"]=$res;
        }
        
        //Campos adicionales: Correo, telefono
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
        //Termina campos adicionales

        //Conversion de array a xml
        $result = ArrayToXml::convert(
            $array, [
            'rootElementName' => 'guiaRemision',
            '_attributes' => [
                'id' => 'comprobante',
                'version' => '1.1.0'
            ],
        ], true, 'UTF-8',"1.0",['formatOutput' => true]);

        $xml = new \SimpleXMLElement($result);
        
        $activacionFacturacionElectronica = ConfiguracionSistema::facturacionElectronica();
        
        //Almacenamiento en servidor y ftp//
        Storage::disk('local')->put('/public/xml/'.$claveacceso.'.xml', $xml->asXML());
        //Para configurar alamacenamiento en servidor ftp configurar en el archivo config/filesystems.php
        // if ($activacionFacturacionElectronica->valor === '1') {
        //     Storage::disk('custom-ftp')->put($claveacceso.'.xml', $xml->asXML());
        // }
    }
*/
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
      /*Termina */
}
