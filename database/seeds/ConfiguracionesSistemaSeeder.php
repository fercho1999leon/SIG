<?php

use Illuminate\Database\Seeder;
use App\ConfiguracionSistema;
use App\Course;
use App\Institution;
use App\PeriodoLectivo;

class ConfiguracionesSistemaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		$institution = Institution::first();
		$idPeriodos = PeriodoLectivo::all();
        $configuraciones = array(
            array('EDITA_CALIFICACIONES', 'El docente puede editar las calificaciones', 'DOCENTES', '0'),
            array('NOTAS_ROJO', 'Los promedios menores a 7 salen en rojo', 'DOCENTES', '1'),
            array('INGRESA_EVALUACION', 'El docente puede ingresar evaluacion', 'DOCENTES', '1'),
            array('INGRESA_EXAMEN', 'El docente puede ingresar EXAMEN', 'DOCENTES', '1'),
            array('INGRESA_RECUPERACION', 'El docente puede ingresar RECUPERACION', 'DOCENTES', '1'),
            array('ORDEN_INSUMOS', 'Orden en el que apareceran los insumos en los reportes', 'INSUMOS', ''),
            array('NOTA_MENOR_ROJO', 'Nota a partir de la cual apareceran en rojo', 'LIBRETA', '7'),
            array('COMPORTAMIENTO_ROJO', 'Letra a partir de la cual apareceran en rojo', 'LIBRETA', 'D'),
            array('ACTIVAR_PAGOS', 'Se activa el módulo de COLECTURÍA', 'ADMINISTRADOR',  '1'),
            array('NUEVA_MATRICULA', 'Se activa el módulo de Nueva Matrícula', 'ADMINISTRADOR', '1'),
            array('CONTADOR_MATRICULA', 'Modo de funcionamiento del contador de matricula', 'ADMINISTRADOR', ''),
            array('MOSTRAR_CALIFICACIONES_REPRESENTANTE', 'El representante podra ver las calificaciones desde su perfil', 'ADMINISTRADOR', '1'),
            array('DIA_DE_PAGO', 'Día máximo que es visible la libreta, sin haber realizado el pago', 'COLECTURIA', '0'),
            array('MODO_ASISTENCIA', 'Modalidad en el que se ingresara las asistencias', 'ADMINISTRADOR', 'DIARIA'),
            array('MOSTRAR_LIBRETA_REPRESENTANTE', 'Modalidad en el que se ingresara las asistencias', 'ADMINISTRADOR', '1'),
            array('MOSTRAR_TRANSPORTE', 'Se oculta en el menu la opción transporte', 'ADMINISTRADOR', '1'),
            array('HABILITAR_NOMBRE_REPRESENTANTE_EN_LIBRETA_PARCIAL', 'Se oculta el nombre del representante', 'ADMINISTRADOR', '1'),
            array('FORMATO_LIBRETA', 'Se cambia el tipo de formato de libreta a usar', 'ADMINISTRADOR', '0'),
            array('REGIMEN_EDUCATIVO', 'Se cambia el tipo de formato de libreta a usar', 'ADMINISTRADOR', '0'),
			array('NOTA_MINIMA', 'Nota minima a ingresar a calificaciones', 'ADMINISTRADOR', 2),
			array('DHI', 'Se ingresa las notas quimestral o parcial', 'ADMINISTRADOR', ''),
			array('COMPORTAMIENTO_QUIMESTRAL', 'Se decide si el comportamiento se replica del 3er parcial o se crea', 'ADMINISTRADOR', 'replicar'),
			array('PROGRESO_FORMATIVO', 'Activa el progreso formativo', 'ADMINISTRADOR', '0'),
			array('ASISTENCIA', 'Asistencia diaria o parcial', 'ADMINISTRADOR', 'parcial'),
			array('ELIMINAR_MENSAJES_ESTUDIANTES', 'Permite a los estudiantes si pueden eliminar o no los mensajes', 'ADMINISTRADOR', '0'),
			array('NUEVO_ESTUDIANTE_ADMISION', 'Permite o restringe la creacion de estudiantes desde admisiones', 'ADMINISTRADOR', '0'),
			array('PAGO_EN_LINEA', 'Permite o restringe el pago en linea desde el usuario representante', 'ADMINISTRADOR', '0'),
			array('AULA_VIRTUAL', 'Permite o restringe mostrar el link de enlace con el aula virtual', 'ADMINISTRADOR', '0'),
			array('ACTIVAR_ADMISIONES', 'Permite o restringe visualizar el modulo admisiones', 'ADMINISTRADOR', '0'),
			array('PAGO_ADELANTADO', 'Permite pasar de un estudiante de pre matricula a ordinario despues de realizar un pago', 'ADMINISTRADOR', ''),
			array('REINICIAR_CONTADOR_FACTURA', 'Esto va a permitir que el usuario no pueda reiniciar el contador mas de una vez', 'ADMINISTRADOR', '1'),
			array('ACTIVACION_FACTURACION_ELECTRONICA', 'permite activar o desactivar la facturación eletronica', 'ADMINISTRADOR', '0'),
			array('FORMATO_DE_FACTURAS', 'Permite escojer entre 2 formatos para la generación de facturas', 'ADMINISTRADOR', '0'),
			array('PERMISO_ASIGNACION_BECAS', 'Permite o restringe la asignación de beca al estudiante', 'Administrador', '0'),
			array('PERMISO_ASIGNACION_BECAS', 'Permite o restringe la asignación de beca al estudiante', 'Colecturia', '0'),
			array('PERMISO_ASIGNACION_BECAS', 'Permite o restringe la asignación de beca al estudiante', 'Secretaria', '0'),
			array('MOSTRAR_CERTIFICADO_MATRICULA', 'Muestra un certificado editado de la matricula', 'ADMINISTRADOR', '1'),
			array('ENVIAR_A_ADMINISTRADOR', 'Permite o restringe el envio de mensajes a administradores desde estudiante', 'ADMINISTRADOR', '0'),
			array('PROMEDIO_POR_INSUMO', 'Permite o restringe el visualización de los promedios según el numero de insumos activo ', 'ADMINISTRADOR', '0'),
            array('INSUMO_PORCENTUAL', 'Permite o restringe la asignación de porcentajes a los insumos', 'ADMINISTRADOR', '0'),
			array('DELETE_ACTIVIDAD_DOCENTE', 'Permite o restringe eliminar Actividades desde el perfil docente', 'ADMINISTRADOR', '0'),
			array('ESTUDIANTES_CUADRO_HONOR', 'Numero de estudiantes a mostrar en el cuadro de honor', 'ADMINISTRADOR', '10'),
			array('CERTIFICADO_ASISTENCIA', 'SELECCIONAR TIPO DE FORMATO ', 'ADMINISTRADOR', '1'),
			array('EDITAR_DATOS_ESTUDIANTE', 'Permite o restringe editar datos desde perfil estudiante', 'ADMINISTRADOR', '1'),
			array('COMPORTAMIENTO_PROMEDIO', 'Permite o restringe el promedio de las calificaciones del comportamiento por materia', 'ADMINISTRADOR', '1'),
            array('PERIODO_PASE_DE_ANIO', 'Selecciona el periodo al cual se puede pasar de año a los estudiantes', 'ADMINISTRADOR', '0'),
			array('SELECCIONAR_PARALELO', 'permite seleccionar al representante, el paralelo o especializacion del pase de año', 'ADMINISTRADOR', '0'),
			array('ACTUALIZAR_ESTUDIANTE_REPRESENTANTE', 'permite actualizar estudiante desde representante', 'ADMINISTRADOR', '0'),
			array('ACTUALIZAR_ESTUDIANTE_ESTUDIANTE', 'permite actualizar estudiante desde ESTUDIANTE', 'ADMINISTRADOR', '0'),
            array('CERTIFICADO_PROMOCION', 'SELECCIONAR TIPO DE FORMATO', 'ADMINISTRADOR', '0'),
            array('FORMATO_PASE_DE_ANIO', 'SELECCIONAR TIPO DE FORMATO', 'ADMINISTRADOR', '0'),
            array('FORMATO_CONTRATO_ECONOMICO', 'SELECCIONAR TIPO DE FORMATO', 'ADMINISTRADOR', '0'),
			array('BUSCAR_ESTUDIANTE_ADMISIONES', 'permite buscar estudiante desde admisiones', 'ADMINISTRADOR', '0'),
            array('ADJUNTO_CORREO_REPRESENTANTE', 'permite buscar adjuntar archivos desde el perfil del representante', 'ADMINISTRADOR', '0'),
		);

		foreach ($idPeriodos as $periodo) {
			for ($i=0; $i < count($configuraciones); $i++) {
				$conf = ConfiguracionSistema::where('nombre', $configuraciones[$i][0])->where('idPeriodo', $periodo->id)->first();
				if($conf == null) {
					$cs = new ConfiguracionSistema();
					$cs->nombre = $configuraciones[$i][0];
					$cs->descripcion = $configuraciones[$i][1];
					$cs->categoria  = $configuraciones[$i][2];
					$cs->valor  = $configuraciones[$i][3];
					$cs->idPeriodo = $periodo->id;
					$cs->save();
				}
			}
		}
    }
}
