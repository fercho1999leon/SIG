@php
use App\Permiso;
@endphp
@include('partials.loader.loader')
@section('contentPanel')
<div class="loader3 loader" id="load" style="display: none;">
  <span></span>
  <span></span>
</div>
  <div class="mail-box tableNotificaciones">
        <div class="table-responsive p-1">
          <table id="tableNotificaciones" class="table table-hover table-mail tableNotificaciones">
            <thead>
              <tr>
                <th>Usuario</th>
                <th>Correo</th>
                <th>Cargo</th>
                <th>Acción</th>
              </tr>
            </thead>
            <tbody>
              <tr>
              <td>{{$usuario->nombres}} {{$usuario->apellidos}}</td>
              <td>{{$usuario->correo}}</td>
              <td>{{$usuario->cargo}}</td>
              <td><button class="bg-none no-border" onclick="eliminar_permisos('{{$usuario->id}}')">
                  <i class="fa fa-trash icon__eliminar"></i>
                </button></td>
              </tr>
            </tbody>
          </table>
          <table id="tableNotificaciones" class="table table-hover table-mail tableNotificaciones">
            <thead>
              <tr>
                <th>#</th>
                <th>Menú</th>
                <th></th>
                <th>SubMenu</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
              @foreach($menus as $menu)
              <tr>
              <td>{{$loop->iteration}}</td>
              <td>{{$menu->nombre}}</td>
              @php
              $permiso_menu = Permiso::where('idMenu', $menu->id)
              ->where('iduser',$usuario->userid)
              ->where('idSubmenu',null)->first();
              @endphp
              <td><input type="checkbox" class="custom-control-input menu-permiso" title="Ver" name="{{$menu->id}}" value="V" id="menu_permiso{{$menu->id}}" {{$permiso_menu['ver'] == '1' ? 'checked="checked"' : ''}}>
              <input type="checkbox" class="custom-control-input menu-permiso" title="Editar" name="{{$menu->id}}" value="E" id="menu_permiso{{$menu->id}}"  {{$permiso_menu['editar'] == '1' ? 'checked="checked"' : ''}}>
              <input type="checkbox" class="custom-control-input menu-permiso" title="Eliminar" name="{{$menu->id}}" value="D" id="menu_permiso{{$menu->id}}"  {{$permiso_menu['eliminar'] == '1' ? 'checked="checked"' : ''}}>
              <input type="checkbox" class="custom-control-input menu-permiso" title="Imprimir" name="{{$menu->id}}" value="I" id="menu_permiso{{$menu->id}}"  {{$permiso_menu['imprimir'] == '1' ? 'checked="checked"' : ''}}>
              </td>
              <td></td></tr>
                @foreach($submenu as $sub)
                @if($menu->id == $sub->idMenu)
                <tr>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td>{{$sub->nombre}}</td>
                   @php
                    $permiso_subMenu = Permiso::where('idSubMenu', $sub->id)
                    ->where('iduser',$usuario->userid)->first();
                  @endphp
                  <td><input type="checkbox" class="custom-control-input sub-permiso"  title="Ver" name="{{$sub->id}}" value="V" id="sub_permiso{{$sub->id}}" {{$permiso_subMenu['ver'] == '1' ? 'checked="checked"' : ''}}>
                  <input type="checkbox" class="custom-control-input sub-permiso" title="Editar" name="{{$sub->id}}" value="E" id="sub_permiso{{$sub->id}}" {{$permiso_subMenu['editar'] == '1' ? 'checked="checked"' : ''}} >
                  <input type="checkbox" class="custom-control-input sub-permiso" title="Eliminar" name="{{$sub->id}}" value="D" id="sub_permiso{{$sub->id}}" {{$permiso_subMenu['eliminar'] == '1' ? 'checked="checked"' : ''}}>
                  <input type="checkbox" class="custom-control-input sub-permiso" title="Imprimir" name="{{$sub->id}}" value="I" id="sub_permiso{{$sub->id}}" {{$permiso_subMenu['imprimir'] == '1' ? 'checked="checked"' : ''}} >
                  </td>
                </tr>
                @endif
                @endforeach
              @endforeach
            </tbody>
          </table>
          <div class="text-right">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <button onclick="add_permisos('{{$usuario->id}}');" class="mb-1 btn btn-primary">Actualizar Permisos</button>
          </div>
        </div>
      </div>
    </div>
@endsection