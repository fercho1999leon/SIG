<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ConfiguracionSistema;
use App\Http\Requests\ConfiguracionesSistemaRequest;
use App\Supply;
use App\Matter;
use App\Nivel;
use App\Usuario;
use App\PeriodoLectivo;
use Sentinel;
class ConfiguracionSistemaController extends Controller
{
    public function index()
    {
        $periodosLectivos = PeriodoLectivo::all();
		$activacionFacturaEletctronica = ConfiguracionSistema::facturacionElectronica();
        $confContadorFactura = ConfiguracionSistema::reiniciarContadorFactura();
        //$configuraciones = ConfiguracionSistema::all();
        $materias = Matter::all()->groupBy('nombre');
		$edita_calificaciones = ConfiguracionSistema::where('idPeriodo', $this->idPeriodoUser())
			->where('nombre','EDITA_CALIFICACIONES')->first();
		$notas_menores = ConfiguracionSistema::where('idPeriodo', $this->idPeriodoUser())
			->where('nombre','NOTAS_ROJO')->first();
		$ingresa_evaluacion = ConfiguracionSistema::where('idPeriodo', $this->idPeriodoUser())
			->where('nombre','INGRESA_EVALUACION')->first();
		$ingresa_examen = ConfiguracionSistema::where('idPeriodo', $this->idPeriodoUser())
			->where('nombre','INGRESA_EXAMEN')->first();
		$ingresa_recuperacion = ConfiguracionSistema::where('idPeriodo', $this->idPeriodoUser())
			->where('nombre','INGRESA_RECUPERACION')->first();
		$orden_insumos = ConfiguracionSistema::where('idPeriodo', $this->idPeriodoUser())
			->where('nombre','ORDEN_INSUMOS')->first();
		$modo_asistencia = ConfiguracionSistema::where('idPeriodo', $this->idPeriodoUser())
			->where('nombre','MODO_ASISTENCIA')->first();
		$mostrar_libreta = ConfiguracionSistema::where('idPeriodo', $this->idPeriodoUser())
			->where('nombre','MOSTRAR_LIBRETA_REPRESENTANTE')->first();
		$transporte = ConfiguracionSistema::where('idPeriodo', $this->idPeriodoUser())
			->where('nombre','MOSTRAR_TRANSPORTE')->first();

        if($orden_insumos->valor != ''){
            $insumos = Supply::getSuppliesOrder($orden_insumos->valor);
        }else{
            $insumos = Supply::getSuppliesNombres();
        }

		$activar_pagos = ConfiguracionSistema::where('idPeriodo', $this->idPeriodoUser())
			->where('nombre','ACTIVAR_PAGOS')->first();
		$nueva_matricula = ConfiguracionSistema::where('idPeriodo', $this->idPeriodoUser())
			->where('nombre','NUEVA_MATRICULA')->first();
		$nota_menor = ConfiguracionSistema::where('idPeriodo', $this->idPeriodoUser())
			->where('nombre','NOTA_MENOR_ROJO')->first();
		$comportamiento_menor = ConfiguracionSistema::where('idPeriodo', $this->idPeriodoUser())
			->where('nombre','COMPORTAMIENTO_ROJO')->first();
		$dia_pago = ConfiguracionSistema::where('idPeriodo', $this->idPeriodoUser())
			->where('nombre','DIA_DE_PAGO')->first();
		$contador_matricula = ConfiguracionSistema::where('idPeriodo', $this->idPeriodoUser())
			->where('nombre','CONTADOR_MATRICULA')->first();
		$mostrar_calificaciones = ConfiguracionSistema::where('idPeriodo', $this->idPeriodoUser())
			->where('nombre','MOSTRAR_CALIFICACIONES_REPRESENTANTE')->first();
		$nombre_representante_libreta_parcial = ConfiguracionSistema::where('idPeriodo', $this->idPeriodoUser())
			->where('nombre','HABILITAR_NOMBRE_REPRESENTANTE_EN_LIBRETA_PARCIAL')->first();
		$nota_minima = ConfiguracionSistema::where('idPeriodo', $this->idPeriodoUser())
			->where('nombre','NOTA_MINIMA')->first();
        $tipo_libreta = ConfiguracionSistema::formatoLibreta();
		$dhi = ConfiguracionSistema::where('idPeriodo', $this->idPeriodoUser())
			->where('nombre', 'DHI')->first();
		$progresoformativo = ConfiguracionSistema::where('idPeriodo', $this->idPeriodoUser())
			->where('nombre', 'PROGRESO_FORMATIVO')->first();
		$comportamientoQuimestral = ConfiguracionSistema::where('idPeriodo', $this->idPeriodoUser())
			->where('nombre', 'COMPORTAMIENTO_QUIMESTRAL')->first();
		$asistencia = ConfiguracionSistema::where('idPeriodo', $this->idPeriodoUser())
			->where('nombre', 'ASISTENCIA')->first();
		$eliminarMensajesEstudiantes = ConfiguracionSistema::where('idPeriodo', $this->idPeriodoUser())
			->where('nombre', 'ELIMINAR_MENSAJES_ESTUDIANTES')->first();
		$nuevoEstudianteAdmision = ConfiguracionSistema::where('idPeriodo', $this->idPeriodoUser())
			->where('nombre', 'NUEVO_ESTUDIANTE_ADMISION')->first();
		$pagoEnLinea = ConfiguracionSistema::where('idPeriodo', $this->idPeriodoUser())
			->where('nombre', 'PAGO_EN_LINEA')->first();
        $activarAdmisiones = ConfiguracionSistema::where('idPeriodo', $this->idPeriodoUser())
			->where('nombre', 'ACTIVAR_ADMISIONES')->first();
		$activarAulaVirtual = ConfiguracionSistema::where('idPeriodo', $this->idPeriodoUser())
			->where('nombre', 'AULA_VIRTUAL')->first();
		$pago_adelantado = ConfiguracionSistema::where('idPeriodo', $this->idPeriodoUser())
			->where('nombre', 'pago_adelantado')->first();
		$sendToAdmin = ConfiguracionSistema::where('idPeriodo', $this->idPeriodoUser())
			->where('nombre', 'ENVIAR_A_ADMINISTRADOR')->first();
		$PromedioInsumo = ConfiguracionSistema::where('idPeriodo', $this->idPeriodoUser())
			->where('nombre', 'PROMEDIO_POR_INSUMO')->first();
        $InsumoPorcentual = ConfiguracionSistema::where('idPeriodo', $this->idPeriodoUser())
            ->where('nombre', 'INSUMO_PORCENTUAL')->first();
		$DeleteActDocente = ConfiguracionSistema::where('idPeriodo', $this->idPeriodoUser())
			->where('nombre', 'DELETE_ACTIVIDAD_DOCENTE')->first();
        $NroEstudiantesCH = ConfiguracionSistema::where('idPeriodo', $this->idPeriodoUser())
            ->where('nombre', 'ESTUDIANTES_CUADRO_HONOR')->first();
        $CertAsistencia = ConfiguracionSistema::where('idPeriodo', $this->idPeriodoUser())
            ->where('nombre', 'CERTIFICADO_ASISTENCIA')->first();
        $PeriodoPaseAnio = ConfiguracionSistema::where('idPeriodo', $this->idPeriodoUser())
            ->where('nombre', 'PERIODO_PASE_DE_ANIO')->first();
        $selectParaleloRepre= ConfiguracionSistema::where('idPeriodo', $this->idPeriodoUser())
			->where('nombre', 'SELECCIONAR_PARALELO')->first();
		$AdmisionesBuscar = ConfiguracionSistema::where('idPeriodo', $this->idPeriodoUser())
			->where('nombre', 'BUSCAR_ESTUDIANTE_ADMISIONES')->first();
		$ActDatosRepre= ConfiguracionSistema::ActRepre();
		$ActDatosEstu= ConfiguracionSistema::ActEstu();
		$confFormatoFacturas = ConfiguracionSistema::formatoFacturas();
		$asignacionBecasAdm = ConfiguracionSistema::configuracionBecas('Administrador');
		$asignacionBecasSec = ConfiguracionSistema::configuracionBecas('Secretaria');
		$asignacionBecasCol = ConfiguracionSistema::configuracionBecas('Colecturia');
		$asignacionBecas = ConfiguracionSistema::configuracionBecas();
		$certificado_matricula = ConfiguracionSistema::certificadoMatricula();
		$editarDatosEstudiante = ConfiguracionSistema::editarDatosEstudiante();
		$PromedioComportamiento = ConfiguracionSistema::comportamientoPro();
        $certificado_promocion = ConfiguracionSistema::certPromocion();
        $FormatoPaseAnio = ConfiguracionSistema::PaseDeAnioFormato($this->idPeriodoUser());
        $contratoEconomico = ConfiguracionSistema::ContratoEconomico($this->idPeriodoUser());
        $adjuntoRepresentante = ConfiguracionSistema::adjuntoRepresentante();

		//dd($selectParaleloRepre);

        return  view('UsersViews.administrador.configuraciones.configuracionesGenerales',
        compact('edita_calificaciones', 'notas_menores', 'ingresa_evaluacion', 'ingresa_examen',
            'ingresa_recuperacion', 'activar_pagos', 'nueva_matricula', 'insumos', 'orden_insumos',
            'nota_menor', 'comportamiento_menor', 'dia_pago', 'materias', 'contador_matricula',
            'modo_asistencia', 'mostrar_calificaciones', 'mostrar_libreta', 'transporte', 'progresoformativo',
            'nombre_representante_libreta_parcial', 'tipo_libreta', 'nota_minima', 'dhi', 'comportamientoQuimestral',
            'asistencia', 'eliminarMensajesEstudiantes', 'pago_adelantado', 'confContadorFactura', 'activacionFacturaEletctronica',
            'confFormatoFacturas', 'asignacionBecasAdm', 'asignacionBecasSec', 'asignacionBecasSec', 'asignacionBecasCol',
            'asignacionBecas','nuevoEstudianteAdmision','activarAdmisiones', 'pagoEnLinea','activarAulaVirtual','certificado_matricula',
            'sendToAdmin','PromedioInsumo','DeleteActDocente','NroEstudiantesCH','CertAsistencia', 'editarDatosEstudiante',
            'InsumoPorcentual', 'PromedioComportamiento','periodosLectivos','PeriodoPaseAnio','selectParaleloRepre',
            'ActDatosRepre','ActDatosEstu', 'certificado_promocion', 'FormatoPaseAnio', 'contratoEconomico','AdmisionesBuscar', 'adjuntoRepresentante'));
    }

    public function update(ConfiguracionesSistemaRequest $request){
        if($request->editaCalificaciones != null){
			$edita_calificaciones = ConfiguracionSistema::where('idPeriodo', $this->idPeriodoUser())
				->where('nombre','EDITA_CALIFICACIONES')->first();
            $edita_calificaciones->valor = $request->editaCalificaciones;
            $edita_calificaciones->save();
        }

        if($request->contador_matricula != null){
			$contador_matricula = ConfiguracionSistema::where('idPeriodo', $this->idPeriodoUser())
				->where('nombre','CONTADOR_MATRICULA')->first();
            $contador_matricula->valor = $request->contador_matricula;
            $contador_matricula->save();
        }

        if($request->notasMenores != null){
			$notas_menores = ConfiguracionSistema::where('idPeriodo', $this->idPeriodoUser())
				->where('nombre','NOTAS_ROJO')->first();
            $notas_menores->valor = $request->notasMenores;
            $notas_menores->save();
        }

        if($request->ingresaEvaluacion != null){
			$ingresa_evaluacion = ConfiguracionSistema::where('idPeriodo', $this->idPeriodoUser())
				->where('nombre','INGRESA_EVALUACION')->first();
            $ingresa_evaluacion->valor = $request->ingresaEvaluacion;
            $ingresa_evaluacion->save();
        }

        if($request->ingresaExamen != null){
			$ingresa_examen = ConfiguracionSistema::where('idPeriodo', $this->idPeriodoUser())
				->where('nombre','INGRESA_EXAMEN')->first();
            $ingresa_examen->valor = $request->ingresaExamen;
            $ingresa_examen->save();
        }

        if($request->certificado_matricula != null){
			$ingresa_recuperacion = ConfiguracionSistema::where('idPeriodo', $this->idPeriodoUser())
				->where('nombre','INGRESA_RECUPERACION')->first();
            $ingresa_recuperacion->valor = $request->ingresaRecuperaciones;
            $ingresa_recuperacion->save();
        }

        if($request->activar_pagos != null){
			$activar_pagos = ConfiguracionSistema::where('idPeriodo', $this->idPeriodoUser())
				->where('nombre','ACTIVAR_PAGOS')->first();
            $activar_pagos->valor = $request->activar_pagos;
            $activar_pagos->save();
        }

        if($request->nueva_matricula != null){
			$nueva_matricula = ConfiguracionSistema::where('idPeriodo', $this->idPeriodoUser())
				->where('nombre','NUEVA_MATRICULA')->first();
            $nueva_matricula->valor = $request->nueva_matricula;
            $nueva_matricula->save();
        }

        if($request->orden_insumos != null){
			$orden_insumos = ConfiguracionSistema::where('idPeriodo', $this->idPeriodoUser())
				->where('nombre','ORDEN_INSUMOS')->first();
            $orden_insumos->valor = $request->orden_insumos;
            $orden_insumos->save();
        }

        if($request->nota_menor != null){
			$nota_menor = ConfiguracionSistema::where('idPeriodo', $this->idPeriodoUser())
				->where('nombre','NOTA_MENOR_ROJO')->first();
            $nota_menor->valor = $request->nota_menor;
            $nota_menor->save();
        }

        if($request->comportamiento_menor != null){
			$comportamiento_menor = ConfiguracionSistema::where('idPeriodo', $this->idPeriodoUser())
				->where('nombre','COMPORTAMIENTO_ROJO')->first();
            $comportamiento_menor->valor = $request->comportamiento_menor;
            $comportamiento_menor->save();
        }

        if($request->diaPago != null){
			$dia_pago = ConfiguracionSistema::where('idPeriodo', $this->idPeriodoUser())
				->where('nombre','DIA_DE_PAGO')->first();
            $dia_pago->valor = $request->diaPago;
            $dia_pago->save();
        }

        if($request->mostrarCalificaciones != null){
			$mostrar_calificacion = ConfiguracionSistema::where('idPeriodo', $this->idPeriodoUser())
				->where('nombre','MOSTRAR_CALIFICACIONES_REPRESENTANTE')->first();
            $mostrar_calificacion->valor = $request->mostrarCalificaciones;
            $mostrar_calificacion->save();
        }

        if($request->modo_asistencia != null){
			$modo_asistencia = ConfiguracionSistema::where('idPeriodo', $this->idPeriodoUser())
				->where('nombre','MODO_ASISTENCIA')->first();
            $modo_asistencia->valor = $request->modo_asistencia;
            $modo_asistencia->save();
        }

        if($request->mostrar_libreta != null){
			$mostrar_libreta = ConfiguracionSistema::where('idPeriodo', $this->idPeriodoUser())
				->where('nombre','MOSTRAR_LIBRETA_REPRESENTANTE')->first();
			$mostrar_libreta->valor = $request->mostrar_libreta;
			$mostrar_libreta->save();
		}

        if($request->transporte != null){
			$transporte = ConfiguracionSistema::where('idPeriodo', $this->idPeriodoUser())
				->where('nombre','MOSTRAR_TRANSPORTE')->first();
            $transporte->valor = $request->transporte;
            $transporte->save();
        }

        if($request->libretaParcial != null){
			$nombre_representante_libreta_parcial = ConfiguracionSistema::where('idPeriodo', $this->idPeriodoUser())
				->where('nombre','HABILITAR_NOMBRE_REPRESENTANTE_EN_LIBRETA_PARCIAL')->first();
            $nombre_representante_libreta_parcial->valor = $request->libretaParcial;
            $nombre_representante_libreta_parcial->save();
        }

        $matters = Matter::where('nombre', $request->area_materia)->get();
        if (strlen($request->nivel) != 0 || strlen($request->nivelID) != 0){
            if (strlen($request->nivelID) == 0){
                $nivel = new Nivel();
                $nivel->area_materia = $request->area_materia;
                $nivel->nivel = $request->nivel;

                $nivel->save();
            }else{
                $nivel = Nivel::where('area_materia', $request->area_materia)->first();
                $nivel->nivel = $request->nivel;
                $nivel->save();
            }

            foreach($matters as $matter){
                $matter->nivel = $request->nivel;

                $matter->save();
            }
        }

        if($request->tipo_libreta != null){
			$tipo_libreta = ConfiguracionSistema::where('idPeriodo', $this->idPeriodoUser())
				->where('nombre','FORMATO_LIBRETA')->first();
            $tipo_libreta->valor = $request->tipo_libreta;
            $tipo_libreta->save();
		}

        if($request->nota_minima != null){
			$nota_minima = ConfiguracionSistema::where('idPeriodo', $this->idPeriodoUser())
				->where('nombre','NOTA_MINIMA')->first();
            $nota_minima->valor = $request->nota_minima;
            $nota_minima->save();
		}

		// if($request->dhi != null) {
			$dhi = ConfiguracionSistema::where('idPeriodo', $this->idPeriodoUser())
				->where('nombre','DHI')->first();
			$dhi->valor = $request->dhi;
			$dhi->save();
		// }

		$comportamientoQuimestral = ConfiguracionSistema::where('idPeriodo', $this->idPeriodoUser())
			->where('nombre','COMPORTAMIENTO_QUIMESTRAL')->first();
		$comportamientoQuimestral->valor = $request->comportamientoQuimestral;
		$comportamientoQuimestral->save();

		if ($request->progresoformativo != null) {
			$progresoformativo = ConfiguracionSistema::where('idPeriodo', $this->idPeriodoUser())
				->where('nombre', 'PROGRESO_FORMATIVO')->first();
			$progresoformativo->valor = $request->progresoformativo;
			$progresoformativo->save();
		}

		if ($request->asistencia != null) {
			$asistencia = ConfiguracionSistema::where('idPeriodo', $this->idPeriodoUser())
				->where('nombre', 'ASISTENCIA')->first();
			$asistencia->valor = $request->asistencia;
			$asistencia->save();
		}

		if ($request->eliminarMensajesEstudiantes != null) {
			$eliminarEstMen = ConfiguracionSistema::where('idPeriodo', $this->idPeriodoUser())
				->where('nombre', 'ELIMINAR_MENSAJES_ESTUDIANTES')->first();
			$eliminarEstMen->valor = $request->eliminarMensajesEstudiantes;
			$eliminarEstMen->save();
		}

		if($request->pago_adelantado != null) {
			$pago_adelantado = ConfiguracionSistema::where('idPeriodo', $this->idPeriodoUser())
				->where('nombre', 'pago_adelantado')->first();
			$pago_adelantado->valor = $request->pago_adelantado;
			$pago_adelantado->save();
		}

		if($request->activacionFacturaElectronica != null) {
			$activacionFacturaElectronica = ConfiguracionSistema::facturacionElectronica();
			$activacionFacturaElectronica->valor = $request->activacionFacturaElectronica;
			$activacionFacturaElectronica->save();
		}

		if($request->factura_formatos != null) {
			$factura_formatos = ConfiguracionSistema::formatoFacturas();
			$factura_formatos->valor = $request->factura_formatos;
			$factura_formatos->save();
		}

		// asignación becas admin
		if($request->asignacionBecasAdm != null) {
			$asignacionBecasAdm = ConfiguracionSistema::configuracionBecas('Administrador');
			$asignacionBecasAdm->valor = $request->asignacionBecasAdm;
			$asignacionBecasAdm->save();
		}

		// asignación becas Colecturía
		if($request->asignacionBecasCol != null) {
			$asignacionBecasCol = ConfiguracionSistema::configuracionBecas('Colecturia');
			$asignacionBecasCol->valor = $request->asignacionBecasCol;
			$asignacionBecasCol->save();
		}

		// asignación becas Secretaría
		if($request->asignacionBecasSec != null) {
			$asignacionBecasSec = ConfiguracionSistema::configuracionBecas('Secretaria');
			$asignacionBecasSec->valor = $request->asignacionBecasSec;
			$asignacionBecasSec->save();
		}
		if ($request->nuevoEstudianteAdmision != null) {
			$NuevoAdmision = ConfiguracionSistema::where('idPeriodo', $this->idPeriodoUser())
				->where('nombre', 'NUEVO_ESTUDIANTE_ADMISION')->first();
			$NuevoAdmision->valor = $request->nuevoEstudianteAdmision;
			$NuevoAdmision->save();
        }

		if ($request->pagoEnLinea != null) {
			$pagoEL = ConfiguracionSistema::where('idPeriodo', $this->idPeriodoUser())
				->where('nombre', 'PAGO_EN_LINEA')->first();
			$pagoEL->valor = $request->pagoEnLinea;
            $pagoEL->save();
        }

		if ($request->activarAdmisiones != null) {
			$ModuloAdmisiones = ConfiguracionSistema::where('idPeriodo', $this->idPeriodoUser())
				->where('nombre', 'ACTIVAR_ADMISIONES')->first();
			$ModuloAdmisiones->valor = $request->activarAdmisiones;
			$ModuloAdmisiones->save();
		}
		if ($request->activarAulaVirtual != null) {
			$ModuloAulaVirtual = ConfiguracionSistema::where('idPeriodo', $this->idPeriodoUser())
				->where('nombre', 'AULA_VIRTUAL')->first();
			$ModuloAulaVirtual->valor = $request->activarAulaVirtual;
			$ModuloAulaVirtual->save();
		}
		if($request->certificado_matricula != null){
			$CerMatricula = ConfiguracionSistema::where('idPeriodo', $this->idPeriodoUser())
				->where('nombre','MOSTRAR_CERTIFICADO_MATRICULA')->first();
            $CerMatricula->valor = $request->certificado_matricula;
            $CerMatricula->save();
        }
        if($request->sendToAdmin != null){
			$SenToAdmin = ConfiguracionSistema::where('idPeriodo', $this->idPeriodoUser())
				->where('nombre','ENVIAR_A_ADMINISTRADOR')->first();
            $SenToAdmin->valor = $request->sendToAdmin;
            $SenToAdmin->save();
		}
		if($request->editarDatosEstudiante != null){
			$editarDatosEstudiante = ConfiguracionSistema::where('idPeriodo', $this->idPeriodoUser())
				->where('nombre','EDITAR_DATOS_ESTUDIANTE')->first();
            $editarDatosEstudiante->valor = $request->editarDatosEstudiante;
            $editarDatosEstudiante->save();
		}
		if($request->PromedioComportamiento != null){
			$PromedioComportamiento = ConfiguracionSistema::where('idPeriodo', $this->idPeriodoUser())
            	->where('nombre', 'COMPORTAMIENTO_PROMEDIO')->first();
            $PromedioComportamiento->valor = $request->PromedioComportamiento;
			$PromedioComportamiento->save();
		}
        if($request->PromedioInsumo != null){
			$ProInsumo = ConfiguracionSistema::where('idPeriodo', $this->idPeriodoUser())
				->where('nombre','PROMEDIO_POR_INSUMO')->first();
            $ProInsumo->valor = $request->PromedioInsumo;
            $ProInsumo->save();
        }
        if($request->InsumoPorcentual != null){
            $InsPor = ConfiguracionSistema::where('idPeriodo', $this->idPeriodoUser())
            ->where('nombre', 'INSUMO_PORCENTUAL')->first();
            $InsPor->valor = $request->InsumoPorcentual;
            $InsPor->save();
        }
        $InsumoPorcentual = ConfiguracionSistema::where('idPeriodo', $this->idPeriodoUser())
            ->where('nombre', 'INSUMO_PORCENTUAL')->first();
        if($request->DeleteActDocente != null){
			$elimiActividad = ConfiguracionSistema::where('idPeriodo', $this->idPeriodoUser())
				->where('nombre','DELETE_ACTIVIDAD_DOCENTE')->first();
            $elimiActividad->valor = $request->DeleteActDocente;
            $elimiActividad->save();
        }
        if($request->NroEstudiantesCH != null){
            $nroEstudiantes = ConfiguracionSistema::where('idPeriodo', $this->idPeriodoUser())
                ->where('nombre','ESTUDIANTES_CUADRO_HONOR')->first();
            $nroEstudiantes->valor = $request->NroEstudiantesCH;
            $nroEstudiantes->save();
        }
        if($request->CertAsistencia != null){
            $certAsis = ConfiguracionSistema::where('idPeriodo', $this->idPeriodoUser())
            ->where('nombre', 'CERTIFICADO_ASISTENCIA')->first();
            $certAsis->valor = $request->CertAsistencia;
            $certAsis->save();
		}
		if($request->CertPromocion != null){
            $certProm = ConfiguracionSistema::where('idPeriodo', $this->idPeriodoUser())
            ->where('nombre', 'CERTIFICADO_PROMOCION')->first();
            $certProm->valor = $request->CertPromocion;
            $certProm->save();
		}
		if($request->PeriodoPaseAnio != null){
            $PaseAnio = ConfiguracionSistema::where('idPeriodo', $this->idPeriodoUser())
            ->where('nombre', 'PERIODO_PASE_DE_ANIO')->first();
            $PaseAnio->valor = $request->PeriodoPaseAnio;
            $PaseAnio->save();
        }
        if($request->FormatoPaseAnio != null){
            $PaseAnio = ConfiguracionSistema::where('idPeriodo', $this->idPeriodoUser())
            ->where('nombre', 'FORMATO_PASE_DE_ANIO')->first();
            $PaseAnio->valor = $request->FormatoPaseAnio;
            $PaseAnio->save();
        }
        if($request->contratoEconomico != null){
            $contratoEconomico = ConfiguracionSistema::where('idPeriodo', $this->idPeriodoUser())
            ->where('nombre', 'FORMATO_CONTRATO_ECONOMICO')->first();
            $contratoEconomico->valor = $request->contratoEconomico;
            $contratoEconomico->save();
        }
        if($request->selectParaleloRepre != null){
            $paralelo = ConfiguracionSistema::where('idPeriodo', $this->idPeriodoUser())
            ->where('nombre', 'SELECCIONAR_PARALELO')->first();
            $paralelo->valor = $request->selectParaleloRepre;
            $paralelo->save();
		}
		if($request->ActDatosRepre != null){
            $actDatos = ConfiguracionSistema::where('idPeriodo', $this->idPeriodoUser())
            ->where('nombre', 'ACTUALIZAR_ESTUDIANTE_REPRESENTANTE')->first();
            $actDatos->valor = $request->ActDatosRepre;
            $actDatos->save();
		}
		if($request->ActDatosEstu != null){
            $actDatosEst = ConfiguracionSistema::where('idPeriodo', $this->idPeriodoUser())
            ->where('nombre', 'ACTUALIZAR_ESTUDIANTE_ESTUDIANTE')->first();
            $actDatosEst->valor = $request->ActDatosEstu;
            $actDatosEst->save();
        }

        if($request->adjuntoRepresentante != null){
            $adjuntoRepresentante = ConfiguracionSistema::where('idPeriodo', $this->idPeriodoUser())
            ->where('nombre', 'ADJUNTO_CORREO_REPRESENTANTE')->first();
            $adjuntoRepresentante->valor = $request->adjuntoRepresentante;
            $adjuntoRepresentante->save();
        }

		if($request->AdmisionesBuscar != null){
            $AdmisionesB = ConfiguracionSistema::where('idPeriodo', $this->idPeriodoUser())
            ->where('nombre', 'BUSCAR_ESTUDIANTE_ADMISIONES')->first();
            $AdmisionesB->valor = $request->AdmisionesBuscar;
            $AdmisionesB->save();
		}
		return redirect()->route('configuracionesGenerales');		

    }

    public function nivelMaterias(Request $request){
        $nivel = Nivel::where('area_materia', $request->materia)->get();
        return $nivel;
	}

	public function configuracionFinanciero() {
		return view('UsersViews.financiero.configuraciones.index');
	}
}