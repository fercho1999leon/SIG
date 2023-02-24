<?php

use App\Student2;
use Illuminate\Database\Seeder;
use App\User;
use App\Student2Profile;
use App\PeriodoLectivo;
use App\Administrative;

class ActualizarCorreosRubira extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $estudiantes = Student2Profile::where('tipo_matricula','Ordinaria')->get();
        $estudiantes = Administrative::where('cargo', 'Estudiante')->get();
        foreach ($estudiantes as $estudiante) {
            $students = Student2::where(['idProfile'=>$estudiante->id,'matricula'=>'Ordinaria'])->get();
            foreach($students as $key){
                $student_profile = Student2Profile::where('idStudent',$key->id)->first();
                if (!is_null($student_profile)){
                    $estudiante->correo = $estudiante->ci."@pined.ec";
                    $estudiante->save();
                    $user = Sentinel::findById($estudiante->userid);
                    $user->email = $estudiante->correo;
                    $credentials = ['password' => $estudiante->ci];
                    Sentinel::update($user, $credentials);
                    $user->save();
                }
            }
            
        }
    }
}
