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
            <h2 class="title-page">Proceso de Pago de Cuenta por Cobrar</h2>
            <p>
                {{--dd($estudiante,$user_data)--}}
            </p>
        </div>     
    </div>
    <div class="row wrapper" style="overflow-x: auto !important;">
        <br>
        <div class="col-md-10">
           





            <form method="post" action="{{route('pagoEstudianteManualProcesado')}}" enctype="multipart/form-data" id="pago">
                {{csrf_field()}}
                <div class="modal-body">
                    <table class="table table-bordered">
                      <tbody>
                        <tr>
                          <td>C.I. Estudiante:</td>
                          <td id="celCedula"> {{$studiante->ci}}</td>
                          <input type="hidden" name="cedulaEstudiante" value="{{$studiante->ci}}">
                        </tr>
                        <tr>
                          <td>Nombres y Apellidos del Estudiante:</td>
                          <td id="celNombre">{{$studiante->nombres}} {{$studiante->apellidos}}</td>
                        </tr>
                        <tr>
                            <td>Carrera</td>
                            <td id="celCarrera">{{$carrera->nombre}}</td>
                          </tr>
                        <tr>
                          <td>Numero de Matricula</td>
                          <td id="celMatricula">{{$cliente->numero_matriculacion}}</td>
                        </tr>
                        <tr>
                          <td>Nivel / Semestre</td>
                          <td id="celSemestre">{{$curso->grado}}</td>
                        </tr>
                        
                      </tbody>
                    </table>
                    <table class="table table-bordered">
                        <tbody>
                          <tr>
                            <td>Concepto de Pago:</td>
                            <td id="celConcepto">{{$cuentaxpagar->concepto}}</td>
                            <input type="hidden" name="conceptoPagoEstudiante" value="{{$cuentaxpagar->concepto}}">
                            <input type="hidden" name="idCuenta" value="{{$cuentaxpagar->id}}">
                          </tr>
                          <tr>
                            <td>Valor Total de la Cuenta</td>
                            <td id="celCantidadTotal">{{$cuentaxpagar->debito}}</td>
                          </tr>
                          <tr>
                            <td>Saldo</td>
                            <td id="celSaldo">{{$cuentaxpagar->saldo}}</td>
                          </tr>
                        </tbody>
                      </table>
                      <div class="form-group">
                        <div class="row">
                            <div class="col-md-3">
                                Valor a Cancelar
                            </div>
                            <div class="col-md-3">
                                <input type="number" id="valor_cancelar" name="valor_cancelar" class="form-control validador_numero2 usd2" step="any" placeholder="0.00" required>
                            </div>
                            <div class="col-md-2">
                                Fecha de Pago
                            </div>
                            <div class="col-md-4">
                                <input type="date" id="fecha_pago" name="fecha_pago" class="form-control" required>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-3">
                                Observaciones: 
                            </div>
                            <div class="col-md-9">
                                <input type="text" id="observaciones" name="observaciones" class="form-control" required>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-3">
                                Forma de Pago: 
                            </div>
                            <div class="col-md-6">
                                <select name="forma_pago" id="forma_pago" class="form-control" required>
                                 <option >Seleccione</option>
                                 <option value="Efectivo" selected>Efectivo</option>
                                 <option value="Deposito">Deposito</option>
                                 <option value="Transferencia">Transferencia</option>
                                 <option value="Transferencia">Transferencia</option>
                             </select>
                             </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-3">
                                <label for="num_factura" >N° Factura</label>
                                
                            </div>
                            <div class="col-md-6">
                                
                                <input type="text" class="form-control" name="num_factura" id="num_factura" value="{{$cuentaxpagar->num_factura}}" > 
                            </div>        
                        </div>
                    </div>

                    
                    <button type="submit" onclick="eliminarEstudiante()" data-toggle="tooltip" data-original-title="Guardar Pago" aria-hidden="true" class="btn btn-primary pull-right">
                        <i class="fa fa-money "></i> &nbsp;Guardar
                    </button>
                </div>

                
            </form>
        </div>    
    </div>  
    
		<a class="button-br" href="{{ route('cuentasporcobrar') }}">
		    <button>
			    <img src="{{secure_asset('img/return.png')}}" alt="" width="17"> Regresar
		    </button>
	    </a>
    
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


    
</script>
@endsection