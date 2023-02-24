<!DOCTYPE html>
<html lang="es">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Reporte Destrezas</title>
	<link rel="stylesheet" href="{{ secure_asset('css/pdf/pdf.css') }}">
</head>
<body>
	<main>
		@foreach($students as $student)
			@include('partials.encabezados.libreta-formato-vertical', [
				'reportName' => 'Reporte Destreza', 
				'seccion' => $seccion,
				'nQuimestre' => $nQuimestre, 
				'parcial' => $n_parcial,
				'quimestre' => $nQuimestre,
			])
			<section class="section">
				<table class="table">
					<tr>
						<td width="50" class="uppercase bold bgDark text-right">Estudiante</td>					
						<td class="uppercase">{{ $student->nombres }} {{ $student->apellidos }}</td>
						<td class="uppercase bold bgDark text-right" width="50">Curso</td>
						<td class="uppercase">{{ $course->grado }} - {{ $course->paralelo }}</td>
						<td class="uppercase bold bgDark text-right" width="50">Tutor</td>
						<td class="uppercase">
							@if($tutor != null)
								{{ $tutor->apellidos }} {{ $tutor->nombres }}
							@endif
						</td>
					</tr>
				</table>
				<table class="table">
					<tr>
						<td class="text-center uppercase bold bgDark">Destrezas</td>
						<td colspan="4" class="text-center uppercase bold bgDark">Quimestre {{ $nQuimestre }} - Parcial {{ $n_parcial }}</td>
					</tr>
					@foreach($matters as $matter)
						<tr>
							<td class="bold">{{ $matter->nombre}}</td>
							<td class="text-center">I</td>
							<td class="text-center">EP</td>
							<td class="text-center">A</td>
							<td class="text-center">N/E</td>
						</tr>
						@if(count($destrezas->where('id', $matter->id) ) > 0)
							@foreach($destrezas->where('id', $matter->id) as $destreza)
								<tr>
									@if($destreza->descripcion != null)
										<td class="uppercase bold">{{ $destreza->nombre }}</td>
									@else
										<td class="uppercase">-</td>
									@endif
									@php
										$jsonSupply = json_decode( $destreza->calificacion ); 
										$notaDestreza = "";
										foreach($jsonSupply as $key => $json){
											if($key == $student->id)
												$notaDestreza = $json;
										}
									@endphp
									<td class="text-center">
										@if($notaDestreza == "I") X @endif
									</td>
									<td class="text-center">
									@if($notaDestreza == "EP") X @endif
									</td>
									<td class="text-center">
									@if($notaDestreza == "A") X @endif
									</td>
									<td class="text-center">
									@if($notaDestreza == "N/E") X @endif
									</td>
								</tr>
								@endforeach
							<tr height="15">
								<td colspan="5" class="no-border"></td>
							</tr>
						@else
							<tr>
								<td colspan="5">Esta clase no tiene destrezas Asignadas</td>
							</tr>
							<tr height="10">
								<td class="no-border"></td>
							</tr>
						@endif
					@endforeach				
				</table>
				@php $estudiante = $estudiantes->where('idStudent', $student->id)->first(); @endphp
				<table class="table w100">
					<tr>
						<td colspan="2" class="text-center bold uppercase bgDark">Escala de Evaluación de Destrezas(Educación Inicial)</td>
						<td width="10" class="no-border"></td>
						<td colspan="2" class="text-center bold uppercase bgDark">Asistencia</td>
					</tr>
					<tr>
						<td width="10%" class="text-center bold">I</td>
						<td width="10%">Iniciada</td>
						<td class="no-border"></td>
						<td width="15%">Faltas justificadas</td>
						<td width="10%">
							@if($estudiante->asistenciaParcial($parcial))
								{{$estudiante->asistenciaParcial($parcial)['faltas_justificadas']}}
							@else
								0
							@endif
						</td>
					</tr>
					<tr>
						<td class="text-center bold">EP</td>
						<td>En Proceso</td>
						<td class="no-border"></td>
						<td>Faltas Injustificadas</td>
						<td>
							@if($estudiante->asistenciaParcial($parcial))
								{{$estudiante->asistenciaParcial($parcial)['faltas_injustificadas']}}
							@else
								0
							@endif
						</td>
					</tr>
					<tr>
						<td class="text-center bold">A</td>
						<td>Adquirida</td>
						<td class="no-border"></td>
						<td>Atrasos</td>
						<td>
							@if($estudiante->asistenciaParcial($parcial))
								{{$estudiante->asistenciaParcial($parcial)['atrasos']}}
							@else
								0
							@endif
						</td>
					</tr>
				</table>
				@if ($student["{$parcial}R"] || $student["{$parcial}O"] != null)
				<table class="table">
					<tr>
						<td colspan="2" class="bgDark text-center uppercase bold">Recomendaciones</td>
					</tr>
				</table>
				@endif
				@if ($student["{$parcial}R"])
					<table class="table">
						<tr>
							<td width="20" class="uppercase bold text-center no-border"style="padding-bottom:5px"  >Recomendaciones:  </td>
							<td class="borderBottom p-0">
								{{$student["{$parcial}R"]}}
							</td>
						</tr>
					</table>				
				@endif
				@if ($student["{$parcial}O"])
					<table class="table">
						<tr>
							<td width="20" class="uppercase bold text-center no-border"style="padding-bottom:5px"  >Observaciones:  </td>
							<td class="borderBottom p-0">
								{{$student["{$parcial}O"]}}
							</td>
						</tr>
					</table>
				@endif
				<br>
				<br>
				<br>
				<br>
				<div class="row">
					<div class="col-xs-6 p-0 text-center ">
						<hr class="certificado__hr">
						<p class="uppercase bold">
						@if($tutor != null)
							{{ $tutor->apellidos }} {{ $tutor->nombres }}
						@endif
						<br> TUTOR
						</p> 
					</div>
					<div class="col-xs-6 p-0 text-center">
						<hr class="certificado__hr">
						<p class="uppercase bold">
						@if($representantes->where('id', $student->idRepresentante)->first() != null)
							{{ $representantes->where('id', $student->idRepresentante)->first()->apellidos }} {{ $representantes->where('id', $student->idRepresentante)->first()->nombres }} <br> REPRESENTANTE
						@endif
						</p> 
					</div>
				</div>
			</section>
			<div style="page-break-after:always;"></div>
        @endforeach
	</main>
</body>

</html>