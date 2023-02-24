@php
$permiso = App\Permiso::desbloqueo('homePeriodo');
@endphp
@extends('layouts.master')
@if ($permiso == null || ( $permiso != null && $permiso->ver == 1 ))
@section('content')
@include('partials.loader.loader')
<div id="page-wrapper" class="gray-bg dashbard-1">
    @include('layouts.nav_bar_top')
    <div class="row wrapper white-bg ">
        <div class="col-lg-12 titulo-separacion">
            <h2 class="title-page">Configuración <small>Periodo Lectivo</small>
            </h2>
        </div>
    </div>
    <div id="principalPanel" class="col-xs-6 mt-1">
        @section('contentPanel')
        @endsection
    </div>
    <div class="col-xs-12 mt-1">
    </div>
    <div id="unidadesPanel" class="col-xs-6 mt-1">
        @section('UnidadesGenerales')
        @endsection
    </div>
    <div id="ParcialesPeriodicos" class="col-xs-6 mt-1">
        @section('parcialesP')
        @endsection
    </div>
</div>
@endsection
<div class="modal" id="NuevoP" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Nuevo Periodo</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="respuesta"></div>
                <form method="POST" id="formaddPeriodo">
                    {{csrf_field()}}
                    <input type="hidden" name="id" value="" id="id">
                    <div class="matricula__matriculacion__input">
                        <label for="" class="matricula__matriculacion-label">Nombres <span class="valorError">*</span></label>
                        <input type="text" class="form-control input-sm" name="nombre" id="nombre" minlength="2" maxlength="100" placeholder="Nombres del Periodo" value="">
                    </div>
                    <div class="matricula__matriculacion__input">
                        <label for="" class="matricula__matriculacion-label">Régimen <span class="valorError">*</span></label>
                        <input type="text" class="form-control input-sm" name="regimen" id="regimen" minlength="2" maxlength="100" placeholder="" value="">
                    </div>
                    <div class="matricula__matriculacion__input">
                        <label for="" class="matricula__matriculacion-label">Fecha Inicial <span class="valorError">*</span> </label>
                        <input type="date" class="form-control input-sm" name="fecha_inicial" id="fecha_inicial" placeholder="" value="">
                    </div>
                    <div class="matricula__matriculacion__input">
                        <label for="" class="matricula__matriculacion-label">Fecha Final <span class="valorError">*</span></label>
                        <input type="date" class="form-control input-sm" name="fecha_final" id="fecha_final" placeholder="" value="">
                    </div>
            </div>
            <div class="modal-footer">
                <button type="submit" id="guardar" class="btn btn-primary">Guardar</button>
                <button type="button" id="actualizar" onclick="act_periodo();" class="btn btn-primary">Actualizar</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            </div>
            </form>
        </div>
    </div>
</div>
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
        const url = "{{route('homePeriodo')}}"
        const newurl = `${url}`
        ajaxRenderSection(newurl);
    });

    function ajaxRenderSection(url) {
        $.ajax({
            type: 'GET',
            url: url,
            dataType: 'json',
            success: function(data) {
                $('#principalPanel').empty().append($(data));
            },
            error: function(data) {
                var errors = data.responseJSON;
                if (errors) {
                    $.each(errors, function(i) {
                        console.log(errors[i]);
                    });
                }
            }
        });
    }

    function ajaxRenderSectionUnidades(url) {
        $.ajax({
            type: 'GET',
            url: url,
            dataType: 'json',
            success: function(data) {
                $('#unidadesPanel').empty().append($(data));
            },
            error: function(data) {
                var errors = data.responseJSON;
                if (errors) {
                    $.each(errors, function(i) {
                        console.log(errors[i]);
                    });
                }
            }
        });
    }

    function ajaxRenderSectionParciales(url) {
        $.ajax({
            type: 'GET',
            url: url,
            dataType: 'json',
            success: function(data) {
                $('#ParcialesPeriodicos').empty().append($(data));
            },
            error: function(data) {
                var errors = data.responseJSON;
                if (errors) {
                    $.each(errors, function(i) {
                        console.log(errors[i]);
                    });
                }
            }
        });
    }

    function nuevoPeriodo() {
        $("#formaddPeriodo")[0].reset();
        $('#NuevoP').modal('show');
        $('#guardar').show();
        $('#actualizar').hide();
    }

    function nuevaUnidad() {
        $("#formaddUnidad")[0].reset();
        $('#NuevaUnidad').modal('show');
        $('#guardarU').show();
        $('#actualizarU').hide();
    }

    function nuevoParcial() {
        $("#formaddParcialP")[0].reset();
        $('#NuevoParcial').modal('show');
        $('#guardarP').show();
        $('#actualizarP').hide();
    }

    function eliminarParcial($id, $idUnidad) {
        var urlNew = "/ParcialesP/" + $idUnidad;
        Swal.fire({
            title: "Realmente desea eliminar la Unidad",
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si',
            cancelButtonText: 'No'
        }).then((result) => {
            $.ajax({
                url: "/ParcialesP/delete/" + $id,
                type: "GET",
                data: $(this).serialize(),
                success: function(result, status, xhr) {
                    ajaxRenderSectionParciales(urlNew);
                },
                error: function(xhr, status, error) {
                    mensaje = '<div class="alert alert-danger" role="alert">' + xhr['responseText'] + '</div>';
                    $('#respuestaParcial').html(mensaje)
                }
            });
        });
    }

    function guardarParcial($id) {
        var urlNew = "/ParcialesP/" + $id;
        $.ajax({
            url: "{{route('addParcialP')}}",
            type: "POST",
            data: $('#formaddParcialP').serialize(),
            success: function(result, status, xhr) {
                $('#NuevoParcial').modal('hide');
                Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: 'Unidad Creada',
                    showConfirmButton: false,
                    timer: 1500,
                })
                ajaxRenderSectionParciales(urlNew);
            },
            error: function(xhr, status, error) {
                mensaje = '<div class="alert alert-danger" role="alert">' + xhr['responseText'] + '</div>';
                $('#respuestaParcial').html(mensaje)
            }
        });
    }

    function editarParcial($id) {
        $.ajax({
            url: "/ParcialesP/editar/" + $id,
            type: "GET",
            success: function(result, status, xhr) {
                $('#NuevoParcial').modal('show');
                $('#idParcial').val(result.id);
                $('#idUnidad').val(result.idUnidad);
                $('#nombreParcial').val(result.nombre);
                $('#fechaI').val(result.fechaI);
                $('#fechaF').val(result.fechaF);
                $('#identificadorParcial').val(result.identificador);
                if (result.activo == 1) {
                    $('#activoParcial').prop("checked", true);
                }
                $('#guardarP').hide();
                $('#actualizarP').show();
            },
            error: function(xhr, status, error) {
                mensaje = '<div class="alert alert-danger" role="alert">' + xhr['responseText'] + '</div>';
                $('#respuestaParcial').html(mensaje)
            }
        });
    }

    function actualizarParcial($id) {
        var urlNew = "/ParcialesP/" + $id;
        $.ajax({
            url: "{{route('actualizarParcialP')}}",
            type: "PUT",
            data: $('#formaddParcialP').serialize(),
            success: function(result, status, xhr) {
                Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: 'Parcial Actualizado',
                    showConfirmButton: false,
                    timer: 1500,
                })
                console.log(result);
                $('#NuevoParcial').modal('hide');
                ajaxRenderSectionParciales(urlNew);

            },
            error: function(xhr, status, error) {
                mensaje = '<div class="alert alert-danger" role="alert">' + xhr['responseText'] + '</div>';
                $('#respuestaParcial').html(mensaje)
            }
        });

    }

    function guardarUnidad($id) {
        var urlNew = "/Unidades/" + $id;
        $.ajax({
            url: "{{route('addUnidad')}}",
            type: "POST",
            data: $('#formaddUnidad').serialize(),
            success: function(result, status, xhr) {
                $('#NuevaUnidad').modal('hide');
                Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: 'Unidad Creada',
                    showConfirmButton: false,
                    timer: 1500,
                })
                ajaxRenderSectionUnidades(urlNew);
            },
            error: function(xhr, status, error) {
                mensaje = '<div class="alert alert-danger" role="alert">' + xhr['responseText'] + '</div>';
                $('#respuestaUnidad').html(mensaje)
            }
        });
    }

    function editarUnidad($id) {
        $.ajax({
            url: "/Unidades/editar/" + $id,
            type: "GET",
            success: function(result, status, xhr) {
                $('#NuevaUnidad').modal('show');
                $('#idUnidad').val(result.id);
                $('#nombreUnidad').val(result.nombre);
                $('#identificador').val(result.identificador);
                if (result.activo == 1) {
                    $('#activo').prop("checked", true);
                }
                $('#guardarU').hide();
                $('#actualizarU').show();

            },
            error: function(xhr, status, error) {
                mensaje = '<div class="alert alert-danger" role="alert">' + xhr['responseText'] + '</div>';
                $('#respuestaUnidad').html(mensaje)
            }
        });

    }

    function actualizarUnidad($id) {
        var urlNew = "/Unidades/" + $id;
        $.ajax({
            url: "{{route('actualizarUnidad')}}",
            type: "PUT",
            data: $('#formaddUnidad').serialize(),
            success: function(result, status, xhr) {
                Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: 'Unidad actualizada',
                    showConfirmButton: false,
                    timer: 1500,
                })
                console.log(result);
                $('#NuevaUnidad').modal('hide');
                ajaxRenderSectionUnidades(urlNew);

            },
            error: function(xhr, status, error) {
                mensaje = '<div class="alert alert-danger" role="alert">' + xhr['responseText'] + '</div>';
                $('#respuestaUnidad').html(mensaje)
            }
        });

    }

    function eliminarUnidad($id, $idPeriodo) {
        var urlNew = "/Unidades/" + $idPeriodo;
        Swal.fire({
            title: "Realmente desea eliminar la Unidad",
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si',
            cancelButtonText: 'No'
        }).then((result) => {
            $.ajax({
                url: "/Unidades/delete/" + $id,
                type: "GET",
                data: $(this).serialize(),
                success: function(result, status, xhr) {
                    ajaxRenderSectionUnidades(urlNew);
                },
                error: function(xhr, status, error) {
                    mensaje = '<div class="alert alert-danger" role="alert">' + xhr['responseText'] + '</div>';
                    $('#respuestaUnidad').html(mensaje)
                }
            });
        });
    }
    $('#formaddPeriodo').submit(function(e) {
        var urlNew = "{{route('homePeriodo')}}"
        e.preventDefault()
        $.ajax({
            url: "{{route('addPeriodo')}}",
            type: "POST",
            data: $(this).serialize(),
            success: function(result, status, xhr) {
                Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: 'Periodo Creado',
                    showConfirmButton: false,
                    timer: 1500,
                })
                ajaxRenderSection(urlNew);
                $("#formaddPeriodo")[0].reset();
                $('#NuevoP').modal('hide');
            },
            error: function(xhr, status, error) {
                mensaje = '<div class="alert alert-danger" role="alert">' + xhr['responseText'] + '</div>';
                $('#respuesta').html(mensaje)
            }
        });
    });

    function eliminar_Periodo($id) {
        var urlNew = "{{route('homePeriodo')}}"
        Swal.fire({
            title: "Realmente desea eliminar el Periodo",
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si',
            cancelButtonText: 'No'
        }).then((result) => {
            $.ajax({
                url: "/periodoLectivo/delete/" + $id,
                type: "GET",
                data: $(this).serialize(),
                success: function(result, status, xhr) {
                    ajaxRenderSection(urlNew);
                },
                error: function(xhr, status, error) {
                    console.log(xhr['responseText']);
                    Swal.fire({
                        position: 'top-end',
                        icon: 'error',
                        title: xhr['responseText'],
                        showConfirmButton: false,
                        timer: 1500,
                    })
                }
            });
        });

    }

    function editar_Periodo($id) {
        var urlNew = "{{route('homePeriodo')}}"

        $.ajax({
            url: "/periodoLectivo/editar/" + $id,
            type: "GET",
            data: $(this).serialize(),
            success: function(result, status, xhr) {
                $('#NuevoP').modal('show');
                $('#id').val(result.id);
                $('#nombre').val(result.nombre);
                $('#regimen').val(result.regimen);
                $('#fecha_inicial').val(result.fecha_inicial);
                $('#fecha_final').val(result.fecha_final);
                $('#guardar').hide();
                $('#actualizar').show();

            },
            error: function(xhr, status, error) {
                mensaje = '<div class="alert alert-danger" role="alert">' + xhr['responseText'] + '</div>';
                $('#respuesta').html(mensaje)
            }
        });

    }

    function ver_unidades($id) {
        $.ajax({
            url: "Unidades/" + $id,
            type: "GET",
            data: $(this).serialize(),
            success: function(data) {
                $('#unidadesPanel').empty().append($(data));
            },
            error: function(xhr, status, error) {
                mensaje = '<div class="alert alert-danger" role="alert">' + xhr['responseText'] + '</div>';
                $('#respuesta').html(mensaje)
            }
        });

    }

    function verParciales($id) {
        $.ajax({
            url: "ParcialesP/" + $id,
            type: "GET",
            data: $(this).serialize(),
            success: function(data) {
                $('#ParcialesPeriodicos').empty().append($(data));
            },
            error: function(xhr, status, error) {
                mensaje = '<div class="alert alert-danger" role="alert">' + xhr['responseText'] + '</div>';
                $('#respuesta').html(mensaje)
            }
        });

    }

    function act_periodo() {
        var urlNew = "{{route('homePeriodo')}}"
        $.ajax({
            url: "{{route('actualizarPeriodo')}}",
            type: "PUT",
            data: $('#formaddPeriodo').serialize(),
            success: function(result, status, xhr) {
                Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: 'Periodo actualizado',
                    showConfirmButton: false,
                    timer: 1500,
                })
                console.log(result);
                $('#NuevoP').modal('hide');
                ajaxRenderSection(urlNew);

            },
            error: function(xhr, status, error) {
                mensaje = '<div class="alert alert-danger" role="alert">' + xhr['responseText'] + '</div>';
                $('#respuesta').html(mensaje)

            }
        });

    }
</script>
@endsection