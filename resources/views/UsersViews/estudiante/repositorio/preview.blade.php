@php
$user_data = session('user_data');
$estudiante = session('estudiante');
$tMessages = session('tMessages');
use App\Student2;
use App\ConfiguracionSistema;
use Carbon\Carbon;
use App\Institution;

$institution = Institution::first();
@endphp
@extends('layouts.master2')
@section('assets')
@include('partials.loader.loader')

@endsection
@section('content')
<div id="page-wrapper" class="gray-bg dashbard-1">
    
    @include('barra.administrador')
    @if(Session::has('alertFalse'))
    <div class="alert alert-danger alert-block">
    {{Session::get('alertFalse')}}
    <button type="button" class="close" data-dismiss="alert">×</button>
    </div>
@endif
@if(Session::has('alertTrue'))
    <div class="alert alert-success alert-block">
    {{Session::get('alertTrue')}}
    <button type="button" class="close" data-dismiss="alert">×</button>
    </div>
@endif
    <div class="row wrapper white-bg titulo-separacion noBefore">
     

        <div class="col-xs-12 titulo-separacion">
            <h2 class="title-page">Repositorio {{$model->type_document_name}}: {{$model->title_document}}</h2>
            <p>
                {{--dd($estudiante,$user_data)--}}
            </p>
        </div>     
    </div>
    <div class="row wrapper" style="overflow-x: auto !important;">
        <br>
        <div class="col-md-10">
            
                <div class="modal-body">
                    <table class="table table-bordered">
                      <tbody>
                        <tr>
                            <td>Titulo del Documento:</td>
                            <td>{{$model->title_document}}</td>
                          </tr>
                        <tr>
                          <td>Autores:</td>
                          <td id="autores"> {{$model->authores}}</td>
                        </tr>
                        <tr>
                            <td>Carrera:</td>
                            <td id="celCarrera">{{$model->carrera}}</td>
                          </tr>
                          <tr>
                            <td>Promoción:</td>
                            <td id="celCarrera">{{$model->promotion}}</td>
                          </tr>
                        <tr>
                          <td>Nombre del Tutor:</td>
                          <td id="celMatricula">{{$model->tutor}}</td>
                        </tr>
                        <tr>
                          <td>Fecha de Publicación de la {{$model->type_document_name}}: </td>
                          <td id="celSemestre">{{$model->fecha_publicacion}}</td>
                        </tr>
                        <tr>
                            <td>Palabras Claves: </td>
                            <td id="celSemestre">{{$model->keywords}}</td>
                          </tr>
                          <tr>
                            <td>Editorial: </td>
                            <td id="celSemestre">{{$model->editorial}}</td>
                          </tr>

                          <tr>
                            <td>Resumen : </td>
                            <td id="celSemestre">{{$model->summary}}</td>
                          </tr>
                          <tr>
                            <td>Número de Páginas : </td>
                            <td id="celSemestre">{{$model->numberOfPages}}</td>
                          </tr>
                          <tr>
                            <td>Formato del Documento : </td>
                            <td id="celSemestre">{{$model->documentFormat}}</td>
                          </tr>
                          <tr>
                            <td>Estado : </td>
                            <td id="celSemestre">{{$model->estado}}</td>
                          </tr>
                          <tr>
                            @if($model->link != null )
                              <td>Link de Descarga : </td>
                              <td style="text-align: center;">
                                <a href="{{ route('repositorios',$model->link) }}"
                                target="_blank">Descargar {{$model->type_document_name}}</a>
                              </td>
                            @endif
                          </tr>
                      </tbody>
                    </table>
                   
                </div>

        </div>    
    </div>  
    
    @if ($tipoUser == 1)
    <a class="button-br" href="{{ route('repositorioEstudiante') }}">
      <button>
        <img src="{{secure_asset('img/return.png')}}" alt="" width="17"> Regresar
      </button>
    </a>    
    @else
    <a class="button-br" href="{{ route('repositorioGeneral') }}">
      <button>
        <img src="{{secure_asset('img/return.png')}}" alt="" width="17"> Regresar
      </button>
    </a>
    @endif
		
    
</div>
@endsection

@section('scripts')
<script>
    var url = "pagoEstudianteManualProcesado";
    var urlPago = "pagoEstudianteManualProcesado";
    var button = $('.eliminarEstudiante')
    var url = window.location.origin +urlPago;
    console.log(url);

function eliminarEstudiante() {
    $('#pago').submit(function(event) {
        event.preventDefault();

        Swal.fire({
        title: 'Seguro desea Procesar el Pago?',
        text: "Esta Acción es Irreversible",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'SI',
        cancelButtonText: 'NO'
    }).then((result) => {
        if (result.value) {
            Swal.fire(
                        'Pago Realizado con Exito!',
                        '',
                        'success'
                    );
                    setTimeout(event.target.submit(), 5000);
        }
    })

    }); 
    
}

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
@endsection