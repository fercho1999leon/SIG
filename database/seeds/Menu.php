<?php

use Illuminate\Database\Seeder;
use App\SubMenu;
use Faker\Factory as Faker;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel as Sentinel;


class Menu extends Seeder
{

    public function run()
    {
       $Menus = array(
		    array('Mi Perfil', 'home', 'fa fa-th-large', '1'),
		    array('Notificaciones', 'notificaciones', 'fa fa-comment', '2'),
		 	array('Institución', '', 'fa fa-university', '3'),
		    array('Fichas Personales', '', 'fa fa-group', '4'),
		    array('Grados', '', 'fa fa-book', '5'),
		    array('Reportes', '', 'fa fa-clipboard', '6'),
		    array('Matrícula', 'matricula', 'fa fa-list-alt', '7'),
		    array('Transporte', 'transporte', 'fa fa-bus', '8'),
		    array('Pagos', '', 'fa fa-credit-card', '9'),
		    array('Configuraciones', 'configuraciones', 'fa fa-cogs', '10'),
		    array('Facturación Electronica', 'datos.facturacionElectronica', 'fa fa-cogs', '11'),
		    array('Permisos Usuarios', 'permisos', 'fa fa-lock', '12'),
		);
       $sub_Menus = array(
		    array('Información', 'institucion', '', '1','3'),
		    array('Año Electivo', 'institucionLectivo', '', '2','3'),
		    array('Áreas / Asignaturas', 'institucionMaterias', '', '3','3'),
		    array('Cronograma', 'cronograma', '', '4','3'),
		    array('Administrativos', 'administrativos', '', '1','4'),
		    array('Colecturia', 'colecturia.index', '', '2','4'),
		    array('Secretaría', 'secretaria.index', '', '4','4'),
		    array('Docentes', 'docentes', '', '5','4'),
		    array('Historial', 'historial', '', '10','4'),
		    array('Agenda Escolar', 'grade_agenda', '', '1','5'),
		    array('Asistencia Parcial', 'asistencia', '', '2','5'),
		    array('Asistencia', 'admin.asistenciaMateria.index', '', '3','5'),
		    array('Calificaciones', 'grade_score', '', '4','5'),
		    array('Comportamiento', 'comportamiento', '', '5','5'),
		    array('Destrezas', 'destrezasAdmin', '', '6','5'),
		    array('DHI', 'dhiAdmin', '', '7','5'),
		    array('Horario Escolar', 'horario_Escolar', '', '8','5'),
		    array('Libros Estudiantiles', 'additionalBook.index', '', '9','5'),
		    array('Lista Estudiantil', 'grade_lista', '', '10','5'),
		    array('Cursos', 'reportePorCurso2', '', '1','6'),
		    array('Docente', 'repDocente', '', '2','6'),
		    array('Estudiantes', 'reportePorEstudiantes2', '', '3','6'),
            array('Plataforma', 'pagosGeneral', '', '1','9'),
            array('Institucion', 'institucionEdicion', '', '1','10'),
            array('Cronograma', 'configuracion_cronograma', '', '2','10'),
            array('Cursos', 'cursosEdicion', '', '3','10'),
            array('Materias', 'materiasEdicion', '', '4','10'),
            array('Horarios', 'horariosEdicion', '', '5','10'),
            array('Areas', 'configuracionesAreas', '', '6','10'),
            array('Parcial', 'configuracionesParcial', '', '7','10'),
            array('Pagos', 'configuracionesPagos', '', '8','10'),
            array('Periodo Lectivo', 'homePeriodo', '', '9','10'),
            array('Generales', 'configuracionesGenerales', '', '10','10'),
		);
        foreach ($Menus as $key) {

       	$existe = \DB::table('menus')->where('nombre',$key[0])
       	->where('ruta',$key[1])->exists();
       	if (!$existe) {
       		 \DB::table('menus')->insert(array(
                'nombre'   =>  $key[0],
                'ruta'   =>  $key[1],
                'icono'   => $key[2],
                'posicion'   =>  $key[3]
            ));
       	}

        }
        foreach ($sub_Menus as $key1) {
        	 $existe1 = SubMenu::where('nombre',$key1[0])
       	->where('ruta',$key1[1])->exists();
       	if (!$existe1) {
            \DB::table('sub_menus')->insert(array(
                'nombre'   =>  $key1[0],
                'ruta'   =>  $key1[1],
                'icono'   => $key1[2],
                'posicion'   =>  $key1[3],
                'idMenu'   => $key1[4],
            ));
        }
        }
    }
}
