@extends('layouts.master')

@php

use App\Http\Controllers\UnidadController;
use App\Http\Controllers\SyllabusController;
$unidades = UnidadController::getUnidadesBySyllabus($unidad->syllabus_id);
$syllabus = SyllabusController::getSyllabusById($unidad->syllabus_id);
$number = 1;
@endphp

@section('css')
    <link href="{{ secure_asset('css/syllabus/syllabus.css') }}" rel="stylesheet">
@endsection

@section('content')
    <div id="page-wrapper" class="gray-bg dashbard-1">
        <!--CABECERA INICIAL-->
        @include('partials.encabezados.syllabus.syllabus_cabecera')
        <!--CONTENIDO PRINCIPAL-->
        <form action="{{ route('updateUnidadSyllabus', $unidad->id) }}" method="POST">
            {{ csrf_field() }}
            <div class="container-sm mt-2 bg-white text-left rounded">
                <div class="row text-center p-1">
                    <img class="rounded mx-auto" src="{{ secure_asset('img/diario escolar.png') }}" alt="N/A" width="140px" />
                    <h3 class="h3 text-uppercase text-black text-center">
                        Unidad <span class="text-success">{{ $unidad->nombre_unidad }}</span>
                    </h3>
                    <hr class="hr">
                </div>
                <div class="row">
                    <div class="col-sm-4">
                        <div class="row p-1">
                            <div class="col-sm-6 form-group">
                                <label class="text-uppercase" for="nombreUnidad">NOMBRE DE LA UNIDAD:
                                </label>
                                <input class="form-control" type="text" name="nombreUnidad" id="nombreUnidad"
                                    value="{{ $unidad->nombre_unidad }}" required>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label class="text-uppercase" for="objetivoUnidad">OBJETIVO DE LA UNIDAD:</label>
                                <input class="form-control" type="text" name="objetivoUnidad" id="objetivoUnidad"
                                    value="{{ $unidad->objetivo }}" required>
                            </div>
                        </div>
                        <div class="row p-1">
                            <div class="col-sm-12 form-group">
                                <label class="text-uppercase" for="resultados">RESULTADOS DE APRENDIZAJE DE LA UNIDAD:
                                </label>
                                <textarea class="form-control" type="textarea" name="resultados" id="resultados" rows="5"
                                    style="resize:none" required>{{ $unidad->aprendizaje }}</textarea>
                            </div>

                        </div>
                        <div class="row p-1">
                            <div class="col-sm-6 form-group">
                                <label class="text-uppercase" for="metodologia">METODOLOGÍA:</label>
                                <input class="form-control" type="text" name="metodologia" id="metodologia"
                                    value="{{ $unidad->metodologia }}" required>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label class="text-uppercase" for="recursos">RECURSOS DIDÁCTICOS:
                                </label>
                                <input class="form-control" type="text" name="recursos" id="recursos"
                                    value="{{ $unidad->recursos }}" required>
                            </div>
                        </div>
                        <div class="row text-center">
                            <div class="col-sm-12 p-1">
                                <button class="btn btn-primary btn-lg text-uppercase" type="submit">ACTUALIZAR</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-8">
                        <div class="p-1 bg-white rounded">
                            <table id="listadoUnidades" class="table table-bordered text-center" style="width:100%">
                                <thead>
                                    <tr class="text-black">
                                        <th colspan="7" class="text-center text-uppercase">Listado de Unidades</th>
                                    </tr>
                                    <tr class="text-white">
                                        <th class="text-center text-black">#</th>
                                        <th class="text-center text-black">Unidad</th>
                                        <th class="text-center text-black">Objetivo</th>
                                        <th class="text-center text-black">Aprendizaje</th>
                                        <th class="text-center text-black">Metodología</th>
                                        <th class="text-center text-black">Recursos</th>
                                    </tr>
                                </thead>
                                <tbody class="text-center">
                                    @foreach ($unidades as $unidad)
                                        @if ($syllabus->id == $unidad->syllabus_id)
                                            <tr class="bg-white text-black">
                                                <th class="text-center textoUnidad">
                                                    {{ $number++ }}</th>
                                                <th class="text-center textoUnidad">
                                                    {{ $unidad->nombre_unidad }}</th>
                                                <th class="text-center textoUnidad">
                                                    {{ $unidad->objetivo }}</th>
                                                <th class="text-center textoUnidad textoLargo">
                                                    {{ $unidad->aprendizaje }}</th>
                                                <th class="text-center textoUnidad">
                                                    {{ $unidad->metodologia }}</th>
                                                <th class="text-center textoUnidad">
                                                    {{ $unidad->recursos }}</th>
                                            </tr>
                                        @endif
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="row text-right mr-3">
                            <div class="col-sm-12 p-1">
                                <a class="btn btn-danger btn-lg"
                                    href="{{ route('unidadSyllabus', $syllabus->id) }}">Cancelar</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
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
    </script>
@endsection
