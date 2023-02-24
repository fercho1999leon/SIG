@extends('layouts.master-reportes')
@section('content')
@section('style')
	<style>
		.table td {
			font-size: 7pt !important;
		}
	</style>
@endsection
<table class="table">
	<tr>
		<th style="vertical-align:top;" class="no-border" width="20%">
			
		</th>
		<th class="no-border" width="60%">
			<div class="header__info text-center">
				<h3>{{ $institution->nombre }}</h3>
			</div>
		</th>
		<th class="no-border" width="20%">
			<div class="header__logo" style="text-align:right">
				<img 
					@if(DB::table('institution')->where('id', '1')->first()->logo == null)
						src="{{ secure_asset('img/logo/logo.png') }}"
					@else
						src="{{ secure_asset('/storage/logo/'.DB::table('institution')->where('id', '1')->first()->logo) }}"
					@endif 
				alt="" width="70">
			</div>
		</th>
	</tr>
</table>
<table class="table">
	<tr>
		<td width="33.3%" class="no-border">Inscripción No. {{substr($student->numero_matriculacion,5,10)}} <br>Fecha:{{$fecha}}</td>
		<td width="33.3%" class="no-border text-center bold">SOLICITUD DE MATRÍCULA</td>
		<td width="33.3%" class="no-border"></td>
	</tr>
</table>
{{-- Datos del Aspirante --}}
<table class="table" style="border:1px solid black;">
	<tr>
		<td colspan="3" class="text-center bold">
			Datos del Aspirante
		</td>
	</tr>
	<tr>
		<td colspan="3" class="no-border">Nombres y Apellidos: {{$student->apellidos}} {{$student->nombres}}</td>
	</tr>
	<tr>
		<td class="no-border">Lugar y fecha de nacimiento: {{$student->lugarNacimiento}} {{$student->fechaNacimiento}}</td>
		<td colspan="2" class="no-border">No. Cédula: {{$student->ci}}</td>
	</tr>
	<tr>
		<td class="no-border">Grado / curso al que aspira: {{$student->course->grado}} {{$student->course->especializacion}} {{$student->course->paralelo}}</td>
		<td colspan="2" class="no-border">Edad: {{$edad}}</td>
	</tr>
	<tr>
		<td colspan="3" class="no-border">Jardín / Escuela / Colegio del que procede: {{$student->institucionAnterior}}</td>
	</tr>
	<tr>
		<td class="no-border">
			Dirección Domiciliaria: {{$student->direccion_domicilio}} 
		</td>
		<td class="no-border">Telef. Casa: {{$student->telefono_movil}}</td>
		<td class="no-border">Telef. Emergencia: {{$student->movil_contacto_emergencia}}</td>
	</tr>
	<tr>
		<td class="no-border" colspan="3">
			Actividad extracurricular que realiza: ---- 
		</td>
	</tr>
	<tr>
		<td class="no-border">
			Actualmente repite Año: ---
		</td>
		<td class="no-border">Disciplina: ---</td>
		<td class="no-border">Aprovechamiento: ---</td>
	</tr>
	<tr>
		<td colspan="3" class="no-border">Número de suministro de la Empresa Eléctrica:----</td>
	</tr>
</table>
{{-- Datos del Padre y la madre --}}
@foreach (['padre', 'madre'] as $padre)
	<table class="table" style="border:1px solid black;">
		<tr>
			<td colspan="2" class="text-center bold">Datos {{$padre == 'padre' ? 'del Padre' : 'de la Madre'}}</td>
		</tr>
		<tr>
			<td colspan="2" class="no-border">Datos del padre: ----</td>
		</tr>
		<tr>
			<td colspan="2" class="no-border">Nombres y Apellidos : {{$student[$padre]->apellidos}} {{$student[$padre]->nombres}}</td>
		</tr>
		<tr>
			<td class="no-border">Lugar y fecha de nacimiento: 
				@if ($student[$padre]->fNacimiento != null)
					{{Carbon\Carbon::createFromFormat('Y-m-d', $student[$padre]->fNacimiento)->diff(Carbon\Carbon::now())->format('%y años')}}
				@endif
			</td>
			<td class="no-border">No. de Cédula: {{$student[$padre]->ci}}</td>
		</tr>
		<tr>
			<td class="no-border">Estado Civil:{{$student[$padre]->estado_civil}}</td>
			<td class="no-border">Número de hijos: ----</td>
		</tr>
		<tr>
			<td class="no-border">Dirección domiciliaria: {{$student[$padre]->direccionDomicilio}}</td>
			<td class="no-border">Celular: {{$student[$padre]->movil}}</td>
		</tr>
		<tr>
			<td class="no-border">Profesión: {{$student[$padre]->cargoTrabajo}}</td>
			<td class="no-border">Ingreso Mensual: ---</td>
		</tr>
		<tr>
			<td class="no-border">Lugar de trabajo: {{$student[$padre]->lugarTrabajo}}</td>
			<td class="no-border">Teléfono: ---</td>
		</tr>
		<tr>
			<td class="no-border">Dirección: {{$student[$padre]->direccionTrabajo}}</td>
			<td class="no-border">Religión que practica: {{$student[$padre]->religion}}</td>
		</tr>
		<tr>
			<td colspan="2" class="no-border">Correo Electrónico: {{$student[$padre]->correo}}</td>
		</tr>
	</table>
@endforeach
<table class="table" style="border:1px solid black;">
	<tr>
		<td colspan="2" class="text-center bold">Datos del Representante Legal(Caso ausencia de padres)</td>
	</tr>
	<tr>
		<td colspan="2" class="no-border">Datos del padre: ----</td>
	</tr>
	<tr>
		<td colspan="2" class="no-border">Nombres y Apellidos : {{$student->representante->apellidos}} {{$student->representante->nombres}}</td>
	</tr>
	<tr>
		<td class="no-border">Lugar y fecha de nacimiento: 
			@if ($student->representante->fNacimiento != null)
				{{Carbon\Carbon::createFromFormat('Y-m-d', $student->representante->fNacimiento)->diff(Carbon\Carbon::now())->format('%y años')}}
			@endif
		</td>
		<td class="no-border">No. de Cédula: {{$student->representante->ci}}</td>
	</tr>
	<tr>
		<td class="no-border">Estado Civil:-------</td>
		<td class="no-border">Número de hijos: {{count($student->representante->hijos)}}</td>
	</tr>
	<tr>
		<td class="no-border">Dirección domiciliaria: {{$student->representante->dDomicilio}}</td>
		<td class="no-border">Celular: {{$student->representante->movil}}</td>
	</tr>
	<tr>
		<td class="no-border">Profesión: ---</td>
		<td class="no-border">Ingreso Mensual: ---</td>
	</tr>
	<tr>
		<td class="no-border">Lugar de trabajo: ---</td>
		<td class="no-border">Teléfono: ---</td>
	</tr>
	<tr>
		<td class="no-border">Dirección: ----</td>
		<td class="no-border">Religión que practica: ---</td>
	</tr>
	<tr>
		<td colspan="2" class="no-border">Correo Electrónico: {{$student->representante->correo}}</td>
	</tr>
</table>
<p class="bold text-center">Todo documento recibido en Secretaría debe constar de sustento legal y de la veracidad del Representante</p>
@endsection