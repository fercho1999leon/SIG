@php
use Luecano\NumeroALetras\NumeroALetras;
$formatter = new NumeroALetras();// numeros en letras
use App\BecaDescuento;
	use App\Rubro;
@endphp
@extends('layouts.master-reportes')
@section('style')
	<style>
		.table-no-border td,
		.table-no-border th {
			font-size: 8.5pt !important;
		}
	</style>
@endsection
@section('content')
	<table class="table-no-border">
		<tr>
			<td width="70%" height="20" style="padding-right: 10px;">{{$student->cliente->apellidos}} {{$student->cliente->nombres}}</td>
			<td  width="30%" class="text-right">{{($factura->facturaDetalle->first()->pagoEstudianteDetalle->updated_at)->format('d/m/Y')}}</td>
		</tr>
		<tr>
			<td style="padding-right: 10px; " height="20">{{$student->cliente->direccion}}</td>
			<td class="text-right" style="font-size: 8.5pt !important">{{$student->cliente->cedula_ruc}}</td>
		</tr>
		<tr>
			<td height="20"></td>
			<td class="text-right"  style="font-size: 8.5pt !important">{{$student->cliente->telefono}}</td>
		</tr>
		</table>
		<br>
		<div style="margin-top: 30px;">
		<table class="table-no-border">
			<tr>
			<td width="70%" height="70"  style="font-size: 8.5pt !important">{{$student->apellidos}} {{$student->nombres}}</td>
			<td width="14%" class="text-right"  style="font-size: 8.5pt !important">&nbsp;</td>
			<td width="16%" class="text-right" style="font-size: 8.5pt !important">{{ bcdiv($factura->total, '1', 2) }}</td>
		</tr>
		<tr>
			<td width="70%" height="70"  style="font-size: 8.5pt !important">
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
			$rubro = App\Rubro::find($pd->pago->idRubro);
				@endphp
				{{$mes}}
			@endforeach
			</td>
			<td  width="14%"{{ $institution->descuentoInstitucional }}</td>
			<td  width="16%" class="text-right">&nbsp;</td>
		</tr>
		<tr>
			<td height="35" style="font-size: 8.5pt !important">{{$student->course->grado}} {{$student->course->especializacion}} {{$student->course->paralelo}}</td>
			<td>&nbsp;</td>
			<td class="text-right">&nbsp;</td>
		</tr>
		@if ($rubro->tipo_rubro == 'Pension')
		@foreach($student->student->becasDescuentos as $beca)
			@if (BecaDescuento::find($beca->idBeca)!=null)
				@php
					$b = BecaDescuento::find($beca->idBeca);
					$tipo = ($b->tipo == 'USD') ? '$' : '%';

					$total =  $pd->pago->valor_cancelar;
					$descuentoTotal = 0;
					if( strtoupper( $rubro->tipo_rubro ) == 'PENSION') {
						if(count($student->student->becasDescuentos) != 0) {
							$becaTotal = 0;
							foreach($student->student->becasDescuentos as $beca){
								$bd = BecaDescuento::find($beca->idBeca);
								if($bd->tipo == 'BECA'){
									if($bd->tipo_pago == "USD"){
										$becaTotal = $bd->valor;
									}else if($bd->tipo_pago == "PORCENTAJE"){
										$becaTotal = $total*($bd->valor/100);
									}
								}
							}

							$descuentoTotal = $total - $becaTotal;
							$descuento = 0;
							foreach($student->student->becasDescuentos as $beca){
								$bd = BecaDescuento::find($beca->idBeca);
								if($bd->tipo == 'DESCUENTO'){
									if($bd->tipo_pago == "USD"){
										$descuento = $bd->valor;
									}else if($bd->tipo_pago == "PORCENTAJE"){
										$descuento = $descuentoTotal*($bd->valor/100);
									}
								}
							}
							$descuentoTotal = $descuentoTotal - $descuento ;
							$total = $descuentoTotal;
						}
					}
				@endphp
				<tr>
					<td height="35" >UD RECIBE EL  {{ $b->nombre }} DE DESCUENTO</td>
					<td></td>
					<td></td>
				</tr>
			@endif
		@endforeach
	@endif
		</table>
	</div>
		<table>
		<tr>
			<td width="70%" height="80"  style="font-size: 8.5pt !important">{{$formatter->toInvoice($factura->total, 2, 'Dolares')}}</td>
			<td width="14%" >&nbsp;</td>
			<td width="16%"  style="position: absolute; bottom: 0; right: 0; font-size: 8.5pt !important">${{ bcdiv($factura->total, '1', 2) }}</td>
		</tr>
	</table>
@endsection