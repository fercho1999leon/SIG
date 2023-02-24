
		{{ csrf_field() }}
		<div class="matricula__matriculacion-block">
			<h3 class="matricula__matriculacion-title">Unidad</h3>
			<div>
				<div class="matricula__matriculacion__input">
					<label for="" class="matricula__matriculacion-label">¿Es un transporte privado?</label>
					<div>
						<input id="es_privado" type="checkbox" name="es_privado" style="width:30px" {{$transporte->es_privado == 1 ? 'checked' : ''}}>
					</div>
				</div>
				<div class="matricula__matriculacion__input es_privado" {{$transporte->es_privado == 1 ? 'style=display:none' : ''}}>
					<label for="" class="matricula__matriculacion-label">Unidad</label>
					<input type="text" class="form-control input-sm" name="unidad" placeholder="Unidad de transporte, ejemplo: 10" minlength="1" maxlength="3" value="{{$transporte->unidad ?? old('unidad')}}">
				</div>
				<div class="matricula__matriculacion__input">
					<label for="" class="matricula__matriculacion-label">Placa</label>
					<input type="text" placeholder="Numero de placa del bus" minlength="6" maxlength="9" name="placa" class="form-control" value="{{$transporte->placa ?? old('placa')}}" required>
				</div>
				<div class="matricula__matriculacion__input es_privado" {{$transporte->es_privado == 1 ? 'style=display:none' : ''}}>
					<label for="" class="matricula__matriculacion-label">Nombre de la ruta</label>
					<input class="form-control" type="text" name="ruta" placeholder="Ejemplo: Las Joyas" value="{{$transporte->ruta ?? old('ruta')}}">
				</div>
				<div class="matricula__matriculacion__input es_privado" {{$transporte->es_privado == 1 ? 'style=display:none' : ''}}>
					<label for="" class="matricula__matriculacion-label">Detalles de la ruta</label>
					<textarea class="form-control" name="rutaDetalle" id="" cols="30" rows="2" placeholder="Detalle del recorrido por donde irá la unidad">{{$transporte->rutaDetalle ?? old('rutaDetalle')}}</textarea>
				</div>
				<div class="matricula__matriculacion__input">
					<label for="" class="matricula__matriculacion-label">Nombres y Apellidos</label>
					<input type="text" placeholder="Nombres y apellidos del conductor" name="chofer" class="form-control" value="{{$transporte->chofer ?? old('chofer')}}" required>
				</div>
				<div class="matricula__matriculacion__input">
					<label for="" class="matricula__matriculacion-label">Celular</label>
					<input type="text" class="form-control" name="celular" placeholder="celular movil" value="{{$transporte->celular ?? old('celular')}}" minlength="10" maxlength="10" required>
				</div>
				<div class="matricula__matriculacion__input">
					<label for="" class="matricula__matriculacion-label">Correo</label>
					<input type="email" class="form-control" name="correo" value="{{$transporte->correo ?? old('correo')}}" placeholder="correo electronico">
				</div>
			</div>
		</div>
		<div class="text-right">
			<input type="submit" class="mb-1 btn btn-primary btn-lg" value="{{$button}}">
		</div>
		<script>
			var es_privado = document.getElementById('es_privado')
			var inputs_privado = document.querySelectorAll('.es_privado')
			es_privado.addEventListener('click', function (){
				if (es_privado.checked === true) {
					inputs_privado.forEach(e => {
						e.style.display = 'none';
					});
				} else {
					inputs_privado.forEach(e => {
						e.style.display = 'block';
					});
				}
			})
		</script>