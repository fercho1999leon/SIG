<p class="text-center uppercase bold" style="font-size:12px"> {{ $institution->nombre }}</p>
	<br>
	<table class="table w100">
		<tr>
		<td colspan="3" class="no-border text-right">Recibo de Caja <br>No. {{ $abono->id}}</td>
		</tr>
		<tr>
			<td class="no-border text-left">
				Cliente: {{ $cliente->apellidos }} {{ $cliente->nombres }}
			</td>
			<td colspan="2" class="no-border text-right">
				Fecha: {{ $abono->created_at }}
			</td>
		</tr>
		<tr>
			<td width="35%" class="no-border text-left">
				RUC: {{$cliente->cedula_ruc}}
			</td>
			<td class="no-border text-center" width="35%" >
				Dirección: {{$cliente->direccion}}
			</td>
			<td class="no-border text-right" width="30%">
				Teléfono: {{$cliente->telefono}}
			</td>
		</tr>
	</table>
	<table class="table">
		<tr>
			<td class="no-border" width="50%">Estudiante: {{$student->apellidos}} {{$student->nombres}}</td>
			<td class="no-border text-right" width="50%">Curso: {{App\Course::nombreCurso($student->course)}}</td>
		</tr>
	</table>
	<table class="table">
		<tr>
			<td colspan="2" class="text-center">{{ $pago->rubro->tipo_rubro }} - {{ $mes }} {{$pago->anio}} </td>
			<td class="text-center">
				{{ $abono->cantidad }}
			</td>
		</tr>
		<tr>
			<td class="no-border">Son: {{ NumerosEnLetras::convertir($abono->cantidad) }}</td>
			<td width="5">Suman:</td>
			<td class="text-center">{{$abono->cantidad}}</td>
		</tr>
	</table>
	<table class="table">
		<tr>
			<td class="no-border">Forma de Pago: COLECTURIA - Efectivo - US$ {{ $abono->cantidad }}</td>
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