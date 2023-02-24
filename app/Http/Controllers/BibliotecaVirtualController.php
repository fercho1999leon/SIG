<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Bibliotecavirtual;
use Illuminate\Support\Facades\File;
use App\SeccionBiblioteca;
use App\RegistryTimeLibraryVirtual;
use Sentinel;
use Exception;

class BibliotecaVirtualController extends Controller
{
    /**
     * Llamado a la vista principal de administracion de biblioteca virtual 
     */
    public function index(){

        try {
            return view('UsersViews.administrador.biblioteca.virtual.index');
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function show(){

        try {
            return view('UsersViews.administrador.biblioteca.virtual.show');
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function store(Request $request){
        try{
            if ($request->hasFile('image')) {
                $biblioteca = new Bibliotecavirtual();
                $biblioteca->name = $request->nombre_biblioteca;
                $biblioteca->urlbiblioteca = $request->url_biblioteca;
                $biblioteca->is_active = $request->estado;
                $biblioteca->id_seccion_biblioteca = $request->seccion;
                    $imagen = $request->file('image');
                    $nameimg = $imagen->getClientOriginalName();
                    $imagen ->move('bibliotecavirtual', $nameimg);
                $biblioteca->urlimage = $nameimg;
                $biblioteca->save();
                return redirect()->route('BibliotecaVirtual')->with('message', '¡Agregado Correctamente!')->with('type','success');
            }
        }catch (Exception $e){
            return $e->getMessage();
        }
    }

    public function createseccion(Request $request){
        $seccion = new SeccionBiblioteca();
        $seccion->seccion = $request->nombre_seccion;
        $seccion->is_active = $request->estado;
        $seccion->save();
        return redirect()->route('BibliotecaVirtual')->with('message', '¡Agregado Correctamente!')->with('type','success');
    }

    public function edit($id)
    {
        try {
            $biblioteca = Bibliotecavirtual::where('id',$id)->first();
            return view('UsersViews.administrador.biblioteca.virtual.edit', compact('biblioteca'));
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function update(Request $request,$id){
        try{
            $biblioteca = Bibliotecavirtual::where('id',$id)->first();
            if($biblioteca != null){
                $biblioteca->name = $request->nombre_biblioteca;
                $biblioteca->urlbiblioteca = $request->url_biblioteca;
                $biblioteca->is_active = $request->estado;
                $biblioteca->id_seccion_biblioteca = $request->seccion;
                if($request->hasFile('image')){
                    if(File::exists(public_path('bibliotecavirtual/'.$biblioteca->urlimage))){
                        File::delete(public_path('bibliotecavirtual/'.$biblioteca->urlimage));
                    }else{
                        return redirect()->route('BibliotecaVirtual')->with('message', 'No se encontro la imagen anterior')->with('type','error');
                    }
                    $imagen = $request->file('image');
                    $nameimg = $imagen->getClientOriginalName();
                    $imagen->move('bibliotecavirtual', $nameimg);
                    $biblioteca->urlimage = $nameimg;
                }
                $biblioteca->save();
                return redirect()->route('BibliotecaVirtual')->with('message', '¡Actualizado Correctamente!')->with('type','success');
            }
        }catch(Exception $e){
            return $e->getMessage();
        }
        
    }

    public function editseccion($id)
    {
        try {
            $seccion = SeccionBiblioteca::where('id',$id)->first();
            return view('UsersViews.administrador.biblioteca.virtual.editseccion', compact('seccion'));
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function updateseccion(Request $request,$id){
        $seccion = SeccionBiblioteca::where('id',$id)->first();
        $seccion->seccion = $request->nombre_seccion;
        $seccion->is_active = $request->estado;
        $seccion->save();
        return redirect()->route('BibliotecaVirtual')->with('message', '¡Actualizado Correctamente!')->with('type','success');        
    }

    public function destroy($id){
        try {
            $biblioteca = Bibliotecavirtual::where('id',$id)->first();
            if($biblioteca != null){
                if(File::exists(public_path('bibliotecavirtual/'.$biblioteca->urlimage))){
                    File::delete(public_path('bibliotecavirtual/'.$biblioteca->urlimage));
                    $biblioteca->delete();
                    return redirect()->route('BibliotecaVirtual')->with('message', '¡Eliminado Correctamente!')->with('type','success');
                }
            }
            return redirect()->route('BibliotecaVirtual')->with('message', 'Error en la elimincacion')->with('type','error');
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function destroyseccion($id){
        $seccion = SeccionBiblioteca::where('id',$id)->first();
        $seccion->delete();
        return redirect()->route('BibliotecaVirtual')->with('message', '¡Eliminado Correctamente!')->with('type','success');
    }

    public function registerTime(Request $request){
        if($request->contadorTiempo>0){
            $table = new RegistryTimeLibraryVirtual();
            $table->time_second = $request->contadorTiempo;
            $table->idBibliotecavirtual = $request->id;
            $table->idUser = Sentinel::getUser()->id;
            $table->save();
        }
    }
}
