@extends('layouts.master')
@section('content')
@include('partials.loader.loader')
    <div id="page-wrapper" class="gray-bg dashbard-1">
        @include('layouts.nav_bar_top')
        <div class="row wrapper white-bg ">
            <div class="col-lg-12 titulo-separacion">
                <h2 class="title-page">Grados
                    <small> Asistencia Diaria Estudiantes</small>
                </h2>
            </div>
        </div>
        <div class="row mt-1 mb350">
            <div class="col-lg-12">
            	@if($regimen=='Regular')
            		<div class="tabs-container">
	                    <ul class="nav nav-tabs">	                    
	                        <li class="active">
	                            <a data-toggle="tab" href="#tab-2">Asistencia Diaria Estudiantes</a>
	                        </li>	                        
	                    </ul>
	                    <div class="tab-content">	                        
	                        <div id="tab-2" class="tab-pane active">
								<div class=" bg-none">
									@if ($user_profile->type_of_supervisor == null || $user_profile->type_of_supervisor == 'basica_elemental_y_media')
									@foreach ($courses as $course)
										@foreach ($coursesandmetters as $coursedocente)
										@if ($coursedocente->idCourse == $course->id)
											<div class="typeOfCourse">
												<h3 class="a-btn__cursos">{{$course->paralelo}}</h3>
												<div class="gradosCalificaciones-grid">
													<div class="gradosCalificaciones-item">
														<div class="gradosCalificaciones-curso">
															<a href="{{route('admin.asistenciaMateria', $course)}}">
																<img src="{{secure_asset('img/asistencia/asistencia_azul.svg')}}" width="25" alt="">
																{{$course->grado}} {{$course->especializacion}} {{$course->paralelo}}
															</a>
														</div>
													</div>
												</div>
											</div>
										@endif
										@endforeach
									@endforeach
									 @elseif($user_profile->type_of_supervisor == null || $user_profile->type_of_supervisor == 'basica_superior_y_bachillerato')
									 @foreach ($courses->groupBy('paralelo') as $key => $coursesG)
										<div class="typeOfCourse">
											<h3 class="a-btn__cursos">{{$key}}</h3>
											<div class="gradosCalificaciones-grid">
												@foreach ($coursesG as $course)
												 @if($course->grado=='Octavo' || $course->grado=='Noveno' || $course->grado=='Decimo')
													<div class="gradosCalificaciones-item">
														<div class="gradosCalificaciones-curso">
															<a href="{{route('admin.asistenciaMateria', $course)}}">
																<img src="{{secure_asset('img/asistencia/asistencia_azul.svg')}}" width="25" alt="">
																{{$course->grado}} {{$course->especializacion}} {{$course->paralelo}}
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
	                        </div>	                        
	                    </div>
	                </div>            	
                @endif
            </div>
        </div>
    </div>
</div>
@endsection