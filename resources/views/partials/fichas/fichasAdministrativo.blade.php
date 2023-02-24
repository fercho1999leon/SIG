<div class="row wrapper white-bg ">
	@if($permiso ==null || ($permiso != null && $permiso->imprimir == 1))
    <div class="col-lg-12 titulo-separacion">
		<h2 class="title-page">Fichas del Personal {{$tipo_usuario == 'Administrador' ? 'Administrativo' : $tipo_usuario }}</h2>
		@if ($tipo_usuario == 'Docente')
			<table><tr>
			<td>
				<a target="_blank" class="matricula__reporteTotalEstudiantesMatriculado  btn btn-black" href="{{route('exportarDocente')}}">Matriz Docentes</a>&nbsp;
			</td>	
			@if(Sentinel::inRole('UsersViews.administrador'))
				<td>
					<a target="_blank" class="matricula__reporteTotalEstudiantesMatriculado  btn btn-black" href="{{route('reporteDocentesGeneral')}}">Reporte Docentes</a>&nbsp;
				</td>
			@endif
			<!--<td colspan="2" align="center">
				<a target="_blank" class="matricula__reporteTotalEstudiantesMatriculado btn btn-black" href="{{route('reporteDocentesGeneraldatos')}}">Reporte Docentes Datos</a>
				</td>-->
				</tr>
				</table>
		@endif
    </div>
    @endif
</div>
<div class="wrapper wrapper-content">
	@if(Sentinel::inRole('UsersViews.secretaria') || Sentinel::inRole('UsersViews.administrador') || ($permiso != null && $permiso->editar == 1))
    <div class="agregarSeccionCont">
        <a href="{{ route('administrativos_crear') }}?tipo_usuario={{$tipo_usuario}}">
            <button class="btn dirConfiguraciones__instituto--agregarInfo" >Agregar Nuevo Personal Académico</button>
        </a>
    </div>
    @endif
	<hr class="dirConfiguraciones__instituto--hr">
	<form method="get">
		<div class="a-matricula__estudiantes">
			<input type="search" name="search" id="admin-search" placeholder="Buscar..." class="inputSearch" value="{{request()->search}}">
		</div>
	</form>
    <div id="admin-list" class="a-listaPersonal">
		@foreach($data as $admin)
			<div class="fAdministrativo">
				<div class="a-personal-administrativo__card relative">
					@if ($perfil == 'admin')
						<img class="shadow a-icono-administrativo"
							alt="image"
							@if ($admin->url_imagen != null)
								src="{{Storage::url("$admin->url_imagen")}}"
							@else
								src="{{secure_asset('img/personal/personal_gris.svg')}}"
							@endif
							/>
					@endif
					<p id="admin" class="a-nombre-administrativo">{{ $admin->apellidos }} {{ $admin->nombres }}</p>
					<span class="a-meta">{{ $admin->cargo }}</span>
					<hr class="a-hr-administrativo">
					<div class="text-center a-personal-administrativo__icons">
						@if ($tipo_usuario == 'Docente')
							<div>
								@if(Sentinel::inRole('UsersViews.administrador') || ($permiso != null && $permiso->imprimir == 1))
								<a href="{{route('reportePorDocente', $admin->id)}}" class="pinedTooltip mr-05" target="_blank">
									<img src="{{secure_asset('img/file-download.svg')}}" width="17" alt="">
									<span class="pinedTooltipH">Reporte Docente</span>
								</a>
								@endif
							</div>
						@else
							<div></div>
						@endif
						<div>
							<span>
								<a data-route="{{route('administrativos_Details',['type'=>$tipo_usuario,'user' =>  $admin->id])}}" class="icon__ver">
									<i class="fa fa-eye"></i>
								</a>
							</span>
							@if(Sentinel::inRole('UsersViews.secretaria') || Sentinel::inRole('UsersViews.administrador') || ($permiso != null && $permiso->editar == 1))
							<span>
								<a href="{{route('administrativos_update',['type'=>$tipo_usuario,'user' =>  $admin->id])}}" class="icon__editar">
									<i class="fa fa-pencil"></i>
								</a>
							</span>
							@endif
							@if(Sentinel::inRole('UsersViews.administrador') || ($permiso != null && $permiso->eliminar == 1))
							<span>
								<form action="{{route('administrativos_update_delete',['user'   =>  $admin->id])}}" method="post" class="icon__eliminar-form form-delete" onclick="return confirm('¿Seguro desea eliminar a este usuario?')" >
									<input name="_method" type="hidden" value="DELETE">
									<input type="hidden" name="_token" value="{{ csrf_token() }}">
									<button type="submit" class="icon__eliminar-btn fz19">
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
		{{ $data->links() }}
	</div>
</div>
