@extends('layouts.master')
@section('content')
@php
use App\Permiso;
$permiso = Permiso::desbloqueo('admin.asistenciaMateria.index');
@endphp
	<a class="button-br"
		@if ($perfil->cargo === 'Administrador' || $tutor == 'true')
			href="{{route('admin.asistenciaMateria', $course->id)}}"
		@else
			href="{{route('docente.asistenciaMateria-materias')}}"
		@endif
		>
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
					Asistencia <small>{{$course->grado}} {{$course->especializacion}} {{$course->paralelo}} {{$materia->nombre}}</small>
                </h2>
            </div>
		</div>
        <div class="wrapper wrapper-content">
            <div class="row">
				<div class="col-xs-12">
					<div class="asistenciaDocente">
						<form class="" method="GET">
							<div class="agendaEscolar__buscador">
								<input name="fecha" type="date" class="form-control" value="{{request('fecha')}}" required>
								<button class="btn btn-primary" type="submit">Buscar</button>
							</div>
						</form>
						<div class="table-responsive">
							<table class="table bg-white max-w-6xl m-auto mb-6 whitespace-no">
								<tr class="table__bgBlue" style="font-weight:500">
									<td rowspan="2" width="5" class="text-center">#</td>
									<td rowspan="2">Nombre del estudiantes</td>
									
									@foreach ($diasDeLaSemana as $fecha => $dia)
										<td class="text-center" colspan="{{count($course->schedules()->where('dia'.$count, $materia->id)->get())}}">
											{{$dia[$count++]}} {{substr($fecha,8,2)}}
											@if($permiso ==null || ($permiso != null && $permiso->editar == 1))
												<a href="{{route('docente.asistenciaMateria.materiaCrear', [$course, $materia, 'fecha='.$fecha])}}" class="text-white">
												<i class="fa fa-pencil"></i>
											</a>
											@endif
										</td>
									@endforeach
								</tr>
								<tr class="table__bgBlue" style="font-weight:500">
									@for ($i = 1; $i <= 7; $i++)
										@forelse ($course->schedules()->where('dia'.$i, $materia->id)->get() as $hora)
											<td class="text-center">
												{{substr($hora->horaInicio,0,5)}} - {{substr($hora->horaFin,0,5)}}
											</td>
										@empty
											<td class="text-center">-</td>
										@endforelse
									@endfor
                                </tr>
								@foreach($students->sortBy('apellidos') as $student)
									<tr>
										<td class="text-center">{{$countStudents++}}</td>
										<td>{{$student->apellidos}} {{$student->nombres}}</td>
										@for ($i=1; $i <= 7; $i++)
											@forelse ($course->schedules()->where('dia'.$i, $materia->id)->get() as $hora)
												@php
													$asistencia = App\DailyAssistance::query()
														->where('idCurso', $course->id)
														->where('idMateria', $materia->id)
														->where('idEstudiante', $student->idStudent)
														->where('idSchedule', $hora->id)
														->where('fecha', $fecha1->startOfWeek()->addDay($i-1)->format('Y-m-d'))
														->first();
												@endphp
												<td class="text-center">
													{{$asistencia->estado ?? '-'}}
												</td>
											@empty
												<td class="text-center"></td>
											@endforelse
										@endfor
									</tr>
								@endforeach
							</table>
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
		if (date && schedule) {
			date.addEventListener('change', function() {
				const newurl = `${url}/${idCurso}/${idMateria}`
				let newDate = date.value;
				location.href = newurl+'?fecha='+newDate;
			})

			schedule.addEventListener('change', function() {
				let idSchedule = schedule.value

				const newurl = `${url}/${idCurso}/${idMateria}`
				let newDate = date.value;
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