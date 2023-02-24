@extends('layouts.master') 
@section('content')
@include('partials.loader.loader')
<div id="page-wrapper" class="gray-bg dashbard-1">
    @include('barra.administrador')
    <div class="row wrapper white-bg titulo-separacion noBefore">
        <div class="col-xs-12 titulo-separacion">
            <h2 class="title-page">Opciones Semestre</h2>
        </div>
    </div>
    <div class="row mt-1 mb350">
        <div class="col-lg-12">
            <div class="tabs-container">
                <ul class="nav nav-tabs">
                    <!--<li>
                        <a data-toggle="tab" href="#tab-1">Derecho</a>
                    </li> -->                    
                </ul>
                <div class="tab-content">
                    <div id="tab-1" class="tab-pane active">
                        <div class=" bg-none">
								<div class="typeOfCourse">
									<h3 class="a-btn__cursos">                                       
                                    </h3>
									<div class="gradosCalificaciones-grid">
                                        <div class="gradosCalificaciones-item reporteCurso-item">
                                            <div class="gradosCalificaciones-curso" width="50px" >
                                                <a href="{{route('reportePorCurso',[$idcarrera])}}">
                                                    <img src="{{secure_asset('img/iconCalificaciones.svg')}}" class="mr-05" width="20" alt=""> 
                                                    Reporte por Curso
                                                </a>
                                                {{--<a href="{{route('reportePorCurso',[$idcarrera])}}" class="rep reportePorEstudiante__download-icon">
                                                </a>--}}
                                            </div>
                                        </div>
                                        {{--<div class="gradosCalificaciones-item reporteCurso-item">
                                            <div class="gradosCalificaciones-curso" width="50px" >
                                                <a href="{{ route('asistencia')}}">
                                                    
                                                </a>
                                                <a href="{{route('reportePorCurso',[$idcarrera])}}" class="rep reportePorEstudiante__download-icon">
                                                    <img src="{{url('/reportePorDocente/p1q1')}}" class="mr-05" width="20" alt=""> 
                                                    Reporte por Docentes
                                                </a>
                                            </div>
                                        </div>--}}
                                        <div class="gradosCalificaciones-item reporteCurso-item">
                                            <div class="gradosCalificaciones-curso" width="50px" >
                                                <a href="{{route('reportePorEstudiantes',[$idcarrera])}}">
                                                    <img src="{{secure_asset('img/iconCalificaciones.svg')}}" class="mr-05" width="20" alt=""> 
                                                    Reporte por Estudiantes
                                                </a>
                                                <a href="{{url('/reportePorEstudiantes/$idcarrera')}}" class="rep reportePorEstudiante__download-icon">
                                                </a>
                                            </div>
                                        </div>                                     
                                            
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