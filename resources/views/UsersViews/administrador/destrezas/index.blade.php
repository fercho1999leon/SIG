@extends('layouts.master') 
@section('content')
@include('partials.loader.loader')
<div id="page-wrapper" class="gray-bg dashbard-1">
    @include('layouts.nav_bar_top')
    <div class="row wrapper white-bg ">
        <div class="col-lg-12 titulo-separacion">
            <h2 class="title-page">Grados
                <small> Destrezas</small>
            </h2>
        </div>
    </div>
    <div class="row mt-1 mb350">
        <div class="col-lg-12">
            <div class="tabs-container">
                <ul class="nav nav-tabs">
                    <li>
                        <a data-toggle="tab" href="#tab-1">Educación Inicial</a>
                    </li>
                    <li class="active">
                        <a data-toggle="tab" href="#tab-2">Educación General Básica</a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div id="tab-1" class="tab-pane">
                        <div class=" bg-none">
                            <div class="typeOfCourse">
								@foreach($coursesEI->groupBy('grado') as $key => $courses)
                                <h3 class="a-btn__cursos">{{$key}}</h3>
                                <div class="gradosCalificaciones-grid">
                                    @foreach($courses as $course)
                                        <div class="gradosCalificaciones-item">
                                            <div class="gradosCalificaciones-curso">
                                                <a href="{{ route('destrezasAdminCurso', $course->id)}}">
                                                    <img src="{{secure_asset('img/iconCalificaciones.svg')}}" class="mr-05" width="20" alt=""> 
                                                    <p class="d-ib mb-0">
                                                        {{ $course->grado }} {{ $course->paralelo }}
                                                    </p>
                                                </a>
                                            </div>
                                        </div>
                                    @endforeach
								</div>
								@endforeach
                            </div>
                        </div>
                    </div>
                    <div id="tab-2" class="tab-pane active">
                        <div class=" bg-none">
                            <div class="typeOfCourse">
                                <h3 class="a-btn__cursos">PRIMERO</h3>
                                <div class="gradosCalificaciones-grid">
                                    @foreach($coursesPrimaria as $course)
                                        <div class="gradosCalificaciones-item">
                                            <div class="gradosCalificaciones-curso">
                                                <a href="{{ route('destrezasAdminCurso', $course->id)}}">
                                                    <img src="{{secure_asset('img/iconCalificaciones.svg')}}" class="mr-05" width="20" alt="">
                                                    <p class="d-ib mb-0">
                                                        {{ $course->grado }} {{ $course->paralelo }}
                                                    </p>
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
</div>
@endsection