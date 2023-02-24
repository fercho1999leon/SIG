@php

namespace App\Http\Controllers;

use App\User;
use Sentinel;
use Form;

$usuario = User::where('userid', Sentinel::getUser()->id)->first();

@endphp

@extends('layouts.master2')
@section('assets')
  <link rel="stylesheet" type="text/css"
    href="https://cdn.datatables.net/v/bs/dt-1.11.4/b-2.2.2/b-html5-2.2.2/r-2.2.9/datatables.min.css" />
@endsection



@section('content')
  <div id="page-wrapper" class="gray-bg dashbard-1">
    @include('layouts.nav_bar_top')
    <div class="row wrapper white-bg titulo-separacion noBefore">
      <div class="col-xs-12 titulo-separacion">
        <h2 class="title-page text-uppercase">Seccion</h2>
      </div>
    </div>
    <div class="row wrapper">
      <div class="col-xs-12 p-1 bg-black">
        <h1 class="text-uppercase text-white" style="text-align: center">Seccion -> <span
            class="text-info">{{ $seccion->seccion }}</span></h1>
      </div>
    </div>

    <div class="row wrapper">
      <div class="col-xs-12 p-1 bg-white" style="text-align: center">
        <form action="{{ route('BibliotecaSeccionupdate', $seccion->id) }}" method="post" enctype="multipart/form-data">
          {{ csrf_field() }}
          <div class="row form-group">
            <div class="col-xs-6 p-1">
              <label for="titulo">Nombre de Seccion</label>
            </div>
            <div class="col-xs-6 p-1">
              <input class="form-control" type="text" name="nombre_seccion" id="nombre_seccion" value="{{ $seccion->seccion }}" required>
            </div>
          </div>
          <div class="row form-group">
            <div class="col-xs-6 p-1">
              <label for="estado">Estado</label>
            </div>
            <div class="col-xs-6 p-1">
              {!! Form::select('estado', ['0' => 'Inactivo', '1' => 'Activo'], $seccion->is_active) !!}
            </div>
          </div>
          <div class="row form-group text-right p-1">
            <button type="submit" class="btn btn-primary btn-lg">Actualizar</button>
            <a href="{{ route('BibliotecaVirtual') }}" type="button" class="btn btn-danger btn-lg">Cancelar</a>
          </div>
        </form>
      </div>
    </div>
  </div>
@endsection

@section('scripts')
  <script type="text/javascript"
    src="https://cdn.datatables.net/v/bs/dt-1.11.4/b-2.2.2/b-html5-2.2.2/r-2.2.9/datatables.min.js"></script>
@endsection
