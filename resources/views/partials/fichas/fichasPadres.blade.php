<form method="get">
	<div class="a-matricula__estudiantes">
		<input type="search" name="search" id="admin-search" placeholder="Buscar..." class="inputSearch" value="{{request()->search}}">
	</div>
</form>
<div id="admin-list" class="a-listaPersonal">
    @foreach($parents as $parent)
        <div class="fDocente">
            <div class="a-personal-administrativo__card">
                <p id="docente" class="nombreDocente">{{ $parent->apellidos }} {{ $parent->nombres }}</p>
                <hr class="a-hr-administrativo">
                <div class="a-personal-administrativo__icons">
					<div></div>
                    <div>
						<span>
							<a data-route="{{ route('padresVer', $parent->id)}}" class="icon__ver">
								<i class="fa fa-eye"></i>
							</a>
						</span>
                        @if($permiso ==null || ($permiso != null && $permiso->editar == 1))
						<span>
							<a href="{{ route('padresEditar', $parent->id) }}" class="icon__editar">
								<i class="fa fa-pencil"></i>
							</a>
						</span>
                        @endif
                        @if($permiso ==null || ($permiso != null && $permiso->eliminar == 1))
						<span>
							<form action="{{route('padresEliminar', $parent->id)}}" method="post" class="icon__eliminar-form form-delete" onclick="return confirm('¿Seguro desea eliminar a este usuario?')" >
								<input name="_method" type="hidden" value="DELETE">
								<input type="hidden" name="_token" value="{{ csrf_token() }}">
								<button type="submit" class="icon__eliminar-btn">
									<i class="fa fa-trash"></i>
								</button>
							</form>
						</span>
                        @endif
					</div>
                </div>
            </div>
        </div>
    @endforeach
</div>
<div class="matricula__pagination">
	{{ $parents->links() }}
</div>
