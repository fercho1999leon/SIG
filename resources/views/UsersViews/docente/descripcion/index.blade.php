@extends('layouts.master')

@php
use App\Http\Controllers\SyllabusController;
use App\User;
use App\TituloGrado;
use App\Career;
use App\Matter;

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
                    DESCRIPCIÓN GENERAL
                </h3>
                <hr class="hr">
            </div>
            <form action="{{ route('storeDescripcionSyllabus', $syllabus->id) }}" method="POST">
                {{ csrf_field() }}
                <div class="row">
                    <div class="col-sm-6">
                        <div class="row p-1">
                            <div class="col-sm-12 form-group">
                                <label class="text-uppercase" for="descripcion_asignatura">DESCRIPCIÓN DE LA
                                    ASIGNATURA:</label>
                                <textarea class="form-control" type="textarea" name="descripcion_asignatura"
                                    id="descripcion_asignatura" rows="4" style="resize:none" required></textarea>
                            </div>
                        </div>
                        <div class="row p-1">
                            <div class="col-sm-12 form-group">
                                <label class="text-uppercase" for="objetivo_asignatura">OBJETIVO DE LA ASIGNATURA:</label>
                                <textarea class="form-control" type="textarea" name="objetivo_asignatura"
                                    id="objetivo_asignatura" rows="4" style="resize:none" required></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="row p-1">
                            <div class="col-sm-12 form-group">
                                <label class="text-uppercase" for="resultados_asignatura">RESULTADOS DE APRENDIZAJE DE LA
                                    ASIGNATURA:</label>
                                <textarea class="form-control" type="textarea" name="resultados_asignatura"
                                    id="resultados_asignatura" rows="4" style="resize:none" required></textarea>
                            </div>
                        </div>
                        <div class="row p-1">
                            <div class="col-sm-12 form-group">
                                <label class="text-uppercase" for="contribucion">CONTRIBUCIÓN DE LA ASIGNATURA EN LA
                                    FORMACIÓN DEL PROFESIONAL:</label>
                                <textarea class="form-control" type="textarea" name="contribucion" id="contribucion"
                                    rows="4" style="resize:none" required></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="row p-1">
                            <div class="col-sm-12 form-group">
                                <label class="text-uppercase" for="competencias">COMPETENCIAS GENÉRICAS DE LA
                                    ASIGNATURA:</label>
                                <textarea class="form-control" type="textarea" name="competencias" id="competencias"
                                    rows="4" style="resize:none" required></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row text-right mr-3">
                    <div class="col-sm-12 p-1">
                        <button class="btn btn-primary btn-lg" type="submit">Continuar</button>
                        {{-- <a class="btn btn-danger btn-lg"
                        href="{{ route('prerequisitosSyllabus', $syllabus->id) }}">Regresar</a> --}}
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
            $('textarea').keyup(function() {
                $(':input[type="submit"]').prop('disabled', this.value == "" ? true : false);
            })
        });
    </script>
@endsection
