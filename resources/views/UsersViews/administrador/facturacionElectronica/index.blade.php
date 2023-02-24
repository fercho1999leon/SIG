@extends('layouts.master')
@section('content')
@include('partials.loader.loader')
    <div id="page-wrapper" class="gray-bg dashbard-1">
        @include('layouts.nav_bar_top')
        <div class="row wrapper white-bg ">
            <div class="col-lg-12 titulo-separacion">
                <h2 class="title-page">Actualización de datos de facturación electronica
                </h2>
            </div>
        </div>
        <div class="row mt-1 mb350 ">
			<div class="col-xs-12">
				<div class="panel pl-8 pr-8 matricula__matriculacion">
					<form action="{{route('datos.facturacionElectronica.update')}}" method="post">
						{{ csrf_field() }}
						{{method_field('PUT')}}
						<div class="matricula__matriculacion-block">
							<h3 class="matricula__matriculacion-title">Facturación</h3>
							<div>
								<div class="matricula__matriculacion__input">
									<label for="" class="matricula__matriculacion-label">Razon Social</label>
									<input type="text" class="form-control input-sm" name="razon_social" value="{{old('razon_social', $institution->razon_social)}}">
								</div>
								<div class="matricula__matriculacion__input">
									<label for="" class="matricula__matriculacion-label">Nombre Comercial</label>
									<input type="text" class="form-control input-sm" name="nombre_comercial" value="{{old('nombre_comercial', $institution->nombre_comercial)}}">
								</div>
								<div class="matricula__matriculacion__input">
									<label for="" class="matricula__matriculacion-label">Ruc</label>
									<input type="text" class="form-control input-sm" minlength="13" maxlength="13" name="ruc" value="{{old('ruc', $institution->ruc)}}">
								</div>
								<div class="matricula__matriculacion__input">
									<label for="" class="matricula__matriculacion-label">Código de Establecimiento</label>
									<input type="text" class="form-control input-sm" name="establecimiento" value="{{old('establecimiento', $institution->establecimiento)}}">
								</div>
								<div class="matricula__matriculacion__input">
									<label for="" class="matricula__matriculacion-label">Dirección Matriz</label>
									<input type="text" class="form-control input-sm" name="direccion_matriz" value="{{old('direccion_matriz', $institution->direccion_matriz)}}">
								</div>
							</div>
						</div>
						<div class="matricula__matriculacion-block">
							<h3 class="matricula__matriculacion-title">Aula virtual</h3>
							<div>
								<div class="matricula__matriculacion__input">
									<label for="" class="matricula__matriculacion-label">Link aula virtual</label>
									<input type="text" class="form-control input-sm" name="aula_virtual" value="{{old('aula_virtual', $institution->aula_virtual)}}">
								</div>
							</div>
						</div>
						<div class="matricula__botones-final">
							<div></div>
							<div class="text-right">
								<input type="submit" class="mb-1 btn btn-primary btn-lg" value="Actualizar datos">
							</div>
						</div>
					</form> 
				</div>
			</div>
        </div>
    </div>
</div>
@endsection