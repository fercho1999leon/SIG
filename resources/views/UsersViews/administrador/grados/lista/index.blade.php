@extends('layouts.master')
@section('content')
@include('partials.loader.loader')
    <div id="page-wrapper" class="gray-bg dashbard-1">
        @include('layouts.nav_bar_top')
        <div class="row wrapper white-bg ">
            <div class="col-lg-12 titulo-separacion">
                <h2 class="title-page">Grados
                    <small>Lista</small>
				</h2>
				<div class="title__seccionButtons">
					<a target="_blank" href="{{route('reporteEstudiantesPorGenero')}}" class="title-page btn btn-primary mr-1">
						<img class="mr-05" src="{{secure_asset('img/file-download-white.svg')}}" width="12">
						Estudiantes por genero</a>
			
				</div>
            </div>
        </div>
		<div class="row mt-1 mb350">
			<div class="col-lg-12">
				@if($regimen=='Regular')
				<div class="tabs-container">
					<ul class="nav nav-tabs">
					
						<li class="active">
							<a data-toggle="tab" href="#tab-2">Grados</a>
						</li>					
					</ul>
					<div class="tab-content">				
						<div id="tab-2" class="tab-pane active">
							<div class=" bg-none">
								@foreach ($courses->groupBy('grado') as $key => $coursesG)
									<div class="typeOfCourse">
										<h3 class="a-btn__cursos">{{$key}}</h3>
										<div class="gradosCalificaciones-grid">
											@foreach ($coursesG as $course)
												<div class="gradosCalificaciones-item">
													<div class="gradosCalificaciones-curso">
														<p class="m-0">
															<img src="{{secure_asset('img/iconCalificaciones.svg')}}" class="mr-05" width="20" alt=""> 
															{{$course->grado}} {{$course->especializacion}} {{$course->paralelo}}
														</p>
													</div>
													<div> 
														<a href="{{route('reporteEstudiantesPorGeneroCurso', $course->id)}}" class="pinedTooltip mr-05" target="_blank">
															<img src="{{secure_asset('img/file-download.svg')}}" width="17" alt="">
															<span class="pinedTooltipH">Estudiantes por Genero</span>
														</a>													
														<a href="{{route('gradoLista-dowload', $course->id)}}" class="pinedTooltip mr-05" target="_blank">
															<img src="{{secure_asset('img/file-download.svg')}}" width="17" alt="">
															<span class="pinedTooltipH">Lista de Estudiantes</span>
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
						@foreach($courses as $courseG)
							@if($courseG->grado=='Octavo')
								<div class="lista_alumnos">
									<article class="dirInformacion__cursos--item">
										<div class="dirInformacion__cursos--info">
											<h3>
												Secundaria {{$course->paralelo}} 
												<a href="{{route('reporteEstudiantesPorGeneroCurso', $course->id)}}" class="pinedTooltip mr-05" target="_blank">
													<img src="{{secure_asset('img/file-download.svg')}}" width="17" alt="">
													<span class="pinedTooltipH">Estudiantes por Genero</span>
												</a>
												<a href="{{route('reporteEstudiantesYRepresentantesCurso', $course->id)}}" class="pinedTooltip mr-05" target="_blank">
													<img src="{{secure_asset('img/file-download.svg')}}" width="17" alt="">
													<span class="pinedTooltipH">Estudiantes y Representantes</span>
												</a>
												<a href="{{route('gradoLista-dowload', $course->id)}}" class="pinedTooltip mr-05" target="_blank">
													<img src="{{secure_asset('img/file-download.svg')}}" width="17" alt="">
													<span class="pinedTooltipH">Lista de Estudiantes</span>
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

