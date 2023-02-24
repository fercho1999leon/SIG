@extends('layouts.master') 
@section('content')
@include('partials.loader.loader')

<div id="page-wrapper" class="gray-bg dashbard-1">
    @include('barra.administrador')
    <div class="row wrapper white-bg titulo-separacion noBefore">
        <div class="col-xs-12 titulo-separacion">
            <h2 class="title-page">Seleccione carrera</h2>
        </div>

        <div class="agregarSeccionCont">
        <!--
        <a href="{{ route('createCarreras') }}">
            <button class="btn dirConfiguraciones__instituto--agregarInfo" >Agregar Carrera</button>
        </a>
        -->
        <!--
        <a href="{{ route('semestres') }}">
            <button class="btn dirConfiguraciones__instituto--agregarInfo" >Agregar Carrera</button>
        </a>
        -->
    </div>
    </div>
    <hr class="dirConfiguraciones__instituto--hr">   
	
    <div id="career-list" class="a-listaPersonal">
		@foreach($careers as $career)
			<div class="fAdministrativo">
				<div class="a-personal-administrativo__card relative">              
                    <a href="{{route('listarOpcionesCarrerasReporte',$career->id)}}">
                        <div class="gradosCalificaciones-item reporteCurso-item">
                            <div class="gradosCalificaciones-curso" width="50px" >
                                <img src="{{secure_asset('img/iconCalificaciones.svg')}}" class="mr-05" width="20" alt=""> 
                                <p class="a-nombre-administrativo"> {{ $career->nombre }} </p>
                                <hr class="a-hr-administrativo">
                                <div class="text-center a-personal-administrativo__icons">                                    
                                    <div>
                                        <!--<span>
                                            <a data-route="#" class="icon__ver">
                                                <i class="fa fa-eye"></i>
                                            </a>
                                            carreras/Carreras/modificar/{{$career['id']}}
                                        </span>
                                        
                                        <span>
                                            <a href="carreras/Carreras/modificar/{{$career['id']}}" class="icon__editar">
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
                                        -->
                                    </div>
                                </div>                                
                            </div>
                        </div>
                    </a>
					
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
