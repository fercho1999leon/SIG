<?php

use App\Student2;
use App\User;
use Illuminate\Database\Seeder;

class CorrecionEstudianteNovus extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $student = Student2::where('idProfile',Null)->get();
        foreach($student as $key){
            $user_profile = User::where('ci',$key->ci)->first();
            if (!is_null($user_profile)){
                $key->idProfile = $user_profile->id;
                $key->save();
            }
        }
    }
}
