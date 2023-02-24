<div class="modal-dialog dirModalAgregarGrado" role="document">
	<form action="{{route('updateAreaOrder',['area' => $area])}}" method="POST"  id="updateMatterForm">
		<input type="hidden"  name="_method" value="PUT">
		{{csrf_field()}}
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<h3>Ordenar Area: {{$area}} </h3>
				<div id="response"></div>
			</div>
			<div class="modal-body">
							<div class="configuracionesGenerales__insumos">
								<div class="configuracionesGenerales__insumos__numeros">
									@foreach($areasOrden as $orden)
										<span>{{ $loop->iteration }}</span>
									@endforeach
								</div>
								<ul class="configuracionesGenerales__insumos-grid sortable">
									@foreach($areasOrden as $orden)
										<li class="uppercase pointer">{{ $orden->nombre }}</li>
									@endforeach
								</ul>
							</div>

					<input type="hidden" name="posicion" value="" id="posicion">
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
	document.getElementById('posicion').value = orden;
});


