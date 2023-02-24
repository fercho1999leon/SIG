@extends('layouts.master')

@php

use App\ReferenciaApa;

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
    <form action="{{route('storeReferenciaApa', $syllabus->id)}}" method="POST">
        {{ csrf_field() }}
        <div class="container-sm mt-2 bg-white text-left rounded">
            <div class="row text-center p-1">
                <img class="rounded mx-auto" src="{{ secure_asset('img/diario escolar.png') }}" alt="N/A" width="140px" />
                <h3 class="h3 text-uppercase text-black text-center">
                    Referencias Bibliográficas
                </h3>
                <hr class="hr">
            </div>
            <div class="row">
                <h4 class="h4 text-uppercase text-black text-center"><a href="https://www.cva.itesm.mx/biblioteca/pagina_con_formato_version_oct/apaweb.html" target="_blank">Generador Apa</a></h4>
                <hr>
                <div class="col-sm-4">
                    <div class="row p-1">
                        <div class="col-sm-12 form-group">
                            <label class="text-uppercase" for="referencias">Referencia Bibliográfica (Normas APA)
                            </label>
                            <textarea class="form-control" type="textarea" name="referencias" id="referencias" rows="5" style="resize:none"
                                required></textarea>
                        </div>
                    </div>
                    <div class="row text-center">
                        <div class="col-sm-12 p-1">
                            <button class="btn btn-primary btn-lg text-uppercase" type="submit">GUARDAR</button>
                        </div>
                    </div>
                </div>
                <div class="col-sm-8">
                    <div class="p-1 bg-white rounded">
                        <table id="listadoUnidades" class="table table-bordered text-center" style="width:100%">
                            <thead>
                                <tr class="text-black">
                                    <th colspan="8" class="text-center text-uppercase">Listado de Referencias Bibliográficas</th>
                                </tr>
                                <tr class="text-white">
                                    <th class="text-center text-black">#</th>
                                    <th class="text-center text-black">Referencia</th>
                                    <th class="text-center text-black">Acción</th>
                                </tr>
                            </thead>
                            <tbody class="text-center">
                                @php
                                     $referencias = ReferenciaApa::all()->where('syllabus_id', $syllabus->id);
                                @endphp
                                @if ($referencias != null)
                                    @foreach ($referencias as $referencia)
                                        <tr class="bg-white text-black">
                                            <th class="text-center textoUnidad">
                                                {{ $contador++ }}</th>
                                            <th class="text-center textoUnidad">
                                                {{ $referencia->referencias }}</th>
                                            <th class="text-center textoUnidad">
                                                <a href="{{route('editReferenciaApa', $referencia->id)}}" class="btn btn-primary btn-block" role="button"
                                                    aria-disabled="true">Editar</a>
                                            </th>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                    <div class="row text-right mr-3">
                        <div class="col-sm-12 p-1">
                            <a class="btn btn-success btn-lg" href="{{ route('syllabus') }}">Finalizar</a>
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
            $('textarea').keyup(function() {
                $(':input[type="submit"]').prop('disabled', this.value == "" ? true : false);
            })
        });
</script>
@endsection