@extends('layouts.master')
@section('content')
<div id="page-wrapper" class="gray-bg dashbard-1">
    @include('layouts.nav_bar_top')
    <div class="row wrapper white-bg ">
        <div class="col-xs-12 seleccion-curso">
            <h2 class="title-page">Planificaciones</h2>
        </div>
    </div>
    <div class="wrapper wrapper-content">
        <div class="row">
			<div class="col-xs-12">
				<div class="transporte-grid">
					<div class="transporte-item">
						<h3>Nombre de la materia</h3>
						<h4>Estado</h4>
						<div class="progress mb-0">
							<div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%;">
								<span class="sr-only">60% Complete</span>
							</div>
						</div>
					</div>
				</div>
			</div>
        </div>
    </div>
</div>
@endsection