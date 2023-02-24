@extends('layouts.master2')
@section('assets')
  <link rel="stylesheet" type="text/css"
    href="https://cdn.datatables.net/v/bs/dt-1.11.4/b-2.2.2/b-html5-2.2.2/r-2.2.9/datatables.min.css" />
@endsection

@php
use App\Http\Controllers\CategoriaController;

$categorias = CategoriaController::getAllCategories();
@endphp

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
        <h1 class="text-uppercase text-white" style="text-align: center">Sección Categorias</h1>
      </div>
    </div>
    <div class="row wrapper">
      <div class="col-xs-12 bg-white p-1">
        <table id="tablaCategorias" class="table table-bordered " style="width:100%;">
          <thead>
            <tr class="bg-black text-white">
              <th>ID</th>
              <th>Nombre Categoría</th>
              <th>Estado</th>
              <th>Acciones</th>
            </tr>
          </thead>
          <tbody>
            @if ($categorias != null)
              @foreach ($categorias as $categoria)
                <tr>
                  <th style="text-align: center;">{{ $categoria->id }}</th>
                  <th style="text-align: center;">{{ $categoria->slug }}</th>
                  <th style="text-align: center;">
                    @if ($categoria->is_active == 1)
                      <span class="text-info text-uppercase">Activo</span>
                    @else
                      <span class="text-danger text-uppercase">Inactivo</span>
                    @endif
                  </th>
                  <th style="text-align: center;">
                    <a class="btn btn-success" href="{{ route('editCategorias', $categoria->id) }}">Modificar</a>
                    <a class="btn btn-danger autorizar"
                      href="{{ route('destroyCategorias', $categoria->id) }}">Eliminar</a>
                  </th>
                </tr>
              @endforeach
            @endif
          </tbody>
        </table>
      </div>
    </div>

    <div class="row wrapper text-right">
      <div class="col-xs-12 bg-white p-1">
        {{-- CREACIÓN --}}
        <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#modalCrear">Crear
          Categoria</button>
        <div id="modalCrear" class="modal fade" role="dialog">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Crear nueva Categoria</h4>
              </div>
              <form action="{{ route('storeCategorias') }}" method="POST">
                {{ csrf_field() }}
                <div class="modal-body">
                  <div class="row form-group">
                    <div class="col-xs-6 p-1">
                      <label for="nombre_categoria">Nombre Categoria</label>
                    </div>
                    <div class="col-xs-6 p-1">
                      <input class="form-control" type="text" name="nombre_categoria" id="nombre_categoria" required>
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
  @endsection

  @section('scripts')
    <script>
      $(document).ready(function() {
        $('#tablaCategorias').DataTable({
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
        var bool = (confirm("¿Está seguro que desea ELIMINAR esta Categoria?"))
        if (bool != true) {
          event.preventDefault();
        }
      });
    </script>
    <script type="text/javascript"
        src="https://cdn.datatables.net/v/bs/dt-1.11.4/b-2.2.2/b-html5-2.2.2/r-2.2.9/datatables.min.js"></script>
  @endsection
