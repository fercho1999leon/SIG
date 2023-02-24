<?php

use Illuminate\Database\Seeder;
use App\Student2;
use App\Administrative;
use App\Student2Profile;
use App\User;
use App\Usuario;
use Illuminate\Support\Facades\DB;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;

class CrearUsuariosFaltantes extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user_info = DB::table('students2')
                 ->select('idProfile', DB::raw('count(*) as total'))
                 ->where('idProfile','<>', null)
                 ->groupBy('idProfile')  
                 ->havingRaw('total > 1 ')            
                 ->pluck('idProfile');  

                foreach ($user_info as $id) {
                	$idStudiante = Student2::where('idProfile', $id)->get();

                	foreach ($idStudiante as $estudiante) {
                	//	
                		$user_perfil = Administrative::where('id', $estudiante->idProfile)
                		->where('ci',$estudiante->ci )
                		->first();
                		if($user_perfil!=''){                			
                			$estudenPeriodo = Student2Profile::where('idStudent', $estudiante->id )
                			->where('idPeriodo', 1)->exists();
                			echo $estudiante->id.'--'.$estudiante->ci.'--'.$user_perfil->id.'existe: '.$estudenPeriodo.'<br>';
                			if(!$estudenPeriodo){
                			$delete_estudiante_repetido = Student2::findOrFail($estudiante->id);
                			$delete_estudiante_repetido->delete();
                			}                			
                		}else{
                $estudianteToSave= Student2::findOrFail($estudiante->id);
                // Creación de usuario en sentinel
                $user = new User;
				$nombres = explode(" ", $estudianteToSave->nombres);
				$apellidos = explode(" ", $estudianteToSave->apellidos);
				$primerNombre = strtolower($nombres[0]);
				$primerApellido = strtolower($apellidos[0]);

                $user_sentinel = [
                    'email'	=>	$request->correo ?? $primerNombre.'.'.$primerApellido.$estudianteToSave->id."@pined.ec",
                    'password'	=>	"12345"
				];
				
				$user = Sentinel::registerAndActivate($user_sentinel);
				$user->idPeriodoLectivo = 1;
				$user->save();
				
				//registra el rol de los usuarios 
				$role = Sentinel::findRoleByName("Estudiante");
				$role->users()->attach($user);
				$idProfile = DB::table('users_profile')
					->insertGetId([
						'ci'	=>	$estudianteToSave->ci,	
						'nombres'	=>	$estudianteToSave->nombres,
						'apellidos'	=>	$estudianteToSave->apellidos,
						'sexo'	=>		$estudianteToSave->sexo,
						'fNacimiento'	=>	$estudianteToSave->fechaNacimiento,
						'correo'	=> $request->correo ?? $user->email,
						'dDomicilio'	=>	$estudianteToSave->dDomicilio,
						'tDomicilio'	=>	$estudianteToSave->tDomicilio,
						'cargo'	=>	"Estudiante",	
						'userid'   =>  $user->id,
						'created_at'	=>	date("Y-m-d H:i:s"),
					]);
				$estudianteToSave->idProfile = $idProfile;
				$estudianteToSave->save();                	
               	echo ' no existe: '.$estudiante->id.' con cedula'.$estudiante->ci.'</br>';}
                	}
                 
                }         
                $nulos = Student2::whereNull('idProfile')
                ->pluck('id');
                foreach ($nulos as $null) {
               	$delete_nulos = Student2::findOrFail($null);
                $delete_nulos->delete();
                }
    }
}