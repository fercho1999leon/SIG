@extends('layouts.master')
@section('content')    
<a class="button-br" href="{{ route('pagosCursoEstudiante', $student->id) }}">
    <button>
        <img src="../../../../img/return.png" alt="" width="17">Regresar
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
            <div class="lista-prof">
                <select onchange="selectProfAsist()" class="form-control select-prof-asist">
                    <option value="" selected="selected" disabled="">PERIODO: 2018-2019</option>
                </select>
            </div>
            <p>EDICIÓN DEL REGISTRO DE PAGO DEL ESTUDIANTE</p>
        </div>
    </div>
    <div class="white-bg p-1">
        <div class="header-pag-his">

            <form method="post" action="{{ route('actualizarRegistroPagoEstudiante', $pago->id)}}">
                <input name="_method" type="hidden" value="PUT">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="lista-prof">
                    <small>
                        <strong>
                            VALORES FIJOS:
                        </strong>
                    </small>
                    <p style="padding-left: 25px">
                        <strong>MES:</strong> {{ $registroPago->mes}}
                    </p>
                    <p style="padding-left: 25px">
                        <strong>VALOR A CANCELAR:</strong> {{ $registroPago->valor}}
                    </p>
                    <p style="padding-left: 25px">
                        <strong>DESCRIPCION:</strong> {{ $registroPago->descripcion}}
                    </p>

                    <small>
                        <strong>
                            VALORES EDITABLES:
                        </strong>
                    </small>
                    <p style="padding-left: 25px">
                        <strong>BECA:</strong>
                        <select class="form-control input-sm" name="beca">
                            <option value="">Sin beca</option>
                            @foreach($bod as $iterator)
                                <option value="{{ $iterator->id}}" {{ ($iterator->id == $pago->beca ) ? ' selected' : '' }}> {{ $iterator->nombre}} </option>
                            @endforeach
                        </select>
                    </p>
                    <p style="padding-left: 25px">
                        <strong>DESCUENTOS:</strong>
                        <select class="form-control input-sm" name="descuento">
                            <option value="">Sin descuento</option>
                            @foreach($descuentos as $descuento)
                                <option value="{{ $descuento->id}}" {{ ($descuento->id == $pago->descuento ) ? ' selected' : '' }}> {{ $descuento->nombre}} </option>
                            @endforeach
                        </select>
                    </p>
                    <p style="padding-left: 25px">
                        <strong>PRORROGA:</strong> {{ $pago->prorroga}} Se dara prorroga
                        <input type="date" class="form-control input-sm" name="prorroga" value="{{ $pago->prorroga }}">
                    </p>
                    <p style="padding-left: 25px">
                        <strong>ESTADO:</strong>
                        <!--
                        <select class="form-control input-sm" name="estado">
                            <option value="Pagado" disabled>Pagado</option>
                            <option value="Pendiente"  {{ ("Pendiente" == $pago->estado ) ? ' selected' : '' }}>Pendiente</option>
                            <option value="NoAplica"  {{ ("NoAplica" == $pago->estado ) ? ' selected' : '' }}>No Aplica</option>
                            <option value="AúnNoAplica"  {{ ("AúnNoAplica" == $pago->estado ) ? ' selected' : '' }}>Aún no aplica</option>
                        </select>
                        -->
                        @if( $pago->estado == "Pagado" )
                            <span style="padding-left: 5px">Pagado</span> 
                        @else
                            <span style="padding-left: 5px">Pendiente</span>
                        @endif
                    </p>
                </div>

                <div class="col-lg-12 text-center">
                    <button type="submit" class="btn btn-primary btn-lg">ACTUALIZAR</button>
                </div> 
            </form>
            
        </div>
    </div>
</div>
@endsection