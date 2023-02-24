<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Student2;
use App\Pago;
use App\PagoRealizado;
use Carbon\Carbon;

class PaymentStudent extends Model
{
    protected $table = 'pagosestudiantes';

    protected $fillable = [
    	'idPago', 'idEstudiante', 'nombres', 'apellidos', 'ciRUC', 'cantidad'
    ];

    public static function mespagado($hijo, $pagos, $pagosEstudiantes, $lectivo, $diaBloqueo){
        $fecha = Carbon::now();
        $dia = $fecha->day;

        //Enlace de pagos del estudiante
        foreach ($pagosEstudiantes as $key => $pagoEstudiante) {
            //Trae la fecha de prórroga y me da el día de prórroga
            $dP = Carbon::parse($pagoEstudiante->prorroga); 
            $diaDP =  $dP->day;       

            //Enlace de pagos del Curso
            foreach ($pagos as $key => $pago) {
                
                //Verifica el mes a comprobar.
                if($pagoEstudiante->idPago == $pago->id){

                    //Verifica si está pagado
                    if( $pagoEstudiante->estado=='Pagado'){
                        return "Pagado";
                    }else{

                        //Valido la existencia de prórroga
                        if($pagoEstudiante->prorroga==null){

                            //Al no haber prórroga, verifica si el mes está pagado
                            if($dia<=$diaBloqueo){
                                //return $pagoEstudiante;
                                return "Pagado";
                            }else{
                                return "Pendiente";
                            }
                            
                        }else{

                            //Verifica si está dentro de los dias a mostrar
                            if($dia<=$diaDP){
                                //return $pagoEstudiante;
                                return "Pagado";
                            }else{
                                return "Pendiente";
                            }
                        }
                        
                    }

                }
                
            }
        }
        return 'Pendiente';
    }

    public static function mes($lectivo){
        $year = $lectivo->year;
        $month = $lectivo->month;
        switch($month){
            case 1:
                $month = "Enero";
            break;
            case 2:
                $month = "Febrero";
            break;
            case 3:
                $month = "Marzo";
            break;
            case 4:
                $month = "Abril";
            break;
            case 5:
                $month = "Mayo";
            break;
            case 6:
                $month = "Junio";
            break;
            case 7:
                $month = "Julio";
            break;
            case 8:
                $month = "Agosto";
            break;
            case 9:
                $month = "Septiembre";
            break;
            case 10:
                $month = "Octubre";
            break;
            case 11:
                $month = "Noviembre";
            break;
            case 12:
                $month = "Diciembre";
            break;
        }

        return $month;
    }

    public  static function pagosRealizados($idEstudiante){
        return PaymentStudent::where('idEstudiante', $idEstudiante)->get();
    }
}
