@extends('layouts.master')
@section('content')
@include('partials.loader.loader')
<div id="page-wrapper" class="gray-bg dashbard-1">
    @include('layouts.nav_bar_top')
    <div class="row wrapper white-bg ">
        <div class="col-lg-12 titulo-separacion">
            <h2 class="title-page">Comportamiento</h2>
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
                        <div class=" bg-none">
							@foreach ($coursesEI->groupBy('grado') as $key => $courses)
								<div class="typeOfCourse">
									<h3 class="a-btn__cursos">{{$key}}</h3>
									<div class="gradosCalificaciones-grid">
										@foreach ($courses as $course)
											<div class="gradosCalificaciones-item">
												<div class="gradosCalificaciones-curso">
													<a href="{{route('comportamiento-curso', ['id' => $course->id, 'parcial' => 'p1q1'])}}">
														<img src="{{secure_asset('img/iconCalificaciones.svg')}}" class="mr-05" width="20" alt="">
														{{$course->grado}} {{$course->especializacion}} {{$course->paralelo}}
													</a>
												</div>
											</div>
										@endforeach
									</div>
								</div>
							@endforeach
                        </div>
                    </div>
                    <div id="tab-2" class="tab-pane active">
                        <div class=" bg-none">
							@foreach ($coursesEGB->groupBy('grado') as $key => $courses)
								<div class="typeOfCourse">
									<h3 class="a-btn__cursos">{{$key}}</h3>
									<div class="gradosCalificaciones-grid">
										@foreach ($courses as $course)
											<div class="gradosCalificaciones-item">
												<div class="gradosCalificaciones-curso">
													<a href="{{route('comportamiento-curso', ['id' => $course->id, 'parcial' => 'p1q1'])}}">
														<img src="{{secure_asset('img/iconCalificaciones.svg')}}" class="mr-05" width="20" alt="">
														{{$course->grado}} {{$course->especializacion}} {{$course->paralelo}}
													</a>
												</div>
											</div>
										@endforeach
									</div>
								</div>
							@endforeach
                        </div>
                    </div>
                    <div id="tab-3" class="tab-pane ">
                        <div class=" bg-none">
							@foreach ($coursesBGU->groupBy('grado') as $key => $courses)
								<div class="typeOfCourse">
									<h3 class="a-btn__cursos">{{$key}}</h3>
									<div class="gradosCalificaciones-grid">
										@foreach ($courses as $course)
											<div class="gradosCalificaciones-item">
												<div class="gradosCalificaciones-curso">
													<a href="{{route('comportamiento-curso', ['id' => $course->id, 'parcial' => 'p1q1'])}}">
														<img src="{{secure_asset('img/iconCalificaciones.svg')}}" class="mr-05" width="20" alt="">
														{{$course->grado}} {{$course->especializacion}} {{$course->paralelo}}
													</a>
												</div>
											</div>
										@endforeach
									</div>
								</div>
							@endforeach
                        </div>
                    </div>
                </div>
            </div>
            @else
            	<h3 class="a-btn__cursos">
					<span class="etiquetaLetra"> Secundaria </span>
				</h3>
				<div class="card-asistencia">
					@foreach($coursesEGB as $course)
						@if($course->grado=='Octavo')
							<div class="lista_alumnos">
								<article class="dirInformacion__cursos--item">
									<div class="dirInformacion__cursos--info">
										<h3>
											<a href="{{route('comportamiento-curso', ['id' => $course->id, 'parcial' => 'p1q1'])}}">
												Secundaria
												{{$course->paralelo}}
											</a>
										</h3>
									</div>
								</article>
							</div>
						@endif
					@endforeach
				</div>

				<h3 class="a-btn__cursos">
					<span class="etiquetaLetra">Bachillerato</span>
				</h3>
				<div class="card-asistencia">
					@foreach($coursesBGU as $course)

							<div class="lista_alumnos">
								<article class="dirInformacion__cursos--item">
									<div class="dirInformacion__cursos--info">
										<h3>
											<a href="{{route('comportamiento-curso', ['id' => $course->id, 'parcial' => 'p1q1'])}}">
												{{$course->grado}} {{$course->paralelo}}
											</a>
										</h3>
									</div>
								</article>
							</div>

					@endforeach
				</div>

            @endif
        </div>
    </div>
</div>
</div>
@endsection