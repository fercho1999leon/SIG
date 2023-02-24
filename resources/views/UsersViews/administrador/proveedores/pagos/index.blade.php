@php
    use App\Proveedor;
@endphp
@extends('layouts.master')
@section('content')
<div id="page-wrapper" class="gray-bg dashbard-1">
    @include('layouts.nav_bar_top')
    <div class="row wrapper white-bg ">
        <div class="col-lg-12 titulo-separacion">
            <h2 class="title-page">
                Pagos            
            </h2>
            <a href=" {{route('crear_transaccion_pago')}} ">
                <button class="btn dirConfiguraciones__instituto--agregarInfo"style="text-align: right">Realizar Pago</button>
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
                            <td class="text-center" style="width: 27%">TRANSACCIÓN</td>
                            <td class="text-center" style="width: 10%">FECHA EMISIÓN</td>

                            <td class="text-center" style="width: 35%"></td>
                            <td class="text-center" style="width: 10%">PROVEEDOR</td>
                            <td class="text-center" style="width: 15%">VALOR</td>
                        </tr>
                        @foreach($pagos_proveedores as $p_p)
                        <tr>
                            <td class="text-center">{{$cont++}}</td>
                            <td class="text-center">    
                                {{$p_p->tipo_de_transaccion}}-{{$p_p->forma_de_pago}}
                            </td>
                            <td class="text-center">    
                                {{$p_p->fecha_de_emision}}
                            </td>
                            <td class="text-center">    
                                {{$p_p->descripcion}}
                            </td>
                            <td class="text-center">
                                @foreach($proveedores as $proveedor)
                                    @if($proveedor->id==$p_p->id_proveedor)
                                        {{$proveedor->nombre_comercial}}
                                    @endif
                                @endforeach
                            </td>
                            <td class="text-center">
                                {{$p_p->total}}
                                @if($p_p->plazo!=0)
                                    - {{$p_p->plazo}} {{$p_p->unidad_tiempo}}
                                @endif
                            </td>
                            {{--
                            <td class="text-center">
                                <a href=" {{route('proveedor_editar')}} ">
                                    Editar
                                </a>
                            </td>
                            --}}
                        </tr>
                        @endforeach
                    {{--
                        string('tipo_de_transaccion', 10)->nullable();
                        string('forma_de_pago', 100)
                        date('fecha_de_emision')
                        integer('id_proveedor')->unsigned()
                        string('cuenta_bancaria', 100)
                        string('numero_cheque', 100)
                        string('descripcion', 1000)
                        //Falta campo valor
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