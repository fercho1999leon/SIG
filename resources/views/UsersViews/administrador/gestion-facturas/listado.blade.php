@extends('layouts.master')
@section('content')
	<a class="button-br" href="{{route('gestionfactura.index')}}">
		<button>
			<img src="{{secure_asset('img/return.png')}}" alt="" width="17"> Regresar
		</button>
	</a>
    <div id="page-wrapper" class="gray-bg dashbard-1">
        @include('layouts.nav_bar_top')
		<div class="row wrapper white-bg ">
			<div class="col-lg-12 titulo-separacion">
				<h2 class="title-page">Gestión de facturas</h2>
            </div>
        </div>
		<div class="row mt-1 mb350">
			<div class="col-xs-12 bg-white p-10">
				<table class="s-calificaciones w-full mx-auto bg-white max-w-lg">
					<tr class="table__bgBlue">
						<td width="5" class="text-center">#</td>
						<td>Factura</td>
					</tr>
					@foreach ($xmls ?? ['Por favor, selecciona al menos uno del listado de xmls'] as $xml)
						<tr>
							<td class="text-center">{{$loop->index+1}}</td>
							<td>{{$xml}}</td>
						</tr>
					@endforeach
				</table>
			</div>
		</div>
	</div>
@endsection

