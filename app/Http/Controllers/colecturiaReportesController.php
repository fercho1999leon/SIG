<?php

namespace App\Http\Controllers;

use PDF;
use Illuminate\Http\Request;
use App\Institution;
use Carbon\Carbon;
use App\PeriodoLectivo;
use DB;

class colecturiaReportesController extends Controller
{
    public function reportePagoPorCurso(){
		$institution = Institution::first();
		$pdf = PDF::loadView('pdf.colecturia.pagos-por-curso', compact(
			'institution'
		));

		return $pdf->inline('Pagos por curso.pdf');
	}
	
	public function estudiantesProrroga(){
		$institution = Institution::first();
		$pdf = PDF::loadView('pdf.colecturia.estudiantes-pendientes-prorroga-por-curso', compact(
			'institution'
		));

		return $pdf->inline('Estudiantes pendientes prorroga.pdf');
	}

    public function estudiantesPagadosPorCurso(){
		$institution = Institution::first();
		$pdf = PDF::loadView('pdf.colecturia.estudiantes-pagados-por-curso', compact(
			'institution'
		));

		return $pdf->inline('Estudiantes pendientes prorroga.pdf');
	}

	public function reporteDeudoresPorCurso(Request $request) {
		$fDesde = (int)date("m", strtotime($request->desde));
		$fHasta = (int)date("m", strtotime($request->hasta));
		$AnioDesde = (int)date("Y", strtotime($request->desde));
		$AnioHasta = (int)date("Y", strtotime($request->hasta));
		if ($AnioDesde == $AnioHasta) {            
            $facturas = DB::table('pago_estudiante_detalles')
            ->join('modulo_pagos', 'pago_estudiante_detalles.idPago', '=', 'modulo_pagos.id')
            ->join('rubros', 'modulo_pagos.idRubro', '=', 'rubros.id')
            ->join('students2', 'pago_estudiante_detalles.idEstudiante', '=', 'students2.id')
            ->join('students2_profile_per_year', 'students2_profile_per_year.idStudent', '=', 'students2.id')
            ->join('courses', 'students2_profile_per_year.idCurso', '=', 'courses.id')
            ->select('students2.nombres','students2.id AS idEstudiante', 'students2.apellidos', 'pago_estudiante_detalles.estado',
                'pago_estudiante_detalles.id AS idPagoDetalle', 'modulo_pagos.mes', 'pago_estudiante_detalles.updated_at',
                'courses.paralelo', 'courses.grado', 'courses.especializacion', 'modulo_pagos.tipo', 'modulo_pagos.tipo_emision',
                'modulo_pagos.valor_cancelar', 'rubros.tipo_rubro')
            ->where([
                ['pago_estudiante_detalles.estado', '!=', 'PAGADO'],
                ['modulo_pagos.idPeriodo', '=', $this->idPeriodoUser()],
                ['students2_profile_per_year.idPeriodo', '=', $this->idPeriodoUser()],
                ['modulo_pagos.mes', '<=', $fHasta],
                ['modulo_pagos.mes', '>=', $fDesde],
                ['modulo_pagos.anio', '<=', $AnioHasta],
                ['students2_profile_per_year.tipo_matricula', '<>', 'Pre Matricula'],
                ['students2_profile_per_year.retirado', '<>', 'SI']
            ])
            ->get();
        }elseif ($AnioDesde < $AnioHasta) {
            $fDesde_desde = 1;
            $fHasta_hasta = 12;
            $facturas_desde = DB::table('pago_estudiante_detalles')
                ->join('modulo_pagos', 'pago_estudiante_detalles.idPago', '=', 'modulo_pagos.id')
                ->join('rubros', 'modulo_pagos.idRubro', '=', 'rubros.id')
                ->join('students2', 'pago_estudiante_detalles.idEstudiante', '=', 'students2.id')
                ->join('students2_profile_per_year', 'students2_profile_per_year.idStudent', '=', 'students2.id')
                ->join('courses', 'students2_profile_per_year.idCurso', '=', 'courses.id')
                ->select('students2.nombres','students2.id AS idEstudiante', 'students2.apellidos', 'pago_estudiante_detalles.estado',
                    'pago_estudiante_detalles.id AS idPagoDetalle', 'modulo_pagos.mes', 'pago_estudiante_detalles.updated_at',
                    'courses.paralelo', 'courses.grado', 'courses.especializacion', 'modulo_pagos.tipo', 'modulo_pagos.tipo_emision',
                    'modulo_pagos.valor_cancelar', 'rubros.tipo_rubro')
                ->where([
                    ['pago_estudiante_detalles.estado', '!=', 'PAGADO'],
                    ['modulo_pagos.idPeriodo', '=', $this->idPeriodoUser()],
                    ['students2_profile_per_year.idPeriodo', '=', $this->idPeriodoUser()],
                    ['modulo_pagos.mes', '<=', $fHasta_hasta],
                    ['modulo_pagos.mes', '>=', $fDesde],
                    ['modulo_pagos.anio', '<=', $AnioDesde],
                    ['students2_profile_per_year.tipo_matricula', '<>', 'Pre Matricula'],
                    ['students2_profile_per_year.retirado', '<>', 'SI']
                ])
                ->get();
            $facturas_hasta = DB::table('pago_estudiante_detalles')
                ->join('modulo_pagos', 'pago_estudiante_detalles.idPago', '=', 'modulo_pagos.id')
                ->join('rubros', 'modulo_pagos.idRubro', '=', 'rubros.id')
                ->join('students2', 'pago_estudiante_detalles.idEstudiante', '=', 'students2.id')
                ->join('students2_profile_per_year', 'students2_profile_per_year.idStudent', '=', 'students2.id')
                ->join('courses', 'students2_profile_per_year.idCurso', '=', 'courses.id')
                ->select('students2.nombres','students2.id AS idEstudiante', 'students2.apellidos', 'pago_estudiante_detalles.estado',
                    'pago_estudiante_detalles.id AS idPagoDetalle', 'modulo_pagos.mes', 'pago_estudiante_detalles.updated_at',
                    'courses.paralelo', 'courses.grado', 'courses.especializacion', 'modulo_pagos.tipo', 'modulo_pagos.tipo_emision',
                    'modulo_pagos.valor_cancelar', 'rubros.tipo_rubro')
                ->where([
                    ['pago_estudiante_detalles.estado', '!=', 'PAGADO'],
                    ['modulo_pagos.idPeriodo', '=', $this->idPeriodoUser()],
                    ['students2_profile_per_year.idPeriodo', '=', $this->idPeriodoUser()],
                    ['modulo_pagos.mes', '<=', $fHasta],
                    ['modulo_pagos.mes', '>=', $fDesde_desde],
                    ['modulo_pagos.anio', '<=', $AnioHasta],
                    ['students2_profile_per_year.tipo_matricula', '<>', 'Pre Matricula'],
                    ['students2_profile_per_year.retirado', '<>', 'SI']
                ])
                ->get();
            $facturas = $facturas_desde->merge($facturas_hasta);
        }

		$becas =  DB::table('becas_descuentos')
			->join('becas_detalle', 'becas_descuentos.id', '=', 'becas_detalle.idBeca')
			->select('becas_detalle.idEstudiante', 'becas_descuentos.valor AS valor_beca', 'becas_descuentos.tipo AS tipo_beca', 
				'becas_descuentos.tipo_pago AS tipo_pago_beca')
			->get();
		$detallesId = $facturas->pluck('idPagoDetalle');

        // Se coloca en otro if y no en el mismo por la variable $detallesId
        if ($AnioDesde == $AnioHasta) {
		    $abonos = DB::table('abonos')
                ->join('pago_estudiante_detalles', 'pago_estudiante_detalles.id', '=', 'abonos.idPagoDetalle')
                ->join('modulo_pagos', 'pago_estudiante_detalles.idPago', '=', 'modulo_pagos.id')
                ->join('factura_detalles', 'abonos.idPagoDetalle', '=', 'factura_detalles.idPagoDetalle')
                ->join('pagos_factura', 'pagos_factura.id', '=', 'factura_detalles.idFactura')
                ->select('pago_estudiante_detalles.estado', 'pago_estudiante_detalles.id AS idPagoDetalle',
                    'pago_estudiante_detalles.updated_at', 'pagos_factura.total AS subtotal', 'modulo_pagos.valor_cancelar', 
                    'modulo_pagos.mes', 'modulo_pagos.tipo','modulo_pagos.tipo_emision', 'modulo_pagos.mes', 'abonos.cantidad', 
                    'abonos.id', 'pagos_factura.numeroFactura', 'pagos_factura.id AS idFactura', 
                    'pagos_factura.tipo_pago', 'pagos_factura.estatus AS estado_factura')
                ->where([
                    ['modulo_pagos.mes', '>=', $fDesde],
                    ['modulo_pagos.mes', '<=', $fHasta],
                    ['modulo_pagos.anio', '>=', $AnioDesde],
                    ['modulo_pagos.anio', '<=', $AnioHasta]
                ])
                ->whereIn('pago_estudiante_detalles.id', $detallesId)
                ->get();
        }elseif ($AnioDesde < $AnioHasta) {
            $fDesde_desde = 1;
            $fHasta_hasta = 12;
            $abonos_desde = DB::table('abonos')
                ->join('pago_estudiante_detalles', 'pago_estudiante_detalles.id', '=', 'abonos.idPagoDetalle')
                ->join('modulo_pagos', 'pago_estudiante_detalles.idPago', '=', 'modulo_pagos.id')
                ->join('factura_detalles', 'abonos.idPagoDetalle', '=', 'factura_detalles.idPagoDetalle')
                ->join('pagos_factura', 'pagos_factura.id', '=', 'factura_detalles.idFactura')
                ->select('pago_estudiante_detalles.estado', 'pago_estudiante_detalles.id AS idPagoDetalle',
                    'pago_estudiante_detalles.updated_at', 'pagos_factura.total AS subtotal', 'modulo_pagos.valor_cancelar', 
                    'modulo_pagos.mes', 'modulo_pagos.tipo','modulo_pagos.tipo_emision', 'modulo_pagos.mes', 'abonos.cantidad', 
                    'abonos.id', 'pagos_factura.numeroFactura', 'pagos_factura.id AS idFactura', 
                    'pagos_factura.tipo_pago', 'pagos_factura.estatus AS estado_factura')
                ->where([
                    ['modulo_pagos.mes', '<=', $fHasta_hasta],
                    ['modulo_pagos.mes', '>=', $fDesde],
                    ['modulo_pagos.anio', '<=', $AnioDesde]
                ])
                ->whereIn('pago_estudiante_detalles.id', $detallesId)
                ->get();
                $abonos_hasta = DB::table('abonos')
                ->join('pago_estudiante_detalles', 'pago_estudiante_detalles.id', '=', 'abonos.idPagoDetalle')
                ->join('modulo_pagos', 'pago_estudiante_detalles.idPago', '=', 'modulo_pagos.id')
                ->join('factura_detalles', 'abonos.idPagoDetalle', '=', 'factura_detalles.idPagoDetalle')
                ->join('pagos_factura', 'pagos_factura.id', '=', 'factura_detalles.idFactura')
                ->select('pago_estudiante_detalles.estado', 'pago_estudiante_detalles.id AS idPagoDetalle',
                    'pago_estudiante_detalles.updated_at', 'pagos_factura.total AS subtotal', 'modulo_pagos.valor_cancelar', 
                    'modulo_pagos.mes', 'modulo_pagos.tipo','modulo_pagos.tipo_emision', 'modulo_pagos.mes', 'abonos.cantidad', 
                    'abonos.id', 'pagos_factura.numeroFactura', 'pagos_factura.id AS idFactura', 
                    'pagos_factura.tipo_pago', 'pagos_factura.estatus AS estado_factura')
                ->where([
                    ['modulo_pagos.mes', '<=', $fHasta],
                    ['modulo_pagos.mes', '>=', $fDesde_desde],
                    ['modulo_pagos.anio', '<=', $AnioHasta]
                ])
                ->whereIn('pago_estudiante_detalles.id', $detallesId)
                ->get();
            $abonos = $abonos_desde->merge($abonos_hasta);
        }

		$institution = Institution::first();
		$periodoLectivo = PeriodoLectivo::findOrFail($this->idPeriodoUser());
		$pdf = PDF::loadView('pdf.colecturia.deudores-por-curso', compact(
			'institution', 'facturas', 'abonos', 'fDesde', 'fHasta', 'becas','periodoLectivo'
		));
		return $pdf->download('Deudores Por Curso De Pensión.pdf');
	}

	//No se está usando
	public function reporteBecas(){
		$pdf = PDF::loadView('pdf.reporte-becas')->setOrientation('landscape');
		
		return $pdf->inline();
	}

	//No se está usando
	public function reporteDeudores(){
		$pdf = PDF::loadView('pdf.reporte-deudores');

		return $pdf->inline();
	}

	//No se está usando
	public function reporteCobroDiario(){
		$pdf = PDF::loadView('pdf.reporte-cobro-diario')->setOrientation('landscape');
		
		return $pdf->inline();
	}

	//No se está usando
	public function reporteCobros() {
		$institution = Institution::first();
		$pdf = PDF::loadView('pdf.reporte-cobros', compact(
			'institution'
		));

		return $pdf->download("Reporte Cobros.pdf");
	}
	
}
