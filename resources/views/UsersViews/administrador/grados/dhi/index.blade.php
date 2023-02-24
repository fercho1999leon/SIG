@extends('layouts.master')
@section('content')
@php
$unidad = App\UnidadPeriodica::unidadP();
$permiso = App\Permiso::desbloqueo('dhiAdmin');
@endphp
{{-- @include('partials.loader.loader') --}}
    <div id="page-wrapper" class="gray-bg dashbard-1">
        @include('layouts.nav_bar_top')
        <div class="row wrapper white-bg " >
            <div class="col-lg-12 titulo-separacion">
				<h2 class="title-page">Desarrollo Humano Integral</h2>
				<select class="selectpicker form-control select__header" id="selectParcial">
				@if ($configuracionDHI->valor == 'PARCIAL')
                @foreach($unidad as $und)
                <optgroup label="{{$und->nombre}}">
                    @php
                    $parcialP = App\ParcialPeriodico::parcialP($und->id);
                    @endphp
                    @foreach($parcialP as $par )
                    @if(($par->identificador == 'q1') || ($par->identificador == 'q2'))
                    @else
                        <option value="{{$par->identificador}}" {{$par->identificador == $parcial ? 'selected' : ''}} >{{$par->nombre}}</option>
                    @endif
                    @endforeach
                    </optgroup>
                @endforeach
                @endif
                 <optgroup label="Quimestres">
						<option {{$parcial == 'q1' ? 'selected' : ''}} value="q1">1er Quimestre</option>
						<option {{$parcial == 'q2' ? 'selected' : ''}} value="q2">2do Quimestre</option>
				</optgroup>
				<optgroup label="Anual">
						<option {{$parcial == 'exq1' ? 'selected' : ''}} value="exq1">Anual</option>
				</optgroup>
            </select>
            </div>
		</div>
        <div class="row mt-1 mb350">
            <div class="col-lg-12">
            	@if($regimen=='Regular')
	                <div class="tabs-container">
	                    <ul class="nav nav-tabs">
	                        <li>
	                            <a data-toggle="tab" href="#tab-1">Educación Inicial</a>
	                        </li>
	                        <li class="active">
	                            <a data-toggle="tab" href="#tab-2">Educación General Básica</a>
	                        </li>
	                        <li>
	                            <a data-toggle="tab" href="#tab-3">Bachillerato General Unificado</a>
	                        </li>
	                    </ul>
	                    <div class="tab-content">
	                        <div id="tab-1" class="tab-pane">
								@foreach ($coursesEI->groupBy('grado') as $key => $courses)
									<div class="typeOfCourse">
										<h3 class="a-btn__cursos"> {{$key}} </h3>
										<div class="gradosCalificaciones-grid">
											@foreach($courses as $course)
												<div class="gradosCalificaciones-item">
													<div class="gradosCalificaciones-curso">
														<p class="mb-0"> {{ $course->grado }} {{$course->especializacion}} {{ $course->paralelo }}
														</p>
													</div>
													<div>
														@php
															$materia = App\Matter::where('nombre', 'DESARROLLO HUMANO INTEGRAL')
																->where('idCurso', $course->id)
																->first();
														@endphp
														@if ($materia[$parcial] != null)
															<button class="dhi-habilidad"> {{$materia[$parcial]}} </button>
														@endif
														@if ($materia != null)
														@if($permiso ==null || ($permiso != null && $permiso->editar == 1))
															<a class="dhi" data-idCurso="{{$course->id}}" href="{{route('dhiCurso', ['parcial' => $parcial, $course])}}" data-toggle="modal" data-target="#dhi">
																<i class="fa fa-pencil a-fa-pencil__matricula"></i>
															</a>
														@endif
														@endif
													</div>
												</div>
											@endforeach
										</div>
									</div>
								@endforeach
	                        </div>
	                        <div id="tab-2" class="tab-pane active">
								@foreach ($coursesEGB->groupBy('grado') as $key => $courses)
									<div class="typeOfCourse">
										<h3 class="a-btn__cursos"> {{$key}} </h3>
										<div class="gradosCalificaciones-grid">
											@foreach($courses as $course)
												<div class="gradosCalificaciones-item">
													<div class="gradosCalificaciones-curso">
														<p class="mb-0"> {{ $course->grado }} {{$course->especializacion}} {{ $course->paralelo }}
														</p>
													</div>
													<div>
														@php
															$materia = App\Matter::where('nombre', 'DESARROLLO HUMANO INTEGRAL')
																->where('idCurso', $course->id)
																->first();
														@endphp
														@if ($materia[$parcial] != null)
															<button class="dhi-habilidad"> {{$materia[$parcial]}} </button>
														@endif
														@if ($materia != null)
														@if($permiso ==null || ($permiso != null && $permiso->editar == 1))
															<a class="dhi" data-idCurso="{{$course->id}}" href="{{route('dhiCurso', ['parcial' => $parcial, $course])}}" data-toggle="modal" data-target="#dhi">
																<i class="fa fa-pencil a-fa-pencil__matricula"></i>
															</a>
														@endif
														@endif
													</div>
												</div>
											@endforeach
										</div>
									</div>
								@endforeach
	                        </div>
	                        <div id="tab-3" class="tab-pane">
								@foreach ($coursesBGU->groupBy('grado') as $key => $courses)
									<div class="typeOfCourse">
										<h3 class="a-btn__cursos"> {{$key}} </h3>
										<div class="gradosCalificaciones-grid">
											@foreach($courses as $course)
												<div class="gradosCalificaciones-item">
													<div class="gradosCalificaciones-curso">
														<p class="mb-0"> {{ $course->grado }} {{$course->especializacion}} {{ $course->paralelo }}
														</p>
													</div>
													<div>
														@php
															$materia = App\Matter::where('nombre', 'DESARROLLO HUMANO INTEGRAL')
																->where('idCurso', $course->id)
																->first();
														@endphp
														@if ($materia[$parcial] != null)
															<button class="dhi-habilidad"> {{$materia[$parcial]}} </button>
														@endif
														@if ($materia != null)
														@if($permiso ==null || ($permiso != null && $permiso->editar == 1))
															<a class="dhi" data-idCurso="{{$course->id}}" href="{{route('dhiCurso', ['parcial' => $parcial, $course])}}" data-toggle="modal" data-target="#dhi">
																<i class="fa fa-pencil a-fa-pencil__matricula"></i>
															</a>
														@endif
														@endif
													</div>
												</div>
											@endforeach
										</div>
									</div>
								@endforeach
	                        </div>
	                    </div>
	                </div>
                @else
	                <h3 class="a-btn__cursos">
						<span class="etiquetaLetra"> Secundaria </span>
					</h3>
					<div class="card-asistencia">
					</div>
					<h3 class="a-btn__cursos">
						<span class="etiquetaLetra"> Bachillerato </span>
					</h3>
					<div class="card-asistencia">

					</div>
                @endif
            </div>
        </div>
	</div>

	{{-- Modal DHI  --}}
	<div class="modal fade" id="modalDHI" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">

	</div>
@endsection
@section('scripts')
	<script>
		var cargo = '{{$cargo}}'
		if (cargo == 'administrador') {
			var url = "{{route('dhiAdmin-js')}}"
		} else {
			var url = "{{route('dhiDocente-js')}}"
		}
		const selectParcial = document.getElementById('selectParcial')
		selectParcial.addEventListener('change', function() {
			const parcial = selectParcial.value
			let newurl = `${url}/${parcial}`
			location.href = newurl;
		})
		// Trae la información sobre DHI
		var dhi = $('.dhi')
		dhi.click(function() {
			$.ajax({
				type: "GET",
				url: $(this).attr('href'),
				success: function (response) {
					$('#modalDHI').html(response)
					$('#modalDHI').modal('show')
				}, error: function() {
					alert('Hubo un error.')
				}
			});
		})

		// <script>
		// POST, enviando los datos a la base de datos
		var addDHI = $('#agregarDHI');
		addDHI.click(function() {
			console.log('test')
			$.ajax({
				type: "POST",
				url: $(this).attr('route'),
				success: function (response) {
					console.log(response)
				}
			});
		})
// </script>
@endsection

