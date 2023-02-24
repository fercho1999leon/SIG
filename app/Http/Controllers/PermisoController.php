<?php

namespace App\Http\Controllers;

use App\Permiso;
use App\Menu;
use App\SubMenu;
use Sentinel;
use App\Administrative;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class PermisoController extends Controller
{

    public function index()
    {
          return 'index';
    }
    public function home(Request $request, $id)
    {
        if($request->ajax()){
            $users = Administrative::where('id',$id)->first();
            $permisos = Permiso::where('iduser',$users->userid)->get();
            $submenu = SubMenu::all();
            $menu = Menu::orderBy('posicion')->get();
            $view = \View::make('UsersViews.administrador.configuraciones.permisos.lista_permisos')->with(['menus' => $menu, 'submenu'=>$submenu,'usuario'=>$users,'permisos'=>$permisos]);
            $sections = $view->renderSections();
            return Response::json($sections['contentPanel']);
        }else {
           return View('UsersViews.administrador.configuraciones.permisos.index');
        }

    }

    public function actualizar(Request $request)
    {
        //dd($request->permisos_sub);
        if(Sentinel::getUser()->email === 'info@itred.edu.ec') {
        //paso todos los permisos a 0     
            $users = Administrative::where('id',$request->id)->first();
            $perm_ver = Permiso::where('iduser',$users->userid)->pluck('id');
            foreach ($perm_ver as $perm) {
                $permiso_ver = permiso::findOrFail($perm);
                $permiso_ver->ver=0;
                $permiso_ver->editar=0;
                $permiso_ver->eliminar=0;
                $permiso_ver->imprimir=0;
                $permiso_ver->save();
            }
            if($request->permisos_menu != null){
                foreach ($request->permisos_menu as $menu ) {
                    list($id_menu,$tipo_permiso) = explode("|*|", $menu);
                    switch ($tipo_permiso) {
                        case 'V':
                        $tp = 'ver';
                        break;
                        case 'E':
                        $tp = 'editar';
                        break;
                        case 'D':
                        $tp = 'eliminar';
                        break;
                        case 'I':
                        $tp = 'imprimir';
                        break;
                    }
                    $existe = Permiso::where('iduser',$users->userid)
                        ->where('idMenu',$menu)
                        ->where('idSubMenu',null)
                        ->exists();
                    if (!$existe) {
                        $menu_permiso = new Permiso();
                        $menu_permiso->$tp=1;
                        $menu_permiso->iduser=$users->userid;
                        $menu_permiso->idMenu=$menu;
                        $menu_permiso->idSubMenu=null;
                        $menu_permiso->save();
                    }else{
                        $permiso = Permiso::where('iduser',$users->userid)
                            ->where('idMenu',$menu)
                            ->where('idSubMenu',null)
                            ->first();
                        $menu_permiso = Permiso::findOrFail($permiso->id);
                        $menu_permiso->$tp=1;
                        $menu_permiso->idSubMenu=null;
                        $menu_permiso->save();
                    }
                }
            }
        
            if($request->permisos_sub != null){
                foreach ($request->permisos_sub as $sub ) {
                    list($id_submenu,$tipo_permiso) = explode("|*|", $sub);
                    switch ($tipo_permiso) {
                        case 'V':
                        $tp = 'ver';
                        break;
                        case 'E':
                        $tp = 'editar';
                        break;
                        case 'D':
                        $tp = 'eliminar';
                        break;
                        case 'I':
                        $tp = 'imprimir';
                        break;
                    }
                    $submenu = SubMenu::findOrFail($sub);
                    $existe = Permiso::where('iduser',$users->userid)
                        ->where('idSubMenu',$sub)
                        ->where('idMenu',$submenu->idMenu)
                        ->exists();
                    if (!$existe) {
                        $sub_permiso = new Permiso();
                        $sub_permiso->$tp=1;
                        $sub_permiso->iduser=$users->userid;
                        $sub_permiso->idSubMenu=$id_submenu;
                        $sub_permiso->idMenu=$submenu->idMenu;
                        $sub_permiso->save();
                    }else{
                        $permiso = Permiso::where('iduser',$users->userid)
                            ->where('idSubMenu',$sub)
                            ->first();
                        $sub_permiso = permiso::findOrFail($permiso->id);
                        $sub_permiso->$tp=1;
                        $sub_permiso->save();
                    }
                }    
            }
            return ['mensaje'=>'Actualizado'];
        }else{
            return  ['mensaje'=>'No tiene permisos'];
        }
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show(Permiso $permiso)
    {
        //
    }

    public function edit(Permiso $permiso)
    {
        //
    }

    public function update(Request $request, Permiso $permiso)
    {
        //
    }

    public function destroy(Permiso $permiso)
    {
        //
    }
    public function delete(Request $request)
    {
       if(Sentinel::getUser()->email === 'soporte@pined.ec') {
         //paso todos los permisos a 0
                $users = Administrative::where('id',$request->id)->first();
                $perm_ver = Permiso::where('iduser',$users->userid)->pluck('id');
                foreach ($perm_ver as $perm) {
                $permiso_ver = permiso::findOrFail($perm);
                $permiso_ver->delete();
                }

        return 'Eliminado';
        }else {
        return 'No esta autorizado';
        }
    }
}
