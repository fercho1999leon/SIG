@extends('UsersViews.admisiones.style')
<a class="button-br" href="{{route('admision_datos', $estudiante->ci)}}">
		<button>
			<img src="{{secure_asset('img/return.png')}}" alt="" width="17"> Regresar
		</button>
	</a>
<div class="row wrapper white-bg ">
	@if (count($errors) > 0)
    <div class="alert alert-danger">
    	<p>Corrige los siguientes errores:</p>
        <ul>
            @foreach ($errors->all() as $message)
                <li>{{ $message }}</li>
            @endforeach
        </ul>
    </div>
@endif
			<div class="container">
				<div class="row mt-5">
					<div class="col-md-12">
						<h2 class="title-page">Editar Representante</h2>
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
								<input type="hidden" value="{{$estudiante->id}}" name="id_estudiante">
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
</div>
