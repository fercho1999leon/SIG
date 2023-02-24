@extends('layouts.master')
@section('content')
    @include('partials.loader.loader')
    @php
    use App\Course;
    $unidad = App\UnidadPeriodica::unidadP();
    @endphp
    <div id="page-wrapper" class="gray-bg dashbard-1">
        <!-- Incluir el nav_bar_top Cerrar Sesion -->
        @include('layouts.nav_bar_top')
        <div class="row wrapper white-bg ">
            <div class="col-xs-12 seleccion-curso">
                <div class="flex flex-col items-center w-full md:flex-row md:justify-between">
                    <h2 class="title-page">CALIFICACIONES</h2>
                </div>
            </div>
        </div>
        <div class="wrapper wrapper-content">
            <div class="row">
                @foreach ($materias as $key => $item)
                    <h3 class="a-btn__cursos"> {{ $key }} </h3>
                    <div class="a-matricula__estudiantes">
                        @foreach ($item as $materia)
                            <div class=" bg-white text-center">
                                <i class="p-1 text-black fa fa-university fa-4x" aria-hidden="true"></i>
                                <h3 class="h3 text-uppercase text-black">
                                    <a
                                        href="{{ route('MateriasDocente', ['idMateria' => $materia->id, 'parcial' => 'p1q1']) }}">
                                        {{ $materia->nombre }}</a>
                                </h3>
                                <a class="btn btn-primary text-white mb-3"
                                    href="{{ route('reporteActaCalificacion', $materia->id) }}">
                                    Acta de Calificaciones
                                </a>
                                <a class="btn btn-success text-white mb-3"
                                    href="{{ route('actaGlobal', $materia->id) }}">
                                    Acta Global de Calificaciones
                                </a>
                            </div>
                        @endforeach
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
