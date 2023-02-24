<?php

namespace App;
use DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Facades\Excel;
use App\Student2;
use App\Student2Profile;
use App\User;


class ReportesExcelMatiz implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function headings(): array
    {
        return [
            'numeroIdentificacion',
            'primerApellido',
            'segundoApellido',
            'primerNombre',
            'segundoNombre',
            'sexoId',
        ];
        
       // ci	apellidos	apellidos	nombres	nombres	sexo

    }
    public function collection()
    {
        
        /* 
        $users = DB::table('students2')
         ->select('ci','SUBSTRING_INDEX(apellidos, ' ', 1) AS primerApellido','SUBSTRING_INDEX(SUBSTRING_INDEX(apellidos,' ', 2), ' ',-1) AS segundoApellido','SUBSTRING_INDEX(nombres, ' ', 1) AS primerNombre','SUBSTRING_INDEX(SUBSTRING_INDEX(nombres,' ', 2), ' ',-1) AS segundoNombres','sexo')
         ->get();
         */
        //dd($users)

        $alumnos = Student2::query('students2')
        ->select('ci as numeroIdentificacion','apellidos as primerApellido', 
                'apellidos as segundoApellido', 'nombres as primerNombre','nombres as segundoNombre','sexo as sexoId')
        ->get();

        //dd($alumnos);
         return $alumnos;
         //SELECT SPLIT_STR('apellidos', ' ', 1) as primerApellido

    }
}