@extends('layouts.master2')
@section('assets')
@include('partials.loader.loader')

<link href="{{secure_asset('bootstrap-fileinput/css/fileinput.min.css')}}" media="all" rel="stylesheet" type="text/css" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
<script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css" />
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.0.3/css/buttons.dataTables.min.css">
<script src="https://cdn.datatables.net/buttons/1.5.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/datatables-buttons-excel-styles@1.2.0/js/buttons.html5.styles.min.js">
</script>
<script
    src="https://cdn.jsdelivr.net/npm/datatables-buttons-excel-styles@1.2.0/js/buttons.html5.styles.templates.min.js">
</script>


<style type="text/css">
tfoot {
    display: table-header-group;
}

div.micelda {
    text-align: left !important;
    width: 800px !important;
}
.my-swal {
  z-index: X!impotant;
}
#tablaEstudiantes {
    text-align: center;
}
</style>

<style>
    .accordion {
    background-color: #eee;
    color: #444;
    cursor: pointer;
    padding: 18px;
    width: 100%;
    border: none;
    text-align: left;
    outline: none;
    font-size: 15px;
    transition: 0.4s;
    }

    .active, .accordion:hover {
    background-color: #ccc;
    }

    .accordion:after {
    content: '\002B';
    color: #777;
    font-weight: bold;
    float: right;
    margin-left: 5px;
    }

    .active:after {
    content: "\2212";
    }

    .panel {
    padding: 0 18px;
    background-color: white;
    max-height: 0;
    overflow: hidden;
    transition: max-height 0.2s ease-out;
    }
</style>

</head>
@endsection
@section('content')
<div id="page-wrapper" class="gray-bg">
      
@if(Session::has('alert'))

<div class="alert alert-success alert-block">
  {{Session::get('alert')}}
  <button type="button" class="close" data-dismiss="alert">×</button>
</div>
@endif

    @include('layouts.nav_bar_top')
    <div class="row wrapper white-bg ">
        @if(Session::has('alertTrue'))
            <div class="alert alert-success alert-block">
            {{Session::get('alertTrue')}}
            <button type="button" class="close" data-dismiss="alert">×</button>
            </div>
        @endif
        <div class="col-lg-12 titulo-separacion">
            <h1 class="title-page">Cuentas por Cobrar </h1>
        </div>
    </div>
    
    <div class="row wrapper" style="overflow-x: auto !important;">
        <table id="tablaEstudiantes" class="table table-striped table-hover table-bordered white-bg">
            <thead>
                <tr>
                    <th>RUC-Cedula Estudiante</th>
                    <th>Nombre del Estudiante</th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <th>RUC-Cedula Estudiante</th>
                    <th>Nombre del Estudiante</th>
                </tr>
            </tfoot>
            <tbody>    
                <tr>
                    <td>
                         
                    </td>        
                </tr>
            </tbody>
        </table>
    </div>
</div>
<div class="modal fade" id="bloqueoEstudiante" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
</div>
<div class="modal fade" id="modal-editpagocxc" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Editar Pago</h4>
            </div>
            <div class="modal-body" id="animacionpagos">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
            </div>
        </div>
        <!--
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Importar Estudiantes </h4>s
                </div>
                <form method="post" action="{{route('importarEstudiantes')}}" enctype="multipart/form-data">
                    {{csrf_field()}}
                    <input id="excel" name="excel" type="file" class="file">
                </form>
            </div>
        -->
    </div>
</div>

<div class="modal fade" id="modal-pagos" style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span></button>
                <h4 class="modal-title">
                    Pagos
                    <button onclick="nuevopago()" type="button" data-toggle="tooltip" data-original-title="Nuevo Pago" aria-hidden="true" class="btn btn-primary ">
                        <i class="fa fa-money "></i> &nbsp;Pagar Cuenta de Forma Manual Colecturia
                    </button>
                </h4>

            </div>
            <div class="modal-body" id="animacionpagos">
                <h3>Historial de Pago de la Cuenta por Cobrar</h3>
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover ">
                        <thead class="thead-dark">
                        <tr><td>Id</td>
                            <td>Número de Factura</td>
                            <td>Fecha</td>
                            <td>Fecha Vencimiento</td>
                            <td>Concepto</td>
                            <td>Observaciones</td>
                            <td>Monto</td>
                         
                        </tr></thead>
                        <tbody id="id_tabla_pagos">
                            
                        </tbody>
                        <tfoot id="id_tabla_pagosfooter">
                            <tr>
                                
                               
                            </tr>
                        </tfoot>
                    </table>
                </div>

                <button type="button" class="btn btn-danger " data-dismiss="modal">Cerrar</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<div class="modal fade" id="modal-nuevopago" style="display: none;">
    <div class="modal-dialog modal-xs">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span></button>
                <h4 class="modal-title">
                    Nuevo Pago
                </h4>

            </div>
            <div class="modal-body " id="animacionpagos">
                <form id="formulariopago" enctype="multipart/form-data" >
                    <input type="hidden" id="pago_id_comprobante" >
                    <input type="hidden" id="pago_tipo_comprobante" value="1">

                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-6">
                                Fecha
                            </div>
                            <div class="col-md-6">
                                <input type="text" class="form-control" id="pago_fecha" value="2021-04-08">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-3">
                                Concepto
                            </div>
                            <div class="col-md-9">
                                <input type="text" class="form-control" id="pago_concepto">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="alert" id="message" style="display: none"></div>
                        {{ csrf_field() }}
                        <div class="form-group">
                            <table class="table">
                                <tr>
                                    <td  align="left"><label>Seleccionar archivo a cargar</label></td>
                                    <td ><input type="file" name="select_file" id="pago_archivo" required /></td>
                             
                                </tr>
                                <tr>
                                    <td align="left"></td>
                                    <td ><span class="text-muted">jpg, png, gif</span></td>
                                    <td align="left"></td>
                                </tr>
                            </table>
                        </div>

                        <br />
                        <span id="uploaded_image"></span>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-3">
                                Forma de Pago
                                <small>(Opcional)</small>
                            </div>
                            <div class="col-md-9">
                                <select id="pago_formapago" class="form-control" name="pago_formapago">
                                    <option value="01">Sin utilizacion del sistema financiero</option>
                                    <option value="16">Tarjetas de Debito</option>
                                    <option value="17">Dinero Electronico</option>
                                    <option value="18">Tarjeta Prepago</option>
                                    <option value="19">Tarjeta de Credito</option>
                                    <option selected="" value="20">Otros con Utilizacion del Sistema Financiero</option>
                                    <option value="21">Endoso de Titulos</option>
                                    <option value="15">COMPENSACIÓN DE DEUDAS</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-3">
                                Valor
                            </div>
                            <div class="col-md-9">
                                <input type="text" id="pago_valor" class="form-control validador_numero2 usd2">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-3">
                                Observacion
                                <small>(Opcional)</small>
                            </div>
                            <div class="col-md-9">
                                <textarea type="text" class="form-control" id="pago_observacion"></textarea>
                            </div>
                        </div>
                    </div>
                </form>


                <button type="button" class="btn btn-danger " data-dismiss="modal">Cerrar</button>
                <button onclick="guardarpagocxc()" type="button" data-toggle="tooltip" data-original-title="Guardar Pago" aria-hidden="true" class="btn btn-primary pull-right">
                    <i class="fa fa-money "></i> &nbsp;Guardar
                </button>
            </div>
        </div>
    </div>
    <!-- /.modal-content -->
</div>
<!-- /.modal-dialog -->


<div class="modal fade in" id="modal-nuevoretencionrecibida">
    <div class="modal-dialog modal-xs">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span></button>
                <h4 class="modal-title">
                    Nueva Retención Recibida
                </h4>

            </div>
            <div class="modal-body " id="animacionretencionrecibida">
                <form id="formularioretencionrecibida" enctype="multipart/form-data">
                    <input type="hidden" id="retencion_id_comprobante" value="5429">
                    <input type="hidden" id="retencion_tipo_comprobante" value="1">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-6">
                                Fecha
                            </div>

                            <div class="col-md-6">
                                <input type="text" class="form-control" id="retencion_fecha" value="2021-04-08">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-3">
                                Tipo Impuesto
                            </div>
                            <div class="col-md-9">
                                <select name="retencion_tipo" id="retencion_tipo" class="form-control width-middle">
                                    <option selected="true" value="2">IVA</option>
                                    <option value="1">RENTA</option>
                                    <option value="6">ISD</option>
                                </select>
                            </div>
                        </div>Seleccionar archivo a cargar
                    </div>
                    <div class="animacionrenta">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-3">
                                    Codigo Retencion
                                </div>
                                <div class="col-md-9">
                                    <select id="codigoretencion" name="codigoretencion" class="form-control">


                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="animacioncodigo">
                            <div class="row">
                                <div class="col-md-9">
                                    Porcentaje
                                </div>
                                <div class="col-md-3">
                                    <div id="porcentajediv">
                                        <div class="input-group">
                                            <input type="number" class="form-control usd5 " id="porcentaje" name="porcentaje" value="0">
                                            <div class="input-group-addon">%</div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-3">
                                        Base Imponible
                                    </div>
                                    <div class="col-md-9">
                                        <input type="text" id="retencion_base" class="form-control validador_numero2 usd2">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-3">
                                        Valor
                                        <button type="button" class="btn-primary btn-sm" onclick="calcularvaloretenido()"><i class="fa fa-fw fa-refresh"></i>
                                        </button>
                                    </div>
                                    <div class="col-md-9">
                                        <input type="text" id="retencion_valor" class="form-control validador_numero2 usd2">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-3">
                                Nro Comprobante Retención
                            </div>
                            <div class="col-md-9">
                                <input type="text" class="form-control" id="retencion_secuencial" placeholder="___-___-_________">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-3">
                                Observacion
                                <small>(Opcional)</small>
                            </div>
                            <div class="col-md-9">
                                <textarea type="text" class="form-control" id="retencion_observacion"></textarea>
                            </div>
                        </div>
                    </div>
                </form>

                <button type="button" class="btn btn-danger " data-dismiss="modal">Cerrar</button>
                <button onclick="guardarretencionrecibidacxc()" type="button" data-toggle="tooltip" data-original-title="Guardar Retención Recibida" aria-hidden="true" class="btn btn-primary pull-right">
                    <i class="fa fa-money "></i> &nbsp;Guardar
                </button>
            </div>
        </div>
    </div>
    <!-- /.modal-content -->
</div>


<div class="modal fade in" id="modal-fotopago">
    <div class="modal-dialog modal-xs">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span></button>
                <h4 class="modal-title">
                    Foto de Comprobante de Pago del Estudiante
                </h4>

            </div>
            <div class="modal-body ">
                <div>
                    <img id="cargafoto" src="https://www.webempresa.com/media/kunena/attachments/legacy/images/Untitled_3.jpg" style="width: 100%; height: 100%" alt="">
                </div>                
                <div>
                    <button type="button" class="btn btn-warning" onclick="procesarPago()">Aprobar Pago</button>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /.modal-dialog -->




@endsection
@section('scripts')

<script type="text/javascript" language="javascript"
    src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js">
</script>
<script type="text/javascript" language="javascript"
    src="https://cdn.datatables.net/buttons/1.2.1/js/dataTables.buttons.min.js">
</script>
<script type="text/javascript" language="javascript" src="//cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js">
</script>
<script type="text/javascript" language="javascript"
    src="//cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js">
</script>
<script type="text/javascript" language="javascript" src="//cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js">
</script>
<script type="text/javascript" language="javascript" src="//cdn.datatables.net/buttons/1.2.1/js/buttons.html5.min.js">
</script>
<script type="text/javascript" language="javascript"
    src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap.min.js">
</script>
<script src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.flash.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.print.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.1/js/dataTables.buttons.min.js" type="text/javascript"></script>
<script src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.colVis.min.js" type="text/javascript"></script>
<script type="text/javascript"> 
    let idPago;
    $(document).ready(function() {
                                
        $('#tablaEstudiantes tfoot th').each(function() {
            var title = $(this).text();
            if (title != '') {
                $(this).html(
                    '<input style="width: 100% !important; text-align: center;" type="text" placeholder="Buscar" />'
                );
            }
        });
        
        var tabla = $('#tablaEstudiantes').DataTable({
            processing: true,
            serverSide: true,
            lengthMenu: [
                [10, 25, 50, -1],
                [10, 25, 50, "All"]
            ],
            responsive: true,
            ajax: "{{ route('tablaCuentasPorCobrar')}}",
            columns: [
                {
                    data: 'cedulaEstudiante',
                    
                },
                {
                    data: 'acordeon'
                }
            ],
            dom: 'Blfrtip',
            buttons: [
                
                {
                    extend: "excel",
                    titleAttr: 'Exportar Excel',
                    text: 'Excel',
                },
                {
                    extend: 'pdfHtml5',
                    titleAttr: 'Exportar PDF',
                    text: 'PDF',
                    
                },
                {
                    extend: 'copyHtml5',
                    titleAttr: 'Copiar Datos',
                    text: 'Copiar',
                    
                },
                {
                    extend: 'print',
                    text: 'Imprimir',
                    titleAttr: 'Imprimir Listado',
                    
                },
            ],
            language: {
                "processing": "Procesando...",
                "lengthMenu": "Mostrar _MENU_ registros",
                "zeroRecords": "No se encontraron resultados",
                "emptyTable": "Ningún dato disponible en esta tabla",
                "info": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                "infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
                "infoFiltered": "(filtrado de un total de _MAX_ registros)",
                "search": "Buscar:",
                "infoThousands": ",",
                "loadingRecords": "Cargando...",
                "paginate": {
                    "first": "Primero",
                    "last": "Último",
                    "next": "Siguiente",
                    "previous": "Anterior"
                },
                "aria": {
                    "sortAscending": ": Activar para ordenar la columna de manera ascendente",
                    "sortDescending": ": Activar para ordenar la columna de manera descendente"
                },
                "buttons": {
                    "copy": "Copiar",
                    
                }
            },

            initComplete: function() {
                this.api().columns().every(function() {
                    var that = this;
                    $('input', this.footer()).on('keyup change clear', function() {
                        if (that.search() !== this.value) {
                            that
                                .search(this.value)
                                .draw();
                        }
                    });
                });
            }
        });
        tabla.on( 'draw', function () {
            //ACORDION
            var acc = document.getElementsByClassName("accordion");
            var i;
            
            if(acc!=null){
                for (i = 0; i < acc.length; i++) {
                    acc[i].addEventListener("click", function() {
                        this.classList.toggle("active");
                        var panel = this.nextElementSibling;
                        if (panel.style.maxHeight) {
                        panel.style.maxHeight = null;
                        } else {
                        panel.style.maxHeight = panel.scrollHeight + "px";
                        } 
                    });
                }

            }  
        } );

    });
    
</script>
<script>

    var cliente_id     = 0;
    var comprobante_id = 0;
    function mostrarcuentas(id){
        $.ajax({
            url: "{{ route('vercomprobantes') }}",
            type: 'GET',
            data: {

            },
            success: function (res){
                if(res.respuesta)
                {
                    $("#credito_disponible").val(res.creditopermitido);
                    $("#credito").attr("idcliente",idcliente);
                    $("#credito").attr("cantidad",res.creditopermitido);
                }
            }
        });
    }

    function procesarPago(){
       // $('#modal-fotopago').modal('hide');
      //  $('#modal-nuevopago').modal('hide');
      Swal.fire({
        title: 'El Comprobante de Pago esta Correcto?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'SI',
        cancelButtonText: 'NO'
    }).then((result) => {
        if (result.value) {
            Swal.fire(
                'El Pago a sido Procesado Correctamente',
                '',
                'success'
                );
                $('.swal2-container').css("z-index",'999999');
        }
        $('#modal-fotopago').modal('hide');
    });
        $('.swal2-container').css("z-index",'999999');
    }

    function guardarpagocxc() {
        //var cuentasporcobrar_id = $("#pago_id_comprobante").val();
        var paqueteDeDatos = new FormData();
        paqueteDeDatos.append('foto', $('#pago_archivo')[0].files[0]);
        paqueteDeDatos.append('pago_archivo', $('#pago_archivo')[0].files[0]);
        paqueteDeDatos.append('tipo_comprobante', $("#pago_tipo_comprobante").val());
        paqueteDeDatos.append('pago_fecha', $("#pago_fecha").val());
        paqueteDeDatos.append('pago_concepto', $("#pago_concepto").val());
        paqueteDeDatos.append('cliente_id', cliente_id);
        paqueteDeDatos.append('pago_formapago', $("#pago_formapago").val());
        paqueteDeDatos.append('pago_valor', $("#pago_valor").val());
        paqueteDeDatos.append('pago_observacion', $("#pago_observacion").val());
        paqueteDeDatos.append('cuentasporcobrar_id', comprobante_id);
       // paqueteDeDatos.append('api_key2', "API_1_2_5a4492f2d5137");          
        $.ajax({
            type: 'POST',
            url: "{{route('realizarpago')}}",
            contentType: false,
            processData: false,
            cache: false,
            data: paqueteDeDatos,
            success: function (resp) {
                if (resp.respuesta == true) {
                    swal.fire({
                        title: "Excelente!",
                        text: "Guardado",
                        type: "success",
                        showConfirmButton: false,
                        timer: 1000
                    });
                    $('#modal-nuevopago').modal('hide');
                    verpagocxc(resp.id_comprobante, resp.tipo_comprobante);
                } else {
                    swal({
                        title: "ERROR!",
                        text: "Error en el proceso Vuelva a intentarlo",
                        type: "error",
                        showConfirmButton: false,
                        timer: 1000
                    });
                }
            }, error: function (xhr) {
                console.log(xhr);
            },
        });


    }
    function pagarCuota()
    {}

    function nuevopago() {
        var urlPago = "pagoEstudianteManual/"+idPago;
        console.log(urlPago);
        window.open(urlPago, "_self");
      
        
    }
    function verComprobantePago(){
        $('#modal-fotopago').modal('show');
    }

    function editpaycxc(id_comprobante, tipo_comprobante, cliente_id,fechaP,fechaV,concepto,saldo){
        $('#modal-editpagocxc').modal('show');
    }

    function verpagocxc(id_comprobante, tipo_comprobante, cliente_id,fechaP,fechaV,concepto,saldo) {
        idPago = id_comprobante;
        //console.log(id_comprobante);
        this.cliente_id = cliente_id;
        this.comprobante_id = id_comprobante;
        retencionbaseiva = 0;
        retencionbaserenta = 0;
        $('#id_tabla_pagos').empty();
        $('#pago_id_comprobante').val(id_comprobante);
        $('#pago_tipo_comprobante').val(tipo_comprobante);
        $('#modal-pagos').modal('show');
        //$("#animacionpagos").LoadingOverlay("show");
/*
        $("#id_tabla_pagos").append('<tr>' +
                            '<td>' + id_comprobante + '</td>' +
                            '<td>' + fechaP + '</td>' +
                            '<td>' + fechaV + '</td>' +
                            '<td>' + concepto + '</td>' +
                            '<td style="text-align: right">' + saldo + '</td>' +
                            '<td> <button class="btn btn-warning foto">Procesar</button></td>' +
                            '</tr>');*/
        $('.foto').click(function() {
            verComprobantePago();
            })

        $.ajax({
            type: 'GET',
            url: "{{route('verpagos')}}",
            data: {
                idcxc: id_comprobante,
                tipo_comprobante: tipo_comprobante,
                //api_key2: "API_1_2_5a4492f2d5137"
            },
            success: function (resp) {
                if (resp.respuesta == true) {
                    let saldo = 0;
                    //$('#id_texto_pago').html(auxtexto + " # " + resp.numero);
                    $('#id_tabla_pagos').empty();
                    $('#id_tabla_pagosfooter').empty();
                    $("#pago_concepto").val("");
                    $("#pago_valor").val("");
                    $(resp.historicopago).each(function (i, v) {
                     
                            console.log(resp.historicopago);
                        $("#id_tabla_pagos").append('<tr>' +
                            '<td>' + v.cuentacobrar_id + '</td>' +
                            '<td>' + v.num_factura + '</td>' +
                            '<td>' + v.fecha + '</td>' +
                            '<td>' + v.fecha_vencimiento + '</td>' +
                            '<td>' + v.concepto +'</td>' +
                            '<td>' + v.observacion +'</td>' +
                            '<td style="text-align: right">' + v.valor + '</td>' +
                          
                            '</tr>');
                        saldo = saldo + parseInt(v.valor) ;
                    })
                    $("#id_tabla_pagosfooter").append('<tr>' +
                        '<td colspan="4"></td>' +
                        '<td><b>Total Cancelado</b></td>' +
                        '<td style="text-align: right">' + saldo + '</td>' +
                        '</tr>');
                    /*

                    $("#pago_concepto").val("Pago " + auxtexto + " # " + resp.numero);
                    $("#pago_valor").val(resp.saldo);
                    retencionbaseiva = resp.baseiva;
                    retencionbaserenta = resp.baserenta;
                    */
                    //$("#animacionpagos").LoadingOverlay("hide");

                } else {
                    //$("#animacionpagos").LoadingOverlay("hide");

                }
            }, error: function (xhr) {
                console.log(xhr);
            },
        })
    }

    function eliminarpagocxc(id_pago) {
        $.ajax({
            type: 'POST',
            url: "https://azur.com.ec/plataforma/eliminarpagosdecxc",
            data: {
                id_pago: id_pago,
                api_key2: "API_1_2_5a4492f2d5137"
            },
            success: function (resp) {
                
            }, error: function (xhr) {
                erroresenajax(xhr);
            },
        })
    }

    function eliminarpago(idPago) {
        Swal.fire({
            title: 'Seguro desea eliminar este pago?',
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
                    url: '{{route("destroyPayStudente")}}',
                    data: {
                        '_token': '{{csrf_token()}}',
                        'idCuenta' : `${idPago}`
                    },
                    success: function(response) {
                        $(`#${idPago}`).css('display', 'none')
                        Swal.fire(
                            'El pago ha sido eliminado!',
                            '',
                            'success'
                        );
                        $('#tablaEstudiantes').DataTable().ajax.reload();
                    },
                    error: function(response) {
                        Swal.fire(
                            `${response.responseText}`,
                            '',
                            'error'
                        );
                    }
                });
            }
        })
    }

    function crearcuotacxc(dataForm) {
        Swal.fire({
            title: 'Creacion de pagos para estudiantes.',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'SI',
            cancelButtonText: 'NO'
        }).then((result) => {
            if (result.value) {
                console.log(dataForm);
                $.ajax({
                    type: "POST",
                    url: '{{route("StorePayStudente")}}',
                    data: {
                        '_token': '{{csrf_token()}}',
                        'id':`${dataForm.id_student}`,
                        'fecha_inicio' : `${dataForm.fecha_pago_inicio}`,
                        'costo_cuota_total' : `${dataForm.valor_cuota}`,
                        'cuotas' : `${dataForm.numero_cuotas}`,
                        'id_semester' : `${dataForm.id_semestre_cuota}`,
                        'concepto' : `${dataForm.concepto_pago}`
                    },
                    success: function(response) {
                        Swal.fire(
                            'El pago se ha creado!',
                            '',
                            'success'
                        );
                        $('#tablaEstudiantes').DataTable().ajax.reload();
                    },
                    error: function(response) {
                        Swal.fire(
                            `${response.responseText}`,
                            '',
                            'error'
                        );
                    }
                });
            }
        })
    }

/*
    $(function () {
        $('#pago_fecha').datetimepicker({

            widgetPositioning: {
                horizontal: 'left'
            },
            icons: {
                time: "fa fa-clock-o",
                date: "fa fa-calendar",
                up: "fa fa-arrow-up",
                down: "fa fa-arrow-down"
            },
            format: 'YYYY-MM-DD'
        });
    })

    $('#id_tabla_pagos').on('click', '#eliminarpagocxc', function () {
        var id_pago = this.getAttribute("id_pago");
        var fila = $(this).parents('tr');
        fila.remove();
        eliminarpagocxc(id_pago);
    })*/

    function filt() {
        console.log($('#filtrar').val())

        /*{{--$.ajax({--}}
        {{--    type: 'GET',--}}
        {{--    url: "{{ route('comprobantes') }}", //+ '/' + $('#filtrar').val(),--}}
        {{--    data: {--}}
        {{--        valor: $('#filtrar').val(),--}}
        {{--    },--}}
        {{--    success: function (resp) {--}}
        {{--        console.log(resp)--}}
        {{--    }, error: function (xhr) {--}}
        {{--        console.log(xhr);--}}
        {{--    },--}}
        {{--})--}}*/
    }


</script>

@endsection