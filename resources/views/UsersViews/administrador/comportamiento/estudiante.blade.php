@extends('layouts.master')
@section('content')
@php
$unidad = App\UnidadPeriodica::unidadP();
@endphp
<a class="button-br" href=" {{route('comportamiento-curso', ['id' => $course->id, 'parcial' => $parcial])}} ">
	<button>
		<img src="{{secure_asset('img/return.png')}}" alt="" width="17"> Regresar
	</button>
</a>
<div id="page-wrapper" class="gray-bg dashbard-1">
    @include('layouts.nav_bar_top')
    <div class="row wrapper white-bg ">
        <div class="col-lg-12 titulo-separacion">
			<h2 class="title-page">Comportamiento</h2>
			<select class="select__header form-control" id="selectParcial">
                @foreach($unidad as $und)
                <optgroup label="{{$und->nombre}}">
                    @php
                    $parcialP = App\ParcialPeriodico::parcialP($und->id);
                    @endphp
                    @foreach($parcialP as $par )
                        <option value="{{$par->identificador}}" {{$par->identificador == $parcial ? 'selected' : ''}} >{{$par->nombre}}</option>
                    @endforeach
                    </optgroup>
                @endforeach
                	<option value="anual" {{$parcial == 'anual' ? 'selected' : ''}}>Anual</option>
            </select>
		</div>
		<div class="row wrapper migajasDePan">
			<div class="col-lg-12">
				<div class="border">
					<a href="{{route('comportamiento-curso', ['id' => $course->id, 'parcial' => $parcial])}}" > {{$course->grado}} {{$course->especialzacion}} {{$course->paralelo}} </a>
					<img src="{{secure_asset('img/chevron-double-right-solid.svg')}}" width="10" alt="">
					<a class="no-pointer"> {{$student->apellidos}} {{$student->nombres}} </a>
				</div>
			</div>
		</div>
    </div>
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
						<form method="POST" action=" {{route('comportamiento-estudiante-store', ['idEstudiante' => $student->id, 'parcial' => $parcial, 'idCurso' => $course->id])}} ">
							@include('partials.comportamiento.comportamiento')
						</form>
					@else
						<form method="POST" action=" {{route('comportamiento-estudiante-update', ['idEstudiante' => $student->id, 'parcial' => $parcial, 'idCurso' => $course->id])}} ">
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
<script>
	function load() {
		const url = "{{route('comportamiento-estudiante-js')}}"
		const idCurso = '{{$course->id}}'
		const idStudent = '{{$student->id}}'
		const selectParciales = document.getElementById('selectParcial')
		if(selectParciales) {
			selectParciales.addEventListener('change', function() {
				const parcial = selectParciales.value
				let newurl = `${url}/${idStudent}/${parcial}/${idCurso}`
				location.href = newurl;
			})
		} else {
			console.log('no se pudo obtener el id del select')
		}
	}
	window.onload = load;
</script>