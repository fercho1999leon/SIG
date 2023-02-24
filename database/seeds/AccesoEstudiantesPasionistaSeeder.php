<?php

use Illuminate\Database\Seeder;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel as Sentinel;
use App\Course;
use App\Student2;
use App\User;

class AccesoEstudiantesPasionistaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $students = Student2::all();

        foreach ($students as $key) {
        	$student = Student2::find($key->id);
        	if($student->idCurso<4){
        		$student->seccion='EI';
        	}
        	if($student->idCurso>3 && $student->idCurso<28){
        		$student->seccion='EGB';
        	}
        	if($student->idCurso>27){
        		$student->seccion='BGU';
        	}

        	$student->save();
        }

        foreach($students as $student){
            // Conversión y extracción del primer nombre y primer apellido
            $nombres = explode(" ", $student->nombres);
            $apellidos = explode(" ", $student->apellidos);
            $primerNombre = strtolower($nombres[0]);
            $primerApellido = strtolower($apellidos[0]);

            $user_sentinel = [
            					'email'	=>	$primerNombre.'.'.$primerApellido.$student->id."@pined.com",
            					'password'	=>	"12345"
            				];
            $user= Sentinel::registerAndActivate($user_sentinel);

            // Registra el rol de los usuarios 
            $role= Sentinel::findRoleByName("Estudiante");
            $role->users()->attach($user);
            $idProfile = DB::table('users_profile')
                ->insertGetId([
                    'ci'	        =>	$student->ci,	
                    'nombres'	    =>	$student->nombres,
                    'apellidos'	    =>	$student->apellidos,
                    'sexo'	        =>	$student->sexo,
                    'fNacimiento'	=>	$student->fechaNacimiento,
                    'correo'	    =>  $primerNombre.'.'.$primerApellido.$student->id."@pined.com",
                    'dDomicilio'	=>	$student->dDomicilio,
                    'tDomicilio'	=>	$student->tDomicilio,
                    'cargo'	        =>	"Estudiante",	
                    'userid'        =>  $user->id,
                    'created_at'	=>	date("Y-m-d H:i:s"),
                ]);
            $student->idProfile = $idProfile;

            $student->save();
        }
    }
}
