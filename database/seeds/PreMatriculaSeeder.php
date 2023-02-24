<?php

use Illuminate\Database\Seeder;
use App\Student2;

class PreMatriculaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $students = Student2::where('matricula', 'Pre Matricula')->get();

        foreach ($students as $key => $student) {
            $student->idCurso = null;
            $student->idPadre = null;
            $student->idMadre = null;
            $student->idRepresentante = null;
            $student->idProfile = null;
            $student->idPeriodo = null;

            $student->save();
        }

    }
}
