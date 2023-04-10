<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Administrative;
use App\ArchivoBase64;
use Sentinel;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class AdministrativeController extends Controller
{
    public function index() {
    	$data = Administrative::all();
        return view(session('rol')->slug.'.administrador.administradores.index', compact('data'));
    }

    public function show(Request $request, $id) {
        $data = Administrative::findOrFail($id);
        
        return view(session('rol')->slug.'.administratives.show', compact('data'));
    }


    public function create() {
        return view(session('rol')->slug.'.fichasPersonales.administradores.crear');
    }

    public function store(Request $request) {
        $data = new Administrative();
        //General
        $data->ci = $request->ci;
        $data->nombres = $request->nombres;
        $data->apellidos = $request->apellidos;
        $data->sexo = $request->sexo;
        $data->fNacimiento = $request->fNacimiento;
        $data->correo = $request->correo;
        $data->movil = $request->movil;
        //Adicional
        $data->bio = $request->bio;
        //Domicilio
        $data->dDomicilio = $request->dDomicilio;
        $data->tDomicilio = $request->tDomicilio;
        //Cargo
        $data->cargo = $request->cargo;    
        
        $data->save();
        return redirect()->route('.administratives.index');
    }

    public function edit(Request $request, $id) {
        $data = Administrative::findOrFail($id);
        return view(session('rol')->slug.'.administratives.edit', compact('data'));
    }

    public function update(Request $request, $id) {
        $data = Administrative::findOrFail($id);
        //General
        $data->ci = $request->ci;
        $data->nombres = $request->nombres;
        $data->apellidos = $request->apellidos;
        $data->sexo = $request->sexo;
        $data->fNacimiento = $request->fNacimiento;
        $data->correo = $request->correo;
        $data->movil = $request->movil;
        //Adicional
        $data->bio = $request->bio;
        //Domicilio
        $data->dDomicilio = $request->dDomicilio;
        $data->tDomicilio = $request->tDomicilio;
        //Cargo
        $data->cargo = $request->cargo;  
        
        $data->save();
        return redirect()->route('.administratives.index');
    }

    public function destroy($id) {
        $data = Administrative::findOrFail($id);
        $data->delete();
        return redirect()->route('.administratives.index');
    }


    //Avatar
    public function storeAvatar(Request $request){

		$this->validate($request, [
			'image' => 'mimes:jpeg,jpg,png,gif|required|max:10000'
		]);        
        $this->UpLoadFileStorage($request);
       // $respSql = DB::select("SELECT insertar_archivo_base64(?, ?, ?, ?, ?)", array(explode('.',$file->getClientOriginalName())[0], base64_encode(file_get_contents($file->getRealPath())), $file->getClientOriginalExtension(), $path, Sentinel::getUser()->id));
        return redirect('perfil');
    }
    
    private function UpLoadFileStorage($request){
        //$path = Storage::disk('public')->putFile('avatars', $request->image,'public');
        $user = Administrative::findBySentinelid(Sentinel::getUser()->id);
        //dd($user);
        if($user->url_imagen!=null){
            if(Storage::disk('public')->exists('avatars', $user->url_imagen)){
                Storage::disk('public')->delete('avatars', $user->url_imagen);
            }
            ArchivoBase64::join('archivos_info','archivos_base64.id','=','archivos_info.archivos_base64_id')
                ->where('ruta_archivo',$user->url_imagen)
                ->where('user_id',Sentinel::getUser()->id)
                ->delete();
        }
        $file = $request->image;
        $path = Storage::disk('public')->putFile('avatars', $request->image,'public');
        $respSql = DB::select("SELECT insertar_archivo_base64(?, ?, ?, ?, ?)", array(explode('.',$file->getClientOriginalName())[0], base64_encode(file_get_contents($file->getRealPath())), $file->getClientOriginalExtension(), $path, Sentinel::getUser()->id));
        $user->url_imagen = $path;
        $user->save();
        if($respSql) return response('Error al cargar el archivo en la base de datos.',503);
        return response('Avatar cargado correctamente.',201);
    }
}
