@extends('layouts.master')
@section('content')
<div id="page-wrapper" class="gray-bg dashbard-1">
    @include('layouts.nav_bar_top')
    <div class="row wrapper white-bg ">
        <div class="col-lg-12 titulo-separacion">
            <h2 class="title-page">Proveedores</h2>
            <a href=" {{route('proveedor_crear')}} ">
                <button class="btn dirConfiguraciones__instituto--agregarInfo"style="text-align: right">Agregar nuevo Proveedor</button>
            </a>
        </div>
    </div>
    <div class="row mt-1 mb350">
        <div class="col-lg-12">
            <form method="get">
                <div class="a-matricula__estudiantes">
                    <input type="search" name="search" id="admin-search" placeholder="Buscar..." class="inputSearch" value="{{request()->search}}">
                </div>
            </form>
            <div class="white-bg">
                <div class="pined-table-responsive">
                    <table class="s-calificaciones w100">
                        <tr class="table__bgBlue">
                            <td class="text-center" style="width: 3%">#</td>
                            <td class="text-center" style="width: 43%">NOMBRE COMERCIAL</td>
                            <td class="text-center" style="width: 43%">NOMBRES Y APELLIDOS</td>
                            <td class="text-center" style="width: 30%">CORREO</td>
                            <td class="text-center" style="width: 10%">DESCUENTO</td>
                            <td class="text-center" style="width: 5%">CIA</td>
                            <td class="text-center" style="width: 5%">ARTESANO</td>
                            <td class="text-center" style="width: 4%"></td>
                            <td class="text-center" style="width: 4%"></td>
                        </tr>
                        @foreach( $proveedores as $proveedor)                        
                            @if($proveedor->estado==0)
                                <tr style="color: red">
                            @else
                                <tr>
                            @endif
                                <td class="text-center">{{$cont++}}</td>
                                <td class="text-center">{{$proveedor->nombre_comercial}}</td>
                                <td class="text-center">{{$proveedor->nombres}}, {{$proveedor->apellidos}}</td>
                                <td class="text-center">{{$proveedor->email}}</td>
                                <td class="text-center">{{$proveedor->descuento}}</td>
                                <td class="text-center">{{$proveedor->cia_relacionada}}</td>
                                <td class="text-center">{{$proveedor->artesano}}</td>
                                <td class="text-center"> + </td>
                                <td class="text-center">
                                    <a href=" {{route('proveedor_editar')}} ">
                                        Editar
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    {{--
                        jhbjk
                        <tr>
                            <td class="text-center">{{$cont++}}</td>
                            <td class="text-center">{{$proveedores->nombre_comercial}}</td>
                            <td class="text-center">
                                {{$proveedores->descuento}}
                                @if($proveedores->descuento!=0)
                                    {{$proveedores->descuento}}  %
                                @endif
                            </td>
                            <td class="text-center">
                                {{$proveedores->cia_relacionada}}
                                @if($proveedores->cia_relacionada==1)
                                    SI
                                @endif
                            </td>
                            <td class="text-center">
                                {{$proveedores->artesano}}
                                @if($proveedores->artesano==1)
                                    SI
                                @endif
                            </td>
                            <td class="text-center">{{$proveedores->ret_ir}}</td>
                            <td class="text-center">{{$proveedores->ret_iva}}</td>
                        </tr>
                    --}}        
                    
                    </table>
                </div>
            </div>
            
        </div>
    </div>

</div>
@endsection
@section('scripts')
<script src="{{secure_asset('js/datatables.js')}}"></script>
<script src="{{secure_asset('js/datatableCustom.js')}}"></script>
@endsection