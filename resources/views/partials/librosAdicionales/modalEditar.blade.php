<div class="modal-dialog" role="document">
	<div class="modal-content">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
					aria-hidden="true">&times;</span></button>
			<h4 class="modal-title" id="myModalLabel">Agregar Libro</h4>
		</div>
		<form action="{{route('additionalBook.update', $book)}}" method="POST" enctype="multipart/form-data">
			{{ csrf_field() }}
			{{ method_field('PUT') }}
			<div class="modal-body">
				<div class="mb-6">
					<label for="">Nombre del libro</label>
					<input name="nombre" type="text" class="form-control" value="{{old('nombre', $book->nombre)}}" required>
				</div>
				<div class="mb-6">
					<label for="">Descripción</label>
					<textarea class="form-control" name="descripcion" id="" cols="30" rows="10">{{old('descripcion', $book->descripcion)}}</textarea>
				</div>
				<div class="mb-6">
					<label for="">Añadir enlace</label>
					<input name="enlace" type="url" class="form-control" value="{{old('enlace', $book->enlace)}}" required>
				</div>
				<div class="mb-6">
					<label for="">Foto de la portada</label>
					<input name="portada" type="file">
				</div>
				@if ($book->portada != null)
					<div class="mb-6">
						<a download="" class="btn btn-primary" href="{{Storage::url("public/adjuntos/$book->portada")}}">{{$book->portada}}</a>
					</div>
				@endif
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
				<button type="submit" class="btn btn-primary">Actualizar</button>
			</div>
		</form>
	</div>
</div>