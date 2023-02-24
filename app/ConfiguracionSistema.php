<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Sentinel;

class ConfiguracionSistema extends Model
{
    protected $table = "configuracionessistema";


    public static function pagos()
    {
        return ConfiguracionSistema::where('nombre', 'ACTIVAR_PAGOS')
            ->where('idPeriodo', Sentinel::getUser()->idPeriodoLectivo)
            ->first();
    }

    public static function configuracionBecas($cargo = null)
    {
        return ConfiguracionSistema::where('nombre', 'PERMISO_ASIGNACION_BECAS')
            ->where('categoria', $cargo ?? session('user_data')->cargo)
            ->where('idPeriodo', Sentinel::getUser()->idPeriodoLectivo)
            ->first();
    }

    public static function configuracionDHI()
    {
        return ConfiguracionSistema::query()
            ->where('nombre', 'DHI')
            ->where('idPeriodo', Sentinel::getUser()->idPeriodoLectivo)
            ->first();
    }

    public static function comportamientoQuimestral()
    {
        return ConfiguracionSistema::query()
            ->where('nombre', 'COMPORTAMIENTO_QUIMESTRAL')
            ->where('idPeriodo', Sentinel::getUser()->idPeriodoLectivo)
            ->first();
    }

    public static function comportamientoPro()
    {
        return ConfiguracionSistema::query()
            ->where('nombre', 'COMPORTAMIENTO_PROMEDIO')
            ->where('idPeriodo', Sentinel::getUser()->idPeriodoLectivo)
            ->first();
    }

    public static function notaMinima()
    {
        return ConfiguracionSistema::where('nombre', 'NOTA_MINIMA')
            ->where('idPeriodo', Sentinel::getUser()->idPeriodoLectivo)
            ->first();
    }

    public static function pagoAdelantado()
    {
        return ConfiguracionSistema::where('nombre', 'pago_adelantado')
            ->where('idPeriodo', Sentinel::getUser()->idPeriodoLectivo)
            ->first();
    }

    public static function reiniciarContadorFactura()
    {
        return ConfiguracionSistema::where('nombre', 'REINICIAR_CONTADOR_FACTURA')
            ->where('idPeriodo', Sentinel::getUser()->idPeriodoLectivo)
            ->first();
    }

    public static function notasRojo()
    {
        return ConfiguracionSistema::where('nombre', 'NOTAS_ROJO')
            ->where('idPeriodo', Sentinel::getUser()->idPeriodoLectivo)
            ->first();
    }

    public static function eliminarMensajesEstudiantes()
    {
        return ConfiguracionSistema::where('nombre', 'ELIMINAR_MENSAJES_ESTUDIANTES')
            ->where('idPeriodo', Sentinel::getUser()->idPeriodoLectivo)
            ->first();
    }
   /* public static function nuevoEstudianteAdmision()
    {
        return ConfiguracionSistema::where('nombre', 'NUEVO_ESTUDIANTE_ADMISION')
            ->where('idPeriodo', Sentinel::getUser()->idPeriodoLectivo)
            ->first();
    }*/

    public static function habilitarNombreRepresentanteLibretaParcial()
    {
        return ConfiguracionSistema::where('nombre', 'HABILITAR_NOMBRE_REPRESENTANTE_EN_LIBRETA_PARCIAL')
            ->where('idPeriodo', Sentinel::getUser()->idPeriodoLectivo)
            ->first();
    }

    public static function formatoFacturas()
    {
        return ConfiguracionSistema::where('nombre', 'FORMATO_DE_FACTURAS')
            ->where('idPeriodo', Sentinel::getUser()->idPeriodoLectivo)
            ->first();
    }

    public static function facturacionElectronica()
    {
        return ConfiguracionSistema::where('nombre', 'ACTIVACION_FACTURACION_ELECTRONICA')
            ->where('idPeriodo', Sentinel::getUser()->idPeriodoLectivo)
            ->first();
    }

    public static function transporte()
    {
        return ConfiguracionSistema::where('nombre', 'MOSTRAR_TRANSPORTE')
            ->where('idPeriodo', Sentinel::getUser()->idPeriodoLectivo)
            ->first();
    }

    public static function nuevaMatricula()
    {
        return ConfiguracionSistema::where('nombre', 'NUEVA_MATRICULA')
            ->where('idPeriodo', Sentinel::getUser()->idPeriodoLectivo)
            ->first();
    }

    public static function calificaciones()
    {
        return ConfiguracionSistema::where('nombre', 'MOSTRAR_CALIFICACIONES_REPRESENTANTE')
            ->where('idPeriodo', Sentinel::getUser()->idPeriodoLectivo)
            ->first();
    }

    public static function diaDePago()
    {
        return ConfiguracionSistema::where('nombre', 'DIA_DE_PAGO')
            ->where('idPeriodo', Sentinel::getUser()->idPeriodoLectivo)
            ->first();
    }

    public static function orderInsumos()
    {
        return ConfiguracionSistema::where('nombre', 'ORDEN_INSUMOS')
            ->where('idPeriodo', Sentinel::getUser()->idPeriodoLectivo)
            ->first();
    }

    public static function diaProrroga()
    {
        return 3;
    }

    public static function contadorMatricula()
    {
        return ConfiguracionSistema::where('nombre', 'CONTADOR_MATRICULA')
            ->where('idPeriodo', Sentinel::getUser()->idPeriodoLectivo)
            ->first();
    }

    public static function tipoLibreta()
    {
        return ConfiguracionSistema::where('nombre', 'FORMATO_LIBRETA')
            ->where('idPeriodo', Sentinel::getUser()->idPeriodoLectivo)
            ->first();
    }

    public static function notaMenorRojo()
    {
        return ConfiguracionSistema::where('nombre', 'NOTA_MENOR_ROJO')
            ->where('idPeriodo', Sentinel::getUser()->idPeriodoLectivo)
            ->first();
    }

    public static function ingresaExamen()
    {
        return ConfiguracionSistema::where('nombre', 'INGRESA_EXAMEN')
            ->where('idPeriodo', Sentinel::getUser()->idPeriodoLectivo)
            ->first();
    }

    public static function modoAsistencia()
    {
        return ConfiguracionSistema::where('nombre', 'MODO_ASISTENCIA')
            ->where('idPeriodo', Sentinel::getUser()->idPeriodoLectivo)
            ->first();
    }

    public static function progresoFormativo()
    {
        return ConfiguracionSistema::where('nombre', 'PROGRESO_FORMATIVO')
            ->where('idPeriodo', Sentinel::getUser()->idPeriodoLectivo)
            ->first();
    }

    public static function asistencia()
    {
        return ConfiguracionSistema::where('nombre', 'ASISTENCIA')
            ->where('idPeriodo', Sentinel::getUser()->idPeriodoLectivo)
            ->first();
    }

    public static function editaCalificaciones()
    {
        return ConfiguracionSistema::where('nombre', 'EDITA_CALIFICACIONES')
            ->where('idPeriodo', Sentinel::getUser()->idPeriodoLectivo)
            ->first();
    }

    public static function ingresaRecuperacion()
    {
        return ConfiguracionSistema::where('nombre', 'INGRESA_RECUPERACION')
            ->where('idPeriodo', Sentinel::getUser()->idPeriodoLectivo)
            ->first();
    }

    public static function ingresaEvaluacion()
    {
        return ConfiguracionSistema::where('nombre', 'INGRESA_EVALUACION')
            ->where('idPeriodo', Sentinel::getUser()->idPeriodoLectivo)
            ->first();
    }

    public static function comportamientoRojo()
    {
        return ConfiguracionSistema::where('nombre', 'COMPORTAMIENTO_ROJO')
            ->where('idPeriodo', Sentinel::getUser()->idPeriodoLectivo)
            ->first();
    }

    public static function regimen()
    {
        $regimen = ConfiguracionSistema::where('nombre', 'REGIMEN_EDUCATIVO')
            ->where('idPeriodo', Sentinel::getUser()->idPeriodoLectivo)
            ->first();
        if ($regimen->valor == '0') {
            return $regimen = 'Regular';
        } else {
            return $regimen = 'Distancia';
        }
    }

    public static function formatoLibreta()
    {
        $tipo_libreta = ConfiguracionSistema::where('nombre', 'FORMATO_LIBRETA')
            ->where('idPeriodo', Sentinel::getUser()->idPeriodoLectivo)
            ->first();
        return $tipo_libreta->valor;
    }

    public static function admisiones()
    {
        $admisiones = ConfiguracionSistema::where('nombre', 'ACTIVAR_ADMISIONES')
            ->where('valor', 1)
            ->first();
        $PaseAnio = ConfiguracionSistema::where('nombre', 'PERIODO_PASE_DE_ANIO')
            ->where('valor','!=', '0')
            ->first();
        if($admisiones && $PaseAnio){
            
            $admisiones->idPeriodo = $PaseAnio->valor;
        }
        return $admisiones;
    }
    public static function aulaVirtual()
    {
        $aulaVirtual = ConfiguracionSistema::where('nombre', 'AULA_VIRTUAL')
            ->where('idPeriodo', Sentinel::getUser()->idPeriodoLectivo)
            ->first();
        return $aulaVirtual;
    }

    public static function mostrarLibretaRepresentante()
    {
        return ConfiguracionSistema::where('nombre', 'MOSTRAR_LIBRETA_REPRESENTANTE')
            ->where('idPeriodo', Sentinel::getUser()->idPeriodoLectivo)
            ->first();
    }
    
    public static function adjuntoRepresentante()
    {
        return ConfiguracionSistema::where('nombre', 'ADJUNTO_CORREO_REPRESENTANTE')
            ->where('idPeriodo', Sentinel::getUser()->idPeriodoLectivo)
            ->first();
    }

    public static function certificadoMatricula()
    {
        return ConfiguracionSistema::where('nombre', 'MOSTRAR_CERTIFICADO_MATRICULA')
            ->where('idPeriodo', Sentinel::getUser()->idPeriodoLectivo)
            ->first();
    }
    public static function certPromocion()
    {
        return ConfiguracionSistema::where('nombre', 'CERTIFICADO_PROMOCION')
            ->where('idPeriodo', Sentinel::getUser()->idPeriodoLectivo)
            ->first();
    }
    public static function sendToAdmin()
    {
        return ConfiguracionSistema::where('nombre', 'ENVIAR_A_ADMINISTRADOR')
            ->where('idPeriodo', Sentinel::getUser()->idPeriodoLectivo)
            ->first();
    }
    public static function editarDatosEstudiante()
    {
        return ConfiguracionSistema::where('nombre', 'EDITAR_DATOS_ESTUDIANTE')
            ->where('idPeriodo', Sentinel::getUser()->idPeriodoLectivo)
            ->first();
    }
     public static function PromedioInsumo()
    {
        return ConfiguracionSistema::where('nombre', 'PROMEDIO_POR_INSUMO')
            ->where('idPeriodo', Sentinel::getUser()->idPeriodoLectivo)
            ->first();
    }
    public static function InsumoPorcentual()
    {
        return ConfiguracionSistema::where('nombre', 'INSUMO_PORCENTUAL')
            ->where('idPeriodo', Sentinel::getUser()->idPeriodoLectivo)
            ->first();
    }
     public static function delActDocente()
    {
        return ConfiguracionSistema::where('nombre', 'DELETE_ACTIVIDAD_DOCENTE')
            ->where('idPeriodo', Sentinel::getUser()->idPeriodoLectivo)
            ->first();
    }
     public static function EstudiantesCuadroHonor()
    {
        return ConfiguracionSistema::where('nombre', 'ESTUDIANTES_CUADRO_HONOR')
            ->where('idPeriodo', Sentinel::getUser()->idPeriodoLectivo)
            ->first();
    }
    public static function certAsistencia()
    {
        return ConfiguracionSistema::where('nombre', 'CERTIFICADO_ASISTENCIA')
            ->where('idPeriodo', Sentinel::getUser()->idPeriodoLectivo)
            ->first();
    }
    public static function PaseDeAnio($periodo)
    {
        return ConfiguracionSistema::where('nombre', 'PERIODO_PASE_DE_ANIO')
            ->where('idPeriodo', $periodo)
            ->first();
    }
    public static function PaseDeAnioFormato($periodo)
    {
        return ConfiguracionSistema::where('nombre', 'FORMATO_PASE_DE_ANIO')
            ->where('idPeriodo', $periodo)
            ->first();
    }
    public static function ContratoEconomico($periodo)
    {
        return ConfiguracionSistema::where('nombre', 'FORMATO_CONTRATO_ECONOMICO')
            ->where('idPeriodo', $periodo)
            ->first();
    }
    public static function SelectParalelo($periodo)
    {
        return ConfiguracionSistema::where('nombre', 'SELECCIONAR_PARALELO')
            ->where('idPeriodo', $periodo)
            ->first();
    }
    public static function ActRepre()
    {
        return ConfiguracionSistema::where('nombre', 'ACTUALIZAR_ESTUDIANTE_REPRESENTANTE')
            ->where('idPeriodo', Sentinel::getUser()->idPeriodoLectivo)
            ->first();
    }
    public static function ActEstu()
    {
        return ConfiguracionSistema::where('nombre', 'ACTUALIZAR_ESTUDIANTE_ESTUDIANTE')
            ->where('idPeriodo', Sentinel::getUser()->idPeriodoLectivo)
            ->first();
    }
    public static function AdmisionesBuscar()
    {
        return ConfiguracionSistema::where('nombre', 'BUSCAR_ESTUDIANTE_ADMISIONES')
            ->where('valor', 1)
            ->first();
    }


}
