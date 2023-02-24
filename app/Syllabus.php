<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Syllabus extends Model
{

    protected $table = 'syllabus';
    public $timestamps = false;

    public function createSyllabus($id_materia)
    {

    }

    public function getAllSyllabus()
    {
        try {
            Syllabus::getAll();
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    public static function getSyllabusByName($nombre_syllabus)
    {
        return Syllabus::where('nombre_syllabus', $nombre_syllabus)->exists();
    }

    public static function getSyllabusByMatter($materia_id)
    {
        return Syllabus::where('materia_id', $materia_id)->first();
    }

    public static function getSyllabusBoolByMatter($materia_id)
    {
        return Syllabus::where('materia_id', $materia_id)->exists();
    }

    public static function getSyllabusById($id)
    {
        return Syllabus::where('id', $id)->first();
    }

}
