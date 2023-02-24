@extends('layouts.master')
@section('content')
@include('partials.loader.loader')
    <div id="page-wrapper" class="gray-bg dashbard-1">
        @include('layouts.nav_bar_top')
        <div class="row wrapper white-bg ">
            <div class="col-lg-12 titulo-separacion">
                <h2 class="title-page">Grados
                    <small>Horario de Clases</small>
                </h2>
            </div>
        </div>
        <div class="row mb350 mt-1">
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
                        	@if ($user_profile->type_of_supervisor == null || $user_profile->type_of_supervisor == 'inicial_y_preparatorio')
							@foreach($coursesEI->groupBy('grado') as $key => $courses)
								<div class="typeOfCourse">
									<h3 class="a-btn__cursos"> {{$key}} </h3>
									<div class="gradosCalificaciones-grid">
										@foreach ($courses as $course)
											<div class="gradosCalificaciones-item">
												<div class="gradosCalificaciones-curso">
													<a href="{{ route('horario_Curso', ['idCurso' => $course->id, 'parcial' => 'clases']) }}">
														<img src="img/iconCalificaciones.svg" alt="" width="20">
														{{ $course->grado }} {{ $course->paralelo }}
													</a>
												</div>
												<div>
													<a target="_blank" href="{{route('descargarDeHorarioEscolar', $course->id)}}" class="color-inherit">
														<img src="{{secure_asset('img/file-download.svg')}}" alt="" width="20">
													</a>
												</div>
											</div>
										@endforeach
									</div>
								</div>
							@endforeach
							 @foreach ($primary->groupBy('grado') as $key => $courses)
                                    <div class="typeOfCourse">
                                        <h3 class="a-btn__cursos">{{$key}}</h3>
                                        <div class="gradosCalificaciones-grid">
                                           @foreach ($courses as $course)
											<div class="gradosCalificaciones-item">
												<div class="gradosCalificaciones-curso">
													<a href="{{ route('horario_Curso', ['idCurso' => $course->id, 'parcial' => 'clases']) }}">
														<img src="img/iconCalificaciones.svg" alt="" width="20">
														{{ $course->grado }} {{ $course->paralelo }}
													</a>
												</div>
												<div>
													<a target="_blank" href="{{route('descargarDeHorarioEscolar', $course->id)}}" class="color-inherit">
														<img src="{{secure_asset('img/file-download.svg')}}" alt="" width="20">
													</a>
												</div>
											</div>
										@endforeach
                                        </div>
                                    </div>
                                @endforeach
							@endif
                        </div>
                        <div id="tab-2" class="tab-pane active">
                        	@if ($user_profile->type_of_supervisor == null || $user_profile->type_of_supervisor == 'basica_elemental_y_media')
							@foreach($coursesEGB->groupBy('grado') as $key => $courses)
								<div class="typeOfCourse">
									<h3 class="a-btn__cursos"> {{$key}} </h3>
									<div class="gradosCalificaciones-grid">
										@foreach ($courses as $course)
											<div class="gradosCalificaciones-item">
												<div class="gradosCalificaciones-curso">
													<a href="{{ route('horario_Curso', ['idCurso' => $course->id, 'parcial' => 'clases']) }}">
														<img src="img/iconCalificaciones.svg" alt="" width="20">
														{{ $course->grado }} {{ $course->paralelo }}
													</a>
												</div>
												<div>
													<a target="_blank" href="{{route('descargarDeHorarioEscolar', $course->id)}}" class="color-inherit">
														<img src="{{secure_asset('img/file-download.svg')}}" alt="" width="20">
													</a>
												</div>
											</div>
										@endforeach
									</div>
								</div>
							@endforeach
							@elseif($user_profile->type_of_supervisor == null || $user_profile->type_of_supervisor == 'basica_superior_y_bachillerato')
							@foreach($coursesEGB->groupBy('grado') as $key => $courses)
								<div class="typeOfCourse">
									<h3 class="a-btn__cursos"> {{$key}} </h3>
									<div class="gradosCalificaciones-grid">
										@foreach ($courses as $course)
										@if($course->grado=='Octavo' || $course->grado=='Noveno' || $course->grado=='Decimo')
											<div class="gradosCalificaciones-item">
												<div class="gradosCalificaciones-curso">
													<a href="{{ route('horario_Curso', ['idCurso' => $course->id, 'parcial' => 'clases']) }}">
														<img src="img/iconCalificaciones.svg" alt="" width="20">
														{{ $course->grado }} {{ $course->paralelo }}
													</a>
												</div>
												<div>
													<a target="_blank" href="{{route('descargarDeHorarioEscolar', $course->id)}}" class="color-inherit">
														<img src="{{secure_asset('img/file-download.svg')}}" alt="" width="20">
													</a>
												</div>
											</div>
											@endif
										@endforeach
									</div>
								</div>
							@endforeach
							@endif
                        </div>
                        <div id="tab-3" class="tab-pane">
                        	 @if ($user_profile->type_of_supervisor == null || $user_profile->type_of_supervisor == 'basica_superior_y_bachillerato')
							@foreach($coursesBGU->groupBy('grado') as $key => $courses)
								<div class="typeOfCourse">
									<h3 class="a-btn__cursos"> {{$key}} </h3>
									<div class="gradosCalificaciones-grid">
										@foreach ($courses as $course)
											<div class="gradosCalificaciones-item">
												<div class="gradosCalificaciones-curso">
													<a href="{{ route('horario_Curso', ['idCurso' => $course->id, 'parcial' => 'clases']) }}">
														<img src="img/iconCalificaciones.svg" alt="" width="20">
														{{ $course->grado }} {{ $course->paralelo }}
													</a>
												</div>
												<div>
													<a target="_blank" href="{{route('descargarDeHorarioEscolar', $course->id)}}" class="color-inherit">
														<img src="{{secure_asset('img/file-download.svg')}}" alt="" width="20">
													</a>
												</div>
											</div>
										@endforeach
									</div>
								</div>
							@endforeach
							@endif
                        </div>
                    </div>
                </div>
	            @else

            		<h3 class="a-btn__cursos">
						<span class="etiquetaLetra">Secundaria</span>
					</h3>
					<div class="card-asistencia">
						@foreach($coursesEGB as $course)
							@if($course->grado=='Octavo')
								<div class="lista_alumnos">
									<article class="dirInformacion__cursos--item">
										<div class="dirInformacion__cursos--info">
											<h3>
												<a href="{{ route('horario_Curso', ['idCurso' => $course->id, 'parcial' => 'clases']) }}">
													Secundaria {{$course->paralelo}}
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
												<a href="{{ route('horario_Curso', ['idCurso' => $course->id, 'parcial' => 'clases']) }}">
													{{$course->grado}} {{$course->paralelo}} {{$course->especializacion}}
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
@endsection

