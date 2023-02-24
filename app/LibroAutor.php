<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Libro;
use App\Autor;

class LibroAutor extends Model
{
    protected $table = 'ebook_authors';
    public $timestamps = false;


    public static function getAuthorByBook($book_id){
        $libro = Libro::find($book_id);
        $autor_libro = LibroAutor::where('ebook_id', $libro->id)->first();
        if ($autor_libro) {
            return Autor::where('id', $autor_libro->author_id)->first();
        }
        return null;
    }
}
