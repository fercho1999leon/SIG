<?php

use Illuminate\Database\Seeder;
use App\Student2;
class RetiradoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $students = Student2::all();

        foreach($students as $student){
            if ($student->retirado == null){
                $student->retirado = 'NO';

                $student->save();
            }
        }
    }
}
