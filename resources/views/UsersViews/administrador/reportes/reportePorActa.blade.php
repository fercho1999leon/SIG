@extends('layouts.master')
@section('css')
<link href="{{ secure_asset('css/actas/acta_index.css') }}" rel="stylesheet">
@endsection
@section('content')
@include('partials.loader.loader')
@php
$unidad = App\UnidadPeriodica::unidadP();
@endphp
<a class="button-br" href=" {{ route('home') }} ">
    <button>
        <img src="{{ secure_asset('img/return.png') }}" alt="" width="17"> Regresar
    </button>
</a>
<div id="page-wrapper" class="gray-bg dashbard-1">
    @include('layouts.nav_bar_top')
    <div class="row wrapper white-bg titulo-separacion noBefore">
        <div class="col-xs-12 titulo-separacion">
            <h2 class="title-page">Reportes Generales de Calificaciones </h2>
        </div>
    </div>

    <div class="wrapper wrapper-content">
        <div class="row">
            <form action="{{ route('generarReporte') }}" method="POST" enctype="multipart/form-data" target="_blank">
                {{ csrf_field() }}
                <div class="panel pl-1 pr-1 matricula__matriculacion">
                    <div class="container-lg p-5">
                        <h2 class="text-success text-center">OPCIONES DE ACTA</h2>
                        <div class="row p-3">
                            <label for="tipoReporte" class="matricula__matriculacion-label">Seleccione el Tipo de
                                Reporte:</label>
                            <select class="form-control input-sm" id="tipoReporte" name="tipoReporte" require>
                                <option selected>Seleccione</option>
                                <option value="1">Acta de Calificación Parcial</option>
                                {{-- <option value="2">Acta de Calificación Final</option>
                                <option value="3">Acta de Recuperación </option>
                                <option value="4">Acta de Asistencias Parcial</option>
                                <option value="5">Acta de Asistencias Final</option> --}}
                                <option value="2">Reporte Calificación Global</option>
                            </select>
                        </div>
                        <div class="row p-3">
                            <label for="" class="matricula__matriculacion-label">Seleccione la Carrera:</label>
                            <select class="form-control input-sm" id="carrera" name="carrera" require>
                                <option>Seleccione</option>
                                @foreach ($careers as $careers)
                                <option value="{{ $careers->id }}">{{ $careers->nombre }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="row p-3">
                            <label for="" class="matricula__matriculacion-label">Seleccione la Ciclo:</label>
                         
                            <select class="form-control input-sm" id="ciclo" name="ciclo" require>
                                @foreach($unidad as $und)
                                    <optgroup label="{{$und->nombre}}">
                                        @php $parcialP = App\ParcialPeriodico::parcialP($und->id); @endphp
                                        @foreach($parcialP as $par )
                                        <option value="{{$par->identificador}}"  >{{$par->nombre}}</option>
                                        @endforeach
                                    </optgroup>
                                @endforeach
                            </select>
                        </div>
                        <div class="row p-3">
                            <label for="" class="matricula__matriculacion-label">Seleccione el Semestre:</label>
                            <select class="form-control input-sm" id="semestre" name="semestre" require>
                                <option>Seleccione</option>
                            </select>
                        </div>
                        <div class="row p-3">
                            <label for="" class="matricula__matriculacion-label">Seleccione el Paralelo o
                                Curso:</label>
                            <select class="form-control input-sm" id="curso" name="curso" require>
                                <option> Seleccione</option>
                            </select>
                        </div>
                        <div class="row p-3">
                            <label for="" class="matricula__matriculacion-label">Seleccione la Materia /
                                Asignatura:</label>
                            <select class="form-control input-sm" id="matters" name="matters" require>
                                <option>Seleccione</option>
                            </select>
                        </div>
                        <div class="text-right">
                            <button id="boton" type="submit" class="mb-1 btn btn-primary btn-lg">Generar
                                Reporte</button>
                        </div>
                    </div>
            </form>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script src="{{ secure_asset('js/reporteActas/reporteActa.js') }}">
</script>
@endSection