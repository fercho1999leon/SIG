<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Libro;
use App\Categoria;

class LibroCategoria extends Model
{
    protected $table = 'ebook_categories';
    public $timestamps = false;

    public static function getCategoryByBook($book_id){
        $libro = Libro::find($book_id);
        $categoria_libro = LibroCategoria::where('ebook_id', $libro->id)->first();
        if ($categoria_libro) {
            return Categoria::where('id', $categoria_libro->category_id)->first();
        }
        return null;
    }
}
