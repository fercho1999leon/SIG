<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use App\Rubro;
use Sentinel;
class PagoEstudianteDetalle extends Model
{
    protected $table ="pago_estudiante_detalles";

    public function pago()
    {
        return $this->belongsTo('App\Payment', 'idPago');
    }
    public function facturaDetalle()
    {
        return $this->hasMany('App\FacturaDetalle', 'idPagoDetalle');
    }
    public function abonos()
    {
		return $this->hasMany('App\Abono', 'idPagoDetalle')
		->where('estatus', null);
    }
    public function student()
    {
        return $this->belongsTo('App\Student2', 'idEstudiante');
	}
	
	public static function descuento($pagoEstudiante) {
		$total =  $pagoEstudiante->pago->valor_cancelar;
		$descuentoTotal = 0;
		$rubro = Rubro::find($pagoEstudiante->pago->idRubro);
		if( strtoupper($rubro->tipo_rubro) == 'PENSION') {
			if(count($pagoEstudiante->student->becasDescuentos) != 0) {
				$becaTotal = 0;
				foreach($pagoEstudiante->student->becasDescuentos as $beca){
					$bd = BecaDescuento::find($beca->idBeca);
					if($bd->tipo == 'BECA'){
						if($bd->tipo_pago == "USD"){
							$becaTotal = $bd->valor;
						}else if($bd->tipo_pago == "PORCENTAJE"){
							$becaTotal = $total*($bd->valor/100);
						} 
					}
				}
				
				$descuentoTotal = $total - $becaTotal;
				$descuento = 0;
				foreach($pagoEstudiante->student->becasDescuentos as $beca){
					$bd = BecaDescuento::find($beca->idBeca);
					if($bd->tipo == 'DESCUENTO'){
						if($bd->tipo_pago == "USD"){
							$descuento = $bd->valor;
						}else if($bd->tipo_pago == "PORCENTAJE"){
							$descuento = $descuentoTotal*($bd->valor/100);
						} 
					}
				}
				$descuentoTotal = $descuentoTotal - $descuento;
				$total = $descuentoTotal;
				return $total;
			}
			return $total;
		}
		return $total;
	}

	public static function pagosPendientes($student) {
		$pagosPendientes = PagoEstudianteDetalle::getDetailPaymentsByStudent($student->idStudent, $student->idCurso)->where('estado', 'PENDIENTE');
	
		$dia_pago = (int)ConfiguracionSistema::diaDePago()->valor;
		if( count($pagosPendientes) > 0) {
            foreach($pagosPendientes as $key => $pago){
				$pago_mes = $pago->pago()->first();
				if($pago->prorroga == null){
                    $fecha_pago = Carbon::createFromDate($pago_mes->anio, $pago_mes->mes+1, $dia_pago);
				}else{
                    $fecha_pago = Carbon::createFromDate($pago_mes->anio, $pago_mes->mes+1, $dia_pago+$pago->prorroga);
					$now = Carbon::now();
					if($fecha_pago >= $now){
						$pagosPendientes->forget($key);
					}
				}
            }
		}
		
		return $pagosPendientes;
	}

    public static function getDetailPaymentsByStudent($idEstudiante, $idCurso) {
        return PagoEstudianteDetalle::with(['facturaDetalle', 'pago' => function ($q) use ($idCurso) {
			$q->where('idCurso', $idCurso)->orderBy('mes');
		}, 'abonos'])
		->where('idEstudiante', $idEstudiante)
		->where('idPeriodo', Sentinel::getUser()->idPeriodoLectivo)
		->get();
    }
}
