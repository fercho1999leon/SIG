@extends('layouts.master') 
@section('content')
<a class="button-br" href="{{route('calificacionesR',['hijo' =>  $alumno->id, 'parcial' => $parcial ])}}">
    <button>
        <img src="{{secure_asset('img/return.png')}}" alt="" width="17"> Regresar
    </button>
</a>
<div id="page-wrapper" class="gray-bg dashbard-1">
	@include('layouts.nav_bar_top')
	<div class="row wrapper border-bottom white-bg">
		<div class="repProfileHijo--cont">
			<figure class="repProfileHijo__resumen--img">
				<img src="{{secure_asset('img/icono persona.png')}}" class="img-circle circle-border m-b-md" alt="profile">
			</figure>
			<div class="repProfileHijo__resumen--info">
				<h3 class="repProfileHijo__resumen--name">{{ $alumno->nombres }} {{ $alumno->apellidos }}</h3>
				<hr>
				<div class="repProfileHijo__resumen--curso">
					<h4>
						<strong>Curso: </strong>{{ $course->grado}} {{ $course->paralelo}} {{ $course->especializacion}}</h4>
					<h4>
						<strong>Dirigente: </strong> @if($tutor!=null) {{ $tutor->nombres }} {{ $tutor->apellidos }} @endif </h4>
				</div>
			</div>
		</div>
	</div>
	<div class="row p-1">
		<!-- <div class="a-matricula__estudiantes mb-1">
			<select name="" id="" class="form-control">
				<option value="">Parciales</option>
			</select>
		</div> -->
		<div class="pined-table-responsive p-1 white-bg representante__insumoDetalle">
			<h2 class="text-color3 mt-0">{{ $supply->nombre }}</h2>
			<!-- <table class="s-calificaciones">
				<tr class="table__bgBlue">
					<td class="text-center">#</td>
					<td class="text-center">Estudiante</td>
					@foreach($activities as $activity)
					<td class="text-center">{{ $activity->nombre }}</td>
					@endforeach
					<td class="text-center">Total</td>
					<td>Observación</td>
				</tr>
				<tr>
					<td class="text-center">1</td>
					<td>{{ $alumno->nombres }} {{ $alumno->apellidos }}</td>
					@php					
						$total = 0;
						$c = 0;
					@endphp
					@foreach($activities as $activity)
					@php				
				
						if($notas->where('idActividad', $activity->id)->where('idEstudiante', $alumno->id)->first() != null)
							$nota = $notas->where('idActividad', $activity->id)->where('idEstudiante', $alumno->id)->first()->nota;
						else
							$nota = 0;
						$c++;
						$total = $total + $nota;
					@endphp
					<td class="text-center">{{ bcdiv($nota, '1', 2) }}</td>
					@endforeach
					@php
					$t = 0;
					if($c != 0 )
						$t = $total / $c;

					@endphp
					<td class="text-center">{{ bcdiv($t, '1', 2) }}</td>
					<td></td>
				</tr>
			</table> -->
			<table class="s-calificaciones">
				<tr class="table__bgBlue">
					<td class="text-center">#</td>
					<td class="text-center">Nombre Actividad</td>
					<td>Nota</td>
					<td>Observación</td>
				</tr>
				@php $cont = 0;$total = 0; @endphp
				@foreach($activities as $activity)
				<tr>
				@php
				
					if($notas->where('idActividad', $activity->id)->where('idEstudiante', $alumno->id)->first() != null){
						if($activity->refuerzo == 0 || $notas->where('idActividad', $activity->id)->where('idEstudiante', $alumno->id)->first()->nota != 0){
							$nota = $notas->where('idActividad', $activity->id)->where('idEstudiante', $alumno->id)->first()->nota;
							$cont++;
						}
					}else
						$nota = 0;
					
					$total = $total + $nota;
					
				
				@endphp
					<td class="text-center">{{ $cont }}</td>
					<td class="text-center">{{ $activity->nombre }}</td>
					<td class="text-center">{{  $nota }}</td>
					<td>{{ $activity->observacion }}</td>
					</tr>
				@endforeach
				<tr>
					<td>Promedio Total</td>
					<td colspan="2" ></td>
					@php
					$t = 0;
					if($cont != 0 )
						$t = $total / $cont;

					@endphp
					<td class="text-center">{{ bcdiv($t, '1', 2) }}</td>
				</tr>
			</table>
		</div>
	</div>
</div>
@endsection