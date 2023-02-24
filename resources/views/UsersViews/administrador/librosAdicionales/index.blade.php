@extends('layouts.master')
@section('content')
    <div id="page-wrapper" class="gray-bg dashbard-1">
		@include('layouts.nav_bar_top')
        <div class="row wrapper white-bg titulo-separacion noBefore">
			<h2 class="title-page">Libros Adicionales</h2>
			<button class="btn btn-black" data-toggle="modal" data-target="#agregarLibro">Agregar Libro</button>
        </div>
        @include('partials.librosAdicionales.content', [
			'admin' => true
		])
	</div>
	{{-- Editar Libro --}}
	<div class="modal fade" id="editarLibro" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	</div>
	{{-- Agregar libro --}}
	<div class="modal fade" id="agregarLibro" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
							aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="myModalLabel">Agregar Libro</h4>
				</div>
				<form action="{{route('additionalBook.store')}}" method="POST" enctype="multipart/form-data">
					{{ csrf_field() }}
					<div class="modal-body">
						<div class="mb-6">
							<label for="">Nombre del libro</label>
							<input name="nombre" type="text" class="form-control" value="{{old('nombre')}}" required>
						</div>
						<div class="mb-6">
							<label for="">Descripción</label>
							<textarea class="form-control" name="descripcion" id="" cols="30" rows="5">{{old('descripcion')}}</textarea>
						</div>
						<div class="mb-6">
							<label for="">Añadir enlace</label>
							<input name="enlace" type="url" class="form-control" value="{{old('enlace')}}" required>
						</div>

						<div class="mb-6">
							<label for="">Grado</label>
							<select class="form-control input-sm" name="grado" required>
								<option value="Inicial 1">Inicial 1</option>
								<option value="Inicial 2">Inicial 2</option>
								<option value="Primero">Primero</option>
								<option value="Segundo">Segundo</option>
								<option value="Tercero">Tercero</option>
								<option value="Cuarto">Cuarto</option>
								<option value="Quinto">Quinto</option>
								<option value="Sexto">Sexto</option>
								<option value="Septimo">Septimo</option>
								<option value="Octavo">Octavo</option>
								<option value="Noveno">Noveno</option>
								<option value="Decimo">Decimo</option>
								<option value="Primero de Bachillerato">Primero de Bachillerato</option>
								<option value="Segundo de Bachillerato">Segundo de Bachillerato</option>
								<option value="Tercero de Bachillerato">Tercero de Bachillerato</option>
							</select>
						</div>
						<div class="mb-6">
							<label for="">Área</label>
							<select class="form-control input-sm" name="area" required>
								@foreach($areas as $area)
									<option value="{{$area->id}}">{{$area->nombre}}-{{$area->seccion}} </option>
								@endforeach
							</select>
						</div>
						
						<div class="mb-6">
							<label for="">Foto de la portada</label>
							<input name="portada" type="file">
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
						<button type="submit" id="postLibro" class="btn btn-primary">Guardar</button>
					</div>
				</form>
			</div>
		</div>
	</div>
@endsection
@section('scripts')
	<script>
		// function libroContent() {
		// 	var 
		// }
		var libro = $('.editarLibro');
		libro.click(function(e) {
			e.preventDefault()
			$.ajax({
				type: "GET",
				url: $(this).attr('href'),
				success: function (result) {
					$('#editarLibro').html(result);
					$('#editarLibro').modal('show');
				}
			});
		})
	</script>
@endsection