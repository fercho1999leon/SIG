@extends('layouts.master')
@section('content')
@php
use App\Permiso;
$ruta = str_replace("/", "", $_SERVER["REQUEST_URI"]);
$permiso = Permiso::desbloqueo($ruta);
@endphp
    <div id="page-wrapper" class="gray-bg dashbard-1">
        @include('barra.administrador')
        @include('partials.institucion')
    </div>
@endsection