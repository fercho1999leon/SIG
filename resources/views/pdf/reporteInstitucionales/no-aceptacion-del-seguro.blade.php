@extends('layouts.master-reportes')
@section('content')
	@section('style')
		<style>
			.table td,
			.table th {
				font-size: 11pt !important;
				padding: 7px !important;
			}
		</style>
	@endsection
	<br>
	<br>
	<table class="table">
		<tr>
			<td class="no-border">{{$institution->ciudad}}, {{$fecha}}<br><br><br></td>
		</tr>
		<tr>
			<td class="no-border bold">
				Señores, <br>{{$institution->nombre}}<br>Ciudad.
			</td>
		</tr>
	</table>
	<br>
	<br>
	<br>
	<br>
	<table class="table">
		<tr>
			<td class="no-border">De mis consideraciones:<br><br></td>
		</tr>
		<tr>
			<td class="line no-border" style="text-align: justify">
				Yo, 
			<span class="bold">{{$student->representante->apellidos}} {{$student->representante->nombres}}</span>, representante {{$student->sexo === 'Masculino' ? 'del' : 'de la'}} Estudiante <span class="bold">{{$student->apellidos}} {{$student->nombres}}</span>,del grado/curso <span class="bold">{{$student->course->grado}} {{$student->course->especializacion}} Paralelo {{$student->course->paralelo}},</span> bajo mis propios derechos, comunico que mi representado no utilizará el <span class="bold">SERVICIO DE SEGURO ACCIDENTES,</span> que la institución sugiere, por lo que asumo toda la responsabilidad económica que genere cualquier eventualidad o accidente dentro y fuera de la institución durante la jornada escolar. También libro de toda responsabilidad económica a la <span class="bold">{{$institution->nombre}}</span> por dicha eventualidad.</td>
		</tr>
		<tr>
			<td class="no-border"><br><br></td>
		</tr>
		<tr>
			<td class="no-border line">
				Gracias por la atención prestada. <br>Atentamente, <br><br>
			</td>
		</tr>
		<tr>
			<td class="no-border">
				___________________________ <br><br>CI: {{$student->representante->ci}}
			</td>
		</tr>
	</table>
@endsection