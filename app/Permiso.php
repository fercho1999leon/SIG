<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Menu;
use App\SubMenu;
class Permiso extends Model
{
    public static function desbloqueo($ruta) {
        $menu = Menu::where('ruta','LIKE',"%$ruta%")->first();
        $submenu = SubMenu::where('ruta',$ruta)->first();
        if($menu != null){
            return $menu = Menu::find($menu->id)->permisosmenu();
        }else if($submenu != null){
            return $submenu = SubMenu::find($submenu->id)->permisosSubmenu();
        }
        return null;
    }
}
