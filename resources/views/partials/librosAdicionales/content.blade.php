<div class="librosAdicionales-grid" id="libros" style="{{count($books) == 0 ? 'display:block' : ''}}">
		@forelse ($books as $book)
			
			<div>
				<h3>{{$book->nombre}}</h3>
				<a href="{{$book->enlace}}" target="_blank">
					<img class="rounded shadow w-full" 
					@if ($book->portada != null)
						src="{{Storage::url("public/adjuntos/$book->portada")}}" 
					@else
						src="{{secure_asset('img/notfound.png')}}" 
					@endif
					alt="">
				</a>
				@foreach($booksGrade as $bk)
					@if($bk->idAdditionalBook==$book->id)
						Grado: {{$bk->grado}}
					@endif
				@endforeach
				<div class="mt-4 flex justify-content-between">
					<div></div>
					<div class="flex">
						@if ($admin == true)
							<a href="{{$book->enlace}}" target="_blank">
								<i class="fa fa-eye icon__ver"></i>
							</a>
							<a class="editarLibro" href="{{route('additionalBook.edit', $book)}}">
								<i class="fa fa-pencil a-fa-pencil__matricula"></i>
							</a>
							<form action="{{route('additionalBook.destroy', $book)}}" method="post">
								{{ csrf_field() }}
								{{method_field('DELETE')}}
								<button type="submit" class="bg-none border-none p-0">
									<i class="fa fa-trash icon__eliminar"></i>
								</a>
							</form>
						@endif
					</div>
				</div>
			</div>

		@empty
			<div>
				<h3 class="text-center">No se ha creado ningún libro.</h3>
			</div>
		@endforelse
	</div>