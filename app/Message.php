<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $table = 'messages';
    protected $fillable = ['razon','descripcion','adjunto'];


    public function messageDetail(){
        return $this->belongsTo('App\MessageDetail');
    }
}
