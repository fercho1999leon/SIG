<!DOCTYPE html>
<html lang="es">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Hoja de vida</title>
	<link rel="stylesheet" href="{{ secure_asset('css/bootstrap.min.css') }}">
	<link rel="stylesheet" href="{{ secure_asset('css/pdf/pdf.css') }}">
</head>
<body class="hdVida__body">
	<main>
		<img @if(DB::table('institution')->where('id', '1')->first()->logo == null) src="{{ secure_asset('img/logo/logo.png') }}"                  @else                     src="{{ secure_asset('/storage/logo/'.DB::table('institution')->where('id', '1')->first()->logo) }}"                                  @endif style="position: absolute" width="80" alt="">
		<header class="hdVida__header text-center">
			<p class="uppercase bold">{{ $institution->nombre}}</p>
			<p>Año lectivo: {{App\Institution::periodoLectivo()}} </p>
			<p>Matrícula No: {{ $estudiante->numero_matriculacion}}</p>
			<p>
				@if ($estudiante->fecha_matriculacion != null)
					{{ $estudiante->fecha_matriculacion->format('d/m/Y')}}
				@else
					-
				@endif
			</p>
		</header>
		<br>
		<br>
		<br>
		<table class="hdVida__table">
			<tr>
				<td colspan="3" class="text-center bg-none">
					<strong>DATOS DEL ESTUDIANTE</strong> 
				</td>
			</tr>
			<tr>
				<td colspan="3">
					<strong>Nombre</strong>:
					<span class="uppercase">
						@if( $estudiante->apellidos!=null )
							{{ $estudiante->apellidos }}
							@if( $estudiante->nombres!=null)
								{{ $estudiante->nombres }}
							@endif
						@endif
					</span>
				</td>
			</tr>
			<tr>
				<td colspan="2">
					<strong>Grado / Curso:</strong>
					<span class="uppercase">{{ $course->grado }}</span>
				</td>
			</tr>
			<tr>
				<td colspan="2">
					<strong>Domicilio</strong>:
					<span class="uppercase">{{ $estudiante->direccion_domicilio }}</span>
				</td>
				<td>
					<strong>Teléfonos: </strong>{{ $estudiante->telefono_movil }}</td>
			</tr>
			<tr>
				<td>
					<strong>Fecha de nacimiento:</strong> {{ $estudiante->fechaNacimiento }} </td>
				<td>
					@php
						$edad = Carbon\Carbon::createFromFormat('Y-m-d', $estudiante->fechaNacimiento)->diff(Carbon\Carbon::now())->format('%y años');
					@endphp
					<strong>Edad:</strong> {{ $edad }} </td>
				<td>
					<strong>C.I.No.:</strong> {{ $estudiante->ci }} </td>
			</tr>
			<tr>
				<td>
					<strong>Grado/Curso anterior: 
						@if ($gradoAnterior != null)
							{{App\Course::nombreCurso($gradoAnterior->course)}}
						@else
							-
						@endif
					</strong> </td>
				<td>
					<strong>Último año de estudio:</strong>
					@if ($gradoAnterior != null)
						{{App\Course::nombreCurso($gradoAnterior->course)}}
					@else
						-
					@endif
				</td>
				<td>
					<strong>Con Quién Vive:</strong>
					<span class="uppercase">{{$estudiante->con_quien_vive}}</span>
				</td>
			</tr>
			<tr>
				<td>
					<strong>Est. Civ. Padres:</strong>
					<span class="uppercase">{{$estudiante->estado_civil_padres}}</span>
				</td>
				<td>
					<strong>Movilización:</strong>
					<span class="uppercase">{{$estudiante->transporte->id != null ? 'Si' : 'No'}}</span>
				</td>
			</tr>
			<tr>
				<td colspan="2">
					<strong>Motivo cambio Institución:</strong> {{ $estudiante->razonCambio }} </td>
				<td>
					<strong>Discapacidad:</strong>
					@if ($estudiante->discapacidad != null)
						{{$estudiante->discapacidad}} 
						% {{$estudiante->porcentaje_discapacidad}} 
					@endif
				</td>
			</tr>
			<tr>
				<td>
					<strong>Discp. Anterior:</strong>--</td>
				<td>
					<strong>Matrícula Condicionada:
						<span class="uppercase">{{$estudiante->condicionado}}</span>
					</strong>  
				</td>
				<td>
					<strong>Motivo:</strong>
					@if ($estudiante->bloqueos->isNotEmpty())
						@foreach ($estudiante->bloqueos as $bloqueo)
							{{$bloqueo->nombre}}, 
						@endforeach
					@else
						-
					@endif
				</td>
			</tr>
		</table>
		<table class="hdVida__table" style="margin-top: 10px;">
			<tr>
				<td colspan="3" class="text-center bg-none">
					<strong>DATOS DE PADRES Y REPRESENTANTE</strong>
				</td>
			</tr>
			<tr>
				<td colspan="2">
					<strong>Padre:</strong>
					<span class="uppercase">
						{{ $padre->nombres }} {{ $padre->apellidos }}
					</span>
				</td>
				<td>
					<strong>C.I:</strong>
					{{ $padre->ci }}
				</td>
			</tr>
			<tr>
				<td colspan="2">
					<strong>Domicilio:</strong>
					<span class="uppercase">
						@if( $padre->ciudadDomicilio!=null )
							{{ $padre->ciudadDomicilio }} - 
						@endif
						{{ $padre->direccionDomicilio }}
					</span>
				</td>
				<td>
					<strong>Teléfono:</strong>
					{{ $padre->telefonoDomicilio }}
				</td>
			</tr>
			<tr>
				<td>
					<strong>Email:</strong>
					{{ $padre->correo }}
				</td>
				<td colspan="2">
					<strong>Nacionalidad:</strong>
					{{ $padre->nacionalidad }}
				</td>
			</tr>
			<tr>
				<td colspan="2">
					<strong>Lugar de trabajo:</strong>
					<span class="uppercase">
						{{ $padre->lugarTrabajo }}
					</span>
				</td>
				<td>
					<strong>Teléfono:</strong>
					{{ $padre->telefonoTrabajo }}
				</td>
			</tr>
			<tr>
				<td colspan="2">
					<strong>Dir. Trabajo:</strong>
					<span class="uppercase">
						@if( $padre->ciudadTrabajo!=null )
							{{ $padre->ciudadTrabajo }} - 
						@endif
						{{ $padre->direccionTrabajo }}
					</span>
				</td>
				<td>
					<strong>Cargo Actividad:</strong>
					<span class="uppercase">
						{{ $padre->cargoTrabajo }}
					</span>
				</td>
			</tr>
			<tr>
				<td colspan="2">
					<strong>Estudios:</strong>
					<span class="uppercase">
						{{ $padre->estudios }}
					</span>
				</td>
				<td>
					<strong>Religión:</strong>
					<span class="uppercase">
						{{ $padre->religion }}
					</span>
				</td>
			</tr>
			<tr>
				<td class="no-border" colspan="3">
					<span style="visibility: hidden">-</span>
				</td>
			</tr>
			<tr>
				<td colspan="2">
					<strong>Madre:</strong>
					<span class="uppercase">
						{{ $madre->nombres }} {{ $madre->apellidos }}
					</span>
				</td>
				<td>
					<strong>C.I:</strong>
					{{ $madre->ci }}
				</td>
			</tr>
			<tr>
				<td colspan="2">
					<strong>Domicilio:</strong>
					<span class="uppercase">
						@if( $madre->ciudadDomicilio!=null )
							{{ $madre->ciudadDomicilio }} - 
						@endif
						{{ $madre->direccionDomicilio }}
					</span>
				</td>
				<td>
					<strong>Teléfono:</strong>
					{{ $madre->telefonoDomicilio }}
				</td>
			</tr>
			<tr>
				<td>
					<strong>Email:</strong>
					{{ $madre->correo }}
				</td>
				<td colspan="2">
					<strong>Nacionalidad:</strong>
					{{ $madre->nacionalidad }}
				</td>
			</tr>
			<tr>
				<td colspan="2">
					<strong>Lugar de trabajo:</strong>
					<span class="uppercase">
						{{ $madre->lugarTrabajo }}
					</span>
				</td>
				<td>
					<strong>Teléfono:</strong>
					{{ $madre->telefonoTrabajo }}
				</td>
			</tr>
			<tr>
				<td colspan="2">
					<strong>Dir. Trabajo:</strong>
					<span class="uppercase">
						@if( $madre->ciudadTrabajo!=null )
							{{ $madre->ciudadTrabajo }} - 
						@endif
						{{ $madre->direccionTrabajo }}
					</span>
				</td>
				<td>
					<strong>Cargo Actividad:</strong>
					<span class="uppercase">
						{{ $madre->cargoTrabajo }}
					</span>
				</td>
			</tr>
			<tr>
				<td colspan="2">
					<strong>Estudios:</strong>
					<span class="uppercase">
						{{ $madre->estudios }}
					</span>
				</td>
				<td>
					<strong>Religión:</strong>
					<span class="uppercase">
						{{ $madre->religion }}
					</span>
				</td>
			</tr>
			<tr>
				<td class="no-border" colspan="3">
					<span style="visibility: hidden">-</span>
				</td>
			</tr>
			<tr>
				<td colspan="2">
					<strong>Representante:</strong>
					<span class="uppercase">
						{{ $representante->apellidos }} {{ $representante->nombres }}
					</span>
				</td>
				<td>
					<strong>C.I.No.:</strong>
					{{ $representante->ci }}
				</td>
			</tr>
			<tr>
				<td>
					<strong>Correo:</strong>
					<span class="uppercase">
						{{ $representante->correo }}
					</span>
				</td>
				<td>
					<strong>Fecha Nacimiento:</strong>
					{{ $representante->fNacimiento }}
				</td>
				<td>
					<strong>Sexo:</strong>
					{{ $representante->sexo }}
				</td>
			</tr>
			<tr>
				<td colspan="2">
					<strong>Domicilio:</strong>
					<span class="uppercase">
						{{ $representante->dDomicilio }}
					</span>
				</td>
				<td>
					<strong>Teléfono:</strong>
					{{ $representante->movil }}
				</td>
			</tr>
		</table>
		<br>
		<br>
		<br>
		<div class="row">
		<div class="col-xs-6 p-0 text-center ">
			<hr class="certificado__hr">
			<p class="uppercase">
				{{ $institution->representante2 }}
			</p>
			<p style="font-size:12px">
				{{ $institution->cargo2 }}
			</p>
		</div>
		<div class="col-xs-6 p-0 text-center">
			<hr class="certificado__hr">
			<p class="uppercase">
				@if( $representante!=null )
					{{ $representante->apellidos }} {{$representante->nombres}}
				@endif
			</p>
			<p style="font-size:12px">
				Representante
			</p>
		</div>
	</main>
</body>

</html>