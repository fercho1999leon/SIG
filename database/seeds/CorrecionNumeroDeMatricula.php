<?php

use App\PeriodoLectivo;
use App\Student2Profile;
use Illuminate\Database\Seeder;

class CorrecionNumeroDeMatricula extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $idPeriodoLectivo = PeriodoLectivo::where('nombre', '2020-2021')->first()->id;

        $students = Student2Profile::query()
            ->where('idPeriodo', $idPeriodoLectivo)
            ->where('tipo_matricula', '!=', 'Pre Matricula')
            ->where('retirado', 'NO')
            ->get();

        $nm1 = "2020-000";
        $nm2 = "2020-00";
        $nm3 = "2020-0";


        $i = 1;

        foreach ($students as $student) {

            if (strlen($i) == 1)
                $student->numero_matriculacion = "$nm1$i";

            if (strlen($i) == 2)
                $student->numero_matriculacion = "$nm2$i";

            if (strlen($i) == 3)
                $student->numero_matriculacion = "$nm3$i";

            $student->save();
            $i++;
        }
    }
}
