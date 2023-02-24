@php
	use App\ParcialPeriodico;
@endphp
@foreach($course->groupBy('grado') as $key => $course)
	<div>
		<h3 class="a-btn__cursos">
			{{$key}}
		</h3>
	</div>
	<div class="row">
		<div class="col-xs-12">
			<div class="configuracionesHorarios__porGrado-grid">
				@foreach ($course as $course)
					@if ($regimen == 'Regular')
						<div class="bg-white rounded shadow mb-4 p-4">
							@if ($course->especializacion)
								<h2 class="mb-4 text-center"> {{$course->especializacion}}</h2>
							@endif
							<h2 class="mb-4 text-center"> {{$course->paralelo}}</h2>
							<div class="flex justify-between">
								<div></div>
								<a href="{{route('creacionHorarioGeneral', ['idCourse' => $course->id, 'parcial' => (ParcialPeriodico::where('idPeriodo',$course->idPeriodo)->first())->identificador])}}">
									<i class="icon__editar fa fa-pencil"></i>
								</a>
							</div>
						</div>
					@else
						@if ($key == 'octavo')
							<div class="bg-white rounded shadow mb-4 p-4">
								@if ($course->especializacion)
									<h2 class="mb-4 text-center"> {{$course->especializacion}}</h3>
								@endif
								<h2 class="mb-4 text-center"> {{$course->paralelo}}</h2>
								<div class="flex justify-between">
									<div></div>
									<a href="{{route('creacionHorarioGeneral', ['idCourse' => $course->id, 'parcial' => 'clases'])}}">
										<i class="icon__editar fa fa-pencil"></i>
									</a>
								</div>
							</div>
						@endif
					@endif
				@endforeach
			</div>
		</div>
	</div>
@endforeach