<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Sentinel;
class SubMenu extends Model
{
    public function permisosSubmenu()
    {
      return $this->hasMany('App\permiso', 'idSubMenu')
      ->where('iduser',Sentinel::getUser()->id)->first();
    }
}
