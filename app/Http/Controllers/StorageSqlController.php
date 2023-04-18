<?php

namespace App\Http\Controllers;

use App\ArchivosInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StorageSqlController extends Controller
{
    public static function create (Request $request){
        dd($request);
        //$respSql = DB::select("CALL insertar_archivo_base64(?, ?, ?, ?, ?)", array($request->dato1, $request->dato2, $request->dato3));
    }
}
