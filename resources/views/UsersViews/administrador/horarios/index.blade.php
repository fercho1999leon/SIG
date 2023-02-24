@extends('layouts.master')
@section('content')
@include('partials.loader.loader')
@php
use App\Permiso;
$permiso = Permiso::desbloqueo('horario_Escolar');
@endphp
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
                        <li class="active">
                            <a data-toggle="tab" href="#tab-2">Horario de Clases</a>
                        </li>                        
                    </ul>
                    <div class="tab-content">            
                        <div id="tab-2" class="tab-pane active">
							@foreach($courses->groupBy('grado') as $key => $coursesG)
								<div class="typeOfCourse">
									<h3 class="a-btn__cursos"> {{$key}} </h3>
									<div class="gradosCalificaciones-grid">
										@foreach ($coursesG as $course)
											<div class="gradosCalificaciones-item">
												<div class="gradosCalificaciones-curso">
													<a href="{{ route('horario_Curso', ['idCurso' => $course->id, 'parcial' => 'clases']) }}">
														<img src="img/iconCalificaciones.svg" alt="" width="20">
														{{ $course->grado }} {{ $course->paralelo }}
													</a>
												</div>
												<div>@if($permiso ==null || ($permiso != null && $permiso->imprimir == 1))
													<a target="_blank" href="{{route('descargarDeHorarioEscolar', $course->id)}}" class="color-inherit">
														<img src="{{secure_asset('img/file-download.svg')}}" alt="" width="20">
													</a>
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
						<span class="etiquetaLetra">Secundaria</span>
					</h3>
					<div class="card-asistencia">
						@foreach($courses as $courseG)
							@if($courseG->grado=='Octavo')
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
            	@endif
            </div>
        </div>
    </div>
@endsection

