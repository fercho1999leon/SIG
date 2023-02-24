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
    <div class="row wrapper white-bg titulo-separacion noBefore">
        <div class="col-xs-12 titulo-separacion">
            <h2 class="title-page">Verificación del Pago del Estudiante</h2>
            <p>
                {{--dd($estudiante,$user_data)--}}
            </p>
        </div>     
    </div>
    <div class="row wrapper" style="overflow-x: auto !important;">
        <br>
        <div class="col-md-10">
           





            <form method="post" action="{{route('verificacionPagoStore')}}" name="pagoEstudiante" id="pagoEstudiante" enctype="multipart/form-data">
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
                            <input type="hidden" name="idCuenta" id="idCuenta" value="{{$cuentaxpagar->id}}">
                          </tr>
                          <tr>
                            <td>Valor Total de la Cuenta</td>
                            <td id="celCantidadTotal">{{$cuentaxpagar->credito}}</td>
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
                                @if($cuentaxpagar->valor_comprobante != '')
                                <label for="">{{$cuentaxpagar->valor_comprobante}}</label>
                                @endif
                                @if($cuentaxpagar->valor_comprobante == '')
                                <label for="">ESTUDIANTE NO HAY REGISTRADO PAGO</label>
                                @endif
                            </div>
                            <div class="col-md-2">
                                Fecha de Pago
                            </div>
                            <div class="col-md-4">
                                @if($cuentaxpagar->fecha_comprobante != '')
                                <label for="">{{$cuentaxpagar->fecha_comprobante}}</label>
                                @endif
                                @if($cuentaxpagar->fecha_comprobante == '')
                                <label for="">NO EXISTE FECHA DE CARGA DE DOCUMENTO DE RESPALDO</label>
                                @endif
                                
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-3">
                                Comprobante de Respaldo 
                            </div>
                            <div class="col-md-9">
                                @if($cuentaxpagar->comprobante_img != '')
                                <img src="{{secure_asset('img/comprobantesPago/'.$cuentaxpagar->comprobante_img)}}" width="70%" alt="">
                                @endif
                                @if($cuentaxpagar->comprobante_img == '')
                                <img src="{{secure_asset('img/comprobantesPago/noImagen.webp')}}" width="70%" alt="No hay Comprobante Cargado">
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-3">
                                <label for="forma_pago" class="form-control">Forma de pago</label>
                            <select name="forma_pago" id="forma_pago" class="form-control">
                                <option default>Seleccione</option>
                                <option value="Efectivo">Efectivo</option>
                                <option value="Deposito">Deposito</option>
                                <option value="Transferencia">Transferencia</option>
                                <option value="Transferencia">Transferencia</option>
                            </select>
                            </div>
                            <div class="col-md-5">
                                <label for="observaciones_pago" class="form-control">Observaciones</label>
                                <input type="text" class="form-control" name="observaciones_pago" id="observaciones_pago" require>
                            </div>
                            <div class="col-md-4">
                                <label for="num_factura" class="form-control">N° Factura</label>
                                <input type="text" class="form-control" name="num_factura" id="num_factura" value="{{$cuentaxpagar->num_factura}}" require> 
                            </div>
                        </div>
                    </div>

                    <input type="hidden" id="ruta" value="{{route('verificacionPagoStore',$cuentaxpagar->id)}}">
                    @if($cuentaxpagar->valor_comprobante != '' || $cuentaxpagar->comprobante_img != '' )
                    
                    <button type="submit"  data-toggle="tooltip" data-original-title="Guardar Pago" aria-hidden="true" class="btn btn-primary pull-right">
                        <i class="fa fa-money "></i> &nbsp;Procesar Pago
                    </button>
                    @endif
                    @if($cuentaxpagar->valor_comprobante == '' || $cuentaxpagar->comprobante_img == '' || $cuentaxpagar->fecha_comprobante == '')
                    
                    <button type="submit" data-toggle="tooltip" data-original-title="Guardar Pago" aria-hidden="true" disabled class="btn btn-primary pull-right">
                        <i class="fa fa-money "></i> &nbsp;Procesar Pago
                    </button>
                    @endif

                    <a href="{{ route('cancelarPago',$cuentaxpagar->id) }}" class="btn btn-primary" title="Cancelar El Comprobante">Cancelar el Pago <i class="fa fa-money" aria-hidden="true"></i></a>
                    
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
    var comprobante_id = $('#idCuenta').val();
    var urlAjax = $('#ruta').val();
    var formaPago = $('#forma_pago').val();
    var observacionesPago = $('#observaciones_pago').val();
    console.log(urlAjax);
   
</script>




@endsection