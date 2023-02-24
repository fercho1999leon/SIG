@extends('layouts.master')
@section('content')
	<a class="button-br" href="{{route('docente.asistenciaMateria')}}">
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
						<form class="asistenciaDocente__generar" id="frmGenerar">
							<input id="fecha" name="fecha" type="date" class="form-control" value="{{request('fecha')}}" required>
							@if($course->schedules->isNotEmpty())
								<select name="schedule" id="schedule" class="form-control" required>
									@foreach ($schedules as $schedule)
										<option 
											value="{{ $schedule->id }}" 
											{{request('schedule') == $schedule->id ? 'selected' : ''}}>
												{{ substr($schedule->horaInicio,0,5) }} - {{ substr($schedule->horaFin,0,5) }}
										</option>
									@endforeach
								</select>
							@endif
							<button class="btn btn-blue" id="btnGenerar" type="submit">GENERAR</button>
						</form>
						<div class="asistenciaDocente__table">
							<div class="pined-table-responsive p-0">
								<form action="{{route('docente.asistenciaMateria.updateAsistencia', [$course, $materia])}}" method="POST">
									{{ csrf_field() }}
									{{method_field('PUT')}} 
									@include('partials.asistenciaDiaria.formulario')
								</form>
							</div>
						</div>
					</div>
				</div>
            </div>
        </div>
    </div>
@endsection