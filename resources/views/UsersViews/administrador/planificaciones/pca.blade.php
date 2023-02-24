@extends('layouts.master')
@section('content')
<a class="button-br" href="">
	<button>
		<img src="{{secure_asset('img/return.png')}}" alt="" width="17"> Regresar
	</button>
</a>
<div id="page-wrapper" class="gray-bg dashbard-1">
    @include('layouts.nav_bar_top')
    <div class="row wrapper white-bg ">
        <div class="col-xs-12 titulo-separacion">
			<h2 class="title-page">Planificaciones</h2>
        </div>
    </div>
    <div class="wrapper wrapper-content">
        <div class="row">
			<div class="col-xs-12">
				<div class="tabs-container">
					<ul class="nav nav-tabs">
						<li class="active">
							<a data-toggle="tab" href="#tab-1">Educación inicial</a>
						</li>
						<li>
							<a data-toggle="tab" href="#tab-2">Educación General Básica</a>
						</li>
						<li>
							<a data-toggle="tab" href="#tab-3">Bachillerato General Unificado</a>
						</li>
					</ul>
					<div class="tab-content">
						<div id="tab-1" class="tab-pane active">
							<div class="panel p-1">
								<div class="planificaciones__pca">
									<h3 class="m-0 uppercase">Curso Especialización Paralelo</h3>
									<div>
										<div class="planificaciones__pca__items">
											<div class="planificaciones__pca__item">
												<h3 class="m-0">Materia Nombre Completo</h3>
												<span>APROBADO</span>
												<img src=" {{secure_asset('img/pagos-check-verde.svg')}} " width="20" alt="">
											</div>
											<div class="planificaciones__pca__item">
												<h3 class="m-0">Materia Nombre Completo</h3>
												<span>APROBADO</span>
												<img src=" {{secure_asset('img/pagos-check-verde.svg')}} " width="20" alt="">
											</div>
											<div class="planificaciones__pca__item">
												<h3 class="m-0">Materia Nombre Completo</h3>
												<span>APROBADO</span>
												<img src=" {{secure_asset('img/pagos-check-verde.svg')}} " width="20" alt="">
											</div>
											<div class="planificaciones__pca__item">
												<h3 class="m-0">Materia Nombre Completo</h3>
												<span>APROBADO</span>
												<img src=" {{secure_asset('img/pagos-check-verde.svg')}} " width="20" alt="">
											</div>
											<div class="planificaciones__pca__item">
												<h3 class="m-0">Materia Nombre Completo</h3>
												<span>APROBADO</span>
												<img src=" {{secure_asset('img/pagos-check-verde.svg')}} " width="20" alt="">
											</div>
											<div class="planificaciones__pca__item">
												<h3 class="m-0">Materia Nombre Completo</h3>
												<span>APROBADO</span>
												<img src=" {{secure_asset('img/pagos-check-verde.svg')}} " width="20" alt="">
											</div>
											<div class="planificaciones__pca__item">
												<h3 class="m-0">Materia Nombre Completo</h3>
												<span>APROBADO</span>
												<img src=" {{secure_asset('img/pagos-check-verde.svg')}} " width="20" alt="">
											</div>
											<div class="planificaciones__pca__item">
												<h3 class="m-0">Materia Nombre Completo</h3>
												<span>APROBADO</span>
												<img src=" {{secure_asset('img/pagos-check-verde.svg')}} " width="20" alt="">
											</div>
											<div class="planificaciones__pca__item">
												<h3 class="m-0">Materia Nombre Completo</h3>
												<span>APROBADO</span>
												<img src=" {{secure_asset('img/pagos-check-verde.svg')}} " width="20" alt="">
											</div>
											<div class="planificaciones__pca__item">
												<h3 class="m-0">Materia Nombre Completo</h3>
												<span>APROBADO</span>
												<img src=" {{secure_asset('img/pagos-check-verde.svg')}} " width="20" alt="">
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div id="tab-2" class="tab-pane">
						</div>
						<div id="tab-3" class="tab-pane">
						</div>
					</div>
				</div>
			</div>
        </div>
    </div>
</div>
@endsection