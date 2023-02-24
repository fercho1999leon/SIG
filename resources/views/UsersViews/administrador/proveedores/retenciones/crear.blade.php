@extends('layouts.master')
@section('content')
<div id="page-wrapper" class="gray-bg dashbard-1">
    @include('layouts.nav_bar_top')
    <div class="row wrapper white-bg ">
        <div class="col-lg-12 titulo-separacion">
            <h2 class="title-page">
                Retenciones
                <small>
                    <u>Nueva Retención</u>
                </small>
            </h2>
        </div>
    </div>
    <div class="row mt-1">
        <div class="col-lg-12">
            <div class="panel pl-1 pr-1 matricula__matriculacion">
                <form method="post" action="{{ route('retencion_store') }}" enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}"> 
                        <div>
                            <div class="matricula__matriculacion__input">
                                <label for="" class="matricula__matriculacion-label">Pago realizado</label>
                                <select class="form-control input-sm" name="pago" required>
                                    <option value="">Opcion</option>
                                    @foreach($pagos as $pago)
                                        <option value="{{$pago->id}}">
                                            {{$pago->descripcion}}
                                            @foreach($proveedores as $proveedor)
                                                @if($pago->id_proveedor==$proveedor->id)
                                                    - {{$proveedor->nombre_comercial}}
                                                @endif
                                            @endforeach
                                            - USD{{$pago->total}}
                                        </option>
                                    @endforeach
                                    
                                </select>
                            </div>
                            {{--
                                <div class="matricula__matriculacion__input">
                                    <label for="" class="matricula__matriculacion-label">Proveedor</label>
                                    <select class="form-control input-sm" name="sexo" disabled>
                                        <option value="Opcion">Opcion</option>
                                    </select>
                                </div>
                            --}}
                            <div class="matricula__matriculacion__input">
                                <label for="" class="matricula__matriculacion-label">
                                    Fecha Emision Retencion
                                </label>
                                <small style="color: red"> (Si no ingresa la fecha, se pondrá por defecto la de hoy)</small>
                                <input type="date" class="form-control input-sm" name="fecha_emision_retencion">
                            </div>
                            {{--
                                <div></div>
                                <div class="matricula__matriculacion__input">
                                    <label for="" class="matricula__matriculacion-label">Valor</label>
                                    <input type="number" step="0.01 "min="0.01" max="99999.99" class="form-control input-sm" name="nombres" disabled>
                                </div>
                                <div></div>
                            --}}
                            <div class="matricula__matriculacion__input">
                                <label for="" class="matricula__matriculacion-label">Retención a la fuente</label>
                                <select class="form-control input-sm" name="retencion_fuente">
                                    <option value="">Opcion</option>
                                    @foreach($codigos_retenciones as $c_r)
                                        <option value="{{$c_r->id}}" style="text-justify">{{$c_r->campo_formulario}} {{$c_r->porcentajes}}%</option>
                                    @endforeach
                                </select>
                            </div>
                            <div></div>

                            <div class="matricula__matriculacion__input">
                                <label for="" class="matricula__matriculacion-label">Retención al iva</label>
                                <select class="form-control input-sm" name="retencion_iva">
                                    <option value="">Ninguna</option>
                                    @foreach($codigos_iva as $c_i)
                                        <option value="{{$c_i->id}}">
                                            {{$c_i->porcentaje}}
                                        </option>
                                    @endforeach                            
                                </select>
                            </div>
                            <div></div>
                            
                            {{--
                                <div class="matricula__matriculacion__input">
                                    <label for="" class="matricula__matriculacion-label">Total</label>
                                    <input type="number" step="0.01 "min="0.01" max="99999.99" class="form-control input-sm" name="nombres">
                                </div>
                                <div class="matricula__matriculacion__input">
                                    <label for="" class="matricula__matriculacion-label">Total Retenido</label>
                                    <input type="number" step="0.01 "min="0.01" max="99999.99" class="form-control input-sm" name="nombres">
                                </div>
                                <div class="matricula__matriculacion__input">
                                    <label for="" class="matricula__matriculacion-label">Saldo</label>
                                    <input type="number" step="0.01 "min="0.01" max="99999.99" class="form-control input-sm" name="nombres">
                                </div>
                                <div></div>
                            --}}

                            <div class="matricula__matriculacion__input">
                                <label for="" class="matricula__matriculacion-label">Numero Documento</label>
                                <input type="text" class="form-control input-sm" name="numero_documento" min="15" maxlength="15" required>
                            </div>
                            <div></div>
                            <div class="matricula__matriculacion__input">
                                <label for="" class="matricula__matriculacion-label">Fecha Emision Documento</label>
                                <input type="date" class="form-control input-sm" name="fecha_documento">
                            </div>            
                        </div>
                    

                    <div class="text-right">
                        <input type="submit" class="mb-1 btn btn-primary btn-lg" value="Generar_Retencion">
                    </div>
                </form>
            </div>            
        </div>
    </div>
</div>
    {{--
        Select del pago
            'id_pagos_realizados'        
        Select del proveedor
            'id_proveedores'
        Date
            'fecha_emision'
        Float
            'neto'
        Select de retencion a la fuente
            'retencion_fuente'
        Select de retencion al iva      
            'retencion_iva'
        Float total valor
            'total'
        Float total retenido      
            'retenido'
        Float total saldo
            'saldo'
        Input documento
            'numero_documento', 100
        Input documento autorizado
            'autorizacion', 100
    --}}
@endsection
@section('scripts')
<script src="{{secure_asset('js/datatables.js')}}"></script>
<script src="{{secure_asset('js/datatableCustom.js')}}"></script>
@endsection