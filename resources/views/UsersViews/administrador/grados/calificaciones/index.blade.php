@extends('layouts.master')
@section('content')
@include('partials.loader.loader')
<div id="page-wrapper" class="gray-bg dashbard-1">
    @include('layouts.nav_bar_top')
    <div class="row wrapper white-bg ">
        <div class="col-lg-12 titulo-separacion">
            <h2 class="title-page">Carrera
                <small> Calificaciones</small>
            </h2>
        </div>
    </div>
    <div class="row mt-1 mb350">
        <div class="col-lg-12">
            <div class="tabs-container">
                <ul class="nav nav-tabs">                   
                    <li class="active">
                        <a data-toggle="tab" href="#tab-2">Calificaciones</a>
                    </li>              
                </ul>
                <div class="tab-content">                   
                    <div id="tab-2" class="tab-pane active">
                        <div class=" bg-none">
                            @if ($user_profile->type_of_supervisor == null || $user_profile->type_of_supervisor == 'basica_elemental_y_media')
                                @foreach ($courses->groupBy('grado') as $grado => $coursesG)
                                    <div class="typeOfCourse">
                                        <h3 class="a-btn__cursos">{{$grado}}</h3>
                                        <div class="gradosCalificaciones-grid">
                                            @foreach($coursesG as $course)
                                                <div class="gradosCalificaciones-item">
                                                    <div class="gradosCalificaciones-curso">
                                                    <!--{{$course->id}}
                                                    {{$course->id_career}}-->
                                                        <!--<a href="{{ route('grade_score_course', ['id' => $course->id, 'parcial' => 'p1q1'] )}}">-->
                                                        <a href="{{ route('grade_score_course', ['id' => $course->id, 'parcial' => ($parcial->first())->identificador] )}}">
                                                            <img src="{{secure_asset('img/iconCalificaciones.svg')}}" class="mr-05" width="20" alt=""> {{ $course->grado }} &nbsp {{ $course->paralelo }} 
                                                        </a>
                                                    </div>
                                                    @php
                                                        $rutaDescarga ='/curso_'.$course->id;
                                                        @endphp
                                                        <form action="{{route('descargarAdjuntos')}}" method="POST">
                                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                        <input name="rutaDescarga" type="hidden" value="{{$rutaDescarga}}">
                                                        <input name="nombreDescarga" type="hidden" value="{{ $course->grado }} ">
                                                        <button type="submit" style="background: none; font-size: 15px; border: none;"><i class="fa fa-download icon__enviar-mensaje" title="Descargar deberes adjuntos"></i></button>
                                                        </form>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                @endforeach
                                @elseif($user_profile->type_of_supervisor == null || $user_profile->type_of_supervisor == 'basica_superior_y_bachillerato')
                                 @foreach ($courses->groupBy('grado') as $grado => $coursesG)
                                    
                                @endforeach
                            @endif
                        </div>
                    </div>                    
                </div>
            </div>
        </div>
    </div>
</div>
</div>
@endsection