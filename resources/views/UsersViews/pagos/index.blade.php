@extends('layouts.master')
@section('content')
@include('partials.loader.loader')
@php
use app\Cliente;
$user = Sentinel::getUser();
    $user = App\Administrative::where('userid', $user->id)->first();
@endphp
@if($user->cargo=='Administrador')
<div id="page-wrapper" class="gray-bg dashbard-1">
    <!-- Incluir el nav_bar_top Cerrar Sesion -->
    @include('layouts.nav_bar_top')
    <div class="col-md-12 animated fadeInRight">
      <div class="studentNotificaciones__header">
        <h2 class="no-margin">Historico de pagos</h2>
        <div class="studentNotificaciones__header--calendar">
        </div>
        <table>
          <tr><td>

        <input class="form-control" onkeyup="searchit()"  id='buscar' type="search" placeholder="Buscar" aria-label="Search">
        </td>
          <td> <input class="form-control"   id="buscarDate" type="date" placeholder="Buscar" >
          </td>
          <td>
          <button class="btn btn-navbar" onclick="searchit2()">
            <i class="fa fa-search"></i>
          </button>
          </td></tr>
          </table>
        </div>
    <div id="principalPanel">
      @section('contentPanel')
    
      @endsection       

    </div>
    <div id="pagination" onclick="getResults()">{{{ $historico->links() }}}</div>
    
    </div>
  </div>
  @else
  <div id="page-wrapper" class="gray-bg dashbard-1">
    <!-- Incluir el nav_bar_top Cerrar Sesion -->
    @include('layouts.nav_bar_top')
  <div class="col-md-12 animated fadeInRight">
      <div class="studentNotificaciones__header">
        <h2 class="no-margin">No tiene permisos para visualizar</h2>
        <div class="studentNotificaciones__header--calendar">
        </div>
      </div>
    </div>
  @endif
  @endsection
  <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
<script src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
<script type="text/javascript">
  $( document ).ready(function() {
        var url = window.location;   
       // alert(url)
   ajaxRenderSection(url);
   //alert(window.location.hash);

  });

  function ver_transaccion($id){
      //alert($id);
      axios.get('/pagos/ver-pago/'+$id)
      .then(response => {
      this.ver = response.data;
      Swal.fire({
      title: "Caracteristicas de la transacción",
      html: ver,
    });
      })
      .catch(e => {
      // Podemos mostrar los errores en la consola
      console.log(e);
      })

  }
   function eliminar_transaccion($id){
     var url = window.location; 
     Swal.fire({
      title: "Realmente desea eliminar la transacción",   
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Si',
      cancelButtonText: 'No'
      }).then((result) => {
          if (result.value==true) {
                axios.get('/pagos/eliminar-transaccion/'+$id)
                .then(response => {
                  ajaxRenderSection(url);
               // $('#mostrar_'+$id).css('display', 'none')
                })
                .catch(e => {
                // Podemos mostrar los errores en la consola
                console.log(e);
                })
            }
        });

  }
  function ajaxRenderSection(url) {
        $.ajax({
            type: 'GET',
            url: url,
            dataType: 'json',
            success: function (data) {
                $('#principalPanel').empty().append($(data)); 
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
      function searchit(){
      setTimeout(function(){
           axios.get('/pagos/search-PEL/?q='+$('#buscar').val())
                .then(response => {
                $('#principalPanel').empty().append($(response.data)); 

                })
                .catch(e => {
                // Podemos mostrar los errores en la consola
                console.log(e);
                })

       }, 200);   
    }
     function searchit2(){
      setTimeout(function(){
           axios.get('/pagos/search-PEL/?q='+$('#buscarDate').val())
                .then(response => {
                $('#principalPanel').empty().append($(response.data)); 

                })
                .catch(e => {
                // Podemos mostrar los errores en la consola
                console.log(e);
                })

       }, 200);
    }
 
</script>

