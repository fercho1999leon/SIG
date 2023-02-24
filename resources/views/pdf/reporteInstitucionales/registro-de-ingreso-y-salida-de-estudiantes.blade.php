@extends('layouts.master-reportes')
@section('content')
	@section('style')
	<style>
		.table td,
		.table th {
			font-size: 8pt !important;
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
			<th class="no-border" width="75%">
				<div class="header__info text-center">
					<h3>{{ $institution->nombre }}</h3>
					<h3>AÑO LECTIVO  {{ $periodoLectivo }}</h3>
				</div>
			</th>
			<th class="no-border" width="5%">
			</th>
		</tr>
	</table>
	<table class="table">
		<tr>
			<td class="text-center no-border bold">
				<h3>
					AUTORIZACIÓN DE MOVILIZACIÓN ESTUDIANTIL
				</h3>
			</td>
		</tr>
		<tr>
			<td class="bold uppercase no-border">datos personales {{$student->sexo === 'Masculino' ? 'del' : 'de la'}} estudiante</td>
		</tr>
	</table>
	<table class="table">
		<tr>
			<td class="uppercase">Nombres y Apellidos:</td>
			<td colspan="5">{{$student->nombres}} {{$student->apellidos}}</td>
		</tr>
		<tr>
			<td class="uppercase">Dirección domiciliaria:</td>
			<td colspan="3">{{$student->direccion_domicilio}}</td>
			<td class="uppercase">Cédula:</td>
			<td>{{$student->ci}}</td>
		</tr>
		<tr>
			<td class="uppercase">GRADO:</td>
			<td>{{$student->course->grado}} {{$student->course->especializacion}}</td>
			<td class="uppercase">Paralelo:</td>
			<td colspan="3">{{$student->course->paralelo}}</td>
		</tr>
		<tr>
			<td class="uppercase" colspan="6">Modalidad de transporte del educando</td>
		</tr>
		<tr>
			<td>Privado</td>
			<td width="50" class="text-center">{{$student->transporte->es_privado === 1 ? 'X' : ''}}</td>
			<td>Expreso</td>
			<td width="50" class="text-center">{{$student->transporte->es_privado === 0 ? 'X' :''}}</td>
			<td>Se retira solo</td>
			<td width="50" class="text-center">{{$student->se_va_solo === 1 ? 'X' : ''}}</td>
		</tr>
		@if ($student->transporte->id != null)
			@if ($student->transporte->es_privado === 0)
				<tr>
					<td colspan="6">Si utiliza expreso: {{$student->transporte->unidad}}</td>
				</tr>
			@endif
			<tr>
				<td>Nombre del conductor</td>
				<td>{{$student->transporte->chofer}}</td>
				<td>Teléfono</td>
				<td colspan="3">{{$student->transporte->celular}}</td>
			</tr>
		@endif
	</table>
	@foreach (['madre', 'padre'] as $padre)	
		@if($student[$padre]->autorizadoRetirarEstudiante==1)
		<table class="table">
			<tr>
				<td class="bold no-border">DATOS PERSONALES {{$student[$padre]->sexo === 'Masculino' ? 'DEL' : 'DE LA'}} {{strToUpper($padre)}}</td>
			</tr>
			<tr>
				<td class="uppercase">Nombres y apellidos:</td>
				<td colspan="3">{{$student[$padre]->apellidos}} {{$student[$padre]->nombres}}</td>
			</tr>
			<tr>
				<td class="uppercase">Dirección domiciliaria:</td>
				<td colspan="3">{{$student[$padre]->direccionDomicilio}}</td>
			</tr>
			<tr>
				<td class="uppercase">Teléfono casa:</td>
				<td>{{$student[$padre]->telefonoDomicilio}}</td>
				<td class="uppercase">Teléfono celular:</td>
				<td colspan="2">{{$student[$padre]->movil}}</td>
			</tr>
			<tr>
				<td class="uppercase">Correo:</td>
				<td colspan="3">{{$student[$padre]->correo}}</td>
			</tr>
			<tr>
				<td class="uppercase">Ocupación:</td>
				<td colspan="3">{{$student[$padre]->cargoTrabajo}}</td>
			</tr>
		</table>
		@endif
		
	@endforeach
	@if ($student->student->personasAutorizadas->isNotEmpty())
		<table class="table">
			<tr>
				<td class="no-border bold">DATOS PERSONALES RESPONSABLE DEL TRASLADO {{$student->sexo === 'Masculino' ? 'DEL' : 'DE LA'}} ESTUDIANTE A LA INSTITUCIÓN</td>
			</tr>
		</table>
		@foreach ($student->student->personasAutorizadas as $user)
			<table class="table">
				<tr>
					<td class="no-border uppercase">En caso de emergencia llamar al: {{$user->telefono_celular}}</td>
				</tr>
				<tr>
					<td class="uppercase" width="50%">Nombres Apellidos:</td>
					<td width="50%">{{$user->nombres}}</td>
				</tr>
				<tr>
					<td class="uppercase">Dirección:</td>
					<td>{{$user->direccion}}</td>
				</tr>
				<tr>
					<td class="uppercase">Convencional:</td>
					<td>{{$user->telefono_domicilio}}</td>
				</tr>
				<tr>
					<td class="uppercase">Celular:</td>
					<td>{{$user->telefono_celular}}</td>
				</tr>
			</table>
		@endforeach
	@endif
	<table class="table">
		<tr>
			<td class="no-border uppercase">
				<small class="bold">OBSERVACIÓN:</small><br>
				<small>
					si su representado(A) se retira solo, favor enviar una carta donde autorice su salida. (ADJUNTAR COPIA DE CÉDULA DEL REPRESENTANTE LEGAL).
				</small>
			</td>
		</tr>
	</table>
	<br>
	<br>
	<table class="table">
		<tr>
			<td class="no-border text-center">
				_____________________________________________ <br>Firma {{$student->representante->sexo === 'Masculino' ? 'del' : 'de la'}} Representante
			</td>
		</tr>
		<tr>
			<td class="no-border text-center uppercase">{{$student->representante->apellidos}} {{$student->representante->nombres}}</td>
		</tr>
		<tr>
			<td class="no-border text-center">{{$student->representante->correo}}</td>
		</tr>
		<tr>
			<td class="no-border text-center">Cédula No. {{$student->representante->ci}}</td>
		</tr>
	</table>
@endsection
