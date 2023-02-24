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
          <div class="col-sm-4">
            <div class="row p-1">
              <div class="col-sm-12 form-group">
                <label class="text-uppercase" for="nombreContenido">NOMBRE DEL CONTENIDO:
                </label>
                <input class="form-control" type="text" name="nombreContenido" id="nombreContenido" required>
              </div>
            </div>
            <div class="row p-1">
              <div class="col-sm-4 form-group">
                <label class="text-uppercase" for="horas_clase">HORAS CLASE:</label>
                <input class="form-control text-center" type="number" id="horas_clase" name="horas_clase" min="1"
                  max="200" value="1" required>
              </div>
              <div class="col-sm-4 form-group">
                <label class="text-uppercase" for="practicas">PRÁCTICAS:</label>
                <input class="form-control text-center" type="number" id="practicas" name="practicas" min="1" max="200"
                  value="1" required>
              </div>
              <div class="col-sm-4 form-group">
                <label class="text-uppercase" for="autonomas">AUTÓNOMAS:</label>
                <input class="form-control text-center" type="number" id="autonomas" name="autonomas" min="1" max="200"
                  value="1" required>
              </div>
            </div>
            <div class="row p-1">
              <div class="col-sm-12 form-group">
                <label class="text-uppercase" for="actividades">ACTIVIDADES GENERALES
                  (AUTÓNOMAS,INVESTIGACIÓN,VINCULACIÓN):
                </label>
                <textarea class="form-control" type="textarea" name="actividades" id="actividades" rows="5"
                  style="resize:none" required></textarea>
              </div>
            </div>
            <div class="row p-1">
              <div class="col-sm-12 form-group">
                <label class="text-uppercase" for="mecanismo">MECANISMO DE EVALUACIÓN:
                </label>
                <input class="form-control" type="text" name="mecanismo" id="mecanismo" required>
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
                          <a href="{{ route('editContenidoUnidad', $contenido->id) }}"
                            class="btn btn-success btn-block" role="button" aria-disabled="true">EDITAR</a>
                        </th>
                      </tr>
                    @endif
                  @endforeach
                </tbody>
              </table>
            </div>
            <div class="row text-right mr-3">
              <div class="col-sm-12 p-1">
                <a class="btn btn-danger btn-lg" href="{{ route('unidadSyllabus', $syllabus->id) }}">Regresar</a>
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
