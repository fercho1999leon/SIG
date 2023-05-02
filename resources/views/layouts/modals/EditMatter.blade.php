<div class="modal-dialog dirModalAgregarGrado" role="document">
	<form action="{{route('updateMatter',['matter' => $matter->id])}}" method="POST"  id="updateMatterForm">
		<input type="hidden"  name="_method" value="PUT">
		{{csrf_field()}}
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<h3>Editar Materia</h3>
				<div id="response"></div>
			</div>
			<div class="modal-body">
				<ul class="nav nav-tabs">
					<li class="active"><a data-toggle="tab" href="#materia">General</a></li>
					<li><a data-toggle="tab" href="#insumos" onclick="reloadInsumos()">Insumos</a></li>
				</ul>

				<div class="tab-content">
					<div id="materia" class="tab-pane fade in active">
						<div class="agregarCurso--info">
					<label for="">Nombre Completo</label>
					<textarea name="nombre" class="form-control" rows="5" id="comment">{{$matter->nombre}}</textarea>
				</div>
				<div class="agregarCurso--info">
					<label for="">Nombre Abreviado</label>
					<input id="subjAbrv" type="text" name="nombre_abreviado" value="{{ $matter->nombre_abreviado }}" class="form-control">
				</div>
				<div class="agregarCurso--info">
					<label for="">Observación</label>
					<textarea class="form-control" name="observacion" rows="5" id="comment">{{ $matter->observacion }}</textarea>
				</div>
				<div class="agregarCurso--info">
					<label for="">Area</label>
					@foreach ($courses as $course)
						@if ($course->id == $matter->idCurso)
							@if ($course->seccion == 'EI')
								<select class="form-control" id="area" name="area">
									<option value="">Sin Asignación...</option>
									@foreach($areas->where('seccion', 'EI') as $area)
										<option value="{{$area->id}}" {{$matter->idArea == $area->id ? 'selected' : '' }}>{{$area->nombre}}</option>
									@endforeach
								</select>
								@elseif($course->seccion == 'EGB')
								<select class="form-control" id="area" name="area">
									<option value="">Sin Asignación...</option>
									@foreach($areas->where('seccion', 'EGB') as $area)
										<option value="{{$area->id}}" {{$matter->idArea == $area->id ? 'selected' : '' }}>{{$area->nombre}}</option>
									@endforeach
								</select>
							@else
								<select class="form-control" id="area" name="area">
									<option value="">Sin Asignación...</option>
									@foreach($areas->where('seccion', 'BGU') as $area)
										<option value="{{$area->id}}" {{$matter->idArea == $area->id ? 'selected' : '' }}>{{$area->nombre}}</option>
									@endforeach
								</select>
							@endif
						@endif
					@endforeach
				</div>
				<div class="agregarCurso--info">
					<label for="">Nivel</label>
					<input id="nivel" name="nivel" type="text" class="form-control" value="{{ $matter->nivel }}">
				</div>
					<div class="hr-line-dashed"></div>
				<div class="agregarCurso--aula">
					<label for="">Visibilidad en  </label>
					<div class="agregarCurso__labels">
						<div>
							<input type="radio" name="visible" value="true" @if($matter->visible) checked @endif>
							<label for="Si1">Si</label>
						</div>
						<div>
							<input type="radio" name="visible" value="false" @if(!$matter->visible) checked @endif>
							<label for="No1">No</label>
						</div>
					</div>
				</div>
				<div class="hr-line-dashed"></div>
				<div class="agregarCurso--aula">
					<label for="">Es Principal</label>
					<div class="agregarCurso__labels">
						<div>
							<input type="radio" name="principal" value="true" @if($matter->principal) checked @endif>
							<label for="Si1">Si</label>
						</div>
						<div>
							<input type="radio" name="principal" value="false" @if(!$matter->principal) checked @endif>
							<label for="No1">No</label>
						</div>
					</div>
				</div>
					<div class="hr-line-dashed"></div>
				<div class="agregarCurso--aula">
						<label for="">Cualitativa</label>
						<div class="agregarCurso__labels">
							<div>
								<input type="checkbox" name="t_calif" id="t_calif_{{$matter->id}}" {{$matter->idEstructura != null ? 'checked' : '' }} onclick="cualitativa({{$matter->id}})">
								<label for="Si1">Si&nbsp;&nbsp;&nbsp;</label>
								<div id="ver_menu_cualitativo_{{$matter->id}}"  style="display: {{$matter->idEstructura != null ? 'block' : 'none' }}">
								<select name="idEstructura" id="idEstructura{{$matter->id}}" class="form-control">
								<option value="">Sin asignación...</option>
								@foreach ($cualitativas as $cualita)
									<option value="{{$cualita->id}}" {{$matter->idEstructura == $cualita->id ? 'selected' : '' }}>{{$cualita->nombre}}</option>
								@endforeach
							</select>
							</div>
							</div>
						</div>
					</div>
				<div class="hr-line-dashed"></div>
					<div class="agregarCurso--aula">
						<div class="form-group">
							  <label for="iddocente">Docente:</label>
							  <select class="form-control" id="idDocente" name="idDocente">
							  	<option value="null">Sin Asignación...</option>
							  	@foreach($docentes as $docente)
									<option value="{{$docente->userid}}" {{$matter->idDocente == $docente->userid ? 'selected' : '' }}>{{$docente->apellidos}} {{$docente->nombres}}</option>
							    @endforeach
							  </select>
						</div>
					</div>
					</div>
					<div id="insumos" class="tab-pane fade">
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<!-- <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> -->
				<button type="input" class="btn btn-primary">GUARDAR</button>
			</div>
		</div>
	</form>
</div>
<script type="text/javascript">
	function reloadInsumos(){
		$.ajax({
            url: "{{route('showListInsumos',['matter'	=>	$matter->id ])}}",
            type: "GET",
            success: function (result, status, xhr) {
                $('#insumos').html(result)
            }, error: function (xhr, status, error) {
                alert('error')
            }
        });
	}
	function cualitativa($materia){
		var isChecked = document.getElementById('t_calif_'+$materia).checked;
		if(isChecked){
		$('#ver_menu_cualitativo_'+$materia).show();
		}else{
		$('#idEstructura'+$materia).val('');
		$('#ver_menu_cualitativo_'+$materia).hide();
		}
	}
</script>


