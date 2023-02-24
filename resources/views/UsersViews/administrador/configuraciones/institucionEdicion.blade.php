@php
    $permiso = App\Permiso::desbloqueo('institucionEdicion');
@endphp
@extends('layouts.master') @section('content')
    @if ($permiso == null || ( $permiso != null && $permiso->ver == 1 ))
        <a class="button-br" href="{{ route('configuraciones') }}">
            <button>
                <img src="img/return.png" alt="" width="17">Regresar
            </button>
        </a>
        <div id="page-wrapper" class="gray-bg dashbard-1">
            @include('layouts.nav_bar_top')
            <div class="row wrapper white-bg">
                <div class="col-lg-12">
                    <h2 class="title-page">Configuraciones
                        <small>Institución</small>
                    </h2>
                </div>
            </div>
            <div class="wrapper wrapper-content animated fadeInRight">
                <div class="widget widget-tabs">
                    <div class="tabs-container">
                        <ul class="nav nav-tabs">
                            <li class="active"> <a data-toggle="tab" href="#tab-1">Datos Generales</a> </li>
                            <li> <a data-toggle="tab" href="#tab-2">Mision/Vision</a> </li>
                            <li> <a data-toggle="tab" href="#tab-3">Historia/Antecedentes</a> </li>
                            <li> <a data-toggle="tab" href="#tab-5">Web Oficial</a> </li>
                            <li> <a data-toggle="tab" href="#tab-6">Redes Sociales</a> </li>
                        </ul>
                        <div class="tab-content">
                            <div id="tab-1" class="tab-pane active">
                                @include('partials.formularioDatosGeneralesInstitucion',['data'=>$data])
                            </div>
                            <div id="tab-2" class="tab-pane">
                                @include('partials.formularioMisionVisionInstitucion',['data'=>$data])
                            </div>
                            <div id="tab-3" class="tab-pane">
                                @include('partials.formularioHistoriaAntecedentesInstitucion',['data'=>$data])
                            </div>
                            <div id="tab-5" class="tab-pane">
                                @include('partials.formularioWebOficialInstitucion',['data'=>$data])
                            </div>
                            <div id="tab-6" class="tab-pane">
                                @include('partials.formularioRedesSocialesInstitucion',['data'=>$data])
                            </div>
                        </div>
                    </div>
                </div>
                <div class="widget widget-tabs">
                    <div class="tabs-container">
                        <ul class="nav nav-tabs">
                            <li class="active">
                                <a data-toggle="tab" href="#tab-8">Reportes Ministeriales</a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div id="tab-8" class="tab-pane active">
                                @include('partials.formularioReportesMinisterialesInstitucion',['data'=>$data])
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @else
        <div id="page-wrapper" class="gray-bg dashbard-1">
        @include('layouts.nav_bar_top')
        <div class="row wrapper white-bg">
            <div class="col-lg-12">
                <h2 class="title-page">
                    NO TIENE PERMISOS NECESARIOS.
                </h2>
            </div>
        </div>
    @endif
@endsection