@extends('layouts.master')

@php
use App\Http\Controllers\SyllabusController;
use App\User;
@endphp

@section('css')
<link href="{{ secure_asset('css/syllabus/syllabus.css') }}" rel="stylesheet">

@endsection
@section('content')
<div id="page-wrapper" class="gray-bg dashbard-1">
    <!-- Incluir el nav_bar_top Cerrar Sesion -->
    @include('layouts.nav_bar_top')

    <div class="row wrapper white-bg ">
        <div class="col-xs-12 seleccion-curso">
            <h2 class="title-page">SYLLABUS</h2>
        </div>
    </div>
    <div class="wrapper wrapper-content">

        <form action="">
            <div class="row">
                @foreach ($materias as $key => $item)
                <h3 class="a-btn__cursos">{{ $key }}</h3>
                <div class="a-matricula__estudiantes">
                    @foreach ($item as $materia)
                    @if ($materia->estado == 1 && $materia->idCurso != null)
                    <div class="bg-white text-center">
                        <i class="p-1 text-black fa fa-university fa-4x" aria-hidden="true"></i>
                        <h3 class="h3 text-uppercase text-black">
                            {{ $materia->nombre }}
                        </h3>
                        @if (SyllabusController::getSyllabusBoolByMatter($materia->id) != true)
                        <div class="btn-group">
                            <a class="btn btn-primary text-white mb-3" type="submit"
                                href="{{ route('crearSyllabus', $materia->id) }}">
                                Crear
                            </a>
                        </div>
                        @else
                        @php
                        $syllabus = SyllabusController::getSyllabusByMatter($materia->id);
                        @endphp
                        <div class="btn-group">
                            <a class="btn btn-primary text-white mb-3"
                                href="{{ route('reporteSyllabus', $materia->id) }}" target="_blank">
                                Generar
                            </a>
                            <a class="btn btn-success text-white mb-3"
                                href="{{ route('modificarSyllabus', $syllabus->id) }}">
                                Modificar
                            </a>
                            <a class="btn btn-danger text-white mb-3 autorizar"
                                href="{{ route('eliminarSyllabus', $materia->id) }}">
                                Eliminar
                            </a>
                        </div>
                        @endif
                    </div>
                    @endif
                    @endforeach
                </div>
                @endforeach
            </div>
        </form>
    </div>
</div>
@endsection

@section('scripts')
<script>
    $(".autorizar").click(function(event) {
            var bool = (confirm("¿Está seguro que desea ELIMINAR el Syllabus?"))
            if (bool != true) {
                event.preventDefault();
            }
        });
</script>

@endsection