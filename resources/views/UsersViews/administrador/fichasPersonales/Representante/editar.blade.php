@extends('layouts.master')
@section('content')
	<a class="button-br" href=" {{route('representantes') }} ">
		<button>
			<img src="{{secure_asset('img/return.png')}}" alt="" width="17"> Regresar
		</button>
	</a>
    <div id="page-wrapper" class="gray-bg dashbard-1">
        @include('layouts.nav_bar_top')
		<div class="row wrapper white-bg">
			<div class="col-lg-12">
				<h2 class="title-page">Editar Representante</h2>
			</div>
		</div>
		<div class="wrapper wrapper-content">
			<div class="row">
				<form action="{{route('representante.update', $data)}}" method="POST" enctype="multipart/form-data">
					{{csrf_field()}}
					{{method_field('PUT')}}
					<input type="hidden" value="Representante" name="tipo_usuario">
					<div class="panel pl-1 pr-1 matricula__matriculacion">
						@include('partials.fichas.fichaRepresentante')
						<div class="text-right">
							<button type="submit" class="mb-1 btn btn-primary btn-lg">Actualizar Representante</button>
						</div>
						<input type="hidden" value="Representante" name="cargo">
					</div>
				</form>
			</div>
		</div>
    </div>
@endsection
