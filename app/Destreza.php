<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Course;
use App\Matter;

class Destreza extends Model
{
    protected $table = 'destrezas';

    protected $fillable = ['nombre', 'descripcion', 'idMateria', 'grado'];
}