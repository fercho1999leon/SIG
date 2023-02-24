<?php 

namespace App\Traits;

use App\Administrative;
use App\Notificaciones;
use App\Student2;
use Carbon\Carbon;
use Sentinel;

trait mensajeNotificaciones {
	
	public function mensajeCrearTarea($students, $newactivity) {
	foreach ($students as $student) {
	 if ($student->student->profile->userid!=null) {
			$mensaje = "<p>Se creó la actividad <strong>{$newactivity->nombre}</strong> de <strong>{$newactivity->insumo->nombre}</strong> en <strong>{$newactivity->insumo->materia->nombre}</strong></p>";
			
			Notificaciones::create([
				'idUser' => $student->student->profile->userid,
				'seccion' => 'Calificaciones',
				'idPeriodo' => $this->idPeriodoUser(),
				'ruta' => "tareasE/$student->idStudent/$newactivity->parcial",
				'mensaje' => $mensaje
			]);
			if ($student->student->representante != null) {
				$hijos = Student2::where('idRepresentante',$student->student->representante->id)->get();
				$cantidadHijos = count($hijos);
				if ($cantidadHijos > 1) {
					$mensaje = "<p>Se creó la actividad <strong>{$newactivity->nombre}</strong> de <strong>{$newactivity->insumo->nombre}</strong> en <strong>{$newactivity->insumo->materia->nombre}</strong> a <strong>{$student->apellidos} {$student->nombres}</strong></p>";
				}
				Notificaciones::create([
					'idUser' => $student->student->representante->userid,
					'seccion' => 'Calificaciones',
					'idPeriodo' => $this->idPeriodoUser(),
					'ruta' => "Representante/Tareas/hijo/$student->idStudent/$newactivity->parcial",
					'mensaje' => $mensaje
				]);
			}

			}
		}
	}

	public function mensajeActualizarTarea($students, $activity) {
		foreach ($students as $student) {
			if ($student->student->profile->userid!=null) {
			$mensaje = "<p>Se actualizó la actividad <strong>{$activity->nombre}</strong> de <strong>{$activity->insumo->nombre}</strong> en <strong>{$activity->insumo->materia->nombre}</strong></p>";
			Notificaciones::create([
				'idUser' => $student->student->profile->userid,
				'seccion' => 'Calificaciones',
				'idPeriodo' => $this->idPeriodoUser(),
				'ruta' => "tareasE/$student->idStudent/$activity->parcial",
				'mensaje' => $mensaje
			]);
			if($student->idRepresentante!=null){//verifico si el estudiante tiene un representante asignado
			if ($student->student->representante->userid != null ) {
				
				$hijos = Student2::where('idRepresentante',$student->student->representante->id)->get();
				$cantidadHijos = count($hijos);

				if ($cantidadHijos > 1) {
					$mensaje = "<p>Se actualizó la actividad <strong>{$activity->nombre}</strong> de <strong>{$activity->insumo->nombre}</strong> en <strong>{$activity->insumo->materia->nombre}</strong> a <strong>{$student->apellidos} {$student->nombres}</strong></p>";
				}
				Notificaciones::create([
					'idUser' => $student->student->representante->userid,
					'seccion' => 'Calificaciones',
					'idPeriodo' => $this->idPeriodoUser(),
					'ruta' => "Representante/Tareas/hijo/$student->idStudent/$activity->parcial",
					'mensaje' => $mensaje
				]);
			}
		}
		}
		}
	}
public function mensajeCrearActividadAgenda($actividad) {
		$students = Student2::where('idCurso', $actividad->idCurso)->get();
		foreach ($students as $student) {
			$mensaje = "<p>Se creó <strong>{$actividad->nombre}</strong> de <strong>{$actividad->materia->nombre}</strong></p>";
			Notificaciones::create([
				'idUser' => $student->profile->userid,
				'seccion' => 'Agenda Escolar',
				'idPeriodo' => $this->idPeriodoUser(),
				'ruta' => "Agenda Escolar?fecha=".substr($actividad->created_at,0,10)."&actividad=".$actividad->id,
				'mensaje' => $mensaje
			]);
			if ($student->representante != null) {
				$hijos = Student2::where('idRepresentante',$student->representante->id)->get();
				$cantidadHijos = count($hijos);
				if ($cantidadHijos > 1) {
					$mensaje = "<p>Se creó <strong>{$actividad->nombre}</strong> de <strong>{$actividad->materia->nombre}</strong> a <strong>{$student->apellidos} {$student->nombres}</strong></p>";
				}
				Notificaciones::create([
					'idUser' => $student->representante->userid,
					'seccion' => 'Agenda Escolar',
					'idPeriodo' => $this->idPeriodoUser(),
					'ruta' => "Representante/Agenda%20Escolar/hijo/$student->id?fecha=".substr($actividad->created_at,0,10)."&actividad=".$actividad->id,
					'mensaje' => $mensaje
				]);
			}
		}
	}

	public function mensajeActualizarActividadAgenda($actividad) {
		$students = Student2::where('idCurso', $actividad->idCurso)->get();
		foreach ($students as $student) {
			$mensaje = "<p>Se actualizó <strong>{$actividad->nombre}</strong> de <strong>{$actividad->materia->nombre}</strong></p>";
			Notificaciones::create([
				'idUser' => $student->profile->userid,
				'seccion' => 'Agenda Escolar',
				'idPeriodo' => $this->idPeriodoUser(),
				'ruta' => "Agenda Escolar?fecha=".substr($actividad->created_at,0,10)."&actividad=".$actividad->id,
				'mensaje' => $mensaje
			]);
			if ($student->representante != null) {
				$hijos = Student2::where('idRepresentante',$student->representante->id)->get();
				$cantidadHijos = count($hijos);
				if ($cantidadHijos > 1) {
					$mensaje = "<p>Se actualizó <strong>{$actividad->nombre}</strong> de <strong>{$actividad->materia->nombre}</strong> a <strong>{$student->apellidos} {$student->nombres}</strong></p>";
				}
				Notificaciones::create([
					'idUser' => $student->representante->userid,
					'seccion' => 'Agenda Escolar',
					'idPeriodo' => $this->idPeriodoUser(),
					'ruta' => "Representante/Agenda%20Escolar/hijo/$student->id?fecha=".substr($actividad->created_at,0,10)."&actividad=".$actividad->id,
					'mensaje' => $mensaje
				]);
			}
		}
	}

	public function mensajeNotaRojo($calificacion) {
		$student = Student2::find($calificacion->idEstudiante);
		$parcial = Notificaciones::obtenerParcialActual($calificacion->actividad->parcial);

		Notificaciones::create([
			'seccion' => 'Calificaciones',
			'idUser' => $student->profile->userid,
			'ruta' => "Calificaciones Estudiante/".$calificacion->actividad->parcial,
			'mensaje' => "<p>Obtuvo <strong class='valorError'>{$calificacion->nota}</strong> en <strong>{$calificacion->supply->materia->nombre} - {$calificacion->supply->nombre} - {$calificacion->actividad->nombre}</strong> del <strong>{$parcial}</strong></p>"
		]);
		if ($student->representante != null) {
			$hijos = Student2::where('idRepresentante',$student->representante->id)->get();
			$cantidadHijos = count($hijos);
			$mensaje = "<p>El estudiante obtuvo <strong class='valorError'>{$calificacion->nota}</strong> en <strong>{$calificacion->supply->materia->nombre} - {$calificacion->supply->nombre} - {$calificacion->actividad->nombre}</strong> del <strong>{$parcial}</strong></p>";
			if ($cantidadHijos > 1) {
				$mensaje = "<p>El estudiante <strong>{$student->apellidos} {$student->nombres}</strong> <strong class='valorError'>{$calificacion->nota}</strong> en <strong>{$calificacion->supply->materia->nombre} - {$calificacion->supply->nombre} - {$calificacion->actividad->nombre}</strong> del <strong>{$parcial}</strong></p>";
			}
			Notificaciones::create([
				'seccion' => 'Calificaciones',
				'idUser' => $student->representante->userid,
				'ruta' => "Representante/Calificaciones/hijo/$student->id/".$calificacion->actividad->parcial,
				'mensaje' => $mensaje
			]);
		}
	}

	public function mensajeComportamiento($parcial, $student, $comportamiento) {
		$parcial = Notificaciones::obtenerParcialActual($parcial);
		$mensaje = "<p>Obtuvo <strong>{$comportamiento->nota}</strong> de comportamiento en el <strong>{$parcial}</strong></p>";
		Notificaciones::create([
			'seccion' => 'Comportamiento',
			'idUser' => $student->profile->userid,
			'idPeriodo' => $this->idPeriodoUser(),
			'ruta' => "Calificaciones Estudiante/$comportamiento->parcial",
			'mensaje' => $mensaje
		]);
		if ($student->representante != null) {
			$hijos = Student2::where('idRepresentante',$student->representante->id)->get();
			$cantidadHijos = count($hijos);
			$mensaje = "<p>El estudiante obtuvo <strong>{$comportamiento->nota}</strong> de comportamiento en el <strong>{$parcial}</strong></p>";
			if ($cantidadHijos > 1) {
				$mensaje = "<p>El estudiante <strong>{$student->apellidos} {$student->nombres}</strong> obtuvo <strong>{$comportamiento->nota}</strong> de comportamiento en el <strong>{$parcial}</strong></p>";
			}
			Notificaciones::create([
				'seccion' => 'Comportamiento',
				'idUser' => $student->representante->userid,
				'idPeriodo' => $this->idPeriodoUser(),
				'ruta' => "Representante/Calificaciones/hijo/$student->id/$comportamiento->parcial",
				'mensaje' => $mensaje
			]);
		}
	}

	public function mensajeAgendaObservacion($idStudent, $observacion) {
		$student = Student2::find($idStudent);
		$fecha = substr($observacion->created_at,0,4).'/'.substr($observacion->created_at,5,2).'/'.substr($observacion->created_at,8,2);
		Notificaciones::create([
			'seccion' => 'Agenda Escolar',
			'idUser' => $student->profile->userid,
			'idPeriodo' => $this->idPeriodoUser(),
			'ruta' => "Agenda Escolar?fecha=".substr($observacion->activity->created_at,0,10)."&actividad=".$observacion->activity->id,
			'mensaje' => "<p>Se creó la observación en <strong>{$observacion->activity->materia->nombre}</strong> del día <strong>{$fecha}</strong></p>"
		]);
		if ($student->representante != null) {
			$hijos = Student2::where('idRepresentante',$student->representante->id)->get();
			$cantidadHijos = count($hijos);
			$mensaje = "<p>Al estudiante se creó la observación en <strong>{$observacion->activity->materia->nombre}</strong> del día <strong>{$fecha}</strong></p>";
			if ($cantidadHijos > 1) {
				$mensaje = "<p>Al estudiante <strong>{$student->apellidos} {$student->nombres}</strong> se creó una observación en <strong>{$observacion->activity->materia->nombre}</strong> del día <strong>{$fecha}</strong></p>";
			}
			Notificaciones::create([
				'seccion' => 'Agenda Escolar',
				'idUser' => $student->representante->userid,
				'idPeriodo' => $this->idPeriodoUser(),
				'ruta' => "Representante/Agenda%20Escolar/hijo/$student->id?fecha=".substr($observacion->activity->created_at,0,10)."&actividad=".$observacion->activity->id,
				'mensaje' => $mensaje
			]);
		}
	}

	public function mensajeActualizacionAgendaObservacion($idStudent, $observacion) {
		$student = Student2::find($idStudent);
		$fecha = substr($observacion->created_at,0,4).'/'.substr($observacion->created_at,5,2).'/'.substr($observacion->created_at,8,2);
		$mensaje = "<p>Se actualizó la observación de <strong>{$observacion->activity->materia->nombre}</strong> del día <strong>{$fecha}</strong></p>";
		Notificaciones::create([
			'seccion' => 'Agenda Escolar',
			'idUser' => $student->profile->userid,
			'idPeriodo' => $this->idPeriodoUser(),
			'ruta' => "Agenda Escolar?fecha=".substr($observacion->activity->created_at,0,10)."&actividad=".$observacion->activity->id,
			'mensaje' => $mensaje
		]);
		if ($student->representante != null) {
			$hijos = Student2::where('idRepresentante',$student->representante->id)->get();
			$cantidadHijos = count($hijos);
			if ($cantidadHijos > 1) {
				$mensaje = "<p>Al estudiante <strong>{$student->apellidos} {$student->nombres}</strong> se actualizó la observación de <strong>{$observacion->activity->materia->nombre}</strong> del día <strong>{$fecha}</strong></p>";
			}
			Notificaciones::create([
				'seccion' => 'Agenda Escolar',
				'idUser' => $student->representante->userid,
				'idPeriodo' => $this->idPeriodoUser(),
				'ruta' => "Representante/Agenda%20Escolar/hijo/$student->id?fecha=".substr($observacion->activity->created_at,0,10)."&actividad=".$observacion->activity->id,
				'mensaje' => $mensaje
			]);
		}
	}

	public function idPeriodoUser() {
		return Sentinel::getUser()->idPeriodoLectivo;
	}
}
