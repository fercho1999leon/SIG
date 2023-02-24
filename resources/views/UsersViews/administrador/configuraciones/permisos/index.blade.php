@extends('layouts.master')
@section('content')
@include('partials.loader.loader')
    <div id="page-wrapper" class="gray-bg dashbard-1">
        @include('layouts.nav_bar_top')
        <div class="row wrapper white-bg ">
            <div class="col-lg-12 titulo-separacion">
                <h2 class="title-page">Permisos Configuración </h2>
                        <div class="col-lg-6">
                        <input class="form-control" type="text" name="" id="NuevoEmail"  placeholder="Seleccione Usuario">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div id="listaCorreos"></div>
                        </div>
                    </div>
        </div>
         <div class="confGeneral__grid" id="principalPanel">

  @section('contentPanel')
  @endsection
</div>
</div>
@endsection
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
<script src="{{secure_asset('js/jquery-3.3.js')}}"></script>
@section('scripts')
    
    <script>
        $(document).ready(function(){
        $('#NuevoEmail').keyup(function(){
                var query = $(this).val();
                if(query != '')
                {
                var _token = $('input[name="_token"]').val();
                $.ajax({
                url:"{{ route('autocompleteEmail') }}",
                method:"POST",
                data:{query:query, _token:_token},
                success:function(data){
                    $('#listaCorreos').show();

                            $('#listaCorreos').html(data);
                }
                });
                }
            });
        });
        function agregarEmail($id,$correo,$nombres,$apellidos){
            //alert($id);
            $('#listaCorreos').hide();
            //const url = "/permisos";
            //const newurl = `${url}/${$id}`
            console.log($id);
            ajaxRenderSection("{{route('permisos',[''])}}/"+$id);
        }
        function ajaxRenderSection(url) {
            $.ajax({
                type: 'GET',
                url: url,
                dataType: 'json',
                success: function (data) {
                    $('#principalPanel').empty().append($(data));
                },
                error: function (data) {
                    var errors = data.responseJSON;
                    if (errors) {
                        $.each(errors, function (i) {
                            console.log(errors[i]);
                        });
                    }
                }
            });
        }
        function add_permisos($iduser){
            $("#load").show();
            var permisos_menu = [];
            var permisos_sub = [];
            var id = $iduser;
            var _token = $('input[name="_token"]').val();
            $('.menu-permiso:checked').each(function() {
            //console.log("Checkbox " + $(this).val() + ") Seleccionado");
            permisos_menu.push($(this).attr('name')+'|*|'+$(this).val());
            });
            $('.sub-permiso:checked').each(function() {
            //console.log("Checkbox " + $(this).val() + ") Seleccionado");
            permisos_sub.push($(this).attr('name')+'|*|'+$(this).val())});
            $.ajax({
                type: 'POST',
                url: "{{route('updatepermisos')}}",
                dataType: 'json',
                data: {
                    permisos_menu:permisos_menu,
                    permisos_sub:permisos_sub,
                    id:$iduser,
                    _token:_token
                },
                success: function (data) {
                    console.log(data);
                    $("#load").hide();
                    Swal.fire({
                        title: "Actualizado",
                        icon: "success",
                    });
                    ajaxRenderSection(newurl);
                },
                error: function (error) {
                    $("#load").hide();
                    //console.log(data);
                }
            });
        }
        function eliminar_permisos($iduser){
            Swal.fire({
            title: "Realmente desea eliminar los permisos",
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si',
            cancelButtonText: 'No'
            }).then((result) => {
                if (result.value==true) {
                    const url = "/permisos";
                    const newurl = `${url}/${$iduser}`
                    axios.post("{{ route('deletepermisos') }}", {
                        id:$iduser,
                    }).then(response => {
                        ajaxRenderSection(newurl);

                    }).catch(e => {
                        // Podemos mostrar los errores en la consola
                        console.log(e);
                    })
                }
            });

        }
    </script>
@endsection
