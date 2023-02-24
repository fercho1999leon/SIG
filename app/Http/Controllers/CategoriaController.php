<?php

namespace App\Http\Controllers;

use App\Categoria;
use App\LibroCategoria;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            return view('UsersViews.administrador.biblioteca.categorias.index');
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
            if($request!=null){
               
                $categoria = new Categoria;
                $categoria->slug = $request->input('nombre_categoria');
                $categoria->is_searchable = 1;
                $categoria->is_active = $request->input('estado');
                $categoria->save();
                return redirect()->route('indexCategorias')->with('message', '¡Agregada Correctamente!')->with('type','success');
            }
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Categoria  $categoria
     * @return \Illuminate\Http\Response
     */
    public function show(Categoria $categoria)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Categoria  $categoria
     * @return \Illuminate\Http\Response
     */
    public function edit($categoria_id)
    {
        try {
            $categoria = Categoria::find($categoria_id);
            return view('UsersViews.administrador.biblioteca.categorias.edit', compact('categoria'));
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Categoria  $categoria
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $categoria_id)
    {
        try {
            if($request!=null){
                $categoria = Categoria::find($categoria_id);
                if($categoria != null){
                    $categoria->slug = $request->input('nombre_categoria');
                    $categoria->is_searchable = 1;
                    $categoria->is_active = $request->input('estado');
                    $categoria->save();
                     return redirect()->route('indexCategorias')->with('message', '¡Actualizada Correctamente!')->with('type','info');
                }
            }
        } catch (Exception $e) {
            redirect()->back()->with('message', 'IT WORKS!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Categoria  $categoria
     * @return \Illuminate\Http\Response
     */
    public function destroy($categoria_id)
    {
        try {
                $categoria = Categoria::find($categoria_id);
                if($categoria != null){
                    $libro_asociado = LibroCategoria::where('category_id', $categoria->id)->first();
                    if($libro_asociado == null){
                        $categoria->delete();   
                        return redirect()->route('indexCategorias')->with('message', '¡Eliminado Correctamente!')->with('type','success');
                    }
                     return redirect()->route('indexCategorias')->with('message', '¡No se puede eliminar! (Libros Aún Existentes)')->with('type','danger');
                }
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public static function getAllCategories(){
        return Categoria::getAllCategories();
    }
}

