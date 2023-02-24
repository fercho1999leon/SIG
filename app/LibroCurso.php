<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LibroCurso extends Model
{
    protected $table = 'libro_curso';
    public $timestamps = false;

    public static function getCourseByBook($book_id)
    {
        return LibroCurso::where('libro_id', $book_id)->first();
    }
}
