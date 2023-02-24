<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClassDay extends Model
{
    protected $table = 'classdays';

    protected $fillable = [
    	/* Primer Quimestre */
    	'fecha','ciclo', 'agenda'
    ];
}
