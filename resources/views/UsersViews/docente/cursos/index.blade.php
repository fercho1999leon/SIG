@extends('layouts.master')
@section('content')
    @php
    use App\Course;
    //dd($materias);
    @endphp
    <div id="page-wrapper" class="gray-bg dashbard-1">
        <!-- Incluir el nav_bar_top Cerrar Sesion -->
        @include('layouts.nav_bar_top')

        <div class="row wrapper white-bg ">
            <div class="col-xs-12 seleccion-curso">
                <h2 class="title-page">CURSOS</h2>
            </div>
        </div>
        <div class="wrapper wrapper-content">
            <div class="row">
                
                @foreach ($materias as $key => $item)
                    <h3 class="a-btn__cursos">{{ $key }}</h3>
                    <div class="a-matricula__estudiantes">
                        @foreach ($item as $materia)
                            <?php $course = Course::getCoursesByCourse($materia->idCurso);?>
                            @if ($materia->estado != 0 && $course)
                                <div class="bg-white text-center">
                                    <i class="p-1 text-black fa fa-university fa-4x" aria-hidden="true"></i>
                                    <h3 class="h3 text-uppercase text-black">
                                        <a href="{{ route('cursos_Docente', $materia->id) }}">
                                            {{ $materia->nombre }}
                                        </a>
                                    </h3>
                                    <p>
                                         Paralelo: {{ $course->paralelo}}
                                    </p>
                                </div>
                            @endif
                        @endforeach
                    </div>
                @endforeach
            </div>
        </div>


    </div>
@endsection
