@extends('layouts.master')
@section('content')
    <div id="page-wrapper" class="gray-bg dashbard-1">
        @include('layouts.nav_bar_top')
		<div class="row wrapper white-bg ">
			<div class="col-lg-12 titulo-separacion">
				<h2 class="title-page">Gestión de facturas</h2>
            </div>
        </div>
		<div class="row mt-1 mb350">
			<div class="col-xs-12 bg-white p-10">
				<form action="{{route('gestionfactura.show')}}" method="POST">
					{{ csrf_field() }}
					<table class="s-calificaciones w-full mx-auto bg-white max-w-lg">
						<tr class="table__bgBlue">
							<td width="5" class="text-center">#</td>
							<td>Factura</td>
							<td width="5" class="text-center">
								<input type="checkbox" id="checkbox_top">
							</td>
						</tr>
						@foreach ($xmls as $xml)
							<tr>
								<td class="text-center">{{$loop->index+1}}</td>
								<td>{{substr($xml,11,1000)}}</td>
								<td>
									<input type="checkbox" class="xml" name="xml_files[]" value="{{substr($xml,11,1000)}}">
								</td>
							</tr>
						@endforeach
					</table>
					<div class="text-center">
						<button type="submit" class="mt-1 btn btn-primary">ENVIAR</button>
					</div>
				</form>
			</div>
		</div>
	</div>
	<script>
		const all_checkbox = document.querySelectorAll(".xml")
		const checbox_top = document.getElementById('checkbox_top')
		checbox_top.addEventListener('click', function() {
			if (checbox_top.checked === true) {
				return all_checkbox.forEach(e => e.checked = true);
			} 
			all_checkbox.forEach(e => e.checked = false);
		})
	</script>
@endsection

