@extends('layouts.master')
@section('content')
@include('partials.loader.loader')
    <div id="page-wrapper" class="gray-bg dashbard-1">
        @include('layouts.nav_bar_top')
        <div class="row wrapper white-bg ">
            <div class="col-lg-12">
                <h2 class="title-page">Configuraciones </h2>
            </div>
		</div>
        <div class="row wrapper white-bg directorPerfil-info"></div>
        <div class="mrAdministrativo">
            <a class="mrAdministrativo__link" href="{{ route('institucionEdicion') }}">
                <figure class="mrAdministrativo--img">
                    <img src="img/institucion.svg" alt="">
                </figure>
                <h2>Institución</h2>
            </a>
            @if($activar_pagos->valor == '1')
            <a class="mrAdministrativo__link " href="{{ route('configuracionesPagos') }}">
                <figure class="mrAdministrativo--img">
                    <img src="img/configuracionesPago.svg" alt="">
                </figure>
                <h2>Pagos</h2>
            </a>
			@endif
			<a class="mrAdministrativo__link" href="{{route('configuracionesGenerales')}}">
				<figure class="mrAdministrativo--img">
					<img src="img/configuracionesGeneral.svg" alt="">
				</figure>
				<h2>Generales</h2>
			</a>
        </div>
    </div>
@endsection
