@extends('layouts.master') 
@section('content')
@include('partials.loader.loader')
<div id="page-wrapper" class="gray-bg dashbard-1">
    @include('barra.administrador')
    <div class="row wrapper white-bg titulo-separacion noBefore">
        <div class="col-xs-12 titulo-separacion">
            <h2 class="title-page">Reporte Por Estudiantes</h2>
        </div>
    </div>
    <div class="row mt-1 mb350">
        <div class="col-lg-12">
            <div class="tabs-container">
                <ul class="nav nav-tabs">               
                    <li class="active">
                        <a data-toggle="tab" href="#tab-2">Semestre</a>
                    </li>                    
                </ul>
                <div class="tab-content">                 
                    <div id="tab-2" class="tab-pane active">
                        <div class="bg-none">
								<div class="typeOfCourse">
									<div class="gradosCalificaciones-grid">
										@foreach($courses as $course)
											<div class="gradosCalificaciones-item reporteCurso-item">
												<div class="gradosCalificaciones-curso">
													<a href="{{ route('reporteEstudiantesCurso',['id' => $course->id, 'parcial' => 'p1q1'])}}">
														<img src="{{secure_asset('img/iconCalificaciones.svg')}}" class="mr-05" width="20" alt=""> {{ $course->grado }} {{ $course->paralelo }}
                                                    </a>
                                                    <a href="{{ route('cerMatriculaCurso', ['idCurso' => $course->id]) }}" class="rep reportePorEstudiante__download-icon">
                                                        <i class="fa fa-download"></i>
                                                    </a>
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
</div>
@endsection
@section('scripts')
<script>
$('#mySelect').change(function () {    
    window.location.href = "{{ route('reportePorEstudiantesRuta') }}/" +  $('#mySelect').val();
});
</script>
@endsection