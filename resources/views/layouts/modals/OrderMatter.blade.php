<div class="modal-dialog dirModalAgregarGrado" role="document">
	<form action="{{route('updateMatterOrder',['curso' => $courses->id])}}" method="POST"  id="updateMatterForm">
		<input type="hidden"  name="_method" value="PUT">
		{{csrf_field()}}
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<h3>Ordenar Materias del curso: {{$courses->grado}} {{$courses->paralelo}} {{$courses->especializacion}} </h3>
				<div id="response"></div>
			</div>
			<div class="modal-body">
							<div class="configuracionesGenerales__insumos">
								<div class="configuracionesGenerales__insumos__numeros">
									@foreach($matters as $matter)
										<span>{{ $loop->iteration }}</span>
									@endforeach
								</div>
								<ul class="configuracionesGenerales__insumos-grid sortable">
									@foreach($matters as $matter)
										<li class="uppercase pointer" title="Area: {{$matter->area}}">{{ $matter->nombre }}</li>
									@endforeach
								</ul>
							</div>

					<input type="hidden" name="Orden_materia" value="" id="Orden_materia">
					<input type="hidden" name="idCurso" value="{{$courses->id}}" id="idCurso">
			</div>
			<div class="modal-footer">
				<!-- <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> -->
				<button type="input" class="btn btn-primary">GUARDAR</button>
			</div>
		</div>
	</form>
</div>
<script src="{{secure_asset('js/html5sortable.js')}}"></script>
<script>
sortable('.sortable')[0].addEventListener('sortupdate', function(e) {
	let orden =[];
	let items = sortable('.sortable', 'serialize')[0].items.forEach( (item,index) => {
		//array_push += "'"+item.node.textContent + "',";
		orden.push(item.node.textContent);
	});
	//orden = orden.substring(0,orden.length-1);
	document.getElementById('Orden_materia').value = orden;
});


