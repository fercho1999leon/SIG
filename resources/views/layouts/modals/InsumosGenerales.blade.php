	@php
	use App\General;
	@endphp
<div class="modal-dialog dirModalAgregarGrado" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h3 class="modal-title">Configuración de Insumos Generales  <button  class="btn btn-primary float-right" onclick="nuevo();">Nuevo</button></h3>
				
			</div>
			<div class="modal-body" >
				<div id="respuesta"></div>
				<div id="nuevo" style="display: none;">
					<form  method="POST" id="formaddInsumoGeneral">
					{{csrf_field()}}
						<div class="matricula__matriculacion__input">
						<div class="form-group">
							<label for="nombre">Nombre: </label>
							<input type="text" class="form-control" id="nombre" name="nombre">
							<label for="nombre">Porcentaje: </label>
							<input type="number" class="form-control" id="porcentaje" name="porcentaje" step="1" min="0" max="100" placeholder="porcentaje">
						
						</div>
						<select id="seccion" name="carrera">
								  <!--<option value="todos">Aplica Para Todos</option>
								  <option value="EI">{{General::getSeccion('EI')}}</option>
								  <option value="EGB">{{General::getSeccion('EGB')}}</option>
								  <option value="BGU">{{General::getSeccion('BGU')}}</option>
								  <option value="todos">Aplica Para Todos</option>-->
					
									@foreach($careers as $career)
										<option value="{{ $career ['id'] }}">{{ $career ['nombre'] }}</option>
									@endforeach
								</select>
						<button  type="submit" class="btn btn-primary">Guardar</button>
						</div>
					</form>
				</div>
				<div id="editar">
				</div>
			</div>
			<div class="modal-footer">
				<div id="insumosIndex">
				
				<table class="table text-left">
					{{--<th>Nombre</th>--}}
					<!--<th>Sección</th>-->
					<!--<th>Carrera</th>-->
					<th>Acción</th>
					@foreach($insumos as $insumo)
						<tr>
							<td>{{$loop->iteration.'.'}} &nbsp; {{$insumo->nombre}}</td>
							<!--<td>{{General::getSeccion($insumo->seccion)}}</td>-->
							
							
										
							<!--<td>{{$insumo->id_carrers}}</td>-->
							
							
							
							
							{{--<td><a href="{{route('insumos.show',['supply'=>	$insumo])}}" class="btn_InsumosG_Editar"><i class="fa fa-pencil icon__editar"></i></a>
								&nbsp;<a href="{{route('deleteInsumoG',['supply'=>	$insumo])}}" class="btn_InsumosG_Eliminar"><i class="fa fa-trash icon__eliminar"></a></td>--}}
						</tr>
					@endforeach
				</table><!-- <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> -->
				</div>
				<div id="insumosNuevos">
				</div>

			</div>
		</div>
</div>
<script type="text/javascript">
	function nuevo(){
		if ($("#nuevo").is(":visible")) {
		$('#nuevo').hide();
	}else{
		$('#respuesta').hide();
		$('#editar').hide();
		$('#nuevo').show();
	}
	}
	function reloadInsumosGenerales(){
		$.ajax({
            url: "{{route('verInsumosGenerales',['id'	=>	1 ])}}",
            type: "GET",
            success: function (result, status, xhr) {
            	$('#editar').hide();
				$('#nuevo').hide();
				$('#respuesta').show();
            	$("#formaddInsumoGeneral")[0].reset();
            	$('#insumosIndex').remove();
                $('#insumosNuevos').html(result)
            }, error: function (xhr, status, error) {
                alert('error')
            }
        });
	}
    $('#formaddInsumoGeneral').submit(function(e){
    e.preventDefault()
     $.ajax({
            url: "{{route('insumos.store')}}",
            type: "POST",
            data : $( this ).serialize()  ,
            success: function (result, status, xhr) {
            	$('#respuesta').html(result)
                reloadInsumosGenerales();
                $("#formaddInsumoGeneral")[0].reset();
            }, error: function (xhr, status, error) {
            	$('#respuesta').show();
            	mensaje ='<div class="alert alert-danger" role="alert">'+xhr['responseText']+'</div>';
                $('#respuesta').html(mensaje);
            }
        });
  });
     $('.btn_InsumosG_Editar').click(function(e){
     	if ($("#nuevo").is(":visible")) {
				$('#nuevo').hide();
				}
       	$('#editar').show();
		e.preventDefault()
		 $.ajax({
            url: $(this).attr('href'),
            type: "GET",
            success: function (result, status, xhr) {
                $('#editar').html(result)
            }, error: function (xhr, status, error) {
                alert('error')
            }
        });
	});
     $('.btn_InsumosG_Eliminar').click(function(e){
		e.preventDefault()
		var txt;
		var r = confirm("Precione aceptar para eliminar");
		if (r == true) {
			 $.ajax({
	            url: $(this).attr('href'),
	            type: "GET",
	            success: function (result, status, xhr) {
	                $('#respuesta').html(result)
	                reloadInsumosGenerales()
	            }, error: function (xhr, status, error) {
	                alert('error')
	            }
	        });
		}
	});
</script>



