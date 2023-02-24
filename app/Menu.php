<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Sentinel;
class Menu extends Model
{
    public function permisosmenu()
    {
      return $this->hasMany('App\permiso', 'idMenu')
      ->where('iduser',Sentinel::getUser()->id)
      ->where('idSubMenu', null)->first();
    }
}
