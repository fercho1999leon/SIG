<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Administrative;
use DB;

class datosController extends Controller
{
    public function index(Request $request){

    	return $representante= Administrative::where('cargo','Representante')
    	->join('students2 as S', 'users_profile.id', '=', 'S.idRepresentante')
    	->select('S.nombres','S.apellidos','S.ci','users_profile.nombres as n_repre','users_profile.apellidos as a_repre','users_profile.ci as ci_repre','users_profile.correo as e_repre','users_profile.nombres as n_repre','users_profile.movil as m_repre','users_profile.dDomicilio as d_repre')
    	  	->get();
    }
}
