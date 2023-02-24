@extends('UsersViews.admisiones.style')
@php
    use App\ConfiguracionSistema;
    use App\PeriodoLectivo;
@endphp
<link rel="stylesheet" href="/css/app.css">
<meta name="csrf-token" content="{{ csrf_token() }}">
<div class="row wrapper white-bg ">
    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $message)
                    <li>{{ $message }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    @if(Session::has('message'))
        <p class="alert alert-success">{{ Session::get('message') }}</p>
    @endif
    @if(Session::has('warning'))
        <p class="alert alert-danger">{{ Session::get('warning') }}</p>
    @endif
    <div class="container">
        <div class="row mt-5">
                <div class="col-md-6">
                    <h2 class="title-page">Busqueda de estudiante por número de cédula</h2>
                    <div class="wrapper wrapper-content">
                    <form method="post" action="{{route('busqueda_estudiante')}}" enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="form-group">
                    <input type="text" name="search" value="{{request('search')}}" class="form-control" placeholder="Buscar estudiante...">
                </div>
                <div class="form-group">
                    <button type="submit" class="mb-1 btn btn-primary btn-lg">BUSCAR</button>
                @php
                    $ModuloAdmisiones = App\ConfiguracionSistema::admisiones();
                    $nuevoEstudianteAdmision = ConfiguracionSistema::where('nombre', 'NUEVO_ESTUDIANTE_ADMISION')
                    ->where('idPeriodo', $ModuloAdmisiones->idPeriodo)->first();
                @endphp
                @if($nuevoEstudianteAdmision->valor=='1')
                <a class="mb-1 btn btn-primary btn-lg" href="{{route('nuevoEstudiante')}}">Nuevo</i>&nbsp;
                </a>
                @endif
                  </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>