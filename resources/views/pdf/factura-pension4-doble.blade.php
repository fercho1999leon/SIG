@extends('layouts.master-reportes')
@section('style')
	<style>
		.table-no-border td,
		.table-no-border th {
			font-size: 10pt !important;
		}
	</style>
@endsection
@section('content')
<table class="table-no-border">
    <tr>
        <td>
            <table class="table-no-border">
                <tr style="border-bottom: 2px solid black">
                    <td style="text-align:left" width="15%">
                        <img 
                            @if(DB::table('institution')->where('id', '1')->first()->logo == null)                    
                                src="{{ secure_asset('img/logo/logo.png') }}"
                            @else
                                src="{{ secure_asset('/storage/logo/'.DB::table('institution')->where('id', '1')->first()->logo) }}"                                  
                            @endif 
                        alt="" width="100%">
                    </td>
                    <td colspan="3" class="text-left" width="85%">
                        <div><span class="bold uppercase">{{$institution->nombre}}</span> </div>
                        <div><span class="bold uppercase">{{$institution->direccion}}</span> </div>
                        <div><span class="bold ">Comp. de Documentos Electrónicos</span></div>
                    </td>
                </tr>
                <tr>
                    <td><span class="bold uppercase" style="font-size: 11px !important;">Cliente:</span></td>
                    <td><span style="font-size: 10px !important;">{{$factura->cliente->nombres}} {{$factura->cliente->apellidos}} </span></td>
                    <td><span class="bold uppercase" style="font-size: 11px !important;">Periodo:</span></td>
                    <td><span style="font-size: 10px !important;"> {{$periodo->nombre}} </span></td>
                </tr>
                <tr>
                    <td><span class="bold uppercase" style="font-size: 11px !important;">Emisión:</span></td>
                    <td><span style="font-size: 10px !important;">{{$factura->updated_at}}</span></td>
                    <td><span class="bold uppercase" style="font-size: 11px !important;">Telefono:</span></td>
                    <td><span style="font-size: 10px !important;"> {{$factura->cliente->telefono}} </span></td>
                </tr>
                <tr style="border-bottom: 2px solid black">
                    <td><span class="bold uppercase" style="font-size: 11px !important;">Dirección:</span></td>
                    <td><span style="font-size: 10px !important;">{{$factura->cliente->direccion}}</span></td>
                    <td><span class="bold uppercase" style="font-size: 11px !important;">RUC:</span></td>
                    <td><span style="font-size: 10px !important;"> {{$factura->cliente->cedula_ruc}} </span></td>
                </tr>
                <tr>
                    <td colspan="4" style="font-size: 10px !important;"><span class="uppercase"> {{$student->apellidos}}, {{$student->nombres}} </span></td>
                </tr>
                <tr style="border-bottom: 2px solid black">
                    <td colspan="4" style="font-size: 12px !important;">{{$nameCurso}}</td>
                </tr>
                <tr>
                    <td colspan="4">{{$nameRubro}}</td>
                </tr>
                <tr><td rowspan="2"></td></tr>
                <tr><td><br><br><br><br></td></tr>
                <tr>
                    <td colspan="2">FORMA DE PAGO: {{$factura->tipo_pago}} US$ {{$factura->total}}</td>
                </tr>
                <tr><td><br><br><br></td></tr>
                <tr style="border: 1px solid black">
                    <td class="text-center" colspan="3" style="border: 1px solid black">
                        <span class="bold uppercase">Datos del estudiante</span>
                    </td>
                    <td class="text-center" colspan="1">
                        <span class="bold uppercase">Saldo</span>
                    </td>
                </tr>
                <tr style="border: 1px solid black">
                    <td colspan="3" style="font-size: 10px !important; padding: 20px;">*GRACIAS POR ESTAR AL DIA EN SUS PAGOS*</td>
                    <td class="text-right" colspan="1" style="border: 1px solid black">0.00 </td>
                </tr>
                <tr>
                    <td colspan="2"><span style="font-size: 11px !important;"><br> FACTURA No. {{$institution->establecimiento}}-001-{{'0000'.$factura->numeroFactura}}</span></td>
                    <td style="text-align: right !important;"><span style="font-size: 11px !important;"><br>SUBTOTAL: </span></td>
                    <td style="text-align: right !important;"><span style="font-size: 11px !important;"><br>{{$factura->subtotal}}</span></td>
                </tr>
                <tr>
                    <td colspan="2"><span style="font-size: 11px !important;">USUARIO: {{$represent->nombres}} {{$represent->apellidos}} </span></td>
                    <td style="text-align: right !important;"><span style="font-size: 11px !important;">RECARGO: </span></td>
                    <td style="text-align: right !important;"><span style="font-size: 11px !important;">0.00</span></td>
                </tr>
                <tr>
                    <td colspan="2"><br></td>
                    <td style="text-align: right !important;"><span style="font-size: 11px !important;">DESCUENTO: </span></td>
                    <td style="text-align: right !important;"><span style="font-size: 11px !important;">{{$descuento}}</span></td>
                </tr>
                <tr>
                    <td colspan="2"><span style="font-size: 11px !important;">SON: {{$formatter->toInvoice($factura->total, 2, 'Dolares')}} </span></td>
                    <td style="text-align: right !important;"><span style="font-size: 11px !important;">TOTAL: </span></td>
                    <td style="text-align: right !important;"><span style="font-size: 11px !important;">{{$factura->total}}</span></td>
                </tr>
                <tr><td><br></td></tr>
                <tr>
                    <td colspan="5"><span style="font-size: 11px !important;">Consulte su factura electrónica ingresando a:</span></td>
                </tr>
                <tr>
                    <td colspan="5"><span style="font-size: 11px !important;">https://declaraciones.sri.gob.ec/comprobantes-electronicos-internet/publico/validezComprobantes.jsf o al portal del SRI www.sri.gob.ec</span></td>
                </tr>
            </table>
        </td>
        <td colspan="3" width= "90px"></td>
        <td>
            <table class="table-no-border">
                <tr style="border-bottom: 2px solid black">
                    <td style="text-align:left" width="15%">
                        <img 
                            @if(DB::table('institution')->where('id', '1')->first()->logo == null)                    
                                src="{{ secure_asset('img/logo/logo.png') }}"
                            @else
                                src="{{ secure_asset('/storage/logo/'.DB::table('institution')->where('id', '1')->first()->logo) }}"                                  
                            @endif 
                        alt="" width="100%">
                    </td>
                    <td colspan="3" class="text-left" width="85%">
                        <div><span class="bold uppercase">{{$institution->nombre}}</span> </div>
                        <div><span class="bold uppercase">{{$institution->direccion}}</span> </div>
                        <div><span class="bold ">Comp. de Documentos Electrónicos</span></div>
                    </td>
                </tr>
                <tr>
                    <td><span class="bold uppercase" style="font-size: 11px !important;">Cliente:</span></td>
                    <td><span style="font-size: 10px !important;">{{$factura->cliente->nombres}} {{$factura->cliente->apellidos}} </span></td>
                    <td><span class="bold uppercase" style="font-size: 11px !important;">Periodo:</span></td>
                    <td><span style="font-size: 10px !important;"> {{$periodo->nombre}} </span></td>
                </tr>
                <tr>
                    <td><span class="bold uppercase" style="font-size: 11px !important;">Emisión:</span></td>
                    <td><span style="font-size: 10px !important;">{{$factura->updated_at}}</span></td>
                    <td><span class="bold uppercase" style="font-size: 11px !important;">Telefono:</span></td>
                    <td><span style="font-size: 10px !important;"> {{$factura->cliente->telefono}} </span></td>
                </tr>
                <tr style="border-bottom: 2px solid black">
                    <td><span class="bold uppercase" style="font-size: 11px !important;">Dirección:</span></td>
                    <td><span style="font-size: 10px !important;">{{$factura->updated_at}}</span></td>
                    <td><span class="bold uppercase" style="font-size: 11px !important;">RUC:</span></td>
                    <td><span style="font-size: 10px !important;"> {{$factura->cliente->telefono}} </span></td>
                </tr>
                <tr>
                    <td colspan="4" style="font-size: 10px !important;"><span class="uppercase"> {{$student->apellidos}}, {{$student->nombres}} </span></td>
                </tr>
                <tr style="border-bottom: 2px solid black">
                    <td colspan="4" style="font-size: 12px !important;">{{$nameCurso}}</td>
                </tr>
                <tr>
                    <td colspan="4">{{$nameRubro}}</td>
                </tr>
                <tr><td rowspan="2"></td></tr>
                <tr><td><br><br><br><br></td></tr>
                <tr>
                    <td colspan="2">FORMA DE PAGO: {{$factura->tipo_pago}} US$ {{$factura->total}}</td>
                </tr>
                <tr><td><br><br><br></td></tr>
                <tr style="border: 1px solid black">
                    <td class="text-center" colspan="3" style="border: 1px solid black">
                        <span class="bold uppercase">Datos del estudiante</span>
                    </td>
                    <td class="text-center" colspan="1">
                        <span class="bold uppercase">Saldo</span>
                    </td>
                </tr>
                <tr style="border: 1px solid black">
                    <td colspan="3" style="font-size: 10px !important; padding: 20px;">*GRACIAS POR ESTAR AL DIA EN SUS PAGOS*</td>
                    <td class="text-right" colspan="1" style="border: 1px solid black">0.00 </td>
                </tr>
                <tr>
                    <td colspan="2"><span style="font-size: 11px !important;"><br> FACTURA No. {{$institution->establecimiento}}-001-{{'0000'.$factura->numeroFactura}}</span></td>
                    <td style="text-align: right !important;"><span style="font-size: 11px !important;"><br>SUBTOTAL: </span></td>
                    <td style="text-align: right !important;"><span style="font-size: 11px !important;"><br>{{$factura->subtotal}}</span></td>
                </tr>
                <tr>
                    <td colspan="2"><span style="font-size: 11px !important;">USUARIO: {{$represent->nombres}} {{$represent->apellidos}} </span></td>
                    <td style="text-align: right !important;"><span style="font-size: 11px !important;">RECARGO: </span></td>
                    <td style="text-align: right !important;"><span style="font-size: 11px !important;">0.00</span></td>
                </tr>
                <tr>
                    <td colspan="2"><br></td>
                    <td style="text-align: right !important;"><span style="font-size: 11px !important;">DESCUENTO: </span></td>
                    <td style="text-align: right !important;"><span style="font-size: 11px !important;">{{$descuento}}</span></td>
                </tr>
                <tr>
                    <td colspan="2"><span style="font-size: 11px !important;">SON: {{$formatter->toInvoice($factura->total, 2, 'Dolares')}} </span></td>
                    <td style="text-align: right !important;"><span style="font-size: 11px !important;">TOTAL: </span></td>
                    <td style="text-align: right !important;"><span style="font-size: 11px !important;">{{$factura->total}}</span></td>
                </tr>
                <tr><td><br></td></tr>
                <tr>
                    <td colspan="5"><span style="font-size: 11px !important;">Consulte su factura electrónica ingresando a:</span></td>
                </tr>
                <tr>
                    <td colspan="5"><span style="font-size: 11px !important;">https://declaraciones.sri.gob.ec/comprobantes-electronicos-internet/publico/validezComprobantes.jsf o al portal del SRI www.sri.gob.ec</span></td>
                </tr>
            </table>
        </td>
    </tr>
</table>
@endsection