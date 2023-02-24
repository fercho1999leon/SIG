<!DOCTYPE html>
<html>
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <link href="{{ secure_asset('font-awesome/css/font-awesome.css')}}" rel="stylesheet">
    <link href="{{ secure_asset('css/style.css')}}" rel="stylesheet">
    <style type="text/css" media="screen">
      .matricula__matriculacion-block {
      display: block;
      }
    </style>

  </head>
  <body>
    @include('layouts.messages')
  <div class="container">
     <div id="respuesta"></div>
      <div class="row">
        <div class="col-sm-4 mt-3" >
          <div class="card">
            <div class="card-header">
              <div class="row">
                <div class="col-sm-4 mt-3" >
              <img
                @if(DB::table('institution')->where('id', '1')->first()->logo == null)
                  src="{{ secure_asset('img/logo/logo.png') }}"
                @else
                  src="{{ secure_asset('/storage/logo/'.DB::table('institution')->where('id', '1')->first()->logo) }}"  width="70"
                @endif
              alt="" width="70">
               </div>
               <div class="col-sm-8 mt-3" >
              <h2 class="card-title">Datos Generales</h2>
            </div>
          </div>
            </div>
            <div class="card-body">
              <div id="datosOriginales">                
              <p class="card-text"><strong>Estudiante:</strong> {{$students->nombres}} {{$students->apellidos}}</p>
              
              @forelse($padres as $padre)
              <!--
              <p class="card-text"><strong>Padre:</strong> {{$padre->nombres}} {{$padre->apellidos}}</p>
              -->
              @empty
              <!--
               <p class="card-text"><strong>Padre:</strong></p>
               -->
              @endforelse
              @forelse($madres as $madre)
              <!--
              <p class="card-text"><strong>Madre:</strong> {{$madre->nombres}} {{$madre->apellidos}}</p>
              -->
              @empty
              <!--
               <p class="card-text"><strong>Madre:</strong></p>
              -->
              @endforelse
              <!--
              <p class="card-text"><strong>Representante:</strong> {{$representantes->id!='' ? $representantes->nombres.' '.$representantes->apellidos : ''}} </p>
              <p class="card-text"><strong>Repr. Financiero:</strong> {{$clientes->id!='' ? $clientes->nombres.' '.$clientes->apellidos : ''}}</p>
              -->
              </div>
              <div id="datosNuevos"></div>
            </div>
          </div>
        </div>
        <div class="col-sm-8 mt-3" >
          <div class="card">
            <div class="card-header">
                  <div class="row">
                    <div class="col-sm-3 mt-3" >
                    <img
                      @if(DB::table('institution')->where('id', '1')->first()->logo == null)
                        src="{{ secure_asset('img/logo/logo.png') }}"
                      @else
                        src="{{ secure_asset('/storage/logo/'.DB::table('institution')->where('id', '1')->first()->logo) }}"  width="70"
                      @endif
                    alt="" width="70">
                     </div>
                     <div class="col-sm-6 mt-3" >
                    <h2 class="card-title">Actualización de datos generales</h2>
                    </div>
                    <div class="col-sm-3 mt-3" align="right">
                    <img
                        src="{{ secure_asset('img/logo/logo_pinedVertical.png') }}"
                    alt="" width="100">
                     </div>
                  </div>
                </div>
            <div class="card-body">
                <div id="pasosPanel" class="col-xs-6 mt-1">
                @section('PasoAPaso')
                @endsection
                </div>
            </div>
          </div>
        </div>
  </div>
</div>
</div>
<div class="modal fade" id="mostrarModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
</div>

  </body>
</html>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js" integrity="sha384-q2kxQ16AaE6UbzuKqyBE9/u/KzioAlnx2maXQHiDX9d4/zp8Ok3f+M7DPm+Ib6IU" crossorigin="anonymous"></script>
<script src="{{ secure_asset('js/theme-js.js') }}"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-pQQkAEnwaBkjpqZ8RU1fF1AKtTcHJwFl3pblpTlHXybJjHpMYo79HY3hIi4NKxyj" crossorigin="anonymous"></script>
<script type="text/javascript">

   function ajaxRenderSectionUnidades(url) {
        $.ajax({
            type: 'GET',
            url: url,
            dataType: 'json',
            success: function (data) {
                $('#pasosPanel').empty().append($(data));
            },
            error: function (data) {
                var errors = data.responseJSON;
                if (errors) {
                    $.each(errors, function (i) {
                        console.log(errors[i]);
                    });
                }
            }
        });
    }
  function reloadDatosGenerales(){
    $.ajax({
            url: "{{route('verDatos',[$students])}}",
            type: "GET",
            success: function (result, status, xhr) {
              $('#nuevo').hide();
              $('#respuesta').show();
              $('#datosOriginales').remove();
              $('#datosNuevos').html(result)
            }, error: function (xhr, status, error) {
                alert('error')
            }
        });
  }
  function updateDatosGenerales($pos){
    var id_padre = $('#id_padre').val()
    var id_madre = $('#id_madre').val()
    var id_representante = $('#id_representante').val()
    var id_financiero = $('#id_financiero').val()
    var estudiante = $('#estudiante').val()
    var ci = $('#ci').val()
    var _token = $('#_token').val()
    $.ajax({
            url: '{{route('actEstuAdmision')}}',
            type: "POST",
            data :{ id_padre: id_padre,
                    id_madre: id_madre,
                    id_representante: id_representante,
                    id_financiero: id_financiero,
                    ci: ci,
                    _token: _token,
                    estudiante: estudiante },
             success: function (data) {
                Swal.fire({
                position: 'top-end',
                icon: 'success',
                title: 'Representante Actualizado',
                showConfirmButton: false,
                timer: 1500,
                });
                 reloadDatosGenerales();
                 ver_PasoPaso($pos);
            }, error: function (xhr, status, error) {
                mensaje ='<div class="alert alert-danger" role="alert">'+xhr['responseText']+'</div>';
                $('#respuesta').html(mensaje)
            }
        });
  }

  function ver_PasoPaso($act){
    if($act == null){
      var $act = '1';
    }
        $.ajax({
            url: '{{route('verPasos',[$students])}}',
            type: "GET",
            data :{ activo: $act },
             success: function (data) {
                $('#pasosPanel').empty().append($(data));
            }, error: function (xhr, status, error) {
                mensaje ='<div class="alert alert-danger" role="alert">'+xhr['responseText']+'</div>';
                $('#respuesta').html(mensaje)
            }
        });
  }
 $(document).ready(function() {
      ver_PasoPaso();
      $('.carousel').carousel('pause');
       $('.carousel').carousel({interval: false,
        });
     });
    function VerPadre(genero) {
    var url = window.location.origin
    if (genero == 'P') {
    var id_padre = $('#id_padre').val()
    }else{
    var id_padre = $('#id_madre').val()
    }
    var estu = $('#estudiante').val()
    var url_completa = url+'/admisiones/modal-padres/?q='+id_padre+'&estu='+estu+'&paren='+genero
    if (id_padre!= '') {
          $.ajax({
            url: url_completa,
            type: "GET",
            success: function (result, status, xhr) {
                $('#mostrarModal').html(result)
                $('#mostrarModal').modal('show')
            }, error: function (xhr, status, error) {
                alert('error')
            }
        });
        }
      }/*
      $('#editar_padre').click(function() {
    var url = window.location.origin
    var id_padre = $('#id_padre').val()
    var estu = $('#estudiante').val()
    var url_completa = url+'/admisiones/padres/'+id_padre+'/'+estu+'/P';
    $("#editar_padre").attr("href",url_completa);
    });*/
      function editarPadre(genero) {
    var url = window.location.origin
    if (genero == 'P') {
    var id_padre = $('#id_padre').val()
    }else{
    var id_padre = $('#id_madre').val()
    }
    var estu = $('#estudiante').val()
    var url_completa = url+'/admisiones/padres/'+id_padre+'/'+estu+'/'+genero
    if (id_padre!= '') {
         $.ajax({
            url: url_completa,
            type: "GET",
            success: function (result, status, xhr) {
                $('#mostrarModal').html(result)
                $('#mostrarModal').modal('show')
            }, error: function (xhr, status, error) {
                alert('error')
            }
        });
       }
      }
      function CrearPadre(gen) {
    var url = window.location.origin
    var estu = $('#estudiante').val()
    var url_completa = url+'/admisiones/padre_crear/'+estu+'/'+gen
         $.ajax({
            url: url_completa,
            type: "GET",
            success: function (result, status, xhr) {
                $('#mostrarModal').html(result)
                $('#mostrarModal').modal('show')
            }, error: function (xhr, status, error) {
                alert('error')
            }
        });

      }
      function VerCliente() {
    var url = window.location.origin
    var id_financiero = $('#id_financiero').val()
    var estu = $('#estudiante').val()
    var url_completa = url+'/admisiones/modal-cliente/?q='+id_financiero+'&estu='+estu
    if (id_financiero!='') {
          $.ajax({
            url: url_completa,
            type: "GET",
            success: function (result, status, xhr) {
                $('#mostrarModal').html(result)
                $('#mostrarModal').modal('show')
            }, error: function (xhr, status, error) {
                alert('error')
            }
        });
          }
      }
      function editarCliente() {
    var url = window.location.origin
    var id_financiero = $('#id_financiero').val()
    var estu = $('#estudiante').val()
    var url_completa = url+'/admisiones/clientes/'+id_financiero+'/'+estu;
         $.ajax({
            url: url_completa,
            type: "GET",
            success: function (result, status, xhr) {
                $('#mostrarModal').html(result)
                $('#mostrarModal').modal('show')
            }, error: function (xhr, status, error) {
                alert('error')
            }
        });
      }
       function CrearCliente() {
    var url = window.location.origin
    var id_financiero = $('#id_financiero').val()
    var estu = $('#estudiante').val()
    var url_completa = url+'/admisiones/cliente_crear/'+estu;
         $.ajax({
            url: url_completa,
            type: "GET",
            success: function (result, status, xhr) {
                $('#mostrarModal').html(result)
                $('#mostrarModal').modal('show')
            }, error: function (xhr, status, error) {
                alert('error')
            }
        });

      }

    function editarRepresentante() {
    var url = window.location.origin
    var id_representante = $('#id_representante').val()
    var estu = $('#estudiante').val()
    var url_completa = url+'/admisiones/representante/'+id_representante+'/'+estu;
         $.ajax({
            url: url_completa,
            type: "GET",
            success: function (result, status, xhr) {
                $('#mostrarModal').html(result)
                $('#mostrarModal').modal('show')
            }, error: function (xhr, status, error) {
                alert('error')
            }
        });

      }
      function CrearRepresentante() {
        var url = window.location.origin
        var estu = $('#estudiante').val()
        var url_completa = url+'/admisiones/representante_crear/'+estu;
        $.ajax({
            url: url_completa,
            type: "GET",
            success: function (result, status, xhr) {
                $('#mostrarModal').html(result)
                $('#mostrarModal').modal('show')
            }, error: function (xhr, status, error) {
                alert('error')
            }
        });
      }
    function VerRepresentante() {
    var url = window.location.origin
    var id_representante = $('#id_representante').val()
    var estu = $('#estudiante').val()
    var url_completa =url+'/admisiones/modal-representante/?q='+id_representante+'&estu='+estu
    if (id_representante!='') {
      $.ajax({
            url: url_completa,
            type: "GET",
            success: function (result, status, xhr) {
                $('#mostrarModal').html(result)
                $('#mostrarModal').modal('show')
            }, error: function (xhr, status, error) {
                alert('error')
            }
        });
    }

      }
      function finalizar() {
        var r = confirm("Al finalizar no podrá actualizar nuevamente");
        if (r == true) {
        var url = window.location.origin
        var estu = $('#estudiante').val()
        var url_completa = url+'/admisiones/finalizar/'+estu;
        $("#Fin").attr("href",url_completa);
        }
      }
</script>