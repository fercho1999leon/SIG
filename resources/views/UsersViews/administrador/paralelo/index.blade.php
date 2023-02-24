@extends('layouts.master') 
@section('content')
@include('partials.loader.loader')

<div id="page-wrapper" class="gray-bg dashbard-1">
    @include('barra.administrador')
    <div class="row wrapper white-bg titulo-separacion noBefore">
        <div class="col-xs-12 titulo-separacion">
            <h2 class="title-page">Paralelo</h2>
        </div>

        <div class="agregarSeccionCont">
        <a href="{{ route('createCarreras') }}">
            <button class="btn dirConfiguraciones__instituto--agregarInfo" >Agregar Paralelo</button>
        </a>
    </div>
    </div>
    <hr class="dirConfiguraciones__instituto--hr">

    
    
            <div class="tabs-container">
                <ul class="nav nav-tabs">
                    <li>
                        <a data-toggle="tab" href="#tab-1">Paralelo</a>
                    </li>
   
                
                  
                </ul>
        

            </div>
      

    
	<form method="get">
		<div class="a-matricula__estudiantes">
			<input type="search" name="search" id="career-search" placeholder="Buscar..." class="inputSearch" value="{{request()->search}}">
		</div>
	</form>
    <!--<div id="career-list" class="a-listaPersonal">
		@foreach($careers as $career)
			<div class="fAdministrativo">
				<div class="a-personal-administrativo__card relative">
					
					<p class="a-nombre-administrativo"> {{ $career->nombre }} </p>
					<hr class="a-hr-administrativo">
					<div class="text-center a-personal-administrativo__icons">
						
						<div>
							
							
							<span>
								<a href="{{route('carrera_update_post',$career)}}" class="icon__editar">
									<i class="fa fa-pencil"></i>
								</a>
							</span>
							
							<span>


                            <form action="{{route('carrera_update_delete',$career)}}" method="post" class="icon__eliminar-form form-delete" onclick="return confirm('¿Seguro desea eliminar a esta Materia?')" >
							
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
    -->






</div>
@endsection
@section('scripts')
<script>
$('#mySelect').change(function () {    
    window.location.href = "#" +  $('#mySelect').val();
});
</script>
@endsection
