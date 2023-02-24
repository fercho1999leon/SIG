@extends('layouts.master')

@php

use App\Http\Controllers\UnidadController;
$unidades = UnidadController::getUnidadesBySyllabus($syllabus->id);

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
        <form action="{{ route('storeUnidadSyllabus', $syllabus->id) }}" method="POST">
            {{ csrf_field() }}
            <div class="container-sm mt-2 bg-white text-left rounded">
                <div class="row text-center p-1">
                    <img class="rounded mx-auto" src="{{ secure_asset('img/diario escolar.png') }}" alt="N/A" width="140px" />
                    <h3 class="h3 text-uppercase text-black text-center">
                        Unidades
                    </h3>
                    <hr class="hr">
                </div>
                <div class="row">
                    <div class="col-sm-4">
                        <div class="row p-1">
                            <div class="col-sm-6 form-group">
                                <label class="text-uppercase" for="nombreUnidad">NOMBRE DE LA UNIDAD:
                                </label>
                                <input class="form-control" type="text" name="nombreUnidad" id="nombreUnidad" required>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label class="text-uppercase" for="objetivoUnidad">OBJETIVO DE LA UNIDAD:</label>
                                <input class="form-control" type="text" name="objetivoUnidad" id="objetivoUnidad"
                                    required>
                            </div>
                        </div>
                        <div class="row p-1">
                            <div class="col-sm-12 form-group">
                                <label class="text-uppercase" for="resultados">RESULTADOS DE APRENDIZAJE DE LA UNIDAD:
                                </label>
                                <textarea class="form-control" type="textarea" name="resultados" id="resultados" rows="5"
                                    style="resize:none" required></textarea>
                            </div>

                        </div>
                        <div class="row p-1">
                            <div class="col-sm-6 form-group">
                                <label class="text-uppercase" for="metodologia">METODOLOGÍA:</label>
                                <input class="form-control" type="text" name="metodologia" id="metodologia" required>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label class="text-uppercase" for="recursos">RECURSOS DIDÁCTICOS:
                                </label>
                                <input class="form-control" type="text" name="recursos" id="recursos" required>
                            </div>
                        </div>
                        <div class="row text-center">
                            <div class="col-sm-12 p-1">
                                <button class="btn btn-primary btn-lg text-uppercase" type="submit">GUARDAR</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-8">
                        <div class="p-1 bg-white rounded table-responsive">
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
                                        <th class="text-center text-black">Acciones</th>
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
                                                <th class="text-center textoUnidad textoLargo">
                                                    {{ $unidad->metodologia }}</th>
                                                <th class="text-center textoUnidad textoLargo">
                                                    {{ $unidad->recursos }}</th>
                                                <th class="text-center ">
                                                    <a href="{{ route('editUnidadSyllabus', $unidad->id) }}"
                                                        class="btn btn-success btn-block" role="button"
                                                        aria-disabled="true">EDITAR</a>
                                                    <a href="{{ route('contenidoUnidad', $unidad->id) }}"
                                                        class="btn btn-primary btn-block" role="button"
                                                        aria-disabled="true">CONTENIDO</a>
                                                </th>
                                            </tr>
                                        @endif
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="row text-right mr-3">
                            <div class="col-sm-12 p-1">
                                <a class="btn btn-primary btn-lg" href="{{ route('perfilUnidad', $syllabus->id) }}">Continuar</a>
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
