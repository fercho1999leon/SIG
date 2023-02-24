@extends('layouts.master') 
@section('content')
@include('partials.loader.loader')

<div id="page-wrapper" class="gray-bg dashbard-1">
    @include('barra.administrador')
    <div class="row wrapper white-bg titulo-separacion noBefore">
        <div class="col-xs-12 titulo-separacion">
            <h2 class="title-page">Insumos</h2>
        </div>
      
        <div class="agregarSeccionCont">
        <a href="crearCarreraSemestre/{{$id}}">
            <button class="btn dirConfiguraciones__instituto--agregarInfo" >Añadir Insumos</button>
        </a>
		
		<a class="button-br" href="{{ route('cursosEdicion') }}">
		<button>
			<img src="{{secure_asset('img/return.png')}}" alt="" width="17"> Regresar
		</button>
	</a>
    </div>
    </div>
    <hr class="dirConfiguraciones__instituto--hr">

    

            <div class="tabs-container">
                <ul class="nav nav-tabs">
                    <li>
                        <a data-toggle="tab" href="#tab-1">Insumos</a>
                    </li>
   
                
                  
                </ul>
              
            </div>
            <div>
            <!--{{ $id }}-->
            </div>







			
    
	
    

    <div id="semester-list" class="a-listaPersonal">
		@foreach($semesters as $semester)
			<div class="fAdministrativo">
				<div class="a-personal-administrativo__card relative">
					
					<p class="a-nombre-administrativo"> {{ $semester->nombsemt }} </p>
					<hr class="a-hr-administrativo">
					<div class="text-center a-personal-administrativo__icons">
						
						<div>
							
							
							<span>
							<!--href="semestres/Semestres/modificar/{{$semester['id']}}"-->
								<a href="semestres/Semestres/modificar/{{$semester['id']}}" class="icon__editar">
									<i class="fa fa-pencil"></i>
								</a>
							</span>
							
							<span>


                            <form action="{{route('semestre_update_delete',$semester)}}" method="post" class="icon__eliminar-form form-delete" onclick="return confirm('¿Seguro desea eliminar a este Semestre?')" >
							
									<input name="_method" type="hidden" value="DELETE">
									<input type="hidden" name="_token" value="{{ csrf_token() }}">
									<button type="submit" class="icon__eliminar-btn fz19">
										<i class="fa fa-trash"></i>
									</button>
								</form>
							</span>

							
							<span>
							



								<!--<a href="curso/semestre/{{$semester['id']}}" class="icon__ver">-->
								<!--<button id="btnCourse1" class="btn" data-toggle="modal" data-target="#dirModalAgregarMateria{{$semester->id}}" onclick="fillModal({{$semester->id}})">
                                            <img src="{{secure_asset('img/circle-more.svg')}}" width="15" alt="">Agregar Materia
                                        </button>

								<a href="{{ route('institucionMaterias') }}" class="icon__ver">
									<i class="fa fa-eye"></i>
								</a>


                                            <img src="{{secure_asset('img/circle-more.svg')}}" width="15" alt="">Agregar Materia
                                        </button>
								-->
								<a href="curso/semestre/{{$semester['id']}}" class="icon__ver">
								<i class="fa fa-eye"></i>
								</a>
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



<script type="text/javascript">
	$(document).ready(function() {
		$('.js-example-basic-single').select2();
	});
	function fillModal(avg){
		$('#idCurso').val(avg)
	}
	$('.dirConfiguraciones__materias--linkEdit').click(function(e){
		e.preventDefault()
		 $.ajax({
            url: $(this).attr('href'),
            type: "GET",
            success: function (result, status, xhr) {
                $('#dirModalEditarMateria').html(result)
                $('#dirModalEditarMateria').modal('show')
            }, error: function (xhr, status, error) {
                alert('error')
            }
        });
	});
	$('.mostrar_orden_materias').click(function(e){
		e.preventDefault()
		 $.ajax({
            url: $(this).attr('href'),
            type: "GET",
            success: function (result, status, xhr) {
                $('#dirModalEditarMateria').html(result)
                $('#dirModalEditarMateria').modal('show')
            }, error: function (xhr, status, error) {
                alert('error')
            }
        });
	});

	var url = window.location.origin
	
	function cualitativa($curso){
		var isChecked = document.getElementById('t_calif'+$curso).checked;
		if(isChecked){
		$('#ver_menu_cualitativo'+$curso).show();
		}else{
		$('#ver_menu_cualitativo'+$curso).hide();
		}
	}
		function ordenar($curso){
		alert($curso);
	}
	function verOcultar($seccion){
		var visible = $('#'+$seccion).is(":visible");
		if (visible) {
			$('#'+$seccion).hide('');
		}else{
			$('#'+$seccion).show('');
		}
	}
</script>
@endsection
