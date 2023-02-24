<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Student2;
use App\Course;
use App\BecaDescuento;
use Sentinel;

class Payment extends Model
{
    protected $table = "modulo_pagos";

    public function becas()
    {
        return $this->hasMany('App\BecaDescuento', 'idPago');
    }

    public function periodo()
    {
        return $this->belongsTo('App\PeriodoLectivo', 'idPeriodo');
    }

    public function curso()
    {
        return $this->belongsTo('App\Course', 'idCurso');
    }

    public function pagoEstudianteDetalle()
    {
        return $this->hasMany('App\PagoEstudianteDetalle', 'idPago');
    }

    public function rubro()
    {
        return $this->belongsTo('App\Rubro', 'idRubro');
    }

    public static function getPaymentsByStudent($idStudent)
    {
        $student = Student2::find($idStudent);
        return Payment::where('idCurso', $student->idCurso)
            ->where('idPeriodo', Sentinel::getUser()->idPeriodoLectivo)
            ->get();
    }

    public static function getPaymentsByCourse($idcurso)
    {
        $course = Course::find($idcurso);
        return Payment::where('idCurso', $course->id)->get();
    }

    public static function getAllPayments()
    {
        return Payment::where('idPeriodo', Sentinel::getUser()->idPeriodoLectivo)
            ->get();
    }

    public static function calcularDescuentoEstudiante($idEstudiante, $idPago)
    {
        $pago = Payment::findOrFail($idPago);
        $student = Student2::with('becasDescuentos')->find($idEstudiante);
        $total = $pago->valor_cancelar;
        $descuento = 0;
        $becaTotal = 0;
        if (count($student->becasDescuentos) != 0) {
            foreach ($student->becasDescuentos as $beca) {
                $bd = BecaDescuento::find($beca->idBeca);
                if ($bd->tipo == 'BECA') {
                    if ($bd->tipo_pago == "USD") {
                        $becaTotal = $bd->valor;
                    } else if ($bd->tipo_pago == "PORCENTAJE") {
                        $becaTotal = bcdiv(($total * bcdiv(($bd->valor / 100),'1',2)),'1',2);
                    }
                }
            }
            
            $descuentoTotal = $total - bcdiv($becaTotal, '1', 2);

            foreach ($student->becasDescuentos as $beca) {
                $bd = BecaDescuento::find($beca->idBeca);
                if ($bd->tipo == 'DESCUENTO') {
                    if ($bd->tipo_pago == "USD") {
                        $descuento = $bd->valor;
                    } else if ($bd->tipo_pago == "PORCENTAJE") {
                        $descuento = bcdiv( ($descuentoTotal * bcdiv( ($bd->valor / 100),'1',2 )),'1',2 );
                    }
                }
            }
            
            $total = $descuentoTotal - bcdiv($descuento, '1', 2);
        }
        return $total;
    }
}
