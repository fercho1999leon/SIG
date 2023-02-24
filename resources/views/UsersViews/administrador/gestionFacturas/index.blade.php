@extends('layouts.master')
@section('content')
@include('partials.loader.loader')
    <div id="page-wrapper" class="gray-bg dashbard-1">
        @include('layouts.nav_bar_top')
        <div class="row wrapper white-bg ">
            <div class="col-lg-12 titulo-separacion">
                <h2 class="title-page">Gestión de Facturas
                </h2>
            </div>
        </div>
        <div class="row mt-1 mb350">
            <div class="col-lg-12">
          		Se mostrará una tabla con todas las facturas realizadas

          		Estas facturas deben poder ser clickeadas
          		
          		Se enviaran por un boton el nombre de todos los archivos seleccionados

            </div>
        </div>
    </div>
</div>
@endsection