@extends('layouts.master')
@section('content')
<a class="button-br" href="{{ route('tutor-comportamiento', ['course' => $course->id, 'parcial' => $parcial] ) }}">
	<button>
		<img src="{{secure_asset('img/return.png')}}" alt="" width="17"> Regresar
	</button>
</a>
<div id="page-wrapper" class="gray-bg dashbard-1">
    @include('layouts.nav_bar_top')
    <div class="row wrapper white-bg ">
        <div class="col-lg-12 titulo-separacion">
			<h2 class="title-page">Comportamiento <small> {{$course->grado}} {{$course->especializacion}} {{$course->paralelo}} / {{$student->apellidos}} {{$student->nombres}} </small> </h2>
			{{-- <select class="select__header form-control" id="selectParcial">
				<optgroup label="Quimestre 1">
					<option value="p1q1" {{$parcial == 'p1q1' ? 'selected' : '' }}>Q1 - Parcial 1</option>
					<option value="p2q1" {{$parcial == 'p2q1' ? 'selected' : '' }}>Q1 - Parcial 2</option>
					<option value="p3q1" {{$parcial == 'p3q1' ? 'selected' : '' }}>Q1 - Parcial 3</option>
					@if ($confComportamiento->valor == 'crear')
						<option value="q1" {{$parcial == 'q1' ? 'selected' : ''}}>Quimestre 1</option>
					@endif
				</optgroup>
				<optgroup label="Quimestre 2">
					<option value="p1q2" {{$parcial == 'p1q2' ? 'selected' : '' }}>Q2 - Parcial 1</option>
					<option value="p2q2" {{$parcial == 'p2q2' ? 'selected' : '' }}>Q2 - Parcial 2</option>
					<option value="p3q2" {{$parcial == 'p3q2' ? 'selected' : '' }}>Q2 - Parcial 3</option>
					@if ($confComportamiento->valor == 'crear')
						<option value="q2" {{$parcial == 'q2' ? 'selected' : ''}}>Quimestre 2</option>
						<option value="anual" {{$parcial == 'anual' ? 'selected' : ''}}>Anual</option>
					@endif
				</optgroup>
			</select> --}}
			<select class="select__header form-control" id="selectParcial">
				@foreach($unidad as $und)
					<optgroup label="{{$und->nombre}}">
						@php $pars = $parcialP->where('idUnidad',$und->id); @endphp
						@foreach($pars as $par )
							<option value="{{$par->identificador}}" {{$par->identificador == $parcial ? 'selected' : ''}} >{{ (substr($par->nombre, 3,6) == "Examen") ? $und->nombre : $par->nombre }}</option>
						@endforeach
					</optgroup>
				@endforeach
				@if ($confComportamiento->valor == 'crear')
					<option value="anual" {{$parcial == 'anual' ? 'selected' : ''}}>Anual</option>
				@endif
			</select>
        </div>
    </div>
    <br>
    @include('partials.comportamiento.materias-estudiante')

	<!-- Horario de Clase -->
	<div id="H-C" class="wrapper wrapper-content mt-1">
		{{-- <div class="row">
			<div class="col-lg-12">
				<div class="panel panel-default">
					<div class="horario-clases">
						<div class="table-responsive">
							<table class="table ss1">
								<tbody id="horario">
									@foreach($schedules as $schedule)
										<tr>
											<td class="subject" style="vertical-align: middle;background: #C0392B;color: #FFFFFF">
												@foreach($matters->where('id', $schedule->dia1) as $matter)
													{{ $matter->nombre}}
													@foreach ($comportamientoPorMaterias->where('idMateria', $matter->id)->where('parcial', $parcial) as $comportamientoMateria)
														<br><span class="comportamientoNota-general">{{$comportamientoMateria->nota}}</span>
													@endforeach
												@endforeach

											</td>
											<td class="subject" style="vertical-align: middle;background: #9B59B6;color: #FFFFFF">
												@foreach($matters->where('id', $schedule->dia2) as $matter)
													{{ $matter->nombre}}
													@foreach ($comportamientoPorMaterias->where('idMateria', $matter->id)->where('parcial', $parcial) as $comportamientoMateria)
														<br><span class="comportamientoNota-general">{{$comportamientoMateria->nota}}</span>
													@endforeach
												@endforeach
											</td>
											<td class="subject" style="vertical-align: middle;background: #2980B9;color: #FFFFFF">
												@foreach($matters->where('id', $schedule->dia3) as $matter)
													{{ $matter->nombre}}
													@foreach ($comportamientoPorMaterias->where('idMateria', $matter->id)->where('parcial', $parcial) as $comportamientoMateria)
														<br><span class="comportamientoNota-general">{{$comportamientoMateria->nota}}</span>
													@endforeach
												@endforeach
											</td>
											<td class="subject" style="vertical-align: middle;background: #1ABC9C;color: #FFFFFF">
												@foreach($matters->where('id', $schedule->dia4) as $matter)
													{{ $matter->nombre}}
													@foreach ($comportamientoPorMaterias->where('idMateria', $matter->id)->where('parcial', $parcial) as $comportamientoMateria)
														<br><span class="comportamientoNota-general">{{$comportamientoMateria->nota}}</span>
													@endforeach
												@endforeach
											</td>
											<td class="subject" style="vertical-align: middle;background: #27AE60;color: #FFFFFF">
												@foreach($matters->where('id', $schedule->dia5) as $matter)
													{{ $matter->nombre}}
													@foreach ($comportamientoPorMaterias->where('idMateria', $matter->id)->where('parcial', $parcial) as $comportamientoMateria)
														<br><span class="comportamientoNota-general">{{$comportamientoMateria->nota}}</span>
													@endforeach
												@endforeach
											</td>
										</tr>
									@endforeach
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div> --}}
		<div class="row">
			<div class="col-xs-1">
			</div>
			<div class="col-xs-10">
				<div class="comportamiento__estudiante"></div>
				<div class="col-xs-12">
					@if ($comportamientoEstudiante == null)
						<form method="POST" action=" {{route('tutor-comportamiento-store', ['idCurso' => $course->id, 'idEstudiante' => $student->id, 'parcial' => $parcial])}} ">
							@include('partials.comportamiento.comportamiento')
						</form>
					@else
						<form method="POST" action=" {{route('tutor-comportamiento-update', ['idEstudiante' => $student->id, 'parcial' => $parcial, 'idCurso' => $course->id])}} ">
							{{ method_field('PUT') }}
							@include('partials.comportamiento.comportamiento')
						</form>
					@endif
				</div>
			</div>
			<div class="col-xs-1">
			</div>
		</div>
	</div>
</div>
</div>
@endsection
@section('scripts')
<script>
	const url = "{{route('tutor-comportamiento-js')}}"
	const idCurso = '{{$course->id}}'
	const idEstudiante = '{{$student->id}}'
	const selectParciales = document.getElementById('selectParcial')
	if(selectParciales) {
		selectParciales.addEventListener('change', function() {
			const parcial = selectParciales.value
			let newurl = `${url}/${idCurso}/${parcial}/${idEstudiante}`
			location.href = newurl;
		})
	} else {
		console.log('no se pudo obtener el id del select')
	}
</script>
@endsection