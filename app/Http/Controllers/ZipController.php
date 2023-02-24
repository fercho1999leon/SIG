<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Chumper\Zipper\Zipper;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;


class ZipController extends Controller
{
    public function download(Request $request) {
        
        $files = glob(public_path('storage/deberes_adjuntos'.$request->rutaDescarga));

        if(empty($files)){
            return redirect()->back()->with('message', [
                'type' => 'danger', 'text' => "No hay Deberes adjuntos para: ".$request->nombreDescarga
            ]);
        }

        if(Storage::disk('local')->exists('public/Comprimido'))
        {
            Storage::deleteDirectory('public/Comprimido');
        }

        $zipper = new Zipper();
        $zipper->make('storage/Comprimido/'.substr($request->nombreDescarga,0,25).'.zip')->add($files)->close();

        return response()->download(public_path('storage/Comprimido/'.substr($request->nombreDescarga,0,25).'.zip'));
    }
}
