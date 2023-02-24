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
	$c = 0;
	$n_m = 1;	
    $notas = $data->where('estudianteId',$student->id)->first();
    @endphp

		<div class="container">
			@if($institution->ruc=='0992636009001')

			@include('partials.encabezados.informe-cualitativo-final-novus', [
				'reportName' => 'Informe Cualitativo',
				'informe' => $informe,
				'periodo' => $periodo,
				'tipo' =>'QUIMESTRE '.$nQuimestre,
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
			<table class="table table__informeCualitativo" style="{{$institution->ruc=='0992636009001' ? 'display: none;':''}}">
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
			<br>
			<table class="table table__informeCualitativo" style="{{$institution->ruc=='0992636009001' ? 'display: none;':''}}">
				<tr>
					<td class="no-border">Apellidos y Nombres del Infante:
						<br><span class="uppercase informeCualitativo__nameAlumno">{{ $student->student->apellidos }} {{ $student->student->nombres }}</span>
					</td>
				</tr>
			</table>
			<table class="table table__informeCualitativo__principal">
				@if ($institution->ruc!='0992636009001')
					<tr>
						<td colspan="1" width="15%" class="uppercase text-center table__informeCualitativo__principal--titulo">Fecha de nacimiento: {{ $student->fechaNacimiento}}</td>
						<td colspan="1" class="uppercase text-center table__informeCualitativo__principal--titulo">reporte de desarollo integral</td>
						<td colspan="3" class="uppercase text-center table__informeCualitativo__principal--titulo">{{$quimestre}} Quimestre</td>
					</tr>
					<tr>
						<td class="no-border"></td>
					</tr>
				@endif
				
				<tr>
					<td width="10" class="text-center bold uppercase">No.</td>
					<td width="250" class="text-center bold uppercase" style="font-size: 8px !important;">ámbitos de desarrollo y aprendizaje</td>
					@foreach ($parcialP as $par)
						<td width="5" class="text-center bold uppercase" style="font-size: 8px !important;">{{( strlen($par->identificador) < 3 ? 'EXA' : substr($par->identificador,0,2) )}}</td>
					@endforeach
					<td width="10" class="text-center bold uppercase" style="font-size: 8px !important;">{{ strtoupper($unidad->identificador) }}</td>
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
								@foreach ($parcialP as $par)
									@php
										$parci = (strlen($par->identificador) < 3 ? 'EX'.strtoupper($par->identificador) : strtoupper($par->identificador)) ;
										$CCQ='';
										$CCQ=App\calificacionCualitativaAmbitos::NotaCualitativaQuimestral($matter->id,$student->id, $parci);
										$CCF=App\calificacionCualitativaAmbitos::NotaCualitativaQuimestral($matter->id,$student->id, strtoupper($unidad->identificador));
									@endphp
									@if($matter->area =='PROYECTO' || $matter->area =='PROYECTOS ESCOLARES' )
										@php 										
											$n_p ='';
											$notas_matter = new \Illuminate\Support\Collection($notas->materias);
											$notas_py = new \Illuminate\Support\Collection($notas_matter->where('materiaId',$matter->id)->first());	
											foreach ($notas_py['parciales'] as $value) {
													if ($value->indicador == $par->identificador) {
														$n_p =App\Calificacion::notaCualitativa($value->promediop);
													}
												}
										@endphp
										<td class="text-center bold uppercase" style="font-size: 8px !important;">{{$n_p}}</td>
									@else
										<td class="text-center bold uppercase" style="font-size: 8px !important;">@if($CCQ!=null){{$CCQ->Calificacion}}@endif</td>
									@endif
								@endforeach
								@if($matter->area =='PROYECTO' || $matter->area =='PROYECTOS ESCOLARES' )
									@php
										$CCF= App\Calificacion::notaCualitativa($notas_py['promedioquimestral']);
									@endphp
									<td class="text-center" style="font-size: 8px !important;">@if($CCF!=null){{$CCF}}@endif</td>
								@else
									<td class="text-center" style="font-size: 8px !important;">@if($CCF!=null){{$CCF->Calificacion}}@endif</td>
								@endif
							</tr>
						@endforeach
					@endif
				@endforeach
				<tr>
					<td class="text-center" style="font-size: 8px !important;">{{ $n_m++}}</td>
					<td style="font-size: 8px !important;">COMPORTAMIENTO</td>
					@php $obs=[]; @endphp
					@foreach ($parcialP as $par)
						@php
							$Comp=App\Comportamiento::ComportamientoCualitativo($student->id, $par->identificador);
							if($Comp!=null){
								$obs[$par->identificador]=$Comp->observacion;
							}else{
								$obs[$par->identificador]="  ";
							}
						@endphp
						<td class="text-center bold uppercase" style="font-size: 8px !important;">@if($Comp!=null){{$Comp->nota}}@endif</td>
					@endforeach
					<td class="text-center" style="font-size: 8px !important;">{{ App\Comportamiento::ComportamientoCualitativo($student->id, $unidad->identificador)['nota'] }}</td>
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
			<table class="table">
				<tr>
					<td class="no-border" with='20%'>
						<table class="table">
							<tr><td class="text-center uppercase bold "style="font-size: 8px !important;" colspan="2">INASISTENCIAS ATRASOS</td></tr>
							<tr><td style="font-size: 8px !important;">
									{{$student->asistenciaParcial('p1q'.$quimestre)['atrasos'] + 
									$student->asistenciaParcial('p2q'.$quimestre)['atrasos'] + 
									$student->asistenciaParcial('p3q'.$quimestre)['atrasos']}}
								</td>
								<td style="font-size: 8px !important;">Atrasos injustificados</td></tr>
							<tr><td style="font-size: 8px !important;">
									{{$student->asistenciaParcial('p1q'.$quimestre)['atrasos'] + 
									$student->asistenciaParcial('p2q'.$quimestre)['atrasos'] + 
									$student->asistenciaParcial('p3q'.$quimestre)['atrasos']}}
								</td>
								<td style="font-size: 8px !important;">Atrasos justificados</td></tr>
							<tr><td style="font-size: 8px !important;">
									{{$student->asistenciaParcial('p1q'.$quimestre)['faltas_injustificadas'] + 
									$student->asistenciaParcial('p2q'.$quimestre)['faltas_injustificadas'] + 
									$student->asistenciaParcial('p3q'.$quimestre)['faltas_injustificadas']}}
								</td>
								<td style="font-size: 8px !important;">Faltas injustificadas</td></tr>
							<tr><td style="font-size: 8px !important;">
									{{$student->asistenciaParcial('p1q'.$quimestre)['faltas_justificadas'] + 
									$student->asistenciaParcial('p2q'.$quimestre)['faltas_justificadas'] + 
									$student->asistenciaParcial('p3q'.$quimestre)['faltas_justificadas']}}
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