@extends('layouts.master-reportes')
@section('content')
@section('style')
	<style>
		.table td,
		.table th {
			font-size: 9pt !important;
		}
	</style>
@endsection
<table class="table">
	<tr>
		<th style="vertical-align:top;" class="no-border" width="20%">
			<div class="header__logo" style="text-align:left">
				<img 
					@if(DB::table('institution')->where('id', '1')->first()->logo == null)
						src="{{ secure_asset('img/logo/logo.png') }}"
					@else
						src="{{ secure_asset('/storage/logo/'.DB::table('institution')->where('id', '1')->first()->logo) }}"
					@endif 
				alt="" width="70">
			</div>
		</th>
		<th class="no-border" width="60%">
			<div class="header__info text-center">
				<h3>{{ $institution->nombre }}</h3>
				<h3>AÑO LECTIVO <h3>{{ $periodoLectivo }}</h3></h3>
			</div>
		</th>
		<th class="no-border" width="20%">
			<span style="display:inline-block; width:50pt;height:50pt; font-size:5pt; border:1px solid black">Autorizo para que en caso de ser aceptado, se pegue en este lugar, la copia de la fotografía del carné estudiantil</span>
		</th>
	</tr>
</table>


<table class="table">
	<tr>
		<td class="no-border">
			<h3>
			Acta de matrícula No {{substr($student->numero_matriculacion,5,10)}}
			</h3>
		</td>
	</tr>
	<tr>
		<td class="no-border"><br></td>
	</tr>
	<tr>
		<td class="no-border">
			<span style="font-size: 9pt">
				En la {{$institution->nombre}} de conformidad con el Reglamento General de Educación (LOEI) se matricula el alumno:
			</span>
		</td>
	</tr>
	<tr>
		<td class="no-border"><br></td>
	</tr>
	<tr>
		<td class="text-center no-border bold">
			<h3>{{$student->apellidos}} {{$student->nombres}}</h3>
		</td>
	</tr>
	<tr>
		<td class="no-border"><br></td>
	</tr>
	<tr>
		<td width="5" class="no-border bold"><h4>En: {{$curso}} </h4></td>
	</tr>
	<tr>
		<td class="no-border"><br><br></td>
	</tr>
	<tr>
		<td class="no-border">
			<span class="bold">N. de cédula:</span>{{$student->ci}}
		</td>
	</tr>
	<tr>
		<td class="no-border">
			<span class="bold">Fecha Nacimiento:</span>{{$student->fechaNacimiento}}
		</td>
	</tr>
	<tr>
		<td class="no-border">
			<span class="bold">Nacionalidad:</span>{{$student->nacionalidad}}
		</td>
	</tr>
	<tr>
		<td class="no-border">
			<span class="bold">Domicilio:</span>{{$student->direccion_domicilio}}
		</td>
	</tr>
	<tr>
		<td class="no-border">
			<span class="bold">Teléfono y celular:</span>{{$student->celular}}
		</td>
	</tr>
	<tr>
		<td class="no-border">
			<span class="bold">Plantel de procedencia:</span>{{$student->institucionAnterior ?? $institution->nombre}}
		</td>
	</tr>
	<tr>
		<td class="no-border">
			{{-- <span class="bold">Suministro eléctrico:</span>{{$student->codigo_empresa_electrica}}  --}}
		</td>
	</tr>
</table>
<br>
<br>
@foreach (['padre', 'madre'] as $padre)
	<table class="table whitespace-no">
		<tr>
			<td width="5" class="bold">Nombre del {{$padre}}:</td>
			<td>{{$student[$padre]->apellidos}} {{$student[$padre]->nombres}} </td>
			<td width="5" class="bold">Cédula</td>
			<td>{{$student[$padre]->ci}}</td>
		</tr>
		<tr>
			<td width="5" class="bold">Lugar de trabajo:</td>
			<td>{{$student[$padre]->lugarTrabajo}}</td>
			<td width="5" class="bold">Telf. tbj:</td>
			<td>{{$student[$padre]->telefonoTrabajo}}</td>
		</tr>
		<tr>
			<td width="5" class="bold">Profesión:</td>
			<td>{{$student[$padre]->profesion}}</td>
			<td width="5" class="bold">Celular:</td>
			<td>{{$student[$padre]->movil}}</td>
		</tr>
		<tr>
			<td width="5" class="bold">Correo:</td>
			<td colspan="3">{{$student[$padre]->correo}}</td>
		</tr>
	</table>
	<br>
@endforeach
<table class="table whitespace-no">
	<tr>
		<td width="5" class="bold">Representante:</td>
		<td>{{$student->representante->nombres}}  {{$student->representante->apellidos}}</td>
		<td width="5" class="bold">Cédula</td>
		<td>{{$student->representante->ci}}</td>
	</tr>
	<tr>
		<td width="5" class="bold">Lugar de trabajo:</td>
		<td>{{$student->representante->lugar_trabajo}}</td>
		<td width="5" class="bold">Telf. tbj:</td>
		<td>{{$student->representante->telefono_trabajo}}</td>
	</tr>
	<tr>
		<td width="5" class="bold">Profesión:</td>
		<td>{{$student->representante->profesion}}</td>
		<td width="5" class="bold">Celular:</td>
		<td>{{$student->representante->movil}}</td>
	</tr>
	<tr>
		<td width="5" class="bold">Correo:</td>
		<td colspan="3">{{$student->representante->correo}}</td>
	</tr>
</table>
<br>
<table class="table">
	<tr>
		<td class="bold no-border">Observación:</td>
	</tr>
</table>
<br>
<table class="table">
	<tr>
		<td class="no-border"></td>
		<td class="no-border text-center">
			_____________________________________________ <br>{{strToUpper($student->representante->apellidos)}} {{strToUpper($student->representante->nombres)}} <br> REPRESENTANTE
		</td>
		<td class="no-border"></td>
		<td class="no-border text-center">
			_____________________________________________ <br>{{strToUpper($institution->representante2)}} <br> SECRETARÍA GENERAL </td>
		<td class="no-border"></td>
	</tr>
</table>
@endsection