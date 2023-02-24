<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

use App\User;
use App\Libro;
use App\LibroAutor;
use App\LibroCategoria;
use Sentinel;
use Carbon\Carbon;
use Illuminate\Http\Request;

class LibroController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //dd(Sentinel::getUser()->id);
      /*
        session(['horaInicio' => Carbon::now(),
        'user' => User::where('userid','=',Sentinel::getUser()->id)->pluck('id')->first()
        //'libro' => 
        ]); */
        
        try {
            return view('UsersViews.administrador.biblioteca.libros.index');
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
       // dd($request);
        try {
            $user_data = User::where('userid', Sentinel::getUser()->id)->first();
            if($request!=null){
                 if ($request->hasFile('documento')) {
                    $libro = new Libro;
                    $libro_autor = new LibroAutor;
                    $libro_categoria = new LibroCategoria;
                    $libro->user_id = $user_data->id;
                    $libro->slug = $request->input('titulo');
                    
                    $documento = $request->file('documento');
                    $nombre_documento = $documento->getClientOriginalName();
                    $documento->move('libros', $nombre_documento);
                    $libro->file_url = $nombre_documento;
                    $libro->isbn = $request->input('isbn');
                    $libro->publication_year = $request->input('publicacion');
                    $libro->is_active = $request->input('estado');
                    $libro->is_private = 1;
                    $libro->is_featured = 1;

                    $libro->save();

                    $libro_autor->ebook_id = $libro->id;
                    $libro_autor->author_id = $request->input('autor');

                    $libro_autor->save();

                    $libro_categoria->ebook_id = $libro->id;
                    $libro_categoria->category_id = $request->input('categoria');

                    $libro_categoria->save();

                    return redirect()->route('indexLibros')->with('message', '¡Agregado Correctamente!')->with('type','success');
                }
            }
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Libro  $libro
     * @return \Illuminate\Http\Response
     */
    public static function show($ruta, $titulo)
    {
       return response()->download(storage_path('app/public/' . $ruta));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Libro  $libro
     * @return \Illuminate\Http\Response
     */
    public function edit($libro_id)
    {
        try {
            $libro = Libro::find($libro_id);
            return view('UsersViews.administrador.biblioteca.libros.edit', compact('libro'));
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Libro  $libro
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $libro_id)
    {
        try {
            if($request!=null){
                    $libro = Libro::find($libro_id);
                    /* $libro_autor = LibroAutor::where('ebook_id',$libro->id)->first();
                    $libro_categoria = LibroCategoria::where('ebook_id',$libro->id)->first(); */

                    $libro->slug = $request->input('titulo');
                    if ($request->hasFile('documento')) {
                        $documento = $request->file('documento');
                        $nombre_documento = $documento->getClientOriginalName();
                        $documento->move('libros', $nombre_documento);
                        $libro->file_url = $nombre_documento;
                    }
                    $libro->isbn = $request->input('isbn');
                    $libro->publication_year = $request->input('publicacion');
                    $libro->is_active = $request->input('estado');
                    $libro->is_private = 1;
                    $libro->is_featured = 1;
                    $libro->save();

                    
                 /* if($request->input('autor') != $libro_autor->author_id){
                        $libro_autor->author_id = $request->input('autor');
                        $libro_autor->save();
                    }

                     if($request->input('categoria') != $libro_categoria->category_id){
                        $libro_categoria->category_id = $request->input('categoria');
                        $libro_categoria->save();
                    } */

                    return redirect()->route('indexLibros')->with('message', '¡Actualizado Correctamente!')->with('type','success');
                
            }
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Libro  $libro
     * @return \Illuminate\Http\Response
     */
    public function destroy($libro_id)
    {
        try {
                $libro = Libro::find($libro_id);
                if($libro != null){
                    $libro_autor = LibroAutor::where('ebook_id', $libro->id);
                    $libro_categoria = LibroCategoria::where('ebook_id', $libro->id);
                    $libro_autor->delete();
                    $libro_categoria->delete();
                     if(File::exists(public_path('libros/'.$libro->file_url))){
                        File::delete(public_path('libros/'.$libro->file_url));
                     }
                    $libro->delete();
                    return redirect()->route('indexLibros')->with('message', '¡Eliminado Correctamente!')->with('type','success');
                }
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public static function getAllBooks(){
        return Libro::getAllBooks();
    }
}
