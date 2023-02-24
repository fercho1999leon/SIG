<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Career extends Model
{
    protected $table = 'Career';

    protected $fillable = ['nombre','costo_matricula'];

    public function semesters()
    {
        return $this->belongsTo('App\Semesters');
    }

}
