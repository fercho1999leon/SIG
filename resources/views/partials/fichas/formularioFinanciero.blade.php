<div class="panel pl-1 pr-1 matricula__matriculacion">
	<div class="matricula__matriculacion-block">
		<h3 class="matricula__matriculacion-title">GENERAL</h3>
		<div>
			<div class="matricula__matriculacion__input">
				<label for="" class="matricula__matriculacion-label">Cédula</label>
				<input type="text" class="form-control input-sm" name="ci" minlength="10" maxlength="10" placeholder="Ingrese los 10 digitos de la cédula" value="{{old('ci',$user->ci)}}" required>
			</div>
			<div></div>
			<div class="matricula__matriculacion__input">
				<label for="" class="matricula__matriculacion-label">Nombres</label>
				<input type="text" class="form-control input-sm" name="nombres" minlength="2" maxlength="100" value="{{old('nombres',$user->nombres)}}" required>
			</div>
			<div class="matricula__matriculacion__input">
				<label for="" class="matricula__matriculacion-label">Apellidos</label>
				<input type="text" class="form-control input-sm" name="apellidos" minlength="2" maxlength="100" value="{{old('apellidos',$user->apellidos)}}" required>
			</div>
			<div class="matricula__matriculacion__input">
				<label for="" class="matricula__matriculacion-label">Sexo</label>
				<select class="form-control input-sm" name="sexo">
					<option {{$user->sexo == 'Masculino' ? 'selected' : ''}} value="Masculino">Masculino</option>
					<option {{$user->sexo == 'Femenino' ? 'selected' : ''}} value="Femenino">Femenino</option>
				</select>
			</div>
			<div class="matricula__matriculacion__input">
				<label for="" class="matricula__matriculacion-label">Fecha de nacimiento</label>
				<input type="date" class="form-control input-sm" name="fNacimiento" value="{{old('fNacimiento', $user->fNacimiento)}}" required>
			</div>
			@if ($edit != true)
				<div class="matricula__matriculacion__input">
					<label for="" class="matricula__matriculacion-label">Correo</label>
					<input type="email" class="form-control input-sm" name="correo" value="{{old('correo', $user->correo)}}" required>
				</div>
			@endif
			<div class="matricula__matriculacion__input">
				<label for="" class="matricula__matriculacion-label">Telefono Movil</label>
				<input type="text" class="form-control input-sm" name="movil" value="{{old('movil', $user->movil)}}">
			</div>
			<div class="matricula__matriculacion__input">
				<label for="" class="matricula__matriculacion-label">Foto</label>
				{{ Form::file('image',array('name'  =>  'image','accept' =>  'image/x-png,image/gif,image/jpeg' ))}}
				@if ($user->url_imagen != null)
					<a class="btn btn-primary" href="{{Storage::url($user->url_imagen)}}" download>
						DESCARGAR
					</a>
				@endif
			</div>
		</div>
	</div>
	<div class="matricula__matriculacion-block">
		<h3 class="matricula__matriculacion-title">ADICIONAL</h3>
		<div>
			<div class="matricula__matriculacion__input">
				<label for="" class="matricula__matriculacion-label">Biografía</label>
				<textarea class="form-control input-sm" rows="5" name="bio">{{old('bio', $user->bio)}}</textarea>
			</div>
		</div>
	</div>
	<div class="matricula__matriculacion-block">
		<h3 class="matricula__matriculacion-title">Domicilio</h3>
		<div>
			<div class="matricula__matriculacion__input">
				<label for="" class="matricula__matriculacion-label">Dirección domicilio</label>
				<input type="text" class="form-control input-sm" name="dDomicilio" value="{{old('dDomicilio', $user->dDomicilio)}}">
			</div>
			<div class="matricula__matriculacion__input">
				<label for="" class="matricula__matriculacion-label">Teléfono del domicilio</label>
				<input type="text" class="form-control input-sm" name="tDomicilio" value="{{old('tDomicilio', $user->tDomicilio)}}">
			</div>
		</div>
	</div>
	@if ($edit)
		<div class="matricula__matriculacion-block">
			<h3 class="matricula__matriculacion-title">Acceso</h3>
			<div>
				<div class="matricula__matriculacion__input">
					<label for="" class="matricula__matriculacion-label">Correo</label>
					<input type="email" class="form-control input-sm" name="correo" value="{{old('correo', $user->correo)}}" required>
				</div>
				<div class="matricula__matriculacion__input">
					<label for="" class="matricula__matriculacion-label">Contraseña</label>
					<input type="password" class="form-control " name="password">
				</div>
			</div>
		</div>
	@endif
	<div class="text-right">
		<button type="submit" class="mb-1 btn btn-primary btn-lg">{{$edit == true ? 'Actualizar usuario' : "Crear Usuario $btn"}} </button>
	</div>
</div>