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
        <!--CABECERA INICIAL-->
        @include('partials.encabezados.syllabus.syllabus_cabecera')
        <div class="wrapper wrapper-content">
            <div class="row">
                <div class="col-sm-4 col-lg-4 bg-white rounded text-center p-1">
                    <div class="card">
                        <img src="{{ secure_asset('img/docente/syllabus/paper.png') }}" class="card-img-top mx-auto" alt="..."
                            width="50%">
                        <div class="card-body p-1">
                            <h4 class="card-title text-uppercase">Información General</h4>
                            <p class="card-text">Punto: I</p>
                            <a href="{{ route('editInformacionGeneral', $syllabus->id) }}"
                                class="btn btn-primary text-uppercase">Ingresar</a>
                        </div>
                    </div>
                </div>
                <div class="col-sm-3 col-lg-4 bg-white rounded text-center p-1">
                    <div class="card">
                        <img src="{{ secure_asset('img/docente/syllabus/paper.png') }}" class="card-img-top mx-auto" alt="..."
                            width="50%">
                        <div class="card-body p-1">
                            <h4 class="card-title text-uppercase">PRERREQUISITOS Y CORREQUISITOS</h4>
                            <p class="card-text">Punto: II</p>
                            <a href="{{ route('editPrerequisitosSyllabus', $syllabus->id) }}"
                                class="btn btn-primary text-uppercase">Ingresar</a>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4 col-lg-4 bg-white rounded text-center p-1">
                    <div class="card">
                        <img src="{{ secure_asset('img/docente/syllabus/paper.png') }}" class="card-img-top mx-auto" alt="..."
                            width="50%">
                        <div class="card-body p-1">
                            <h4 class="card-title text-uppercase">DESCRIPCIÓN GENERAL
                            </h4>
                            <p class="card-text">Punto: III - IV - V - VI - VII</p>
                            <a href="{{ route('editDescripcionSyllabus', $syllabus->id) }}"
                                class="btn btn-primary text-uppercase">Ingresar</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-1">
                <div class="col-sm-4 col-lg-4 bg-white rounded text-center p-1 ">
                    <div class="card">
                        <img src="{{ secure_asset('img/docente/syllabus/paper.png') }}" class="card-img-top mx-auto" alt="..."
                            width="50%">
                        <div class="card-body p-1">
                            <h4 class="card-title text-uppercase">UNIDADES CURRICULARES
                            </h4>
                            <p class="card-text">Punto: VIII</p>
                            <a href="{{ route('modificarUnidadSyllabus', $syllabus->id) }}"
                                class="btn btn-primary text-uppercase">Ingresar</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row text-center mt-1">
                <a class="btn btn-danger btn-lg" href="{{ route('syllabus') }}">Regresar</a>
            </div>
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
