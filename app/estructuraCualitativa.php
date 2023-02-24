<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class estructuraCualitativa extends Model
{
    protected $table = 'estructura_cualitativas';
    protected $fillable = ['nombre','created_at','updated_at'];
}
