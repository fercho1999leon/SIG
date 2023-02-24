@extends('layouts.master')
@section('content')
<div id="page-wrapper" class="gray-bg dashbard-1">
    @include('layouts.nav_bar_top')
    <div class="row wrapper white-bg ">
        <div class="col-xs-12 seleccion-curso">
            <h2 class="title-page">Planificaciones <small>Nombre de la materia</small></h2>
        </div>
    </div>
    <div class="wrapper wrapper-content">
        <div class="row">
			<div class="col-xs-12">
				<div class="planificaciones__materias-grid">
					<div class="transporte-item">
						<a href="#" class="planificaciones__materias-link">
							Destrezas con criterio de desempeños
						</a>
					</div>
					<div class="transporte-item">
						<a href="#" class="planificaciones__materias-link">
							Planificación de unidad didáctica 
						</a>
					</div>
					<div class="transporte-item">
						<a href="#" class="planificaciones__materias-link">
							Plan de bloqueo
						</a>
					</div>
					<div class="transporte-item">
						<a href="#" class="planificaciones__materias-link">
							Informe parcial de asignatura
						</a>
					</div>
					<div class="transporte-item">
						<a href="#" class="planificaciones__materias-link">
							Refuerzo académico
						</a>
					</div>
				</div>
			</div>
        </div>
    </div>
</div>
@endsection