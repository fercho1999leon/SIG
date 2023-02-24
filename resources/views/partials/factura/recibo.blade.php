@php
	use App\Payment;
	use App\Abono;
	use App\Rubro;
	use App\Fechas;

@endphp
<p class="text-center uppercase bold" style="font-size:12px"> {{ $institution->nombre }}</p>
	<br>
	<table class="table w100">
		<tr>
		<td colspan="2" class="no-border text-right">Recibo de Caja <br>No. {{ $factura->abonos()->latest()->first()->id }}</td>
		</tr>
		<tr>
			<td class="no-border text-left">
				Cliente: {{ $cliente->apellidos }} {{ $cliente->nombres }}
			</td>
			<td class="no-border text-right">
				Fecha: {{ $factura->abonos()->latest()->first()->created_at }}
			</td>
		</tr>
		<tr>
			<td width="35%" class="no-border text-left">
				RUC: {{ $cliente->cedula_ruc }}
			</td>
			<td class="no-border" width="35%" >
				Dirección: {{ $cliente->direccion }}
			</td>
			<td class="no-border" width="30%">
				Teléfono: {{ $cliente->telefono }}
			</td>
		</tr>
	</table>
	<table class="table">
		<tr>
			<td class="no-border" width="50%">Estudiante: {{  $student->apellidos }} {{  $student->nombres }}</td>
			<td class="no-border" width="50%">Curso: {{  $student->course->grado }} {{  $student->course->paralelo }}</td>
		</tr>
	</table>
	<table class="table">
		@foreach($factura->abonos as $abono)
			@php
				$ab = Abono::with('pagoDetalle')->find($abono->id);
				$pago = Payment::find($ab->pagoDetalle->idPago);
				$mes = Fechas::getMes($pago->mes);
				$rubro = Rubro::find($pago->idRubro);        
			@endphp
			<tr>
				<td colspan="2" class="text-center">{{ $rubro->tipo_rubro }} - {{ $mes }} </td>
				<td class="text-center">{{ $abono->cantidad }}</td>
			</tr>
		@endforeach
		<tr>
			<td class="no-border">Son: {{ NumerosEnLetras::convertir($factura->abonos->sum('cantidad')) }}</td>
			<td width="5">Suman:</td>
			<td class="text-center">{{$factura->abonos->sum('cantidad')}}</td>
		</tr>
	</table>
	<table class="table">
		<tr>
			<td class="no-border">Forma de Pago: COLECTURIA - {{ implode(" ", array_unique($factura->tipoPago->pluck('tipo_pago')->toArray()) )}} - US$ {{ $factura->abonos->sum('cantidad') }}</td>
		</tr>
	</table>
	<table class="table">
		<tr>
			<td class="no-border text-left">Usuario: {{ $user_profile->apellidos }} {{ $user_profile->nombres }}</td>
		</tr>
	</table>
	<br>
	<br>
	<table class="table">
		<tr>
			<td width="10%" class="no-border"></td>
			<td width="35%" class="no-border text-center">
				<hr style="border:1px solid black">
				Firma Cliente
			</td>
			<td width="10%" class="no-border"></td>
			<td width="35%" class="no-border text-center">
				<hr style="border:1px solid black">
				Firma Autorizada
			</td>
			<td width="10%" class="no-border"></td>
		</tr>
	</table>