<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Request;

class GestionFacturaController extends Controller
{
    public function index() {
		$xmls = Storage::files('public/xml');
		return view('UsersViews.administrador.gestion-facturas.index', compact('xmls'));
	}

	public function show(Request $request) {
		$xmls = $request->xml_files;
		return view('UsersViews.administrador.gestion-facturas.listado', compact('xmls'));
	}
}
