@php
use App\Permiso;
use App\ConfiguracionSistema;
$permiso = Permiso::desbloqueo('matricula');
$usuario = session('user_data')->correo;
$pagos = ConfiguracionSistema::pagos()->valor;
@endphp
<a href="#" data-toggle="modal" data-target="#importar" onclick="verEstudiante({{$id}})" title="Ver"><i class="fa fa-eye icon__ver"></i></a>