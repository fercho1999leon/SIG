@extends('layouts.master')
@section('content')
@php
use App\Permiso;
$permiso = Permiso::desbloqueo('home');
@endphp
        <div id="page-wrapper" class="gray-bg dashbard-1">
            @include('layouts.nav_bar_top')
            @include('partials.datos_perfil')
        </div>
@endsection