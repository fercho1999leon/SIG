@php
    $permiso = App\Permiso::desbloqueo('materiasEdicion');
@endphp
@extends('layouts.master')
@if ($permiso == null || ( $permiso != null && $permiso->ver == 1 ))
@section('content')
    <a class="button-br" href="{{ route('configuraciones') }}">
        <button>
            <img src="img/return.png" alt="" width="17">Regresar
        </button>
    </a>
    <div id="page-wrapper" class="gray-bg dashbard-1">
        @include('layouts.nav_bar_top')
        <div class="row wrapper white-bg">
            <div class="col-lg-8">
                <h2 class="title-page">Configuraciones
                    <small>Materias</small>
                </h2>
            </div>
            <div class="col-lg-4">
                <button class="btn btn-info">
                <a class="mostrar_orden_materias" href="{{route('insumos.index')}}" style="color: white;"><i class="fa fa-cogs" >&nbsp;</i>Insumos</a>
                </button>
                <button class="btn btn-info">
                <a class="mostrar_orden_materias" href="{{route('estructuras.index')}}" style="color: white;"><i class="fa fa-cogs" >&nbsp;</i>Estructuras Cualitativas</a>
                </button>
            </div>
        </div>
        @php
            $PorcentajeInsumo = App\ConfiguracionSistema::InsumoPorcentual()->valor;
            $bandera = '';
        @endphp
        {{-- Educación Inicial --}}
        @if($regimen=='Regular')
            @foreach($courses->where('seccion', 'EI') as $course)
                @php
                    $titulo = $bandera == $course->seccion ? false : true;
                @endphp
                @if($titulo)
                    <div class="row text-center">
                        <div class="col-lg-12 barra-inicial" >
                            <button class="btn btn-link" onclick="verOcultar('{{$course->seccion}}')">
                                <h3 class="m-0 p-1 color-white">EDUCACION INICIAL</h3>
                            </button>
                            @if($PorcentajeInsumo=='1')
                                <button class="btn btn-primary">
                                    <a class="mostrar_orden_materias" href="{{route('confInsumoSeccion',['seccion' => $course->seccion])}}" style="color: white;"><i class="fa fa-cog" >&nbsp;</i>Insumos</a>
                                </button>
                            @endif
                        </div>
                    </div>
                @endif
                @php
                    $bandera = $course->seccion;
                @endphp
            @endforeach
            <div style="display: none;" id='EI'>
                @foreach($courses->where('seccion', 'EI') as $course)
                    <div class="wrapper wrapper-content animated fadeInRight" >
                        <div class="dirConfiguraciones__cursos">
                            <div class="dirConfiguraciones__cursos__seccion">
                                <div class="d-ib">
                                    <div class="dirConfiguraciones__materias-cont">
                                        <h2 class="dirConfiguraciones__cursos__seccion--title" onclick="verOcultar('curso{{$course->id}}')" style="cursor: pointer;">{{$course->grado}} {{$course->paralelo}} {{$course->especializacion}}</h2>
                                        <button id="btnCourse1" class="btn" data-toggle="modal" data-target="#dirModalAgregarMateria{{$course->id}}" onclick="fillModal({{$course->id}})">
                                            <img src="{{secure_asset('img/circle-more.svg')}}" width="15" alt="">Agregar Materia
                                        </button>
                                        <button id="btnordenar" class="btn" data-toggle="modal">
                                            <a class="mostrar_orden_materias" href="{{route('getMatterOrder',['curso' => $course->id])}}" style="color: white;"><i class="fa fa-list-ul" >&nbsp;</i>Ordenar Materias</a>
                                        </button>
                                    </div>
                                </div>
                                <div class="configuracionesMaterias-grid" id="curso{{$course->id}}" style="display: none;">
                                    @php
                                        $matters = App\Matter::getMattersByCourseConfig($course->id);
                                    @endphp
                                    @foreach($matters as $matter)
                                        <div class="configuracionesMaterias__item" id="{{$matter->id}}">
                                            <p  class="no-margin bold">{{$matter->nombre}}</p>
                                            <div class="configuracionesMaterias__btnEdit">
                                                <a class="dirConfiguraciones__materias--linkEdit" href="{{route('getMatter',['matter' => $matter->id])}}">Editar</a>
                                                <span>
                                                    <div class="icon__eliminar-form form-delete m-0" onclick="eliminarMateria({{$matter->id}})">
                                                        <input name="_method" type="hidden" value="DELETE">
                                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                        <button type="submit" class="icon__eliminar-btn">
                                                            <i class="fa fa-trash"></i>
                                                        </button>
                                                    </div>
                                                </span>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                    @include('partials.configuraciones.modalAgregarMateria',[
                        'course' => $course
                    ])
                @endforeach
            </div>
        @endif
        {{-- Educación General Básica--}}
        @if($regimen=='Regular')
            @foreach($courses->where('seccion', 'EGB') as $course)
                @php
                    $titulo = $bandera == $course->seccion ? false : true;
                @endphp
                @if($titulo)
                    <div class="row text-center">
                            <div class="col-lg-12 barra-inicial" >
                            <button class="btn btn-link" onclick="verOcultar('{{$course->seccion}}')">
                                <h3 class="m-0 p-1 color-white">EDUCACION GENERAL BASICA</h3>
                            </button>
                            @if($PorcentajeInsumo=='1')
                                <button class="btn btn-primary">
                                <a class="mostrar_orden_materias" href="{{route('confInsumoSeccion',['seccion' => $course->seccion])}}" style="color: white;"><i class="fa fa-cog" >&nbsp;</i>Insumos</a>
                                </button>
                            @endif
                        </div>
                    </div>
                @endif
                @php
            $bandera = $course->seccion;
            @endphp
            @endforeach
            <div style="display: none;" id='EGB'>
                @foreach($courses->where('seccion', 'EGB') as $course)
                    <div class="wrapper wrapper-content animated fadeInRight">
                        <div class="dirConfiguraciones__cursos">
                            <div class="dirConfiguraciones__cursos__seccion">
                                <div class="d-ib">
                                    <div class="dirConfiguraciones__materias-cont">
                                        <h2 class="dirConfiguraciones__cursos__seccion--title" onclick="verOcultar('curso{{$course->id}}')" style="cursor: pointer;">{{$course->grado}} {{$course->paralelo}} {{$course->especializacion}}</h2>
                                        <button id="btnCourse1" class="btn" data-toggle="modal" data-target="#dirModalAgregarMateria{{$course->id}}" onclick="fillModal({{$course->id}})">
                                            <img src="{{secure_asset('img/circle-more.svg')}}" width="15" alt="">Agregar Materia
                                        </button>
                                        <button id="btnordenar" class="btn" data-toggle="modal">
                                            <a class="mostrar_orden_materias" href="{{route('getMatterOrder',['curso' => $course->id])}}" style="color: white;"><i class="fa fa-list-ul" >&nbsp;</i>Ordenar Materias</a>
                                        </button>
                                    </div>
                                </div>
                                <div class="configuracionesMaterias-grid" id="curso{{$course->id}}" style="display: none;">
                                    @php
                                        $matters = App\Matter::getMattersByCourseConfig($course->id);
                                    @endphp
                                    @foreach($matters as $matter)
                                        <div class="configuracionesMaterias__item" id="{{$matter->id}}">
                                            <p  class="no-margin bold">{{$matter->nombre}}</p>
                                            <div class="configuracionesMaterias__btnEdit">
                                                <a class="dirConfiguraciones__materias--linkEdit" href="{{route('getMatter',['matter' => $matter->id])}}">Editar</a>
                                                <span>
                                                    <div class="icon__eliminar-form form-delete m-0" onclick="eliminarMateria({{$matter->id}})">
                                                        <input name="_method" type="hidden" value="DELETE">
                                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                        <button type="submit" class="icon__eliminar-btn">
                                                            <i class="fa fa-trash"></i>
                                                        </button>
                                                    </div>
                                                </span>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            @php
                            $bandera = $course->seccion;
                            @endphp
                        </div>
                    </div>
                    @include('partials.configuraciones.modalAgregarMateria',[
                        'course' => $course
                    ])
                @endforeach
            </div>
        @else
            @if($course->grado=='Octavo' )
                @php
                    $titulo = $bandera == $course->seccion ? false : true;
                @endphp
                @if($titulo)
                    <div class="row text-center">
                        <div class="col-lg-12 barra-inicial">
                            <h3 class="m-0 p-1 color-white"> {{ $course->seccion }}
                            </h3>
                        </div>
                    </div>
                @endif
                <div class="wrapper wrapper-content animated fadeInRight">
                    <div class="dirConfiguraciones__cursos">
                        <div class="dirConfiguraciones__cursos__seccion">
                            <div class="d-ib">
                                <div class="dirConfiguraciones__materias-cont">
                                    <h2 class="dirConfiguraciones__cursos__seccion--title" onclick="verOcultar('curso{{$course->id}}')" style="cursor: pointer;">{{$course->grado}} {{$course->paralelo}} {{$course->especializacion}}</h2>
                                <button id="btnCourse1" class="btn" data-toggle="modal" data-target="#dirModalAgregarMateria{{$course->id}}" onclick="fillModal({{$course->id}})">
                                        <img src="{{secure_asset('img/circle-more.svg')}}" width="15" alt="">Agregar Materia
                                    </button>
                                    <button id="btnordenar" class="btn" data-toggle="modal">
                                    <a class="mostrar_orden_materias" href="{{route('getMatterOrder',['curso' => $course->id])}}" style="color: white;"><i class="fa fa-list-ul" >&nbsp;</i>Ordenar Materias</a>
                                </button>
                                </div>
                            </div>
                            <div class="configuracionesMaterias-grid" id="curso{{$course->id}}" style="display: none;">
                                @php
                                    $matters = App\Matter::getMattersByCourseConfig($course->id);
                                @endphp
                                @foreach($matters as $matter)
                                    <div class="configuracionesMaterias__item" id="{{$matter->id}}">
                                        <p  class="no-margin bold">{{$matter->nombre}}</p>
                                        <div class="configuracionesMaterias__btnEdit">
                                            <a class="dirConfiguraciones__materias--linkEdit" href="{{route('getMatter',['matter' => $matter->id])}}">Editar</a>
                                            <span>
                                                <div class="icon__eliminar-form form-delete m-0" onclick="eliminarMateria({{$matter->id}})">
                                                    <input name="_method" type="hidden" value="DELETE">
                                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                    <button type="submit" class="icon__eliminar-btn">
                                                        <i class="fa fa-trash"></i>
                                                    </button>
                                                </div>
                                            </span>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        @php
                        $bandera = $course->seccion;
                        @endphp
                    </div>
                </div>
                @include('partials.configuraciones.modalAgregarMateria',[
                    'course' => $course
                ])
            @endif
        @endif
        {{-- Bachillearto General Unificado --}}
        @if($regimen=='Regular')
            @foreach($courses->where('seccion', 'BGU') as $course)
                @php
                    $titulo = $bandera == $course->seccion ? false : true;
                @endphp
                @if($titulo)
                    <div class="row text-center">
                        <div class="col-lg-12 barra-inicial" >
                            <button class="btn btn-link" onclick="verOcultar('{{$course->seccion}}')">
                                <h3 class="m-0 p-1 color-white">BACHILLERATO GENERAL UNIFICADO</h3>
                            </button>
                            @if($PorcentajeInsumo=='1')
                                <button class="btn btn-primary">
                                <a class="mostrar_orden_materias" href="{{route('confInsumoSeccion',['seccion' => $course->seccion])}}" style="color: white;"><i class="fa fa-cog" >&nbsp;</i>Insumos</a>
                                </button>
                            @endif
                        </div>
                    </div>
                @endif
                @php
                $bandera = $course->seccion;
                @endphp
            @endforeach
            <div style="display: none;" id='BGU'>
                @foreach($courses->where('seccion', 'BGU') as $course)
                    <div class="wrapper wrapper-content animated fadeInRight">
                        <div class="dirConfiguraciones__cursos">
                            <div class="dirConfiguraciones__cursos__seccion">
                                <div class="d-ib">
                                    <div class="dirConfiguraciones__materias-cont">
                                        <h2 class="dirConfiguraciones__cursos__seccion--title" onclick="verOcultar('curso{{$course->id}}')" style="cursor: pointer;">{{$course->grado}} {{$course->paralelo}} {{$course->especializacion}}</h2>
                                    <button id="btnCourse1" class="btn" data-toggle="modal" data-target="#dirModalAgregarMateria{{$course->id}}" onclick="fillModal({{$course->id}})">
                                            <img src="{{secure_asset('img/circle-more.svg')}}" width="15" alt="">Agregar Materia
                                        </button>
                                        <button id="btnordenar" class="btn" data-toggle="modal">
                                            <a class="mostrar_orden_materias" href="{{route('getMatterOrder',['curso' => $course->id])}}" style="color: white;"><i class="fa fa-list-ul" >&nbsp;</i>Ordenar Materias</a>
                                        </button>
                                    </div>
                                </div>
                                <div class="configuracionesMaterias-grid" id="curso{{$course->id}}" style="display: none;">
                                    @php
                                        $matters = App\Matter::getMattersByCourseConfig($course->id);
                                    @endphp
                                    @foreach($matters as $matter)
                                        <div class="configuracionesMaterias__item" id="{{$matter->id}}">
                                            <p  class="no-margin bold">{{$matter->nombre}}</p>
                                            <div class="configuracionesMaterias__btnEdit">
                                                <a class="dirConfiguraciones__materias--linkEdit" href="{{route('getMatter',['matter' => $matter->id])}}">Editar</a>
                                                <span>
                                                    <div class="icon__eliminar-form form-delete m-0" onclick="eliminarMateria({{$matter->id}})">
                                                        <input name="_method" type="hidden" value="DELETE">
                                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                        <button type="submit" class="icon__eliminar-btn">
                                                            <i class="fa fa-trash"></i>
                                                        </button>
                                                    </div>
                                                </span>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            @php
                            $bandera = $course->seccion;
                            @endphp
                        </div>
                    </div>
                    @include('partials.configuraciones.modalAgregarMateria',[
                        'course' => $course
                    ])
                @endforeach
            </div>
        @else
            @php
                $titulo = $bandera == $course->seccion ? false : true;
            @endphp
            @if($titulo)
                <div class="row text-center">
                    <div class="col-lg-12 barra-inicial">
                        <h3 class="m-0 p-1 color-white"> {{ $course->seccion }}
                        </h3>
                    </div>
                </div>
            @endif
            <div class="wrapper wrapper-content animated fadeInRight">
                <div class="dirConfiguraciones__cursos">
                    <div class="dirConfiguraciones__cursos__seccion">
                        <div class="d-ib">
                            <div class="dirConfiguraciones__materias-cont">
                                <h2 class="dirConfiguraciones__cursos__seccion--title" onclick="verOcultar('curso{{$course->id}}')" style="cursor: pointer;">{{$course->grado}} {{$course->paralelo}} {{$course->especializacion}}</h2>
                            <button id="btnCourse1" class="btn" data-toggle="modal" data-target="#dirModalAgregarMateria{{$course->id}}" onclick="fillModal({{$course->id}})">
                                    <img src="{{secure_asset('img/circle-more.svg')}}" width="15" alt="">Agregar Materia
                                </button>
                                <button id="btnordenar" class="btn" data-toggle="modal">
                                <a class="mostrar_orden_materias" href="{{route('getMatterOrder',['curso' => $course->id])}}" style="color: white;"><i class="fa fa-list-ul" >&nbsp;</i>Ordenar Materias</a>
                            </button>
                            </div>
                        </div>
                        <div class="configuracionesMaterias-grid" id="curso{{$course->id}}" style="display: none;">
                            @php
                                $matters = App\Matter::getMattersByCourseConfig($course->id);
                            @endphp
                            @foreach($matters as $matter)
                                <div class="configuracionesMaterias__item" id="{{$matter->id}}">
                                    <p  class="no-margin bold">{{$matter->nombre}}</p>
                                    <div class="configuracionesMaterias__btnEdit">
                                        <a class="dirConfiguraciones__materias--linkEdit" href="{{route('getMatter',['matter' => $matter->id])}}">Editar</a>
                                        <span>
                                            <div class="icon__eliminar-form form-delete m-0" onclick="eliminarMateria({{$matter->id}})">
                                                <input name="_method" type="hidden" value="DELETE">
                                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                <button type="submit" class="icon__eliminar-btn">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            </div>
                                        </span>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    @php
                    $bandera = $course->seccion;
                    @endphp
                </div>
            </form>
            @include('partials.configuraciones.modalAgregarMateria',[
                'course' => $course
            ])
        @endif
    </form>

    <!-- Modificacion de Materias-->
    <div class="modal fade" id="dirModalEditarMateria" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    </div>
    <!--fin-->

@endsection

@else
    <div id="page-wrapper" class="gray-bg dashbard-1">
        @include('layouts.nav_bar_top')
        <div class="row wrapper white-bg ">
            <div class="col-lg-12 titulo-separacion">
                <h2 class="title-page">NO TIENE PERMISOS NECESARIOS.</h2>
            </div>
        </div>
    </div>
@endif

@section('scripts')
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
	function eliminarMateria(idMateria) {
		Swal.fire({
			title: '¿Seguro desea eliminar la materia?',
			icon: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: 'SI',
			cancelButtonText: 'NO'
			}).then((result) => {
				if (result.value) {
					$.ajax({
						type: "POST",
						url: `${url}/materiasEdicion/delete/${idMateria}`,
						data: {
							'_token': $('input[name=_token]').val(),
							'_method': 'DELETE'
						},
						success: function (response) {
							$('#'+idMateria).css('display', 'none')
							Swal.fire(
								'La materia ha sido eliminada!',
								'',
								'success'
							)
						}, error: function(response) {
							alert('Algo salio mal.')
						}
					});

			}
		})
	}
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