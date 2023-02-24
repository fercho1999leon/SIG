@extends('layouts.master') 
@section('content')
@include('partials.loader.loader')

<div id="page-wrapper" class="gray-bg dashbard-1">
    @include('barra.administrador')
    <div class="row wrapper white-bg titulo-separacion noBefore">
        <div class="col-xs-12 titulo-separacion">
            <h2 class="title-page">Materias</h2>
        </div>

        <div class="agregarSeccionCont">
        <a href="crearSemestreMateria/{{$id}}">
            <button class="btn dirConfiguraciones__instituto--agregarInfo" >Agregar Materias</button>
        </a>
    </div>
    </div>
    <hr class="dirConfiguraciones__instituto--hr">

    <a class="button-br" href="{{ route('cursosEdicion') }}">
		<button>
			<img src="{{secure_asset('img/return.png')}}" alt="" width="17"> Regresar
		</button>
	</a>
   

    
	<form method="get">
		<div class="a-matricula__estudiantes">
			<input type="search" name="search" id="career-search" placeholder="Buscar..." class="inputSearch" value="{{request()->search}}">
		</div>
	</form>
    
	<div id="matter-list" class="a-listaPersonal">
		@foreach($matter as $matte)
			<div class="fAdministrativo">
				<div class="a-personal-administrativo__card relative">
					
					<p class="a-nombre-administrativo"> {{ $matte->nombre }}  </p>
					<hr class="a-hr-administrativo">
					<div class="text-center a-personal-administrativo__icons">
						
						<div>
							
							
							<span>
								<a href="materias/Semestres/modificar/{{$matte['id']}}'" class="icon__editar">
									<i class="fa fa-pencil"></i>
								</a>
							</span>
							
							<span>

                            
                            <form action="{{route('materia_update_delete',$matte)}}" method="post" class="icon__eliminar-form form-delete" onclick="return confirm('¿Seguro desea eliminar a esta Materia?')" >
							
									<input name="_method" type="hidden" value="DELETE">
									<input type="hidden" name="_token" value="{{ csrf_token() }}">
									<button type="submit" class="icon__eliminar-btn fz19">
										<i class="fa fa-trash"></i>
									</button>
								</form>
							</span>

							
							


						</div>
					</div>
				</div>
			</div>
		@endforeach
	</div>




</div>
@endsection
@section('scripts')
<script>
$('#mySelect').change(function () {    
    window.location.href = "#" +  $('#mySelect').val();
});
</script>
@endsection
