@extends('layouts.master2')
@include('partials.loader.loader')
@section('content')
    @php
    use App\Permiso;
    $permiso = Permiso::desbloqueo('docentes');
    @endphp
    <div id="page-wrapper" class="gray-bg dashbard-1">
        @include('layouts.nav_bar_top')
        @php
            $tipo_usuario = 'Docente';
        @endphp
        @include('partials.fichas.fichasAdministrativo', [
        'perfil' => ''
        ])
    </div>
    {{-- modal para --}}
    <div class="modal fade" id="detalleDocente" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    </div>
@endsection
@section('scripts')
    <script>
        $('.icon__ver').click(function() {
            $.ajax({
                type: "GET",
                url: $(this).data('route'),
                success: function(response) {
                    $('#detalleDocente').html(response)
                    $('#detalleDocente').modal('show')
                },
                error: function() {
                    console.log('sucedio un error')
                }
            });
        })
    </script>
@endsection
