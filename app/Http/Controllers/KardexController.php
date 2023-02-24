<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Redirect;
use App\KardexExport;
use App\Student2;
use App\Student2Profile;
use App\Course;
use App\Semesters;
use App\Cuentasporcobrar;
use Carbon\Carbon;
use App\PeriodoLectivo;
use Illuminate\Support\Facades\DB;

class KardexController extends Controller
{
   
    
    public function exportKardex($id) {
   
        Excel::create('Datos Alumnos', function ($excel) use($id) {
            
            $data = Student2::where('id',$id)->first();
            //$estudiante = Student2Profile::get()->first();
            //dd($data);
            $estudiante = Student2Profile::where('idStudent',$data->id)->first();
            // dd($estudiante,$data);
            //$data = Student2::get()->first();
            $semestre = Course::where('id','=',$estudiante->idCurso)->first();
            //$semestre = Semesters::where('id','=',$estudiante->idCurso)->first();
            // dd($semestre);
            $semestreCarrera = Semesters::where('career_id','=',$semestre->id_career)->first();
            // dd($semestreCarrera);
    
            $excel->sheet('New sheet', function($sheet) use ($data,$estudiante,$semestre,$semestreCarrera){
                $sheet->setStyle(array(
                    'font' => array(
                        'name'      =>  'Calibri',
                        'size'      =>  10,
                        'bold'      =>  false
                    ),
                    'text' => array(
                        'align'     =>  'center'
                    ),
                    'color' => array(
                        'background'     =>  '#a0b7c5'
                    ),

                ));
                $pago = [100,130,10,0,50];
                //dd($pago);
                $sheet->with('estudiante',$estudiante);
                $sheet->with('semestre', $semestre);
                $sheet->with('semestreCarrera', $semestreCarrera);
                $sheet->with('pago',$pago);
                $cuentasxcobrar = Cuentasporcobrar::where('cliente_id','=',$estudiante->id )->get();
                $costoMatricula = Cuentasporcobrar::where('cliente_id','=',$estudiante->id )
                                                    ->where('concepto','=','Matricula del Semestre')
                                                    ->first();
                $cuotasSemestre = Cuentasporcobrar::select('cuentas_por_cobrar.*',
                                                \DB::raw('(CASE
                                                    WHEN cuentas_por_cobrar.status = "1" THEN "POR VENCER"                        
                                                    WHEN cuentas_por_cobrar.status = "2" THEN "PAGADA"                        
                                                    WHEN cuentas_por_cobrar.status = "3" THEN "ABONADO"                        
                                                    WHEN cuentas_por_cobrar.status = "4" THEN "EN PROCESO DE VERIFICACION"   
                                                    WHEN cuentas_por_cobrar.status = "0" THEN "ELIMINADA"                        
                                                    END) AS estado'))
                                                ->where('cliente_id','=',$estudiante->id )
                                                ->where('concepto','=','Cuota de Semestre')
                                                ->get();
                
                $periodos = PeriodoLectivo::where('id','=',$semestre->idPeriodo)->first();
                $sheet->with('costoMatricula',$costoMatricula);
                $sheet->with('cuotasSemestre',$cuotasSemestre);
            
                $sheet->loadView('UsersViews.colecturia.kardex.kardex')->with('data',$data);
                
            });
        
            
        })->export('xls');
    }

    public function consultarPagos($id){
        $cuentasxcobrar = Cuentasporcobrar::where('cliente_id','=',$id)->get();
        //dd($cuentasxcobrar->isEmpty());
        if($cuentasxcobrar==null){
            return true;
        }else{
            return false;
        }
    }

}
