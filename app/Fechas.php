<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Fechas extends Model
{
	public static function diaDeLaSemana($numero) {
		switch ($numero) {
			case '1':
				$dia = 'Lunes';
				break;
			case '2':
				$dia = 'Martes';
				break;
			case '3':
				$dia = 'Miercoles';
				break;
			case '4':
				$dia = 'Jueves';
				break;
			case '5':
				$dia = 'Viernes';
				break;
			case '6':
				$dia = 'Sábado';
				break;
			default:
            $dia = 'Domingo';
				break;
		}

		return $dia;
	}
    public static function fechaActual(){
        setlocale(LC_TIME, 'Spanish');
        Carbon::setUtf8(true);
        $now = Carbon::now();
    	$mes = $now->month;
        $mes2 = "";
        switch($now->month){
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

        $dia = $now->format('l');
        $dia2 = "";
        switch($dia){
            case 'Monday':
                $dia2 = "Lunes";
                break;
            case 'Tuesday':
                $dia2 = "Martes";
                break;
            case 'Wednesday':
                $dia2 = "Miércoles";
                break;
            case 'Thursday':
                $dia2 = "Jueves";
                break;
            case 'Friday':
                $dia2 = "Viernes";
                break;
            case 'Saturday':
                $dia2 = "Sábado";
                break;
            case 'Sunday':
                $dia2 = "Domingo";
                break;
        }

        return  $dia2.' '.$now->day.' de '.$mes2.' del '.$now->year;
    }

    public static function fechaActualMdY(){
        setlocale(LC_TIME, 'Spanish');
        Carbon::setUtf8(true);
        $now = Carbon::now();
    	$mes = $now->month;
        $mes2 = "";
        switch($now->month){
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

        $dia = $now->format('l');
        $dia2 = "";
        switch($dia){
            case 'Monday':
                $dia2 = "Lunes";
                break;
            case 'Tuesday':
                $dia2 = "Martes";
                break;
            case 'Wednesday':
                $dia2 = "Miércoles";
                break;
            case 'Thursday':
                $dia2 = "Jueves";
                break;
            case 'Friday':
                $dia2 = "Viernes";
                break;
            case 'Saturday':
                $dia2 = "Sábado";
                break;
            case 'Sunday':
                $dia2 = "Domingo";
                break;
        }
        return  $mes2.' '.$now->day.' del '.$now->year;
    }
    public static function fechaActualMY(){
        setlocale(LC_TIME, 'Spanish');
        Carbon::setUtf8(true);
        $now = Carbon::now();
    	$mes = $now->month;
        $mes2 = "";
        switch($now->month){
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
        return  $mes2.' del '.$now->year;
    }

    public static function fechaMatricula($created_at){
        $mes = $created_at->month;
            $mes2 = "";
            switch($created_at->month){
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
            $dia = $created_at->format('l');
            $dia2 = "";
            switch($dia){
                case 'Monday':
                $dia2 = "Lunes";
                break;
                case 'Tuesday':
                $dia2 = "Martes";
                break;
                case 'Wednesday':
                $dia2 = "Miércoles";
                break;
                case 'Thursday':
                $dia2 = "Jueves";
                break;
                case 'Friday':
                $dia2 = "Viernes";
                break;
                case 'Saturday':
                $dia2 = "Sábado";
                break;
                case 'Sunday':
                $dia2 = "Domingo";
                break;

            }
        return  $created_at->day.' de '.$mes2.' del '.$created_at->year;
    }

	public static function obtenerMes($mes) {
		switch ($mes) {
			case 1:
				$fecha_mes = 'Enero';
				break;
			case 2:
				$fecha_mes = 'Febrero';
				break;
			case 3:
				$fecha_mes = 'Marzo';
				break;
			case 4:
				$fecha_mes = 'Abril';
				break;
			case 5:
				$fecha_mes = 'Mayo';
				break;
			case 6:
				$fecha_mes = 'Junio';
				break;
			case 7:
				$fecha_mes = 'Julio';
				break;
			case 8:
				$fecha_mes = 'Agosto';
				break;
			case 9:
				$fecha_mes = 'Septiembre';
				break;
			case 10:
				$fecha_mes = 'Octubre';
				break;
			case 11:
				$fecha_mes = 'Noviembre';
				break;
			case 12:
				$fecha_mes = 'Diciembre';
				break;
			default:
				break;
		}
		return $fecha_mes;
    }

	public static function fechaParciales($fechaMes) {
		$fechaDia = substr($fechaMes,8,2);
		$fechaMes2 = '';
		$fechaMes = substr($fechaMes,5,2);
		switch ($fechaMes) {
			case '01':
				$fechaMes2 = 'Enero';
				break;
			case '02':
				$fechaMes2 = 'Febrero';
				break;
			case '03':
				$fechaMes2 = 'Marzo';
				break;
			case '04':
				$fechaMes2 = 'Abril';
				break;
			case '05':
				$fechaMes2 = 'Mayo';
				break;
			case '06':
				$fechaMes2 = 'Junio';
				break;
			case '07':
				$fechaMes2 = 'Julio';
				break;
			case '08':
				$fechaMes2 = 'Agosto';
				break;
			case '09':
				$fechaMes2 = 'Septiembre';
				break;
			case '10':
				$fechaMes2 = 'Octubre';
				break;
			case '11':
				$fechaMes2 = 'Noviembre';
				break;
			case '12':
				$fechaMes2 = 'Diciembre';
				break;
		}

		return "$fechaDia de $fechaMes2";
		// return $fecha;
    }

    public static function getMes($numMes)
    {
        $mes = '';
        switch($numMes){
            case 1:
                $mes = "Enero";
                break;
            case 2:
                $mes = "Febrero";
                break;
            case 3:
                $mes = "Marzo";
                break;
            case 4:
                $mes = "Abril";
                break;
            case 5:
                $mes = "Mayo";
                break;
            case 6:
                $mes = "Junio";
                break;
            case 7:
                $mes = "Julio";
                break;
            case 8:
                $mes = "Agosto";
                break;
            case 9:
                $mes = "Septiembre";
                break;
            case 10:
                $mes = "Octubre";
                break;
            case 11:
                $mes = "Noviembre";
                break;
            case 12:
                $mes = "Diciembre";
                break;
        }
        return $mes;
    }
}
