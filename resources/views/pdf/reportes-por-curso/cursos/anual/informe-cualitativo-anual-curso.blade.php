<!DOCTYPE html>
<html lang="es">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Informe Cualitativo</title>
	<link rel="stylesheet" href="{{ secure_asset('css/pdf/pdf.css') }}">
</head>

<body class="informeCualitativo">
	<main>
    @foreach($students as $student)
		
	@php
	$acumulado_atrasos = 0;
	$acumulado_faltas =0;
	$acumulado_faltasInjustificadas =0;
	$n_m = 1;
    $notas = $data->where('estudianteId',$student->id)->first();
    @endphp
		<div class="container">
			@if($institution->ruc=='0992636009001')
			@include('partials.encabezados.informe-cualitativo-final-novus', [
				'reportName' => 'Informe Cualitativo',
				'informe' => $informe,
				'periodo' => $periodo,
				'tipo' =>	'Periodo Preescolar -'.substr($periodo,0,4),
				'course' =>$course,
				'nombre' => $student->apellidos.' '.$student->nombres
			])
			@else
			@include('partials.encabezados.informe-cualitativo-final', [
				'reportName' => 'Informe Cualitativo',
				'informe' => $informe
			])
			@endif
			<br>
			<table class="table" style="{{$institution->ruc=='0992636009001' ? 'display: none;':''}}">
				<tr>
					<td class="uppercase no-border">coordinación zonal {{ $institution->coordinacionZonal }}</td>
					<td class="text-right uppercase no-border">distrito: {{ $institution->distrito }}</td>
				</tr>
				<tr>
					<td class="uppercase no-border">institución: {{ $institution->nombre }}</td>
					<td class="text-right uppercase no-border">codigo amie: {{ $institution->codigoAmie }}</td>
				</tr>
				<tr>
					<td colspan="2" class="text-center no-border uppercase">año lectivo {{$periodo}}</td>
				</tr>
			</table>
			<table class="table table__informeCualitativo" style="{{$institution->ruc=='0992636009001' ? 'display: none;':''}}">
				<tr>
					<td class="no-border">Apellidos y Nombres del Infante:
						<br><span class="uppercase informeCualitativo__nameAlumno">{{ $student->apellidos }} {{ $student->nombres }}</span>
					</td>
				</tr>
			</table>
			<table class="table table__informeCualitativo__principal" style="line-height:7px;">
				@if ($institution->ruc!='0992636009001')
					<tr>
						<td colspan="1" width="15%" class="uppercase text-center table__informeCualitativo__principal--titulo">Fecha de nacimiento: {{ $student->fechaNacimiento}}</td>
						<td colspan="1" class="uppercase text-center table__informeCualitativo__principal--titulo">reporte de desarollo integral</td>
					</tr>
					<tr>
						<td class="no-border"></td>
					</tr>
				@endif
				
				<tr>
					<td width="10" class="text-center bold uppercase">No.</td>
					<td width="250" class="text-center bold uppercase" style="font-size: 8px !important;">ámbitos de desarrollo y aprendizaje</td>
					@foreach ($unidades as $unidad)
						
						<td width="5" class="text-center bold uppercase" style="font-size: 8px !important;">{{$unidad->identificador}}</td>
					@endforeach
					<td width="5" class="text-center bold uppercase" style="font-size: 8px !important;">PMF</td>					
				</tr>
				@foreach($area_pos as $key => $Ap)
					@php
						$mat_fij = $matters->where('nombreArea',$Ap->nombre)->sortBy('posicion');
					@endphp
					@if($mat_fij!= null)
						@foreach($mat_fij as $matter)
						<tr>						
								<td class="text-center" style="font-size: 8px !important;">{{$n_m++}}</td>
								<td  class="bold" style="font-size: 8px !important;">{{ $matter->nombre }}</td>							
								@foreach ($unidades as $unidad)
									@php
									$CCF=App\calificacionCualitativaAmbitos::NotaCualitativaQuimestral($matter->id,$student->id, strtoupper($unidad->identificador));
									@endphp		
									<td class="text-center" style="font-size: 8px !important;">{{$CCF->Calificacion ?? ''}}</td>													
								@endforeach	
								@php
									$CCA=App\calificacionCualitativaAmbitos::NotaCualitativaQuimestral($matter->id,$student->id, strtoupper('ANUAL'));
									@endphp	
								<td class="text-center" style="font-size: 8px !important;">{{$CCA->Calificacion ?? ''}}</td>								
							</tr>						
						@endforeach															
					@endif
				@endforeach
				<tr>
					<td class="text-center" style="font-size: 8px !important;">{{$n_m++}}</td>
					<td style="font-size: 8px !important;">COMPORTAMIENTO</td>
					@php $obs=[]; @endphp
					@foreach ($unidades as $unidad)
						@php
						$Comp=App\Comportamiento::ComportamientoCualitativo($student->id,$unidad->identificador);
						@endphp		
						<td class="text-center" style="font-size: 8px !important;">{{$Comp->nota ?? ''}}</td>
						@endforeach		
						@php
						$CompA=App\Comportamiento::ComportamientoCualitativo($student->id, 'anual');
							if($CompA!=null){
								$obs['anual']=$CompA->observacion;
							}else{
								$obs['anual']="  ";
							}
						@endphp							
						<td class="text-center" style="font-size: 8px !important;">{{$CompA->nota ?? ''}}</td>
				</tr>
			</table>
			@if( $course->seccion != "EI" )
				@include('partials.reglamento', [
					'asignaturaCualitativa' => true, 'inicial' => true
				])
			@else
				@include('partials.reglamento', [
					'asignaturaCualitativa' => false, 'inicial' => true
				])
			@endif
			<table class="table" style="line-height:7px;">
				<tr>
					<td class="no-border" with='20%'>
						<table class="table">
							<tr><td class="text-center uppercase bold "style="font-size: 8px !important;" colspan="2">INASISTENCIAS ATRASOS</td></tr>
							@php
								
							@endphp
							<tr>
								@foreach ([1,2] as $quimestre)					
								@php
									$acumulado_atrasos+= $student->asistenciaParcial('p1q'.$quimestre)['atrasos'] + 
									$student->asistenciaParcial('p2q'.$quimestre)['atrasos'] + 
									$student->asistenciaParcial('p3q'.$quimestre)['atrasos'];
									$acumulado_faltas+= $student->asistenciaParcial('p1q'.$quimestre)['faltas_injustificadas'] + 
									$student->asistenciaParcial('p2q'.$quimestre)['faltas_injustificadas'] + 
									$student->asistenciaParcial('p3q'.$quimestre)['faltas_injustificadas'];
									$acumulado_faltasInjustificadas+=$student->asistenciaParcial('p1q'.$quimestre)['faltas_justificadas'] + 
									$student->asistenciaParcial('p2q'.$quimestre)['faltas_justificadas'] + 
									$student->asistenciaParcial('p3q'.$quimestre)['faltas_justificadas'];
									
								@endphp
								@endforeach
								<td style="font-size: 8px !important;">
									{{$acumulado_atrasos}}
								</td>
								<td style="font-size: 8px !important;">Atrasos injustificados</td></tr>
							<tr><td style="font-size: 8px !important;">
									{{$acumulado_atrasos}}
								</td>
								<td style="font-size: 8px !important;">Atrasos justificados</td></tr>
							<tr><td style="font-size: 8px !important;">
									{{$acumulado_faltas}}
								</td>
								<td style="font-size: 8px !important;">Faltas injustificadas</td></tr>
							<tr><td style="font-size: 8px !important;">
									{{$acumulado_faltasInjustificadas}}
								</td>
								<td style="font-size: 8px !important;">Faltas justificadas</td></tr>
						</table>
					</td>
				
					<td class="no-border"> &nbsp; </td>
					<td  class="no-border" with='60%'>
						<table class="table" >
							<tr>
								<td class="text-center uppercase bold" style="font-size: 8px !important;">Observaciones</td>
							</tr>
							<tr height="55">
								<td class="text-center" style="font-size: 8px !important;">
									@foreach ($obs as $s)
										{{$s}}<br>
									@endforeach
								</td>
							</tr>
						</table>
					</td>
				</tr>
			</table>
			<br>
			<div class="row">
				<div class="col-xs-4 p-0 text-center">
					<hr class="certificado__hr">
					@if( $course->seccion == "EI" )
						<p class="uppercase" style="font-size: 8px !important;">
							{{ $institution->representante3 }} <br> {{ $institution->cargo3 }}
						</p>
					@elseif ( $course->seccion == "EGB" )
						<p class="uppercase" style="font-size: 8px !important;">
							{{ $institution->representante4 }} <br> {{ $institution->cargo4 }}
						</p>
					@else
						<p class="uppercase" style="font-size: 8px !important;">
							{{ $institution->representante1 }} <br> {{ $institution->cargo1 }}
						</p>
					@endif
				</div>
				<div class="col-xs-4 p-0 text-center">
					<hr class="certificado__hr">
					<p class="uppercase" style="font-size: 8px !important;">
						{{$tutor == null ? "-" : $tutor->nombres }} {{$tutor == null ? "-" : $tutor->apellidos }}<br> {{$tutor == null ? "-" : ($tutor->sexo == 'Masculino' ? 'TUTOR' : 'TUTORA')}}
					</p>
				</div>
				<div class="col-xs-4 p-0 text-center">
					<td>
						<hr class="certificado__hr">
						<p class="uppercase" style="font-size: 8px !important;">
							@foreach($representantes as $repre)
								@if($student->idRepresentante ==$repre->id)
									{{$repre->apellidos}} {{$repre->nombres}}
								@endif
							@endforeach
							<br> representante
						</p>
					</td>
				</div>
			</div>
		</div>
		<div style="page-break-after:always;"></div>
    @endforeach
	</main>
</body>
</html>