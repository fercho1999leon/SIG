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
$numeroDeMaterias = count($matters);

$esSupletorios = [];
$aprovechamiento = [];
foreach($students as $student){
	$esSupletorios[$student->idStudent] = "APROBADO";
	$aprovechamiento[$student->idStudent] = 0;
	foreach($matters as $matter){
		$aprovechamiento[$student->idStudent] += $promediosFinales[$matter->id][$student->idStudent];
		if($promediosAnuales[$matter->id][$student->idStudent] < 7 && $promediosAnuales[$matter->id][$student->idStudent] != 0 ){

			if($supletorios[$matter->id][$student->idStudent] == 0){
				$esSupletorios[$student->idStudent] = "SUPLETORIO";
			}else if($supletorios[$matter->id][$student->idStudent] >= 7){
				//$esSupletorios[$student->idStudent] = "APROBADO";
			}else {
				if($remediales[$matter->id][$student->idStudent] == 0 && $supletorios[$matter->id][$student->idStudent] < 7){
					$esSupletorios[$student->idStudent] = "REMEDIAL";
				}else if($remediales[$matter->id][$student->idStudent] >= 7){
					//$esSupletorios[$student->idStudent] = "APROBADO";
				}else{
					if($gracias[$matter->id][$student->idStudent] == 0 && $remediales[$matter->id][$student->idStudent] < 7){
						$esSupletorios[$student->idStudent] = "GRACIA";
					}else if($gracias[$matter->id][$student->idStudent] >= 7){
						//$esSupletorios[$student->idStudent] = "APROBADO";
					}
				}
			}


		}else if ($promediosAnuales[$matter->id][$student->idStudent] == 0)
			$esSupletorios[$student->idStudent] = "NOTAS INCOMPLETAS";
	}
}

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
				@foreach(array_unique($matters->take(6)->pluck('area')->toArray()) as $matter)
					<td colspan="{{ count($matters->take(6)->where('area', $matter) ) * 7}}" class="text-center up bold">{{ $matter }}</td>
				@endforeach
			</tr>
			<tr height="130">
				@foreach($matters->take(6) as $matter)
					<td colspan="7" class="text-center up bold">
						<p class="s-calificaciones__materia libretaQuimestralPorCurso__nombres">
							<span class="up bold">{{ $matter->nombre }}</span>
						</p>
					</td>
				@endforeach
			</tr>
			<tr height="40">
				@foreach($matters->take(6) as $matter)
					<td class="text-center">
						<p class="s-calificaciones__materia libretaQuimestralPorCurso__nombres sabanaTd-nombres">
							<span class="up bold">q1</span>
						</p>
					</td>
					<td class="text-center">
						<p class="s-calificaciones__materia libretaQuimestralPorCurso__nombres sabanaTd-nombres">
							<span class="up bold">q2</span>
						</p>
					</td>
					<td class="text-center">
						<p class="s-calificaciones__materia libretaQuimestralPorCurso__nombres sabanaTd-nombres">
							<span class="up bold">pro</span>
						</p>
					</td>
					<td class="text-center">
						<p class="s-calificaciones__materia libretaQuimestralPorCurso__nombres sabanaTd-nombres">
							<span class="up bold">sup</span>
						</p>
					</td>
					<td class="text-center">
						<p class="s-calificaciones__materia libretaQuimestralPorCurso__nombres sabanaTd-nombres">
							<span class="up bold">rem</span>
						</p>
					</td>
					<td class="text-center">
						<p class="s-calificaciones__materia libretaQuimestralPorCurso__nombres sabanaTd-nombres">
							<span class="up bold">gra</span>
						</p>
					</td>
					<td class="text-center">
						<p class="s-calificaciones__materia libretaQuimestralPorCurso__nombres sabanaTd-nombres">
							<span class="up bold">p.f</span>
						</p>
					</td>
				@endforeach
            </tr>
			@foreach($students->slice($sliceEstudiantes)->take($cantidadDeEstudiantesPorHoja) as $student)
				<tr>
					<td class="text-center">{{$count++}}</td>
					<td width="300" class="up">{{ $student->apellidos }} {{ $student->nombres }} </td>
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
					@foreach($matters->take(6) as $matter)
						<td class="text-center"> {{ $promediosQ1[$matter->id][$student->idStudent] == 0 ? "" : $promediosQ1[$matter->id][$student->idStudent] }} </td>
						<td class="text-center">{{ $promediosQ2[$matter->id][$student->idStudent] == 0 ? "" : $promediosQ2[$matter->id][$student->idStudent] }}</td>
						<td class="text-center"
						@if($notasMenores == "1")
							@if($promediosAnuales[$matter->id][$student->idStudent] < (int)$nota_menor->valor && $promediosAnuales[$matter->id][$student->idStudent]!=0)
								style="color:red;"
							@endif
						@endif >
						{{ $promediosAnuales[$matter->id][$student->idStudent] == 0 ? "" : $promediosAnuales[$matter->id][$student->idStudent] == 0 ? "" : $promediosAnuales[$matter->id][$student->idStudent] }}</td>
						@if( $promediosAnuales[$matter->id][$student->idStudent] >= 7)
							<td class="text-center"></td>
							<td class="text-center"></td>
							<td class="text-center"></td>
							<td class="text-center">{{ $promediosFinales[$matter->id][$student->idStudent] }}</td>
						@else
							<td class="text-center">{{ $supletorios[$matter->id][$student->idStudent] == 0 ? "" : $supletorios[$matter->id][$student->idStudent] }}</td>
							<td class="text-center">{{ $remediales[$matter->id][$student->idStudent] == 0 ? "" : $remediales[$matter->id][$student->idStudent] }}</td>
							<td class="text-center">{{ $gracias[$matter->id][$student->idStudent] == 0 ? "" : $gracias[$matter->id][$student->idStudent] }}</td>
							<td class="text-center">
								@if( $supletorios[$matter->id][$student->idStudent] < 7 && $remediales[$matter->id][$student->idStudent] < 7 && $gracias[$matter->id][$student->idStudent] < 7)

								@else
									7
								@endif
							</td>
						@endif
					@endforeach
				</tr>
			@endforeach
		</table>
		<br>
		<br>
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

			@foreach(array_unique($matters->take(6)->pluck('area')->toArray()) as $matter)
				<td colspan="{{ count($matters->take(6)->where('area', $matter) ) * 7}}" class="text-center up bold">{{ $matter }}</td>
			@endforeach
		</tr>
		<tr height="130">
			@foreach($matters->take(6) as $matter)
				<td colspan="7" class="text-center up bold">
					<p class="s-calificaciones__materia libretaQuimestralPorCurso__nombres">
						<span class="up bold">{{ $matter->nombre }}</span>
					</p>
				</td>
			@endforeach
        </tr>
		<tr height="40">
			@foreach($matters->take(6) as $matter)
				<td class="text-center">
					<p class="s-calificaciones__materia libretaQuimestralPorCurso__nombres sabanaTd-nombres">
						<span class="up bold">q1</span>
					</p>
				</td>
				<td class="text-center">
					<p class="s-calificaciones__materia libretaQuimestralPorCurso__nombres sabanaTd-nombres">
						<span class="up bold">q2</span>
					</p>
				</td>
				<td class="text-center">
					<p class="s-calificaciones__materia libretaQuimestralPorCurso__nombres sabanaTd-nombres">
						<span class="up bold">pro</span>
					</p>
				</td>
				<td class="text-center">
					<p class="s-calificaciones__materia libretaQuimestralPorCurso__nombres sabanaTd-nombres">
						<span class="up bold">sup</span>
					</p>
				</td>
				<td class="text-center">
					<p class="s-calificaciones__materia libretaQuimestralPorCurso__nombres sabanaTd-nombres">
						<span class="up bold">rem</span>
					</p>
				</td>
				<td class="text-center">
					<p class="s-calificaciones__materia libretaQuimestralPorCurso__nombres sabanaTd-nombres">
						<span class="up bold">gra</span>
					</p>
				</td>
				<td class="text-center">
					<p class="s-calificaciones__materia libretaQuimestralPorCurso__nombres sabanaTd-nombres">
						<span class="up bold">p.f</span>
					</p>
				</td>
			@endforeach
        </tr>

		@foreach($students->slice($sliceEstudiantes)->take($cantidadDeEstudiantesPorHoja) as $student)
			<tr>
				<td class="text-center">{{$count++}}</td>
				<td width="300" class="up">{{ $student->apellidos }} {{ $student->nombres }} </td>
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
                @foreach($matters->take(6) as $matter)
                    @if (!$matter->getArea->dependiente)
                        <td class="text-center">{{ $promediosQ1[$matter->id][$student->idStudent] == 0 ? "" : $promediosQ1[$matter->id][$student->idStudent] }} </td>
                        <td class="text-center">{{ $promediosQ2[$matter->id][$student->idStudent] == 0 ? "" : $promediosQ2[$matter->id][$student->idStudent] }}</td>
                        <td class="text-center"
                        @if($notasMenores == "1")
                            @if($promediosAnuales[$matter->id][$student->idStudent] < (int)$nota_menor->valor && $promediosAnuales[$matter->id][$student->idStudent]!=0)
                                style="color:red;"
                            @endif
                        @endif >
                        {{ $promediosAnuales[$matter->id][$student->idStudent] == 0 ? "" : $promediosAnuales[$matter->id][$student->idStudent] == 0 ? "" : $promediosAnuales[$matter->id][$student->idStudent] }}</td>
                        @if( $promediosAnuales[$matter->id][$student->idStudent] >= 7)
                            <td class="text-center"></td>
                            <td class="text-center"></td>
                            <td class="text-center"></td>
                            <td class="text-center">{{ $promediosFinales[$matter->id][$student->idStudent] }}</td>
                        @else
                            <td class="text-center">{{ $supletorios[$matter->id][$student->idStudent] == 0 ? "" : $supletorios[$matter->id][$student->idStudent] }}</td>
                            <td class="text-center">{{ $remediales[$matter->id][$student->idStudent] == 0 ? "" : $remediales[$matter->id][$student->idStudent] }}</td>
                            <td class="text-center">{{ $gracias[$matter->id][$student->idStudent] == 0 ? "" : $gracias[$matter->id][$student->idStudent] }}</td>
                            <td class="text-center">
                                @if( $supletorios[$matter->id][$student->idStudent] < 7 && $remediales[$matter->id][$student->idStudent] < 7 && $gracias[$matter->id][$student->idStudent] < 7)

                                @else
                                    7
                                @endif
                            </td>
                        @endif
                    @else
                        @php
                            $materiasArea = App\Matter::where(['idCurso' => $course->id,'idArea' => $matter->getArea->id])->get();
                            $materiaPrincipal = $materiasArea->where('principal', 1)->first();
                            $pr1 = 0;
                            $pr2 = 0;
                            foreach ($materiasArea as $materia) {
                                $pr1 += $promediosQ1[$materia->id][$student->idStudent];
                                $pr2 += $promediosQ2[$materia->id][$student->idStudent];
                            }
                            $pr1 = bcdiv($pr1/ count($materiasArea), '1', 2);
                            $pr2 = bcdiv($pr2/ count($materiasArea), '1', 2);
                            $prf = bcdiv(($pr1 + $pr2) / 2, '1', 2);
                        @endphp
                        <td class="text-center">{{$pr1}}</td>
                        <td class="text-center">{{$pr2}}</td>
                        <td class="text-center">{{$prf}}</td>
                        @if( $promediosAnuales[$matter->id][$student->idStudent] >= 7)
                            <td></td>
                            <td></td>
                            <td></td>
                            <td class="text-center">{{$prf}}</td>
                        @else
                            <td class="text-center">{{ $supletorios[$matter->id][$student->idStudent] == 0 ? "" : $supletorios[$matter->id][$student->idStudent] }}</td>
                            <td class="text-center">{{ $remediales[$matter->id][$student->idStudent] == 0 ? "" : $remediales[$matter->id][$student->idStudent] }}</td>
                            <td class="text-center">{{ $gracias[$matter->id][$student->idStudent] == 0 ? "" : $gracias[$matter->id][$student->idStudent] }}</td>
                            <td class="text-center">
                                @if( $supletorios[$matter->id][$student->idStudent] < 7 && $remediales[$matter->id][$student->idStudent] < 7 && $gracias[$matter->id][$student->idStudent] < 7)

                                @else
                                    7
                                @endif
                            </td>
                        @endif
                    @endif
				@endforeach
			</tr>
		@endforeach
	</table>
	<br>
	<br>
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
    <div style="page-break-after:always;"></div>

    @if ($numeroDeMaterias < 16)

		{{-- 2da hoja --}}
		@php
			$sliceEstudiantes = 0;
			$cantidadDeEstudiantesPorHojaSumatoria = $reinicioCantidadDeEstudiantesPorHoja;
			$count = 1;
		@endphp
		@while ($cantidadDeEstudiantesPorHojaSumatoria < $cantidadDeEstudiantes)
			<div style="visibility:hidden">
				@include('partials.encabezados.sabana')
			</div>
			<table class="table m-0"  style="visibility: hidden">
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
			<table class="table">
				<tr height="40">
					<td rowspan="3" width="5" class="text-center">No.</td>
					@foreach(array_unique($matters->slice(6)->take(9)->pluck('area')->toArray()) as $matter)
						<td colspan="{{ count($matters->slice(6)->take(9)->where('area', $matter) ) * 7}}" class="text-center up bold">{{ $matter }}</td>
					@endforeach

                    @if($proyecto->area != null)
						<td colspan="7" class="text-center up bold">{{ $proyecto->nombre }}</td>
					@endif
					<td rowspan="3" class="text-center up bold">
						<p class="s-calificaciones__materia libretaQuimestralPorCurso__nombres">
							<span class="up bold">Promedio Final</span>
						</p>
					</td>
					<td rowspan="3" class="up text-center">observaciones</td>
				</tr>
				<tr height="130">
					@foreach($matters->slice(6)->take(9) as $matter)
						<td colspan="7" class="text-center up bold">
							<p class="s-calificaciones__materia libretaQuimestralPorCurso__nombres">
								<span class="up bold">{{ $matter->nombre }}</span>
							</p>
						</td>
					@endforeach
					@if($proyecto->area != null)
					<td colspan="7" class="text-center up bold">
						<p class="s-calificaciones__materia libretaQuimestralPorCurso__nombres">
							<span class="up bold">{{ $proyecto->nombre }}</span>
						</p>
					</td>
					@endif
				</tr>
				<tr height="40">
					@foreach($matters->slice(6)->take(9) as $matter)
						<td class="text-center">
							<p class="s-calificaciones__materia libretaQuimestralPorCurso__nombres sabanaTd-nombres">
								<span class="up bold">q1</span>
							</p>
						</td>
						<td class="text-center">
							<p class="s-calificaciones__materia libretaQuimestralPorCurso__nombres sabanaTd-nombres">
								<span class="up bold">q2</span>
							</p>
						</td>
						<td class="text-center">
							<p class="s-calificaciones__materia libretaQuimestralPorCurso__nombres sabanaTd-nombres">
								<span class="up bold">pro</span>
							</p>
						</td>
						<td class="text-center">
							<p class="s-calificaciones__materia libretaQuimestralPorCurso__nombres sabanaTd-nombres">
								<span class="up bold">sup</span>
							</p>
						</td>
						<td class="text-center">
							<p class="s-calificaciones__materia libretaQuimestralPorCurso__nombres sabanaTd-nombres">
								<span class="up bold">rem</span>
							</p>
						</td>
						<td class="text-center">
							<p class="s-calificaciones__materia libretaQuimestralPorCurso__nombres sabanaTd-nombres">
								<span class="up bold">gra</span>
							</p>
						</td>
						<td class="text-center">
							<p class="s-calificaciones__materia libretaQuimestralPorCurso__nombres sabanaTd-nombres">
								<span class="up bold">p.f</span>
							</p>
						</td>
					@endforeach
					@if($proyecto->area != null)
						<td class="text-center">
							<p class="s-calificaciones__materia libretaQuimestralPorCurso__nombres sabanaTd-nombres">
								<span class="up bold">q1</span>
							</p>
						</td>
						<td class="text-center">
							<p class="s-calificaciones__materia libretaQuimestralPorCurso__nombres sabanaTd-nombres">
								<span class="up bold">q2</span>
							</p>
						</td>
						<td class="text-center">
							<p class="s-calificaciones__materia libretaQuimestralPorCurso__nombres sabanaTd-nombres">
								<span class="up bold">pro</span>
							</p>
						</td>
						<td class="text-center">
							<p class="s-calificaciones__materia libretaQuimestralPorCurso__nombres sabanaTd-nombres">
								<span class="up bold">sup</span>
							</p>
						</td>
						<td class="text-center">
							<p class="s-calificaciones__materia libretaQuimestralPorCurso__nombres sabanaTd-nombres">
								<span class="up bold">rem</span>
							</p>
						</td>
						<td class="text-center">
							<p class="s-calificaciones__materia libretaQuimestralPorCurso__nombres sabanaTd-nombres">
								<span class="up bold">gra</span>
							</p>
						</td>
						<td class="text-center">
							<p class="s-calificaciones__materia libretaQuimestralPorCurso__nombres sabanaTd-nombres">
								<span class="up bold">p.f</span>
							</p>
						</td>
					@endif
				</tr>
				@foreach($students->slice($sliceEstudiantes)->take($cantidadDeEstudiantesPorHoja) as $student)
					<tr>
						<td class="text-center"> {{$count++}} </td>
						@foreach($matters->slice(6)->take(9) as $matter)
						<td class="text-center"> {{ $promediosQ1[$matter->id][$student->idStudent] == 0 ? "" : $promediosQ1[$matter->id][$student->idStudent] }} </td>
							<td class="text-center">{{ $promediosQ2[$matter->id][$student->idStudent] == 0 ? "" : $promediosQ2[$matter->id][$student->idStudent] }}</td>
							<td class="text-center"
							@if($notasMenores == "1")
								@if($promediosAnuales[$matter->id][$student->idStudent] < (int)$nota_menor->valor && $promediosAnuales[$matter->id][$student->idStudent]!=0)
									style="color:red;"
								@endif
							@endif >
							{{$promediosAnuales[$matter->id][$student->idStudent] == 0 ? "" : $promediosAnuales[$matter->id][$student->idStudent] }}</td>
								@if( $promediosAnuales[$matter->id][$student->idStudent] >= 7)
									<td class="text-center"></td>
									<td class="text-center"></td>
									<td class="text-center"></td>
									<td class="text-center">{{ $promediosFinales[$matter->id][$student->idStudent] }}</td>
								@else
									<td class="text-center">{{ $supletorios[$matter->id][$student->idStudent] == 0 ? "" : $supletorios[$matter->id][$student->idStudent] }}</td>
									<td class="text-center">{{ $remediales[$matter->id][$student->idStudent] == 0 ? "" : $remediales[$matter->id][$student->idStudent] }}</td>
									<td class="text-center">{{ $gracias[$matter->id][$student->idStudent] == 0 ? "" : $gracias[$matter->id][$student->idStudent] }}</td>
									<td class="text-center">
										@if( $supletorios[$matter->id][$student->idStudent] < 7 && $remediales[$matter->id][$student->idStudent] < 7 && $gracias[$matter->id][$student->idStudent] < 7)

										@else
											7
										@endif
									</td>
								@endif
						@endforeach
						@if($proyecto->area != null)
							<td class="text-center">
							@if($promediosQ1[$proyecto->id][$student->idStudent] != 0)
								@if( $promediosQ1[$proyecto->id][$student->idStudent]>= 9)
									EX
								@endif
								@if ( $promediosQ1[$proyecto->id][$student->idStudent]<9 && $promediosQ1[$proyecto->id][$student->idStudent]>=7)
									MB
								@endif
								@if( $promediosQ1[$proyecto->id][$student->idStudent]>4 && $promediosQ1[$proyecto->id][$student->idStudent]<7)
									B
								@endif
								@if( $promediosQ1[$proyecto->id][$student->idStudent]==4)
									R
								@endif
								@if( $promediosQ1[$proyecto->id][$student->idStudent]<4)
									R
								@endif
							@endif
							</td>
							<td class="text-center">
							@if($promediosQ2[$proyecto->id][$student->idStudent] != 0)
								@if( $promediosQ2[$proyecto->id][$student->idStudent]>= 9)
									EX
								@endif
								@if ( $promediosQ2[$proyecto->id][$student->idStudent]<9 && $promediosQ2[$proyecto->id][$student->idStudent]>=7)
									MB
								@endif
								@if( $promediosQ2[$proyecto->id][$student->idStudent]>4 && $promediosQ2[$proyecto->id][$student->idStudent]<7)
									B
								@endif
								@if( $promediosQ2[$proyecto->id][$student->idStudent]==4)
									R
								@endif
								@if( $promediosQ2[$proyecto->id][$student->idStudent]<4)
									R
								@endif
							@endif
							</td>
							<td class="text-center"
							@if($notasMenores == "1")
								@if($promediosAnuales[$matter->id][$student->idStudent] < (int)$nota_menor->valor && $promediosAnuales[$matter->id][$student->idStudent]!=0)
									style="color:red;"
								@endif
							@endif >
							@if($promediosAnuales[$proyecto->id][$student->idStudent] != 0)
								@if( $promediosAnuales[$proyecto->id][$student->idStudent]>= 9)
									EX
								@endif
								@if ( $promediosAnuales[$proyecto->id][$student->idStudent]<9 && $promediosAnuales[$proyecto->id][$student->idStudent]>=7)
									MB
								@endif
								@if( $promediosAnuales[$proyecto->id][$student->idStudent]>4 && $promediosAnuales[$proyecto->id][$student->idStudent]<7)
									B
								@endif
								@if( $promediosAnuales[$proyecto->id][$student->idStudent]==4)
									R
								@endif
								@if( $promediosAnuales[$proyecto->id][$student->idStudent]<4)
									R
								@endif
							@endif
							</td>
							@if( $promediosAnuales[$matter->id][$student->idStudent] >= 7)
								<td class="text-center"></td>
								<td class="text-center"></td>
								<td class="text-center"></td>
								<td class="text-center">
									@if($promediosFinales[$proyecto->id][$student->idStudent] != 0)
									@if( $promediosFinales[$proyecto->id][$student->idStudent]>= 9)
										EX
									@endif
									@if ( $promediosFinales[$proyecto->id][$student->idStudent]<9 && $promediosFinales[$proyecto->id][$student->idStudent]>=7)
										MB
									@endif
									@if( $promediosFinales[$proyecto->id][$student->idStudent]>4 && $promediosFinales[$proyecto->id][$student->idStudent]<7)
										B
									@endif
									@if( $promediosFinales[$proyecto->id][$student->idStudent]==4)
										R
									@endif
									@if( $promediosFinales[$proyecto->id][$student->idStudent]<4)
										R
									@endif
								@endif
								</td>
							@else
								<td class="text-center">{{ $supletorios[$matter->id][$student->idStudent] == 0 ? "" : $supletorios[$matter->id][$student->idStudent] }}</td>
								<td class="text-center">{{ $remediales[$matter->id][$student->idStudent] == 0 ? "" : $remediales[$matter->id][$student->idStudent] }}</td>
								<td class="text-center">{{ $gracias[$matter->id][$student->idStudent] == 0 ? "" : $gracias[$matter->id][$student->idStudent] }}</td>
								<td class="text-center">
									@if( $supletorios[$matter->id][$student->idStudent] < 7 && $remediales[$matter->id][$student->idStudent] < 7 && $gracias[$matter->id][$student->idStudent] < 7)

									@else
										7
									@endif
								</td>
							@endif
						@endif
						<td class="text-center">{{ bcdiv( ($aprovechamiento[$student->idStudent]/$numeroDeMaterias), '1', 2) }}</td>
						<td class="up">{{ $esSupletorios[$student->idStudent] }}</td>
					</tr>
				@endforeach
			</table>
			@php
				$sliceEstudiantes = $sliceEstudiantes + $cantidadDeEstudiantesPorHoja; //10 pasa, 20 pasa
				$cantidadDeEstudiantesPorHojaSumatoria = $sliceEstudiantes + $cantidadDeEstudiantesPorHoja; // 20 pasa , 30
			@endphp
			<br>
			<br>
			<br>
			<table class="table">
				<tr>
					<th width="35%"></th>
					<th width="30%">
						<hr style="border:1px solid black;">
						<h4 class="firma--size m-0 uppercase text-center">{{$institution->representante2}}</h4>
						<h4 class="firma--size m-0 uppercase text-center">{{$institution->cargo2}}</h4>
					</th>
					<th width="35%"></th>
				</tr>
			</table>
			<div style="page-break-after:always;"></div>
		@endwhile
		@php
			$sliceEstudiantes = $cantidadDeEstudiantesPorHojaSumatoria - $cantidadDeEstudiantesPorHoja;
			$cantidadDeEstudiantesPorHojaSumatoria = $cantidadDeEstudiantesPorHojaSumatoria - $cantidadDeEstudiantes;
		@endphp
		<div style="visibility:hidden">
			@include('partials.encabezados.sabana')
		</div>
		<table class="table m-0"  style="visibility: hidden">
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
		<table class="table">
			<tr height="40">
				<td rowspan="3" width="5" class="text-center">No.</td>
				@foreach(array_unique($matters->slice(6)->take(9)->pluck('area')->toArray()) as $matter)
					<td colspan="{{ count($matters->slice(6)->take(9)->where('area', $matter) ) * 7}}" class="text-center up bold">{{ $matter }}</td>
				@endforeach
				@if($proyecto->area != null)
					<td colspan="7" class="text-center up bold">{{ $proyecto->nombre }}</td>
				@endif
				{{-- @if ($cantidadDeEstudiantesPorHojaSumatoria <= $cantidadDeEstudiantes) --}}
					<td rowspan="3" class="text-center up bold">
						<p class="s-calificaciones__materia libretaQuimestralPorCurso__nombres">
							<span class="up bold">Promedio Final</span>
						</p>
					</td>
					<td rowspan="3" class="up text-center">observaciones</td>
				{{-- @endif --}}
			</tr>
			<tr height="130">
				@foreach($matters->slice(6)->take(9) as $matter)
					<td colspan="7" class="text-center up bold">
						<p class="s-calificaciones__materia libretaQuimestralPorCurso__nombres">
							<span class="up bold">{{ $matter->nombre }}</span>
						</p>
					</td>
				@endforeach
				@if($proyecto->area != null)
				<td colspan="7" class="text-center up bold">
					<p class="s-calificaciones__materia libretaQuimestralPorCurso__nombres">
						<span class="up bold">{{ $proyecto->nombre }}</span>
					</p>
				</td>
				@endif
			</tr>
			<tr height="40">
				@foreach($matters->slice(6)->take(9) as $matter)
					<td class="text-center">
						<p class="s-calificaciones__materia libretaQuimestralPorCurso__nombres sabanaTd-nombres">
							<span class="up bold">q1</span>
						</p>
					</td>
					<td class="text-center">
						<p class="s-calificaciones__materia libretaQuimestralPorCurso__nombres sabanaTd-nombres">
							<span class="up bold">q2</span>
						</p>
					</td>
					<td class="text-center">
						<p class="s-calificaciones__materia libretaQuimestralPorCurso__nombres sabanaTd-nombres">
							<span class="up bold">pro</span>
						</p>
					</td>
					<td class="text-center">
						<p class="s-calificaciones__materia libretaQuimestralPorCurso__nombres sabanaTd-nombres">
							<span class="up bold">sup</span>
						</p>
					</td>
					<td class="text-center">
						<p class="s-calificaciones__materia libretaQuimestralPorCurso__nombres sabanaTd-nombres">
							<span class="up bold">rem</span>
						</p>
					</td>
					<td class="text-center">
						<p class="s-calificaciones__materia libretaQuimestralPorCurso__nombres sabanaTd-nombres">
							<span class="up bold">gra</span>
						</p>
					</td>
					<td class="text-center">
						<p class="s-calificaciones__materia libretaQuimestralPorCurso__nombres sabanaTd-nombres">
							<span class="up bold">p.f</span>
						</p>
					</td>
				@endforeach
				@if($proyecto->area != null)
					<td class="text-center">
						<p class="s-calificaciones__materia libretaQuimestralPorCurso__nombres sabanaTd-nombres">
							<span class="up bold">q1</span>
						</p>
					</td>
					<td class="text-center">
						<p class="s-calificaciones__materia libretaQuimestralPorCurso__nombres sabanaTd-nombres">
							<span class="up bold">q2</span>
						</p>
					</td>
					<td class="text-center">
						<p class="s-calificaciones__materia libretaQuimestralPorCurso__nombres sabanaTd-nombres">
							<span class="up bold">pro</span>
						</p>
					</td>
					<td class="text-center">
						<p class="s-calificaciones__materia libretaQuimestralPorCurso__nombres sabanaTd-nombres">
							<span class="up bold">sup</span>
						</p>
					</td>
					<td class="text-center">
						<p class="s-calificaciones__materia libretaQuimestralPorCurso__nombres sabanaTd-nombres">
							<span class="up bold">rem</span>
						</p>
					</td>
					<td class="text-center">
						<p class="s-calificaciones__materia libretaQuimestralPorCurso__nombres sabanaTd-nombres">
							<span class="up bold">gra</span>
						</p>
					</td>
					<td class="text-center">
						<p class="s-calificaciones__materia libretaQuimestralPorCurso__nombres sabanaTd-nombres">
							<span class="up bold">p.f</span>
						</p>
					</td>
				@endif
			</tr>
			@foreach($students->slice($sliceEstudiantes)->take($cantidadDeEstudiantesPorHoja) as $student)
				<tr>
					<td class="text-center"> {{$count++}}</td>
					@foreach($matters->slice(6)->take(9) as $matter)
					<td class="text-center">{{ $promediosQ1[$matter->id][$student->idStudent] == 0 ? "" : $promediosQ1[$matter->id][$student->idStudent] }} </td>
						<td class="text-center">{{ $promediosQ2[$matter->id][$student->idStudent] == 0 ? "" : $promediosQ2[$matter->id][$student->idStudent] }}</td>
						<td class="text-center"
						@if($notasMenores == "1")
							@if($promediosAnuales[$matter->id][$student->idStudent] < (int)$nota_menor->valor && $promediosAnuales[$matter->id][$student->idStudent]!=0)
								style="color:red;"
							@endif
						@endif >
						{{$promediosAnuales[$matter->id][$student->idStudent] == 0 ? "" : $promediosAnuales[$matter->id][$student->idStudent] }}</td>
							@if( $promediosAnuales[$matter->id][$student->idStudent] >= 7)
								<td class="text-center"></td>
								<td class="text-center"></td>
								<td class="text-center"></td>
								<td class="text-center">{{ $promediosFinales[$matter->id][$student->idStudent] }}</td>
							@else
								<td class="text-center">{{ $supletorios[$matter->id][$student->idStudent] == 0 ? "" : $supletorios[$matter->id][$student->idStudent] }}</td>
								<td class="text-center">{{ $remediales[$matter->id][$student->idStudent] == 0 ? "" : $remediales[$matter->id][$student->idStudent] }}</td>
								<td class="text-center">{{ $gracias[$matter->id][$student->idStudent] == 0 ? "" : $gracias[$matter->id][$student->idStudent] }}</td>
								<td class="text-center">
									@if( $supletorios[$matter->id][$student->idStudent] < 7 && $remediales[$matter->id][$student->idStudent] < 7 && $gracias[$matter->id][$student->idStudent] < 7)

									@else
										7
									@endif
								</td>
							@endif
					@endforeach
					@if($proyecto->area != null)
						<td class="text-center">
						@if($promediosQ1[$proyecto->id][$student->idStudent] != 0)
							@if( $promediosQ1[$proyecto->id][$student->idStudent]>= 9)
								EX
							@endif
							@if ( $promediosQ1[$proyecto->id][$student->idStudent]<9 && $promediosQ1[$proyecto->id][$student->idStudent]>=7)
								MB
							@endif
							@if( $promediosQ1[$proyecto->id][$student->idStudent]>4 && $promediosQ1[$proyecto->id][$student->idStudent]<7)
								B
							@endif
							@if( $promediosQ1[$proyecto->id][$student->idStudent]==4)
								R
							@endif
							@if( $promediosQ1[$proyecto->id][$student->idStudent]<4)
								R
							@endif
						@endif
						</td>
						<td class="text-center">
						@if($promediosQ2[$proyecto->id][$student->idStudent] != 0)
							@if( $promediosQ2[$proyecto->id][$student->idStudent]>= 9)
								EX
							@endif
							@if ( $promediosQ2[$proyecto->id][$student->idStudent]<9 && $promediosQ2[$proyecto->id][$student->idStudent]>=7)
								MB
							@endif
							@if( $promediosQ2[$proyecto->id][$student->idStudent]>4 && $promediosQ2[$proyecto->id][$student->idStudent]<7)
								B
							@endif
							@if( $promediosQ2[$proyecto->id][$student->idStudent]==4)
								R
							@endif
							@if( $promediosQ2[$proyecto->id][$student->idStudent]<4)
								R
							@endif
						@endif
						</td>
						<td class="text-center"
						@if($notasMenores == "1")
							@if($promediosAnuales[$matter->id][$student->idStudent] < (int)$nota_menor->valor && $promediosAnuales[$matter->id][$student->idStudent]!=0)
								style="color:red;"
							@endif
						@endif >
						@if($promediosAnuales[$proyecto->id][$student->idStudent] != 0)
							@if( $promediosAnuales[$proyecto->id][$student->idStudent]>= 9)
								EX
							@endif
							@if ( $promediosAnuales[$proyecto->id][$student->idStudent]<9 && $promediosAnuales[$proyecto->id][$student->idStudent]>=7)
								MB
							@endif
							@if( $promediosAnuales[$proyecto->id][$student->idStudent]>4 && $promediosAnuales[$proyecto->id][$student->idStudent]<7)
								B
							@endif
							@if( $promediosAnuales[$proyecto->id][$student->idStudent]==4)
								R
							@endif
							@if( $promediosAnuales[$proyecto->id][$student->idStudent]<4)
								R
							@endif
						@endif
						</td>
						@if( $promediosAnuales[$matter->id][$student->idStudent] >= 7)
							<td class="text-center"></td>
							<td class="text-center"></td>
							<td class="text-center"></td>
							<td class="text-center">
								@if($promediosFinales[$proyecto->id][$student->idStudent] != 0)
								@if( $promediosFinales[$proyecto->id][$student->idStudent]>= 9)
									EX
								@endif
								@if ( $promediosFinales[$proyecto->id][$student->idStudent]<9 && $promediosFinales[$proyecto->id][$student->idStudent]>=7)
									MB
								@endif
								@if( $promediosFinales[$proyecto->id][$student->idStudent]>4 && $promediosFinales[$proyecto->id][$student->idStudent]<7)
									B
								@endif
								@if( $promediosFinales[$proyecto->id][$student->idStudent]==4)
									R
								@endif
								@if( $promediosFinales[$proyecto->id][$student->idStudent]<4)
									R
								@endif
							@endif
							</td>
						@else
							<td class="text-center">{{ $supletorios[$matter->id][$student->idStudent] == 0 ? "" : $supletorios[$matter->id][$student->idStudent] }}</td>
							<td class="text-center">{{ $remediales[$matter->id][$student->idStudent] == 0 ? "" : $remediales[$matter->id][$student->idStudent] }}</td>
							<td class="text-center">{{ $gracias[$matter->id][$student->idStudent] == 0 ? "" : $gracias[$matter->id][$student->idStudent] }}</td>
							<td class="text-center">
								@if( $supletorios[$matter->id][$student->idStudent] < 7 && $remediales[$matter->id][$student->idStudent] < 7 && $gracias[$matter->id][$student->idStudent] < 7)

								@else
									7
								@endif
							</td>
						@endif
                    @endif
					{{-- @if ($cantidadDeEstudiantesPorHojaSumatoria <= $cantidadDeEstudiantes) --}}
						<td class="text-center">{{ bcdiv( ($aprovechamiento[$student->idStudent]/$numeroDeMaterias), '1', 2) }}</td>
						<td class="up">{{ $esSupletorios[$student->idStudent] }}</td>
					{{-- @endif --}}
				</tr>
			@endforeach
		</table>
		<br>
		<br>
		<br>
		<table class="table">
			<tr>
				<th width="35%"></th>
				<th width="30%">
					<hr style="border:1px solid black;">
					<h4 class="firma--size m-0 uppercase text-center">{{$institution->representante2}}</h4>
					<h4 class="firma--size m-0 uppercase text-center">{{$institution->cargo2}}</h4>
				</th>
				<th width="35%"></th>
			</tr>
        </table>
	@else
		{{-- 2da hoja --}}
		@php
			$sliceEstudiantes = 0;
			$cantidadDeEstudiantesPorHojaSumatoria = $reinicioCantidadDeEstudiantesPorHoja;
			$count = 1;
		@endphp
		@while ($cantidadDeEstudiantesPorHojaSumatoria < $cantidadDeEstudiantes)
			<div style="visibility:hidden">
				@include('partials.encabezados.sabana')
			</div>
			<table class="table m-0" style="visibility: hidden">
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
			<table class="table">
				<tr height="40">
					<td rowspan="3" width="5" class="text-center">No.</td>
					@foreach(array_unique($matters->slice(6)->take(9)->pluck('area')->toArray()) as $matter)
						<td colspan="{{ count($matters->slice(6)->take(9)->where('area', $matter) ) * 7}}" class="text-center up bold">{{ $matter }}</td>
					@endforeach
					@if($proyecto->area != null)
						<td colspan="7" class="text-center up bold">{{ $proyecto->nombre }}</td>
					@endif
					{{-- <td rowspan="3" class="text-center up bold">
						<p class="s-calificaciones__materia libretaQuimestralPorCurso__nombres">
							<span class="up bold">Promedio Final</span>
						</p>
					</td>
					<td rowspan="3" class="up text-center">observaciones</td> --}}
				</tr>
				<tr height="130">
					@foreach($matters->slice(6)->take(9) as $matter)
						<td colspan="7" class="text-center up bold">
							<p class="s-calificaciones__materia libretaQuimestralPorCurso__nombres">
								<span class="up bold">{{ $matter->nombre }}</span>
							</p>
						</td>
					@endforeach
					@if($proyecto->area != null)
					<td colspan="7" class="text-center up bold">
						<p class="s-calificaciones__materia libretaQuimestralPorCurso__nombres">
							<span class="up bold">{{ $proyecto->nombre }}</span>
						</p>
					</td>
					@endif
				</tr>
				<tr height="40">
					@foreach($matters->slice(6)->take(9) as $matter)
						<td class="text-center">
							<p class="s-calificaciones__materia libretaQuimestralPorCurso__nombres sabanaTd-nombres">
								<span class="up bold">q1</span>
							</p>
						</td>
						<td class="text-center">
							<p class="s-calificaciones__materia libretaQuimestralPorCurso__nombres sabanaTd-nombres">
								<span class="up bold">q2</span>
							</p>
						</td>
						<td class="text-center">
							<p class="s-calificaciones__materia libretaQuimestralPorCurso__nombres sabanaTd-nombres">
								<span class="up bold">pro</span>
							</p>
						</td>
						<td class="text-center">
							<p class="s-calificaciones__materia libretaQuimestralPorCurso__nombres sabanaTd-nombres">
								<span class="up bold">sup</span>
							</p>
						</td>
						<td class="text-center">
							<p class="s-calificaciones__materia libretaQuimestralPorCurso__nombres sabanaTd-nombres">
								<span class="up bold">rem</span>
							</p>
						</td>
						<td class="text-center">
							<p class="s-calificaciones__materia libretaQuimestralPorCurso__nombres sabanaTd-nombres">
								<span class="up bold">gra</span>
							</p>
						</td>
						<td class="text-center">
							<p class="s-calificaciones__materia libretaQuimestralPorCurso__nombres sabanaTd-nombres">
								<span class="up bold">p.f</span>
							</p>
						</td>
					@endforeach
					@if($proyecto->area != null)
						<td class="text-center">
							<p class="s-calificaciones__materia libretaQuimestralPorCurso__nombres sabanaTd-nombres">
								<span class="up bold">q1</span>
							</p>
						</td>
						<td class="text-center">
							<p class="s-calificaciones__materia libretaQuimestralPorCurso__nombres sabanaTd-nombres">
								<span class="up bold">q2</span>
							</p>
						</td>
						<td class="text-center">
							<p class="s-calificaciones__materia libretaQuimestralPorCurso__nombres sabanaTd-nombres">
								<span class="up bold">pro</span>
							</p>
						</td>
						<td class="text-center">
							<p class="s-calificaciones__materia libretaQuimestralPorCurso__nombres sabanaTd-nombres">
								<span class="up bold">sup</span>
							</p>
						</td>
						<td class="text-center">
							<p class="s-calificaciones__materia libretaQuimestralPorCurso__nombres sabanaTd-nombres">
								<span class="up bold">rem</span>
							</p>
						</td>
						<td class="text-center">
							<p class="s-calificaciones__materia libretaQuimestralPorCurso__nombres sabanaTd-nombres">
								<span class="up bold">gra</span>
							</p>
						</td>
						<td class="text-center">
							<p class="s-calificaciones__materia libretaQuimestralPorCurso__nombres sabanaTd-nombres">
								<span class="up bold">p.f</span>
							</p>
						</td>
					@endif
				</tr>
				@foreach($students->slice($sliceEstudiantes)->take($cantidadDeEstudiantesPorHoja) as $student)
					<tr>
						<td class="text-center"> {{$count++}} </td>
						@foreach($matters->slice(6)->take(9) as $matter)
						<td class="text-center"> {{ $promediosQ1[$matter->id][$student->idStudent] == 0 ? "" : $promediosQ1[$matter->id][$student->idStudent] }} </td>
							<td class="text-center">{{ $promediosQ2[$matter->id][$student->idStudent] == 0 ? "" : $promediosQ2[$matter->id][$student->idStudent] }}</td>
							<td class="text-center"
							@if($notasMenores == "1")
								@if($promediosAnuales[$matter->id][$student->idStudent] < (int)$nota_menor->valor && $promediosAnuales[$matter->id][$student->idStudent]!=0)
									style="color:red;"
								@endif
							@endif >
							{{$promediosAnuales[$matter->id][$student->idStudent] == 0 ? "" : $promediosAnuales[$matter->id][$student->idStudent] }}</td>
								@if( $promediosAnuales[$matter->id][$student->idStudent] >= 7)
									<td class="text-center"></td>
									<td class="text-center"></td>
									<td class="text-center"></td>
									<td class="text-center">{{ $promediosFinales[$matter->id][$student->idStudent] }}</td>
								@else
									<td class="text-center">{{ $supletorios[$matter->id][$student->idStudent] == 0 ? "" : $supletorios[$matter->id][$student->idStudent] }}</td>
									<td class="text-center">{{ $remediales[$matter->id][$student->idStudent] == 0 ? "" : $remediales[$matter->id][$student->idStudent] }}</td>
									<td class="text-center">{{ $gracias[$matter->id][$student->idStudent] == 0 ? "" : $gracias[$matter->id][$student->idStudent] }}</td>
									<td class="text-center">
										@if( $supletorios[$matter->id][$student->idStudent] < 7 && $remediales[$matter->id][$student->idStudent] < 7 && $gracias[$matter->id][$student->idStudent] < 7)

										@else
											7
										@endif
									</td>
								@endif
						@endforeach
						@if($proyecto->area != null)
							<td class="text-center">
							@if($promediosQ1[$proyecto->id][$student->idStudent] != 0)
								@if( $promediosQ1[$proyecto->id][$student->idStudent]>= 9)
									EX
								@endif
								@if ( $promediosQ1[$proyecto->id][$student->idStudent]<9 && $promediosQ1[$proyecto->id][$student->idStudent]>=7)
									MB
								@endif
								@if( $promediosQ1[$proyecto->id][$student->idStudent]>4 && $promediosQ1[$proyecto->id][$student->idStudent]<7)
									B
								@endif
								@if( $promediosQ1[$proyecto->id][$student->idStudent]==4)
									R
								@endif
								@if( $promediosQ1[$proyecto->id][$student->idStudent]<4)
									R
								@endif
							@endif
							</td>
							<td class="text-center">
							@if($promediosQ2[$proyecto->id][$student->idStudent] != 0)
								@if( $promediosQ2[$proyecto->id][$student->idStudent]>= 9)
									EX
								@endif
								@if ( $promediosQ2[$proyecto->id][$student->idStudent]<9 && $promediosQ2[$proyecto->id][$student->idStudent]>=7)
									MB
								@endif
								@if( $promediosQ2[$proyecto->id][$student->idStudent]>4 && $promediosQ2[$proyecto->id][$student->idStudent]<7)
									B
								@endif
								@if( $promediosQ2[$proyecto->id][$student->idStudent]==4)
									R
								@endif
								@if( $promediosQ2[$proyecto->id][$student->idStudent]<4)
									R
								@endif
							@endif
							</td>
							<td class="text-center"
							@if($notasMenores == "1")
								@if($promediosAnuales[$matter->id][$student->idStudent] < (int)$nota_menor->valor && $promediosAnuales[$matter->id][$student->idStudent]!=0)
									style="color:red;"
								@endif
							@endif >
							@if($promediosAnuales[$proyecto->id][$student->idStudent] != 0)
								@if( $promediosAnuales[$proyecto->id][$student->idStudent]>= 9)
									EX
								@endif
								@if ( $promediosAnuales[$proyecto->id][$student->idStudent]<9 && $promediosAnuales[$proyecto->id][$student->idStudent]>=7)
									MB
								@endif
								@if( $promediosAnuales[$proyecto->id][$student->idStudent]>4 && $promediosAnuales[$proyecto->id][$student->idStudent]<7)
									B
								@endif
								@if( $promediosAnuales[$proyecto->id][$student->idStudent]==4)
									R
								@endif
								@if( $promediosAnuales[$proyecto->id][$student->idStudent]<4)
									R
								@endif
							@endif
							</td>
							@if( $promediosAnuales[$matter->id][$student->idStudent] >= 7)
								<td class="text-center"></td>
								<td class="text-center"></td>
								<td class="text-center"></td>
								<td class="text-center">
									@if($promediosFinales[$proyecto->id][$student->idStudent] != 0)
									@if( $promediosFinales[$proyecto->id][$student->idStudent]>= 9)
										EX
									@endif
									@if ( $promediosFinales[$proyecto->id][$student->idStudent]<9 && $promediosFinales[$proyecto->id][$student->idStudent]>=7)
										MB
									@endif
									@if( $promediosFinales[$proyecto->id][$student->idStudent]>4 && $promediosFinales[$proyecto->id][$student->idStudent]<7)
										B
									@endif
									@if( $promediosFinales[$proyecto->id][$student->idStudent]==4)
										R
									@endif
									@if( $promediosFinales[$proyecto->id][$student->idStudent]<4)
										R
									@endif
								@endif
								</td>
							@else
								<td class="text-center">{{ $supletorios[$matter->id][$student->idStudent] == 0 ? "" : $supletorios[$matter->id][$student->idStudent] }}</td>
								<td class="text-center">{{ $remediales[$matter->id][$student->idStudent] == 0 ? "" : $remediales[$matter->id][$student->idStudent] }}</td>
								<td class="text-center">{{ $gracias[$matter->id][$student->idStudent] == 0 ? "" : $gracias[$matter->id][$student->idStudent] }}</td>
								<td class="text-center">
									@if( $supletorios[$matter->id][$student->idStudent] < 7 && $remediales[$matter->id][$student->idStudent] < 7 && $gracias[$matter->id][$student->idStudent] < 7)

									@else
										7
									@endif
								</td>
							@endif
						@endif
						{{-- <td class="text-center">{{ bcdiv( ($aprovechamiento[$student->idStudent]/$numeroDeMaterias), '1', 2) }}</td>
						<td class="up">{{ $esSupletorios[$student->idStudent] }}</td> --}}
					</tr>
				@endforeach
			</table>
			@php
				$sliceEstudiantes = $sliceEstudiantes + $cantidadDeEstudiantesPorHoja; //10 pasa, 20 pasa
				$cantidadDeEstudiantesPorHojaSumatoria = $sliceEstudiantes + $cantidadDeEstudiantesPorHoja; // 20 pasa , 30
			@endphp
			<br>
			<br>
			<br>
			<table class="table">
				<tr>
					<th width="35%"></th>
					<th width="30%">
						<hr style="border:1px solid black;">
						<h4 class="firma--size m-0 uppercase text-center">{{$institution->representante2}}</h4>
						<h4 class="firma--size m-0 uppercase text-center">{{$institution->cargo2}}</h4>
					</th>
					<th width="35%"></th>
				</tr>
			</table>
			<div style="page-break-after:always;"></div>
		@endwhile
		@php
			$sliceEstudiantes = $cantidadDeEstudiantesPorHojaSumatoria - $cantidadDeEstudiantesPorHoja;
			$cantidadDeEstudiantesPorHojaSumatoria = $cantidadDeEstudiantesPorHojaSumatoria - $cantidadDeEstudiantes;
		@endphp
		<div style="visibility:hidden">
			@include('partials.encabezados.sabana')
		</div>
		<table class="table m-0" style="visibility: hidden">
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
		<table class="table">
			<tr height="40">
				<td rowspan="3" width="5" class="text-center">No.</td>
				@foreach(array_unique($matters->slice(6)->take(9)->pluck('area')->toArray()) as $matter)
					<td colspan="{{ count($matters->slice(6)->take(9)->where('area', $matter) ) * 7}}" class="text-center up bold">{{ $matter }}</td>
				@endforeach
				@if($proyecto->area != null)
					<td colspan="7" class="text-center up bold">{{ $proyecto->nombre }}</td>
				@endif
				@if ($cantidadDeEstudiantesPorHojaSumatoria <= $cantidadDeEstudiantes)
					{{-- <td rowspan="3" class="text-center up bold">
						<p class="s-calificaciones__materia libretaQuimestralPorCurso__nombres">
							<span class="up bold">Promedio Final</span>
						</p>
					</td>
					<td rowspan="3" class="up text-center">observaciones</td> --}}
				@endif
			</tr>
			<tr height="130">
				@foreach($matters->slice(6)->take(9) as $matter)
					<td colspan="7" class="text-center up bold">
						<p class="s-calificaciones__materia libretaQuimestralPorCurso__nombres">
							<span class="up bold">{{ $matter->nombre }}</span>
						</p>
					</td>
				@endforeach
				@if($proyecto->area != null)
				<td colspan="7" class="text-center up bold">
					<p class="s-calificaciones__materia libretaQuimestralPorCurso__nombres">
						<span class="up bold">{{ $proyecto->nombre }}</span>
					</p>
				</td>
				@endif
			</tr>
			<tr height="40">
				@foreach($matters->slice(6)->take(9) as $matter)
					<td class="text-center">
						<p class="s-calificaciones__materia libretaQuimestralPorCurso__nombres sabanaTd-nombres">
							<span class="up bold">q1</span>
						</p>
					</td>
					<td class="text-center">
						<p class="s-calificaciones__materia libretaQuimestralPorCurso__nombres sabanaTd-nombres">
							<span class="up bold">q2</span>
						</p>
					</td>
					<td class="text-center">
						<p class="s-calificaciones__materia libretaQuimestralPorCurso__nombres sabanaTd-nombres">
							<span class="up bold">pro</span>
						</p>
					</td>
					<td class="text-center">
						<p class="s-calificaciones__materia libretaQuimestralPorCurso__nombres sabanaTd-nombres">
							<span class="up bold">sup</span>
						</p>
					</td>
					<td class="text-center">
						<p class="s-calificaciones__materia libretaQuimestralPorCurso__nombres sabanaTd-nombres">
							<span class="up bold">rem</span>
						</p>
					</td>
					<td class="text-center">
						<p class="s-calificaciones__materia libretaQuimestralPorCurso__nombres sabanaTd-nombres">
							<span class="up bold">gra</span>
						</p>
					</td>
					<td class="text-center">
						<p class="s-calificaciones__materia libretaQuimestralPorCurso__nombres sabanaTd-nombres">
							<span class="up bold">p.f</span>
						</p>
					</td>
				@endforeach
				@if($proyecto->area != null)
					<td class="text-center">
						<p class="s-calificaciones__materia libretaQuimestralPorCurso__nombres sabanaTd-nombres">
							<span class="up bold">q1</span>
						</p>
					</td>
					<td class="text-center">
						<p class="s-calificaciones__materia libretaQuimestralPorCurso__nombres sabanaTd-nombres">
							<span class="up bold">q2</span>
						</p>
					</td>
					<td class="text-center">
						<p class="s-calificaciones__materia libretaQuimestralPorCurso__nombres sabanaTd-nombres">
							<span class="up bold">pro</span>
						</p>
					</td>
					<td class="text-center">
						<p class="s-calificaciones__materia libretaQuimestralPorCurso__nombres sabanaTd-nombres">
							<span class="up bold">sup</span>
						</p>
					</td>
					<td class="text-center">
						<p class="s-calificaciones__materia libretaQuimestralPorCurso__nombres sabanaTd-nombres">
							<span class="up bold">rem</span>
						</p>
					</td>
					<td class="text-center">
						<p class="s-calificaciones__materia libretaQuimestralPorCurso__nombres sabanaTd-nombres">
							<span class="up bold">gra</span>
						</p>
					</td>
					<td class="text-center">
						<p class="s-calificaciones__materia libretaQuimestralPorCurso__nombres sabanaTd-nombres">
							<span class="up bold">p.f</span>
						</p>
					</td>
				@endif
			</tr>
            @foreach($students->slice($sliceEstudiantes)->take($cantidadDeEstudiantesPorHoja) as $student)
				<tr>
					<td class="text-center"> {{$count++}} </td>
					@foreach($matters->slice(6)->take(9) as $matter)
					<td class="text-center"> {{ $promediosQ1[$matter->id][$student->idStudent] == 0 ? "" : $promediosQ1[$matter->id][$student->idStudent] }} </td>
						<td class="text-center">{{ $promediosQ2[$matter->id][$student->idStudent] == 0 ? "" : $promediosQ2[$matter->id][$student->idStudent] }}</td>
						<td class="text-center"
						@if($notasMenores == "1")
							@if($promediosAnuales[$matter->id][$student->idStudent] < (int)$nota_menor->valor && $promediosAnuales[$matter->id][$student->idStudent]!=0)
								style="color:red;"
							@endif
						@endif >
						{{$promediosAnuales[$matter->id][$student->idStudent] == 0 ? "" : $promediosAnuales[$matter->id][$student->idStudent] }}</td>
							@if( $promediosAnuales[$matter->id][$student->idStudent] >= 7)
								<td class="text-center"></td>
								<td class="text-center"></td>
								<td class="text-center"></td>
								<td class="text-center">{{ $promediosFinales[$matter->id][$student->idStudent] }}</td>
							@else
								<td class="text-center">{{ $supletorios[$matter->id][$student->idStudent] == 0 ? "" : $supletorios[$matter->id][$student->idStudent] }}</td>
								<td class="text-center">{{ $remediales[$matter->id][$student->idStudent] == 0 ? "" : $remediales[$matter->id][$student->idStudent] }}</td>
								<td class="text-center">{{ $gracias[$matter->id][$student->idStudent] == 0 ? "" : $gracias[$matter->id][$student->idStudent] }}</td>
								<td class="text-center">
									@if( $supletorios[$matter->id][$student->idStudent] < 7 && $remediales[$matter->id][$student->idStudent] < 7 && $gracias[$matter->id][$student->idStudent] < 7)

									@else
										7
									@endif
								</td>
							@endif
					@endforeach
					@if($proyecto->area != null)
						<td class="text-center">
						@if($promediosQ1[$proyecto->id][$student->idStudent] != 0)
							@if( $promediosQ1[$proyecto->id][$student->idStudent]>= 9)
								EX
							@endif
							@if ( $promediosQ1[$proyecto->id][$student->idStudent]<9 && $promediosQ1[$proyecto->id][$student->idStudent]>=7)
								MB
							@endif
							@if( $promediosQ1[$proyecto->id][$student->idStudent]>4 && $promediosQ1[$proyecto->id][$student->idStudent]<7)
								B
							@endif
							@if( $promediosQ1[$proyecto->id][$student->idStudent]==4)
								R
							@endif
							@if( $promediosQ1[$proyecto->id][$student->idStudent]<4)
								R
							@endif
						@endif
						</td>
						<td class="text-center">
						@if($promediosQ2[$proyecto->id][$student->idStudent] != 0)
							@if( $promediosQ2[$proyecto->id][$student->idStudent]>= 9)
								EX
							@endif
							@if ( $promediosQ2[$proyecto->id][$student->idStudent]<9 && $promediosQ2[$proyecto->id][$student->idStudent]>=7)
								MB
							@endif
							@if( $promediosQ2[$proyecto->id][$student->idStudent]>4 && $promediosQ2[$proyecto->id][$student->idStudent]<7)
								B
							@endif
							@if( $promediosQ2[$proyecto->id][$student->idStudent]==4)
								R
							@endif
							@if( $promediosQ2[$proyecto->id][$student->idStudent]<4)
								R
							@endif
						@endif
						</td>
						<td class="text-center"
						@if($notasMenores == "1")
							@if($promediosAnuales[$matter->id][$student->idStudent] < (int)$nota_menor->valor && $promediosAnuales[$matter->id][$student->idStudent]!=0)
								style="color:red;"
							@endif
						@endif >
						@if($promediosAnuales[$proyecto->id][$student->idStudent] != 0)
							@if( $promediosAnuales[$proyecto->id][$student->idStudent]>= 9)
								EX
							@endif
							@if ( $promediosAnuales[$proyecto->id][$student->idStudent]<9 && $promediosAnuales[$proyecto->id][$student->idStudent]>=7)
								MB
							@endif
							@if( $promediosAnuales[$proyecto->id][$student->idStudent]>4 && $promediosAnuales[$proyecto->id][$student->idStudent]<7)
								B
							@endif
							@if( $promediosAnuales[$proyecto->id][$student->idStudent]==4)
								R
							@endif
							@if( $promediosAnuales[$proyecto->id][$student->idStudent]<4)
								R
							@endif
						@endif
						</td>
						@if( $promediosAnuales[$matter->id][$student->idStudent] >= 7)
							<td class="text-center"></td>
							<td class="text-center"></td>
							<td class="text-center"></td>
							<td class="text-center">
								@if($promediosFinales[$proyecto->id][$student->idStudent] != 0)
								@if( $promediosFinales[$proyecto->id][$student->idStudent]>= 9)
									EX
								@endif
								@if ( $promediosFinales[$proyecto->id][$student->idStudent]<9 && $promediosFinales[$proyecto->id][$student->idStudent]>=7)
									MB
								@endif
								@if( $promediosFinales[$proyecto->id][$student->idStudent]>4 && $promediosFinales[$proyecto->id][$student->idStudent]<7)
									B
								@endif
								@if( $promediosFinales[$proyecto->id][$student->idStudent]==4)
									R
								@endif
								@if( $promediosFinales[$proyecto->id][$student->idStudent]<4)
									R
								@endif
							@endif
							</td>
						@else
							<td class="text-center">{{ $supletorios[$matter->id][$student->idStudent] == 0 ? "" : $supletorios[$matter->id][$student->idStudent] }}</td>
							<td class="text-center">{{ $remediales[$matter->id][$student->idStudent] == 0 ? "" : $remediales[$matter->id][$student->idStudent] }}</td>
							<td class="text-center">{{ $gracias[$matter->id][$student->idStudent] == 0 ? "" : $gracias[$matter->id][$student->idStudent] }}</td>
							<td class="text-center">
								@if( $supletorios[$matter->id][$student->idStudent] < 7 && $remediales[$matter->id][$student->idStudent] < 7 && $gracias[$matter->id][$student->idStudent] < 7)

								@else
									7
								@endif
							</td>
						@endif
					@endif
					@if ($cantidadDeEstudiantesPorHojaSumatoria <= $cantidadDeEstudiantes)
						{{-- <td class="text-center">{{ bcdiv( ($aprovechamiento[$student->idStudent]/$numeroDeMaterias), '1', 2) }}</td>
						<td class="up">{{ $esSupletorios[$student->idStudent] }}</td> --}}
					@endif
				</tr>
			@endforeach
		</table>
		<br>
		<br>
		<br>
		<table class="table">
			<tr>
				<th width="35%"></th>
				<th width="30%">
					<hr style="border:1px solid black;">
					<h4 class="firma--size m-0 uppercase text-center">{{$institution->representante2}}</h4>
					<h4 class="firma--size m-0 uppercase text-center">{{$institution->cargo2}}</h4>
				</th>
				<th width="35%"></th>
			</tr>
		</table>
		<div style="page-break-after:always;"></div>
		{{-- 3era hoja --}}
		@php
			$sliceEstudiantes = 0;
			$cantidadDeEstudiantesPorHojaSumatoria = $reinicioCantidadDeEstudiantesPorHoja;
			$count = 1;
		@endphp
		@while ($cantidadDeEstudiantesPorHojaSumatoria < $cantidadDeEstudiantes)
			<div style="visibility:hidden">
				@include('partials.encabezados.sabana')
			</div>
			<table class="table m-0" style="visibility: hidden">
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
			@php
				$sliceEstudiantes = 0;
				$cantidadDeEstudiantesPorHojaSumatoria = $reinicioCantidadDeEstudiantesPorHoja;
				$count = 1;
			@endphp
			<table class="table" style="width:auto">
				<tr height="40">
					<td rowspan="3" width="5" class="text-center">No.</td>
					@foreach(array_unique($matters->slice(15)->take(5)->pluck('area')->toArray()) as $matter)
						<td colspan="{{ count($matters->slice(15)->take(5)->where('area', $matter) ) * 7}}" class="text-center up bold">{{ $matter }}</td>
					@endforeach
					<td rowspan="3" class="text-center up bold">
						<p class="s-calificaciones__materia libretaQuimestralPorCurso__nombres">
							<span class="up bold">Promedio Final</span>
						</p>
					</td>
					<td rowspan="3" class="up text-center">observaciones</td>
				</tr>
				<tr height="130">
					@foreach($matters->slice(15)->take(5) as $matter)
						<td colspan="7" class="text-center up bold">
							<p class="s-calificaciones__materia libretaQuimestralPorCurso__nombres">
								<span class="up bold">{{ $matter->nombre }}</span>
							</p>
						</td>
					@endforeach
				</tr>
				<tr height="40">
					@foreach($matters->slice(15)->take(5) as $matter)
						<td class="text-center">
							<p class="s-calificaciones__materia libretaQuimestralPorCurso__nombres sabanaTd-nombres">
								<span class="up bold">q1</span>
							</p>
						</td>
						<td class="text-center">
							<p class="s-calificaciones__materia libretaQuimestralPorCurso__nombres sabanaTd-nombres">
								<span class="up bold">q2</span>
							</p>
						</td>
						<td class="text-center">
							<p class="s-calificaciones__materia libretaQuimestralPorCurso__nombres sabanaTd-nombres">
								<span class="up bold">pro</span>
							</p>
						</td>
						<td class="text-center">
							<p class="s-calificaciones__materia libretaQuimestralPorCurso__nombres sabanaTd-nombres">
								<span class="up bold">sup</span>
							</p>
						</td>
						<td class="text-center">
							<p class="s-calificaciones__materia libretaQuimestralPorCurso__nombres sabanaTd-nombres">
								<span class="up bold">rem</span>
							</p>
						</td>
						<td class="text-center">
							<p class="s-calificaciones__materia libretaQuimestralPorCurso__nombres sabanaTd-nombres">
								<span class="up bold">gra</span>
							</p>
						</td>
						<td class="text-center">
							<p class="s-calificaciones__materia libretaQuimestralPorCurso__nombres sabanaTd-nombres">
								<span class="up bold">p.f</span>
							</p>
						</td>
					@endforeach
				</tr>
				@foreach($students->slice($sliceEstudiantes)->take($cantidadDeEstudiantesPorHoja) as $student)
					<tr>
						<td class="text-center">{{ $count++ }}</td>
						@foreach($matters->slice(15)->take(5) as $matter)
						<td class="text-center"> {{ $promediosQ1[$matter->id][$student->idStudent] == 0 ? "" : $promediosQ1[$matter->id][$student->idStudent] }} </td>
							<td class="text-center">{{ $promediosQ2[$matter->id][$student->idStudent] == 0 ? "" : $promediosQ2[$matter->id][$student->idStudent] }}</td>
							<td class="text-center"
							@if($notasMenores == "1")
								@if($promediosAnuales[$matter->id][$student->idStudent] < (int)$nota_menor->valor && $promediosAnuales[$matter->id][$student->idStudent]!=0)
									style="color:red;"
								@endif
							@endif >
							{{ $promediosAnuales[$matter->id][$student->idStudent] == 0 ? "" : $promediosAnuales[$matter->id][$student->idStudent] == 0 ? "" : $promediosAnuales[$matter->id][$student->idStudent] }}</td>
							@if( $promediosAnuales[$matter->id][$student->idStudent] >= 7)
								<td class="text-center"></td>
								<td class="text-center"></td>
								<td class="text-center"></td>
								<td class="text-center">{{ $promediosFinales[$matter->id][$student->idStudent] }}</td>
							@else
								<td class="text-center">{{ $supletorios[$matter->id][$student->idStudent] == 0 ? "" : $supletorios[$matter->id][$student->idStudent] }}</td>
								<td class="text-center">{{ $remediales[$matter->id][$student->idStudent] == 0 ? "" : $remediales[$matter->id][$student->idStudent] }}</td>
								<td class="text-center">{{ $gracias[$matter->id][$student->idStudent] == 0 ? "" : $gracias[$matter->id][$student->idStudent] }}</td>
								<td class="text-center">
									@if( $supletorios[$matter->id][$student->idStudent] < 7 && $remediales[$matter->id][$student->idStudent] < 7 && $gracias[$matter->id][$student->idStudent] < 7)

									@else
										7
									@endif
								</td>
							@endif
						@endforeach
						<td class="text-center">{{ bcdiv( ($aprovechamiento[$student->idStudent]/$numeroDeMaterias), '1', 2) }}</td>

						<td class="up">{{ $esSupletorios[$student->idStudent] }}</td>
					</tr>
				@endforeach
			</table>
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
		<div style="visibility:hidden">
			@include('partials.encabezados.sabana')
		</div>
		<table class="table m-0" style="visibility: hidden">
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
		<table class="table" style="width:auto">
			<tr height="40">
				<td rowspan="3" width="5" class="text-center">No.</td>
				@foreach(array_unique($matters->slice(15)->take(5)->pluck('area')->toArray()) as $matter)
					<td colspan="{{ count($matters->slice(15)->take(5)->where('area', $matter) ) * 7}}" class="text-center up bold">{{ $matter }}</td>
				@endforeach
				<td rowspan="3" class="text-center up bold">
					<p class="s-calificaciones__materia libretaQuimestralPorCurso__nombres">
						<span class="up bold">Promedio Final</span>
					</p>
				</td>
				<td rowspan="3" class="up text-center">observaciones</td>
			</tr>
			<tr height="130">
				@foreach($matters->slice(15)->take(5) as $matter)
					<td colspan="7" class="text-center up bold">
						<p class="s-calificaciones__materia libretaQuimestralPorCurso__nombres">
							<span class="up bold">{{ $matter->nombre }}</span>
						</p>
					</td>
				@endforeach
			</tr>
			<tr height="40">
				@foreach($matters->slice(15)->take(5) as $matter)
					<td class="text-center">
						<p class="s-calificaciones__materia libretaQuimestralPorCurso__nombres sabanaTd-nombres">
							<span class="up bold">q1</span>
						</p>
					</td>
					<td class="text-center">
						<p class="s-calificaciones__materia libretaQuimestralPorCurso__nombres sabanaTd-nombres">
							<span class="up bold">q2</span>
						</p>
					</td>
					<td class="text-center">
						<p class="s-calificaciones__materia libretaQuimestralPorCurso__nombres sabanaTd-nombres">
							<span class="up bold">pro</span>
						</p>
					</td>
					<td class="text-center">
						<p class="s-calificaciones__materia libretaQuimestralPorCurso__nombres sabanaTd-nombres">
							<span class="up bold">sup</span>
						</p>
					</td>
					<td class="text-center">
						<p class="s-calificaciones__materia libretaQuimestralPorCurso__nombres sabanaTd-nombres">
							<span class="up bold">rem</span>
						</p>
					</td>
					<td class="text-center">
						<p class="s-calificaciones__materia libretaQuimestralPorCurso__nombres sabanaTd-nombres">
							<span class="up bold">gra</span>
						</p>
					</td>
					<td class="text-center">
						<p class="s-calificaciones__materia libretaQuimestralPorCurso__nombres sabanaTd-nombres">
							<span class="up bold">p.f</span>
						</p>
					</td>
				@endforeach
			</tr>
			@foreach($students->slice($sliceEstudiantes)->take($cantidadDeEstudiantesPorHoja) as $student)
				<tr>
					<td class="text-center">{{ $count++ }}</td>
					@foreach($matters->slice(15)->take(5) as $matter)
					<td class="text-center"> {{ $promediosQ1[$matter->id][$student->idStudent] == 0 ? "" : $promediosQ1[$matter->id][$student->idStudent] }} </td>
						<td class="text-center">{{ $promediosQ2[$matter->id][$student->idStudent] == 0 ? "" : $promediosQ2[$matter->id][$student->idStudent] }}</td>
						<td class="text-center"
						@if($notasMenores == "1")
							@if($promediosAnuales[$matter->id][$student->idStudent] < (int)$nota_menor->valor && $promediosAnuales[$matter->id][$student->idStudent]!=0)
								style="color:red;"
							@endif
						@endif >
						{{ $promediosAnuales[$matter->id][$student->idStudent] == 0 ? "" : $promediosAnuales[$matter->id][$student->idStudent] == 0 ? "" : $promediosAnuales[$matter->id][$student->idStudent] }}</td>
						@if( $promediosAnuales[$matter->id][$student->idStudent] >= 7)
							<td class="text-center"></td>
							<td class="text-center"></td>
							<td class="text-center"></td>
							<td class="text-center">{{ $promediosFinales[$matter->id][$student->idStudent] }}</td>
						@else
							<td class="text-center">{{ $supletorios[$matter->id][$student->idStudent] == 0 ? "" : $supletorios[$matter->id][$student->idStudent] }}</td>
							<td class="text-center">{{ $remediales[$matter->id][$student->idStudent] == 0 ? "" : $remediales[$matter->id][$student->idStudent] }}</td>
							<td class="text-center">{{ $gracias[$matter->id][$student->idStudent] == 0 ? "" : $gracias[$matter->id][$student->idStudent] }}</td>
							<td class="text-center">
								@if( $supletorios[$matter->id][$student->idStudent] < 7 && $remediales[$matter->id][$student->idStudent] < 7 && $gracias[$matter->id][$student->idStudent] < 7)

								@else
									7
								@endif
							</td>
						@endif
					@endforeach
					<td class="text-center">{{ bcdiv( ($aprovechamiento[$student->idStudent]/$numeroDeMaterias), '1', 2) }}</td>

					<td class="up">{{ $esSupletorios[$student->idStudent] }}</td>
				</tr>
			@endforeach
		</table>
	@endif
</body>

</html>