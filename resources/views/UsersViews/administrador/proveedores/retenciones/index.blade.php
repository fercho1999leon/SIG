@extends('layouts.master')
@section('content')
<div id="page-wrapper" class="gray-bg dashbard-1">
    @include('layouts.nav_bar_top')
    <div class="row wrapper white-bg ">
        <div class="col-lg-12 titulo-separacion">
            <h2 class="title-page">Retenciones</h2>
            <a href=" {{route('retencion_crear')}} ">
                <button class="btn dirConfiguraciones__instituto--agregarInfo"style="text-align: right">
                Crear nueva Retención
                </button>
            </a>
        </div>
    </div>
    <div class="row mt-1 mb350">
        <div class="col-lg-12">
            {{--
            <form method="get">
                <div class="a-matricula__estudiantes">
                    <input type="search" name="search" id="admin-search" placeholder="Buscar..." class="inputSearch" value="{{request()->search}}">
                </div>
            </form>--}}

            <div class="white-bg">
                <div class="pined-table-responsive">
                    <table class="s-calificaciones w100">
                        <tr class="table__bgBlue text-center">
                            <td style="width: 3%">#</td>

                            <td>Pago Realizado</td>
                            <td>Proveedor</td>

                            <td>Valor</td>
                            <td>Retenciones</td>
                            <td>Total</td>

                            <td>N. Documento</td>
                            <td>Fecha Emisión</td>
                        </tr>
                        @foreach($retenciones as $retencion)
                            <tr>
                                <td class="text-center">{{$retencion}}</td>
                            </tr>
                        @endforeach
                    </table>
                </div>
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