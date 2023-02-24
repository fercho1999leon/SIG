<!DOCTYPE html>
<html lang="es">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link rel="stylesheet" href="{{ secure_asset('css/pdf/pdf.css') }}">
	<title>{{$tituloTitle}}</title>
</head>
<style>
    .s-calificaciones__materia2 {
  width: 8px;
  font-size: 8px;
  -webkit-transform: rotate(-90deg);
          transform: rotate(-90deg);
  position: relative;
  font-weight: bold;
  left: 5px;
}
.s-calificaciones__materia2 > span {
  display: block;
  white-space: initial;
  line-height: 1;
  width: 115px;
  text-align: center;
}
</style>
@php
$numeroDeAreas = count($areas);
//dd($numeroDeAreas);
@endphp
<body>
		@include('partials.encabezados.sabana')
		<table class="table m-0 line-height:7px !important;">
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
		<table class="table whitespace-no line-height:7px !important;">
			<tr height="15">
				<td rowspan="3" class="text-center">No.</td>
				<td rowspan="3" class="bold text-center up">apellidos y nombres</td>
				<td rowspan="3" class="text-center up bold">
					Comp
                </td>
                @foreach($areas as $area)
				    <td colspan="{{$area->numero * 3}}" class="text-center up">{{ $area->nombreArea}}</td>
				@endforeach
                <td rowspan="3" class="text-center up bold">
                    Pro.F
                </td>
                @if($dhi != null)
                    <td colspan="3" class="text-center uppercase bold">
                        {{$dhi->nombre}}
                    </td>
                @endif
                <td rowspan="3" class="up text-center">observaciones</td>
			</tr>
			<tr height="15">
				@foreach($areas as $area)
					@foreach($matters as $matter)
						@if($matter->nombreArea == $area->nombreArea)
							<td class="text-center up bold" colspan="3">
								{{ $matter->nombre }}
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
			<tr height="15">
				@foreach($areas as $area)
					@foreach($matters as $matter)
						@if($matter->nombreArea == $area->nombreArea)
							@foreach($unidades_a as $unidad)
								<td class="text-center up bold">
									{{$unidad->identificador}}
								</td>
							@endforeach
							<td class="text-center up bold">
								PRO
							</td>
						@endif
					@endforeach
				@endforeach
                @if($dhi!=null)
					@foreach($unidades_a as $unidad)
                        <td class="text-center up bold">
						    {{$unidad->identificador}}
						</td>
					@endforeach
                    <td class="text-center up bold">
                        PRO
                    </td>
				@endif
			</tr>
			<tr>
			@foreach($sabana->slice($sliceEstudiantes) as $estudiante)
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
                @foreach($areas as $area)
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
		 <div class="row" style="line-height: 7px">
            <div class="col-xs-6 p-0 text-center ">
                <hr class="certificado__hr">
                <p class="uppercase" style="font-size: 9px !important;">
                    {{ $institution->representante1 }} <br> {{ $institution->cargo1 }}
                </p>
            </div>
            <div class="col-xs-6 p-0 text-center" style="line-height: 7px">
                <hr class="certificado__hr">
                <p class="uppercase"  style="font-size: 9px !important;">
                    {{ $institution->representante2 }} <br> {{ $institution->cargo2 }}
                </p>
            </div>
        </div>
		@php
			$sliceEstudiantes = $sliceEstudiantes + $cantidadDeEstudiantesPorHoja; //10 pasa, 20 pasa
			$cantidadDeEstudiantesPorHojaSumatoria = $sliceEstudiantes + $cantidadDeEstudiantesPorHoja; // 20 pasa , 30
        @endphp

</body>
</html>