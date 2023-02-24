@extends('layouts.master') 
@section('content')
<a class="button-br" href="{{ route('pagosCursoEstudiante', $student->id) }}">
    <button>
        <img src="{{secure_asset('img/return.png')}}" alt="" width="17">Regresar
    </button>
</a>
<div id="page-wrapper" class="gray-bg dashbard-1">
    @include('layouts.nav_bar_top')
    <div class="row wrapper white-bg mb-1">
        <div class="padre-pago">
            <div class="profile-image mb-1">
                <img src="{{secure_asset('img/icono_persona.png')}}" alt="FACTURA" W width="30">
            </div>
            <div class="profile-info">
                <h2 class="no-margins">
                    {{ $student->nombres }} {{ $student->apellidos }}
                </h2>
                <p>
                    <h3 style="padding-left:10px">
                        <strong>CURSO:</strong> {{ $course->grado }} {{ $course->paralelo}} 
                    </h3>
                </p>
                <p>
                    <h3 style="padding-left:10px">
                        <strong>DIRIGENTE:</strong> {{ $tutor->nombres }} {{ $tutor->apellidos }}
                    </h3>
                </p>
            </div>
        </div>
    </div>

    <div class="white-bg p-1">
        <div class="header-pag-his">
            <div class="pagoHistorico__layout-pago">
                <select onchange="selectProfAsist()" class="form-control select-prof-asist">
                    <option value="" selected="selected" disabled="">PERIODO: 2018-2019</option>
                </select>
                <!-- Muestra el pago que debe cubrirse -->
                <table class="table">
                    <tr class="table__bgBlue">
                        <td colspan="3" class="text-center">PAGO</td>
                    </tr>
                    <tr>
                        <td class="text-center">MES:</td>
                        <td class="text-center">{{ $pagoACancelar->mes }}</td>
                    </tr>
                    <tr>
                        <td class="text-center">TIPO:</td>
                        <td class="text-center">{{ $pagoACancelar->tipo }}</td>
                    </tr>
                    <tr>
                        <td class="text-center">VALOR AUTORIZADO MINISTERIO:</td>
                        <td class="text-center">{{ $pagoACancelar->pagoAutorizado }}</td>
                    </tr>
                    <tr>
                        <td class="text-center">VALOR A CANCELAR:</td>
                        <td class="text-center">{{ $pagoACancelar->valor }}</td>
                    </tr>
                </table>
            </div>
        </div>
        <div class="bg-w-table" id="Q1">
            <div class="table-responsive">
                <!-- Se muestra si hay pagos realizados -->
                <table class="table table-pag-hist">
                    <thead>
                        <tr>
                            <th>Mes</th>
                            <th>Tipo</th>
                            <th>Cantidad</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Iteración si existe Beca-->
                        @if( $beca!=null)
                        <tr>
                            <td colspan="2">BECA</td>
                            <td>
                                @if($beca->valor!=null)
                                    {{ $beca->valor }} USD 
                                @else
                                    {{ $beca->porcentaje }} %
                                @endif
                            </td>
                        </tr>
                        @endif

                        <!-- Iteración si existe Descuento-->
                        @if( $descuento!=null)
                        <tr>
                            <td colspan="2">DESCUENTO</td>
                            <td>
                                @if($descuento->valor!=null)
                                    {{ $descuento->valor }} USD 
                                @else
                                    {{ $descuento->porcentaje }} %
                                @endif
                            </td>
                        </tr>
                        @endif

                        <!-- Iteración si existe Abono o Pago Cancelado-->
                        @if( $pagosEstudiantes!=null )
                            @foreach( $pagosEstudiantes as $pE)
                                <tr>
                                    <td>Abono</td>
                                    <td>{{ $pE->tipoPago }}</td>
                                    <td>{{ $pE->cantidad }}</td>
                                </tr>
                            @endforeach
                        @endif
                        
                    </tbody>
                </table>
            </div>
            
            @if( $pago->estado=="Pagado" )
                <a href="{{ route('descargarFacturaPago', $pago->id) }}" style="padding-right: 5px">
                    <i class="glyphicon glyphicon-file">GENERAR_FACTURA</i>
                </a>
            @else
                PENDIENTE
            @endif
        </div>

    </div>
</div>
@endsection