<?php

use App\Student2;
use App\Student2Profile;
use Illuminate\Database\Seeder;

class CorrecionesRegistrosDuplicados extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $student = Student2::all();
        foreach($student as $key){
            $students = Student2Profile::where('idStudent',"=",$key->id)->first();
            if (is_null($students)){
                $key->delete();
            }
        }
    }
}