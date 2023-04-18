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
        $res = $this->UpLoadFileStorage($request);
        
        return $res;
    }
    
    private function UpLoadFileStorage($request){
        $user = Administrative::findBySentinelid(Sentinel::getUser()->id);
        if($user->url_imagen!=null){
            if(Storage::disk('public')->exists('avatars', $user->url_imagen)){
                Storage::disk('public')->delete('avatars', $user->url_imagen);
            }
            StorageController::DelectSqlStorage($user->url_imagen,Sentinel::getUser()->id,$this->idPeriodoUser());
        }
        $file = $request->image;
        $path = Storage::disk('public')->putFile('avatars', $file,'public');

        $respSql = StorageController::StorageSql($file,$path,explode('.',$file->getClientOriginalName())[0],$file->getClientOriginalExtension(),$user->id,$this->idPeriodoUser());
           
        $user->url_imagen = $path;
        $user->save();
        if($respSql->getStatusCode() === 501) redirect('perfil')->withErrors(['error' => 'Error al cargar el archivo en la base de datos.']);
        return redirect('perfil');
    }
}
