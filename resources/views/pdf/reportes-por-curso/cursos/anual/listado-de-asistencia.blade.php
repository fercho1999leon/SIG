<!DOCTYPE html>
<html lang="es">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link rel="stylesheet" href=" {{secure_asset('css/pdf/pdf.css')}} ">
	<title>Listado de Asistencia</title>
</head>

<body class="actaCalificacionesParcial">

		<div class="container">
			<div class="row text-center m-3">
				<img class="img-fluid w-50" src="{{ secure_asset('img/logo/logoSolicitud.png') }}" alt="" style="opacity: 0.7;">
			</div>
			<div class="row text-center m-3">
				<div class="col-12 m-3">
					<h3 class="h3 text-uppercase textoSubtitle" style="color: darkblue;">Reporte de Asistencia</h3>
				</div>
				<div class="col-12 m-3 float-right">

				</div>
			</div>
		</div>
		
	<br>
	<section class="actaCalificacionesParcial__section">
		<h3 class="up">CURSO: {{ $course->grado }} {{ $course->paralelo }} - {{ $course->especializacion }}</h3>
		<br>
		<table class="table">
			<tr height="150">
				<td class="text-center">No.</td>
				<td class="text-center">Nombre</td>
				<td class="text-center">
					<p class="s-calificaciones__materia">
						<span class="bold up" style="position: relative;right: 62px;">TRANSPORTE</span>
					</p>
				</td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
			</tr>
			@foreach($students as $student)
			<tr>
				<td class="text-center">{{ $count++ }}</td>
				<td class="up">
					{{ $student->apellidos}} {{ $student->nombres}}
					<span style="display: none">
						@if($student->sexo == 'Masculino') 
							{{$studentsM++}}
						@else 
							{{$studentsF++}} 
						@endif
					</span>
				</td>
				<td class="text-center"> 
					@if ($student->transporte != null)
						{{ $student->transporte->unidad }} 
					@endif
				</td>
				<td width="15"></td>
				<td width="15"></td>
				<td width="15"></td>
				<td width="15"></td>
				<td width="15"></td>
				<td width="15"></td>
				<td width="15"></td>
				<td width="15"></td>
				<td width="15"></td>
				<td width="15"></td>
				<td width="15"></td>
				<td width="15"></td>
				<td width="15"></td>
				<td width="15"></td>
				<td width="15"></td>
				<td width="15"></td>
				<td width="15"></td>
				<td width="15"></td>
				<td width="15"></td>
				<td width="15"></td>
				<td width="15"></td>
				<td width="15"></td>
				<td width="15"></td>
			</tr>
			@endforeach
			<tr>
				<td class="text-left vertical-align" colspan="2">{{ $studentsM }} <img src="{{secure_asset('img/hombreS.svg')}}" width="12" alt=""></td>
				<td colspan="24" class="text-left vertical-align">{{ $studentsF }} <img src="{{secure_asset('img/mujerS.svg')}}" width="12" alt=""></td>
			</tr>
		</table>
	</section>
</body>

</html>