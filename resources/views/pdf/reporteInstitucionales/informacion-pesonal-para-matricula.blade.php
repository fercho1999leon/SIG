<!DOCTYPE html>
<html lang="es">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Ficha de datos</title>
	<link rel="stylesheet" href="{{ secure_asset('css/bootstrap.min.css') }}">
	<link rel="stylesheet" href="{{ secure_asset('css/pdf/pdf.css') }}">
</head>
<style>
	.hdVida__table td,
	.hdVida__table th {
		font-size: 8pt !important;
	}
</style>
<body class="hdVida__body" style="padding:7.5px">
	<main>
		<img @if(DB::table('institution')->where('id', '1')->first()->logo == null)                     src="{{ secure_asset('img/logo/logo.png') }}"                  @else                     src="{{ secure_asset('/storage/logo/'.DB::table('institution')->where('id', '1')->first()->logo) }}"                                  @endif style="position: absolute" width="50" alt="">
		<header class="hdVida__header text-center">
			<p class="uppercase bold">{{ $institution->nombre}}</p>
			<p>Año lectivo: {{$periodo == null ? App\Institution::periodoLectivo() : $periodo->nombre}} </p>
			<p>Matrícula No: {{ $student->numero_matriculacion}}</p>
		</header>
		<br>
		<table class="hdVida__table" style="border:1px solid black;margin-top:5px">
			<tr>
				<td colspan="4" class="text-center bg-none">
					<strong>DATOS DEL ESTUDIANTE</strong>
				</td>
			</tr>
			<tr>
				@php 
				//dd($student->nombres);
				@endphp
				<td colspan="4">
					<strong>Nombres y Apellidos:</strong>
					<span class="uppercase">
						{{$student->apellidos}}  {{$student->nombres}}
					</span>
				</td>
			</tr>
			<!--<tr>
				<td>
					<strong>Grado / Curso:</strong>
					<span class="uppercase">
						{{$curso->grado}}  {{$curso->paralelo}} {{$curso->especializacion}}
					</span>
				</td>
				<td colspan="3">
					<span class="uppercase"></span>
				</td>
			</tr>-->

			<tr>
				<td colspan="2">
					<strong>Semestre / Paralelo:</strong>
					<span class="uppercase"> {{$curso->grado}} {{$curso->paralelo}}</span>
					<!--<span class="uppercase">{{$curso->grado}}  {{$curso->paralelo}}</span>-->
				</td>
				<td colspan="2">
					<strong>Carrera:</strong>
					<span class="uppercase">{{$carrera->nombre}}</span>
				</td>
			</tr>



			<tr>
				<td colspan="2">
					<strong>Domicilio:</strong>
					<span class="uppercase">{{$student->direccion_domicilio}}</span>
				</td>
				<td colspan="2">
					<strong>Teléfono domicilio:</strong>
					<span class="uppercase">{{$student->telefono_movil}}</span>
				</td>
			</tr>
			<tr>
				<td>
					<strong>Fecha de nacimiento:</strong>
					<span class="uppercase">{{$student->fechaNacimiento}}</span>
				</td>
				<td colspan="2">
					<strong>Edad:</strong>
					@php
						$edad = Carbon\Carbon::createFromFormat('Y-m-d', $student->fechaNacimiento)->diff(Carbon\Carbon::now())->format('%y años');
					@endphp
					{{$edad}}
					<span class="uppercase"></span>
				</td>
				<td>
					<strong>C.I:</strong>
					<span class="uppercase">{{$student->ci}}</span>
				</td>
			</tr>
			<tr>
				<td>
					<strong>Estado civil padres:</strong>
					<span class="uppercase">{{$student->estado_civil_padres}}</span>
				</td>
				<td>
					<strong>Movilización:</strong>
					<span class="uppercase">
						{{$student->transporte->id != null ? 'Si' : 'No'}}
					</span>
				</td>
				<td colspan="2">
					<strong>Con quién vive:</strong>
					<span class="uppercase">{{$student->con_quien_vive}}</span>
				</td>
			</tr>
			<tr>
				<td colspan="2">
					<strong>Institución Anterior:</strong>
					<span class="uppercase">{{$student->institucionAnterior}}</span>
				</td>
				<td colspan="2">
					<strong>Discapacidad:</strong>
					<span class="uppercase">
						@if ($student->discapacidad != null)
							{{$student->discapacidad}}
							% {{$student->porcentaje_discapacidad}}
						@endif
					</span>
				</td>
			</tr>
			<tr>
				<td colspan="4">
					<strong>Correo:</strong>
					<span class="uppercase">{{$student->student->profile->correo}}</span>
				</td>
			</tr>
			<tr>
				<td colspan="2">
					<strong>Disciplina o deporte que practica:</strong>
					<span class="uppercase">{{$student->disciplina_practica}}</span>
				</td>
				<td colspan="2">
					<strong>Actividad artística que practica:</strong>
					<span class="uppercase">{{$student->actividad_artistica}}</span>
				</td>
			</tr>
			<tr>
				<td>
					<strong>Enfermedades:</strong>
					<span class="uppercase">{{$student->enfermedad}}</span>
				</td>
				<td colspan="2">
					<strong>Alergias:</strong>
					<span class="uppercase">{{$student->alergias}}</span>
				</td>
				<td>
					<strong>Tipo de sangre:</strong>
					<span class="uppercase">{{$student->tipoSangre}}</span>
				</td>
			</tr>
			<tr>
				<td colspan="2">
					<strong>Inclusión:</strong>
					<span class="uppercase">{{$student->inclusion == 0 ? 'No' : 'Si'}}</span>
				</td>
				<td colspan="2">
					<strong>Seguro:</strong>
					<span class="uppercase">{{$student->seguro_institucional}}</span>
				</td>
			</tr>
			<tr>
				<td colspan="2">
					<strong>Contacto emergencia 1:</strong>
					<span class="uppercase">{{$student->nombre_contacto_emergencia}}</span>
				</td>
				<td colspan="2">
					<strong>Telefono contacto emergencia 1:</strong>
					<span class="uppercase">{{$student->movil_contacto_emergencia}}</span>
				</td>
			</tr>
			<tr>
				<td colspan="2">
					<strong>Contacto emergencia 2:</strong>
					<span class="uppercase">{{$student->nombre_contacto_emergencia2}}</span>
				</td>
				<td colspan="2">
					<strong>Telefono contacto emergencia 2:</strong>
					<span class="uppercase">{{$student->movil_contacto_emergencia2}}</span>
				</td>
			</tr>
		</table>
		<!--
		<table class="hdVida__table">
			<tr>
				<td colspan="3" class="text-center bg-none">
					<strong>DATOS DE PADRES Y REPRESENTANTE</strong>
				</td>
			</tr>
		</table>
		-->
		{{-- Datos del padre y de la madre --}}
		@foreach (['padre', 'madre'] as $padre)
		<!--
			<table class="hdVida__table" style="border:1px solid black;margin-top:5px;">
				<tr>
					<td class="bold" colspan="3">{{strToUpper($padre)}}</td>
				</tr>
				<tr>
					<td>
						<strong>Nombres:</strong>
						<span class="uppercase">
							{{$student[$padre]->apellidos}} {{$student[$padre]->nombres}}
						</span>
					</td>
					<td colspan="2">
						<strong>C.I:</strong> {{$student[$padre]->ci}}
					</td>
				</tr>
				<tr>
					<td>
						<strong>Domicilio:</strong>
						<span class="uppercase">
							{{$student[$padre]->direccionDomicilio}}
						</span>
					</td>
					<td colspan="2">
						<strong>Teléfono:</strong> {{$student[$padre]->movil}}
					</td>
				</tr>
				<tr>
					<td>
						<strong>Email:</strong> {{$student[$padre]->correo}}
					</td>
					<td colspan="2">
						<strong>Nacionalidad:</strong> {{$student[$padre]->nacionalidad}}
					</td>
				</tr>
				<tr>
					<td>
						<strong>Lugar de trabajo:</strong>
						<span class="uppercase">
							{{$student[$padre]->lugarTrabajo}}
						</span>
					</td>
					<td colspan="2">
						<strong>Teléfono:</strong> {{$student[$padre]->telefonoTrabajo}}
					</td>
				</tr>
				<tr>
					<td>
						<strong>Dir. Trabajo:</strong>
						<span class="uppercase">
							{{$student[$padre]->direccionTrabajo}}
						</span>
					</td>
					<td colspan="2">
						<strong>Cargo Actividad:</strong>
						<span class="uppercase">
							{{$student[$padre]->cargoTrabajo}}
						</span>
					</td>
				</tr>
				<tr>
					<td>
						<strong>Estudios:</strong>
						<span class="uppercase">
							{{$student[$padre]->estudios}}
						</span>
					</td>
					<td colspan="2">
						<strong>Religión:</strong>
						<span class="uppercase">
							{{$student[$padre]->religion}}
						</span>
					</td>
				</tr>
				<tr>
					<td>
						<strong>Estado civil:</strong>
						<span class="uppercase">
							{{$student[$padre]->estado_civil}}
						</span>
					</td>
					<td>
						<strong>Profesión:</strong>
						<span class="uppercase">
							{{$student[$padre]->profesion}}
						</span>
					</td>
					<td>
						<strong>Fecha Nacimiento:</strong>
						<span class="uppercase">
							{{$student[$padre]->fNacimiento}}
						</span>
					</td>
				</tr>
			</table>
		-->
		@endforeach
		<!--
		<table class="hdVida__table" style="border:1px solid black;margin-top:5px;">
			<tr>
				<td colspan="4" class="bold">Representante Legal</td>
			</tr>
			<tr>
				<td colspan="2">
					<strong>Nombres:</strong>
					<span class="uppercase">
						{{$student->representante->apellidos}} {{$student->representante->nombres}}
					</span>
				</td>
				<td colspan="2">
					<strong>C.I:</strong>  {{$student->representante->ci}}
				</td>
			</tr>
			<tr>
				<td colspan="2">
					<strong>Correo:</strong>
					{{$student->representante->correo}}
				</td>
				<td>
					<strong>Fecha Nacimiento:</strong> {{$student->representante->fNacimiento}}
				</td>
				<td>
					<strong>Sexo:</strong> {{$student->representante->sexo}}
				</td>
			</tr>
			<tr>
				<td colspan="2">
					<strong>Domicilio:</strong>
					<span class="uppercase">{{$student->representante->dDomicilio}}</span>
				</td>
				<td colspan="2">
					<strong>Teléfono:</strong> {{$student->representante->movil}}
				</td>
			</tr>
		</table>
		-->
		<!--
		<table class="hdVida__table" style="border:1px solid black;margin-top:5px;">
			<tr>
				<td class="bold" colspan="2">Representante Financiero</td>
			</tr>
			<tr>
				<td>
					<strong>Nombres</strong> {{$student->cliente->apellidos}} {{$student->cliente->nombres}}
					<span class="uppercase">
					</span>
				</td>
				<td>
					<strong>C.I:</strong> {{$student->cliente->cedula_ruc}}
				</td>
			</tr>
			<tr>
				<td>
					<strong>Correo:</strong> {{$student->cliente->correo}}
				</td>
				<td>
					<strong>Fecha Nacimiento:</strong> {{$student->cliente->fecha_nacimiento}}
				</td>
			</tr>
			<tr>
				<td>
					<strong>Domicilio:</strong>
					<span class="uppercase">{{$student->cliente->direccion}}</span>
				</td>
				<td>
					<strong>Teléfono:</strong> {{$student->cliente->telefono}}
				</td>
			</tr>
		</table>
		-->
		<br>
		<br>
		<div class="row">
		<div class="col-xs-6 p-0 text-center">
			<hr class="certificado__hr">
			<p class="uppercase bold">
				{{ $institution->representante2 }}
			</p>
			<p style="font-size:10px" class= "bold">
				{{ $institution->cargo2 }}
			</p>
		</div>
		<div class="col-xs-6 p-0 text-center">
			<hr class="certificado__hr">
			<p class="uppercase bold">
				{{$student->representante->apellidos}} {{$student->representante->nombres}}
			</p>
			<p style="font-size:10px" class="bold">
				Representante
			</p>
		</div>

	</main>
</body>

</html>