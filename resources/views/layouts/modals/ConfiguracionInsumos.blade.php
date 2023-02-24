
<div class="modal-dialog dirModalAgregarGrado" role="document">
	<form action="{{route('actInsSeccion')}}" method="POST" >
		<input type="hidden" name="seccion" value="{{$seccion}}" placeholder="">
		{{csrf_field()}}
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<h3>Configuración de insumos para la seccion: </h3>
				<div id="response"></div>
			</div>
			<div class="modal-body">
				@foreach($supply->groupBy('nombre') as $insumo)
				<div class="form-group">
				<label for="nombre">{{$loop->iteration}}</label>
				<input type="text"  id="nombre" name="nombre[]" value="{{$insumo[0]->nombre}}">
				<input type="hidden"  id="nombre_old" name="nombre_old[]" value="{{$insumo[0]->nombre}}">
				<input type="number"  id="porcentaje{{$loop->iteration}}" class="sumaPorcentajes" name="porcentaje[]" step="1" min="1" max="100" placeholder="porcentaje" value="{{$insumo[0]->porcentaje}}" onchange="suma('{{$loop->iteration}}');">
				</div>
				@endforeach
			</div>
			<div class="modal-footer">
				<!-- <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> -->
				<button type="input" class="btn btn-primary">GUARDAR</button>
			</div>
		</div>
	</form>
</div>
<script type="text/javascript">
function suma($id){
var sum = 0;
$(".sumaPorcentajes").each(function(){
sum += +$(this).val();
});
if(sum>100){
	alert('Error: La suma de los porcentajes debe ser 100');
	$('#porcentaje'+$id).val(0);
}
}
</script>


