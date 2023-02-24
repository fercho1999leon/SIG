@php

namespace App\Http\Controllers;

use App\User;
use Sentinel;
use Form;
use App\SeccionBiblioteca;

$usuario = User::where('userid', Sentinel::getUser()->id)->first();

$seccion = SeccionBiblioteca::getAllConfig();

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
        <h2 class="title-page text-uppercase">Biblioteca</h2>
      </div>
    </div>
    <div class="row wrapper">
      <div class="col-xs-12 p-1 bg-black">
        <h1 class="text-uppercase text-white" style="text-align: center">Biblioteca -> <span
            class="text-info">{{ $biblioteca->name }}</span></h1>
      </div>
    </div>

    <div class="row wrapper">
      <div class="col-xs-12 p-1 bg-white" style="text-align: center">
        <form action="{{ route('BibliotecaVirtualupdate', $biblioteca->id) }}" method="post" enctype="multipart/form-data">
          {{ csrf_field() }}
          <div class="row form-group">
            <div class="col-xs-6 p-1">
              <label for="titulo">Nombre de biblioteca</label>
            </div>
            <div class="col-xs-6 p-1">
              <input class="form-control" type="text" name="nombre_biblioteca" id="nombre_biblioteca" value="{{ $biblioteca->name }}" required>
            </div>
          </div>
          <div class="row form-group">
            <div class="col-xs-6 p-1">
              <label for="documento">Imagen (PNG)</label>
            </div>
            <div class="col-xs-6 p-1">
              <input type="file" name="image" id="image" accept=".png"
                value="{{ $biblioteca->urlimage }}">
            </div>
          </div>
          <div class="row form-group">
            <div class="col-xs-6 p-1">
              <label for="url_biblioteca">Url biblioteca</label>
            </div>
            <div class="col-xs-6 p-1">
              <input class="form-control" type="text" name="url_biblioteca" id="url_biblioteca" value="{{ $biblioteca->urlbiblioteca }}" required>
            </div>
          </div>
          <div class="row form-group">
            <div class="col-xs-6 p-1">
              <label for="seccion">Secciòn</label>
            </div>
            <div class="col-xs-6 p-1">
              <select class="form-control" name="seccion" id="seccion" required>
                @foreach($seccion as $secci)
                  <option value="{{$secci->id}}">{{$secci->seccion}}</option>
                @endforeach
              </select>
            </div>
          </div>
          <div class="row form-group">
            <div class="col-xs-6 p-1">
              <label for="estado">Estado</label>
            </div>
            <div class="col-xs-6 p-1">
              {!! Form::select('estado', ['0' => 'Inactivo', '1' => 'Activo'], $biblioteca->is_active) !!}
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
  <script>
    $("#seccion").val("{{$biblioteca->id_seccion_biblioteca}}")
  </script>
  <script type="text/javascript"
    src="https://cdn.datatables.net/v/bs/dt-1.11.4/b-2.2.2/b-html5-2.2.2/r-2.2.9/datatables.min.js"></script>
@endsection
