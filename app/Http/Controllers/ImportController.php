<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Categoria;
use App\Autor;
use App\User;
use Sentinel;
use App\Libro;
use App\LibroAutor;
use App\LibroCategoria;
use Carbon\Carbon;
use DB;

use Maatwebsite\Excel\Facades\Excel;
use App\TiempoSession;
class ImportController extends Controller
{
    public function index(){
        try {
            return view('UsersViews.administrador.biblioteca.imports.index');
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function import(Request $request){
     //dd($request);
        Excel::load($request->file('alumnos'), function($reader) {
            $results = $reader->get();
            $row = $results->toArray();
            //dd($ret);
            foreach ($row as $index => $value) {
                $user_data = User::where('userid', Sentinel::getUser()->id)->pluck('userid')->first();
                $author = $this->newAuthor($value, $user_data);
                $category = $this->newCategory($value, $user_data);
                $libro = $this->newBook($value, $user_data);
               // var_dump($author);
                $book_author = $this->newBook_Author($author,$libro);
                $book_category = $this->newBook_Categories($category,$libro);
            }
            //dd($author);
        });
        Session::flash('alert', "Se han subido Los Libros de Forma Correcta");
        return back();
        //return redirect()->route('indexLibros');
    }
    public function newAuthor($row, $user){

        if($this->verificarAutor($row['slug_author'])){
            $author = new Autor;
                    $author->user_id = $user;
                    $author->slug = $row['slug_author'];
                    $author->is_active = $row['status'];
                    $author->is_verified = $row['is_verified'];
                    $author->save();            
            return $author;
        }else{
            $autor = Autor::where('slug','=',$row['slug_author'])->first();
            return $autor;
        }
        
    }
    public function newCategory($row, $user){
        if($this->verificarCategoria($row['slug_category'])){
           $categoria = new Categoria;
           $categoria->slug = $row['slug_category'];
           $categoria->is_searchable = 1;
           $categoria->is_active = $row['status'];
            $categoria->save();
            return $categoria;          
        }else{
            $categoria = Categoria::where('slug','=',$row['slug_category'])->first();
            return $categoria;
        }
    }
    public function newBook($row, $user){
        $user_data = User::where('userid', Sentinel::getUser()->id)->pluck('id')->first();
        if($this->verificarLibro($row['slug'])){
            $libro = new Libro;
            $libro->user_id = $user_data;
            $libro->slug = $row['slug'];
            $libro->file_url ="";
            $libro->isbn = $row['isbn'];
            $libro->publication_year = $row['publication_year'];
            $libro->is_featured = $row['status'];
            $libro->is_private = 1;
            $libro->is_active = 1;
            $libro->save();
            return $libro;
        }else{
            $libro = Libro::where('slug','=',$row['slug'])->first();
            return $libro;
        }
    }

    public function newBook_Author($author, $book){
        if($this->verificarLibro_Autor($book['id'],$author['id'])){
            $author_book = new LibroAutor;
            $author_book->ebook_id = $book['id'];
            $author_book->author_id = $author['id'];
            $author_book->save();
            return $author_book;
        }else{
            $author_book = LibroAutor::where('ebook_id','=',$book['id'])->Where('author_id','=',$author['id'])->first();
            return $author_book;
        }
    }

    public function newBook_Categories($category, $book){
        if($this->verificarLibro_Categoria($book['id'],$category['id'])){
            $category_book = new LibroCategoria;
            $category_book->ebook_id = $book['id'];
            $category_book->category_id = $category['id'];
            $category_book->save();
            return $category_book;
        }else{       
             $categoria = LibroCategoria::where('ebook_id','=',$book['id'])->Where('category_id','=',$category['id'])->first();
             return $categoria;
        }
    }


    /**
     * Validaciones para conocer si existe o no un 
     * Autor
     * Categoria 
     * Libro 
     * libro-categoria 
     * libro-autor
     */
    public function verificarAutor($autor){
       $autores = Autor::where('slug','=',$autor)->pluck('slug')->first();
       if($autores != ""){
           return false;
        }else{
            return true;
        }
    }
    public function verificarCategoria($cat){
        $categoria = Categoria::where('slug','=',$cat)->pluck('slug')->first();
        echo($categoria);
       if($categoria != ""){
           return false;
        }else{
            return true;
        }
    }
    public function verificarLibro($libro){
        $autores = Libro::where('slug','=',$libro)->pluck('slug')->first();
       if($autores != ""){
           return false;
        }else{
            return true;
        }
    }
    public function verificarLibro_Categoria($id_libro, $id_categoria){
        $libro_categoria = LibroCategoria::where('ebook_id','=',$id_libro)->Where('category_id','=',$id_categoria)->pluck('ebook_id')->first();
        if($libro_categoria != ""){
            return false;
         }else{
             return true;
         }
    }
    public function verificarLibro_Autor($id_libro, $id_autor){
        $libro_autor = LibroAutor::where('ebook_id','=',$id_libro)->Where('author_id','=',$id_autor)->pluck('ebook_id')->first();
        if($libro_autor != ""){
            return false;
         }else{
             return true;
         }
    }
 
}
