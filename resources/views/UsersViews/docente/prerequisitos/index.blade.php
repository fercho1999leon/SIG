@extends('layouts.master')

@php
use App\Http\Controllers\SyllabusController;
use App\User;
use App\TituloGrado;
use App\Matter;
use App\Course;
use App\Career;

@endphp

@section('css')
    <link href="{{ secure_asset('css/syllabus/syllabus.css') }}" rel="stylesheet">
@endsection
@section('content')
    <div id="page-wrapper" class="gray-bg dashbard-4">
        <!--CABECERA INICIAL-->
        @include('partials.encabezados.syllabus.syllabus_cabecera')
        <div class="container-sm mt-2 bg-white text-left rounded">
            <div class="row text-center p-1">
                <img class="rounded mx-auto" src="{{ secure_asset('img/diario escolar.png') }}" alt="N/A" width="140px" />
                <h3 class="h3 text-uppercase text-black text-center">
                    PREREQUISITOS Y CORREQUISITOS
                </h3>
                <hr class="hr">
            </div>
            <form action="{{ route('storePrerequisitosSyllabus', $syllabus->id) }}" method="POST">
                {{ csrf_field() }}
                <div class="row">
                    <div class="col-sm-6">
                        <div class="row p-1">
                            <h3 class="h3 text-uppercase text-black text-center">
                                PREREQUISITOS
                            </h3>
                        </div>
                        <div class="row p-1">
                            @php
                                $curso_id = Matter::getCourse($syllabus->materia_id);
                                $materias = Matter::getMattersAllByCourse($curso_id)->where('estado', '1');
                            @endphp
                            <div class="col-sm-6 form-group">
                                <label class="text-uppercase" for="asignaturaPre">ASIGNATURA:
                                </label>
                                <select class="form-control text-uppercase" name="asignaturaPre" id="asignaturaPre">
                                    <option value="">---Seleccione---</option>
                                    @foreach ($materias as $materia)
                                        <option value="{{ $materia->nombre }}">{{ $materia->nombre }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label class="text-uppercase" for="codigo">CÓDIGO DE ASIGNATURA:</label>
                                <input class="form-control" type="text" name="codigo" id="codigo" required>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="row p-1">
                            <h3 class="h3 text-uppercase text-black text-center">
                                CORREQUISITOS
                            </h3>
                        </div>
                        <div class="row p-1">
                            <div class="col-sm-6 form-group">
                                <label class="text-uppercase" for="asignaturaCo">ASIGNATURA:
                                </label>
                                <select class="form-control text-uppercase" name="asignaturaCo" id="asignaturaCo">
                                    <option value="">---Seleccione---</option>
                                    @foreach ($materias as $materia)
                                        <option value="{{ $materia->nombre }}">
                                            {{ $materia->nombre }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label class="text-uppercase" for="codigoDos">CÓDIGO DE ASIGNATURA:</label>
                                <input class="form-control" type="text" name="codigoDos" id="codigoDos" required>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row text-right mr-3">
                    <div class="col-sm-12 p-1">
                        <button class="btn btn-primary btn-lg" type="submit">Continuar</button>
                        {{-- <a class="btn btn-danger btn-lg"
                            href="{{ route('informacionGeneral', $syllabus->id) }}">Regresar</a> --}}
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        $(document).ready(function() {
            $(':input[type="submit"]').prop('disabled', true);
            $('input[type="text"]').keyup(function() {
                $(':input[type="submit"]').prop('disabled', this.value == "" ? true : false);
            })
        });
        $('#asignaturaCo').on('change', function() {
            $(':input[type="submit"]').prop('disabled', !$(this).val());
        }).trigger('change');
    </script>
@endsection
