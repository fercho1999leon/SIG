@extends('layouts.master')

@php

use App\Http\Controllers\UnidadController;
use App\PerfilEgreso;
$unidades = UnidadController::getUnidadesBySyllabus($syllabus->id);

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
    <form action="{{route('updatePerfilUnidad', $perfil->id)}}" method="POST">
        {{ csrf_field() }}
        <div class="container-sm mt-2 bg-white text-left rounded">
            <div class="row text-center p-1">
                <img class="rounded mx-auto" src="{{ secure_asset('img/diario escolar.png') }}" alt="N/A" width="140px" />
                <h3 class="h3 text-uppercase text-black text-center">
                    Perfil de Egreso
                </h3>
                <hr class="hr">
            </div>
            <div class="row">
                <div class="col-sm-4">
                    <div class="row p-1">
                        <div class="col-sm-12 form-group">
                            <label class="text-uppercase" for="unidad">Unidad:
                            </label>
                            <select class="form-control" name="unidad" id="unidad" disabled>
                                <option value="{{$unidadSola->id}}">{{$unidadSola->nombre_unidad}}</option>
                            </select>
                        </div>
                    </div>
                    <div class="row p-1">
                        <div class="col-sm-12 form-group">
                            <label class="text-uppercase" for="contribucion">Contribución:
                            </label>
                            <select class="form-control" name="contribucion" id="contribucion">
                                <option value="">Seleccione</option>
                                <option value="Alta">Alta</option>
                                <option value="Media">Media</option>
                                <option value="Baja">Baja</option>
                            </select>
                        </div>
                    </div>
                    <div class="row p-1">
                        <div class="col-sm-12 form-group">
                            <label class="text-uppercase" for="evidencias">Evidencias (Conocimiento-Valores-Habilidades)
                            </label>
                            <textarea class="form-control" type="textarea" name="evidencias" id="evidencias" rows="5"
                                style="resize:none" required>{{$perfil->evidencias}}</textarea>
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
                                    <th colspan="8" class="text-center text-uppercase">Listado de Perfiles</th>
                                </tr>
                                <tr class="text-white">
                                    <th class="text-center text-black">#</th>
                                    <th class="text-center text-black">Unidad</th>
                                    <th class="text-center text-black">Contribución (Alta-Media-Baja)</th>
                                    <th class="text-center text-black">Evidencias(Conocimiento-Valores-Habilidades)</th>
                                </tr>
                            </thead>
                            <tbody class="text-center">
                                @foreach ($unidades as $unidad)
                                @if ($syllabus->id == $unidad->syllabus_id)
                                @php
                                    $perfil = PerfilEgreso::where('unidad_id', $unidad->id)->first();
                                @endphp
                                @if ($perfil != null)
                                    <tr class="bg-white text-black">
                                        <th class="text-center textoUnidad">
                                            {{ $contador++ }}</th>
                                        <th class="text-center textoUnidad">
                                            {{ $unidad->nombre_unidad }}</th>
                                        <th class="text-center textoUnidad">
                                            {{$perfil->contribucion}}</th>
                                        <th class="text-center textoUnidad">
                                            {{$perfil->evidencias}}</th>
                                    </tr>
                                @endif
                                @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                   <div class="row text-right mr-3">
                    <div class="col-sm-12 p-1">
                        <a class="btn btn-danger btn-lg" href="{{ route('perfilUnidad', $syllabus->id) }}">Cancelar</a>
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