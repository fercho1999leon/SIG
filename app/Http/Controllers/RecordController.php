<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Administrative;
use App\Student2;
use App\User;
use App\Usuario;

class RecordController extends Controller
{
    public function index(){
		
		$users = Administrative::query()
		->search(request('search'))
		->perfil(request('perfil'))
		->paginate(20);
		//dd($users);
		return view('UsersViews.administrador.historialDeUso.historial', compact(
			'users'
		));
	}
}
