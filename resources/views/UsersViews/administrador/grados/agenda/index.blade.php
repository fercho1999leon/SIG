@extends('layouts.master')
@section('content')
@include('partials.loader.loader')
    <div id="page-wrapper" class="gray-bg dashbard-1">
        @include('layouts.nav_bar_top')
        <div class="row wrapper white-bg " >
            <div class="col-lg-12 titulo-separacion">
                <h2 class="title-page">Agenda Escolar</h2>
            </div>
		</div>
        <div class="row mt-1 mb350">
            <div class="col-lg-12">
            	@if($regimen=='Regular')
                <div class="tabs-container">
                    <ul class="nav nav-tabs">                    
                        <li class="active">
                            <a data-toggle="tab" href="#tab-3">Listado</a>
                        </li>
                    </ul>
                    <div class="tab-content">                        
                        <div id="tab-3" class="tab-pane active">
                        	@if ($user_profile->type_of_supervisor == null || $user_profile->type_of_supervisor == 'basica_superior_y_bachillerato')
							@foreach ($courses->groupBy('grado') as $key => $courses)
								<div class="typeOfCourse">
									<h3 class="a-btn__cursos"> {{$key}} </h3>
									<div class="gradosCalificaciones-grid">
										@foreach($courses as $course)
											<div class="gradosCalificaciones-item">
												<div class="gradosCalificaciones-curso">
													<a href="{{ route('ver_CursoAgenda',['id' => $course->id, 'fecha='.$fechaActual->format('Y-m-d')])}}">
														<img src="{{secure_asset('img/iconCalificaciones.svg')}}" class="mr-05" width="20" alt=""> {{ $course->grado }} {{$course->especializacion}} {{ $course->paralelo }}
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
						<span class="etiquetaLetra"> Secundaria </span>
					</h3>
					<div class="card-asistencia">
						@foreach($coursesEGB as $course)
							@if($course->grado=='Octavo')
								<div class="lista_alumnos">
									<article class="dirInformacion__cursos--item">
										<div class="dirInformacion__cursos--info">
											<h3>
												<a href="{{ route('ver_CursoAgenda',['id' => $course->id, 'fecha='.$fechaActual->format('Y-m-d')])}}">
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
						<span class="etiquetaLetra"> Bachillerato </span>
					</h3>
					<div class="card-asistencia">
						@foreach($courses as $course)
							<div class="lista_alumnos">
								<article class="dirInformacion__cursos--item">
									<div class="dirInformacion__cursos--info">
										<h3>
											<a href="{{ route('ver_CursoAgenda',['id' => $course->id, 'fecha='.$fechaActual->format('Y-m-d')])}}">
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
@endsection

