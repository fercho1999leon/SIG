@php
use App\Supply;
$insumos = Supply::getSuppliesByMatter($matter->id);
$PorcentajeInsumo = App\ConfiguracionSistema::InsumoPorcentual()->valor;
@endphp
	<table class="table">
		<tbody>
			@foreach($insumos as $insumo)
			<tr><td>{{$loop->iteration.'.'}} &nbsp; {{$insumo->nombre}}</td>
                @if($PorcentajeInsumo==1)
                <td>{{$insumo->porcentaje}} %</td>
                @endif
				<td><a href="{{route('showInsumo',['supply'	=>	$insumo->id])}}" class="btn btn-primary btn_Insumos_Editar">Editar</a></td>
				<td><a href="{{route('deleteInsumo',['supply'	=>	$insumo->id])}}" class="btn btn-danger btn_Insumos_Eliminar">Eliminar</a></td>
			</tr>
			@endforeach
		</tbody>
	</table>

	<button class="btn btn-primary btn_agregar_insumo" name="{{route('getaddInsumo',['matter'=> $matter->id])}}" >Agregar Insumo +</button>
	<div id="response-form"></div>
<script type="text/javascript">
$('.btn_agregar_insumo').click(function(e){
		e.preventDefault()
		 $.ajax({
            url: $(this).attr('name'),
            type: "GET",

            success: function (result, status, xhr) {
                $('#response-form').html(result)
            }, error: function (xhr, status, error) {
                alert('error')
            }
        });
	});

	$('.btn_Insumos_Eliminar').click(function(e){
		e.preventDefault()
		 $.ajax({
            url: $(this).attr('href'),
            type: "GET",

            success: function (result, status, xhr) {
                $('#response').html(result)
                reloadInsumos()
            }, error: function (xhr, status, error) {
                alert('error')
            }
        });
	});

	$('.btn_Insumos_Editar').click(function(e){
		e.preventDefault()
		 $.ajax({
            url: $(this).attr('href'),
            type: "GET",

            success: function (result, status, xhr) {
                $('#response-form').html(result)
            }, error: function (xhr, status, error) {
                alert('error')
            }
        });
	});
</script>