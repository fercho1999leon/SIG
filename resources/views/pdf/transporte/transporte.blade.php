<!DOCTYPE html>
<html lang="es">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Reporte Transporte</title>
	<link rel="stylesheet" href="{{ secure_asset('css/pdf/pdf.css') }}">
</head>
<body>
	<table class="table">
		<tr>
			<th style="vertical-align:top;" class="no-border" width="10%">
				<div class="header__logo" style="text-align:left">
					<img @if(DB::table('institution')->where('id', '1')->first()->logo == null)src="{{ secure_asset('img/logo/logo.png') }}" @else src="{{ secure_asset('/storage/logo/'.DB::table('institution')->where('id', '1')->first()->logo) }}"                                  @endif width="70" alt="" >
				</div>
			</th>
			<th class="no-border" width="80%">
				<div class="header__info text-center">
					<h3> {{$institution->nombre}} </h3>
					<h3 class="up">Año Lectivo: {{$periodo}} </h3>
					<h3 class="up">
						Reporte Transporte
					</h3>
					<h3 class="up">Listado de Estudiantes Expreso</h3>
					<h3 class="up">Recorrido: {{$unidad->ruta}} </h3>
				</div>
			</th>
			<th class="no-border" width="10%">
			</th>
		</tr>
	</table>
	<table class="table">
		<tr>
			<td colspan="5" class="no-border" style="font-size: 12px">Fecha: {{$fecha}} </td>
			<td colspan="2" class="no-border" style="font-size: 12px">Unidad: {{$unidad->unidad}} </td>
			<td colspan="4" class="no-border" style="font-size: 12px;text-align: right">Chofer: {{$unidad->chofer}} </td>
		</tr>
		<tr>
			<td width="5" class="text-center">No.</td>
			<td class="text-center up">Estudiante</td>
			<td class="text-center up">Curso/Paralelo</td>
			<td class="text-center up">Domicilio</td>
			<td class="text-center up">Telefono Representante</td>
			<td class="text-center up">Nombre Representante</td>
			<td class="text-center up">Telefono Padre</td>
			<td class="text-center up">Telefono Madre</td>
		</tr>
		@foreach ($estudiantes as $estudiante)
			<tr>
				<td class="text-center"> {{$loop->index+1}} </td>
				<td>
					{{$estudiante->apellidos}} {{$estudiante->nombres}}
				</td>
				<td> 
					{{$estudiante->course->grado}} {{$estudiante->course->especializacion}} {{$estudiante->course->paralelo}} 
				</td>
				<td> 
					{{$estudiante->direccion}} 
				</td>
                <td class="text-center"> {{$estudiante->representante->movil}} </td>
                <td>{{$estudiante->representante->nombres}} {{$estudiante->representante->apellidos}} </td>
				@if ($estudiante->idPadre == null)
					<td></td>
				@else
					@php
						$padre = $padres->where('id', $estudiante->idPadre)->first()
					@endphp
					<td class="text-center">
                        @if ($padre != null)
                            {{$padre->movil}}
                        @endif
                    </td>
				@endif
				@if ($estudiante->idMadre==null)
					<td></td>
				@else
					@php
						$madre = $madres->where('id', $estudiante->idMadre)->first()
					@endphp
					<td class="text-center">
                        @if ($madre != null)
                            {{$madre->movil}}
                        @endif
					</td>
				@endif
			</tr>
		@endforeach
	</table>
</body>
</html>