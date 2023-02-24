@php
use App\Permiso;
use App\ConfiguracionSistema;
$permiso = Permiso::desbloqueo('matricula');
$usuario = session('user_data')->correo;
$pagos = ConfiguracionSistema::pagos()->valor;
@endphp
@if(Sentinel::inRole('UsersViews.secretaria') || Sentinel::inRole('UsersViews.administrador') || ($permiso != null && $permiso->editar == 1))
    <a href="{{route('matriculaEditar', ['id' => $id, 'idPeriodo' =>$idPeriodo,'idCarrera' =>$idCarrera ])}}" title="Ver"><i class="fa fa-pencil a-fa-pencil__matricula"></i></a>
@endif
@if($pagos==1)
@if(Sentinel::inRole('UsersViews.colecturia') || ($permiso != null && $permiso->editar == 1))
{{--<a href="{{route('pagosCursoEstudiante', ['id' => $id])}}" title="Ver"><i class="fa fa-money icon__ver"></i></a>--}}
<a href="{{route('exportarKardex', ['id' => $id])}}" title="Kardex"><i class="fa fa-download icon_kardex"></i></a>
@endif
@endif
@if($usuario==='info@itred.edu.ec')
    @if(Sentinel::inRole('UsersViews.administrador') || ($permiso != null && $permiso->eliminar == 1))
        <a href="#" title="Eliminar" onclick="eliminarEstudiante({{$id}})"><i class="fa fa-trash icon__eliminar"></i></a>
    @endif
@endif