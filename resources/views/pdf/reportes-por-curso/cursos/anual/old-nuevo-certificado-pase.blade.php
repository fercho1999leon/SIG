<!DOCTYPE html>
<html lang="es">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Certificado pase de año</title>
	<link rel="stylesheet" href="{{ secure_asset('css/pdf/pdf.css') }}">
</head>
<style>
	p {
		font-size: 18px;
	}
</style>
<body>
	<main>
	@foreach($students as $student)
		@include('partials.encabezados.certificado', [
			'reportName' => 'pase de año'
		])
		<p>La suscrita Rectoría de la <span class="uppercase">{{ $institution->nombre }}</span><br>
		A petición de la parte interesada certifica que
			@if( $student->sexo=='Masculino' )
				el estudiante:
			@else
				la estudiante:
			@endif
		</p>
		<br>
		<h3 class="text-center bolf uppercase">{{ $student->apellidos }} {{ $student->nombres }}</h3>
		<table class="table">

			@if( $proyecto!=null)
			<tr style="display: none">
				<td class="uppercase">{{ $proyecto->area }}</td>
				<td>{{ $proyecto->nombre }}</td>
				<td class="text-center uppercase">ex</td>
				<td style="font-size:8px">Demuestra destacado desempeño en cada fase del desarrollo del proyecto escolar lo que constituye un excelente aporte
					a su formación integral</td>
			</tr>
			@endif

			<tr style="display: none">
				<td  class="text-center uppercase bold">PROMEDIO</td>
				<td  class="text-center uppercase"></td>
				<td  class="text-center uppercase">{{ bcdiv( $pPromediosTotalFinal[$student->idStudent]/count($materiasFijas), '1', 2) }}</td>
				<td  class="text-center uppercase"></td>
			</tr>
			<tr style="display: none">
				<td  class="text-center uppercase bold">COMPORTAMIENTO</td>
				<td  class="text-center uppercase"></td>
				<td  class="text-center uppercase">
					@if($student->p3q2C!=null)
						{{ $student->p3q2C }}
					@elseif($student->p2q2C!=null)
						{{ $student->p2q2C }}
					@elseif($student->p1q2C!=null)
						{{ $student->p1q2C }}
					@elseif($student->p3q1C!=null)
						{{ $student->p3q1C }}
					@elseif($student->p2q1C!=null)
						{{ $student->p2q1C }}
					@else
						{{ $student->p1q1C }}
					@endif
				</td>
				<td  class="text-center uppercase">
				</td>
			</tr>
		</table>
		<br>
		@if( $aprobados[$student->idStudent])
				<p>Aprobó el <span class="uppercase"> {{ $educacion }}</span>
				@if( $curso->grado != 'Tercero de Bachillerato')
				siendo promovido al
				@endif
				{{ $gradoSiguiente }}</p>
			<p>Asistiendo normalmente a clases y obteniendo una calificación global en:</p>
			<br>
			<table class="table">
				<tr>
					<td style="font-size:16px" class="bold uppercase no-border text-right" width="48%">aprovechamiento:</td>
					<td class="no-border"></td>
					<td style="font-size:16px" class="bold uppercase no-border text-left" width="48%">{{ bcdiv( $pPromediosTotalFinal[$student->idStudent]/count($materiasFijas), '1', 2) }}</td>
				</tr>
				<tr>
					<td style="font-size:16px" class="bold uppercase no-border text-right">disciplina:</td>
					<td class="no-border"></td>
					<td style="font-size:16px" class="bold uppercase no-border text-left">
						@if($student->p3q2C!=null)
							{{ $student->p3q2C }}
						@elseif($student->p2q2C!=null)
							{{ $student->p2q2C }}
						@elseif($student->p1q2C!=null)
							{{ $student->p1q2C }}
						@elseif($student->p3q1C!=null)
							{{ $student->p3q1C }}
						@elseif($student->p2q1C!=null)
							{{ $student->p2q1C }}
						@else
							{{ $student->p1q1C }}
						@endif
					</td>
				</tr>
			</table>
			<p>Además hacemos constar que los documentos del estudiante están en trámite por legalización en la Dirección Distrital.</p>
			<p> Asi consta en los libros de calificaciones de la Secretaría del Plantel.</p>
			<p>Certificación que se hace en honor a la verdad, para los fines pertinentes.</p>
			<br>
			<p class="text-right">{{ $institution->ciudad }}, {{ $fechaA }}</p>
			<br>
			<br>
			<br>
			<br>
			<br>
			<br>
			<br>
		@else
			<p>No Aprobó el <span class="uppercase"> {{ $educacion }} </span> teniendo que repetir el {{ $educacion }}</p>
			<p>Asistiendo normalmente a clases y obteniendo una calificación global en:</p>
			<br>
			<table class="table">
				<tr>
					<td style="font-size:16px" class="bold uppercase no-border text-right" width="48%">aprovechamiento:</td>
					<td class="no-border"></td>
					<td style="font-size:16px" class="bold uppercase no-border text-left" width="48%">{{ bcdiv( $pPromediosTotalFinal[$student->idStudent]/count($materiasFijas), '1', 2) }}</td>
				</tr>
				<tr>
					<td style="font-size:16px" class="bold uppercase no-border text-right">disciplina:</td>
					<td class="no-border"></td>
					<td style="font-size:16px" class="bold uppercase no-border text-left">
						@if($student->p3q2C!=null)
							{{ $student->p3q2C }}
						@elseif($student->p2q2C!=null)
							{{ $student->p2q2C }}
						@elseif($student->p1q2C!=null)
							{{ $student->p1q2C }}
						@elseif($student->p3q1C!=null)
							{{ $student->p3q1C }}
						@elseif($student->p2q1C!=null)
							{{ $student->p2q1C }}
						@else
							{{ $student->p1q1C }}
						@endif
					</td>
				</tr>
			</table>
			<p>Además hacemos constar que los documentos del estudiante están en trámite por legalización en la Dirección Distrital.</p>
			<p> Asi consta en los libros de calificaciones de la Secretaría del Plantel.</p>
			<p>Certificación que se hace en honor a la verdad, para los fines pertinentes.</p>
			<br>
			<p class="text-right">{{ $institution->ciudad }}, {{ $fechaA }}</p>
			<br>
			<br>
			<br>
			<br>
			<br>
			<br>
			<br>
		@endif
		<div class="row">
			<div class="col-xs-6 p-0 text-center ">
				<hr class="certificado__hr">
				<p class="uppercase">
					{{ $institution->representante1 }} <br> RECTOR
				</p>
			</div>
			<div class="col-xs-6 p-0 text-center">
				<hr class="certificado__hr">
				<p class="uppercase">
					{{ $institution->representante2 }} <br> secretaria general
				</p>
			</div>
		</div>
		<div style="page-break-after:always;"></div>
	@endforeach
	</main>
</body>
</html>