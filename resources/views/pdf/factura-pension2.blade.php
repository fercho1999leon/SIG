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
			<td colspan="2" class="text-center">
				<h3 class="m-0">{{$institution->razon_social}}</h3>
				<div><span class="bold">RUC:</span> {{$institution->ruc}}</div>
				<div><span class="bold">Dirección:</span> {{$institution->direccion_matriz}}</div>
				<div><span class="bold">Telf:</span>{{$institution->telefonos}}</div>
			</td>
		</tr>
		<tr>
			<td colspan="2"><br></td>
		</tr>
		<tr>
			<td colspan="2">
				{{-- Recibo de pago #420838 --}}
				<span style="visibility: hidden">-</span>
			</td>
		</tr>
		<tr>
			<td colspan="2"><br></td>
		</tr>
		<tr class="text-center">
			<td colspan="2">DETALLE DE COMPRA SIN VALIDEZ TRIBURATIA</td>
		</tr>
		<tr class="text-center">
			<td colspan="2"># factura{{$institution->establecimiento}}-001-{{$numeroDeFactura}}</td>
		</tr>
		<tr>
			<td colspan="2"><br></td>
		</tr>
		<tr>
			<td><span class="bold">Hora impresión:</span></td>
			<td class="text-right"> {{Carbon\Carbon::now()}} </td>
		</tr>
		<tr>
			<td><span class="bold">Usuario impr:</span></td>
			<td class="text-right">{{$user->apellidos}} {{$user->nombres}}</td>
		</tr>
		<tr>
			<td><span class="bold">Fecha pago:</span></td>
			<td class="text-right">{{$factura->facturaDetalle->first()->pagoEstudianteDetalle->updated_at}}</td>
		</tr>
		<tr>
			<td><span class="bold">Cajero:</span></td>
			<td class="text-right">{{$factura->user->apellidos}} {{$factura->user->nombres}}</td>
		</tr>
		<tr>
			@foreach($factura->facturaDetalle as $fd)
				@php
                    $pd = $pagos->where('id', $fd->idPagoDetalle)->first();
					$mes = '';
					switch($pd->pago->mes){
						case 1: $mes = "Enero"; break;
						case 2: $mes = "Febrero"; break;
						case 3: $mes = "Marzo"; break;
						case 4: $mes = "Abril"; break;
						case 5: $mes = "Mayo"; break;
						case 6: $mes = "Junio"; break;
						case 7: $mes = "Julio"; break;
						case 8: $mes = "Agosto"; break;
						case 9: $mes = "Septiembre"; break;
						case 10: $mes = "Octubre"; break;
						case 11: $mes = "Noviembre"; break;
						case 12: $mes = "Diciembre"; break;
					}
					$valorTotal = $factura->total;
				@endphp
			@endforeach
			<td><span class="bold">Total Pago:</span></td>
			<td class="text-right"><h3 class="m-0 bold">${{ bcdiv($valorTotal, '1', 2) }}</h3></td>
		</tr>
		<tr>
			<td colspan="2"><br></td>
		</tr>
		<tr>
			<td colspan="2">
				<span class="bold">Datos representante económico</span>
			</td>
		</tr>
		<tr>
			<td colspan="2">{{$student->cliente->apellidos}} {{$student->cliente->nombres}}</td>
		</tr>
		<tr>
			<td colspan="2">CI/RUC: {{$student->cliente->cedula_ruc}}</td>
		</tr>
		<tr>
			<td colspan="2">
				<span class="bold">Datos del estudiante</span>
			</td>
		</tr>
		<tr>
			<td colspan="2">{{$student->apellidos}} {{$student->nombres}}</td>
		</tr>
		<tr>
			<td colspan="2">{{$student->course->grado}} {{$student->course->especializacion}} {{$student->course->paralelo}}</td>
		</tr>
		{{-- <tr>
			<td>Código</td>
			<td class="text-right">2018000072</td>
		</tr> --}}
		<tr>
			<td>CI/RUC</td>
			<td class="text-right">{{$student->cliente->cedula_ruc}}</td>
		</tr>
		@foreach($factura->facturaDetalle as $fd)
			@php
                $valorTotal = 0;
				$pd = $pagos->where('id', $fd->idPagoDetalle)->first();
				$mes = '';
				switch($pd->pago->mes){
					case 1: $mes = "Enero"; break;
					case 2: $mes = "Febrero"; break;
					case 3: $mes = "Marzo"; break;
					case 4: $mes = "Abril"; break;
					case 5: $mes = "Mayo"; break;
					case 6: $mes = "Junio"; break;
					case 7: $mes = "Julio"; break;
					case 8: $mes = "Agosto"; break;
					case 9: $mes = "Septiembre"; break;
					case 10: $mes = "Octubre"; break;
					case 11: $mes = "Noviembre"; break;
					case 12: $mes = "Diciembre"; break;
				}
				$rubro = App\Rubro::find($pd->pago->idRubro);
				$valorTotal = App\Payment::calcularDescuentoEstudiante($student->idStudent, $pd->idPago);
			@endphp
			<tr>
				<td>Descripción</td>
				<td class="text-right uppercase">
					{{$mes}} - {{$rubro->tipo_rubro}}
				</td>
			</tr>
			<tr>
				<td>Total a pagar</td>
				<td class="text-right">{{$valorTotal}}</td>
			</tr>
		@endforeach
	</table>
@endsection