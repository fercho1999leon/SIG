@php

namespace App\Http\Controllers;

use App\Http\Controllers\LibroController;
use App\Http\Controllers\AutorController;
use App\Http\Controllers\CategoriaController;

use App\Http\Controllers\LibroAutorController;
use App\Http\Controllers\LibroCursoController;
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
        <h2 class="title-page text-uppercase">Libros</h2>
      </div>
    </div>
    <div class="row wrapper">
      <div class="col-xs-12 p-1 bg-black">
        <h1 class="text-uppercase text-white" style="text-align: center">Bienvenido a Libros Curso</h1>
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
              <th>Curso</th>
              @if ($usuario->cargo != 'Estudiante')
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
                  $curso_libro = LibroCursoController::getCourseByBook($libro->id);
                @endphp
                @if ($autor_libro != null && $categoria_libro != null && $curso_libro != null)
                  @if ($autor_libro->is_active == 1 && $autor_libro->is_verified == 1 && $categoria_libro->is_active == 1)
                    @if ($curso_libro->libro_id == $libro->id)
                      <tr>
                        <th style="text-align: center;">{{ $libro->id }}</th>
                        <th style="text-align: center;">{{ $autor_libro->slug }}</th>
                        <th style="text-align: center;">{{ $categoria_libro->slug }}</th>
                        <th style="text-align: center;">{{ $libro->slug }}</th>
                        <th style="text-align: center;"><a href="libros/{{ $libro->file_url }}"
                            onclick="timeRead($libro->id)" target="_blank">Ver
                            Libro</a>
                        </th>
                        @foreach ($cursos as $curso)
                          @if ($curso->id == $curso_libro->curso_id)
                            <th style="text-align: center;">{{ $curso->grado }}
                              {{ $curso->paralelo }}</th>
                          @endif
                        @endforeach
                        @if ($usuario->cargo != 'Estudiante')
                          <th style="text-align: center;">
                            {{-- <a class="btn btn-success" href="{{route('editLibros', $libro->id)}}">Modificar</a>
                        <a class="btn btn-danger autorizar" href="{{route('destroyLibros', $libro->id)}}">Eliminar</a> --}}
                          </th>
                        @endif
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
          <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#modalCrear">Asignar
            Libro</button>
          <div id="modalCrear" class="modal fade" role="dialog">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <h4 class="modal-title">Crear nuevo Libro</h4>
                </div>
                <form action="{{ route('storeLibrosCurso') }}" method="POST" enctype="multipart/form-data">
                  {{ csrf_field() }}
                  <div class="modal-body">
                    <div class="row form-group">
                      <div class="col-xs-6 p-1">
                        <label for="carrera">Carrera</label>
                      </div>
                      <div class="col-xs-6 p-1">
                        <select class="form-control text-uppercase" name="carrera" id="carrera">
                          <option value="">-Seleccione-</option>
                          @foreach ($carreras as $carrera)
                            <option value="{{ $carrera->id }}">{{ $carrera->nombre }}</option>
                          @endforeach
                        </select>
                      </div>
                    </div>
                    <div class="row form-group">
                      <div class="col-xs-6 p-1">
                        <label for="semestre">Semestre</label>
                      </div>
                      <div class="col-xs-6 p-1">
                        <select class="form-control text-uppercase" name="semestre" id="semestre">
                        </select>
                      </div>
                    </div>
                    <div class="row form-group">
                      <div class="col-xs-6 p-1">
                        <label for="curso">Curso</label>
                      </div>
                      <div class="col-xs-6 p-1">
                        <select class="form-control text-uppercase" name="curso" id="curso">
                        </select>
                      </div>
                    </div>
                    <div class="row form-group">
                      <div class="col-xs-6 p-1">
                        <label for="libro">Libro</label>
                      </div>
                      <div class="col-xs-6 p-1">
                        <select class="form-control text-uppercase" name="libro" id="libro">
                          <option value="">-Seleccione-</option>
                          @foreach ($libros as $libro)
                            @if ($libro->is_active == 1)
                              <option value="{{ $libro->id }}">{{ $libro->slug }}</option>
                            @endif
                          @endforeach
                        </select>
                      </div>
                    </div>
                  </div>
                  <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Asignar</button>
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
  </script>
  <script type="text/javascript"
    src="https://cdn.datatables.net/v/bs/dt-1.11.4/b-2.2.2/b-html5-2.2.2/r-2.2.9/datatables.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/viewerjs/1.10.4/viewer.common.js"
    integrity="sha512-tO8TIHa2E4zvKYXmSk7QTrjyNbJ1vDW5wXeobD0yYTf4qN+q+PRR6D2KBju4EE79eYWMzJzTwWr7LGPBdGTyhg=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script>
    $("#carrera").on('change', function() {
      if ($(this).val() != '') {
        var idCarrera = $(this).val();
        $.get('/api/semestresPorCarrera/' + idCarrera + '', function(semestre) {
          var html_datos = '<option>Seleccione</option>';
          for (var i = 0; i < semestre.length; i++) {
            html_datos += '<option class="text-uppercase" value="' + semestre[i].id +
              '">' + semestre[i].nombsemt + '</option>	';
          }
          $('#semestre').html(html_datos);
        })
      }
    });
    $("#semestre").on('change',
      function() {
        if ($(this).val() != '') {
          idSemestre = $(this).val();
          var html_datos = '<option> Seleccione</option>';
          $.get('/api/postAccedeParalelos/' + idSemestre + '', function(data) {
            for (var i = 0; i < data.length; i++) {
              html_datos += '<option class="text-uppercase" value="' + data[i].id + '">Paralelo ' + data[i]
                .paralelo + '</option>	';
            }
            $('#curso').html(html_datos);
          })
        }
      });

   
  </script>
@endsection
