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
                    INFORMACIÓN GENERAL
                </h3>
                <hr class="hr">
            </div>
            <form action="{{ route('storeInformacionGeneral', $syllabus->id) }}" method="POST">
                {{ csrf_field() }}
                <div class="row">
                    <div class="col-sm-6">
                        <div class="row p-1">
                            <div class="col-sm-4 form-group">
                                <label class="text-uppercase" for="codigo">CÓDIGO DE ASIGNATURA:</label>
                                <input class="form-control" type="text" name="codigo" id="codigo" required>
                            </div>
                            <div class="col-sm-4 form-group">
                                <label class="text-uppercase" for="creditos">CRÉDITOS:
                                </label>
                                <input class="form-control text-center" type="number" id="creditos" name="creditos" max="6"
                                    value="1" required>
                            </div>
                            <div class="col-sm-4 form-group">
                                <label class="text-uppercase" for="tipo_asignatura">TIPO DE ASIGNATURA:
                                </label>
                                <select class="form-control" name="tipo_asignatura" id="tipo_asignatura">
                                    <option value="">---Seleccione---</option>
                                    <option value="Formación Básica">Formación Básica</option>
                                    <option value="Prácticas Externas">Prácticas Externas</option>
                                    <option value="Obligatoria">Obligatoria</option>
                                    <option value="Optativas">Optativas</option>
                                    <option value="Titulación">Titulación</option>
                                </select>
                            </div>
                        </div>
                        <div class="row p-1">
                            <div class="col-sm-12 form-group">
                                <label class="text-uppercase" for="curricular">UNIDAD DE ORGANIZACIÓN CURRICULAR:</label>
                                <input class="form-control" type="text" name="curricular" id="curricular" required>
                            </div>

                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="row p-1">
                            <div class="col-sm-4 form-group">
                                <label class="text-uppercase" for="horas_semanal">HORAS SEMANALES:</label>
                                <input class="form-control text-center" type="number" id="horas_semanal"
                                    name="horas_semanal" value="1" required>
                            </div>
                            <div class="col-sm-4 form-group">
                                <label class="text-uppercase" for="horas_clase">HORAS CLASE TOTALES:
                                </label>
                                <input class="form-control text-center" type="number" id="horas_clase" name="horas_clase"
                                    required>
                            </div>
                            <div class="col-sm-4 form-group">
                                <label class="text-uppercase" for="horas_tutoria">HORAS TUTORÍA TOTALES:
                                </label>
                                <input class="form-control text-center" type="number" id="horas_tutoria"
                                    name="horas_tutoria" required>
                            </div>
                        </div>
                        <div class="row p-1">
                            <div class="col-sm-2 form-group">
                                <label class="text-uppercase" for="teoricas">TEÓRICAS:</label>
                                <input class="form-control text-center" type="number" id="teoricas" name="teoricas"
                                    required>
                            </div>
                            <div class="col-sm-2 form-group">
                                <label class="text-uppercase" for="practicas">PRÁCTICAS:</label>
                                <input class="form-control text-center" type="number" id="practicas" name="practicas"
                                    required>
                            </div>
                            <div class="col-sm-2 form-group">
                                <label class="text-uppercase" for="autonomas">AUTÓNOMAS:</label>
                                <input class="form-control text-center" type="number" id="autonomas" name="autonomas"
                                    required>
                            </div>
                            <div class="col-sm-3 form-group">
                                <label class="text-uppercase" for="presenciales">PRESENCIALES:</label>
                                <input class="form-control text-center" type="number" id="presenciales" name="presenciales"
                                    required>
                            </div>
                            <div class="col-sm-3 form-group">
                                <label class="text-uppercase" for="virtuales">VIRTUALES:</label>
                                <input class="form-control text-center" type="number" id="virtuales" name="virtuales"
                                    required>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row text-right mr-3">
                    <div class="col-sm-12 p-1">
                        <button class="btn btn-primary btn-lg" type="submit">Continuar</button>
                        <a class="btn btn-danger btn-lg"
                            href="{{ route('eliminarSoloSyllabus', $syllabus->materia_id) }}">Cancelar</a>
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
