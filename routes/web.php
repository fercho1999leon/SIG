<?php
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
 */
/**ACTIVAR SOLO CUANDO SE UTILICE CERTIFICADO SSL o PROXY*/

use App\Mail\NotifyUserAndPasswordUserAdmision;
use Illuminate\Support\Facades\Mail;

\URL::forceScheme('https');

//Routes for visitors
/**Routes Authentication with Sentinel**/
Route::group(['middleware' => ['visitors']], function () {

    Route::get('/mail',function(){
        $credentials = array();
        array_push($credentials,['user' => 'fernando@itred.edu.ec','pass' => '12345']);
        //dd(($credentials[0])['user']);
        //Mail::to('tecnico.tic@itred.edu.ec')->send(new NotifyUserAndPasswordUserAdmision($credentials));
        return view('mail.notifyUserAndPasswordAdmision',compact('credentials'));
    });


    Route::get('/', 'LoginSentinelController@login')->name('/');
    Route::post('/login', 'LoginSentinelController@postLogin')->name('login');
    Route::get('/password_forgot', 'LoginSentinelController@postLogin')->name('password.request');
    Route::get('/admisiones', 'MatriculaController@home_admision')->name('admision');
    Route::get('/admisiones/registro', 'MatriculaController@registro_admision')->name('admision_registro');
    Route::get('/admisiones/actualizar', 'AdmisionController@actDatos')->name('homeActualizar');

    /**PAGO EN LINEA **/
    Route::post('/pagos/', 'PagoLineaController@pagoTarjeta')->name('pagos');
    Route::get('/pagos/resultado/', 'PagoLineaController@recibe_token')->name('recibeToken');

    /**        FICHAS PERSONALES - Admisión       **/

    Route::get('/UsersViews/admisiones', 'admisionController@index')->name('admisiones');
    Route::post('/UsersViews/admisiones/registro', 'AdmisionController@searchStudents')->name('busqueda_estudiante');
    Route::get('/UsersViews/admisiones/{cedula}', 'AdmisionController@datos_estudiante')->name('admision_datos');
    Route::get('/autocomplete', 'AutocompleteController@index');
    Route::post('/autocomplete/fetch', 'AutocompleteController@fetch')->name('autocomplete.fetch');
    Route::post('/autocomplete/fetchFinanciero', 'AutocompleteController@fetchFinanciero')->name('autocompleteFinanciero.fetch');
    Route::post('/autocomplete/fetchPadre', 'AutocompleteController@fetchPadre')->name('autocompletePadre.fetch');
    Route::post('/autocomplete/fetchMadre', 'AutocompleteController@fetchMadre')->name('autocompleteMadre.fetch');
    Route::post('/admisiones/editarAdmision', 'AdmisionController@ActualizarAdmision')->name('actEstuAdmision');
    Route::get('/admisiones/modal-representante', 'AdmisionController@representanteAdmision')->name('verRepresentanteAdmision');
    Route::get('/admisiones/modal-cliente/', 'AdmisionController@clienteAdmision')->name('verClienteAdmision');
    Route::get('/admisiones/modal-padres/', 'AdmisionController@padresAdmision')->name('verPadresAdmision');
    Route::get('/admisiones/modal-edit-representante/', 'AdmisionController@editRepresentanteAdmision')->name('editPadresAdmision');
    Route::get('/admisiones/representante/{id}/{estudiante}', 'AdmisionController@representante')->name('admisionRepresentante');
    Route::get('/admisiones/representante_crear/{estudiante}', 'AdmisionController@representante_crear')->name('representante.crear');
    Route::get('/admisiones/ver-datos/{students}', 'AdmisionController@verDatos')->name('verDatos');
    Route::get('/admisiones/ver-pasos/{students}', 'AdmisionController@verPasos')->name('verPasos');
    Route::post('/admisiones/store_representante', 'AdmisionController@storeRepresentante')->name('representante.store');
    Route::get('/admisiones/clientes/{id}/{estudiante}', 'AdmisionController@cliente')->name('cliente.edit');
    Route::get('/admisiones/cliente_crear/{estudiante}', 'AdmisionController@cliente_crear')->name('cliente.crear');
    Route::post('/UsersViews/admisiones/{representante}', 'AdmisionController@representanteEdit')->name('representante.Edit');
    Route::post('/admisiones/store_cliente', 'AdmisionController@storeCliente')->name('cliente.store');
    Route::post('/admisiones/clientes', 'AdmisionController@clienteupdate')->name('actualizarCliente');
    Route::get('/admisiones/padres/{id}/{estudiante}/{parentezco}', 'AdmisionController@padres')->name('padres.edit');
    Route::post('/UsersViews/admisiones/', 'AdmisionController@padresupdate')->name('padres.update');
    Route::get('/admisiones/padre_crear/{estudiante}/{parentezco}', 'AdmisionController@padre_crear')->name('padre.crear');
    Route::post('/admisiones/store_padre', 'AdmisionController@storePadre')->name('padre.store');
    Route::get('/admisiones/estudiante/{id}', 'AdmisionController@edit_estudiante')->name('editarEstudiante');
    Route::put('/UsersViews/admisiones/{id}', 'AdmisionController@update_estudiante')->name('updateEstudiante');
    Route::get('/admisiones/nuevo-estudiante', 'AdmisionController@nuevo_estudiante')->name('nuevoEstudiante');
    Route::post('/admisiones/crear-estudiante', 'AdmisionController@crear_estudiante')->name('crearEstudiante');
    Route::get('/admisiones/finalizar/{id}', 'AdmisionController@finalizar')->name('finalizarAdmisiones');
    Route::get('/informacion-personal-matricula-representante/{idStudent}/{periodo}', 'ReportesInstitucionalesController@informacionPersonalMatriculaAdmision')->name('reporte.informacionPersonalMatriculaRepresentante');

    route::get('/admisiones/GetSemestreCarrera/{id}', 'AdmisionController@GetSemestreCarrera');
    route::get('/admisiones/GetCursoSemestre/{id}', 'AdmisionController@GetCursoSemestre');

    //listar facturas::
    Route::resource('/listarfactura', 'FacturasSRIController');
    Route::resource('/inforepresentante', 'datosController');
});

Route::group(['middleware' => ['users']], function () {

    // Hoja de Vida
    Route::get('/hoja-de-vida/{idEstudiante}', 'PdfControllerCertificado@hojaDeVida')->name('hojaDeVida');
    /** Cambio de roles*/
    Route::post('/CambioRol', 'ConfigurationController@switchRoles')->name('cambioRol');
    Route::post('/cambio-de-periodo/{user}', 'PeriodoController@cambioDePeriodo')->name('cambioPeriodoLectivo');
    /*
    API FICHAS PERSONALES
     */
    Route::get('FichasPersonales/api/estudiantesConRepresentante', 'PersonalFileController@getEstudiantesConRepresentante')->name('APIestudiantes');
    Route::get('FichasPersonales/api/administrativos', 'PersonalFileController@getAdministrativos')->name('APIadministrativos');
    Route::get('FichasPersonales/api/docentes', 'PersonalFileController@getDocentes')->name('APIdocentes');
    Route::get('FichasPersonales/api/docentesMateria', 'PersonalFileController@getDocentesMateria')->name('APIdocentesMateria');
    Route::get('FichasPersonales/api/cursos', 'PersonalFileController@getCursos')->name('APIcursos');
    Route::get('FichasPersonales/api/cursosDocente', 'PersonalFileController@getCursosDocente')->name('APIcursosDocente');
    Route::get('FichasPersonales/api/estudiantes', 'PersonalFileController@getEstudiantes')->name('APIrepresentantes');
    Route::get('FichasPersonales/api/estudiantesMateria', 'PersonalFileController@getEstudiantesMateria')->name('APIestudianteMateria');
    Route::get('FichasPersonales/api/representantesMateria', 'PersonalFileController@getRepresentanteMateria')->name('APIrepresentantesMateria');
    Route::get('FichasPersonales/api/secretaria', 'PersonalFileController@getSecretarias')->name('APIsecretarias');
    /*ZIP*/
    Route::post('downloadAdjunto', 'ZipController@download')->name('descargarAdjuntos');

    /*
    NOTIFICACIONES
     */
    Route::get('/notificacionesEnviar', 'NotificationController@enviar')->name("notificacionesEnviar");
    Route::post('/notificacionesEnviar', 'NotificationController@enviarMensaje')->name("enviarMensaje");
    Route::post('/notificacionesEnviarRespuesta', 'NotificationController@enviarMensajeRespuesta')->name("enviarMensajeRespuesta");
    Route::get('/notificacionesEnviar/{id}', 'NotificationController@show')->name("mostrarMensaje");
    //Descargar Adjunto-Notificaciones
    Route::get('/adjuntos/{archivo}', 'NotificationController@descargarAdjunto')->name('descargaAdjuntos');
    /**/

    // Notificaciones

    Route::get('todas-las-notificaciones', 'NotificacionesController@indexAll')->name('index.all');
    Route::post('marcar-leido/{notificacion}', 'NotificacionesController@marcarLeido')->name('marcar.leido');
    Route::post('notificaciones-leidas', 'NotificacionesController@updateLeido')->name('index.updated.leido');
    Route::get('/perfil', 'LoginSentinelController@home')->name('home');
    Route::post('/logout', 'LoginSentinelController@logout')->name('logout');
    Route::post('/logout/admisiones', 'LoginSentinelController@logoutAdmisiones')->name('logoutAdmisiones');
    Route::post('/Avatar', 'AdministrativeController@storeAvatar')->name('avatar');

    // Titulo Grado
    Route::delete('titulo-grados/destroy', 'TituloGradoController@massDestroy')->name('titulo-grados.massDestroy');
    Route::resource('titulo-grados', 'TituloGradoController');

    // Titulo Posgrado
    Route::delete('titulo-posgrados/destroy', 'TituloPosgradoController@massDestroy')->name('titulo-posgrados.massDestroy');
    Route::resource('titulo-posgrados', 'TituloPosgradoController');

    // Certificaciones
    Route::delete('certificaciones/destroy', 'CertificacionesController@massDestroy')->name('certificaciones.massDestroy');
    Route::resource('certificaciones', 'CertificacionesController');

    // Seminario
    Route::delete('seminarios/destroy', 'SeminarioController@massDestroy')->name('seminarios.massDestroy');
    Route::resource('seminarios', 'SeminarioController');

    // Experiencia Profesional
    Route::delete('experiencia-profesionals/destroy', 'ExperienciaProfesionalController@massDestroy')->name('experiencia-profesionals.massDestroy');
    Route::resource('experiencia-profesionals', 'ExperienciaProfesionalController');

    // Experiencia Docente
    Route::delete('experiencia-docentes/destroy', 'ExperienciaDocenteController@massDestroy')->name('experiencia-docentes.massDestroy');
    Route::resource('experiencia-docentes', 'ExperienciaDocenteController');

    // Experiencia Capacitador
    Route::delete('experiencia-capacitadors/destroy', 'ExperienciaCapacitadorController@massDestroy')->name('experiencia-capacitadors.massDestroy');
    Route::resource('experiencia-capacitadors', 'ExperienciaCapacitadorController');

    // Exp Vinc Colectiva
    Route::delete('exp-vinc-colectivas/destroy', 'ExpVincColectivaController@massDestroy')->name('exp-vinc-colectivas.massDestroy');
    Route::resource('exp-vinc-colectivas', 'ExpVincColectivaController');

    // Experiencia Vinculacion
    Route::delete('experiencia-vinculacions/destroy', 'ExperienciaVinculacionController@massDestroy')->name('experiencia-vinculacions.massDestroy');
    Route::resource('experiencia-vinculacions', 'ExperienciaVinculacionController');

    // Eventos
    Route::delete('eventos/destroy', 'EventosController@massDestroy')->name('eventos.massDestroy');
    Route::resource('eventos', 'EventosController');

    // Articulo
    Route::delete('articulos/destroy', 'ArticuloController@massDestroy')->name('articulos.massDestroy');
    Route::resource('articulos', 'ArticuloController');

    // Publicacion Libros
    Route::delete('publicacion-libros/destroy', 'PublicacionLibrosController@massDestroy')->name('publicacion-libros.massDestroy');
    Route::resource('publicacion-libros', 'PublicacionLibrosController');

    /* Asistencia Diaria */
    // Materias
    Route::get('asistencia-diaria/cursos/{course}', 'AsistenciaDiariaController@matters')->name('admin.asistenciaMateria');

    /*
    Edicion de datos del usuario
     */
    Route::get('/perfilEdit', 'LoginSentinelController@edit')->name('editPerfil');
    Route::post(
        'editGeneralData',
        ['as' => 'editUserGeneralData', 'uses' => 'LoginSentinelController@updateUserGeneralData']
    );

    Route::post(
        'editDomicilioData',
        ['as' => 'editUserDomicilioData', 'uses' => 'LoginSentinelController@updateUserDomicilioData']
    );

    Route::post(
        'editEmergencyTelf',
        ['as' => 'editUserEmergencyTelf', 'uses' => 'LoginSentinelController@updateUserEmergencyTelf']
    );
    /**/

    Route::get('institucion', 'InstitutionController@index')->name('institucion');
    Route::get('/notificaciones', 'NotificationController@home')->name('notificaciones');
    Route::get('/notificaciones/recibidos', 'NotificationController@recibidos')->name('notificacionesRecibidos');
    Route::post('/notificacione/recibidos/delete/{message}', 'NotificationController@eliminarEnviados')->name('eliminarNotificacionesEnviados');
    Route::get('/notificaciones/enviados', 'NotificationController@enviados')->name('notificacionesEnviados');
    Route::post('/notificacione/enviados/delete/{message}', 'NotificationController@eliminarRecibidos')->name('eliminarNotificacionesRecibidos');

    
    Route::get('carreras/listarCarreras/{idcarrera}', 'CarrerasController@listarOpcionesCarreras')->name('listarOpcionesCarreras');
    Route::get('carreras/crearCarrera', 'CarrerasController@createCarreras')->name('createCarreras');
    Route::post('carreras/Carreras', 'CarrerasController@carreraPost')->name('carrerapost-post');
    Route::delete('carreras/Carreras/eliminar/{carrera}', 'CarrerasController@postDeleteCareer')->name('carrera_update_delete');
    Route::get('carreras/Carreras/modificar/{career}', 'CarrerasController@postUpdateCareer')->name('carrera_update_post');
    Route::put('carreras/Carreras/{career}', 'CarrerasController@UpdateCareer')->name('update_post');

   // ASISTENCIA ESTUDIANTIL
     
        Route::get('/asistencia', 'AssistanceController@home')->name('asistencia');
        Route::get('/carrera/asistencia', 'AssistanceController@homeCareer')->name('asistenciacarrera');

        /** ASISTENCIA DIARIA */
        // Cursos
        Route::get('asistencia-diaria-cursos', 'AsistenciaDiariaController@index')->name('admin.asistenciaMateria.index');
        // materia
        // Route::get('asistencia-diaria/cursos/{course}/{materia}', 'AsistenciaDiariaController@materia')->name('admin.asistenciaMateria.materia');
        // // materia crear
        // Route::get('asistencia-diaria/cursos/{course}/{materia}/crear', 'AsistenciaDiariaController@materiaCrear')->name('admin.asistenciaMateria.crear');
        // Route::get('asistencia-diaria/cursos/', function(){})->name('admin.asistenciaMateria.crear-js');

    /**
    Routes Administrador
     **/
    Route::group(['middleware' => ['admin']], function () {
        /*
        permisos
         */

        Route::get('/permisos/{id}', 'PermisoController@home')->name('permisos');
        Route::post('/permisos/update', 'PermisoController@actualizar')->name('updatepermisos');
        Route::post('/permisos/delete', 'PermisoController@delete')->name('deletepermisos');

        /*
        PeriodoLectivo
         */
        Route::get('/periodoLectivo', 'PeriodoController@home')->name('homePeriodo');
        Route::get('/periodoLectivo/delete/{id}', 'PeriodoController@deletePeriodo')->name('deletePeriodo');
        Route::get('/periodoLectivo/editar/{id}', 'PeriodoController@editPeriodo')->name('editPeriodo');
        Route::PUT('/periodoLectivo/actualizar/', 'PeriodoController@actualizarPeriodo')->name('actualizarPeriodo');
        Route::Post('/periodoLectivo/agregar', 'PeriodoController@addPeriodo')->name('addPeriodo');
        /*
        Unidades Generales (Quimestres)
         */
        Route::get('/Unidades/{id}', 'PeriodoController@homeUnidades')->name('homeUnidades');
        Route::get('/Unidades/editar/{id}', 'PeriodoController@editarUnidad')->name('editarUnidad');
        Route::get('/Unidades/delete/{id}', 'PeriodoController@deleteUnidad')->name('deleteUnidad');
        Route::post('/Unidades/storeUnidad', 'PeriodoController@addUnidad')->name('addUnidad');
        Route::PUT('/Unidades/actualizar/', 'PeriodoController@actualizarUnidad')->name('actualizarUnidad');
        /*
        Unidades Generales (Quimestres)
         */
        Route::get('/ParcialesP/{id}', 'PeriodoController@homeParcialesP')->name('homeParcialesP');
        Route::get('/ParcialesP/editar/{id}', 'PeriodoController@editarParcialP')->name('editarParcialP');
        Route::get('/ParcialesP/delete/{id}', 'PeriodoController@deleteParcialP')->name('deleteParcialP');
        Route::post('/ParcialesP/storeParcialP', 'PeriodoController@addParcialP')->name('addParcialP');
        Route::PUT('/ParcialesP/actualizar/', 'PeriodoController@actualizarParcialP')->name('actualizarParcialP');
        /*
        Matrícula
         */
        Route::get('/students', 'MatriculaController@homeNew')->name('matricula');
        //Route::get('/studentsNew','MatriculaController@homeNew')->name('matriculaNew');
        Route::get('/students/tabla', 'MatriculaController@tablaEstudiantes')->name('tablaEstudiantes');
        Route::get('/students-bloqueo/{idStudent}', 'MatriculaController@obtenerBloqueos')->name('matriculacion.obtenerBloqueos');
        Route::get('/students/matricular/{id}', 'MatriculaController@matricular')->name('matricular');
        Route::get('/Crear Matricula', 'MatriculaController@create')->name('matriculaCrear');
        Route::post('/Crear Matricula', 'MatriculaController@store')->name('matricula_Crear');
        Route::post('/updateCredentials', 'MatriculaController@updateCredentials')->name('updateCredentials');
        Route::get('/Ver Matricula/{id}', 'MatriculaController@show')->name('matriculaVer');
        Route::get('/Editar Matricula/{id}/{idPeriodo}', 'MatriculaController@edit')->name('matriculaEditar');
        Route::get('/certificado_matricula', 'MatriculaController@certificadoMatriculaMinisterial')->name('matriculaMinisterialEstudiante');
        Route::get('/Editar Matricula/Representante/{id}', 'MatriculaController@showRepresentative')->name('infoReprentante');
        Route::put('/Actualizar Matricula/{id}', 'MatriculaController@update')->name('matriculaActualizar');
        Route::post('Actualizar_Matricula', 'MatriculaController@updateAndCrear')->name('matriculaActualizarCrear');
        Route::delete('/student/eliminar/{student}', 'StudentController@destroy')->name('eliminarEstudiante');
        Route::post('student/pasar-de-periodo-lectivo/{student}', 'MatriculaController@pasarDePeriodoLectivo')->name('pasarDePeriodoLectivo');
        Route::get('student/pasar-de-periodo-lectivo-all', 'MatriculaController@pasarDePeriodoLectivoAll')->name('pasarDePeriodoLectivoAll');
        Route::post('students/Editar-Becas', 'MatriculaController@editarBecas')->name('EditarBecas');
        // Reportes sección matricula
        Route::get('reporte/certificado-economico/{student}', 'PdfController@certificadoEconomico')->name('certificadoEconomico');

        /*
        INSTITUCION
         */

        Route::get('Grados-Paralelos/{id}', 'CourseController@showGrade')->name('institucionVerParalelos');
        //Materias/Docente
        Route::get('institucionMaterias', 'MatterController@show')->name('institucionMaterias');
        Route::get('Grados-Materias/{id}', 'MatterController@showByGrade')->name('institucionVerMaterias');
        //Año Lectivo
        Route::get('/institucionLectivo2', 'InstitutionController@schoolYear')->name('institucionLectivo');

        /*
        CRONOGRAMA
         */
        Route::get('/cronogramaA', 'CronogramaController@adminIndex')->name('cronograma');
        /*
        CRONOGRAMA CONFIGURACIONES
         */
        Route::get('/configuraciones/cronogramaA', 'CronogramaController@configuraciones_index')->name('configuracion_cronograma');
        Route::post('/configuraciones/cronogramaA/store', 'CronogramaController@configuraciones_store')->name('configuracion_cronograma-store');
        Route::put('/configuraciones/cronogramaA/{cronograma}/update', 'CronogramaController@configuraciones_update')->name('configuracion_cronograma-update');
        Route::delete('/configuraciones/cronogramaA/{cronograma}/delete', 'CronogramaController@configuraciones_destroy')->name('configuracion_cronograma-delete');
        /*
        TRANSPORTE
         */
        Route::get('transporte', 'transporteController@home')->name('transporte');
        Route::get('transporte/ver/{transporte}', 'transporteController@unidad')->name('transporte-ver');
        Route::get('transporte/crear-ruta', 'transporteController@crearTransporte')->name('transporte-crearRuta');
        Route::post('transporte/crear-ruta', 'transporteController@store')->name('transporte-store');
        Route::get('transporte/editar-ruta/{id}', 'transporteController@editarTransporte')->name('transporte-editar');
        Route::put('transporte/update/{id}', 'transporteController@updateTransporte')->name('transporte-update');
        Route::delete('transporte/delete/{id}', 'transporteController@destroy')->name('transporte-eliminar');
        /**
         * TRANSPORTE REPORTE
         */
        Route::get('transporte/transporte-reporte/{id}', 'transporteController@reporte')->name('transporte-reporte');

        /**
         * PLANIFICACIÓN
         */
        Route::get('planificaciones', 'planificacionesController@home')->name('planificacionesAdministrador');

        //Debe editarse
        Route::get('planificaciones/pci', 'planificacionesController@pci')->name('planificaciones-pci');

        Route::get('planificaciones/pca', 'planificacionesController@pca')->name('planificaciones-pca');
        Route::get('planificaciones/microplanificaciones', 'planificacionesController@microplanificaciones')->name('microplanificaciones');

        Route::get('planificaciones/pca/curso', 'planificacionesController@curso');
        Route::get('planificaciones/pca/curso/documento', 'planificacionesController@documento')->name('planificaciones-documento');
        /**
         * REPORTE CANTIDAD DE ESTUDIANTES
         */
        Route::get('reporte-matricula', 'MatriculaController@matriculados')->name('reporteMatriculados');
        Route::get('students/reporte-becas', 'MatriculaController@reporteBecas')->name('reporteEstudiantesConBecas');
        Route::get('students/reporte-estudiantes-matriculados', 'MatriculaController@matriculados2')->name('reporte.matriculados2');
        /*
        SEMESTRES
         */
        //Semestres--Carreras
        //Route::get('/carreras','CarrerasController@index')->name('carreras');
        //Route::get('carreras/listarCarreras','CarrerasController@listarOpcionesCarreras')->name('listarOpcionesCarreras');
        //Route::get('carreras/crearCarrera','CarrerasController@createCarreras')->name('createCarreras');
        //Route::post('carreras/Carreras', 'CarrerasController@carreraPost')->name('carrerapost-post');
        //Route::delete('carreras/Carreras/eliminar/{carrera}','CarrerasController@postDeleteCareer')->name('carrera_update_delete');
        //Route::put('carreras/Carreras/modificar/{carrera}','CarrerasController@postUpdateCareer')->name('carrera_update_post');

        

        //Semestres
        Route::get('/semestres', 'SemestresController@index')->name('semestres');
        Route::get('semestres/listarSemestres', 'SemestresController@listarOpcionesSemestres')->name('listarOpcionesSemestres');
        //Route::get('semestres/crearSemestre','SemestresController@createSemestres')->name('createSemestres');

        Route::get('semestres/carrera/crearCarreraSemestre/{id}', 'SemestresController@creaCarreraSemestre')->name('creaCarreraSemestre');

        Route::post('semestres/carrera/crearCarreraSemestre/semestrepost-post', 'SemestresController@semestrePost')->name('semestrepost-post');
        //Route::delete('semestres/Semestres/eliminar/{}','SemestresController@postDeleteSemestre')->name('semestre_update_delete');
        //Route::get('semestres/Semestres/modificar/{}','SemestresController@postUpdateSemestres')->name('semestre_update_post');
        Route::get('semestres/carrera/{id}', 'SemestresController@postAccedeCareer')->name('carrera_accede_post');
        //Route::get('semestres/crearSemestre/carrera/{id}','SemestresController@createSemestreAccede')->name('carrera_accedecrea_post');
        Route::delete('semestres/Semestres/eliminar/{semestre}', 'SemestresController@postDeleteSemester')->name('semestre_update_delete');
        Route::get('semestres/carrera/semestres/Semestres/modificar/{semester}', 'SemestresController@postUpdateSemester')->name('semestre_update_post');
        Route::put('semestres/Semestres/{semester}', 'SemestresController@UpdateSemester')->name('update_post_semester');

        //Insumos
        Route::get('/insumos', 'InsumosController@index')->name('insumos');
        Route::get('insumos/carrera/{id}', 'InsumosController@postAccedeCareer')->name('insumo_listar');

        //Materia
        Route::get('semestres/carrera/curso/semestre/materias/semestre/{id}', 'MateriasController@postAccedeSemester')->name('semestre_accede_post');

        Route::get('semestres/carrera/curso/semestre/materias/semestre/crearSemestreMateria/{id}', 'MateriasController@creaSemestreMateria')->name('creaSemestreMateria');
        Route::post('semestres/carrera/crearSemestreMateria/materiapost-post', 'MateriasController@materiaPost')->name('materiapost-post');

        Route::get('semestres/carrera/curso/semestre/materias/semestre/materias/Semestres/modificar/{matter}', 'MateriasController@postUpdateMatter')->name('matter_update_post');
        Route::put('materias/Materias/{matter}', 'MateriasController@UpdateMatter')->name('update_post_matter');
        Route::delete('materias/Materias/eliminar/{materia}', 'MateriasController@postDeleteMatter')->name('materia_update_delete');
        //Route::post('materias/Materias/eliminar/{materia}','MateriasController@postDeleteMatter')->name('materia_update_delete');

        //Cursos
        //Route::get('semestres/carrera/curso/semestre/{id}','CursosController@postAccedeCurso')->name('cursos_accede_post');
        Route::get('semestres/carrera/curso/semestre/{semester_id}', 'CursosController@postAccedeCurso')->name('cursos_accede_post');
        Route::get('semestres/carrera/curso/semestre/crearSemestreCurso/{id}', 'CursosController@creaSemestreCurso')->name('creaSemestreCurso');
        Route::post('semestres/carrera/crearSemestreCurso/cursopost-post', 'CursosController@cursoPost')->name('cursopost-post');

        Route::get('semestres/carrera/curso/semestre/curso/Semestres/modificar/{curso}', 'CursosController@postUpdateCurso')->name('curso_update_post');
        Route::put('semestres/Curso/{curso}', 'CursosController@UpdateCurso')->name('update_post_curso');
        Route::delete('semestres/Curso/eliminar/{curso}', 'CursosController@postDeleteCurso')->name('curso_update_delete');

        //Route::get('/materias','MateriasController@index')->name('materias');
        //Route::get('materias/listarMaterias','MateriasController@listarOpcionesMaterias')->name('listarOpcionesMaterias');
        //Route::get('materias/crearMaterias','MateriasController@createMaterias')->name('createMaterias');
        //Route::post('materias/Materias', 'MateriasController@materiaPost')->name('materiapost-post');
        //Route::delete('materias/Materias/eliminar/{}','MateriasController@postDeleteMaterias')->name('materia_update_delete');
        //Route::get('materias/Materias/modificar/{}','MateriasController@postUpdateMaterias')->name('materia_update_post');

        //Paralelo
        //Route::get('/paralelos','ParalelosController@index')->name('paralelos');
        //Route::get('paralelos/listarParalelos','ParalelosController@listarOpcionesParalelos')->name('listarOpcionesParalelos');
        //Route::get('paralelos/crearParalelos','ParalelosController@createParalelos')->name('createParalelos');
        //Route::post('paralelos/Paralelos', 'ParalelosController@paralelosPost')->name('paralelopost-post');
        //Route::delete('paralelos/Paralelos/eliminar/{}','ParalelosController@postDeleteParalelos')->name('paralelo_update_delete');
        //Route::get('paralelos/Paralelos/modificar/{}','ParalelosController@postUpdateParalelos')->name('paralelo_update_post');
        Route::get('/asistencia/Reporte-Curso/{course}/{parcial}', 'AssistanceController@getAsistenciaReporte')->name('asistenciaReporteCurso');
        Route::get('/asistencia/Reporte-Curso/', function(){})->name('asistenciaReporteCursoJs');
        Route::get('/asistencia/reporte-asistencia-anual/{course}', 'AssistanceController@reporteAsistenciaCursoAnual')->name('reporteAsistenciaCursoAnual');

        //Grados--Agenda Escolar//
        Route::get('/grados/agenda/', 'GradeController@getLectionary')->name('grade_agenda');
        Route::get('/grados/agenda/carrera/{idcarrera}', 'GradeController@getLectionary')->name('grade_agenda_carrera'); //cambiar
        //Grados --Agenda Escolar--Curso  ver_CursoAgenda
        Route::get('/grados/agenda/{id}', 'GradeController@getLectionaryCourse')->name('ver_CursoAgenda');
        Route::get('/grados/agenda-semanal/{course}', 'GradeController@getLectionaryCourseSemanal')->name('ver_CursoAgenda.semanal');
        //Ruta Crear hora Clase Administrador
        Route::get('/Grados/Agenda Escolar/Crear Hora Clase/{id}/{idCurso}', 'LectionaryController@createHourClass')->name('crearClaseAdministrador');
        Route::post('/Grados/Agenda Escolar/Crear Hora Clase-Enviar/{id}', 'LectionaryController@storeHourClass')->name('storeClaseAdministrador');
        //Ruta Editar  hora Clase Administrador
        Route::get('/Grados/Agenda Escolar/Editar Hora Clase/{id}/{idCurso}', 'LectionaryController@editHourClass')->name('editClaseAdministrador');
        Route::put('/Grados/Agenda Escolar/Actualizar Hora Clase/{id}', 'LectionaryController@updateHourClass')->name('updateClaseAdministrador');
        //Ruta Eliminar hora Clase Administrador
        Route::delete('/Grados/Agenda Escolar/Eliminar Hora Clase/{id}', 'LectionaryController@destroyClaseAdministrador')->name('destroyClaseAdministrador');
        // Ruta Observación al estudiante
        Route::post('/Grados/Agenda Escolar/Editar Hora Clase/observacion/{actividad}', 'LectionaryController@storeObservacionAdministrador')->name('ClaseObservacionAdministrador');
        Route::put('/Grados/Agenda Escolar/Editar Hora Clase/observacion/{observacion}/update', 'LectionaryController@updateObservacionAdministrador')->name('ClaseObservacionAdministradorUpdate');
        Route::delete('/Grados/Agenda Escolar/Editar Hora Clase/observacion/{observacion}/delete', 'LectionaryController@destroyObservacionAdministrador')->name('ClaseObservacionAdministradorDestroy');
        //Grados--Agenda Escolar Reportes//
        Route::get('/grados/agenda escolar/reporte-del-dia/{course}', 'LectionaryController@reporteDiario')->name('agenda-escolar-reporteDiario');

        /* COMPORTAMIENTO */
        Route::get('comportamiento', 'ComportamientoController@home')->name('comportamiento');
        Route::get('comportamiento/curso/{id}/{parcial}', 'ComportamientoController@curso')->name('comportamiento-curso');
        Route::get('comportamiento/curso/estudiante/{idEstudiante}/{parcial}/{idCurso}', 'ComportamientoController@estudiante')->name('comportamiento-estudiante');
        Route::post('comportamiento/curso/estudiante/{idEstudiante}/{parcial}/{idCurso}', 'ComportamientoController@store')->name('comportamiento-estudiante-store');
        Route::put('comportamiento/curso/estudiante/{idEstudiante}/{parcial}/{idCurso}', 'ComportamientoController@update')->name('comportamiento-estudiante-update');
        Route::get('comportamiento/curso/', function () {
        })->name('comportamiento-curso-js');
        Route::get('comportamiento/curso/estudiante/', function () {
        })->name('comportamiento-estudiante-js');

        /** COMPORTAMIENTO REPORTES */
        Route::get('comportamiento/curso/{course}/{parcial}/reporte-por-parcial', 'ComportamientoController@reportePorParcial')->name('comportamiento-reporte-por-parcial');
        //LISTA
        Route::get('/grados/lista', 'GradeController@getList')->name('grade_lista');
        Route::get('/grados/lista/{idCurso}', 'GradeController@gradoLista')->name('gradoLista-dowload');
        // PERSONAS AUTORIZADAS
        Route::resource('/personas-autorizadas', 'PersonasAutorizadasController');
        // PERSONAS AUTORIZADAS - REPORTE
        Route::get('/reporte-personas-autorizadas/{idStudent}', 'PdfController@personasAutorizadas')->name('reporte.personas.autorizadas');
        //CALIFICACIONES
        Route::get('/recuperaciones/{idCurso}/{idMateria}', 'GradeController@recuperaciones')->name('recuperacionesAdmin');
        Route::get('/grados/calificaciones', 'GradeController@getScores')->name('grade_score');
        Route::get('/grados/calificaciones/curso/{id}/{parcial?}', 'GradeController@getScoresCourse')->name('grade_score_course');
        Route::get('/grados/calificaciones/curso/materia/{id}/{parcial}', 'GradeController@getScoresCourseMatter')->name('InsumosAdmin');
        Route::post('/grados/calificaciones/{activity}/{student}', 'GradeController@updateCalificaciones')->name('calificacionesUpdateAdmin');
        Route::get('/grados/calificaciones/curso/', function () {
        })->name('promedioCurso');
        Route::get('/grados/calificaciones/curso/materia/', function () {
        })->name('grade_score_course_matter');
        Route::get('grados/Calificaciones/Curso/Materia/{id}', 'ScoreController@ingreso')->name('ingresoMateria');

        /* Reporte de Comportamiento - Index*/
        Route::get('grados/Calificaciones/Curso/Comportamiento/{id}', 'ComportamientoController@getCourse')->name('reporteComportamientoCurso');
        /* Reporte de Comportamiento - Editar Estudiante*/
        Route::get('grados/Calificaciones/Curso/Comportamiento/Estudiante-Edicion/{id}/{parcial}', 'ComportamientoController@editStudent')->name('comportamientoEdit');
        Route::get('grados/Calificaciones/Curso/Comportamiento/Estudiante-Edicion/{id}', function () {
        })->name('RutaComportamientoEdit');
        /* Reporte de Comportamiento - Actualizar Estudiante*/
        Route::put('grados/Calificaciones/Curso/Comportamiento/Estudiante/Actualizar/{id}', 'ComportamientoController@updateStudent')->name('comportamientoUpdate');

        Route::get('/grados/materiaInsumo/{idMateria}/{idInsumo}/{parcial}', 'GradeController@materiaInsumo')->name('verInsumoAdmin');
        Route::post('/grados/materiaInsumo/Actividades/{idMateria}/{idInsumo}/{parcial}', 'GradeController@storemateriaInsumo')->name('addActividadAdmin');
        Route::get('/grados/materiaInsumo/Actividades/refuerzo/{idInsumo}/{parcial}', 'GradeController@activarRefuerzoAcademico')->name('ActivarRefuerzoAcademico');
        Route::get('/grados/materiaInsumo/Actividades/refuerzo/desactivar/{idInsumo}/{parcial}', 'GradeController@desactivarRefuerzoAcademico')->name('DesactivarRefuerzoAcademico');
        Route::get('/grados/materia/Insumo/Actividades/showActividad/{actividad}/{course}/{materia}/{accion}', 'GradeController@showActivity')->name('getActividadAdmin');

        Route::get('/grados/materiaInsumo/promedio/', function () {
        })->name('promedioInsumoAdmin');
        Route::get('/grados/materiaInsumo/Actividades/', function () {
        })->name('ActividadAdmin');
        Route::get('/grados/materia/promedio/', function () {
        })->name('guardarPromediosAdmin');
        Route::get('/grados/materiaInsumo/', function () {
        })->name('InsumoAdmin');
        Route::delete('deleteActivityAdmin', 'GradeController@destroy')->name('deleteActivityAdmin');
        Route::post('/grados/materiaInsumo/promedio/{idInsumo}', 'GradeController@promedioInsumo');
        Route::post('/grados/materia/promedio/{x}', 'GradeController@promedio');
        Route::get('/examen-quimestral/{materia}/{quimestre}', 'GradeController@examenQuimestral')->name('examenQuimestralA');
        Route::get('/examen-quimestral/{materia}', function () {
        })->name('examenQuimestral');

        //Administrador ingresa a la materia
        
        // Progreso Formativo
        Route::get('observaciones-aulicas', 'observacionesAulicasController@index')->name('aulicas.index');
        // ver
        Route::get('observaciones-aulicas/ver/{docente}', 'observacionesAulicasController@show')->name('aulicas.show');
        // crear
        Route::get('observaciones-aulicas/crear/{docente}', 'observacionesAulicasController@create')->name('aulicas.create');
        // editar
        Route::get('observaciones-aulicas/editar/{docente}', 'observacionesAulicasController@edit')->name('aulicas.edit');
        // post crear
        Route::post('observaciones-aulicas/crear/{docente}', 'observacionesAulicasController@store')->name('observacionesAulicas.store');
        // post actualizar
        Route::put('observaciones-aulicas/crear/{docente}', 'observacionesAulicasController@update')->name('observacionesAulicas.update');

        /*
        
        //Asistencia Reportes
        Route::get('/asistencia/Reporte Curso/{course}/{parcial}', 'AssistanceController@getAsistenciaReporte')->name('asistenciaReporteCurso');
        Route::get('/asistencia/Reporte Curso/', function () {
        })->name('asistenciaReporteCursoJs');
        //Asistencia Reporte Editar-Estudiante
        Route::get('/asistencia/Reporte Curso/Estudiante/{student}/{parcial}', 'AssistanceController@createAsistenciaReporte')->name('asistenciaReportStudent');
        //Asistencia Reporte Actualizar-Estudiante
        Route::put('/asistencia/Reporte Curso/Estudiante/Actualizar/{student}/{parcial}', 'AssistanceController@updateAsistenciaReporte')->name('asistenciaReportStudentUpdate');
        // Reporte descargable
        Route::get('/asistencia/Reporte Curso/{course}/{parcial}/reporte-asistencia-parcial', 'AssistanceController@reporteAsistenciaCurso')->name('reporteAsistenciaCurso');
        Route::get('/asistencia/reporte-asistencia-anual/{course}', 'AssistanceController@reporteAsistenciaCursoAnual')->name('reporteAsistenciaCursoAnual');
        Route::get('/asistencia/reporte-asistencia-anual-header', function () {
            return view('pdf.reporte-asistencia-quimestral-header');
        })->name('reporteAsistenciaCursoAnual-header');
        Route::get('/asistencia/reporte-asistencia-quimestral/{course}/{parcial}', 'AssistanceController@reporteAsistenciaCursoQuimestral')->name('reporteAsistenciaCursoQuimestral');
        Route::get('/asistencia/reporte-asistencia-por-estudiante/{course}/{student}/{parcial}', 'AssistanceController@reporteAsistenciaPorEstudiante')->name('reporteAsistenciaPorEstudiante');

        // ASISTENCIA DE CURSO POR PARCIAL
        Route::post('asistencia/asistencia-curso-por-parcial/{id}/{parcial}', 'AssistanceController@crearAsistenciaCurso')->name('asistencia.cursoPorParcial');
        /*
        DHI
         */
        Route::get('/dhi/{parcial}', 'DHIController@index')->name('dhiAdmin');
        Route::get('/dhi/', function () {
        })->name('dhiAdmin-js');
        Route::get('/dhi/{parcial}/{course}', 'DHIController@curso')->name('dhiCurso');
        Route::post('dhi/{parcial}/{course}', 'DHIController@storeParcial')->name('dhi.store.parcial');
        /*
        OBSERVACIONES AULICAS
         */
        Route::get('/observacion-aulica', 'SeguimientoDocenteController@index');
        Route::get('observacion-aulica/docente', 'SeguimientoDocenteController@generar');

        /*
        CONFIGURACIONES
         */
        Route::get('/configuraciones', 'ConfigurationController@home')->name('configuraciones');
        /*
        HORARIO ESCOLAR
         */
        Route::get('horarios', 'ScheduleController@schedules')->name('horario_Escolar');
        Route::get('/horario_Curso/{idCurso}/{parcial}', 'ScheduleController@courseSchedule')->name('horario_Curso');
        Route::get('/horario_Curso', function () {
        })->name('horario_CursoJs');

        Route::get('/docente/horarios/{id}', 'TeacherScheduleController@edit')->name('editarHoraClaseDocente');
        Route::put('/docente/horarios/actualizar/{id}', 'TeacherScheduleController@update')->name('actualizarHoraClaseDocente');

        /*
        DESTREZAS
         */
        Route::get('/Destrezas', 'DestrezaController@homeAdmin')->name('destrezasAdmin');
        Route::get('/Destrezas curso/{idCurso}', 'DestrezaController@homeCurso')->name('destrezasAdminCurso');
        //Index
        Route::get('/Destrezas/materiasAdmin/', 'DestrezaController@getSubjectsAdmin')->name('materiasAdmin');
        //Crear Destreza Index
        Route::get('/Destrezas/Crear Destrezas', 'DestrezaController@crearAdmin')->name('crearDestrezaAdmin');
        Route::post('/Destrezas/Crear Destrezas/store', 'DestrezaController@storeAdmin')->name('crearDestrezaDocenteAdmin');
        /* Mostrar destrezas por materia*/
        Route::get('/Destrezas/{idMateria}/{parcial}', 'DestrezaController@showDestrezasAdmin')->name('showDestrezasMateriaAdmin');
        /*Editar destreza*/
        Route::get('/Destrezas/{idMateria}/{parcial}/{idDestreza}/Editar Destreza', 'DestrezaController@editarAdmin')->name('editDestrezaAdmin');
        Route::get('/Destrezas/materias', 'DestrezaController@getSubjects')->name('MATERIASDESTREZA');
        Route::put('/Destrezas/update', 'DestrezaController@updateAdmin')->name('updateDestrezasAdmin');
        /*Eliminar Destrezas*/
        Route::delete('/Destrezas/{idDestreza}/{parcial}/delete', 'DestrezaController@destroyAdmin')->name('deleteDestrezasAdmin');
        /*Clase Destreza*/
        Route::post('/crear-destreza/{idMateria}/{parcial}/', 'DestrezaController@crearClaseDestrezaAdmin')->name('crearClaseDestrezaAdmin');
        Route::post('/Destrezas/claseDestreza', 'DestrezaController@updateClaseDestrezaAdmin')->name('updateClaseDestrezaAdmin');
        Route::get('/Destrezas/{idMateria}/{parcial}/{idDestreza}', 'DestrezaController@showClaseDestrezasAdmin')->name('showClaseDestrezasMateriaAdmin');
        Route::delete('/Destrezas/deleteClaseDestreza', 'DestrezaController@destroyClaseDestrezaAdmin')->name('deleteClaseDestrezaAdmin');
        /**/

        // Gestión Facturas
        Route::get('gestionfactura', 'GestionFacturaController@index')->name('gestionfactura.index');
        Route::post('gestionfactura/listado', 'GestionFacturaController@show')->name('gestionfactura.show');
        /*
        FICHAS PERSONALES
         */
        //**Registro de Administradores - Docentes**//
        Route::get('FichasPersonales/administrativos/crear', 'RegisterController@register_index')->name('administrativos_crear');
        Route::post('FichasPersonales/administrativos/crear', 'RegisterController@postRegister');

        //****//
        //**Edición de Administradores - Docentes**//
        Route::get('FichasPersonales/{type}/modificar/{user}', 'PersonalFileController@getUpdateUser')->name('administrativos_update');
        Route::get('FichasPersonales/{type}/detalle/{user}', 'PersonalFileController@getDetailUser')->name('administrativos_Details');
        Route::put('FichasPersonales/administrativos/modificar/{user}', 'PersonalFileController@postUpdateUser')->name('administrativos_update_post');
        Route::delete('FichasPersonales/administrativos/eliminar/{user}', 'PersonalFileController@postDeleteUser')->name('administrativos_update_delete');
        // Representante edit
        Route::put('FichasPersonales/Representante/modificar/{representante}', 'PersonalFileController@representanteUpdate')->name('representante.update');
        // Representante ver
        Route::get('FichasPersonales/Representante/show/{representante}', 'PersonalFileController@representanteShow')->name('representante.show');

        Route::get('FichasPersonales/administrativos', 'PersonalFileController@administrativeHome')->name('administrativos');
        Route::get('FichasPersonales/docentes', 'PersonalFileController@teacherHome')->name('docentes');
        Route::get('/estudiantes', 'PersonalFileController@studentHome')->name('estudiantes');
        Route::get('FichasPersonales/representantes', 'PersonalFileController@representativeHome')->name('representantes');

        Route::get('FichasPersonales/administrativos/ver/{id}', 'RegisterController@show')->name('administrativos_ver');
        Route::get('FichasPersonales/docentes/reporte-docentes', 'PdfController@reporteDocentes')->name('reporteDocentesGeneral');
        Route::get('FichasPersonales/docentes/reporte-docentes-datos', 'PdfController@reporteDocentesdatos')->name('reporteDocentesGeneraldatos');

        Route::get('FichasPersonales/docentes/horario/{user}', 'TeacherScheduleController@indexHorario')->name('fichaDocenteHorario');
        Route::post('FichasPersonales/docentes/horario/{user}', 'TeacherScheduleController@adminHorarioStore')->name('fichaDocenteHorario-store');
        Route::delete('FichasPersonales/docentes/horario/{courseSchedule}/{user}', 'TeacherScheduleController@adminHorarioDestroy')->name('fichaDocenteHorario-destroy');

        // Fichas personales colecturia
        Route::get('FichasPersonales/colecturia', 'PersonalFileController@colecturia')->name('colecturia.index');
        // Ver usuario colecturia
        Route::get('FichasPersonales/colecturia/{colecturia}/show', 'PersonalFileController@colecturiaShow')->name('colecturia.show');
        // Creando usuario colecturia
        Route::get('FichasPersonales/colecturia/crear', 'PersonalFileController@colecturiaCrear')->name('colecturia.create');
        Route::post('FichasPersonales/colecturia/crear/adding-user', 'PersonalFileController@colecturiaStore')->name('colecturia.store');
        // Editando un usuario colecturia
        Route::get('FichasPersonales/colecturia/{user}/editar', 'PersonalFileController@colecturiaEdit')->name('colecturia.edit');
        Route::put('FichasPersonales/colecturia/{user}/editar/update', 'PersonalFileController@colecturiaUpdate')->name('colecturia.update');
        // eliminando un usuario en coleturia
        Route::delete('FichasPersonales/colecturia/{user}/delete', 'PersonalFileController@colecturiaDestroy')->name('colecturia.destroy');

        // Fichas personales Secretaría
        Route::get('FichasPersonales/secretaria', 'PersonalFileController@secretariaIndex')->name('secretaria.index');
        // Creando usuario secretaría
        Route::get('FichasPersonales/secretaria/crear', 'PersonalFileController@secretariaCreate')->name('secretaria.create');
        Route::post('FichasPersonales/secretaria/crear/adding-user', 'PersonalFileController@colecturiaStore')->name('secretaria.store');
        // Ver usuario
        Route::get('FichasPersonales/secretaria/{user}', 'PersonalFileController@secretariaShow')->name('secretaria.show');
        // Editando un usuario
        Route::get('FichasPersonales/secretaria/{user}/editar', 'PersonalFileController@secretariaEdit')->name('secretaria.edit');
        // Eliminando
        Route::delete('FichasPersonales/secretaria/{user}', 'PersonalFileController@secretariaDestroy')->name('secretaria.destroy');

        // Clients
        Route::resource('clients', 'ClientController');

        // Financiero
        Route::resource('financiero', 'FinancieroController');
        /*
        REPORTES GENERALES
         */
        // reporte por curso
        Route::get('/reportePorCurso', function () {
        })->name('reportePorCursoRuta');
        Route::get('/reportePorCurso/{parcial}', 'GradeController@getScoresReports')->name('reportePorCurso');
        Route::get('/reportePorCurso/p1q1', 'GradeController@getScoresReports')->name('reportePorCurso2');
        // reporte por estudiante
        Route::get('/reportePorEstudiantes', function () {
        })->name('reportePorEstudiantesRuta');
        Route::get('/reportePorEstudiantes/{parcial}', 'GradeController@getStudentsReports')->name('reportePorEstudiantes');
        Route::get('/reportePorEstudiantes/p1q1', 'GradeController@getStudentsReports')->name('reportePorEstudiantes2');
        Route::get('/reportePorEstudiantes-curso/{id}', 'GradeController@getCourseReports')->name("reporteEstudiantesCurso");
        // Otros reportes
        Route::get('/reporte-por-genero', 'PdfController@reportePorGenero')->name('reporteEstudiantesPorGenero');
        Route::get('/reporte-estudiantes-y-representantes', 'PdfController@reporteEstudiantesRepresentante')->name('reporteEstudiantesYRepresentantes');
        Route::get('/reporte-por-genero-curso/{idCurso}', 'PdfController@reportePorGeneroCurso')->name('reporteEstudiantesPorGeneroCurso');
        Route::get('/reporte-estudiantes-y-representantes-curso/{idCurso}', 'PdfController@reporteEstudiantesRepresentanteCurso')->name('reporteEstudiantesYRepresentantesCurso');
        Route::get('/aviso-de-vencimiento/{idEstudiante}', 'PdfController@avisoVencimiento')->name('avisoVencimiento');
        Route::get('/aviso-de-vencimiento-por-curso/{course}', 'PdfController@avisoVencimientoPorCurso')->name('avisoVencimientoPorCurso');
        Route::get('/reporte-estudiantes-cedula/{course}', 'PdfController@reporteEstudiantesCedula')->name('reporteEstudiantesCedula');
        Route::get('/reporte-datos-cas/{course}', 'PdfController@reporteDatosCas')->name('reporteDatosCas');
        Route::get('/reporte-prorroga-por-curso/{course}', 'PdfController@reporteProrrogaPorCurso')->name('reporteProrrogaPorCurso');
        Route::get('/reporte-de-estudiantes-con-beca-curso/{course}', 'PdfController@reporteEstudiantesBecaCurso')->name('reporteEstudiantesBecaCurso');
        Route::get('/reporte-acta-de-calificaciones-atrasadas-por-parcial/{parcial}', "PdfController@reporteCalificacionesAtrasadosPorParcial")->name('reporteCalificacionesAtrasadosPorParcial');
        Route::get('/listado-de-documentos-por-cobro', "PdfController@documentosDeCobro")->name('reporteDocumentosDeCobro');
        // Reporte Acta de control de insumos
        Route::get('/acta-de-control-de-insumos-curso/{course}/{parcial}', 'PdfController@reporteActaDeControlDeInsumosCurso')->name('reporteActaDeControlDeInsumos-curso');
        Route::get('/acta-de-control-de-insumos-docente/{docente}/{parcial}', 'PdfController@reporteActaDeControlDeInsumosDocente')->name('reporteActaDeControlDeInsumos-docente');
        Route::get('/acta-de-control-de-insumos/{materia}/{parcial}', 'PdfController@reporteActaDeControlDeInsumos')->name('reporteActaDeControlDeInsumos');
        Route::get('/archivo1', 'PdfController@archivo1');
        Route::get('/archivo2', 'PdfController@archivo2');
        /*
        COLECTURIA
         */
        Route::get('/colecturia/estudiantes-pagados-por-curso/{idCurso}/{mes}/{tipoPago}', 'ColecturiaController@estudiantesPagadosCurso')->name('estudiantesPagadosCurso');
        Route::get('/colecturia/estudiantes-pendientes-prorroga/{idCurso}/{mes}/{tipoPago}', 'ColecturiaController@estudiantesPendientesProrroga')->name('estudiantesPendientesProrroga');
        Route::get('/colecturia/estudiantes-pendientes/{idCurso}/{mes}/{tipoPago}', 'ColecturiaController@estudiantesPendientes')->name('estudiantesPendientes');
        Route::get('/colecturia/pagos-por-curso/{idCurso}', 'ColecturiaController@pagosPorCurso')->name('pagosPorCurso');
        Route::get('/colecturia/pagos-por-curso-acumulado/{idCurso}', 'ColecturiaController@pagosPorCursoDetallado')->name('pagosPorCursoDetallado');
        Route::get('/colecturia/pagos-por-curso-rubros/{idCurso}', 'ColecturiaController@pagosPorCursoRubro')->name('pagosPorCursoRubros');
        Route::post('/colecturia/reporte-diario', 'ColecturiaController@reporteDiario')->name('reporteDiario');
        Route::post('/colecturia/reporte-diario-general', 'ColecturiaController@reporteDiarioGeneral')->name('reporteDiarioGeneral');
        // reporte por docente
        Route::get('/reportePorDocente/reporte-docentes/{idDocente}', 'PdfController@reportePorDocente')->name('reportePorDocente'); 
        Route::get('/reportePorDocente/hoja-de-vida/{idDocente}', 'PdfController@reportePorDocente')->name('curriculumDocente');
        Route::get('/reportePorDocente/{parcial}', 'GradeController@reportePorDocente');
        Route::get('/reportePorDocente/p1q1', 'GradeController@reportePorDocente')->name('repDocente');
        Route::get('/reportePorDocente', function () {
        })->name('reportePorDocenteRuta');

        /*
        PROVEEDORES
         */
        Route::get('/proveedor/registros', 'ProveedorController@index')->name('proveedor');
        Route::get('/proveedor/registros/crear', 'ProveedorController@crear_proveedor')->name('proveedor_crear');
        Route::get('/proveedor/registros/editar', 'ProveedorController@editar_proveedor')->name('proveedor_editar');
        // Pagos
        Route::get('/proveedor/pagos', 'ProveedorController@pagos')->name('pagos');
        Route::get('/proveedor/pagos/crear', 'ProveedorController@crear_transaccion_pago')->name('crear_transaccion_pago');
        // Retenciones
        Route::get('/proveedor/retenciones', 'ProveedorController@retenciones')->name('retenciones');
        /*
        RETENCIONES
         */
        Route::get('/retenciones/crear', 'ProveedorController@crear_retencion')->name('retencion_crear');
        //Route::post('/retenciones/crear','ProveedorController@store_retencion')->name('retencion_store');
        Route::post('/retenciones/crear', 'ComprobantesElectronicosController@generarRetencion')->name('retencion_store');

        /*
        CONFIGURACIONES
         */
        /*INSTITUCION*/
        //Index
        Route::get('institucionEdicion', 'InstitutionController@edit')->name('institucionEdicion');
        //Rutas para configuracion de datos la institucion
        Route::get('edit', ['as' => 'edit', 'uses' => 'InstitutionController@edit']);
        Route::post('editDatosGenerales', ['as' => 'editDatosGeneralesInstitution', 'uses' => 'InstitutionController@updateDatosGenerales']);
        Route::post('editMisionVision', ['as' => 'editMisionVisionInstitution', 'uses' => 'InstitutionController@updateMisionVision']);
        Route::post('editAntecedentesHistoria', ['as' => 'editMisionHistoriaAntecedentesInstitucion', 'uses' => 'InstitutionController@updateHistoriaAntecedentes']);
        Route::post('editAntecedentesHistoria', ['as' => 'editMisionHistoriaAntecedentesInstitucion', 'uses' => 'InstitutionController@updateHistoriaAntecedentes']);
        Route::post('editWebOficial', ['as' => 'editWebOficialInstitucion', 'uses' => 'InstitutionController@updateWebOficial']);
        Route::post('editRedesSociales', ['as' => 'editRedesSocialeslInstitucion', 'uses' => 'InstitutionController@updateRedesSociales']);
        Route::post('editReportesMinisteriales', ['as' => 'editReportesMinisterialesInstitucion', 'uses' => 'InstitutionController@updateReportesMinisteriales']);

        /*CONFIGURACIONES GENERALES*/
        // representante calificaicones
        Route::get('/configuracionesGenerales', 'ConfiguracionSistemaController@index')->name('configuracionesGenerales');
        Route::get('/configuracionesGenerales/nivel', 'ConfiguracionSistemaController@nivelMaterias')->name('configuracionesGeneralesNivelMaterias');
        Route::post('/configuracionesGenerales', 'ConfiguracionSistemaController@update')->name('actualizarConfiguraciones');

        /*CURSOS*/
        Route::get('cursosEdicion', 'CourseController@edit')->name('cursosEdicion');
        Route::resource('cursosEdicionResources', 'CourseController');

        /*MATERIAS*/
        Route::get('materiasEdicion', 'MatterController@edit')->name('materiasEdicion');
        Route::get('materiasEdicion/editar/{matter}', 'MatterController@getMatter')->name('getMatter');
        Route::get('materiasEdicion/order/{curso}', 'MatterController@getMatterOrder')->name('getMatterOrder');
        Route::put('materiasEdicion/editar/{matter}', 'MatterController@putMatter')->name('updateMatter');
        Route::put('materiasEdicion/order/{curso}', 'MatterController@putMatterOrder')->name('updateMatterOrder');
        Route::delete('materiasEdicion/delete/{matter}', 'MatterController@destroy')->name('deleteMatter');
        Route::post('materiasEdicion/agregar', 'MatterController@postaddMatter')->name('addMatter');

        //route::post('materiasEdicion/agregar/lista','CursosController@GetMatterFlux')->name('getMatterFlux');

        route::get('materiasEdicion-lista', 'CursosController@GetMatterFlux');
        //route::get('materiasEdicion-lista/{id}','CursosController@GetMatterFlux');

        /*Insumos*/
        Route::get('materiasEdicion/editar/insumo/agregar/{matter}', 'SupplyController@getaddInsumo')->name('getaddInsumo');
        Route::post('materiasEdicion/editar/insumo/agregar', 'SupplyController@postaddInsumo')->name('postaddInsumo');
        Route::get('materiasEdicion/editar/insumo/insumo/{supply}', 'SupplyController@showInsumo')->name('showInsumo');
        Route::get('materiasEdicion/editar/insumo/insumo/listado/{matter}', 'SupplyController@showListInsumos')->name('showListInsumos');
        Route::put('materiasEdicion/editar/insumo/{supply}', 'SupplyController@putInsumo')->name('putInsumo');
        Route::get('materiasEdicion/editar/insumo/eliminar/{supply}', 'SupplyController@deleteInsumo')->name('deleteInsumo');
        Route::get('materiasEdicion/editar/insumo/configurar/{eccion}', 'SupplyController@confInsumoSeccion')->name('confInsumoSeccion');
        Route::post('materiasEdicion/editar/insumo/actualizar', 'SupplyController@actInsSeccion')->name('actInsSeccion');
        Route::resource('insumos', 'InsumoController');
        Route::get('/insumos/visualizar/{id}', 'InsumoController@ver')->name('verInsumosGenerales');
        Route::get('/insumos/eliminar/{insumo}', 'InsumoController@deleteInsumo')->name('deleteInsumoG');

        /*ESTRUCTURAS CUALITATIVAS*/
        Route::resource('estructuras', 'EstructuraCualitativaController');
        Route::get('/estructuras/visualizar/{id}', 'EstructuraCualitativaController@ver')->name('verEstructuras');
        Route::get('/estructuras/eliminar/{estructuraCualitativa}', 'EstructuraCualitativaController@deteteEstructura')->name('deteteEstructura');
        Route::get('/estructuras/rangos/{id}', 'EstructuraCualitativaController@verRangos')->name('verRangos');
        Route::post('estructuras/actualizar', 'EstructuraCualitativaController@actualizarR')->name('actualizarRangos');
        Route::get('/estructuras/rangos/delete/{id}', 'EstructuraCualitativaController@deleteRango')->name('deleteRango');

        /*HORARIOS*/
        /*Rutas edicion de horarios*/
        //Route::get('horariosEdicion/', 'ScheduleController@index')->name('horariosEdicion');
        Route::get('horariosEdicion', 'ScheduleController@index')->name('horariosEdicion');
        Route::get('horariosEdicion/asignarcarreraSesion/{idcarrera}', 'ScheduleController@asignarcarreraSesion')->name('asignarcarreraSesion');
        Route::get('horariosCarrera', 'CarrerasController@listaCarrera')->name('horariosCarrera');

        // Route::get('horariosEdicionCurso','ScheduleController@show');
        // Route::post('horariosEdicionCurso', 'ScheduleController@edit')->name('editar_Horario_Curso');
        Route::post('/horariosEdicionCurso', ['uses' => 'ScheduleController@edit', 'as' => 'editar_Horario_Curso']);

        Route::post('editHorarios', 'ScheduleController@saveChanges')->name('editHorariosStore');

        Route::get('horariosEdicion/configuraciones-horario-parcial/{course}/{parcial}', 'ScheduleController@createQuiz')->name('creacionHorarioGeneral');
        Route::get('horariosEdicion/configuraciones-horario-parcial', function () {
        })->name('creacionHorarioParcialJs');
        Route::post('horariosEdicion/configuraciones-horario-parcial/{parcial}', 'ScheduleController@storeQuiz')->name('storeHorarioParcial');
        Route::delete('horariosEdicion/configuraciones-horario-parcial/{course}/{parcial}/{id}', 'ScheduleController@destroy')->name('deleteHorarioParcial');
        /* CONFIGURACIONES PARCIAL*/
        Route::get('/configuraciones/Configuraciones Parcial', 'ParcialController@edit')->name('configuracionesParcial');
        Route::put('/configuraciones/Configuraciones Parcial/Actualizar/{id}', 'ParcialController@update')->name('configuracionesParcialActualizar');

        /* CONFIGURACIONES AREAS */
        Route::get('configuraciones/areas', 'ConfigurationController@areas')->name('configuracionesAreas');
        Route::get('configuraciones/areas/orden/{area}', 'ConfigurationController@orden')->name('ordenAreas');
        Route::put('configuraciones/areas/orden/{area}', 'ConfigurationController@ordenEdit')->name('updateAreaOrder');
        Route::post('configuraciones/areas', 'ConfigurationController@areasPost')->name('configuracionesAreas-post');
        Route::delete('configuraciones/areas/{area}', 'ConfigurationController@areasDelete')->name('configuracionesAreas-delete');
        Route::put('configuraciones/areas/editar/{area}', 'ConfigurationController@areasEdit')->name('configuracionesAreas-edit');

        /* CONFIGURACIONES POR SECCION */
        Route::get('configuraciones/configuraciones-por-seccion', 'ConfigurationController@configSecciones')->name('configuracionesPorSeccion');

        /*
        SIN UBICAR
         */
        //Ver un curso dentro de Agenda
        // Route::get('/cursoAgenda', 'LectionaryController@getCourse')->name('agendaCurso');
        //Ver un curso dentro de Calificaciones
        //Route::get('cursoCalificaciones/{id}', 'ScoreController@getStudentsCourse')->name('calificacionesCurso');
        //Ver un curso dentro de Lista

        /**/
        Route::get('cursoLista', 'GradeController@getListStudents')->name('listaCurso');

        /**
         * PAGOS
         */

        Route::get('/Pagos/{idcarrera}', 'PayController@getCourses')->name('pagosGeneral');
        // Configuración pagos, cuando se quiere reinicar el contador
        Route::post('/reiniciar-contador-factura', 'PayController@reiniciarContadorFactura');

        /*
        LIBROS ADICIONALES
         */
        Route::get('/libros-adicionales', 'AdditionalBookController@index')->name('additionalBook.index');
        Route::post('/libros-adicionales/agregar-libro', 'AdditionalBookController@store')->name('additionalBook.store');
        Route::get('/libros-adicionales/{book}', 'AdditionalBookController@edit')->name('additionalBook.edit');
        Route::put('/libros-adicionales/{book}/update', 'AdditionalBookController@update')->name('additionalBook.update');
        Route::delete('/libros-adicionales/{book}/delete', 'AdditionalBookController@destroy')->name('additionalBook.destroy');

        // Actualización de información de la factura electronica
        Route::get('actualizacion-de-datos-de-facturacion-electronica', 'PayController@facturacionIndex')->name('datos.facturacionElectronica');
        Route::put('actualizacion-de-datos-de-facturacion-electronica/update', 'PayController@facturacionUpdate')->name('datos.facturacionElectronica.update');

        /**
         * Biblioteca Virtual
         * 
         */
        Route::get('/biblioteca-virtual','BibliotecaVirtualController@index')->name('BibliotecaVirtual');
        Route::post('/biblioteca-virtual','BibliotecaVirtualController@store')->name('BibliotecaVirtual');
        Route::get('/biblioteca-virtual/destroy/{id}','BibliotecaVirtualController@destroy')->name('BibliotecaVirtualdestroy');
        Route::post('/biblioteca-virtual/update/{id}','BibliotecaVirtualController@update')->name('BibliotecaVirtualupdate');
        Route::get('/biblioteca-virtual/update/{id}','BibliotecaVirtualController@edit')->name('BibliotecaVirtualupdate');
        /**
         * Secciones para la Biblioteca Virtual
         * 
         */
        Route::post('/biblioteca-seccion','BibliotecaVirtualController@createseccion')->name('BibliotecaSeccion');
        Route::get('/biblioteca-seccion/destroy/{id}','BibliotecaVirtualController@destroyseccion')->name('BibliotecaSecciondestroy');
        Route::post('/biblioteca-seccion/update/{id}','BibliotecaVirtualController@updateseccion')->name('BibliotecaSeccionupdate');
        Route::get('/biblioteca-seccion/update/{id}','BibliotecaVirtualController@editseccion')->name('BibliotecaSeccionupdate');

         /**
        BECAS - DESCUENTOS
        **/
        Route::get('Configuraciones/Becas o Descuentos', 'PayController@BOD')->name('becas');
        //Crear Beca o Descuento
        Route::get('Configuraciones/Becas o Descuentos/Crear', 'PayController@createBOD')->name('crearBOD');
        Route::post('Configuraciones/Becas o Descuentos/Crear', 'PayController@storeBOD')->name('storeBOD');
        //Editar Beca o Descuento
        Route::get('Configuraciones/Becas o Descuentos/Editar/{id}', 'PayController@editBOD')->name('editarBOD');
        Route::put('Configuraciones/Becas o Descuentos/Editar/{id}', 'PayController@updateBOD')->name('updateBOD');
        //Eliminar Beca o Descuento
        Route::delete('/Configuraciones/Eliminar Beca o Descuento/{id}', 'PayController@destroyBOD')->name('eliminarBOD');

        /**
         * Rutas para la seccion de documentos Oscar Cornejo
         * 17/03/2022 
         */
        //Administración
        Route::get('manejoDocumentos','DocumentsController@index')->name('manejoDocumentos');
        Route::get('getTableDocumentation','DocumentsController@getTableDocumentation')->name('getTableDocumentation');
        Route::get('autorizarDocummento/{id}','DocumentsController@autorizarDocumento')->name('autorizarDocummento');
        Route::post('documentoAutorizado','DocumentsController@documentoAutorizado')->name('documentoAutorizado');
        

        Route::get('statusIndex','DocumentsController@statusIndex')->name('statusIndex');
        Route::get('typeDocumentIndex','DocumentsController@typeDocumentIndex')->name('typeDocumentIndex');
        Route::get('getTableStatus','DocumentsController@getTableStatus')->name('getTableStatus');
        Route::get('editStatus/{id}/{sec}/{type}','DocumentsController@editStatus')->name('editStatus');
        Route::get('newStatusDoc','DocumentsController@newStatusDoc')->name('newStatusDoc');
        Route::post('newStatusDoc','DocumentsController@newStatusStoreDoc');
        Route::post('editStatusDoc','DocumentsController@editStatusUpdate')->name('editStatusDoc');
        Route::get('deleteStatus/{id}','DocumentsController@deleteStatus')->name('deleteStatus');
        Route::get('tdCreate','DocumentsController@tdCreate')->name('tdCreate');
        Route::post('tdStore','DocumentsController@tdStore')->name('tdStore');
        Route::get('tdEdit/{id}','DocumentsController@tdEdit')->name('tdEdit');
        Route::post('tdUpdate','DocumentsController@tdUpdate')->name('tdUpdate');
        Route::get('tdDelete/{id}','DocumentsController@tdDelete')->name('tdDelete');
        Route::get('getTableTypeDocument','DocumentsController@getTableTypeDocument')->name('getTableTypeDocument');

        /**
         * Rutas para el modulo de peas
         * @Author Fernando Leon Boada
         */
        Route::group(['prefix' => 'pea'], function (){
            Route::get('/configuracion','ConfigurationController@peasIndex')->name('getPeaIndex');
            Route::post('/add','ConfigurationController@peasStore')->name('setPeaStore');
            Route::post('/delect','ConfigurationController@delectPea')->name('setPeaDelect');
            Route::group(['prefix' => 'view'], function (){
                Route::post('/','ConfigurationController@viewDocumentPEA')->name('indexPeaView');
                Route::post('/edit','ConfigurationController@viewModalPEA')->name('viewEditPEA');
                Route::post('/edit/store','ConfigurationController@editPeaStore')->name('setEditPEA');
                Route::post('/modal','ConfigurationController@viewModalPEA')->name('modalPeaView');
                Route::get('/PDF/{id}','ConfigurationController@downloadDocumentPEA')->name('getPeaView');
            });
        });

    });
    
    Route::get('/carreras', 'CarrerasController@index')->name('carreras');
    Route::post('/grados/materiaInsumo/deber/', 'GradeController@desbloqueoDeTarea')->name('desbloquearTarea');
    Route::post('/grados/materiaInsumo/deber/caducado', 'GradeController@desbloqueoDeTareaCaducado')->name('desbloquearTareaCaducada');

    /**
    Routes Administrador - Colecturia
     **/
    Route::group(['prefix' => 'colecturia', 'middleware' => ['admin-colect']], function () {
        Route::get('pago-por-curso', 'colecturiaReportesController@reportePagoPorCurso');
        Route::get('estudiantes-prorroga', 'colecturiaReportesController@estudiantesProrroga');
        Route::get('estudiantes-pagados-por-curso', 'colecturiaReportesController@estudiantesPagadosPorCurso');
        Route::get('eporte-de-caja', 'colecturiaReportesController@reporteDeCaja');
        Route::post('reporte-deudores-de-pension', 'colecturiaReportesController@reporteDeudoresPorCurso')->name('cuentas_por_cobrar');
        Route::post('reporte-deudores-de-pension-excel', 'ExcelController@reporteDeudoresCursoExcel')->name('cuentas_por_cobrar_excel');
    });

    /**
     * Reporte colecturia
     */
    Route::group([ 'middleware' => ['admin-colect']], function () {
        Route::get('/cuentasporcobrar', 'CuentasporcobrarController@comprobantesC')->name('cuentasporcobrar');
        // Route::get('/', 'CuentasporcobrarController@newpagosC')->name('vernewpagos');
        Route::get('vercomprobantes/', 'CuentasporcobrarController@productos')->name('vercomprobantes');
        Route::POST('prueba/', 'CuentasporcobrarController@mostrarPagos')->name('prueba');
        Route::get('verpagos/', 'CuentasporcobrarController@verpagos')->name('verpagos');
        Route::post('realizarpago/', 'CuentasporcobrarController@realizarPago')->name('realizarpago');
        Route::get('verificacionPago/{id}', 'CuentasporcobrarController@verificacionPago')->name('verificacionPago');
        Route::post('verificacionPagoStore', 'CuentasporcobrarController@verificacionPagoStore')->name('verificacionPagoStore');


        Route::get('filtrar/', 'CuentasporcobrarController@filtrar')->name('filtrar');

        /**
        PAGOS
        **/
        Route::get('/Pagos/factura/resultados_pasarela', 'PayController@recibe_token2')->name('recibeToken2');
        Route::get('/Pagos/Curso/{id}', 'PayController@getCourse')->name('pagosCurso');
        Route::post('/Pagos/factura/{idEstudiante}', 'PayController@factura')->name('NuevaFactura');
        Route::post('/Pagos/factura-multiple/{idEstudiante}', 'PayController@generarFacturas')->name('NuevasFacturas'); //no se esta usando
        Route::post('/Pagos/factura_individual/pagar/', 'PayController@facturaPost')->name('GuardarFactura');
        Route::post('/Pagos/factura_multiple/pagar', 'PayController@facturaMultiplePost')->name('GuardarFacturaMultiple');
        Route::get('/Pagos/historico/{idFactura}', 'PayController@getAbonos')->name('getAbonos');
        Route::get('/Pagos/cliente/{idCliente}', 'PayController@getCliente')->name('getCliente');
        Route::get('/factura/baja/{idFactura}', 'PayController@darBajaFactura')->name('darBajaFactura');
        Route::get('/recibo/baja/{id}', 'PayController@darBajaRecibo')->name('darBajaRecibo');
        Route::get('/Pagos/cliente', function () {
        })->name('urlGetCliente');
        Route::get('/PagosDetalles/baja/{idPagoDetalle}', 'ColecturiaController@eliminarPagoDetalle')->name('BajaPagoDetalle');
        //Listado de pagos a realizar del estudiante
        Route::get('/Pagos/Curso/Estudiante/{id}', 'PayController@getStudent')->name('pagosCursoEstudiante');
        Route::get('/Pagos/Curso/Estudiante', function () {
        })->name('pagosCursoEstudianteJs');
        //Edición del pago a realizar
        Route::get('/Pagos/Curso/Estudiante/Registro de Pago/{id}', 'PaymentRecordController@edit')->name('editarRegistroPagoEstudiante');
        //Historico Estudiante
        Route::get('/Pagos/Curso/Estudiante/Historico de Pagos/{idPago}', 'PaymentStudentController@historico')->name('historicoPagoEstudiante');
        //Descarga de factura
        Route::get('factura-pension/{idPago}/{idEstudiante}', 'FacturaController@invoice')->name('descargarFacturaPago');
        // formato recibo
        Route::get('abono/{id}', 'FacturaController@abono')->name('pdfabono');
        Route::get('recibo/{id}', 'FacturaController@recibo')->name('pdfRecibo');
        Route::get('/recibo-de-pago', 'FacturaController@reciboDePago')->name('factura.reciboDePago');
        Route::get('recibo', function () {
        })->name('urlRecibo');
        Route::get('abono', function () {
        })->name('urlabono');
        //Realizar Pago
        Route::get('/Pagos/Curso/Estudiante/Realizar Pago/{idPago}', 'PaymentStudentController@create')->name('realizarPagoEstudiante');
        Route::post('/Pagos/Curso/Estudiante/Realizar_Pago/{idStudent}/{idPago}', 'PaymentStudentController@store')->name('generarPagoEstudiante');
        Route::post('/prorroga/estudiante', 'PayController@setProrroga')->name('setProrroga');
        Route::get('/prorroga/estudiante', function () {
        })->name('getProrrogaRoute');
        Route::get('/prorroga/estudiante/{idStudent}/{idPago}', 'PayController@getProrroga')->name('getProrroga');
        Route::post('/Pagos/estudiantes-con-beca-100', 'PayController@storeEstudianteBecas100')->name('storeEstudianteBecas100');


         /**
        PAGOS - CONFIGURACIONES
        **/
        Route::get('/pagos/carreras', 'PayController@listarCarrerasPagos')->name('listarCarrerasPagos');

        //Configuraciones
        Route::get('/Configuraciones/Pagos', 'PayController@index')->name('configuracionesPagos');
        //Crear Pago
        Route::get('/Configuraciones/Pagos/Crear Pago/{id}', 'PayController@create')->name('configuraciones_CrearPago');
        Route::post('/Configuraciones/Pagos/Crear Pago/{id}', 'PayController@store')->name('configuraciones_CrearPagoEnviar');
        //Editar Pago
        Route::get('/Configuraciones/Pagos/Editar Pago/{id}', 'PayController@edit')->name('configuraciones_EditarPago');
        Route::put('/Configuraciones/Pagos/Editar Pago/{id}', 'PayController@update')->name('configuraciones_ActualizarPago');
        //Eliminar Pago
        Route::delete('/Configuraciones/Eliminar Pago/{id}', 'PayController@destroy')->name('configuraciones_EliminarPago');

        // Crear Rubro
        Route::post('/Configuraciones/Pagos/crear-rubro', 'PayController@rubroStore')->name('rubro.store');
        // Ver Rubro
        Route::get('/Configuraciones/Pagos/rubro/{rubro}', 'PayController@rubroShow')->name('rubro.show');
        // Eliminar Rubro
        Route::delete('/Configuraciones/Pagos/{rubro}/delete', 'PayController@rubroDestroy')->name('rubro.destroy');

        /**
         * PAGOS DE FORMA MANUAL
         */
        Route::get('pagoEstudianteManual/{id}','PaymentController@pagoEstudianteManualCreate')->name('pagoEstudianteManual');
        Route::post('pagoEstudianteManualProcesado','PaymentController@pagoEstudianteManualStore')->name('pagoEstudianteManualProcesado');
        Route::get('cancelarPago/{id}','PaymentController@cancelarPago')->name('cancelarPago');

        //ELIMINAR PAGO DEL ESTUDIANTE
        Route::post('/cuentasporcobrar/colecturia/eliminar-pago','CuentasporcobrarController@destroyPayStudent')->name('destroyPayStudente');
        //CREAR PAGO DEL ESTUDIANTE
        Route::post('/cuentasporcobrar/colecturia/crear-pago','PayController@crearCuotasColecturia')->name('StorePayStudente');
    });


    /**
    Routes Docentes
     **/
    Route::group(['middleware' => ['docentes']], function () { 
        Route::delete('deleteActivityAdmin', 'GradeController@destroy')->name('deleteActivityAdmin');
        Route::get('/grados/materia/Insumo/Actividades/showActividad/{actividad}/{course}/{materia}/{accion}', 'GradeController@showActivity')->name('getActividadAdmin');
        Route::get('/recuperaciones/{idCurso}/{idMateria}/{idCiclo}/{parcial}', 'GradeController@recuperaciones')->name('recuperacionesAdmin');

        Route::get('/grados/agenda/carrera/{idcarrera}', 'GradeController@getLectionary')->name('grade_agenda_carrera'); //cambiar

        Route::get('horarios', 'ScheduleController@schedules')->name('horario_Escolar');

        Route::get('/grados/lista', 'GradeController@getList')->name('grade_lista');

        Route::get('/reporte-por-genero', 'PdfController@reportePorGenero')->name('reporteEstudiantesPorGenero');
       
        Route::get('/reporte-por-genero-curso/{idCurso}', 'PdfController@reportePorGeneroCurso')->name('reporteEstudiantesPorGeneroCurso');
        Route::get('/grados/lista/{idCurso}', 'GradeController@gradoLista')->name('gradoLista-dowload');

        Route::get('/grados/materiaInsumo/{idMateria}/{idInsumo}/{parcial}', 'GradeController@materiaInsumo')->name('verInsumoAdmin');
        Route::post('/grados/materiaInsumo/Actividades/{idMateria}/{idInsumo}/{parcial}', 'GradeController@storemateriaInsumo')->name('addActividadAdmin');
        Route::get('/grados/materiaInsumo/Actividades/refuerzo/{idInsumo}/{parcial}', 'GradeController@activarRefuerzoAcademico')->name('ActivarRefuerzoAcademico');
        Route::get('/grados/materiaInsumo/Actividades/refuerzo/desactivar/{idInsumo}/{parcial}', 'GradeController@desactivarRefuerzoAcademico')->name('DesactivarRefuerzoAcademico');
        
        //---------------------------------//
        Route::get('/grados/calificaciones', 'GradeController@getScores')->name('grade_score');
        Route::get('/grados/calificaciones/curso/{id}/{parcial?}', 'GradeController@getScoresCourse')->name('grade_score_course');
        Route::get('/grados/calificaciones/curso/materia/{id}/{parcial}', 'GradeController@getScoresCourseMatter')->name('InsumosAdmin');
        Route::post('/grados/calificaciones/{activity}/{student}', 'GradeController@updateCalificaciones')->name('calificacionesUpdateAdmin');
        Route::get('/grados/calificaciones/curso/', function () {
        })->name('promedioCurso');
        Route::get('/grados/calificaciones/curso/materia/', function () {
        })->name('grade_score_course_matter');
        Route::get('grados/Calificaciones/Curso/Materia/{id}', 'ScoreController@ingreso')->name('ingresoMateria');

        /* Reporte de Comportamiento - Index*/
        Route::get('grados/Calificaciones/Curso/Comportamiento/{id}', 'ComportamientoController@getCourse')->name('reporteComportamientoCurso');
        /* Reporte de Comportamiento - Editar Estudiante*/
        Route::get('grados/Calificaciones/Curso/Comportamiento/Estudiante-Edicion/{id}/{parcial}', 'ComportamientoController@editStudent')->name('comportamientoEdit');
        Route::get('grados/Calificaciones/Curso/Comportamiento/Estudiante-Edicion/{id}', function () {
        })->name('RutaComportamientoEdit');
        /* Reporte de Comportamiento - Actualizar Estudiante*/
        Route::put('grados/Calificaciones/Curso/Comportamiento/Estudiante/Actualizar/{id}', 'ComportamientoController@updateStudent')->name('comportamientoUpdate');

        Route::get('/asistencia/reporte-asistencia-anual/{course}', 'AssistanceController@reporteAsistenciaCursoAnual')->name('reporteAsistenciaCursoAnual');

        Route::get('/asistencia/Reporte-Curso/{course}/{parcial}', 'AssistanceController@getAsistenciaReporte')->name('asistenciaReporteCurso');

        /*eliminar tarea docente*/
        Route::delete('deleteActivityDocente', 'GradeController@destroy')->name('deleteActivityDocente');

        /* Cursos */
        Route::get('/docente/cursosDocente', 'GradeController@getDocenteHome')->name('cursosDocente');
        Route::get('/docente/cursoDocente/Curso/{id}', 'GradeController@getDocenteCourse')->name('cursos_Docente');

        // MODIFICAR PROMEDIO DE LAS MATERIAS

        Route::post('/docente/materia/promedio/', 'GradeController@promedio')->name('Promedios');

        /* Horarios */
        Route::get('/docente/horarios', 'TeacherScheduleController@homev2')->name('horario_Docente');

        Route::get('horarios/crear/{id}', 'TeacherScheduleController@create')->name('crearHora');
        Route::post('docente/horarios/crear', 'TeacherScheduleController@store')->name('crearHora2');

        Route::get('/docente/horarios/{id}', 'TeacherScheduleController@edit')->name('editarHoraClaseDocente');
        Route::put('/docente/horarios/actualizar/{id}', 'TeacherScheduleController@update')->name('actualizarHoraClaseDocente');

        Route::delete('/docente/horarios/eliminar/{id}', 'TeacherScheduleController@destroy')->name('eliminarHoraClaseDocente');

        /*
        PLANIFICACIONES DOCENTE
         */
        Route::get('/docente/planificaciones', 'planificacionesController@index_D');
        Route::get('/docente/planificaciones/materia', 'planificacionesController@materias_D');
        Route::get('/docente/planificaciones/materia/documento', 'planificacionesController@documento_D');
        /**
         * PLANIFICACIONES TUTOR
         */
        Route::get('/tutor-planificaciones', 'planificacionesController@home_Tutor');
        /*
        CRONOGRAMA
         */
        Route::get('/docente/cronograma', 'CronogramaController@docenteIndex')->name('cronograma_index');
        /*
        DHI
         */
        Route::get('docente/dhi/{parcial}', 'DHIController@docenteIndex')->name('dhiDocente');
        Route::get('docente/dhi/', function () {
        })->name('dhiDocente-js');
        Route::get('docente/dhi/{parcial}/{course}', 'DHIController@curso')->name('dhiCurso');
        Route::post('docente/dhi/{parcial}/{course}', 'DHIController@storeParcial')->name('dhi.store.parcial');
        /*

        /**
         * ASISTENCIA DIARIA
         */

        // Route::get('/agenda Docente',function(){})->name('agenda_Docente_ruta');
        //Ruta Crear hora Clase
        Route::get('/agenda/Crear Clase/{id}', 'LectionaryController@crearHora')->name('agenda_Docente_crearHora');
        Route::post('/agenda/CrearHora Clase/{id}', 'LectionaryController@storeHora')->name('agenda_Docente_storeHora');
        //Ruta Editar hora Clase
        Route::get('/agenda/Editar Hora Clase/{id}', 'LectionaryController@editHora')->name('agenda_Docente_editHora');
        Route::put('/agenda/Actualizar Hora Clase/{id}', 'LectionaryController@updateHora')->name('agenda_Docente_updateHora');
        //Ruta Eliminar hora Clase
        Route::delete('agenda/Eliminar Hora Clase/{id}', 'LectionaryController@deleteHora')->name('agenda_Docente_deleteHora');
        // Observacion a estudiantes
        Route::post('agenda/agregar-observacion/{actividad}', 'LectionaryController@storeObservacion')->name('agenda_Docente_storeObservacion');
        Route::put('agenda/agregar-observacion/{observacion}/update', 'LectionaryController@updateObservacion')->name('agenda_Docente_updateObservacion');
        Route::delete('agenda/agregar-observacion/{observacion}/delete', 'LectionaryController@destroyObservacion')->name('agenda_Docente_destroyObservacion');
        // Reporte agenda
        Route::get('/agenda/reporte-del-dia/{docente}', 'LectionaryController@reporteDiarioDocente')->name('agenda-escolar-reporteDiario-docente');

        /*
        CALIFICACIONES
         */
        // Route::get('/d-examen-quimestral', function() {
        //     return view('UsersViews.docente.calificaciones.examen-quimestral');
        // });
        // Route::get('/d-recuperaciones', function() {
        //     return view('UsersViews.docente.calificaciones.d-recuperaciones');
        // });
        Route::get('/d-recuperaciones/{idCurso}/{idMateria}', 'ScoreController@recuperaciones')->name('recuperacionesDocente');
        Route::get('/docente/examen-quimestral/{materia}/{quimestre}', 'ScoreController@examenQuimestral')->name('examenQuimestralD');
        Route::get('/docente/examen-quimestral/{materia}', function () {
        })->name('examenQuimestralDocente');

        Route::get('/docente/calificaciones/{parcial}', 'ScoreController@getCalificaciones')->name('calificaciones');
        Route::get('/docente/calificaciones/actaGlobal/{id}', 'PdfController@actaGlobal')->name('actaGlobal');
        Route::get('/docente/calificaciones/reporteActa/{id}/{ciclo}', 'PdfController@reporteActaCalificacion')->name('reporteActaCalificacion');
        Route::post('/docente/materiaInsumo/promedio/{idInsumo}', 'ScoreController@promedioInsumo');
        Route::get('/docente/materiaInsumo/Actividades/refuerzo/{idInsumo}/{parcial}', 'ScoreController@activarRefuerzoAcademico')->name('ActivarRefuerzoAcademicoDocente');
        Route::get('/docente/materiaInsumo/Actividades/refuerzo/desactivar/{idInsumo}/{parcial}', 'ScoreController@desactivarRefuerzoAcademico')->name('DesactivarRefuerzoAcademicoDocente');

        Route::get('/docente/calificaciones/', function () {
        })->name('calificacionesJs');
        Route::get('/docente/materiaInsumo/promedio/', function () {
        })->name('promedioInsumo');
        Route::get('/docente/materiaInsumo/Actividades/', function () {
        })->name('ActividadesDocente');
        Route::get('/docente/materia/promedio/', function () {
        })->name('guardarPromedios');
        Route::get('/docente/materiaInsumo', function () {
        })->name('DocentesInsumo');

        Route::get('/docente/verMateria/{idMateria}/{parcial}', 'ScoreController@materia')->name('MateriasDocente'); //
        Route::get('/docente/verMateria/', function () {
        })->name('verMateria');
        Route::get('/docente/materiaInsumo/{idMateria}/{idInsumo}/{parcial}', 'ScoreController@materiaInsumo')->name('verInsumo');

        Route::post('/docente/materiaInsumo/Actividades/{idMateria}/{idInsumo}/{parcial}', 'ScoreController@storemateriaInsumo')->name('addActividad');
        Route::get('/docente/materia/Insumo/Actividades/showActividad/{actividad}/{idCurso}/{idMateria}/{accion}', 'ScoreController@showActivity')->name('getActividad');
        /**
         * COMPORTAMIENTO
         */
        Route::get('docente/comportamiento', 'ComportamientoController@docenteHome')->name('comportamiento_docente');
        Route::get('docente/comportamiento/estudiante/{idCourse}/{idMateria}/{parcial}', 'ComportamientoController@docenteEstudiante')->name('comportamiento_docente-estudiante');
        Route::get('docente/comportamiento/estudiante', function () {
        })->name('comportamiento_docente-estudiante-js');
        Route::get('docente/comportamiento/estudiante/materia/{idCourse}/{idMateria}/{parcial}/{idStudent}', 'ComportamientoController@docenteMateria')->name('comportamiento_docente-materia');
        Route::get('docente/comportamiento/estudiante/materia', function () {
        })->name('comportamiento_docente-materia-js');
        Route::post('docente/comportamiento/estudiante/materia/{idCourse}/{idMateria}/{parcial}/{idStudent}', 'ComportamientoController@docenteStore')->name('comportamiento_docente-materia-store');
        Route::put('docente/comportamiento/estudiante/materia/{idCourse}/{idMateria}/{parcial}/{idStudent}', 'ComportamientoController@docenteUpdate')->name('comportamiento_docente-materia-update');
        /* Destrezas */

        // Route::get('/docente/verMateria/{idMateria}/destrezas','DestrezaController@index')->name('destrezas');
        // Route::get('/docente/verMateria/Crear Destrezas','DestrezaController@createDestrezas')->name('createDestrezas');
        //Eliminar Actividad
        //
        // Route::post('deleteActivityMateria',
        // ['as' => 'deleteActivity', 'uses' => 'ScoreController@destroy']);
        Route::delete('deleteActivity', 'ScoreController@destroy')->name('deleteActivity');
        Route::post('/docente/materiaInsumo/Actividades/updateActividad', 'ScoreController@updateActivity')->name('updateActividad');
        Route::post('/docente/calificaciones/{activity}/{student}', 'ScoreController@updateCalificaciones')->name('calificacionesUpdate');

        Route::post('/docente/materiaInsumo/Actividades/Adjuntos/CrearAdjunto/Nuevo', 'ScoreController@stroreTempFiles')->name('tempAdjuntos');
        Route::post('/docente/materiaInsumo/Actividades/Adjuntos/EliminarAdjunto/{idActividad}', 'ScoreController@deleteFiles')->name('DeleteAdjuntos');
        Route::post('/docente/materiaInsumo/Actividades/Adjuntos/ActualizarAdjunto/{idActividad}', 'ScoreController@updateFiles')->name('updateAdjuntos');

        /*
        Destrezas
         */
        //Index
        Route::get('/docente/Destrezas', 'DestrezaController@home')->name('destrezas');
        Route::get('/docente/materias/', 'DestrezaController@getSubjects')->name('materias');

        // Progreso Formativo
        Route::get('/docente/observaciones-aulicas/ver/{docente}', 'observacionesAulicasDocenteController@show')->name('aulicasDocente.show');
        //Crear Destreza Index
        Route::get('/docente/Crear Destrezas', 'DestrezaController@crear')->name('crearDestreza');
        Route::post('/docente/Crear Destrezas/store', 'DestrezaController@store')->name('crearDestrezaDocente');

        /* Mostrar destrezas por materia*/
        Route::get('/docente/Destrezas/{idMateria}/{parcial}', 'DestrezaController@showDestrezas')->name('showDestrezasMateria');

        /*Editar destreza*/
        Route::get('/docente/Destrezas/{idDestreza}/{parcial}/Editar Destreza', 'DestrezaController@editar')->name('editDestreza');
        Route::get('/docente/Destrezas/{idDestreza}/{parcial}/actualizar Destreza', 'DestrezaController@editar_js')->name('editDestreza_js');
        Route::get('/docente/Destrezas/materias', 'DestrezaController@getSubjects')->name('MATERIASDESTREZA');
        Route::put('/docente/Destrezas/update', 'DestrezaController@update')->name('updateDestrezas');

        /*Eliminar Destrezas*/
        Route::delete('/docente/Destrezas/{idDestreza}/{parcial}/delete', 'DestrezaController@destroy')->name('deleteDestrezas');
        /*quitar enlace*/
        Route::delete('/docente/Destrezas/{idDestreza}/{parcial}/enlace', 'DestrezaController@enlace')->name('deleteEnlace');

        /*Clase Destreza*/
        Route::post('/docente/Crear Clase', 'DestrezaController@crearClaseDestreza')->name('crearClaseDestreza');
        Route::post('/docente/Destrezas/claseDestreza', 'DestrezaController@updateClaseDestreza')->name('updateClaseDestreza');
        Route::get('/docente/Destrezas/{idMateria}/{parcial}/{idDestreza}', 'DestrezaController@showClaseDestrezas')->name('showClaseDestrezasMateria');
        Route::delete('/docente/Destrezas/deleteClaseDestreza', 'DestrezaController@destroyClaseDestreza')->name('deleteClaseDestreza');
        //creada para el reporte de calificacion cualitativa quimestral
        Route::post('/docente/Destrezas/CalificacionCualitativaQ', 'DestrezaController@CalificacionQuimestral')->name('CalificacionCualitativaQuimestral');

        /*
        Tutoría
         */
        //Informacion
        Route::get('/Tutoria/Informacion/{id}', 'CourseController@getTutoria')->name('tutoria_Informacion');
        //Agenda Escolar
        Route::get('/Tutoria/Agenda/{id}', 'CourseController@getAgenda')->name('tutoria_Agenda');
        //Asistencia
        Route::get('/Tutoria/Asistencia/{id}/{parcial}', 'CourseController@getAsistencia')->name('tutoria_Asistencia');
        //Calificaciones
        Route::get('/Tutoria/Calificaciones/{id}', 'CourseController@getCalificaciones')->name('tutoria_Calificacioness');
        //Estadisticas
        Route::get('/Tutoria/Estadísticas/{id}', 'CourseController@getEstadisticas')->name('tutoria_Estadisticas');
        //Libreta
        Route::get('/Tutoria/Libreta/{course}/{parcial}', 'CourseController@getLibreta')->name('tutoria_Libreta');
        Route::get('/Tutoria/Libreta', function () {
        })->name('tutoria_Libreta_ruta');
        /**
         * COMPORTAMIENTO TUTORIA
         */

        Route::get('tutor/comportamiento/{idCurso}/{parcial}', 'ComportamientoController@tutorHome')->name('tutor-comportamiento');
        Route::get('tutor/comportamiento', function () {
        })->name('tutor-comportamiento-js');
        Route::get('tutor/comportamiento/{idCurso}/{parcial}/{idEstudiante}', 'ComportamientoController@tutorEstudiante')->name('tutor-comportamiento-estudiante');
        Route::post('tutor/comportamiento/{idCurso}/{parcial}/{idEstudiante}', 'ComportamientoController@tutorStore')->name('tutor-comportamiento-store');
        Route::put('tutor/comportamiento/{idCurso}/{parcial}/{idEstudiante}', 'ComportamientoController@tutorUpdate')->name('tutor-comportamiento-update');

        /** Libros Adicionales */
        Route::get('docente/libros-adicionales', 'AdditionalBookController@indexDoc')->name('additionalBook.index.doc');

        /** Reporte Cotejo*/
        Route::get('docente/lista-de-cotejo/{materia}/{parcial}', 'ListaCotejoController@index')->name('lista.cotejo');

        /** Reporte de insumos */
        Route::get('docente/reporte-de-insumos/{docente}/{parcial}', 'PdfController@reporteInsumos')->name('reporteInsumo');

        /* SYLLABUS VISTAS */
        Route::get('/syllabus', 'SyllabusController@index')->name('syllabus');
        Route::get('/crearSyllabus/{id}', 'SyllabusController@store')->name('crearSyllabus');
        Route::get('/eliminarSyllabus/{id}', 'SyllabusController@destroy')->name('eliminarSyllabus');
        Route::get('/eliminarSoloSyllabus/{id}', 'SyllabusController@destroyOnlySyllabus')->name('eliminarSoloSyllabus');

        Route::get('/syllabus/modificarSyllabus/{id}', 'SyllabusController@show')->name('modificarSyllabus');

        Route::get('/syllabus/informacionGeneral/{id}', 'InformacionController@index')->name('informacionGeneral');
        Route::post('/syllabus/informacionGeneral/{id}', 'InformacionController@store')->name('storeInformacionGeneral');
        Route::get('/syllabus/editInformacionGeneral/{id}', 'InformacionController@show')->name('editInformacionGeneral');
        Route::post('/syllabus/editInformacionGeneral/{id}', 'InformacionController@update')->name('updateInformacionGeneral');

        Route::get('/syllabus/prerequisitos-corequisitos/{id}', 'PreCoRequisitosController@index')->name('prerequisitosSyllabus');
        Route::post('/syllabus/prerequisitos-corequisitos/{id}', 'PreCoRequisitosController@store')->name('storePrerequisitosSyllabus');
        Route::get('/syllabus/editPrerequisitos-corequisitos/{id}', 'PreCoRequisitosController@show')->name('editPrerequisitosSyllabus');
        Route::post('/syllabus/editPrerequisitos-corequisitos/{id}', 'PreCoRequisitosController@update')->name('updatePrerequisitosSyllabus');

        Route::get('/syllabus/descripcionGeneral/{id}', 'DescripcionSyllabusController@index')->name('descripcionSyllabus');
        Route::post('/syllabus/descripcionGeneral/{id}', 'DescripcionSyllabusController@store')->name('storeDescripcionSyllabus');
        Route::get('/syllabus/editDescripcionGeneral/{id}', 'DescripcionSyllabusController@show')->name('editDescripcionSyllabus');
        Route::post('/syllabus/editDescripcionGeneral/{id}', 'DescripcionSyllabusController@update')->name('updateDescripcionSyllabus');

        Route::get('/syllabus/crearUnidad/{id}', 'UnidadController@index')->name('unidadSyllabus');
        Route::post('/syllabus/crearUnidad/{id}', 'UnidadController@store')->name('storeUnidadSyllabus');
        Route::get('/syllabus/editUnidad/{id}', 'UnidadController@edit')->name('editUnidadSyllabus');
        Route::post('/syllabus/editUnidad/{id}', 'UnidadController@update')->name('updateUnidadSyllabus');

        Route::get('/syllabus/modificarUnidad/{id}', 'UnidadController@indexDos')->name('modificarUnidadSyllabus');
        Route::get('/syllabus/editarDosUnidad/{id}', 'UnidadController@editDos')->name('editDosUnidadSyllabus');
        Route::post('/syllabus/editarDosUnidad/{id}', 'UnidadController@updateDos')->name('updateDosUnidadSyllabus');

        Route::get('/syllabus/crearUnidad/crearContenido/{id}', 'ContenidoController@index')->name('contenidoUnidad');
        Route::post('/syllabus/crearUnidad/crearContenido/{id}', 'ContenidoController@store')->name('storeContenidoUnidad');
        Route::get('/syllabus/editarContenido/{id}', 'ContenidoController@edit')->name('editContenidoUnidad');
        Route::post('/syllabus/editarContenido/{id}', 'ContenidoController@update')->name('updateContenidoUnidad');

        Route::get('/syllabus/modificarContenido/{id}', 'ContenidoController@indexDos')->name('modificarContenidoUnidad');
        Route::get('/syllabus/editarDosContenido/{id}', 'ContenidoController@editDos')->name('editDosContenidoUnidad');
        Route::post('/syllabus/editarDosContenido/{id}', 'ContenidoController@updateDos')->name('updateDosContenidoUnidad');

        Route::get('/syllabus/crearPerfil/{id}', 'PerfilEgresoController@index')->name('perfilUnidad');
        Route::post('/syllabus/crearPerfil/', 'PerfilEgresoController@store')->name('storePerfilUnidad');
        Route::get('/syllabus/editarPerfil/{id}', 'PerfilEgresoController@edit')->name('editPerfilUnidad');
        Route::post('/syllabus/editarPerfil/{id}', 'PerfilEgresoController@update')->name('updatePerfilUnidad');

        Route::get('/syllabus/referenciasApa/{id}', 'ReferenciaApaController@index')->name('referenciaApa');
        Route::post('/syllabus/referenciasApa/{id}', 'ReferenciaApaController@store')->name('storeReferenciaApa');
        Route::get('/syllabus/editReferenciasApa/{id}', 'ReferenciaApaController@edit')->name('editReferenciaApa');
        Route::post('/syllabus/editReferenciasApa/{id}', 'ReferenciaApaController@update')->name('updateReferenciaApa');


        Route::get('/reporteSyllabus/{id}', 'PdfController@reporteSyllabus')->name('reporteSyllabus');
    });

    /**
        Routes Representantes
     **/
    Route::group(['middleware' => ['representative']], function () {
        // notificaciones
        Route::get('/Representante/notificacionesEnviar', function () {
            $cs = App\MessageDetail::getMessagesBySender(Sentinel::getUser()->id)->count();
            $cm = App\MessageDetail::getMessagesByReciever(Sentinel::getUser()->id)->count();
            $courses = App\Course::getAllCourses();
            $adjunto = App\ConfiguracionSistema::adjuntoRepresentante();
            return view(
                'UsersViews.representante.notificaciones.enviar',
                ['courses' => $courses, 'countSend' => $cs, 'countMessages' => $cm, 'adjunto' => $adjunto]
            );
        })->name("notificacionesEnviarRepresentante");

        /*HIJO*/
        Route::get('/Representante/Alumno/{hijo}', 'RepresentativeController@getChildren')->name('hijo');
        //Agenda Escolar
        Route::get('/Representante/Agenda Escolar/hijo/{hijo}', 'RepresentativeController@getLectionaryChildern')->name('hijo_agenda');
        Route::get('/Representante/agenda-semanal/hijo/{hijo}', 'RepresentativeController@agendaSemanal')->name('hijo_agenda.semanal');

        //Horario de Clases
        Route::get('/Representante/Horario de Clases/hijo/{hijo}/{parcial}', 'RepresentativeController@getSchedulerChildern')->name('hijo_horario');
        Route::get('/Representante/Horario de Clases/hijo/', function () {
        })->name('hijo_horarioJs');
        //Asistencia
        Route::get('Representante/Asistencia Estudiantil/hijo/{hijo}', 'RepresentativeController@getAsistenciaChildern')->name('asistenciaR');
        //Tareas
        Route::get('Representante/Tareas/hijo/tarea/{activity}/{matter}/{supply}', 'RepresentativeController@getTareaHijo')->name('tareaHijo');
        Route::get('Representante/Tareas/hijo/{hijo}/{parcial}', 'RepresentativeController@getTareasChildren')->name('tareasR');
        Route::get('Representante/Tareas/hijo/', function () {
        })->name('tareasRuta');
        Route::get('Representante/Calificaciones/hijo/{hijo}/{parcial}', 'RepresentativeController@getScoreChildren')->name('calificacionesR');
        Route::get('Representante/Calificaciones/hijo/', function () {
        })->name('calificacionesRepresentante');
        Route::get('Representante/Hijo/Tareas/{id}', 'RepresentativeController@getTareaRepresentante')->name('verActividadRepresentante');
        Route::get('Representante/Hijo/configuracion/{id}', 'RepresentativeController@configuracionHijo')->name('configuracionesRepresentante');
        Route::put('Representante/Hijo/configuracion/{id}', 'RepresentativeController@postConfiguracionHijo')->name('hijo_update');

        //Encuesta
        Route::get('representante/encuesta', 'EncuestaController@index')->name('representante.encuesta.index');
        //Agenda Pasada
        Route::post('Representante/Agenda Anterior/{id}', 'RepresentativeController@getAgendaPasada')->name('agendaPasada');
        //Cambiar Fecha Agenda
        Route::get('Representante/Agenda/{id}', 'RepresentativeController@getCambiarFecha')->name('cambiarAgenda');

        // Detalles de Insumo
        Route::get('/insumo-detalles/{alumno}/{insumo}/{parcial}', 'RepresentativeController@getTareasInsumoChildren')->name('insumoDetallesRepresentante');

        /** Libros Adicionales */
        Route::get('representante/libros-adicionales', 'AdditionalBookController@indexRep')->name('additionalBook.index.rep');
        Route::post('presentante/pasar-de-periodo-lectivo/{student}', 'MatriculaController@pasarDePeriodoLectivo')->name('pasarDePeriodoLectivoHijo');
        /*
        CRONOGRAMA
        */
        Route::get('representante/cronograma', 'CronogramaController@representanteIndex')->name('cronogramaRep');

        /**
         * PAGOS
         */

        Route::get('Representante/Alumno/{hijo}/pago', 'representantePagosController@index')->name('representantePagos');
        Route::get('Representante/Alumno/{hijo}/pendientes', 'representantePagosController@pendientes')->name('representantePagosPendientes');

    });

    /*
    Rutas Estudiante
     */
    Route::group(['middleware' => ['student']], function () {

        /*
        AGENDA ESCOLAR
         */
        Route::get('/Agenda Escolar', 'StudentController@getLectionary')->name('agendaEstudiante');
        Route::get('/Agenda-Semanal', 'StudentController@agendaSemanal')->name('agendaEstudiante.semanal');
        Route::post('/Agenda Anterior', 'StudentController@getAgendaPasadaStudent')->name('agendaPasadaStudent');

        //Existe o no ???
        Route::get('/Datos Escolares', 'StudentController@getChildren');

        /*
        CRONOGRAMA
         */
        Route::get('estudiante/cronograma', 'CronogramaController@estudianteIndex')->name('cronogramaEstudiante');
        /*
        CALIFICACIONES
         */
        Route::get('/Calificaciones Estudiante/{parcial}', 'StudentController@calificaciones')->name('calificacionesEstudiante');
        Route::get('/Calificaciones Estudiante', function () {
        })->name('rutaCalificacion');

        /*
        MI PERFIL
         */
        //Es una vista general
        //NO eliminar esta ruta
        Route::get('/perfilE', function () {
            return view('UsersViews.estudiante.perfil2');
        });

        /*
        HORARIO
         */
        Route::get('/Horario Escolar/{parcial}', 'CourseScheduleController@getCourseScheduler')->name('horarioEscolarEstudiante');

        /*
        Encuesta
         */
        Route::get('estudiante/encuesta', 'EncuestaController@index')->name('estudiante.encuesta.index');
        /*
        CALIFICACIONES-No usadas
         */
        //NO eliminar, hay duda si se lo usa
        Route::get('/calificacionesE', function () {
            return view('UsersViews.estudiante.calificaciones.calificaciones');
        });
        Route::get('/calificacionesMateria', function () {
            return view('UsersViews.estudiante.calificaciones.calificacionesMateria');
        });
        Route::get('/calificacionesq1E', function () {
            return view('UsersViews.estudiante.calificaciones.calificacionesq1');
        });
        Route::get('/calificacionesq2E', function () {
            return view('UsersViews.estudiante.calificaciones.calificacionesq2');
        });
        Route::get('/sabanaE', function () {
            return view('UsersViews.estudiante.calificaciones.sabana');
        });

        // NOTIFICACIONES
        Route::get('/Estudiante/notificaciones', 'NotificationController@homeEstudiante')->name('notificacionesEstudiante');
        Route::get('/Estudiante/notificaciones/enviar', 'NotificationController@notificacionesEnviarEstudiante')->name("notificacionesEnviarEstudiante");
        Route::get('/Estudiante/notificaciones/enviados', 'NotificationController@notificacionesEstudianteEnviados')->name("notificacionesEstudianteEnviados");
        Route::post('/Estudiante/notificaciones/enviados/delete/{message}', 'NotificationController@eliminarEnviadosE')->name("eliminarEnviadosE");
        Route::post('/Estudiante/notificaciones/recibidos/delete/{message}', 'NotificationController@eliminarRecibidosE')->name("eliminarRecibidosE");
        Route::get('/Estudiante/notificaciones/{notificacion}', 'NotificationController@notificacionesVerEstudiante')->name("notificacionesVerEstudiante");
        Route::get('/Estudiante/notificaciones/enviados/{notificacion}', 'NotificationController@notificacionesVerEnviadosEstudiante')->name("notificacionesVerEnviadosEstudiante");
        /*
        TAREAS
         */
        //Se la usará, no eliminar esta ruta
        // Route::get('/tareasE', function () {
        //     return view('UsersViews.estudiante.tareas.tareas');
        // })->name('TareasEstudiante');

        Route::get('/tareasE/{hijo}/{parcial}/', 'StudentController@getTareas')->name('TareasEstudiante');
        Route::get('/tareasE', function () {
        })->name('tareasEstudianteRuta');
        Route::post('/tareasE', 'StudentController@subirTareas')->name('subirTareas');
        Route::get('/estudiante/tarea/{activity}/{matter}/{supply}', 'StudentController@tareaEstudiante')->name('tareaEstudiante');
        /*
        INSTITUCION
         */
        //Es una vista general

        /*
        CALENDARIO ACADEMICO
         */

        // Detalles de Insumo
        Route::get('Estudiante/insumo-detalles/{alumno}/{insumo}/{parcial}', 'RepresentativeController@getTareasInsumoChildren')->name('insumoDetalles');
        /** Libros Adicionales */
        Route::get('estudiante/libros-adicionales', 'AdditionalBookController@indexEst')->name('additionalBook.index.est');

        /**
        PAGOS
        **/
        Route::put('Pagos/Curso/Estudiante/Actualizacion de Pago/{id}', 'PaymentRecordController@update')->name('actualizarRegistroPagoEstudiante');
        Route::get('/configuracionesPagos', function () {
            return view('UsersViews.administrador.configuracionesPagos');
        });
        // pago estudiante (realizando el pago)
        Route::get('/pagosEstudiante-pago', function () {
            return view('UsersViews.colecturia.pagos.pagosEstudiante-pago');
        });
         /**
         * Rutas de seccion pagos Oscar Cornejo
         * 10/03/2022 -> Se manejara:
         * - Creación de las vistas de pagos de estudiantes
         * - Procesos de pagos de parte de los estudiantes
         */
        Route::get('pagosEstudiante','PaymentController@listPay')->name('pagosEstudiante');
        Route::get('tablaPagosEstudiante/{id}','PaymentController@tablaPagosEstudiante')->name('tablaPagosEstudiante');
        Route::get('pagoEstudiante/{id}','PaymentController@pagoEstudianteCreate')->name('pagoEstudiante');
        Route::post('pagoEstudianteProcesado','PaymentController@pagoEstudianteStore')->name('pagoEstudianteProcesado');
        /*Route::get('pagoEstudianteManual/{id}','PaymentController@pagoEstudianteManualCreate')->name('pagoEstudianteManual');
        Route::post('pagoEstudianteManualProcesado','PaymentController@pagoEstudianteManualStore')->name('pagoEstudianteManualProcesado');
        Route::get('cancelarPago/{id}','PaymentController@cancelarPago')->name('cancelarPago');*/ //Se movio para colecturia

        /**
         * Rutas para la seccion de documentos Oscar Cornejo
         * 17/03/2022 
         */
        //Estudiante
        Route::get('documentacionEstudiantil','DocumentsController@documentacionEstudiantil')->name('documentacionEstudiantil');
        Route::get('getTableDocumentationEstudiante','DocumentsController@getTableDocumentationEstudiante')->name('getTableDocumentationEstudiante');
        Route::get('addDocument','DocumentsController@documentStudentCreate')->name('addDocument');
        Route::post('documentStudentStore','DocumentsController@documentStudentStore')->name('documentStudentStore');
        Route::get('deleteDocument/{id}','DocumentsController@deleteDocument')->name('deleteDocument');
        Route::get('rutaDocumento/{id}','DocumentsController@rutaDocumento')->name('rutaDocumento');

        //Actualizar datos estudiante 
        Route::get('actualizarEstudiante/{id}','MatriculaController@actualizarEstudiante')->name('actualizarEstudiante');
        Route::post('actualizarEstudiantePost', 'MatriculaController@actualizarEstudiantePost')->name('actualizarEstudiantePost');
    });

    Route::group(['middleware' => ['student','docentes']], function () {
        //Descargar Adjunto-Actividad
        Route::get('/actividad/adjuntos/{archivo}', 'GradeController@descargarAdjunto')->name('descargaAdjuntosActividad');
        //Descargar Adjunto-Tarea
        Route::get('/tareas/{archivo}', 'StudentController@descargarTarea')->name('descargaTarea');
        Route::get('/storage/deberes_adjuntos/{archivo}', 'StudentController@descargarTarea')->name('descargaTarea2');
    });

    Route::group(['middleware' => ['admin-student']], function () {
        Route::get('DownloadDocumentStudent/{id}/{idUser}','DocumentsController@downloadDocumentStudent')->name('DownloadDocumentStudent');
    });

    /**
     * Secciones para la Biblioteca Virtual
     */
    Route::get('/biblioteca-virtual/show','BibliotecaVirtualController@show')->name('BibliotecaVirtualshow');
    //Route::get('/biblioteca-virtual/show/{id}','BibliotecaVirtualController@showbibliotecatime')->name('BibliotecaVirtualshowTime');
    Route::post('/biblioteca-virtual/register-time','BibliotecaVirtualController@registerTime')->name('registertimelibrary');
    
    /**
    REPORTES
     **/

    Route::get('/reportes', 'CarrerasController@reportes')->name('reportes.carreras');
    Route::get('reportes/listarCarreras/{idcarrera}', 'CarrerasController@listarOpcionesCarrerasReporte')->name('listarOpcionesCarrerasReporte');

    /**
    REPORTES INSTITUCIONALES
     **/
    Route::get('/pagare-con-vencimientos-sucesivos/{idStudent}', 'ReportesInstitucionalesController@pagareConVencimientos')->name('reporte.pagareConVencimiento');
    Route::get('/no-aceptacion-del-seguro/{idStudent}', 'ReportesInstitucionalesController@noAceptacionDelSeguro')->name('reporte.noAceptacionDelSeguro');
    Route::get('/ingreso-y-salida-de-estudiantes/{idStudent}', 'ReportesInstitucionalesController@registroDeIngresoYSalidaDeEstudiantes')->name('reporte.registroDeIngresoYSalidaDeEstudiantes');
    Route::get('/contrato-economico-de-prestacion-de-servicios-educacionales/{idStudent}', 'ReportesInstitucionalesController@prestacionServiciosEducacionales')->name('reporte.prestacionServiciosEducacionales');
    Route::get('/acta-de-matricula/{idStudent}', 'ReportesInstitucionalesController@actaDeMatricula')->name('reporte.actaDeMatricula');
    Route::get('/solicitud-de-admision/{idStudent}', 'ReportesInstitucionalesController@solicitudDeAdmision')->name('reporte.solicitudDeAdmision');
    Route::get('/informacion-personal-matricula/{idStudent}', 'ReportesInstitucionalesController@informacionPersonalMatricula')->name('reporte.informacionPersonalMatricula');
    Route::get('/informacion-personal-matricula', 'ReportesInstitucionalesController@informacionPersonalMatricula_vacia');
    Route::get('/solicitud-de-matricula/{id}', 'ReportesInstitucionalesController@solicitudDeMatricula')->name('reporte.solicitudDeMatricula');

    /**
    REPORTES EI
     **/
    // Libreta Destrezas - PARCIAL
    Route::get('pdf/{curso}/{parcial}', 'LibretasParcialController@libretaDestreza')->name('destrezaCurso');
    // Cuadro Informe
    Route::get('cuadro-informe-inicial/{curso}/{quimestre}', 'PdfControllerInicialPreparatoria@cuadroInformeInicial')->name('cuadroInformeInicial');
    // Libreta Destrezas - QUIMESTRE
    Route::get('destreza/quimestral/{curso}/{parcial}', 'LibretasQuimestralController@libretaDestreza')->name('libretaQuimestralGeneral');
    //Reporte Asistencia - ANUAL
    Route::get('/listado-de-asistencia/{idCurso}', 'AssistanceController@listaAsistencia')->name('listadoAsistencia2');
    Route::post('/listado-de-asistencia-general', 'AssistanceController@listaAsistenciaGeneral')->name('listadoAsistenciageneral');
    //Informa Anual Cualitativo - ANUAL
    Route::get('reporte-anual-de-aprendizaje/{idCurso}/{parcial}', 'PdfControllerInicialPreparatoria@informeAnualDestrezas')->name('informeAnualDestrezas');
    //Informe Cualitativo Final - ANUAL
    Route::get('destreza/informe/{curso}', 'PdfControllerInicialPreparatoria@informeFinalDestrezas')->name('informeFinalDestrezas');
    // Cuadro de calificaciones anual - ANUAL
    Route::get('/cuadro-calificaciones-anual', function () {
        return view('pdf.reportes-por-curso.cuadro-calificaciones-anual');
    });
    Route::get('destreza/informe-quimestral/{curso}/{parcial}', 'PdfControllerInicialPreparatoria@informeQuimestralDestrezas')->name('informeQuimestralDestrezas');

    /**
    REPORTES EGB/BGU - PARCIAL
     **/
    //Reporte General
    Route::get('acta-de-calificaciones-general/{curso}/{parcial}', 'PdfControllerActaDeCalificaciones@actaGeneral')->name('actaCalificacionesGeneral');
    Route::get('acta-de-calificaciones-materia/{curso}/{parcial}/{materia}', 'PdfControllerActaDeCalificaciones@actaParcialMateria')->name('actaParcialMateria');
    //Reporte Evaluaciones/Examenes Pendientes
    Route::get('evaluaciones-pendientes/{curso}/{parcial}', 'PdfControllerActaDeCalificaciones@evaluacionesPendientes')->name('evaluacionesPendientes');
    //Estadisticas
    Route::get('/estadisticas-por-parcial/{idCurso}/{parcial}', 'EstadisticaController@invoice')->name('EstadisticasPorParcial');
    //Calificaciones pendientes
    Route::get('listado-de-calificaciones-pendientes-por-curso/{idCurso}/{parcial}', 'PdfControllerListadoDeCalificacionesPendientesPorCurso@invoice')->name('calificacionesPendientes');
    //Resumen de calificaciones
    Route::get('/resumen-de-calificaciones-por-parcial/{curso}/{parcial}', 'PdfController2@ResumenCalificaciones')->name('ResumenCalificaciones');
    //Refuerzo Academico
    Route::get('/refuerzo-academico-curso/{curso}/{parcial}', 'PdfController2@RefuerzoAcademicoReporteCurso')->name('RefuerzoAcademicoReporteCurso');
    //Cuadro de calificaciones
    Route::get('cuadro-de-calificaciones-por-curso/{curso}/{parcial}', 'PdfControllerActaDeCalificaciones@cuadroGeneralCurso')->name('cuadroCalificacionesCurso');
    //Libreta RA
    Route::get('/acta-de-calificaciones-refuerzos/{idCurso}/{parcial}', 'LibretasParcialController@LibretaRA')->name('libretaParcialConRefuerzo');

    /**
    REPORTES EGB/BGU - QUIMESTRE
     **/
    //Examenes Pendientes
    Route::get('/examenes-pendientes-por-quimestre/{curso}/{quimestre}', 'LibretasQuimestralController@examenesPendientes')->name('examenesPendientes');
    //Reporte General
    Route::get('/acta-de-calificaciones-por-quimestre/{curso}/{quimestre}', 'PdfControllerActaDeCalificaciones@ActaCalificacionesQuimestre')->name('ActaCalificacionesQuimestre');
    //Estadisticas
    Route::get('/estadisticas-por-quimestre/{idCurso}/{parcial}', 'EstadisticaController@EstadisticasQuimestre')->name('EstadisticasQuimestre');
    //Cuadro de Honor
    Route::get('cuadro-de-honor/{idCurso}/{parcial}', 'PdfControllerCuadroDeHonor@invoice')->name('cuadroDeHonor');
    //Resumen de Calificaciones
    Route::get('/resumen-de-calificaciones-por-quimestre/{curso}/{parcial}', 'PdfController2@ResumenCalificacionesQuimestre')->name('ResumenCalificacionesQuimestre');
    //Calificaciones Pendientes
    Route::get('calificaciones-pendientes-examen/{idCurso}/{quimestre}', 'PdfController@calificacionesPendienteExamen')->name('calificacionesPendienteExamen');
    //Cuadro de calificaciones
    Route::get('cuadro-de-calificaciones-por-curso-quimestre/{curso}/{parcial}', 'PdfControllerActaDeCalificaciones@cuadroGeneralCursoQuimestre')->name('cuadroGeneralCursoQuimestre');
    //Libreta
    Route::get('/libreta-por-quimestre/{idCurso}/{quimestre}', 'LibretasQuimestralController@libreta')->name('libretaQuimestre');
    // Route::get('/libreta-por-quimestre2', 'LibretasQuimestralController@libreta2')->name('libretaQuimestre');
    Route::get('/examenes-pendientes-por-quimestre/', 'LibretasQuimestralController@examenesPendientes')->name('examenesPendientes');

    /**
    REPORTES EGB/BGU- ANUAL
     **/
    //Nomina de estudiantes
    Route::get('/nomina-de-estudiantes-matriculados/{idCurso}', 'pdfControllerNominaEstudiantesMatriculados@invoice')->name('nominaEstudiantil');
    // Reporte datos varios
    Route::get('/datos-varios/{idCurso}', 'PdfController@datosVarios')->name('reporte.datosVarios');
    //Libreta Anual
    Route::get('/libreta/{idCurso}', 'LibretasAnualController@libretaAnual')->name('libretaAnual');
    Route::get('/libreta-anual2', 'LibretasAnualController@libretaAnual2')->name('libretaAnual2');
    //Libreta Anual por estudiante
    Route::get('/libreta-anual-estudiante/{idEstudiante}', 'LibretasAnualController@libretaAnualEstudiante')->name('libretaAnualEstudiante');
    //Certificado de promoción
    Route::get('ReporteporCurso/CertificadoPromocion/{idCurso}', 'PdfControllerCertificado@certificadoPromocionEstudiante')->name('certificadoPromocionCurso');
    //Certificado pase de año
    Route::get('ReporteporCurso/CertificadoPaseAnual/{idCurso}', 'PdfControllerCertificado@certificadoPaseEstudiante')->name('certificadoPaseEstudianteCurso');
    // S��bana
    Route::get('/sabana-por-curso/{curso}/{parcial}', 'SabanaController@sabana')->name('sabana');
    // Sábana Supletorio
    Route::get('/sabana-por-curso/supletorio/{curso}', 'SabanaController@sabanaSupletorio')->name('sabanaCursoSupletorio');
    // Sábana Remedial
    Route::get('/sabana-por-curso/remedial/{curso}', 'SabanaController@sabanaRemedial')->name('sabanaCursoRemedial');
    //Reporte promedio
    Route::get('reporte-de-promedios/{idCurso}', 'ReportesController@reportePromedio')->name('reportePromedio');
    //Reporte promedios por clase
    Route::get('acta-de-calificaciones-recuperacion/{idCurso}', 'ReportesController@reportePromedioClases')->name('reportePromedioClases');
    //Reporte promedios por Docente
    Route::get('reporte-de-promedios-docente/{idMateria}', 'ReportesController@reportePromedioDocente')->name('reportePromediosDocente');
    //Reporte de Recuperación
    Route::get('reporte-examenes-recuperacion/{idCurso}', 'ReportesController@reporteRecuperacion')->name('reporteRecuperacion');
    //Reporte de supletorio
    Route::get('reporte-supletorio/{idCurso}', 'ReportesController@reporteSupletorio')->name('reporteSupletorio');
    //Reporte de remedial
    Route::get('reporte-remedial/{idCurso}', 'ReportesController@reporteRemedial')->name('reporteRemedial');
    //Reporte de Gracia
    Route::get('reporte-gracia/{idCurso}', 'ReportesController@reporteGracia')->name('reporteGracia');

    /**
    REPORTES POR ESTUDIANTES
     **/
    //Certificado de Comportamiento
    Route::get('certificado-comportamiento/{idAlumno}/{parcial}', 'PdfControllerCertificado@certificadoComportamiento')->name('certificadoComportamiento');
    //Certificado de Matrícula
    Route::get('certificado/{idAlumno}', 'PdfControllerCertificado@invoice')->name('certificadoMatricula');
    //Certificado de Promocion para Educacion Inicial
    Route::get('certificado-promocion-ei/{idCurso}', 'PdfControllerCertificado@CertificadoPromocionEi')->name('certificadoPromocionEi');
    //Certificado de Matrícula2
    Route::get('certificado Matricula/{idAlumno}', 'PdfControllerCertificado@CertificadoMatricula')->name('cerMatricula');
    Route::get('certificado Matricula/curso/{idCurso}', 'PdfControllerCertificado@CertificadoMatriculaCurso')->name('cerMatriculaCurso');
    //Certificado de Asistencia
    Route::get('certificado-asistencia/{idAlumno}', 'PdfControllerCertificado@certificadoAsistencia')->name('certificadoAsistencia');
    // Reporte toma de fotos y videos
    Route::get('autorizacion-de-toma-de-fotos-videos/{idEstudiante}', 'PdfController@autorizacionFotosVideos')->name('reporte.autorizacionFotosVideos');

    /**
    REPORTES POR DOCENTES
     **/
    // Reporte Actas
    Route::get('acta-de-calificaciones-general-docente/{docente}/{parcial}', 'GradeController@ActaCalificacionesDocente')->name('actaCalificacionesDocente');
    // Reporte Actas Quimestre
    Route::get('/acta-de-calificaciones-por-quimestre-docente/{quimestre}/{docente}', 'PdfControllerActaDeCalificaciones@ActaCalificacionesQuimestreDocente')->name('ActaCalificacionesQuimestreDocente');
    // Estadísticas Parcial
    Route::get('/estadisticas-por-parcial-docente/{idDocente}/{parcial}', 'EstadisticaController@EstadisticasParcialDocente')->name('EstadisticasPorParcialDocente');
    // Estadísticas Quimestral
    Route::get('/estadisticas-por-quimestre-docente/{idDocente}/{parcial}', 'EstadisticaController@EstadisticasQuimestreDocente')->name('EstadisticasPorQuimestreDocente');
    // Estadísticas Anual
    Route::get('/estadisticas-anual-docente/{idDocente}', 'EstadisticaController@EstadisticasAnualDocente')->name('EstadisticasAnualDocente');

    /**
    FICHAS PERSONALES - PADRES
     **/
    // Crear Padre/Madre
    Route::get('FichasPersonales/padres/crear', 'ParentsController@create')->name('padresCrear');
    Route::post('FichasPersonales/padres/crear', 'ParentsController@store')->name('padresCrearStore');
    // Listdo de Padre/Madre
    Route::get('/FichasPersonales/Padres', 'ParentsController@index')->name('padres');
    // Visualizar info Padre/Madres
    Route::get('/FichasPersonales/Padres/{idParent}', 'ParentsController@show')->name('padresVer');
    // Editar Padre/Madre
    Route::get('/FichasPersonales/Padres/Editar/{idParent}', 'ParentsController@edit')->name('padresEditar');
    Route::put('/FichasPersonales/Padres/Actualizar/{idParent}', 'ParentsController@update')->name('padresActualizar');
    // ELiminar Padre/Madre
    Route::delete('/FichasPersonales/Padres/Eliminar/{idParent}', 'ParentsController@destroy')->name('padresEliminar');

    /**
    TUTORÍA - ASISTENCIA
     **/
    Route::get('/Tutoria/AsistenciaEstudiantial/Estudiante/{idEstudiante}/{parcial}', 'AssistanceController@editStudent')->name('asistenciaTutoriaEstudiante');
    Route::get('/Tutoria/AsistenciaEstudiantial/Estudiante/{idEstudiante}', function () {
    })->name('asistenciaTutoriaEstudianteRuta');
    Route::post('/asistencia/Reporte Curso/Tutor/Estudiante/Actualizar/{id}/{parcial}', 'AssistanceController@updateAsistenciaReporteTutor')->name('updateAsistenciaReporteTutor');

    /**
    GRADOS CALIFICACIONES - DESCARGABLES
     **/
    // Destrezas Parcial por Estudiante
    Route::get('pdf/{alumno}/{curso}/{parcial}', 'LibretasParcialController@libretaDestrezaAlumno')->name('destrezaEstudiante');
    // Libreta Destrezas Quimestral por Estudiante (EI/Primero)
    Route::get('destreza/quimestral/{idCurso}/{parcial}/{idEstudiante}', 'LibretasQuimestralController@libretaDestrezaAlumno')->name('libretaQuimestralDestrezasAlumno');
    Route::get('destreza/quimestral/{idCurso}/{parcial}/{idEstudiante}/detallada', 'LibretasQuimestralController@informeQuimestralDestrezasEstudiantes')->name('libretaQuimestralDestrezasAlumnoDetallada');
    //libreta Anual Destrezas
    Route::get('destreza/anual/{idCurso}/{idEstudiante}', 'PdfControllerInicialPreparatoria@informeAnualDestrezasEstudiantes')->name('informeAnualDestrezasEstudiantes');
    Route::get('destreza/anual/{idCurso}', 'PdfControllerInicialPreparatoria@informeAnualDestrezasDetalladas')->name('informeAnualDestrezasDetalladas');
    // Libreta Parcial (Estudiante)
    Route::get('pdf2/{idEstudiante}/{idCurso}/{parcial}', 'LibretasParcialController@libretaParcialAlumno')->name('reporteEstudiante');
    // Libreta Parcial (Curso)
    Route::get('pdf2/{idCurso}/{parcial}', 'LibretasParcialController@libreta')->name('reporteEstudiantes');
    // Libreta RA (Parcial-Estudiante)
    Route::get('/acta-de-calificaciones-refuerzos/estudiante/{idEstudiante}/{parcial}', 'LibretasParcialController@LibretaRAAlumno')->name('libretaParcialConRefuerzoAlumno');
    // Libreta Quimestral por Estudiante
    Route::get('/libreta-por-quimestre/{idCurso}/{quimestre}/{idAlumno}', 'LibretasQuimestralController@libretaQuimestralAlumno')->name('libretaQuimestreEstudiante');
    // Acta de Calificaciones(Por Curso)
    Route::get('acta-de-calificaciones/{materia}/{parcial}', 'PdfControllerActaDeCalificaciones@invoice')->name('actaCalificaciones');
    // Refuerzo Académico(Por Curso)
    Route::get('/refuerzo-academico/{matter}/{parcial}', 'PdfController2@RefuerzoAcademicoReporte')->name('RefuerzoAcademicoReporte');

    // HORARIO ESCOLAR-Descargable por curso
    Route::get('descargarDeHorarioEscolar/{id}', 'CourseScheduleController@downloadScheduleCourse')->name('descargarDeHorarioEscolar');
    Route::get('horario-escolar-por-tipo/{course}/{tipo}', 'CourseScheduleController@descargarHorarioEscolarPorTipo')->name('descargarDeHorarioEscolarPorTipo');

    /**
    Varios - NO EN USO
     **/
    //DECE
    Route::get('/DECE', function () {
        return view('UsersViews.administrador.DECE.index');
    });
    // CARNET
    Route::get('grados/lista/carnet_del_Curso/{idCurso}', 'CredentialsController@carnetCurso')->name('carnetCurso');
    //Historial de Uso
    Route::get('/historial-de-uso', 'RecordController@index')->name('historial');

    //PDF-libretas a revisar
    Route::get('/libreta-quimestral-por-estudiante', function () {
        return view('pdf.libretas-ministeriales.libreta-quimestral-por-estudiante');
    });
    Route::get('/libreta-quimestral-por-curso', function () {
        return view('pdf.libretas-ministeriales.libreta-quimestral-por-curso');
    });
    Route::get('/libreta-anual-por-curso', function () {
        return view('pdf.libretas-ministeriales.libreta-anual-por-curso');
    });

    /**
    Junta de curso - NO EN USO
     **/
    Route::get('/junta-de-curso', 'JuntaDeCursoController@junta');
    Route::get('/junta-de-curso-pdf', 'JuntaDeCursoController@junta_PDF');
    Route::get('/lista-docentes', 'JuntaDeCursoController@lista_docentes');
    Route::get('/resoluciones-anteriores', 'JuntaDeCursoController@resoluciones_anteriores');
    Route::get('/orden-del-dia', 'JuntaDeCursoController@orden_del_dia');
    Route::get('/rendimiento-quimestral', 'JuntaDeCursoController@rendimiento_quimestral');
    Route::get('/informe-asistencia', 'JuntaDeCursoController@informe_asistencia');
    Route::get('/promedio-materias', 'JuntaDeCursoController@promedio_materias');
    Route::get('/cuadro-de-honor', 'JuntaDeCursoController@cuadro_de_honor');
    Route::get('/notas-faltantes', 'JuntaDeCursoController@notas_faltantes');
    Route::get('/resoluciones', 'JuntaDeCursoController@resoluciones');

    // API pagos
    Route::get('/total-pagos', 'ColecturiaController@totalPagos');
    Route::get('/detalle-pagos', 'ColecturiaController@totalDetallePagos');

    //Pago en Linea
    Route::resource('/pagos/', 'PagoLineaController');
    Route::post('/pagos/Eliminar_Transaccion', 'PagoLineaController@eliminar')->name('EliminarTransaccion');
    Route::get('/pagos/anular transaccion/{id_factura}/{id_estudiante}', 'PagoLineaController@anular')->name('AnularTransaccion');
    Route::get('/pagos/Eliminar_tarjetas/{idcliente}', 'PagoLineaController@eliminarTarjetas')->name('deleteTarjeta');
    Route::get('/pagos/ver-pago/{id_transaccion}', 'PagoLineaController@ver_pago')->name('verPago');
    Route::get('/pagos/eliminar-transaccion/{id_transaccion}', 'PagoLineaController@eliminar_transaccion')->name('elimTransaccion');
    Route::get('/pagos/search-PEL/', 'PagoLineaController@search')->name('busqueda');
    // excel
    Route::resource('/excel', 'ExcelController');
    Route::POST('/excel/envio-mensajes', 'ExcelController@envioMensajes')->name('exel_envio_mensajes');
    Route::get('/excel/ExcelCursoMensajes/{curso}', 'ExcelController@deudaCurso')->name('reporteDeudaCurso');
    Route::post('/excel/ExcelInsumos/', 'ExcelController@InsumoInstitucion')->name('InsumoInstitucion');
    Route::post('/excel/ExcelFacturas/', 'ExcelController@FacturasCobradas')->name('FacturasCobradas');
    Route::post('/excel/importarNotas/', 'ExcelController@importaractividades')->name('importarActividades');
    //Route::post('/excel/importarEstudiantes/', 'ExcelController@importarestudiantes')->name('importarEstudiantes');
    Route::post('/excel/importarEstudiantes/', 'ExcelController@importarestudiantes2')->name('importarEstudiantes');
    Route::get('/excel/reportePromedioExcel/{idCurso}', 'ExcelController@reportePromedioExcel')->name('reportePromedioExcel');
    /**
     * COMPORTAMIENTO DOCENTE-NEW
     */
    Route::get('docente/comportamiento-referencia/', 'ComportamientoController@DocenteComportamiento')->name('docente-comportamiento');
    Route::get('docente/comportamiento-curso-new/{id}/{parcial}', 'ComportamientoController@DocenteComportamientoCurso')->name('docente-comportamiento-curso');
    Route::post('/docente/comportamiento-curso-new/', 'ComportamientoController@storeComportamientosNew')->name('addComportamientoNew');
    Route::get('/docente/comportamiento-curso-eliminar/{id}', 'ComportamientoController@eliminarComportamientosNew')->name('deleteComportamientoNew');
    Route::post('/autocomplete/email', 'AutocompleteController@email')->name('autocompleteEmail');

    //asistencia::::
    Route::get('docente/asistencia-materia', 'DocenteAsistenciaMateria@index')->name('docente.asistenciaMateria');
    Route::get('docente/asistencia-materias', 'DocenteAsistenciaMateria@AsistenciaPorMaterias')->name('docente.asistenciaMateria-materias');
    // ver asistencia
    Route::get('asistencia-materia/materia/{course}/{materia}', 'DocenteAsistenciaMateria@materia')->name('docente.asistenciaMateria.materia');
    // Crear asistencia
    Route::get('asistencia-materia/materia/{course}/{materia}/crear', 'DocenteAsistenciaMateria@materiaCrear')->name('docente.asistenciaMateria.materiaCrear');
    Route::get('asistencia-materia/materia/', function () {
    })->name('docente.asistenciaMateria.materia-js');
    //  post asistencia
    Route::post('asistencia-materia/materia/{course}/{materia}', 'DocenteAsistenciaMateria@postAsistencia')->name('docente.asistenciaMateria.postAsistencia');
    //  editar asistencia
    Route::get('asistencia-materia/materia/editar/{course}/{materia}', 'DocenteAsistenciaMateria@editarMateria')->name('docente.asistenciaMateria.editar');
    // put asistencia
    Route::put('asistencia-materia/materia/editar/{course}/{materia}', 'DocenteAsistenciaMateria@updateAsistencia')->name('docente.asistenciaMateria.updateAsistencia');
    // ASISTENCIA DE CURSO POR PARCIAL
    Route::post('docente/asistencia/asistencia-curso-por-parcial/{id}/{parcial}', 'AssistanceController@crearAsistenciaCurso')->name('asistencia.cursoPorParcial');
    //ACTUALIZAR LISTADO DE ASISTENCIA PARA NUEVOS ESTUDIANTES
    Route::get('asistencia-materia/materia/updateListStudents/{course}/{materia}', 'DocenteAsistenciaMateria@upDateListStudents')->name('docente.asistenciaMateria.updateListStudent');
    /* Agenda */
    Route::get('/agenda Docente', 'LectionaryController@lectionaryDocente')->name('agenda_Docente');
    Route::get('/agenda Docente/semanal', 'LectionaryController@lectionaryDocenteSemanal')->name('agenda_Docente.semanal');

    //Solicitudes
    Route::get('/solicitudes', 'AcademicRequestsController@index')->name('solicitudes');
    Route::get('/solicitudes_crear', 'AcademicRequestsController@create_requests')->name('solicitudes_crear');
    Route::get('/solicitudesGetAll', 'AcademicRequestsController@getAll')->name('solicitudesGetAll');
    Route::get('/solicitudesEdit/{id}', 'AcademicRequestsController@edit')->name('solicitudesEdit');
    Route::get('/solicitudesRecibidas', 'AcademicRequestsController@solicitudesRecibidas')->name('solicitudesRecibidas');
    Route::get('/solicitudesPorDestinatario/{id}', 'AcademicRequestsController@solicitudesPorDestinatario')->name('solicitudesPorDestinatario');
    
    //Crear Solicitud
    Route::post('/solicitudes_crear', 'AcademicRequestsController@post_requests_create')->name('solicitud_crear');
    Route::post('solicitudesEdit/{id}', 'AcademicRequestsController@post_requests_edit');
    Route::post('/solicitudesEstudiantes_crear/{id}', 'AcademicRequestsController@postStudent_requests_create')->name('solicitudesEstudiantiles_crear');

    Route::delete('solicitudesDelete/{id}', 'AcademicRequestsController@solicitudesDelete')->name('solicitudesDelete');

    //Solicitudes Estudiantes
    Route::get('/solicitudesEstudiantes', 'AcademicRequestsController@estudiantesIndex')->name('solicitudesEstudiantes');
    Route::get('/solicitudesEstudiantes_crear/{id}', 'AcademicRequestsController@estudiantesCreate_requests')->name('solicitudesEstudiantiles_crear');

    Route::get('/solicitudesEstudiantesGetAll', 'AcademicRequestsController@estudiantesGetAll')->name('solicitudesEstudiantesGetAll');

    Route::get('/solicitudesEstudiantes/{id}', 'PdfController@reporteSolicitud')->name('reporteSolicitud');

    Route::delete('solicitudesEstudiantesDelete/{id}', 'AcademicRequestsController@solicitudesEstudiantesDelete')->name('solicitudesEstudiantesDelete');

    //Seccion de Actas de Calificaciones
    //Route::get('/pdfActa', 'PdfController@reporteActaCalificacion')->name('actaCalificacion');
    Route::get('/reporteActas', 'QualificationController@index')->name('reporteActas');
    Route::get('/postAccedeCurso/{id}', 'QualificationController@postAccedeCurso')->name('postAccedeCurso');
    Route::get('/postAccedeParalelos/{id}', 'QualificationController@postAccedeParalelos')->name('postAccedeParalelos');

    Route::post('/reporteActas', 'PdfController@generarReporte')->name('generarReporte');

    Route::get('/tablaEstudiantesPrueba', 'MatriculaController@tablaEstudiantesPrueba')->name('tablaEstudiantesPrueba');

    Route::resource('/exportar', 'ReportesExcelController');
    Route::get('/export', 'ReportesExcelController@export')->name('export');
    Route::get('/exportarDocente', 'ReportesExcelController@exportDocente')->name('exportarDocente');

    /**-----------------------------------------------------------------------------------------**/

    Route::get('/exportarKardex/{id}', 'KardexController@exportKardex')->name('exportarKardex');
    Route::get('getEstudiante', 'CuentasporcobrarController@getEstudiante')->name('getEstudiante');
    Route::get('tablaCuentasPorCobrar', 'CuentasporcobrarController@tablaCuentasPorCobrar')->name('tablaCuentasPorCobrar');

    
    //BIBLIOTECA//
    //Categories

    Route::get('/categorias', 'CategoriaController@index')->name('indexCategorias');
    Route::post('/categorias', 'CategoriaController@store')->name('storeCategorias');
    Route::get('/categorias/editar/{id}', 'CategoriaController@edit')->name('editCategorias');
    Route::post('/categorias/editar/{id}', 'CategoriaController@update')->name('updateCategorias');

    Route::get('/categorias/eliminar/{id}', 'CategoriaController@destroy')->name('destroyCategorias');

    /* Authors */
    Route::get('/autores', 'AutorController@index')->name('indexAutores');
    Route::post('/autores', 'AutorController@store')->name('storeAutores');
    Route::get('/autores/editar/{id}', 'AutorController@edit')->name('editAutores');
    Route::post('/autores/editar/{id}', 'AutorController@update')->name('updateAutores');

    Route::get('/autores/eliminar/{id}', 'AutorController@destroy')->name('destroyAutores');

    /* Books */
    Route::get('/libro', 'LibroController@index')->name('indexLibros');
    Route::post('/libro', 'LibroController@store')->name('storeLibros');
    Route::get('/libro/editar/{id}', 'LibroController@edit')->name('editLibros');
    Route::post('/libro/editar/{id}', 'LibroController@update')->name('updateLibros');
    Route::get('/libros/eliminar/{id}', 'LibroController@destroy')->name('destroyLibros');

    /* Libro Curso */
    Route::get('/libro-curso', 'LibroCursoController@index')->name('indexLibrosCurso');
    Route::post('/libro-curso', 'LibroCursoController@store')->name('storeLibrosCurso');
    

    Route::put('categories/tree', 'CategoryTreeController@update')->name('admin.categories.tree.update');
    Route::get('categories', 'CategoryController@index')->name('admin.categories.index');
    Route::post('categories', 'CategoryController@store')->name('admin.categories.store');
    Route::get('categories/{id}', 'CategoryController@show')->name('admin.categories.show');
    Route::put('categories/{id}', 'CategoryController@update')->name('admin.categories.update');
    Route::delete('categories/{id}', 'CategoryController@destroy')->name('admin.categories.destroy');

    /**
     * Rutas de seccion de libros Oscar Cornejo
     * 16/02/2022 -> Se manejara:
     * - La importacion masica 
     * - Base de datos de Estudiantes
     * - Reporte General de Estudiantes que han Leido 
     * - Reporte Individual de estudiante (Perfil de estudiante)
     */
    Route::get('import','ImportController@index')->name('import');
    Route::post('import','ImportController@import')->name('import');
    Route::get('studentsBiblioteca','BibliotecaReportController@index')->name('studentsBiblioteca');
    Route::get('tablaEstudiantesBiblioteca','BibliotecaReportController@tablaEstudiantes')->name('tablaEstudiantesBiblioteca');
    Route::get('datosEstudiante/{id}','BibliotecaReportController@estudianteBiblioteca')->name('datosEstudiante');
    Route::post('reportePDFindividual','BibliotecaReportController@reportePDFindividual')->name('reportePDFindividual');
    Route::post('reporteExcelindividual','BibliotecaReportController@reporteExcelindividual')->name('reporteExcelindividual');
    Route::get('iniciarContador/{id}','BibliotecaReportController@iniciarContador')->name('iniciarContador');
    Route::get('reporteExcelGeneral','BibliotecaReportController@reportAllExcel')->name('reporteExcelGeneral');
    Route::get('reportePDFGeneral','BibliotecaReportController@reportAllPDF')->name('reportePDFGeneral');
        /**
     * Fin de seccion de libros Oscar Cornejo 
     * 16-02-2022
     */

     /**
     * Rutas de seccion repositorios Oscar Cornejo
     * 09/03/2022 -> Se manejara:
     * - Vista de todos las Tesis y Tesinas  
     * - Vista para agregar y editar las tesis y tesinas manualmente. 
     * - Importación General de Tesis y Tesinas
     * - Reporte General de Estudiantes que han subido sus tesis o tesinas
     * - Reporte Individual de estudiante con sus trabajos academicos 
     */
    Route::get('repositorio','RepositoryController@index')->name('repositorio');
    Route::get('repositorioGeneral','RepositoryController@indexGeneral')->name('repositorioGeneral');
    Route::get('repositorioTesis','RepositoryController@indexTesis')->name('repositorioTesis');
    Route::get('repositorioTesinas','RepositoryController@indexTesinas')->name('repositorioTesinas');
    Route::get('tablaGeneral','RepositoryController@tablaGeneral')->name('tablaGeneral');
    Route::get('tablaTesis','RepositoryController@tablaTesis')->name('tablaTesis');
    Route::get('tablaTesinas','RepositoryController@tablaTesinas')->name('tablaTesinas');
    Route::get('newRepositorio','RepositoryController@newRepositorio')->name('newRepositorio');
    Route::post('newRepositorioCreate','RepositoryController@newRepositorioCreate')->name('newRepositorioCreate');
    Route::get('repositorios/{id}','RepositoryController@downloadDocument')->name('repositorios');


    //Ajustes
    Route::get('repositorioAjustes','RepositoryController@repositorioAjustes')->name('repositorioAjustes');
    Route::get('tipoDocumentos','RepositoryController@tipoDocumentos')->name('tipoDocumentos');
    Route::get('listTypeDocument','RepositoryController@listTypeDocument')->name('listTypeDocument');
    Route::get('newDocument','RepositoryController@newDocument')->name('newDocument');
    Route::post('newDocumentStore','RepositoryController@newDocumentStore')->name('newDocumentStore');
    Route::get('tipoDocumentoEdit/{id}/{seccion}','RepositoryController@tipoDocumentoEdit')->name('tipoDocumentoEdit');
    Route::post('tipoDocumentoUpdate','RepositoryController@tipoDocumentoUpdate')->name('tipoDocumentoUpdate');
    
    Route::get('listStatusDocument','RepositoryController@listStatusDocument')->name('listStatusDocument');
    Route::get('listStatusTbl','RepositoryController@listStatusTbl')->name('listStatusTbl');
    Route::get('newStatus','RepositoryController@newStatus')->name('newStatus');
    Route::post('newStatusStore','RepositoryController@newStatusStore')->name('newStatusStore');
    Route::get('editStatusrepositorio/{id}/{seccion}','RepositoryController@editStatus')->name('editStatusrepositorio');
    Route::post('editStatusUpdate','RepositoryController@editStatusUpdate')->name('editStatusUpdate');
    Route::get('editRepositorio/{id}','RepositoryController@editRepositorio')->name('editRepositorio');
    Route::post('editRepositorioUpdate','RepositoryController@editRepositorioUpdate')->name('editRepositorioUpdate');
    

    //Seccion estudiantes
    Route::get('repositorioEstudiante','RepositoryController@indexEstudiante')->name('repositorioEstudiante');
    Route::get('tablaEstudiantesRepositorio','RepositoryController@tablaEstudiantes')->name('tablaEstudiantesRepositorio');
    Route::get('previewRepository/{id}','RepositoryController@previewRepository')->name('previewRepository');
    Route::get('previewRepositoryAdmin/{id}','RepositoryController@previewRepositoryAdmin')->name('previewRepositoryAdmin');
    

    //Rutas de Solicitudes de secretaria 
    Route::get('solicitudesRecibidasSecretaria','AcademicRequestsController@solicitudesRecibidasSecretaria')->name('solicitudesRecibidasSecretaria');
    Route::get('solicitudesGeneralSecretaria','AcademicRequestsController@solicitudesGeneralSecretaria')->name('solicitudesGeneralSecretaria');
    
    //Authors Public
    /* 
    Route::get('authors', 'AuthorController@index')->name('authors.index');
    Route::get('authors/{slug}', 'AuthorController@show')->name('authors.show');*/
    //Author
/*
    Route::get('authors', 'AuthorController@index')->name('admin.authors.index');
    Route::get('authors/create', 'AuthorController@create')->name('admin.authors.create');
    Route::post('authors', 'AuthorController@store')->name('admin.authors.store');
    Route::get('authors/{id}', 'AuthorController@show')->name('admin.authors.show');
    Route::get('authors/{id}/edit', 'AuthorController@edit')->name('admin.authors.edit');
    Route::put('authors/{id}', 'AuthorController@update')->name('adm
    in.authors.update');
    Route::delete('authors/{ids?}', 'AuthorController@destroy')->name('admin.authors.destroy');
*/
    //Public Ebook
    /*
    Route::get('ebooks', 'EbookController@index')->name('ebooks.index');
    Route::get('ebooks/{slug}', 'EbookController@show')->name('ebooks.show');
    Route::post('ebooks/{slug}/unlock', 'EbookController@unlock')->name('ebooks.unlock');
    Route::post('ebooks/{ebookId}/report', 'ReportEbookController@store')->name('ebooks.report.store');
    Route::get('ebooks/{slug}/download/{fileId?}', 'EbookController@download')->name('ebooks.download');
    Route::get('ebook/upload', 'EbookController@create')->name('ebooks.upload');
    Route::post('ebook', 'EbookController@store')->name('ebooks.create');
    Route::get('ebook/{slug}/delete', 'EbookController@destroy')->name('ebooks.delete');
    Route::get('ebook/{slug}/edit', 'EbookController@edit')->name('ebooks.edit');
    Route::put('ebook/{id}', 'EbookController@update')->name('ebooks.update');
    Route::get('epub/{slug}', 'EbookController@epubReader')->name('ebooks.epubReader');
    Route::post('ebooks/{slug}/pdfviewer', 'EbookController@pdfviewer')->name('ebooks.pdfviewer');
*/
    //Admin Ebook
/*
    Route::get('ebooks', 'EbookController@index')->name('admin.ebooks.index');
    Route::get('ebooks/create', 'EbookController@create')->name('admin.ebooks.create');
    Route::post('ebooks', 'EbookController@store')->name('admin.ebooks.store');
    Route::get('ebooks/{id}', 'EbookController@show')->name('admin.ebooks.show');
    Route::get('ebooks/{id}/edit', 'EbookController@edit')->name('admin.ebooks.edit');
    Route::put('ebooks/{id}', 'EbookController@update')->name('admin.ebooks.update');
    Route::delete('ebooks/{ids}', 'EbookController@destroy')->name('admin.ebooks.destroy');
    Route::get('reported-ebooks', 'ReportedEbookController@index')->name('admin.reportedebooks.index');
    Route::delete('reported-ebooks/{ids}', 'ReportedEbookController@destroy')->name('admin.reportedebooks.destroy');*/


});
