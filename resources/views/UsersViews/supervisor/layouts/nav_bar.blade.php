@php
$user_data = App\User::where('userid', Sentinel::getUser()->id)->first();
$tMessages = session('tMessages');

$menuNovus_1 = false;
$email = Sentinel::getUser()->email ?? false;

switch ($email) {
    case 'eperez@centroeducativonovus.edu.ec':
        $menuNovus_1 = true;
    break;
    case 'mchiriboga@centroeducativonovus.edu.ec':
        $menuNovus_1 = true;
    break;
    case 'jarmijo@centroeducativonovus.edu.ec':
        $menuNovus_1 = true;
    break;
    case 'ccollantes@centroeducativonovus.edu.ec':
        $menuNovus_1 = true;
    break;
}


use App\ConfiguracionSistema;
use App\Permiso;
use App\Menu;
use App\SubMenu;

$menus = Permiso::select('idMenu')
->where('iduser',Sentinel::getUser()->id)
->where('ver', 1)
->distinct()
->get();
//

//->where('ver', 1)->get();
$pagos = ConfiguracionSistema::pagos();
$nuevaMatricula = ConfiguracionSistema::nuevaMatricula();
$transporte = ConfiguracionSistema::transporte();
$asistencia = ConfiguracionSistema::where('nombre', 'ASISTENCIA')
->where('idPeriodo', Sentinel::getUser()->idPeriodoLectivo)
->first();
$configuracionDHI = App\ConfiguracionSistema::where('nombre', 'DHI')
->where('idPeriodo', Sentinel::getUser()->idPeriodoLectivo)->first();
if ($configuracionDHI->valor == 'PARCIAL') {
    $parcial = 'p1q1';
} else {
    $parcial = 'q1';
}
$regimen = ConfiguracionSistema::regimen();
$progresoformativo = ConfiguracionSistema::where('nombre', 'PROGRESO_FORMATIVO')->first();
@endphp

<nav class="navbar-default navbar-static-side" role="navigation">
    <div class="sidebar-collapse">
        <ul class="nav metismenu" id="side-menu">
            <li class="nav-header">
                <div class="profile-element">
                    <img alt="image" class="img-circle"
                        src="{{ $user_data->url_imagen == null ? secure_asset("img/icono_persona.png ") : secure_asset("storage/$user_data->url_imagen") }}"
                        width="30%" />
                    <span class="block ">
                        <h4 class="uppercase">
                            <strong class="font-bold">
                                <a href="">{{strtoupper($user_data->nombres)}} {{strtoupper($user_data->apellidos)}}</a>
                            </strong>
                            <br>
                            <small class="profile-type">{{strtoupper($user_data->cargo)}}</small>
                        </h4>
                    </span>
                </div>
                <div class="logo-element">
                    <img alt="logo" src="{{secure_asset('img/logo unico.png')}}" width="50px" />
                </div>
            </li>
            @if(!$menus->count()){{--en caso de no estar en el modulo de permisos--}}
            @if (!$menuNovus_1)
                <li>
                    <a href="{{route('home')}}">
                        <i class="fa fa-th-large"></i>
                        <span class="nav-label">Mi Perfil </span>
                    </a>
                </li>
            @endif
            <li>
                <a href="{{route('notificaciones')}}" class="relative">
                    <img class="mr-05" src="{{secure_asset('img/notificaciones.svg')}}" alt="" width="17">
                    <span class="nav-label">Notificaciones </span>
                    @if($tMessages != 0)
                    <span class="label label-success pull-right numberNotifications">{{ $tMessages }}</span>
                    <label class="notificaciones__versionMovil"></label>
                    @endif
                </a>
            </li>
            @if (!$menuNovus_1)
                <li>
                    <a>
                        <i class="fa fa-university"></i>
                        <span class="nav-label">Institución </span>
                        <span class="fa arrow"></span>
                    </a>
                    <ul class="nav nav-second-level">
                        <li>
                            <a href="{{ route('institucion') }}">Información </a>
                        </li>
                        <!--
                            <li>
                                <a href="{{ route('institucionLectivo') }}">Año Lectivo </a>
                            </li>
                            <li>
                                <a href="{{ route('institucionMaterias') }}">Áreas / Asignaturas </a>
                            </li>
                        -->
                        <li>
                            <a href=" {{route('cronograma')}}">
                                Cronograma
                            </a>
                        </li>
                    </ul>
                </li>

                <li>
                    <a href="#">
                        <i class="fa fa-group"></i>
                        <span class="nav-label">Fichas Personales </span>
                        <span class="fa arrow"></span>
                    </a>
                    <ul class="nav nav-second-level">
                        <li>
                            <a href="{{ route('administrativos') }}">Administrativos</a>
                        </li>
                        <li>
                            <a href="{{ route('colecturia.index') }}">Colecturia</a>
                        </li>
                        <li>
                            <a href="{{ route('secretaria.index') }}">Secretaría</a>
                        </li>
                        <li>
                            <a href="{{ route('docentes') }}">Docentes</a>
                        </li>
                        <li>
                            <a href="{{ route('historial') }}">Historial</a>
                        </li>
                    </ul>
                </li>
            @endif
            <li>
                <a href="{{route('carreras') }}" title="Carreras">
                    <i class="fa fa-th-large"></i>
                    <span class="nav-label">Carreras</span>
                </a>
            </li>
            @if (!$menuNovus_1)
                <li>
                    <a href="#" clas>
                        <i class="fa fa-clipboard"></i>
                        <span class="nav-label">Reportes </span>
                        <span class="fa arrow"></span>
                    </a>
                    <ul class="nav nav-second-level">
                        <li>
                            <a href=" {{url('/reportePorCurso/p1q1')}}">Carrera</a>
                        </li>
                        <li>
                            <a href="{{url('/reportePorDocente/p1q1')}}">Docentes</a>
                        </li>
                        <li>
                            <a href=" {{url('/reportePorEstudiantes/p1q1')}} ">Estudiantes </a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="{{ route('matricula') }}">
                        <i class="fa fa-list-alt"></i>
                        <span class="nav-label">Matrícula </span>
                    </a>
                </li>
                @if ($progresoformativo->valor == '1')
                    <li>
                        <a href="{{route('aulicas.index')}}">
                            <i class="fa fa-list-alt"></i>
                            <span class="nav-label">Progreso Formativo</span>
                        </a>
                    </li>
                @endif
                @if ($transporte->valor == '1')
                    <li>
                        <a href="{{route('transporte')}}">
                            <i class="fa fa-bus"></i>
                            <span class="nav-label">Transporte</span>
                        </a>
                    </li>
                @endif
                <!-- Validación de activación de Pagos -->
                @if( $pagos->valor=="1")
                    <li>
                        <a href="#" clas>
                            <i class="fa fa-credit-card"></i>
                            <span class="nav-label">Pagos </span>
                            <span class="fa arrow"></span>
                        </a>
                        <ul class="nav nav-second-level">
                            <!--
                            <li>
                                <a href=" {{ route('listarCarrerasPagos') }}">Plataforma </a>
                            </li>
-->
                            @php
                                $pagoEnLinea = ConfiguracionSistema::where('nombre', 'PAGO_EN_LINEA')
                                    ->where('idPeriodo',Sentinel::getUser()->idPeriodoLectivo)
                                    ->first();
                            @endphp
                            @if($pagoEnLinea->valor=='1')
                            <!--
                            <li>
                                <a href="{{url('/pagos/')}}">Pago En Linea </a>
                            </li>-->
                            @endif
                        </ul>
                    </li>
                @endif
                <li style="display:none">
                    <a href="#" clas>
                        <i class="fa fa-clipboard"></i>
                        <span class="nav-label">Proveedores</span>
                        <span class="fa arrow"></span>
                    </a>
                    <ul class="nav nav-second-level">
                        <li>
                            <a href="{{ route('proveedor') }}">Registros</a>
                        </li>
                        <li>
                            <a href="{{ route('pagos') }}">Pagos</a>
                        </li>
                        <li>
                            <a href="{{ route('retenciones') }}">Retenciones</a>
                        </li>
                        <li>
                            <a href="">Liquidación de Compras, Bienes y Servicios</a>
                        </li>
                    </ul>
                </li>
                <li class="hide">
                    <a href="#" clas>
                        <i class="fa fa-clipboard"></i>
                        <span class="nav-label">Transacciones</span>
                        <span class="fa arrow"></span>
                    </a>
                    <ul class="nav nav-second-level">
                        <li>
                            <a href="">Facturas</a>
                        </li>
                        <li>
                            <a href="">Retenciones</a>
                        </li>
                        <li>
                            <a href="">Liquidación de compras de bienes y prestación de servicios</a>
                        </li>
                        <li>
                            <a href="">Nota de débito</a>
                        </li>
                        <li>
                            <a href="">Nota de crédito</a>
                        </li>
                        <li>
                            <a href="">Guía de remisión</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="{{ route('configuraciones') }}">
                        <i class="fa fa-cogs"></i>
                        <span class="nav-label">Configuraciones</span>
                    </a>
                </li>
                @if (Sentinel::getUser()->email === 'soporte@pined.ec')
                    <!--<li>
                        <a href="{{ route('datos.facturacionElectronica') }}">
                            <i class="fa fa-cogs"></i>
                            <span class="nav-label">Facturación Electronica</span>
                        </a>
                    </li>-->
                     <li>
                        <a href="{{route('permisos', ['id' => 0]) }}">
                            <i class="fa fa-lock"></i>
                            <span class="nav-label">Permisos Usuarios</span>
                        </a>
                    </li>
                @endif
            @endif
            @if (Sentinel::getUser()->email === 'ccollantes@centroeducativonovus.edu.ec')
                <li>
                    <a href="{{ route('matricula') }}">
                        <i class="fa fa-list-alt"></i>
                        <span class="nav-label">Matrícula </span>
                    </a>
                </li>
            @endif
            @else
            @foreach($menus as $menu)
            @php
            $menu_des = Menu::FindOrFail($menu->idMenu);
            $Submenus = Permiso::where('iduser',Sentinel::getUser()->id)
            ->where('idMenu',$menu->idMenu)
            ->where('ver', 1)
            ->whereNotNull('idSubMenu')
            ->pluck('idSubMenu');
            @endphp
                        @if(!$Submenus->count() && $menu_des->ruta != null)
                        {{--bloque de condiciones en  el menú dinamico--}}
                        @if($transporte->valor == '0' && $menu_des->nombre =='Transporte' )
                        @elseif($menu_des->nombre =='Permisos Usuarios' )
                        <li>
                            <a  href="{{ route($menu_des->ruta, ['id' => 0]) }}">
                                <i class="{{$menu_des->icono}}"></i>
                                <span class="nav-label">{{$menu_des->nombre}}</span>
                                @if($menu_des->ruta=='notificaciones')
                                <span class="label label-success pull-right numberNotifications">{{ $tMessages }}</span>
                                <label class="notificaciones__versionMovil"></label>
                            @endif
                            </a>
                        </li>
                        @else
                        <li>
                            <a  href="{{ route($menu_des->ruta) }}">
                                <i class="{{$menu_des->icono}}"></i>
                                <span class="nav-label">{{$menu_des->nombre}}</span>
                                @if($menu_des->ruta=='notificaciones')
                                <span class="label label-success pull-right numberNotifications">{{ $tMessages }}</span>
                                <label class="notificaciones__versionMovil"></label>
                            @endif
                            </a>
                        </li>
                        @endif
                        @else
                         <li>
                            <a>
                                <i class="{{$menu_des->icono}}"></i>
                                <span class="nav-label">{{$menu_des->nombre}} </span>
                                <span class="fa arrow">
                                </span>
                            </a>
                        <ul class="nav nav-second-level">
                        @foreach($Submenus as $Submenu)
                        @php
                         $Submenu_des = SubMenu::FindOrFail($Submenu);
                        @endphp
                         {{--bloque de condiciones en el Sub-menú dinamico--}}
                        @if ($asistencia->valor == 'parcial' && $Submenu_des->nombre =='Asistencia')
                        @elseif($asistencia->valor != 'parcial' && $Submenu_des->nombre =='Asistencia Parcial')
                        @elseif($Submenu_des->nombre =='DHI')
                         <li>
                            <a href="{{ route($Submenu_des->ruta, ['parcial' => $parcial]) }}">{{$Submenu_des->nombre}}</a>
                        </li>
                        @elseif( $pagos->valor=="0" && $Submenu_des->nombre =='Clientes')
                        @else
                        <li>
                            <a href="{{ route($Submenu_des->ruta) }}">{{$Submenu_des->nombre}}</a>
                        </li>
                        @endif
                        @endforeach
                    </ul>
                    </li>
                     @endif

            @endforeach

            @endif
        </ul>
    </div>
</nav>