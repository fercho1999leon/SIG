@extends('layouts.master')
@section('content')
@include('partials.loader.loader')
    <div id="page-wrapper" class="gray-bg dashbard-1">
        @include('layouts.nav_bar_top')
        <div class="row wrapper white-bg ">
            <div class="col-lg-12 titulo-separacion">
                <h2 class="title-page">Carreras
                    <small> Asistencia Estudiantil</small>
                </h2>
            </div>
        </div>
		@if (count($errors) > 0)
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $message)
                    <li>{{ $message }}</li>
                @endforeach
            </ul>
        </div>
		@endif
		@if(Session::has('message'))
			<p class="alert alert-success">{{ Session::get('message') }}</p>
		@endif
		@if(Session::has('warning'))
			<p class="alert alert-danger">{{ Session::get('warning') }}</p>
		@endif
        <div class="row mt-1 mb350">
            <div class="col-lg-12">
            		<div class="tabs-container">
					<ul class="nav nav-tabs">
						<li>
							<a data-toggle="active" href="#tab-1">Asistencia</a>
						</li>	                      
					</ul>
					<div class="tab-content">	                      
						<div id="tab-1" class="tab-pane active">
							<div class=" bg-none">
								@foreach ($courses->groupBy('grado') as $key => $coursesG)
									<div class="typeOfCourse">
										<h3 class="a-btn__cursos">{{$key}}</h3>
										<div class="gradosCalificaciones-grid">
											@foreach ($coursesG as $course)
												<div class="gradosCalificaciones-item">
													<div class="gradosCalificaciones-curso">
														<a href="{{ route('asistenciaReporteCurso', [$course, 'p1q1']) }}">
															<img src="{{secure_asset('img/asistencia/asistencia_azul.svg')}}" width="25" alt="">
															{{$course->grado}} {{$course->especializacion}} {{$course->paralelo}}
														</a>
													</div>
													<a target="_blank" href="{{route('reporteAsistenciaCursoAnual', $course)}}">
														<img src="{{secure_asset('img/file-download.svg')}}" width="17">
													</a>
												</div>
											@endforeach
										</div>
									</div>
								@endforeach
							</div>
						</div>	                       
					</div>
				</div>  
            </div>
        </div>
    </div>
</div>
@endsection