<?php 

namespace App\Traits;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

trait tablasIdPeriodo {
	// CON ID PERIODO
	public function tablasConIdPeriodo() {
		return [
			'additional_books', 'comportamiento', 'comportamientoMateria', 'courses', 'courseschedules', 'cronograma', 'leccionario_estudiantil',
			'matters', 'modulo_pagos', 'quiz_schedule', 'teacherschedules'
		];
	}

	// SIN ID PERIODO
	public function tablasSinIdPeriodo() {
		return [
			'abonos', 'activities', 'adjuntos_menssages', 'archivos_institucionales', 'areas', 'asistencia', 'becas_descuentos',
			'becas_detalle', 'calificacionesactividad', 'clasesdestrezas', 'classdays', 'clientes', 'configuracionesparcial',
			'configuracionessistema', 'datospadres', 'deberes', 'course_assistances', 'destrezas', 'factura_detalles', 'lectionaries',
			'messages', 'messages_detail', 'notificaciones', 'observaciones_aulicas', 'pagos_factura', 'pago_estudiante_detalles',
			'promedios', 'supplies', 'tipos_pago', 'transportes',
		];
	}

}
