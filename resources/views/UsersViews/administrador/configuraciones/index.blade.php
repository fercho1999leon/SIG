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
            <a class="mrAdministrativo__link" href="{{ route('configuracion_cronograma') }}">
                <figure class="mrAdministrativo--img">
					<img src="img/calendarioAcademico/calendarioAcademico_gris.svg" alt="">
                </figure>
                <h2>Cronograma</h2>
            </a>
            <a class="mrAdministrativo__link" href="{{ route('cursosEdicion') }}">
                <figure class="mrAdministrativo--img">
                    <img src="img/curso/curso_gris.svg" alt="">
                </figure>
                <!--<h2>Cursos</h2>-->
                <h2>Carreras</h2>
            </a>
            <!--Comentar Materias-->
             <!--
            <a class="mrAdministrativo__link" href="{{ route('materiasEdicion') }}">
                <figure class="mrAdministrativo--img">
                    <img src="img/materias.svg" alt="">
                </figure>
                <h2>Materias</h2>
            </a>
           
            <a class="mrAdministrativo__link" href="{{ route('horariosEdicion') }}">
                <figure class="mrAdministrativo--img">
                    <img src="img/horario/horario_gris.svg" alt="">
                </figure>
                <h2>Horarios</h2>
            </a>
            -->

            <a class="mrAdministrativo__link" href="{{ route('horariosCarrera') }}">
                <figure class="mrAdministrativo--img">
                    <img src="img/horario/horario_gris.svg" alt="">
                </figure>
                <h2>Horarios</h2>
            </a>



        
            <!--
            <a class="mrAdministrativo__link" href="{{ route('configuracionesParcial') }}">
                <figure class="mrAdministrativo--img">
                    <img src="img/configuracionesParcial.svg" alt="">
                </figure>
                <h2>Parcial</h2>
            </a>-->
            @if($activar_pagos->valor == '1')
            <!--<a class="mrAdministrativo__link " href="{{ route('configuracionesPagos') }}">
                <figure class="mrAdministrativo--img">
                    <img src="img/configuracionesPago.svg" alt="">
                </figure>
                <h2>Pagos</h2>
            </a>-->
                <a class="mrAdministrativo__link " href="{{route('becas')}}">
                    <figure class="mrAdministrativo--img">
                        <img src="img/configuracionesPago.svg" alt="">
                    </figure>
                    <h2>Pagos</h2>
                </a>
            @endif
            <a class="mrAdministrativo__link" href="{{route('homePeriodo')}}">
                <figure class="mrAdministrativo--img">
                    <img src="img/periodo.png" alt="">
                </figure>
                <h2>Periodo Lectivo</h2>
            </a>
            <a class="mrAdministrativo__link" href="{{('configuracionesGenerales') }}">
                <figure class="mrAdministrativo--img">
                    <img src="img/configuracionesGeneral.svg" alt="">
                </figure>
                <h2>Generales</h2>
            </a>
            {{---
            <a class="mrAdministrativo__link" href=" {{route('configuracionesPorSeccion')}} ">
                <figure class="mrAdministrativo--img">
                    <img src="img/configuracionesGeneral.svg" alt="">
                </figure>
                <h2>Asistencia</h2>
            </a>
            --}}
        </div>
    </div>
@endsection
