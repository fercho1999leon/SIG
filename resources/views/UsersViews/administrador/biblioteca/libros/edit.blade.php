@php

namespace App\Http\Controllers;

use App\User;
use Sentinel;
use Form;

$usuario = User::where('userid', Sentinel::getUser()->id)->first();
$libros = LibroController::getAllBooks();
$autores = AutorController::getAllAuthors();
$categorias = CategoriaController::getAllCategories();
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
        <h2 class="title-page text-uppercase">Libros</h2>
      </div>
    </div>
    <div class="row wrapper">
      <div class="col-xs-12 p-1 bg-black">
        <h1 class="text-uppercase text-white" style="text-align: center">Libro -> <span
            class="text-info">{{ $libro->slug }}</span></h1>
      </div>
    </div>

    <div class="row wrapper">
      <div class="col-xs-12 p-1 bg-white" style="text-align: center">
        @php
          $autor_libro = LibroAutorController::getAuthorByBook($libro->id);
          $categoria_libro = LibroCategoriaController::getCategoryByBook($libro->id);
        @endphp
        <form action="{{ route('updateLibros', $libro->id) }}" method="post">
          {{ csrf_field() }}
          <div class="row form-group">
            <div class="col-xs-6 p-1">
              <label for="autor">Autor</label>
            </div>
            <div class="col-xs-6 p-1">
              <select class="form-control" name="autor" id="autor" disabled>
                @foreach ($autores as $autor)
                  @if ($autor->is_active != 0 && $autor->is_verified != 0)
                    @if ($autor->id == $autor_libro->id)
                      <option value="{{ $autor->id }}">{{ $autor->slug }}</option>
                    @endif
                  @endif
                @endforeach
              </select>
            </div>
          </div>
          <div class="row form-group">
            <div class="col-xs-6 p-1">
              <label for="categoria">Categorias</label>
            </div>
            <div class="col-xs-6 p-1">
              <select class="form-control" name="categoria" id="categoria" disabled>
                @foreach ($categorias as $categoria)
                  @if ($categoria->is_active != 0)
                    @if ($categoria->id == $categoria_libro->id)
                      <option value="{{ $categoria->id }}">{{ $categoria->slug }}</option>
                    @endif
                  @endif
                @endforeach
              </select>
            </div>
          </div>
          <div class="row form-group">
            <div class="col-xs-6 p-1">
              <label for="titulo">Título</label>
            </div>
            <div class="col-xs-6 p-1">
              <input class="form-control" type="text" name="titulo" id="titulo" value="{{ $libro->slug }}">
            </div>
          </div>
          <div class="row form-group">
            <div class="col-xs-6 p-1">
              <label for="documento">Documento (PDF)</label>
            </div>
            <div class="col-xs-6 p-1">
              <input type="file" name="documento" id="documento" accept="application/pdf"
                value="{{ $libro->file_url }}">
            </div>
          </div>
          <div class="row form-group">
            <div class="col-xs-6 p-1">
              <label for="estado">Estado</label>
            </div>
            <div class="col-xs-6 p-1">
              {!! Form::select('estado', ['0' => 'Inactivo', '1' => 'Activo'], $libro->is_active) !!}
            </div>
          </div>
          <div class="row form-group">
            <div class="col-xs-6 p-1">
              <label for="isbn">Número Internacional del Libro</label>
            </div>
            <div class="col-xs-6 p-1">
              <input class="form-control" type="text" name="isbn" id="isbn" value="{{ $libro->isbn }}">
            </div>
          </div>
          <div class="row form-group">
            <div class="col-xs-6 p-1">
              <label for="publicacion">Año de Publicación</label>
            </div>
            <div class="col-xs-6 p-1">
              <input class="form-control" type="text" name="publicacion" id="publicacion"
                value="{{ $libro->publication_year }}">
            </div>
          </div>
          <div class="row form-group text-right p-1">
            <button type="submit" class="btn btn-primary btn-lg">Actualizar</button>
            <a href="{{ route('indexLibros') }}" type="button" class="btn btn-danger btn-lg">Cancelar</a>
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
