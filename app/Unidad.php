<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Unidad extends Model
{
    protected $table = 'unidad';
    public $timestamps = false;

    public static function getUnidadesBySyllabus($syllabus_id)
    {
        return Unidad::where('syllabus_id', $syllabus_id)->get();
    }

    public static function getUnidadById($id)
    {
        return Unidad::where('id', $id)->first();
    }
}
