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
      <h2 class="title-page text-uppercase">Autores</h2>
    </div>
  </div>
  <div class="row wrapper">
    <div class="col-xs-12 p-1 bg-black">
      <h1 class="text-uppercase text-white" style="text-align: center">Autor -> <span
          class="text-info">{{$autor->slug}}</span></h1>
    </div>
  </div>

  <div class="row wrapper">
    <div class="col-xs-12 p-1 bg-white" style="text-align: center">
      <form action="{{route('updateAutores', $autor->id)}}" method="post">
        {{csrf_field()}}
        <div class="row form-group">
          <div class="col-xs-6 p-1">
            <label class="form-label" for="nombre_autor">Nombre Autor</label>
          </div>
          <div class="col-xs-6 p-1">
            <input class="form-control" type="text" name="nombre_autor" id="nombre_autor" value="{{$autor->slug}}">
          </div>
        </div>
        <div class="row form-group">
          <div class="col-xs-6 p-1">
            <label for="estado">Estado</label>
          </div>
          <div class="col-xs-6 p-1">
            {!! Form::select('estado', array('0' => 'Inactivo', '1' => 'Activo'),
            $autor->is_active);!!}
          </div>
        </div>
        <div class="row form-group">
          <div class="col-xs-6 p-1">
            <label for="estado">Verificado</label>
          </div>
          <div class="col-xs-6 p-1">
            {!! Form::select('verificado', array('0' => 'No', '1' => 'Si'),
            $autor->is_verified);!!}
          </div>
        </div>
        <div class="row form-group text-right p-1">
          <button type="submit" class="btn btn-primary btn-lg">Actualizar</button>
          <a href="{{route('indexAutores')}}" type="button" class="btn btn-danger btn-lg">Cancelar</a>
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