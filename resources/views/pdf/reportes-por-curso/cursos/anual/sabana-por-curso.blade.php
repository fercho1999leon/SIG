<!DOCTYPE html>
<html lang="es">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link rel="stylesheet" href="{{ secure_asset('css/pdf/pdf.css') }}">
	<title>{{$tituloTitle}}</title>
</head>
@php
$numeroDeAreas = count($areas);
@endphp
<body>
	<div style="page-break-after:always;"></div>
	@while ($cantidadDeEstudiantesPorHojaSumatoria < $cantidadDeEstudiantes)
		@include('partials.encabezados.sabana')
		<table class="table m-0">
			<tr>
			<td width="50%" class="no-border up">{{ $institution->jornada }}</td>
			<td width="50%" class="no-border up text-right">
				@if($course->grado=='Segundo')
					Segundo Grado de Educacion General Elemental
				@endif
				@if($course->grado=='Tercero')
					Tercer Grado de Educacion General Elemental
				@endif
				@if($course->grado=='Cuarto')
					Cuarto Grado de Educacion General Elemental
				@endif
				@if($course->grado=='Quinto')
					Quinto Grado de Educacion General Media
				@endif
				@if($course->grado=='Sexto')
					Sexto Grado de Educacion General Media
				@endif
				@if($course->grado=='Septimo')
					Septimo Grado de Educacion General Media
				@endif
				@if($course->grado=='Octavo')
					Octavo Grado de Educacion General Superior
				@endif
				@if($course->grado=='Noveno')
					Noveno Grado de Educacion General Superior
				@endif
				@if($course->grado=='Decimo')
					Decimo Grado de Educacion General Superior
				@endif
				@if($course->grado=='Primero de Bachillerato')
					Primer Año de Bachillerato General Unificado {{ $course->especializacion }}
				@endif
				@if($course->grado=='Segundo de Bachillerato')
					Segundo Año de Bachillerato General Unificado {{ $course->especializacion }}
				@endif
				@if($course->grado=='Tercero de Bachillerato')
					Tercer Año de Bachillerato General Unificado {{ $course->especializacion }}
				@endif
				{{ $course->paralelo }}
			</td>
			</tr>
		</table>
		<table class="table whitespace-no">
			<tr height="40">
				<td width="5" rowspan="3" class="text-center">No.</td>
				<td rowspan="3" class="bold text-center up">apellidos y nombres</td>
				<td rowspan="3" width="5" class="text-center up bold">
					<p class="s-calificaciones__materia libretaQuimestralPorCurso__nombres">
						<span class="up bold">Comportamiento</span>
					</p>
                </td>
                @foreach($areas->take(5) as $area)
				<td colspan="{{$area->numero * 7}}" class="text-center up">{{ $area->nombreArea}}</td>
				@endforeach
			</tr>
			<tr height="40">
				@foreach($areas->take(5) as $area)
					@foreach($matters as $matter)
						@if($matter->nombreArea == $area->nombreArea)
							<td class="text-center up bold" colspan="7">
								
									<span class="up bold">{{ $matter->nombre }}</span>
								
							</td>
						@endif
					@endforeach
				@endforeach
			</tr>
			<tr height="40">
				@foreach($areas->take(5) as $area)
					@foreach($matters as $matter)
						@if($matter->nombreArea == $area->nombreArea)
							@foreach($unidades_a as $unidad)
								<td class="text-center">
									<p class="s-calificaciones__materia libretaQuimestralPorCurso__nombres sabanaTd-nombres">
										<span class="up bold">{{$unidad->identificador}}</span>
									</p>
								</td>
							@endforeach
							<td><p class="s-calificaciones__materia libretaQuimestralPorCurso__nombres sabanaTd-nombres">
										<span class="up bold">PRO</span>
									</p>
							</td>
							<td><p class="s-calificaciones__materia libretaQuimestralPorCurso__nombres sabanaTd-nombres">
										<span class="up bold">SUP</span>
									</p>
							</td>
							<td><p class="s-calificaciones__materia libretaQuimestralPorCurso__nombres sabanaTd-nombres">
										<span class="up bold">REM</span>
									</p>
							</td>
							<td><p class="s-calificaciones__materia libretaQuimestralPorCurso__nombres sabanaTd-nombres">
										<span class="up bold">GRA</span>
									</p>
							</td>
							<td><p class="s-calificaciones__materia libretaQuimestralPorCurso__nombres sabanaTd-nombres">
										<span class="up bold">PRO.F</span>
									</p>
							</td>
						@endif
					@endforeach
				@endforeach
			</tr>
			<tr>
				@foreach($sabana->slice($sliceEstudiantes)->take($cantidadDeEstudiantesPorHoja) as $estudiante)
				@php
				$supletorio= false;
				$remedial= false;
				$gracia= false;
				$faltanNotas = false;
				$reprobado = false;
				$student = $students->where('idStudent',$estudiante->estudianteId)->first()
				@endphp
					<td>{{$count++}}</td>
					<td>{{$student->apellidos}} {{$student->nombres}}</td>
					<td class="text-center">
                        @if($confComportamiento->valor !== 'crear')
							@forelse($student->student->comportamientos->where('parcial', 'p3q2') as $comportamiento)
								{{$comportamiento->nota}}
							@empty
								-
							@endforelse
						@else
							@forelse($student->student->comportamientos->where('parcial', 'anual') as $comportamiento)
								{{$comportamiento->nota}}
							@empty
								-
							@endforelse
						@endif
                    </td>
					@foreach($areas->take(5) as $area)
						@foreach($matters as $matter)
							@if($matter->nombreArea == $area->nombreArea)
								@foreach($estudiante->materias as $notas_materias)
									@if($notas_materias->materiaId == $matter->id)
										@foreach($unidades_a as $unidad)
											@foreach($notas_materias->quimestres as $nota_quimestral)
												@if($nota_quimestral->indicador == $unidad->identificador)
													<td class="text-center"
                                                        @if($nota_quimestral->promediop < 7 && $notasMenores == "1")
													        style="color:red;"
													    @endif>
                                                        @if($nota_quimestral->promediop!=0)
                                                            {{$matter->idEstructura!= null ? App\rangosCualitativo::getCalificacionCualitativa($matter->idEstructura,$nota_quimestral->promediop)['nota'] : bcdiv($nota_quimestral->promediop, '1', 2)}}
                                                        @endif
													</td>
												@endif
											@endforeach
										@endforeach
										@php
										if($notas_materias->promedioAnual == 0){
											$faltanNotas = true;
                                        }elseif($notas_materias->supletorio==0 && $notas_materias->promedioFinal<7 && $notas_materias->promedioFinal>=5 ) {
											$supletorio= true;
										}elseif($notas_materias->supletorio>=0 && $notas_materias->promedioFinal <7 && $notas_materias->remedial ==0 ){
											$remedial= true;
										}elseif($notas_materias->supletorio>=0 && $notas_materias->promedioFinal <7 && $notas_materias->remedial >=0 && $notas_materias->gracia ==0 ){
											$gracia= true;
										}elseif($notas_materias->promedioFinal>0 && $notas_materias->promedioAnual < 7 ){
											$reprobado= true;
										}
										@endphp
										<td class="text-center"
                                            @if($notas_materias->promedioAnual < 7 && $notasMenores == "1")
												style="color:red;"
											@endif>
											@if($notas_materias->promedioAnual!=0)
												{{$matter->idEstructura!= null ? App\rangosCualitativo::getCalificacionCualitativa($matter->idEstructura,$notas_materias->promedioAnual)['nota'] : bcdiv($notas_materias->promedioAnual, '1', 2)}}
											@endif
                                        </td>
										<td class="text-center"
                                            @if($notas_materias->supletorio < 7 && $notasMenores == "1" && $notas_materias->supletorio >0)
												style="color:red;"
											@endif>
											@if($notas_materias->supletorio!=0)
												{{$matter->idEstructura!= null ? App\rangosCualitativo::getCalificacionCualitativa($matter->idEstructura,$notas_materias->supletorio)['nota'] : bcdiv($notas_materias->supletorio, '1', 2)}}
											@endif
                                        </td>
										<td class="text-center"
                                            @if($notas_materias->remedial < 7 && $notasMenores == "1" && $notas_materias->remedial >0)
												style="color:red;"
											@endif>
											@if($notas_materias->remedial!=0)
												{{$matter->idEstructura!= null ? App\rangosCualitativo::getCalificacionCualitativa($matter->idEstructura,$notas_materias->remedial)['nota'] : bcdiv($notas_materias->remedial, '1', 2)}}
											@endif
                                        </td>
										<td class="text-center"
                                            @if($notas_materias->gracia < 7 && $notasMenores == "1" && $notas_materias->gracia >0)
												style="color:red;"
											@endif>
											@if($notas_materias->gracia!=0)
												{{$matter->idEstructura!= null ? App\rangosCualitativo::getCalificacionCualitativa($matter->idEstructura,$notas_materias->gracia)['nota'] : bcdiv($notas_materias->gracia, '1', 2)}}
											@endif
                                        </td>
										<td class="text-center"
                                            @if($notas_materias->promedioFinal < 7 && $notasMenores == "1")
												style="color:red;"
											@endif>
											@if($notas_materias->promedioFinal!=0)
												{{$matter->idEstructura!= null ? App\rangosCualitativo::getCalificacionCualitativa($matter->idEstructura,$notas_materias->promedioFinal)['nota'] : bcdiv($notas_materias->promedioFinal, '1', 2)}}
											@endif
                                        </td>
									@endif
								@endforeach
							@endif
						@endforeach
					@endforeach
					</tr>
				@endforeach
		</table>
			<br>
		 <div class="row">
            <div class="col-xs-6 p-0 text-center ">
                <hr class="certificado__hr">
                <p class="uppercase">
                    {{ $institution->representante1 }} <br> {{ $institution->cargo1 }}
                </p>
            </div>
            <div class="col-xs-6 p-0 text-center">
                <hr class="certificado__hr">
                <p class="uppercase">
                    {{ $institution->representante2 }} <br> {{ $institution->cargo2 }}
                </p>
            </div>
        </div>
		@php
			$sliceEstudiantes = $sliceEstudiantes + $cantidadDeEstudiantesPorHoja; //10 pasa, 20 pasa
			$cantidadDeEstudiantesPorHojaSumatoria = $sliceEstudiantes + $cantidadDeEstudiantesPorHoja; // 20 pasa , 30
			//dd($cantidadDeEstudiantesPorHojaSumatoria)
        @endphp
		<div style="page-break-after:always;"></div>
	@endwhile
	@php
		$sliceEstudiantes = $cantidadDeEstudiantesPorHojaSumatoria - $cantidadDeEstudiantesPorHoja;
		$cantidadDeEstudiantesPorHojaSumatoria = $cantidadDeEstudiantesPorHojaSumatoria - $cantidadDeEstudiantes;
		//dd($cantidadDeEstudiantesPorHojaSumatoria);
	@endphp
	@php
	//echo 'dentro';
	@endphp
	@include('partials.encabezados.sabana')
		<table class="table m-0">
			<tr>
			<td width="50%" class="no-border up">{{ $institution->jornada }}</td>
			<td width="50%" class="no-border up text-right">
				@if($course->grado=='Segundo')
					Segundo Grado de Educacion General Elemental
				@endif
				@if($course->grado=='Tercero')
					Tercer Grado de Educacion General Elemental
				@endif
				@if($course->grado=='Cuarto')
					Cuarto Grado de Educacion General Elemental
				@endif
				@if($course->grado=='Quinto')
					Quinto Grado de Educacion General Media
				@endif
				@if($course->grado=='Sexto')
					Sexto Grado de Educacion General Media
				@endif
				@if($course->grado=='Septimo')
					Septimo Grado de Educacion General Media
				@endif
				@if($course->grado=='Octavo')
					Octavo Grado de Educacion General Superior
				@endif
				@if($course->grado=='Noveno')
					Noveno Grado de Educacion General Superior
				@endif
				@if($course->grado=='Decimo')
					Decimo Grado de Educacion General Superior
				@endif
				@if($course->grado=='Primero de Bachillerato')
					Primer Año de Bachillerato General Unificado {{ $course->especializacion }}
				@endif
				@if($course->grado=='Segundo de Bachillerato')
					Segundo Año de Bachillerato General Unificado {{ $course->especializacion }}
				@endif
				@if($course->grado=='Tercero de Bachillerato')
					Tercer Año de Bachillerato General Unificado {{ $course->especializacion }}
				@endif
				{{ $course->paralelo }}
			</td>
			</tr>
		</table>
		<table class="table whitespace-no">
			<tr height="40">
				<td width="5" rowspan="3" class="text-center">No.</td>
				<td rowspan="3" class="bold text-center up">apellidos y nombres</td>
				<td rowspan="3" width="5" class="text-center up bold">
					<p class="s-calificaciones__materia libretaQuimestralPorCurso__nombres">
						<span class="up bold">Comportamiento</span>
					</p>
                </td>
                @foreach($areas->take(5) as $area)
				<td colspan="{{$area->numero * 7}}" class="text-center up">{{ $area->nombreArea}}</td>
				@endforeach
			</tr>
			{{-- Cambios Hector 23/03/2021 --}}
			<tr height="40">
				@foreach($areas->take(5) as $area)
					@foreach($matters as $matter)
						@if($matter->nombreArea == $area->nombreArea)
							<td class="text-center up bold" colspan="7">
								<span class="up bold">{{ $matter->nombre }}</span>
							</td>
						@endif
					@endforeach
				@endforeach
			</tr>
			<tr height="40">
				@foreach($areas->take(5) as $area)
					@foreach($matters as $matter)
						@if($matter->nombreArea == $area->nombreArea)
							@foreach($unidades_a as $unidad)
								<td class="text-center">
									<p class="s-calificaciones__materia libretaQuimestralPorCurso__nombres sabanaTd-nombres">
										<span class="up bold">{{$unidad->identificador}}</span>
									</p>
								</td>
							@endforeach
							<td><p class="s-calificaciones__materia libretaQuimestralPorCurso__nombres sabanaTd-nombres">
										<span class="up bold">PRO</span>
									</p>
							</td>
							<td><p class="s-calificaciones__materia libretaQuimestralPorCurso__nombres sabanaTd-nombres">
										<span class="up bold">SUP</span>
									</p>
							</td>
							<td><p class="s-calificaciones__materia libretaQuimestralPorCurso__nombres sabanaTd-nombres">
										<span class="up bold">REM</span>
									</p>
							</td>
							<td><p class="s-calificaciones__materia libretaQuimestralPorCurso__nombres sabanaTd-nombres">
										<span class="up bold">GRA</span>
									</p>
							</td>
							<td><p class="s-calificaciones__materia libretaQuimestralPorCurso__nombres sabanaTd-nombres">
										<span class="up bold">PRO.F</span>
									</p>
							</td>
						@endif
					@endforeach
				@endforeach
			</tr>
			<tr>
				@foreach($sabana->slice($sliceEstudiantes)->take($cantidadDeEstudiantesPorHoja) as $estudiante)
				@php
				$supletorio= false;
				$remedial= false;
				$gracia= false;
				$faltanNotas = false;
				$reprobado = false;
				$student = $students->where('idStudent',$estudiante->estudianteId)->first();

				@endphp
					<td>{{$count++}}</td>
					<td>{{$student->apellidos}} {{$student->nombres}}</td>
					<td class="text-center">
                        @if($confComportamiento->valor !== 'crear')
							@forelse($student->student->comportamientos->where('parcial', 'p3q2') as $comportamiento)
								{{$comportamiento->nota}}
							@empty
								-
							@endforelse
						@else
							@forelse($student->student->comportamientos->where('parcial', 'anual') as $comportamiento)
								{{$comportamiento->nota}}
							@empty
								-
							@endforelse
						@endif
                    </td>
					@foreach($areas->take(5) as $area)
						@foreach($matters as $matter)
							@if($matter->nombreArea == $area->nombreArea)
								@foreach($estudiante->materias as $notas_materias)
									@if($notas_materias->materiaId == $matter->id)
										@foreach($unidades_a as $unidad)
											@foreach($notas_materias->quimestres as $nota_quimestral)
												@if($nota_quimestral->indicador == $unidad->identificador)
													<td class="text-center" @if($nota_quimestral->promediop < 7 && $notasMenores == "1")
													style="color:red;"
													@endif>@if($nota_quimestral->promediop!=0)
													{{$matter->idEstructura!= null ? App\rangosCualitativo::getCalificacionCualitativa($matter->idEstructura,$nota_quimestral->promediop)['nota'] : bcdiv($nota_quimestral->promediop, '1', 2)}}
													@endif
													</td>
												@endif
											@endforeach
											@endforeach
											@php

											if($notas_materias->promedioAnual == 0)
											$faltanNotas = true;
											elseif($notas_materias->supletorio==0 && $notas_materias->promedioFinal<7 && $notas_materias->promedioFinal>=5 ) {
											$supletorio= true;
											}elseif($notas_materias->supletorio>=0 && $notas_materias->promedioFinal <7 && $notas_materias->remedial ==0 ){
											$remedial= true;
											}elseif($notas_materias->supletorio>=0 && $notas_materias->promedioFinal <7 && $notas_materias->remedial >=0 && $notas_materias->gracia ==0 ){
											$gracia= true;
											}elseif($notas_materias->promedioFinal>0 && $notas_materias->promedioAnual < 7 ){
											$reprobado= true;
											}
											@endphp
												<td class="text-center" @if($notas_materias->promedioAnual < 7 && $notasMenores == "1")
															style="color:red;"
													@endif>
													@if($notas_materias->promedioAnual!=0)
													{{$matter->idEstructura!= null ? App\rangosCualitativo::getCalificacionCualitativa($matter->idEstructura,$notas_materias->promedioAnual)['nota'] : bcdiv($notas_materias->promedioAnual, '1', 2)}}
												@endif</td>
												<td class="text-center" @if($notas_materias->supletorio < 7 && $notasMenores == "1" && $notas_materias->supletorio >0)
															style="color:red;"
													@endif>
													@if($notas_materias->remedial!=0)
													{{$matter->idEstructura!= null ? App\rangosCualitativo::getCalificacionCualitativa($matter->idEstructura,$notas_materias->supletorio)['nota'] : bcdiv($notas_materias->supletorio, '1', 2)}}
												@endif</td>
												<td class="text-center" @if($notas_materias->remedial < 7 && $notasMenores == "1" && $notas_materias->remedial >0)
															style="color:red;"
													@endif>
													@if($notas_materias->remedial!=0)
													{{$matter->idEstructura!= null ? App\rangosCualitativo::getCalificacionCualitativa($matter->idEstructura,$notas_materias->remedial)['nota'] : bcdiv($notas_materias->remedial, '1', 2)}}
												@endif</td>
												<td class="text-center" @if($notas_materias->gracia < 7 && $notasMenores == "1" && $notas_materias->gracia >0)
															style="color:red;"
													@endif>
													@if($notas_materias->gracia!=0)
													{{$matter->idEstructura!= null ? App\rangosCualitativo::getCalificacionCualitativa($matter->idEstructura,$notas_materias->gracia)['nota'] : bcdiv($notas_materias->gracia, '1', 2)}}
												@endif</td>
												<td class="text-center" @if($notas_materias->promedioFinal < 7 && $notasMenores == "1")
													style="color:red;"
													@endif>
													@if($notas_materias->promedioFinal!=0)
													{{$matter->idEstructura!= null ? App\rangosCualitativo::getCalificacionCualitativa($matter->idEstructura,$notas_materias->promedioFinal)['nota'] : bcdiv($notas_materias->promedioFinal, '1', 2)}}
												@endif</td>
									@endif
								@endforeach
							@endif
						@endforeach
					@endforeach
					</tr>
				@endforeach
		</table>
			<br>
		 <div class="row">
            <div class="col-xs-6 p-0 text-center ">
                <hr class="certificado__hr">
                <p class="uppercase">
                    {{ $institution->representante1 }} <br> {{ $institution->cargo1 }}
                </p>
            </div>
            <div class="col-xs-6 p-0 text-center">
                <hr class="certificado__hr">
                <p class="uppercase">
                    {{ $institution->representante2 }} <br> {{ $institution->cargo2 }}
                </p>
            </div>
        </div>
    <div style="page-break-after:always;"></div>

    @if ($numeroDeAreas < 11)
		{{-- 2da hoja --}}
		@php
			$sliceEstudiantes = 0;
			$cantidadDeEstudiantesPorHojaSumatoria = $reinicioCantidadDeEstudiantesPorHoja;
			$count = 1;
		@endphp
		@while ($cantidadDeEstudiantesPorHojaSumatoria < $cantidadDeEstudiantes)
				@include('partials.encabezados.sabana')
		<table class="table m-0">
			<tr>
			<td width="50%" class="no-border up">{{ $institution->jornada }}</td>
			<td width="50%" class="no-border up text-right">
				@if($course->grado=='Segundo')
					Segundo Grado de Educacion General Elemental
				@endif
				@if($course->grado=='Tercero')
					Tercer Grado de Educacion General Elemental
				@endif
				@if($course->grado=='Cuarto')
					Cuarto Grado de Educacion General Elemental
				@endif
				@if($course->grado=='Quinto')
					Quinto Grado de Educacion General Media
				@endif
				@if($course->grado=='Sexto')
					Sexto Grado de Educacion General Media
				@endif
				@if($course->grado=='Septimo')
					Septimo Grado de Educacion General Media
				@endif
				@if($course->grado=='Octavo')
					Octavo Grado de Educacion General Superior
				@endif
				@if($course->grado=='Noveno')
					Noveno Grado de Educacion General Superior
				@endif
				@if($course->grado=='Decimo')
					Decimo Grado de Educacion General Superior
				@endif
				@if($course->grado=='Primero de Bachillerato')
					Primer Año de Bachillerato General Unificado {{ $course->especializacion }}
				@endif
				@if($course->grado=='Segundo de Bachillerato')
					Segundo Año de Bachillerato General Unificado {{ $course->especializacion }}
				@endif
				@if($course->grado=='Tercero de Bachillerato')
					Tercer Año de Bachillerato General Unificado {{ $course->especializacion }}
				@endif
				{{ $course->paralelo }}
			</td>
			</tr>
		</table>
		<table class="table whitespace-no">
			<tr height="40">
				<td width="5" rowspan="3" class="text-center">No.</td>
				<td rowspan="3" class="bold text-center up">apellidos y nombres</td>
				<td rowspan="3" width="5" class="text-center up bold">
					<p class="s-calificaciones__materia libretaQuimestralPorCurso__nombres">
						<span class="up bold">Comportamiento</span>
					</p>
                </td>
                @foreach($areas->slice(5)->take(6) as $area)
				<td colspan="{{$area->numero * 7}}" class="text-center up">{{ $area->nombreArea}}</td>
				@endforeach
				<td rowspan="3" class="text-center up bold">
								<p class="s-calificaciones__materia libretaQuimestralPorCurso__nombres">
									<span class="up bold">Promedio Final</span>
								</p>
							</td>
				@if($dhi != null)
				<td colspan="3" class="text-center uppercase bold">
					{{$dhi->nombre}}
				</td>
				@endif
				<td rowspan="3" class="up text-center">observaciones</td>
			</tr>
			<tr height="40">
				@foreach($areas->slice(5)->take(6) as $area)
					@foreach($matters as $matter)
						@if($matter->nombreArea == $area->nombreArea)
							<td class="text-center up bold" colspan="7">
								
									<span class="up bold">{{ $matter->nombre }}</span>
								
							</td>
						@endif
					@endforeach
				@endforeach
				@if($dhi != null)
				<td colspan="3" class="text-center uppercase bold">
					{{$dhi->nombre}}
				</td>
				@endif
			</tr>
			<tr height="40">
				@foreach($areas->slice(5)->take(6) as $area)
					@foreach($matters as $matter)
						@if($matter->nombreArea == $area->nombreArea)
							@foreach($unidades_a as $unidad)
								<td class="text-center">
									<p class="s-calificaciones__materia libretaQuimestralPorCurso__nombres sabanaTd-nombres">
										<span class="up bold">{{$unidad->identificador}}</span>
									</p>
								</td>
							@endforeach
							<td><p class="s-calificaciones__materia libretaQuimestralPorCurso__nombres sabanaTd-nombres">
										<span class="up bold">PRO</span>
									</p>
							</td>
							<td><p class="s-calificaciones__materia libretaQuimestralPorCurso__nombres sabanaTd-nombres">
										<span class="up bold">SUP</span>
									</p>
							</td>
							<td><p class="s-calificaciones__materia libretaQuimestralPorCurso__nombres sabanaTd-nombres">
										<span class="up bold">REM</span>
									</p>
							</td>
							<td><p class="s-calificaciones__materia libretaQuimestralPorCurso__nombres sabanaTd-nombres">
										<span class="up bold">GRA</span>
									</p>
							</td>
							<td><p class="s-calificaciones__materia libretaQuimestralPorCurso__nombres sabanaTd-nombres">
										<span class="up bold">PRO.F</span>
									</p>
							</td>
						@endif
					@endforeach
				@endforeach
				@if($dhi!=null)
					@foreach($unidades_a as $unidad)
									<td class="text-center">
										<p class="s-calificaciones__materia libretaQuimestralPorCurso__nombres sabanaTd-nombres">
											<span class="up bold">{{$unidad->identificador}}</span>
										</p>
									</td>
					@endforeach
									<td><p class="s-calificaciones__materia libretaQuimestralPorCurso__nombres sabanaTd-nombres">
											<span class="up bold">PRO.F</span>
										</p>
									</td>
				@endif
			</tr>
			<tr>
				@foreach($sabana->slice($sliceEstudiantes)->take($cantidadDeEstudiantesPorHoja) as $estudiante)
				@php
				$supletorio= false;
				$remedial= false;
				$gracia= false;
				$faltanNotas = false;
				$reprobado = false;
				$student = $students->where('idStudent',$estudiante->estudianteId)->first()
				@endphp
					<td>{{$count++}}</td>
					<td>{{$student->apellidos}} {{$student->nombres}}</td>
					<td class="text-center">
                        @if($confComportamiento->valor !== 'crear')
							@forelse($student->student->comportamientos->where('parcial', 'p3q2') as $comportamiento)
								{{$comportamiento->nota}}
							@empty
								-
							@endforelse
						@else
							@forelse($student->student->comportamientos->where('parcial', 'anual') as $comportamiento)
								{{$comportamiento->nota}}
							@empty
								-
							@endforelse
						@endif
                    </td>
					@foreach($areas->slice(5)->take(6) as $area)
						@foreach($matters as $matter)
							@if($matter->nombreArea == $area->nombreArea)
								@foreach($estudiante->materias as $notas_materias)
									@if($notas_materias->materiaId == $matter->id)
										@foreach($unidades_a as $unidad)
											@foreach($notas_materias->quimestres as $nota_quimestral)
												@if($nota_quimestral->indicador == $unidad->identificador)
													<td class="text-center" @if($nota_quimestral->promediop < 7 && $notasMenores == "1")
													style="color:red;"
													@endif>@if($nota_quimestral->promediop!=0)
													{{$matter->idEstructura!= null ? App\rangosCualitativo::getCalificacionCualitativa($matter->idEstructura,$nota_quimestral->promediop)['nota'] : bcdiv($nota_quimestral->promediop, '1', 2)}}
													@endif
													</td>
												@endif
											@endforeach
											@endforeach
											@php
											if($notas_materias->promedioAnual == 0)
											$faltanNotas = true;
											elseif($notas_materias->supletorio==0 && $notas_materias->promedioFinal<7 && $notas_materias->promedioFinal>=5 ) {
											$supletorio= true;
											}elseif($notas_materias->supletorio>=0 && $notas_materias->promedioFinal <7 && $notas_materias->remedial ==0 ){
											$remedial= true;
											}elseif($notas_materias->supletorio>=0 && $notas_materias->promedioFinal <7 && $notas_materias->remedial >=0 && $notas_materias->gracia ==0 ){
											$gracia= true;
											}elseif($notas_materias->promedioFinal>0 && $notas_materias->promedioAnual < 7 ){
											$reprobado= true;
											}
											@endphp
												<td class="text-center" @if($notas_materias->promedioAnual < 7 && $notasMenores == "1")
															style="color:red;"
													@endif>
													@if($notas_materias->promedioAnual!=0)
													{{$matter->idEstructura!= null ? App\rangosCualitativo::getCalificacionCualitativa($matter->idEstructura,$notas_materias->promedioAnual)['nota'] : bcdiv($notas_materias->promedioAnual, '1', 2)}}
												@endif</td>
												<td class="text-center" @if($notas_materias->supletorio < 7 && $notasMenores == "1" && $notas_materias->supletorio >0)
															style="color:red;"
													@endif>
													@if($notas_materias->remedial!=0)
													{{$matter->idEstructura!= null ? App\rangosCualitativo::getCalificacionCualitativa($matter->idEstructura,$notas_materias->supletorio)['nota'] : bcdiv($notas_materias->supletorio, '1', 2)}}
												@endif</td>
												<td class="text-center" @if($notas_materias->remedial < 7 && $notasMenores == "1" && $notas_materias->remedial >0)
															style="color:red;"
													@endif>
													@if($notas_materias->remedial!=0)
													{{$matter->idEstructura!= null ? App\rangosCualitativo::getCalificacionCualitativa($matter->idEstructura,$notas_materias->remedial)['nota'] : bcdiv($notas_materias->remedial, '1', 2)}}
												@endif</td>
												<td class="text-center" @if($notas_materias->gracia < 7 && $notasMenores == "1" && $notas_materias->gracia >0)
															style="color:red;"
													@endif>
													@if($notas_materias->gracia!=0)
													{{$matter->idEstructura!= null ? App\rangosCualitativo::getCalificacionCualitativa($matter->idEstructura,$notas_materias->gracia)['nota'] : bcdiv($notas_materias->gracia, '1', 2)}}
												@endif</td>
												<td class="text-center" @if($notas_materias->promedioFinal < 7 && $notasMenores == "1")
													style="color:red;"
													@endif>
													@if($notas_materias->promedioFinal!=0)
													{{$matter->idEstructura!= null ? App\rangosCualitativo::getCalificacionCualitativa($matter->idEstructura,$notas_materias->promedioFinal)['nota'] : bcdiv($notas_materias->promedioFinal, '1', 2)}}
												@endif</td>
									@endif
								@endforeach
							@endif
						@endforeach
					@endforeach

						<td class="text-center" @if($estudiante->promedioEstudiante < 7 && $notasMenores == "1")
												style="color:red;" @endif>{{$estudiante->promedioEstudiante!= 0 ? bcdiv($estudiante->promedioEstudiante, '1', 2) : ''}}</td>
						@if($dhi!=null)
							<td class="text-center">{{$dhi['q1']!= null ? $dhi['q1']:'-' }}</td>
							<td class="text-center">{{$dhi['q2']!= null ? $dhi['q2']:'-' }}</td>
							<td class="text-center">{{$dhi["exq1"]!= null ? $dhi['exq1']:'-' }}</td>
						@endif
						<td class="text-center">
							@if($reprobado)
							{{'Alumno: REPROBADO'}}
							@elseif($faltanNotas)
							{{'FALTAN NOTAS'}}
							@elseif($supletorio)
							{{'Alumno: SUPLETORIO'}}
							@elseif($remedial)
							{{'Alumno: REMEDIAL'}}
							@elseif($gracia)
							{{'Alumno: GRACIA'}}
							@else
							{{'Alumno: APROBADO'}}
							@endif
						</td>
					</tr>
				@endforeach
		</table>
			<br>
		 <div class="row">
            <div class="col-xs-6 p-0 text-center ">
                <hr class="certificado__hr">
                <p class="uppercase">
                    {{ $institution->representante1 }} <br> {{ $institution->cargo1 }}
                </p>
            </div>
            <div class="col-xs-6 p-0 text-center">
                <hr class="certificado__hr">
                <p class="uppercase">
                    {{ $institution->representante2 }} <br> {{ $institution->cargo2 }}
                </p>
            </div>
        </div>
			@php
				$sliceEstudiantes = $sliceEstudiantes + $cantidadDeEstudiantesPorHoja; //10 pasa, 20 pasa
				$cantidadDeEstudiantesPorHojaSumatoria = $sliceEstudiantes + $cantidadDeEstudiantesPorHoja; // 20 pasa , 30
			@endphp
			<div style="page-break-after:always;"></div>
		@endwhile
		@php
			$sliceEstudiantes = $cantidadDeEstudiantesPorHojaSumatoria - $cantidadDeEstudiantesPorHoja;
			$cantidadDeEstudiantesPorHojaSumatoria = $cantidadDeEstudiantesPorHojaSumatoria - $cantidadDeEstudiantes;
		@endphp
			@include('partials.encabezados.sabana')
		<table class="table m-0">
			<tr>
			<td width="50%" class="no-border up">{{ $institution->jornada }}</td>
			<td width="50%" class="no-border up text-right">
				@if($course->grado=='Segundo')
					Segundo Grado de Educacion General Elemental
				@endif
				@if($course->grado=='Tercero')
					Tercer Grado de Educacion General Elemental
				@endif
				@if($course->grado=='Cuarto')
					Cuarto Grado de Educacion General Elemental
				@endif
				@if($course->grado=='Quinto')
					Quinto Grado de Educacion General Media
				@endif
				@if($course->grado=='Sexto')
					Sexto Grado de Educacion General Media
				@endif
				@if($course->grado=='Septimo')
					Septimo Grado de Educacion General Media
				@endif
				@if($course->grado=='Octavo')
					Octavo Grado de Educacion General Superior
				@endif
				@if($course->grado=='Noveno')
					Noveno Grado de Educacion General Superior
				@endif
				@if($course->grado=='Decimo')
					Decimo Grado de Educacion General Superior
				@endif
				@if($course->grado=='Primero de Bachillerato')
					Primer Año de Bachillerato General Unificado {{ $course->especializacion }}
				@endif
				@if($course->grado=='Segundo de Bachillerato')
					Segundo Año de Bachillerato General Unificado {{ $course->especializacion }}
				@endif
				@if($course->grado=='Tercero de Bachillerato')
					Tercer Año de Bachillerato General Unificado {{ $course->especializacion }}
				@endif
				{{ $course->paralelo }}
			</td>
			</tr>
		</table>
		<table class="table whitespace-no">
			<tr height="40">
				<td width="5" rowspan="3" class="text-center">No.</td>
				<td rowspan="3" class="bold text-center up">apellidos y nombres</td>
				<td rowspan="3" width="5" class="text-center up bold">
					<p class="s-calificaciones__materia libretaQuimestralPorCurso__nombres">
						<span class="up bold">Comportamiento</span>
					</p>
                </td>
                @foreach($areas->slice(5)->take(6) as $area)
				<td colspan="{{$area->numero * 7}}" class="text-center up">{{ $area->nombreArea}}</td>
				@endforeach
				<td rowspan="3" class="text-center up bold">
								<p class="s-calificaciones__materia libretaQuimestralPorCurso__nombres">
									<span class="up bold">Promedio Final</span>
								</p>
							</td>
				@if($dhi != null)
					<td  colspan="3" class="text-center uppercase bold">
						{{$dhi->nombre}}
					</td>
				@endif
				<td rowspan="3" class="up text-center">observaciones</td>
			</tr>
			<tr height="40">
				@foreach($areas->slice(5)->take(6) as $area)
					@foreach($matters as $matter)
						@if($matter->nombreArea == $area->nombreArea)
							<td class="text-center up bold" colspan="7">
								
									<span class="up bold">{{ $matter->nombre }}</span>
								
							</td>
						@endif
					@endforeach
				@endforeach
				@if($dhi != null)
				<td colspan="3" class="text-center uppercase bold">
					{{$dhi->nombre}}
				</td>
				@endif
			</tr>
			<tr height="40">
				@foreach($areas->slice(5)->take(6) as $area)
					@foreach($matters as $matter)
						@if($matter->nombreArea == $area->nombreArea)
							@foreach($unidades_a as $unidad)
								<td class="text-center">
									<p class="s-calificaciones__materia libretaQuimestralPorCurso__nombres sabanaTd-nombres">
										<span class="up bold">{{$unidad->identificador}}</span>
									</p>
								</td>
							@endforeach
							<td><p class="s-calificaciones__materia libretaQuimestralPorCurso__nombres sabanaTd-nombres">
										<span class="up bold">PRO</span>
									</p>
							</td>
							<td><p class="s-calificaciones__materia libretaQuimestralPorCurso__nombres sabanaTd-nombres">
										<span class="up bold">SUP</span>
									</p>
							</td>
							<td><p class="s-calificaciones__materia libretaQuimestralPorCurso__nombres sabanaTd-nombres">
										<span class="up bold">REM</span>
									</p>
							</td>
							<td><p class="s-calificaciones__materia libretaQuimestralPorCurso__nombres sabanaTd-nombres">
										<span class="up bold">GRA</span>
									</p>
							</td>
							<td><p class="s-calificaciones__materia libretaQuimestralPorCurso__nombres sabanaTd-nombres">
										<span class="up bold">PRO.F</span>
									</p>
							</td>
						@endif
					@endforeach
				@endforeach
				@if($dhi!=null)
					@foreach($unidades_a as $unidad)
									<td class="text-center">
										<p class="s-calificaciones__materia libretaQuimestralPorCurso__nombres sabanaTd-nombres">
											<span class="up bold">{{$unidad->identificador}}</span>
										</p>
									</td>
					@endforeach
									<td class="text-center">
										<p class="s-calificaciones__materia libretaQuimestralPorCurso__nombres sabanaTd-nombres">
											<span class="up bold">PRO.F</span>
										</p>
									</td>
				@endif
			</tr>
			<tr>
				@foreach($sabana->slice($sliceEstudiantes)->take($cantidadDeEstudiantesPorHoja) as $estudiante)
				@php
				$supletorio= false;
				$remedial= false;
				$gracia= false;
				$faltanNotas = false;
				$reprobado = false;
				$student = $students->where('idStudent',$estudiante->estudianteId)->first()
				@endphp
					<td>{{$count++}}</td>
					<td>{{$student->apellidos}} {{$student->nombres}}</td>
					<td class="text-center">
                        @if($confComportamiento->valor !== 'crear')
							@forelse($student->student->comportamientos->where('parcial', 'p3q2') as $comportamiento)
								{{$comportamiento->nota}}
							@empty
								-
							@endforelse
						@else
							@forelse($student->student->comportamientos->where('parcial', 'anual') as $comportamiento)
								{{$comportamiento->nota}}
							@empty
								-
							@endforelse
						@endif
                    </td>
					@foreach($areas->slice(5)->take(6) as $area)
						@foreach($matters as $matter)
							@if($matter->nombreArea == $area->nombreArea)
								@foreach($estudiante->materias as $notas_materias)
									@if($notas_materias->materiaId == $matter->id)
										@foreach($unidades_a as $unidad)
											@foreach($notas_materias->quimestres as $nota_quimestral)
												@if($nota_quimestral->indicador == $unidad->identificador)
													<td class="text-center" @if($nota_quimestral->promediop < 7 && $notasMenores == "1")
													style="color:red;"
													@endif>@if($nota_quimestral->promediop!=0)
													{{$matter->idEstructura!= null ? App\rangosCualitativo::getCalificacionCualitativa($matter->idEstructura,$nota_quimestral->promediop)['nota'] : bcdiv($nota_quimestral->promediop, '1', 2)}}
													@endif
													</td>
												@endif
											@endforeach
											@endforeach
											@php
											if($notas_materias->promedioAnual == 0)
											$faltanNotas = true;
											elseif($notas_materias->supletorio==0 && $notas_materias->promedioFinal<7 && $notas_materias->promedioFinal>=5 ) {
											$supletorio= true;
											}elseif($notas_materias->supletorio>=0 && $notas_materias->promedioFinal <7 && $notas_materias->remedial ==0 ){
											$remedial= true;
											}elseif($notas_materias->supletorio>=0 && $notas_materias->promedioFinal <7 && $notas_materias->remedial >=0 && $notas_materias->gracia ==0 ){
											$gracia= true;
											}elseif($notas_materias->promedioFinal>0 && $notas_materias->promedioAnual < 7 ){
											$reprobado= true;
											}
											@endphp
												<td class="text-center" @if($notas_materias->promedioAnual < 7 && $notasMenores == "1")
															style="color:red;"
													@endif>
													@if($notas_materias->promedioAnual!=0)
													{{$matter->idEstructura!= null ? App\rangosCualitativo::getCalificacionCualitativa($matter->idEstructura,$notas_materias->promedioAnual)['nota'] : bcdiv($notas_materias->promedioAnual, '1', 2)}}
												@endif</td>
												<td class="text-center" @if($notas_materias->supletorio < 7 && $notasMenores == "1" && $notas_materias->supletorio >0)
															style="color:red;"
													@endif>
													@if($notas_materias->remedial!=0)
													{{$matter->idEstructura!= null ? App\rangosCualitativo::getCalificacionCualitativa($matter->idEstructura,$notas_materias->supletorio)['nota'] : bcdiv($notas_materias->supletorio, '1', 2)}}
												@endif</td>
												<td class="text-center" @if($notas_materias->remedial < 7 && $notasMenores == "1" && $notas_materias->remedial >0)
															style="color:red;"
													@endif>
													@if($notas_materias->remedial!=0)
													{{$matter->idEstructura!= null ? App\rangosCualitativo::getCalificacionCualitativa($matter->idEstructura,$notas_materias->remedial)['nota'] : bcdiv($notas_materias->remedial, '1', 2)}}
												@endif</td>
												<td class="text-center" @if($notas_materias->gracia < 7 && $notasMenores == "1" && $notas_materias->gracia >0)
															style="color:red;"
													@endif>
													@if($notas_materias->gracia!=0)
													{{$matter->idEstructura!= null ? App\rangosCualitativo::getCalificacionCualitativa($matter->idEstructura,$notas_materias->gracia)['nota'] : bcdiv($notas_materias->gracia, '1', 2)}}
												@endif</td>
												<td class="text-center" @if($notas_materias->promedioFinal < 7 && $notasMenores == "1")
													style="color:red;"
													@endif>
													@if($notas_materias->promedioFinal!=0)
													{{$matter->idEstructura!= null ? App\rangosCualitativo::getCalificacionCualitativa($matter->idEstructura,$notas_materias->promedioFinal)['nota'] : bcdiv($notas_materias->promedioFinal, '1', 2)}}
												@endif</td>

									@endif
								@endforeach
							@endif
						@endforeach
					@endforeach
					<td class="text-center" @if($estudiante->promedioEstudiante < 7 && $notasMenores == "1")
												style="color:red;" @endif>{{$estudiante->promedioEstudiante!= 0 ? bcdiv($estudiante->promedioEstudiante, '1', 2) : ''}}</td>
						@if($dhi!=null)
							<td class="text-center">{{$dhi['q1']!= null ? $dhi['q1']:'-' }}</td>
							<td class="text-center">{{$dhi['q2']!= null ? $dhi['q2']:'-' }}</td>
							<td class="text-center">{{$dhi["exq1"]!= null ? $dhi['exq1']:'-' }}</td>
						@endif
						<td class="text-center">
							@if($reprobado)
							{{'Alumno: REPROBADO'}}
							@elseif($faltanNotas)
							{{'FALTAN NOTAS'}}
							@elseif($supletorio)
							{{'Alumno: SUPLETORIO'}}
							@elseif($remedial)
							{{'Alumno: REMEDIAL'}}
							@elseif($gracia)
							{{'Alumno: GRACIA'}}
							@else
							{{'Alumno: APROBADO'}}
							@endif
						</td>
					</tr>
				@endforeach
		</table>
			<br>
		 <div class="row">
            <div class="col-xs-6 p-0 text-center ">
                <hr class="certificado__hr">
                <p class="uppercase">
                    {{ $institution->representante1 }} <br> {{ $institution->cargo1 }}
                </p>
            </div>
            <div class="col-xs-6 p-0 text-center">
                <hr class="certificado__hr">
                <p class="uppercase">
                    {{ $institution->representante2 }} <br> {{ $institution->cargo2 }}
                </p>
            </div>
        </div>

	@else
		{{-- 2da hoja --}}
		@php
			$sliceEstudiantes = 0;
			$cantidadDeEstudiantesPorHojaSumatoria = $reinicioCantidadDeEstudiantesPorHoja;
			$count = 1;
		@endphp
		@while ($cantidadDeEstudiantesPorHojaSumatoria < $cantidadDeEstudiantes)
				@include('partials.encabezados.sabana')
			<table class="table m-0">
				<tr>
				<td width="50%" class="no-border up">{{ $institution->jornada }}</td>
				<td width="50%" class="no-border up text-right">
					@if($course->grado=='Segundo')
						Segundo Grado de Educacion General Elemental
					@endif
					@if($course->grado=='Tercero')
						Tercer Grado de Educacion General Elemental
					@endif
					@if($course->grado=='Cuarto')
						Cuarto Grado de Educacion General Elemental
					@endif
					@if($course->grado=='Quinto')
						Quinto Grado de Educacion General Media
					@endif
					@if($course->grado=='Sexto')
						Sexto Grado de Educacion General Media
					@endif
					@if($course->grado=='Septimo')
						Septimo Grado de Educacion General Media
					@endif
					@if($course->grado=='Octavo')
						Octavo Grado de Educacion General Superior
					@endif
					@if($course->grado=='Noveno')
						Noveno Grado de Educacion General Superior
					@endif
					@if($course->grado=='Decimo')
						Decimo Grado de Educacion General Superior
					@endif
					@if($course->grado=='Primero de Bachillerato')
						Primer Año de Bachillerato General Unificado {{ $course->especializacion }}
					@endif
					@if($course->grado=='Segundo de Bachillerato')
						Segundo Año de Bachillerato General Unificado {{ $course->especializacion }}
					@endif
					@if($course->grado=='Tercero de Bachillerato')
						Tercer Año de Bachillerato General Unificado {{ $course->especializacion }}
					@endif
					{{ $course->paralelo }}
				</td>
				</tr>
			</table>
			<table class="table whitespace-no">
				<tr height="40">
					<td width="5" rowspan="3" class="text-center">No.</td>
					<td rowspan="3" class="bold text-center up">apellidos y nombres</td>
					<td rowspan="3" width="5" class="text-center up bold">
						<p class="s-calificaciones__materia libretaQuimestralPorCurso__nombres">
							<span class="up bold">Comportamiento</span>
						</p>
	                </td>
	                @foreach($areas->slice(5)->take(5) as $area)
					<td colspan="{{$area->numero * 7}}" class="text-center up">{{ $area->nombreArea}}</td>
					@endforeach
				</tr>
				<tr height="40">
					@foreach($areas->slice(5)->take(5) as $area)
						@foreach($matters as $matter)
							@if($matter->nombreArea == $area->nombreArea)
								<td class="text-center up bold" colspan="7">
									
										<span class="up bold">{{ $matter->nombre }}</span>
									
								</td>
							@endif
						@endforeach
					@endforeach
				</tr>
				<tr height="40">
					@foreach($areas->slice(5)->take(5) as $area)
						@foreach($matters as $matter)
							@if($matter->nombreArea == $area->nombreArea)
								@foreach($unidades_a as $unidad)
									<td class="text-center">
										<p class="s-calificaciones__materia libretaQuimestralPorCurso__nombres sabanaTd-nombres">
											<span class="up bold">{{$unidad->identificador}}</span>
										</p>
									</td>
								@endforeach
								<td><p class="s-calificaciones__materia libretaQuimestralPorCurso__nombres sabanaTd-nombres">
											<span class="up bold">PRO</span>
										</p>
								</td>
								<td><p class="s-calificaciones__materia libretaQuimestralPorCurso__nombres sabanaTd-nombres">
											<span class="up bold">SUP</span>
										</p>
								</td>
								<td><p class="s-calificaciones__materia libretaQuimestralPorCurso__nombres sabanaTd-nombres">
											<span class="up bold">REM</span>
										</p>
								</td>
								<td><p class="s-calificaciones__materia libretaQuimestralPorCurso__nombres sabanaTd-nombres">
											<span class="up bold">GRA</span>
										</p>
								</td>
								<td><p class="s-calificaciones__materia libretaQuimestralPorCurso__nombres sabanaTd-nombres">
											<span class="up bold">PRO.F</span>
										</p>
								</td>
							@endif
						@endforeach
					@endforeach
				</tr>
				<tr>
					@foreach($sabana->slice($sliceEstudiantes)->take($cantidadDeEstudiantesPorHoja) as $estudiante)
					@php
					$student = $students->where('idStudent',$estudiante->estudianteId)->first()
					@endphp
						<td>{{$count++}}</td>
						<td>{{$student->apellidos}} {{$student->nombres}}</td>
						<td class="text-center">
	                        @if($confComportamiento->valor !== 'crear')
								@forelse($student->student->comportamientos->where('parcial', 'p3q2') as $comportamiento)
									{{$comportamiento->nota}}
								@empty
									-
								@endforelse
							@else
								@forelse($student->student->comportamientos->where('parcial', 'anual') as $comportamiento)
									{{$comportamiento->nota}}
								@empty
									-
								@endforelse
							@endif
	                    </td>
						@foreach($areas->slice(5)->take(5) as $area)
							@foreach($matters as $matter)
								@if($matter->nombreArea == $area->nombreArea)
									@foreach($estudiante->materias as $notas_materias)
										@if($notas_materias->materiaId == $matter->id)
											@foreach($unidades_a as $unidad)
												@foreach($notas_materias->quimestres as $nota_quimestral)
													@if($nota_quimestral->indicador == $unidad->identificador)
														<td class="text-center" @if($nota_quimestral->promediop < 7 && $notasMenores == "1")
													style="color:red;"
													@endif>@if($nota_quimestral->promediop!=0)
													{{$matter->idEstructura!= null ? App\rangosCualitativo::getCalificacionCualitativa($matter->idEstructura,$nota_quimestral->promediop)['nota'] : bcdiv($nota_quimestral->promediop, '1', 2)}}
													@endif
													</td>
													@endif
												@endforeach
												@endforeach
												@php
												if($notas_materias->promedioAnual == 0)
											$faltanNotas = true;
											elseif($notas_materias->supletorio==0 && $notas_materias->promedioFinal<7 && $notas_materias->promedioFinal>=5 ) {
											$supletorio= true;
											}elseif($notas_materias->supletorio>=0 && $notas_materias->promedioFinal <7 && $notas_materias->remedial ==0 ){
											$remedial= true;
											}elseif($notas_materias->supletorio>=0 && $notas_materias->promedioFinal <7 && $notas_materias->remedial >=0 && $notas_materias->gracia ==0 ){
											$gracia= true;
											}elseif($notas_materias->promedioFinal>0 && $notas_materias->promedioAnual < 7 ){
											$reprobado= true;
											}
											@endphp
													<td class="text-center" @if($notas_materias->promedioAnual < 7 && $notasMenores == "1")
															style="color:red;"
													@endif>
													@if($notas_materias->promedioAnual!=0)
													{{$matter->idEstructura!= null ? App\rangosCualitativo::getCalificacionCualitativa($matter->idEstructura,$notas_materias->promedioAnual)['nota'] : bcdiv($notas_materias->promedioAnual, '1', 2)}}
												@endif</td>
												<td class="text-center" @if($notas_materias->supletorio < 7 && $notasMenores == "1" && $notas_materias->supletorio >0)
															style="color:red;"
													@endif>
													@if($notas_materias->remedial!=0)
													{{$matter->idEstructura!= null ? App\rangosCualitativo::getCalificacionCualitativa($matter->idEstructura,$notas_materias->supletorio)['nota'] : bcdiv($notas_materias->supletorio, '1', 2)}}
												@endif</td>
												<td class="text-center" @if($notas_materias->remedial < 7 && $notasMenores == "1" && $notas_materias->remedial >0)
															style="color:red;"
													@endif>
													@if($notas_materias->remedial!=0)
													{{$matter->idEstructura!= null ? App\rangosCualitativo::getCalificacionCualitativa($matter->idEstructura,$notas_materias->remedial)['nota'] : bcdiv($notas_materias->remedial, '1', 2)}}
												@endif</td>
												<td class="text-center" @if($notas_materias->gracia < 7 && $notasMenores == "1" && $notas_materias->gracia >0)
															style="color:red;"
													@endif>
													@if($notas_materias->gracia!=0)
													{{$matter->idEstructura!= null ? App\rangosCualitativo::getCalificacionCualitativa($matter->idEstructura,$notas_materias->gracia)['nota'] : bcdiv($notas_materias->gracia, '1', 2)}}
												@endif</td>
												<td class="text-center" @if($notas_materias->promedioFinal < 7 && $notasMenores == "1")
													style="color:red;"
													@endif>
													@if($notas_materias->promedioFinal!=0)
													{{$matter->idEstructura!= null ? App\rangosCualitativo::getCalificacionCualitativa($matter->idEstructura,$notas_materias->promedioFinal)['nota'] : bcdiv($notas_materias->promedioFinal, '1', 2)}}
												@endif</td>
										@endif
									@endforeach
								@endif
							@endforeach
						@endforeach
						</tr>
					@endforeach
			</table>
				<br>
			<table class="table">
				<tr>
					<th width="35%"></th>
					<th width="30%">
						<hr style="border:1px solid black;">
						<h4 class="firma--size m-0 uppercase text-center">{{$institution->representante1}}</h4>
						<h4 class="firma--size m-0 uppercase text-center">{{$institution->cargo1}}</h4>
					</th>
					<th width="35%"></th>
				</tr>
        	</table>
			@php
				$sliceEstudiantes = $sliceEstudiantes + $cantidadDeEstudiantesPorHoja; //10 pasa, 20 pasa
				$cantidadDeEstudiantesPorHojaSumatoria = $sliceEstudiantes; // 20 pasa , 30
			@endphp
			<div style="page-break-after:always;"></div>
		@endwhile
		{{-- 3era hoja --}}
		@php
			$sliceEstudiantes = 0;
			$cantidadDeEstudiantesPorHojaSumatoria = $reinicioCantidadDeEstudiantesPorHoja;
			$count = 1;
		@endphp
		@while ($cantidadDeEstudiantesPorHojaSumatoria < $cantidadDeEstudiantes)

				@include('partials.encabezados.sabana')
		<table class="table m-0">
			<tr>
			<td width="50%" class="no-border up">{{ $institution->jornada }}</td>
			<td width="50%" class="no-border up text-right">
				@if($course->grado=='Segundo')
					Segundo Grado de Educacion General Elemental
				@endif
				@if($course->grado=='Tercero')
					Tercer Grado de Educacion General Elemental
				@endif
				@if($course->grado=='Cuarto')
					Cuarto Grado de Educacion General Elemental
				@endif
				@if($course->grado=='Quinto')
					Quinto Grado de Educacion General Media
				@endif
				@if($course->grado=='Sexto')
					Sexto Grado de Educacion General Media
				@endif
				@if($course->grado=='Septimo')
					Septimo Grado de Educacion General Media
				@endif
				@if($course->grado=='Octavo')
					Octavo Grado de Educacion General Superior
				@endif
				@if($course->grado=='Noveno')
					Noveno Grado de Educacion General Superior
				@endif
				@if($course->grado=='Decimo')
					Decimo Grado de Educacion General Superior
				@endif
				@if($course->grado=='Primero de Bachillerato')
					Primer Año de Bachillerato General Unificado {{ $course->especializacion }}
				@endif
				@if($course->grado=='Segundo de Bachillerato')
					Segundo Año de Bachillerato General Unificado {{ $course->especializacion }}
				@endif
				@if($course->grado=='Tercero de Bachillerato')
					Tercer Año de Bachillerato General Unificado {{ $course->especializacion }}
				@endif
				{{ $course->paralelo }}
			</td>
			</tr>
		</table>
		<table class="table whitespace-no">
			<tr height="40">
				<td width="5" rowspan="3" class="text-center">No.</td>
				<td rowspan="3" class="bold text-center up">apellidos y nombres</td>
				<td rowspan="3" width="5" class="text-center up bold">
					<p class="s-calificaciones__materia libretaQuimestralPorCurso__nombres">
						<span class="up bold">Comportamiento</span>
					</p>
                </td>
                @foreach($areas->slice(10)->take(5) as $area)
				<td colspan="{{$area->numero * 7}}" class="text-center up">{{ $area->nombreArea}}</td>
				@endforeach
				<td rowspan="3" class="text-center up bold">
                    <p class="s-calificaciones__materia libretaQuimestralPorCurso__nombres">
                        <span class="up bold">Promedio Final</span>
                    </p>
                </td>
				@if($dhi != null)
					<td colspan="3" class="text-center uppercase bold">
						{{$dhi->nombre}}
					</td>
				@endif
				<td rowspan="3" class="up text-center">observaciones</td>
			</tr>
			<tr height="40">
				@foreach($areas->slice(10)->take(5) as $area)
					@foreach($matters as $matter)
						@if($matter->nombreArea == $area->nombreArea)
							<td class="text-center up bold" colspan="7">
								
									<span class="up bold">{{ $matter->nombre }}</span>
								
							</td>
						@endif
					@endforeach
				@endforeach
				@if($dhi != null)
				<td colspan="3" class="text-center uppercase bold">
					{{$dhi->nombre}}
				</td>
				@endif
			</tr>
			<tr height="40">
				@foreach($areas->slice(10)->take(5) as $area)
					@foreach($matters as $matter)
						@if($matter->nombreArea == $area->nombreArea)
							@foreach($unidades_a as $unidad)
								<td class="text-center">
									<p class="s-calificaciones__materia libretaQuimestralPorCurso__nombres sabanaTd-nombres">
										<span class="up bold">{{$unidad->identificador}}</span>
									</p>
								</td>
							@endforeach
							<td><p class="s-calificaciones__materia libretaQuimestralPorCurso__nombres sabanaTd-nombres">
										<span class="up bold">PRO</span>
									</p>
							</td>
							<td><p class="s-calificaciones__materia libretaQuimestralPorCurso__nombres sabanaTd-nombres">
										<span class="up bold">SUP</span>
									</p>
							</td>
							<td><p class="s-calificaciones__materia libretaQuimestralPorCurso__nombres sabanaTd-nombres">
										<span class="up bold">REM</span>
									</p>
							</td>
							<td><p class="s-calificaciones__materia libretaQuimestralPorCurso__nombres sabanaTd-nombres">
										<span class="up bold">GRA</span>
									</p>
							</td>
							<td><p class="s-calificaciones__materia libretaQuimestralPorCurso__nombres sabanaTd-nombres">
										<span class="up bold">PRO.F</span>
									</p>
							</td>
						@endif
					@endforeach
				@endforeach
				@if($dhi!=null)
					@foreach($unidades_a as $unidad)
									<td class="text-center">
										<p class="s-calificaciones__materia libretaQuimestralPorCurso__nombres sabanaTd-nombres">
											<span class="up bold">{{$unidad->identificador}}</span>
										</p>
									</td>
					@endforeach
									<td class="text-center">
										<p class="s-calificaciones__materia libretaQuimestralPorCurso__nombres sabanaTd-nombres">
											<span class="up bold">PRO.F</span>
										</p>
									</td>
				@endif
			</tr>
			<tr>
				@foreach($sabana->slice($sliceEstudiantes)->take($cantidadDeEstudiantesPorHoja) as $estudiante)
				@php
				$supletorio= false;
				$remedial= false;
				$gracia= false;
				$student = $students->where('idStudent',$estudiante->estudianteId)->first()
				@endphp
					<td>{{$count++}}</td>
					<td>{{$student->apellidos}} {{$student->nombres}}</td>
					<td class="text-center">
                        @if($confComportamiento->valor !== 'crear')
							@forelse($student->student->comportamientos->where('parcial', 'p3q2') as $comportamiento)
								{{$comportamiento->nota}}
							@empty
								-
							@endforelse
						@else
							@forelse($student->student->comportamientos->where('parcial', 'anual') as $comportamiento)
								{{$comportamiento->nota}}
							@empty
								-
							@endforelse
						@endif
                    </td>
					@foreach($areas->slice(10)->take(5) as $area)
						@foreach($matters as $matter)
							@if($matter->nombreArea == $area->nombreArea)
								@foreach($estudiante->materias as $notas_materias)
									@if($notas_materias->materiaId == $matter->id)
										@foreach($unidades_a as $unidad)
											@foreach($notas_materias->quimestres as $nota_quimestral)
												@if($nota_quimestral->indicador == $unidad->identificador)
													<td class="text-center" @if($nota_quimestral->promediop < 7 && $notasMenores == "1")
													style="color:red;"
													@endif>@if($nota_quimestral->promediop!=0)
													{{$matter->idEstructura!= null ? App\rangosCualitativo::getCalificacionCualitativa($matter->idEstructura,$nota_quimestral->promediop)['nota'] : bcdiv($nota_quimestral->promediop, '1', 2)}}
													@endif
													</td>
												@endif
											@endforeach
											@endforeach
											@php
											if($notas_materias->promedioAnual == 0)
											$faltanNotas = true;
											elseif($notas_materias->supletorio==0 && $notas_materias->promedioFinal<7 && $notas_materias->promedioFinal>=5 ) {
											$supletorio= true;
											}elseif($notas_materias->supletorio>=0 && $notas_materias->promedioFinal <7 && $notas_materias->remedial ==0 ){
											$remedial= true;
											}elseif($notas_materias->supletorio>=0 && $notas_materias->promedioFinal <7 && $notas_materias->remedial >=0 && $notas_materias->gracia ==0 ){
											$gracia= true;
											}elseif($notas_materias->promedioFinal>0 && $notas_materias->promedioAnual < 7 ){
											$reprobado= true;
											}
											@endphp
												<td class="text-center" @if($notas_materias->promedioAnual < 7 && $notasMenores == "1")
															style="color:red;"
													@endif>
													@if($notas_materias->promedioAnual!=0)
													{{$matter->idEstructura!= null ? App\rangosCualitativo::getCalificacionCualitativa($matter->idEstructura,$notas_materias->promedioAnual)['nota'] : bcdiv($notas_materias->promedioAnual, '1', 2)}}
												@endif</td>
												<td class="text-center" @if($notas_materias->supletorio < 7 && $notasMenores == "1" && $notas_materias->supletorio >0)
															style="color:red;"
													@endif>
													@if($notas_materias->remedial!=0)
													{{$matter->idEstructura!= null ? App\rangosCualitativo::getCalificacionCualitativa($matter->idEstructura,$notas_materias->supletorio)['nota'] : bcdiv($notas_materias->supletorio, '1', 2)}}
												@endif</td>
												<td class="text-center" @if($notas_materias->remedial < 7 && $notasMenores == "1" && $notas_materias->remedial >0)
															style="color:red;"
													@endif>
													@if($notas_materias->remedial!=0)
													{{$matter->idEstructura!= null ? App\rangosCualitativo::getCalificacionCualitativa($matter->idEstructura,$notas_materias->remedial)['nota'] : bcdiv($notas_materias->remedial, '1', 2)}}
												@endif</td>
												<td class="text-center" @if($notas_materias->gracia < 7 && $notasMenores == "1" && $notas_materias->gracia >0)
															style="color:red;"
													@endif>
													@if($notas_materias->gracia!=0)
													{{$matter->idEstructura!= null ? App\rangosCualitativo::getCalificacionCualitativa($matter->idEstructura,$notas_materias->gracia)['nota'] : bcdiv($notas_materias->gracia, '1', 2)}}
												@endif</td>
												<td class="text-center" @if($notas_materias->promedioFinal < 7 && $notasMenores == "1")
													style="color:red;"
													@endif>
													@if($notas_materias->promedioFinal!=0)
													{{$matter->idEstructura!= null ? App\rangosCualitativo::getCalificacionCualitativa($matter->idEstructura,$notas_materias->promedioFinal)['nota'] : bcdiv($notas_materias->promedioFinal, '1', 2)}}
												@endif</td>
									@endif
								@endforeach
							@endif
						@endforeach
					@endforeach
							<td class="text-center" 
                                @if($estudiante->promedioEstudiante < 7 && $notasMenores == "1")
									style="color:red;"
                                @endif
                                >{{$estudiante->promedioEstudiante!= 0 ? bcdiv($estudiante->promedioEstudiante, '1', 2) : ''}}
                            </td>
                            @if($dhi!=null)
                                <td class="text-center">{{$dhi['q1']!= null ? $dhi['q1']:'-' }}</td>
                                <td class="text-center">{{$dhi['q2']!= null ? $dhi['q2']:'-' }}</td>
                                <td class="text-center">{{$dhi["exq1"]!= null ? $dhi['exq1']:'-' }}</td>
                            @endif
							<td class="text-center">
							    @if($reprobado)
							        {{'Alumno: REPROBADO'}}
							    @elseif($faltanNotas)
							        {{'FALTAN NOTAS'}}
							    @elseif($supletorio)
							        {{'Alumno: SUPLETORIO'}}
							    @elseif($remedial)
							        {{'Alumno: REMEDIAL'}}
							    @elseif($gracia)
							        {{'Alumno: GRACIA'}}
							    @else
							        {{'Alumno: APROBADO'}}
							    @endif
						    </td>
			</tr>
				@endforeach
		</table>
			<br>
		 <div class="row">
            <div class="col-xs-6 p-0 text-center ">
                <hr class="certificado__hr">
                <p class="uppercase">
                    {{ $institution->representante1 }} <br> {{ $institution->cargo1 }}
                </p>
            </div>
            <div class="col-xs-6 p-0 text-center">
                <hr class="certificado__hr">
                <p class="uppercase">
                    {{ $institution->representante2 }} <br> {{ $institution->cargo2 }}
                </p>
            </div>
        </div>
			@php
				$sliceEstudiantes = $sliceEstudiantes + $cantidadDeEstudiantesPorHoja; //10 pasa, 20 pasa
				$cantidadDeEstudiantesPorHojaSumatoria = $sliceEstudiantes; // 20 pasa , 30
			@endphp
			<div style="page-break-after:always;"></div>
		@endwhile
	@endif
</body>
</html>