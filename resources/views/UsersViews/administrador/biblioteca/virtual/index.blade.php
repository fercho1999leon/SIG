@extends('layouts.master2')
@section('assets')
  <link rel="stylesheet" type="text/css"
    href="https://cdn.datatables.net/v/bs/dt-1.11.4/b-2.2.2/b-html5-2.2.2/r-2.2.9/datatables.min.css" />
@endsection

@php

  use App\Bibliotecavirtual;
  use App\SeccionBiblioteca;

  $virtual = Bibliotecavirtual::getAllConfig();
  $seccion = SeccionBiblioteca::getAllConfig();

@endphp

@section('content')
  <div id="page-wrapper" class="gray-bg dashbard-1">
    @include('layouts.nav_bar_top')
    <div class="row wrapper white-bg titulo-separacion noBefore">
      <div class="col-xs-12 titulo-separacion">
        <h2 class="title-page text-uppercase">Configuracion Biblioteca Virtual</h2>
      </div>
    </div>
    <div class="row wrapper">
      <div class="col-xs-12" style="min-width: min-content;">
        <div class="row wrapper">
          <div class="col-xs-12 p-1 bg-black">
            <h1 class="text-uppercase text-white" style="text-align: center">Sección de bibliotecas</h1>
          </div>
        </div>
        <div class="row wrapper">
          <div class="col-xs-12 bg-white p-1">
            <table id="tablaseccionbiblioteca" class="table table-bordered " style="width:100%;">
              <thead>
                <tr class="bg-black text-white">
                  <th>ID</th>
                  <th>Nombre Secciòn</th>
                  <th>Estado</th>
                  <th>Acciones</th>
                </tr>
              </thead>
              <tbody>
                @if ($seccion != null)
                  @foreach ($seccion as $config)
                    <tr>
                      <th style="text-align: center;">{{ $config->id }}</th>
                      <th style="text-align: center;">{{ $config->seccion }}</th>
                      <th style="text-align: center;">
                        @if ($config->is_active == 1)
                          <span class="text-info text-uppercase">Activo</span>
                        @else
                          <span class="text-danger text-uppercase">Inactivo</span>
                        @endif
                      </th>
                      <th style="text-align: center;">
                        <a class="btn btn-success" href="{{ route('BibliotecaSeccionupdate', $config->id) }}">Modificar</a>
                        <a class="btn btn-danger autorizar"
                          href="{{ route('BibliotecaSecciondestroy', $config->id) }}">Eliminar</a>
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
              Secciòn</button>
            <div id="modalCrear" class="modal fade" role="dialog">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Crear nueva Secciòn</h4>
                  </div>
                  <form action="{{ route('BibliotecaSeccion') }}" method="POST" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="modal-body">
                      <div class="row form-group">
                        <div class="col-xs-6 p-1">
                          <label for="nombre_seccion">Nombre de Seccion</label>
                        </div>
                        <div class="col-xs-6 p-1">
                          <input class="form-control" type="text" name="nombre_seccion" id="nombre_seccion" required>
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
      </div>

      <div class="col-xs-12" style="min-width: min-content;">
        <div class="row wrapper">
          <div class="col-xs-12 p-1 bg-black">
            <h1 class="text-uppercase text-white" style="text-align: center">Biblioteca virtual</h1>
          </div>
        </div>
        <div class="row wrapper">
          <div class="col-xs-12 bg-white p-1">
            <table id="tablavibliotecavirtual" class="table table-bordered " style="width:100%;">
              <thead>
                <tr class="bg-black text-white">
                  <th>ID</th>
                  <th>Nombre de biblioteca</th>
                  <th>Imagen</th>
                  <th>Url Biblioteca</th>
                  <th>Estado</th>
                  <th>Acciones</th>
                </tr>
              </thead>
              <tbody>
                @if ($virtual != null)
                  @foreach ($virtual as $config)
                    <tr>
                      <th style="text-align: center;">{{ $config->id }}</th>
                      <th style="text-align: center;">{{ $config->name }}</th>
                      <th style="text-align: center;">{{ $config->urlimage }}</th>
                      <th style="text-align: center;">{{ $config->urlbiblioteca }}</th>
                      <th style="text-align: center;">
                        @if ($config->is_active == 1)
                          <span class="text-info text-uppercase">Activo</span>
                        @else
                          <span class="text-danger text-uppercase">Inactivo</span>
                        @endif
                      </th>
                      <th style="text-align: center;">
                        <a class="btn btn-success" href="{{ route('BibliotecaVirtualupdate', $config->id) }}">Modificar</a>
                        <a class="btn btn-danger autorizar"
                          href="{{ route('BibliotecaVirtualdestroy', $config->id) }}">Eliminar</a>
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
            <button type="button" class="btn btn-primary btn-lg" id="btnAddBiblioteca" data-toggle="modal" data-target="#modalCrearbiblioteca">Crear
              Biblioteca Virtual</button>
            <div id="modalCrearbiblioteca" class="modal fade" role="dialog">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Crear nueva Biblioteca Virtual</h4>
                  </div>
                  <form action="{{ route('BibliotecaVirtual') }}" method="POST" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="modal-body">
                      <div class="row form-group">
                        <div class="col-xs-6 p-1">
                          <label for="nombre_biblioteca">Nombre de biblioteca</label>
                        </div>
                        <div class="col-xs-6 p-1">
                          <input class="form-control" type="text" name="nombre_biblioteca" id="nombre_biblioteca" required>
                        </div>
                      </div>
                      <div class="row form-group">
                        <div class="col-xs-6 p-1">
                          <label for="image">Imagen (PNG)</label>
                        </div>
                        <div class="col-xs-6 p-1">
                          <input type="file" name="image" id="image" accept=".png" required>
                        </div>
                      </div>
                      <div class="row form-group">
                        <div class="col-xs-6 p-1">
                          <label for="url_biblioteca">Url biblioteca</label>
                        </div>
                        <div class="col-xs-6 p-1">
                          <input class="form-control" type="text" name="url_biblioteca" id="url_biblioteca" required>
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
      </div>
    </div>
  @endsection

  @section('scripts')
  <script>
    if("{{$seccion->isEmpty()?0:1}}" == 0){
      $('#btnAddBiblioteca').prop('disabled', true);
    }
    $(document).ready(function() {
      $('#tablaseccionbiblioteca').DataTable({
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
    $(document).ready(function() {
      $('#tablavibliotecavirtual').DataTable({
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

