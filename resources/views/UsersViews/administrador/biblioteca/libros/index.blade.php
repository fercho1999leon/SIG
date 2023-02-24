@php

namespace App\Http\Controllers;

use App\User;
use Sentinel;

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
        <h2 class="title-page text-uppercase">Biblioteca</h2>
      </div>
    </div>
    <div class="row wrapper">
      <div class="col-xs-12 p-1 bg-black">
        <h1 class="text-uppercase text-white" style="text-align: center">Sección de Catalogos de Libros</h1>
      </div>
    </div>
    <div class="row wrapper">
      <div class="col-xs-12 bg-white p-1">
        <table id="tablaLibros" class="table table-bordered " style="width:100%;">
          <thead>
            <tr class="bg-black text-white">
              <th>ID</th>
              <th>Autor</th>
              <th>Categoría</th>
              <th>Título</th>
              <th>Documento</th>
              <th>Año de Publicación</th>
              @if ($usuario->cargo != 'Estudiante')
                <th>Estado</th>
                <th>Acciones</th>
              @endif
            </tr>
          </thead>
          <tbody>
            @if ($libros != null)
              @foreach ($libros as $libro)
                @php
                  $autor_libro = LibroAutorController::getAuthorByBook($libro->id);
                  $categoria_libro = LibroCategoriaController::getCategoryByBook($libro->id);
                @endphp
                @if ($autor_libro != null && $categoria_libro != null)
                  @if ($autor_libro->is_active == 1 && $autor_libro->is_verified == 1 && $categoria_libro->is_active == 1)
                    @if ($usuario->cargo == 'Estudiante')
                      @if ($libro->is_active == 1)
                        <tr>
                          <th style="text-align: center;">{{ $libro->id }}</th>
                          <th style="text-align: center;">{{ $autor_libro->slug }}</th>
                          <th style="text-align: center;">{{ $categoria_libro->slug }}</th>
                          <th style="text-align: center;">{{ $libro->slug }}</th>
                          <th style="text-align: center;"><a href="libros/{{ $libro->file_url }}"
                              onclick="timeRead({{ $libro->id }})" target="_blank">Ver Libro</a>
                          </th>
                          <th style="text-align: center;">{{ $libro->publication_year }}</th>
                        </tr>
                      @endif
                    @else
                      <tr>
                        <th style="text-align: center;">{{ $libro->id }}</th>
                        <th style="text-align: center;">{{ $autor_libro->slug }}</th>
                        <th style="text-align: center;">{{ $categoria_libro->slug }}</th>
                        <th style="text-align: center;">{{ $libro->slug }}</th>
                        <th style="text-align: center;"><a href="libros/{{ $libro->file_url }}"
                            onclick="timeRead({{ $libro->id }})" target="_blank">Ver Libro</a>
                          {{-- <a href="/ViewerJS/#../libros/{{ $libro->file_url }}" target="_blank">Ver</a> --}}
                        </th>
                        <th style="text-align: center;">{{ $libro->publication_year }}</th>
                        <th style="text-align: center;">
                          @if ($libro->is_active == 1)
                            <span class="text-info text-uppercase">Activo</span>
                          @else
                            <span class="text-danger text-uppercase">Inactivo</span>
                          @endif
                        </th>
                        <th style="text-align: center;">
                          <a class="btn btn-success" href="{{ route('editLibros', $libro->id) }}">Modificar</a>
                          <a class="btn btn-danger autorizar"
                            href="{{ route('destroyLibros', $libro->id) }}">Eliminar</a>
                        </th>
                      </tr>
                    @endif
                  @endif
                @endif
              @endforeach
            @endif
          </tbody>
        </table>
      </div>
    </div>

    @if ($usuario->cargo != 'Estudiante')
      <div class="row wrapper text-right">
        <div class="col-xs-12 bg-white p-1">
          {{-- CREACIÓN --}}
          <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#modalCrear">Crear
            Libro</button>
          <div id="modalCrear" class="modal fade" role="dialog">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <h4 class="modal-title">Crear nuevo Libro</h4>
                </div>
                <form action="{{ route('storeLibros') }}" method="POST" enctype="multipart/form-data">
                  {{ csrf_field() }}
                  <div class="modal-body">
                    <div class="row form-group">
                      <div class="col-xs-6 p-1">
                        <label for="autor">Autor</label>
                      </div>
                      <div class="col-xs-6 p-1">
                        <select class="form-control" name="autor" id="autor" required>
                          @foreach ($autores as $autor)
                            @if ($autor->is_active != 0 && $autor->is_verified != 0)
                              <option value="{{ $autor->id }}">{{ $autor->slug }}</option>
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
                        <select class="form-control" name="categoria" id="categoria" required>
                          @foreach ($categorias as $categoria)
                            @if ($categoria->is_active != 0)
                              <option value="{{ $categoria->id }}">{{ $categoria->slug }}</option>
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
                        <input class="form-control" type="text" name="titulo" id="titulo" required>
                      </div>
                    </div>
                    <div class="row form-group">
                      <div class="col-xs-6 p-1">
                        <label for="documento">Documento (PDF)</label>
                      </div>
                      <div class="col-xs-6 p-1">
                        <input type="file" name="documento" id="documento" accept="application/pdf" required>
                      </div>
                    </div>
                    <div class="row form-group">
                      <div class="col-xs-6 p-1">
                        <label for="estado">Estado</label>
                      </div>
                      <div class="col-xs-6 p-1">
                        <select class="form-control" name="estado" id="estado" required>
                          <option value="0">Inactivo</option>
                          <option value="1">Activo</option>
                        </select>
                      </div>
                    </div>
                    <div class="row form-group">
                      <div class="col-xs-6 p-1">
                        <label for="isbn">Número Internacional del Libro</label>
                      </div>
                      <div class="col-xs-6 p-1">
                        <input class="form-control" type="text" name="isbn" id="isbn" required>
                      </div>
                    </div>
                    <div class="row form-group">
                      <div class="col-xs-6 p-1">
                        <label for="publicacion">Año de Publicación</label>
                      </div>
                      <div class="col-xs-6 p-1">
                        <input class="form-control" type="text" name="publicacion" id="publicacion" required>
                      </div>
                    </div>
                  </div>
                  <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Agregar</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    @endif
  </div>
@endsection

@section('scripts')
  <script>
    $(document).ready(function() {
      $('#tablaLibros').DataTable({
        "paging": true,
        "ordering": true,
        "info": false,
        "oLanguage": {
          "sProcessing": "Procesando...",
          "sLengthMenu": "Mostrar _MENU_ registros",
          "sZeroRecords": "No se encontraron resultados",
          "sEmptyTable": "Ningún dato disponible en esta tabla",
          "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
          "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
          "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
          "sInfoPostFix": "",
          "sSearch": "Buscar:",
          "sUrl": "",
          "sInfoThousands": ",",
          "sLoadingRecords": "Cargando...",
          "oPaginate": {
            "sFirst": "Primero",
            "sLast": "Último",
            "sNext": "Siguiente",
            "sPrevious": "Anterior"
          },
          "oAria": {
            "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
            "sSortDescending": ": Activar para ordenar la columna de manera descendente"
          }
        }
      });
    });
    $(".autorizar").click(function(event) {
      var bool = (confirm("¿Está seguro que desea ELIMINAR esta Libro?"))
      if (bool != true) {
        event.preventDefault();
      }
    });
    $('#publicacion').bind('keyup paste', function() {
      this.value = this.value.replace(/[^0-9]/g, '');
    });

    function timeRead(id) {

      var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
      var url = window.location.origin
      var ajaxUrl = url + '/iniciarContador/' + id;
      console.log(ajaxUrl);
      request.open("get", ajaxUrl, true);
      request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
      request.send();
      console.log(request);
    }
  </script>
  <script type="text/javascript"
    src="https://cdn.datatables.net/v/bs/dt-1.11.4/b-2.2.2/b-html5-2.2.2/r-2.2.9/datatables.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/viewerjs/1.10.4/viewer.common.js"
    integrity="sha512-tO8TIHa2E4zvKYXmSk7QTrjyNbJ1vDW5wXeobD0yYTf4qN+q+PRR6D2KBju4EE79eYWMzJzTwWr7LGPBdGTyhg=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
@endsection
