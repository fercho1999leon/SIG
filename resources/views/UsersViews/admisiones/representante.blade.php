@extends('UsersViews.admisiones.style')
<a class="button-br" href="{{route('admision_datos', $estudiante->ci)}}">
		<button>
			<img src="{{secure_asset('img/return.png')}}" alt="" width="17"> Regresar
		</button>
	</a>
<div class="row wrapper white-bg ">
  <div class="col-lg-12">
				<h2 class="title-page">Editar Representante nuevo</h2>
			</div>
		</div>
		<div class="wrapper wrapper-content">
			<div class="row">
				<form action="{{route('representante.Edit', $data)}}" method="POST" enctype="multipart/form-data">
					{{csrf_field()}}
					<input type="hidden" value="Representante" name="tipo_usuario">
					<div class="panel pl-1 pr-1 matricula__matriculacion">
						@include('partials.fichas.fichaRepresentante')
						<div class="text-right">
							<button type="submit" class="mb-1 btn btn-primary btn-lg">Actualizar Representante</button>
						</div>
						<input type="hidden" value="Representante" name="cargo">
						<input type="hidden" value="{{$cedula}}" name="ci">				
					</div>
				</form>
			</div>
		</div>
    </div>	