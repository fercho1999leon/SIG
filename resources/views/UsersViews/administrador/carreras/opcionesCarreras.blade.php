@extends('layouts.master') 
@section('content')
@include('partials.loader.loader')
@php 
    use App\ConfiguracionSistema;
    //dd(ConfiguracionSistema::editaCalificaciones());
@endphp
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
									<h3 class="a-btn__cursos"></h3>
									<div class="gradosCalificaciones-grid">
											{{--<div class="gradosCalificaciones-item reporteCurso-item">
												<div class="gradosCalificaciones-curso" width="50px" >
													<a href="{{ route('grade_agenda_carrera',$idcarrera)}}">
                                                        <img src="{{secure_asset('img/iconCalificaciones.svg')}}" class="mr-05" width="20" alt=""> 
                                                        Agenda
                                                    </a>
                                                    <a href="{{ route('grade_agenda_carrera', $idcarrera) }}" class="rep reportePorEstudiante__download-icon">
                                                    </a>
                                                </div>
											</div>--}}
                                            {{--<div class="gradosCalificaciones-item reporteCurso-item">
												<div class="gradosCalificaciones-curso" width="50px" >
													<a href="{{ route('asistencia')}}">
                                                        <img src="{{secure_asset('img/iconCalificaciones.svg')}}" class="mr-05" width="20" alt=""> 
                                                        Asistencia Parcial
                                                    </a>
                                                    <a href="{{ route('asistencia') }}" class="rep reportePorEstudiante__download-icon">
                                                    </a>
                                                </div>
											</div>--}}
                                            <div class="gradosCalificaciones-item reporteCurso-item">
												<div class="gradosCalificaciones-curso" width="50px" >
													<a href="{{ route('admin.asistenciaMateria.index')}}">
                                                        <img src="{{secure_asset('img/iconCalificaciones.svg')}}" class="mr-05" width="20" alt=""> 
                                                        Asistencia Diaria
                                                    </a>
                                                    <a href="{{ route('admin.asistenciaMateria.index') }}" class="rep reportePorEstudiante__download-icon">
                                                    </a>
                                                </div>
											</div>
                                            @if((ConfiguracionSistema::editaCalificaciones())->valor == 1)
                                            <div class="gradosCalificaciones-item reporteCurso-item">
												<div class="gradosCalificaciones-curso" width="50px" >
													<a href="{{ route('grade_score')}}">
                                                        <img src="{{secure_asset('img/iconCalificaciones.svg')}}" class="mr-05" width="20" alt=""> 
                                                        Calificaciones
                                                    </a>
                                                    <a href="{{ route('grade_score') }}" class="rep reportePorEstudiante__download-icon">
                                                    </a>
                                                </div>
											</div>
                                            @endif
                                            <div class="gradosCalificaciones-item reporteCurso-item">
												<div class="gradosCalificaciones-curso" width="50px" >
													<a href="{{ route('grade_lista')}}">
                                                        <img src="{{secure_asset('img/iconCalificaciones.svg')}}" class="mr-05" width="20" alt=""> 
                                                        Listado Estudiantes
                                                    </a>
                                                    <a href="{{ route('grade_lista') }}" class="rep reportePorEstudiante__download-icon">
                                                    </a>
                                                </div>
											</div>
                                            {{--<div class="gradosCalificaciones-item reporteCurso-item">
												<div class="gradosCalificaciones-curso" width="50px" >
													<a href="{{ route('horario_Escolar')}}">
                                                        <img src="{{secure_asset('img/iconCalificaciones.svg')}}" class="mr-05" width="20" alt=""> 
                                                        Horarios
                                                    </a>
                                                    <a href="{{ route('horario_Escolar') }}" class="rep reportePorEstudiante__download-icon">
                                                    </a>
                                                </div>
											</div>--}}                                     
                                            {{--
                                                <div class="gradosCalificaciones-item reporteCurso-item">
                                                    <div class="gradosCalificaciones-curso" width="50px" >
                                                        <a href="{{ route('syllabus')}}">
                                                            <img src="{{secure_asset('img/iconCalificaciones.svg')}}" class="mr-05" width="20" alt=""> 
                                                            Syllabus
                                                        </a>
                                                        <a href="{{ route('horario_Escolar') }}" class="rep reportePorEstudiante__download-icon">
                                                        </a>
                                                    </div>
                                                </div>
                                            --}}
                                                
                                            <div class="gradosCalificaciones-item reporteCurso-item">
												<div class="gradosCalificaciones-curso" width="50px" >
													<a href="{{ route('indexPeaDocenteView')}}">
                                                        <img src="{{secure_asset('img/iconCalificaciones.svg')}}" class="mr-05" width="20" alt=""> 
                                                        PEAs
                                                    </a>
                                                    <a href="{{ route('indexPeaDocenteView') }}" class="rep reportePorEstudiante__download-icon">
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