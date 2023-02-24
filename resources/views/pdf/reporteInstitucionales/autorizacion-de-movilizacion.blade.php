<!DOCTYPE html>
<html lang="es">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Reporte Autorización de Movilización Estudiantil</title>
	<link rel="stylesheet" href="{{ secure_asset('css/pdf/pdf.css') }}">
</head>
<style>
.table td,
.table th {
		font-size: 8pt !important;
		padding: 8px !important;
 	}
</style>
<body>
	<table class="table">
		<tr>
			<th style="vertical-align:top" class="no-border" width="20%">
				<div class="header__logo" style="float: left">
					<img @if(DB::table('institution')->where('id', '1')->first()->logo == null)src="{{ secure_asset('img/logo/logo.png') }}" @else src="{{ secure_asset('/storage/logo/'.DB::table('institution')->where('id', '1')->first()->logo) }}" @endif width="90" alt="" >
				</div>
			</th>
			<th class="no-border" width="60%">
				<div class="header__info text-center">
					<h3 class="m-0 h1 uppercase"> {{$institution->nombre}} </h3>
					<h4 class="m-0 up">
						Autorización de Movilización Estudiantil
					</h4>
					<h4 class="m-0 bold uppercase"><small> año lectivo {{App\Institution::periodoLectivo()}} </small> </h4>
				</div>
			</th>
			<th class="no-border" width="20%">
			</th>
		</tr>
	</table>
	<table class="table">
		<tr>
			<td colspan="2" class="no-border text-center">DATOS DEL ESTUDIANTE</td>
		</tr>
		<tr>
			<td colspan="2">
				{{$student->apellidos}} {{$student->nombres}} <br>
				<p class="bold" style="font-size:7pt">APELLIDOS Y NOMBRES</p>
			</td>
		</tr>
		<tr>
			<td width="50%">
				{{$student->course->grado}} {{$student->course->especializacion}}<br>
				<p class="bold" style="font-size:7pt">GRADO/CURSO</p>
			</td>
			<td width="50%">
				{{$student->course->paralelo}} <br>
				<p class="bold" style="font-size:7pt">PARALELO</p>
			</td>
		</tr>
		<tr>
			<td>
				{{$student->telefono_movil}}<br>
				<p class="bold" style="font-size:7pt">TELÉFONO</p>
			</td>
			<td>
				{{$student->direccion_domicilio}}<br>
				<p class="bold" style="font-size:7pt">DIRECCIÓN</p>
			</td>
		</tr>
	</table>
	<table class="table">
		<tr>
			<td colspan="2" class="no-border text-center">DATOS DEL REPRESENTANTE Y/O PADRE MADRE DE FAMILIA</td>
		</tr>
		<tr>
			<td colspan="2">
				{{$student->representante->apellidos}} {{$student->representante->nombres}} <br>
				<p class="bold" style="font-size:7pt">APELLIDOS Y NOMBRES</p>
			</td>
		</tr>
		<tr>
			<td width="50%">
				{{$student->representante->tDomicilio}}<br>
				<p class="bold" style="font-size:7pt">TELÉFONO DOMICILIO</p>
			</td>
			<td width="50%">
				{{$student->representante->movil}}<br>
				<p class="bold" style="font-size:7pt">TELÉFONO CELULAR</p>
			</td>
		</tr>
		<tr>
			<td colspan="2">
				{{$student->representante->dDomicilio}}<br>
				<p class="bold" style="font-size:7pt">DIRECCIÓN</p>
			</td>
		</tr>
	</table>
	<table class="table">
		<tr>
			<td colspan="3" class="no-border text-center">DATOS PERSONALES DE LOS RESPONSABLES DEL TRASLADO DEL ESTUDIANTE</td>
		</tr>
		<tr>
			<td width="33%" class="text-center no-border">
				{{$student->student->transporte->es_privado === 0 ? 'X' : ''}}
				<br>
				<span style="padding: 0 15px;border-top:black solid 1px;margin-top:3px">
					Expreso Escolar
				</span>
			</td>
			<td width="33%" class="text-center no-border">
				{{$student->student->transporte->es_privado === 1 ? 'X' : ''}}
				<br>
				<span style="padding: 0 15px;border-top:black solid 1px;margin-top:3px">
					Expreso Privado
				</span>
			</td>
			<td width="33%" class="text-center no-border">
				{{$student->se_va_solo === 1 ? 'X' : ''}}
				<br>
				<span style="padding: 0 15px;border-top:black solid 1px;margin-top:3px">
					Se va solo
				</span>
			</td>
		</tr>
	</table>
	@foreach ($personasAutorizadas as $user)
		<table class="table">
			<tr>
				<td colspan="2" class="text-center">PERSONA AUTORIZADA NO.{{$loop->index+1}}</td>
			</tr>
			<tr>
				<td colspan="2">
					{{$user->nombres}}<br>
					<p class="bold" style="font-size:7pt">APELLIDOS Y NOMBRES</p>
				</td>
			</tr>
			<tr>
				<td>
					{{$user->telefono_domicilio}}<br>
					<p class="bold" style="font-size:7pt">TELEFONO DOMICILIO</p>
				</td>
				<td>
					{{$user->telefono_celular}}<br>
					<p class="bold" style="font-size:7pt">TELEFONO CELULAR</p>
				</td>
			</tr>
			<tr>
				<td colspan="2">
					{{$user->direccion}}<br>
					<p class="bold" style="font-size:7pt">DIRECCIÓN</p>
				</td>
			</tr>
		</table>
	@endforeach
	<br>
	<br>
	<br>
	<table class="table">
		<tr>
			<td class="bold no-border text-center">
				<span style="display:inline-block;width:250px;border-top:black solid 1px;margin-top:3px">
					FIRMA DEL REPRESENTANTE LEGAL
				</span>
			</td>
		</tr>
	</table>
</body>

</html>