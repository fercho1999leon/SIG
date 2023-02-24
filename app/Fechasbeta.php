<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Fechasbeta extends Model
{

    public static function fechaMetodo1($fecha){
        $fecha = new Carbon($fecha);
         return  $fecha->day.'/'.$fecha->month.'/'.$fecha->year;
    }

    public static function fechaMetodo2($fecha){
        $fecha = new Carbon($fecha);
         return  $fecha->day.'-'.$fecha->month.'-'.$fecha->year;
    }


    public static function fechaMetodo3($fecha){
        $fecha = new Carbon($fecha);
        $mes = $fecha->month;
            $mes2 = "";
            switch($fecha->month){
                case 1:
                $mes2 = "Enero";
                break;
                case 2:
                $mes2 = "Febrero";
                break;
                case 3:
                $mes2 = "Marzo";
                break;
                case 4:
                $mes2 = "Abril";
                break;
                case 5:
                $mes2 = "Mayo";
                break;
                case 6:
                $mes2 = "Junio";
                break;
                case 7:
                $mes2 = "Julio";
                break;
                case 8:
                $mes2 = "Agosto";
                break;
                case 9:
                $mes2 = "Septiembre";
                break;
                case 10:
                $mes2 = "Octubre";
                break;
                case 11:
                $mes2 = "Noviembre";
                break;
                case 12:
                $mes2 = "Diciembre";
                break;

            }
            $dia = $fecha->format('l');
            $dia2 = "";
            switch($dia){
                case 'Monday':
                $dia2 = "Lunes, ";
                break;
                case 'Tuesday':
                $dia2 = "Martes, ";
                break;
                case 'Wednesday':
                $dia2 = "Miércoles, ";
                break;
                case 'Thursday':
                $dia2 = "Jueves, ";
                break;
                case 'Friday':
                $dia2 = "Viernes, ";
                break;
                case 'Saturday':
                $dia2 = "Sábado, ";
                break;
                case 'Sunday':
                $dia2 = "Domingo, ";
                break;

            }
        return  $dia2.' '.$fecha->day.' de '.$mes2.' del '.$fecha->year;
        
    }


}
