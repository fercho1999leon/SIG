<!DOCTYPE html>
<html lang="es">
@php
	use Carbon\Carbon;
	use App\Rubro;
@endphp
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link rel="stylesheet" href="{{ secure_asset('css/pdf/pdf.css') }}">
	<title>Pagos por curso(Rubros)</title>
</head>

<body>
	@include('partials.encabezados.reporte-institucional', ['reportName' => 'Pagos por curso'])
		<table class="table m-0">
			<tr height="150">
				<td class="text-center" width="5">#</td>
				<td class="text-center uppercase">Apellidos y nombres del estudiante</td>
				@foreach ($course->pagos as $pago)
					@php		
						$nombreMes = "";
						$mes = $pago->mes;
						switch($pago->mes){
							case 1:
								$nombreMes = 'ENERO';
							break;
							case 2:
								$nombreMes = 'FEBRERO';
							break;
							case 3:
								$nombreMes = 'MARZO';
							break;
							case 4:
								$nombreMes = 'ABRIL';
							break;
							case 5:
								$nombreMes = 'MAYO';
							break;
							case 6:
								$nombreMes = 'JUNIO';
							break;
							case 7:
								$nombreMes = 'JULIO';
							break;
							case 8:
								$nombreMes = 'AGOSTO';
							break;
							case 9:
								$nombreMes = 'SEPTIEMBRE';
							break;
							case 10:
								$nombreMes = 'OCTUBRE';
							break;
							case 11:
								$nombreMes = 'NOVIEMBRE';
							break;
							case 12:
								$nombreMes = 'DICIEMBRE';
							break;
						}
						$rubro = Rubro::find($pago->idRubro);        

					@endphp
					<td class="text-right uppercase">
						<p class="s-calificaciones__materia libretaQuimestralPorCurso__nombres">
							<span class="up bold">{{ $nombreMes }} - {{ $rubro->tipo_rubro }} ({{$pago->descripcion}})</span>
						</p>
					 </td>
				@endforeach
			</tr>
			@foreach($students as $student)
				<tr>
					<td class="text-center">{{ $loop->iteration }}</td>
					<td class="uppercase">{{ $student->apellidos }} {{ $student->nombres }}</td>
					@foreach ($course->pagos as $pago)
						@php		
							$pagoEstudiante = $student->pagos->where('idPago', $pago->id)->first();
						@endphp
						<td class="text-center">
							{{$pagoEstudiante->estado}}
						</td>
					@endforeach
				</tr>
			@endforeach
		</table>
		<div style="page-break-after:always;"></div>
</body>
</html>