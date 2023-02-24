<?php

use App\Student2;
use App\Student2Profile;
use App\ConfiguracionSistema;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel as Sentinel;
use App\PeriodoLectivo;
use App\User;
use Illuminate\Database\Seeder;

class EstudiantesSinUsuario extends Seeder
{
    public function run()
    {
        $periodo = PeriodoLectivo::where('nombre', '2020-2021')->first();
        $student = Student2::where(['idProfile'=>Null,'matricula'=>'Ordinaria'])->get();
 
        foreach($student as $key){


            // SE BUSCA AL ESTUDIANTE POR CI Y CORREO
            $user_profile = User::where('ci',$key->ci)->first();
            $nombres = explode(" ", $key->nombres);
            $apellidos = explode(" ", $key->apellidos);
            $primerNombre = strtolower($nombres[0]);
            $primerApellido = strtolower($apellidos[0]);
            $user_sentinel = ['email'=>$primerNombre.'.'.$primerApellido.$key->id."@pined.ec",'password'=>"12345"];
            $error = User::where('correo',$user_sentinel)->first();
            

            $student_per_year = Student2Profile::where('idStudent',$key->id)->first();
            $contador_matricula = ConfiguracionSistema::where('nombre', 'CONTADOR_MATRICULA')->where('idPeriodo', $periodo->id)->first();
            

            // CASOS DONDE NO TIENE REGISTRADO EL IDPROFILE EN LA TABLA STUDENTS2 PERO EXISTE EL REGISTRO EN LA TABLA USERS_PROFILE
            if (!is_null($user_profile)){
                $key->idProfile = $user_profile->id;
                $key->save();
            }else if(!is_null($error)){
                $key->idProfile = $error->id;
                $key->save();

            


            // CASOS DONDE NO TIENE REGISTRO EN LA TABLA USERS Y USERS_PROFILE
            }else if((!is_null($student_per_year))&&(is_null($user_profile))&&(is_null($error))){


                //CONTADOR PARA NUMERO DE MATRICULA EN CASO DE NO EXISTIR
                if($contador_matricula->valor == 'G' && is_null($student_per_year->numero_matriculacion)){
					$cont = Student2Profile::query()->where('idPeriodo', $periodo->id)->where('tipo_matricula', '!=','Pre Matricula')->count();
                    $student_per_year->numero_matriculacion = substr($periodo->fecha_inicial,0,4)."-".sprintf("%04d", $cont);
                    $student_per_year->save();
                } else if ($contador_matricula->valor == 'S' && is_null($student_per_year->numero_matriculacion)){
                    $cont = Student2Profile::where('seccion',$student_per_year->seccion)->where('tipo_matricula','!=','Pre Matricula')->where('idPeriodo',$periodo->id)->count();
                    $student_per_year->numero_matriculacion = substr($periodo->fecha_inicial,0,4)."-".sprintf("%04d", $cont);
                    $student_per_year->save();
                }

                $user= Sentinel::registerAndActivate($user_sentinel);
                $role= Sentinel::findRoleByName("Estudiante");
                $role->users()->attach($user);
                $idProfile = DB::table('users_profile')->insertGetId([
                    'ci'	        =>	$key->ci,	
                    'nombres'	    =>	$key->nombres,
                    'apellidos'	    =>	$key->apellidos,
                    'sexo'	        =>	$key->sexo,
                    'fNacimiento'	=>	$key->fechaNacimiento,
                    'correo'	    =>  $primerNombre.'.'.$primerApellido.$key->id."@pined.ec",
                    'dDomicilio'	=>	$key->dDomicilio,
                    'tDomicilio'	=>	$key->tDomicilio,
                    'cargo'	        =>	"Estudiante",	
                    'userid'        =>  $user->id,
                    'created_at'	=>	date("Y-m-d H:i:s"),
                ]);

                $key->idProfile = $idProfile;
                $key->save();
            }
        }
    }
}
