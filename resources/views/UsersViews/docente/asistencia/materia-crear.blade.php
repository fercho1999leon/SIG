@extends('layouts.master')
@section('content')
<a class="button-br" href="{{route('docente.asistenciaMateria.materia', [$course->id, $materia->id, 'fecha='.request('fecha')])}}">
		<button>
			<img src="{{secure_asset('img/return.png')}}" alt="" width="17"> Regresar
		</button>
	</a>
    <div id="page-wrapper" class="gray-bg dashbard-1">
        <!-- Incluir el nav_bar_top Cerrar Sesion -->
        @include('layouts.nav_bar_top')
        <div class="row wrapper white-bg ">
            <div class="col-xs-12 seleccion-curso">
                <h2 class="title-page">
					Asistencia <small>{{$materia->nombre}}</small>
                </h2>
            </div>
		</div>
        <div class="wrapper wrapper-content">
            <div class="row">
				<div class="col-xs-12">
					<div class="asistenciaDocente">
						@if ($schedules->isEmpty())
							@php
								if (request('fecha') == Carbon\Carbon::now()->format('Y-m-d')) {
									$message = 'Esta matería, no tiene horario para el día de hoy';
								} else {
									$message = 'Esta matería, no tiene horario para el día '.App\Fechas::diaDeLaSemana($day).' '.Carbon\Carbon::createFromFormat('Y-m-d', request('fecha'))->day;
								}
							@endphp
							<div class="text-center max-w-2xl mx-auto alert alert-warning"
								role="alert">{{$message}}
							</div>
						@endif

						<div class="max-w-2xl mx-auto">
							<form class="max-w-xs mb-4" method="GET">
								<select name="schedule" id="schedule" class="form-control">
									@if ($schedules->isNotEmpty())
										<option value="">Escoja un horario...</option>
									@endif
									@forelse ($schedules as $schedule)
										<option
											value="{{ $schedule->id }}"
											{{request('schedule') == $schedule->id ? 'selected' : ''}}>
												{{ substr($schedule->horaInicio,0,5) }} - {{ substr($schedule->horaFin,0,5) }}
										</option>
									@empty
										<option value="">...</option>
									@endforelse
								</select>
							</form>

							@if ($newStudent)

								<form class="max-w-xs mb-4" action="{{route('docente.asistenciaMateria.updateListStudent', [$course, $materia])}}" method="GET">
									<input type="hidden" name="fecha" value="{{request('fecha')}}">
									<input type="hidden" name="schedule" value="{{request('schedule')}}">

									<div class="p-1 white-bg" style="display: none">
										<table class="s-calificaciones white-bg w100">
											<tr class="table__bgBlue">
												<td class="p-1">ESTUDIANTES</td>
												<td class="text-center">ESTADO</td>
												<td>OBSERVACIÓN</td>
											</tr>
											
											@foreach($newStudent as $student)
													<input type="hidden" name="idStudents[]" value="{{$student}}">
													<tr style="display:none" class="trEstudiantes">
														<td></td>
														<td>
															<select name="estado[]" id="" class="form-control" required>
																<option {{'ASISTIO'}}selected value="ASISTIO" >Asistio</option>
																<option {{'NO ASISTIO'}} value="NO ASISTIO">No Asistio</option>
																<option {{'ATRASADO'}} value="ATRASADO" >Atrasado</option>
															</select>
														</td>
														<td>
															<textarea name="observacion[]" cols="30" rows="2" class="form-control">{{''}}</textarea>
														</td>
													</tr>
												
												<input type="hidden" name="asistenciaId[]" value="{{$student}}">
											@endforeach
										</table>
									</div>
									<div class="text-center mt-1">
										<input id="btn-submit" type="submit" value="{{'NEW STUDENT '.count($newStudent).' UPDATE'}}" class="btn btn-lg btn-primary">
									</div>
								</form>	
							@endif
							<div class="pined-table-responsive p-0">
								<form
									@if ($esUnaColeccion === true)
										action="{{route('docente.asistenciaMateria.postAsistencia', [$course, $materia, 'fecha='.request('fecha'), 'schedule='.request('schedule')])}}" method="POST">
									@else
										action="{{route('docente.asistenciaMateria.updateAsistencia', [$course, $materia, 'fecha='.request('fecha'), 'schedule='.request('schedule')])}}" method="POST">
										{{method_field('PUT')}}
									@endif
									{{ csrf_field() }}
									@include('partials.asistenciaDiaria.formulario')
								</form>
							</div>
						</div>
					</div>
				</div>
            </div>
        </div>
	</div>
	<script>
		const date = document.getElementById('date')
		const schedule = document.getElementById('schedule')
		const btnSubmit = document.getElementById('btn-submit')
		const trEstudiantes = document.querySelectorAll('.trEstudiantes')
		const url = "{{route('docente.asistenciaMateria.materia-js')}}"
		const idCurso = '{{$course->id}}'
		const idMateria = '{{$materia->id}}'
		if (schedule) {
			schedule.addEventListener('change', function() {
				let idSchedule = schedule.value

				const newurl = `${url}/${idCurso}/${idMateria}/crear`
				let newDate = "{{request('fecha')}}";
				location.href = newurl+'?fecha='+newDate+'&schedule='+idSchedule;
			})
		}
		if (schedule.value !== '') {
			trEstudiantes.forEach(e => {
				e.style.display = 'table-row'
			});
			btnSubmit.removeAttribute('disabled')
		}

	</script>
@endsection