
@extends('layouts.master') 
@section('content')
<div id="page-wrapper" class="gray-bg dashbard-1">
    @include('layouts.nav_bar_top')
    <div class="row wrapper white-bg ">
        <div class="col-lg-12">
            <h2 class="title-page">Historial de Uso</h2>
        </div>
	</div>
    <div class="row mt-1 mb350">
        <div class="col-lg-12">
			<form method="get">
				<div class="historialDeUso__search-flex">
					<input type="search" name="search" placeholder="Buscar..." value="{{request('search')}}" class="inputSearch mb-0">
					<select class="form-control" name="perfil">
						<option value="" {{request('perfil') == '' ? 'selected' : ''}} >Seleccione un perfil</option>
						@foreach (['Administrador', 'Docente', 'Estudiante', 'Representante'] as $perfil)
							<option value="{{$perfil}}" {{request('perfil') == $perfil ? 'selected' : ''}} >{{$perfil}}</option>
						@endforeach
					</select>
					<button class="btn btn-primary" type="submit">Buscar</button>
				</div>
			</form>
			<div id="admin-list" class="a-matricula__estudiantes">
				@foreach($users as $user)
					@component('partials.historial._card', 
						['user' => $user])
					@endcomponent
				@endforeach
			</div>
			<div class="matricula__pagination">
				{{ $users->appends(request(['search', 'perfil']))->links() }}
			</div>
        </div>
    </div>
</div>
@endsection
@include('partials.historial.modalEditarEstado')
<script type="text/javascript">
    function myFunction() {
        var input, filter, adminList, p, a, i;
        input = document.getElementById('admin-search');
        filter = input.value.toUpperCase();
        adminList = document.getElementById("admin-list");
        p = adminList.getElementsByTagName('h3');
        for (i = 0; i < p.length; i++) {
            if (p[i].id.indexOf('admin') > -1) {
                var name = p[i].innerHTML;
                var splt = name.split(">");
                if (splt[0].toUpperCase().indexOf(filter) > -1) {
                    $(p[i]).closest('div.ibox-content').css("display", "");
                } else {
                    $(p[i]).closest('div.ibox-content').css("display", "none");
                }
            }
        }
    }
</script>