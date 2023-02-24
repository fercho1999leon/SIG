@extends('layouts.master')

@php
use App\Http\Controllers\SyllabusController;
$syllabus = SyllabusController::getSyllabusById($unidad->syllabus_id);

use App\Http\Controllers\ContenidoController;
$contenidos = ContenidoController::getContenidosByUnidad($unidad->id);
$contador = 1;

@endphp


@section('css')
    <link href="{{ secure_asset('css/syllabus/syllabus.css') }}" rel="stylesheet">
@endsection

@section('content')
    <div id="page-wrapper" class="gray-bg dashbard-1">
        <!--CABECERA INICIAL-->
        @include('partials.encabezados.syllabus.syllabus_cabecera')
        <!--CONTENIDO PRINCIPAL-->
        <form action="{{ route('storeContenidoUnidad', $unidad->id) }}" method="POST">
            {{ csrf_field() }}
            <div class="container-sm mt-2 bg-white text-left rounded">
                <div class="row text-center p-1">
                    <img class="rounded mx-auto" src="{{ secure_asset('img/diario escolar.png') }}" alt="N/A" width="140px" />
                    <h3 class="h3 text-uppercase text-black text-center">
                        Contenido
                    </h3>
                    <hr class="hr">
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="p-1 bg-white rounded">
                            <table id="listadoUnidades" class="table table-bordered text-center" style="width:100%">
                                <thead>
                                    <tr class="text-black">
                                        <th colspan="8" class="text-center text-uppercase">Listado de Contenidos</th>
                                    </tr>
                                    <tr class="text-white">
                                        <th class="text-center text-black">#</th>
                                        <th class="text-center text-black">Contenido</th>
                                        <th class="text-center text-black">Horas Clase</th>
                                        <th class="text-center text-black">Horas Práctica</th>
                                        <th class="text-center text-black">Horas Autónomas</th>
                                        <th class="text-center text-black">Actividades Generales
                                            (Autónomas,Investigación,Vinculación)</th>
                                        <th class="text-center text-black">Mecanismo de Evaluación</th>
                                        <th class="text-center text-black">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody class="text-center">
                                    @foreach ($contenidos as $contenido)
                                        @if ($unidad->id == $contenido->unidad_id)
                                            <tr class="bg-white text-black">
                                                <th class="text-center textoUnidad">
                                                    {{ $contador++ }}</th>
                                                <th class="text-center textoUnidad">
                                                    {{ $contenido->titulo }}</th>
                                                <th class="text-center textoUnidad">
                                                    {{ $contenido->horas_clase }}</th>
                                                <th class="text-center textoUnidad">
                                                    {{ $contenido->horas_practicas }}</th>
                                                <th class="text-center textoUnidad">
                                                    {{ $contenido->horas_autonomas }}</th>
                                                <th class="text-center textoUnidad textoLargo">
                                                    {{ $contenido->actividades }}</th>
                                                <th class="text-center textoUnidad">
                                                    {{ $contenido->evaluacion }}</th>
                                                <th class="text-center ">
                                                    <a href="{{ route('editDosContenidoUnidad', $contenido->id) }}"
                                                        class="btn btn-success btn-block" role="button"
                                                        aria-disabled="true">EDITAR</a>
                                                </th>
                                            </tr>
                                        @endif
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="row text-right mr-3">
                            <div class="col-sm-12 p-1">
                                <a class="btn btn-danger btn-lg"
                                    href="{{ route('modificarUnidadSyllabus', $syllabus->id) }}">Regresar</a>
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
        $(document).ready(function() {
            $('input[type="number"]').attr({
                "min": 1,
                "value": 1
            });
        });
        $('input[type="number"]').on('input', function() {
            var value = $(this).val();
            if ((value !== '') && (value.indexOf('.') === -1)) {
                $(this).val(Math.max(Math.min(value, 200), -90));
            }
        });
    </script>
@endsection
