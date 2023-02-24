<?php

namespace App\Http\Controllers;

use App\Autor;
use App\LibroAutor;
use Illuminate\Http\Request;
use App\User;
use Sentinel;



class AutorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            return view('UsersViews.administrador.biblioteca.autores.index');
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $user_data = User::where('userid', Sentinel::getUser()->id)->first();
            if($request!=null){
                $autor = new Autor;
                $autor->user_id = $user_data->id;
                $autor->slug = $request->input('nombre_autor');
                $autor->is_active = $request->input('estado');
                $autor->is_verified = $request->input('verificado');
                $autor->save();
                return redirect()->route('indexAutores')->with('message', '¡Agregado Correctamente!')->with('type','success');
            }
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Autor  $autor
     * @return \Illuminate\Http\Response
     */
    public function show(Autor $autor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Autor  $autor
     * @return \Illuminate\Http\Response
     */
    public function edit($autor_id)
    {
        try {
            $autor = Autor::find($autor_id);
            return view('UsersViews.administrador.biblioteca.autores.edit', compact('autor'));
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Autor  $autor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $autor_id)
    {
        try {
            if($request!=null){
                $autor = Autor::find($autor_id);
                if($autor != null){
                    $autor->slug = $request->input('nombre_autor');
                    $autor->is_active = $request->input('estado');
                    $autor->is_verified = $request->input('verificado');;
                    $autor->save();
                    return redirect()->route('indexAutores')->with('message', '¡Actualizado Correctamente!')->with('type','info');
                }
            }
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Autor  $autor
     * @return \Illuminate\Http\Response
     */
    public function destroy($autor_id)
    {
        try {
                $autor = Autor::find($autor_id);
                if($autor != null){
                    $libro_asociado = LibroAutor::where('author_id', $autor->id)->first();
                    if($libro_asociado == null){
                        $autor->delete();
                        return redirect()->route('indexAutores')->with('message', '¡Eliminado Correctamente!')->with('type','success');
                    }
                    return redirect()->route('indexAutores')->with('message', '¡No se puede eliminar! (Libros Aún Existentes)')->with('type','danger');
                }
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public static function getAllAuthors(){
        return Autor::getAllAuthors();
    }
}
