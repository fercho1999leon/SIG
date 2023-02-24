<?php

namespace Tests\Browser\Admin;

use App\Cliente;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\ConfiguracionSistema;
use App\Course;
use App\Institution;
use App\Parents;
use App\Student2;
use App\Transporte;
use App\User;
use App\Usuario;
use factoryEstudiante;

class matriculaTest extends DuskTestCase
{
	use RefreshDatabase;
	
	/** @test */
    public function matriculando_un_estudiante_con_pagos_activo() {
		$padre = factory(Parents::class)->create([
			'sexo' => 'Masculino' ]);
		$madre = factory(Parents::class)->create([
			'sexo' => 'Femenino' ]);
		$confSistema = ConfiguracionSistema::where('nombre','CONTADOR_MATRICULA')
		->where('idPeriodo', Institution::first()->periodoLectivo)
		->first();
		$confSistema->valor = 'G';
		$confSistema->save();
		$transporte = factory(Transporte::class)->create([
			'idPeriodo' => Institution::first()->periodoLectivo ]);
		$course = factory(Course::class)->create([
			'grado' => 'Segundo',
			'paralelo' => 'A',
			'seccion' => 'EGB',
			'especializacion' => null]);
		$usuario = factory(Usuario::class)->create();
		$representante = factory(User::class)->create([
			'userid' => $usuario->id,
			'correo' => $usuario->email,
			'cargo' => 'Representante'
		]);
		
		$this->browse(function (Browser $browser) use ($transporte, $course, $representante, $padre, $madre) {
			$browser->visit('/')
			->type('email', 'soporte@pined.ec')
			->type('password', 'adminPINED')
			->press('Ingresar')
            ->visit('/Crear Matricula')
			->assertSee('Matrícula')
			->type('ci', '0930307444')
			->keys('[name="fecha_matriculacion"]', '06242019')
			->type('nombres', 'Miguel Vinicio')
			->type('apellidos', 'Bonifaz Calderon')
			->keys('[name="fechaNacimiento"]', '06241991')
			->keys('[name="fecha_ingreso_pais"]', '01012010')
			->keys('[name="fecha_expiracion_pasaporte"]', '01012020')
			->keys('[name="fecha_caducidad_pasaporte"]', '06062012')
			->select('sexo', 'Masculino')
			->type('celular_estudiante', '0969900987')
			->type('ingreso_familiar', '1200')
			->type('ciudad', 'Guayaquil')
			->type('direccion', 'Coop juan montalvo Mz a14 v25')
			->type('telefono', '0996690636')
			->type('tipoVivienda', 'tipo vivienda')
			->type('nacionalidad', 'Ecuatoriano')
			->type('lugarNacimiento', 'Guayaquil-nacimiento')
			->type('provincia', 'Guayas')
			->type('canton', 'Canton')
			->type('parroquia', 'Parroquia')
			->type('institucionAnterior', 'ACADEMIA NAVAL ALMIRANTE ILLINGWORTH')
			->type('razonCambio', 'razon cambio')
			->type('observaciones', 'observaciones porque el cambio')
			->type('clinica', 'clinica centro')
			->type('indicaciones', 'indicaciones etc etc')
			->type('tipoSangre', 'A+')
			->type('alergias', 'A la manzana')
			->select('inclusion', 'Si')
			->type('numero_carnet', '123456789')
			->select('seguro_institucional', 'Si')
			->select('nombre_seguro', 'Seguro 2')
			->select('discapacidad', 'Motor A')
			->select('condicionado', 'Si')
			->select('estado_civil_padres', 'Casados')
			->type('contactoEmergencia', 'Miguel Bonilla')
			->type('telefonoEmergencia', '042122815')
			->attach('fichaMedica','public/test.pdf')
			->select('matricula', 'Ordinaria')
			->select('curso', $course->id)
			->select('transporte', $transporte->id)
			->select('idRepresentante', $representante->id)
			->select('idPadre', $padre->id)
			->select('idMadre', $madre->id)
			// Facturación cliente
			->type('numero_identificacion', '0930307178')
			->type('facturacion_nombres', 'Diego')
			->type('facturacion_apellidos', 'Bonilla')
			->type('facturacion_correo', 'diegobonilla@gmail.com')
			->type('facturacion_movil', '0996690123')
			->type('facturacion_direccion', 'Ciudad las Joyas')
			->select('facturacion_parentezco', 'Madre')
			->keys('[name="facturacion_fecha_nacimiento"]', '06241995')
			->type('facturacion_telefono_domicilio', '042158535')
			->type('facturacion_profesion', 'Programador Full Stack')
			->type('facturacion_lugar_trabajo', 'Udesa central')
			->type('facturacion_telefono_trabajo', '065809675')
			->type('facturacion_nacionalidad', 'Ecuatoriana')
			->press('Matricular Estudiante')
			->assertPathIs('/Editar%20Matricula/1/1')
			->assertSee('Realizar Pago')
			->assertSee('Miguel Vinicio');
		});

		$user = Usuario::where('email', 'miguel.bonifaz1@pined.ec')->first();
		$this->assertDatabaseHas('users_profile', [
			'ci' =>'0930307444',
			'nombres' => 'Miguel Vinicio',
			'apellidos' => 'Bonifaz Calderon',
			'sexo' => 'Masculino',
			'correo' => 'miguel.bonifaz1@pined.ec',
			'fNacimiento' => '1991-06-24',
			'cargo' => 'Estudiante',
			'userid' => $user->id
		]);
		
		$this->assertDatabaseHas('users', [
			'email' => 'miguel.bonifaz1@pined.ec',
		]);

		$this->assertDatabaseHas('students2', [
			'ci' => '0930307444',
			'nombres' => 'Miguel Vinicio',
			'apellidos' => 'Bonifaz Calderon',
			'fechaNacimiento' => '1991-06-24',
			'fecha_matriculacion' => '2019-06-24',
			'sexo' => 'Masculino',
			'ciudad' => 'Guayaquil',
			'direccion' => 'Coop juan montalvo Mz a14 v25',
			'telefono' => '0996690636',
			'tipoVivienda' => 'tipo vivienda',
			'nacionalidad' => 'Ecuatoriano',
			'canton' => 'Canton',
			'parroquia' => 'Parroquia',
			'lugarNacimiento' => 'Guayaquil-nacimiento',
			'provincia' => 'Guayas',
			'canton' => 'Canton',
			'parroquia' => 'Parroquia',
			'institucionAnterior' => 'ACADEMIA NAVAL ALMIRANTE ILLINGWORTH',
			'razonCambio' => 'razon cambio',
			'observaciones' => 'observaciones porque el cambio',
			'clinica' => 'clinica centro',
			'indicaciones' => 'indicaciones etc etc',
			'tipoSangre' => 'A+',
			'contactoEmergencia' => 'Miguel Bonilla',
			'telefonoEmergencia' => '042122815',
			'ficha_medica' =>'test.pdf',
			'matricula' => 'Ordinaria',
			'idPadre' => $padre->id,
			'idMadre' => $madre->id,
			'transporte_id' => $transporte->id,
		]);
		
		$this->assertDatabaseHas('clientes', [
			'nombres' => 'Diego',
			'apellidos' => 'Bonilla',
			'cedula_ruc' => '0930307178',
			'direccion' => 'Ciudad las Joyas',
			'correo' => 'diegobonilla@gmail.com',
			'telefono' => '0996690123',
			'parentezco' => 'Madre',
			'fecha_nacimiento' => '1995-06-24',
			'telefono_domicilio' => '042158535',
			'profesion' => 'Programador Full Stack',
			'lugar_Trabajo' => 'Udesa central',
			'telefono_trabajo' => '065809675',
			'nacionalidad' => 'Ecuatoriana'
		]);

		$student = Student2::where('nombres', 'Miguel Vinicio')->first();
		$cliente = Cliente::where('nombres', 'Diego')->first();
		$this->assertDatabaseHas('students2_profile_per_year', [
			'celular' => '0969900987',
			'ingreso_familiar' => '1200',
			'fecha_ingreso_pais' => '2010-01-01',
			'fecha_expiracion_pasaporte' => '2020-01-01',
			'fecha_caducidad_pasaporte' => '2012-06-06',
			'inclusion' => 1,
			'numero_carnet' => '123456789',
			'alergias' => 'A la manzana',
			'seguro_institucional' => 'Si',
			'nombre_seguro' => 'Seguro 2',
			'discapacidad' => 'Motor A',
			'condicionado' => 'Si',
			'estado_civil_padres' => 'Casados',
			'fecha_matriculacion' => '2019-06-24',
			'idCurso' => $course->id,
			'idRepresentante' => $representante->id,
			'idStudent' => $student->id,
			'transporte_id' => $transporte->id,
			'idCliente' => $cliente->id,
			'tipo_matricula' => 'Ordinaria',
			'seccion' => 'EGB',
			'ciudad_domicilio' => 'Guayaquil',
			'direccion_domicilio' => 'Coop juan montalvo Mz a14 v25',
			'telefono_movil' => '0996690636',
			'tipo_vivienda' => 'tipo vivienda',
			'nacionalidad' => 'Ecuatoriano',
			'hospital' => 'clinica centro',
			'indicaciones' => 'indicaciones etc etc',
			'nombre_contacto_emergencia' => 'Miguel Bonilla',
			'movil_contacto_emergencia' => '042122815',
			'ficha_medica' => 'test.pdf',
			'retirado' => 'NO'
		]);
	}

	/** @test */
    public function actualizando_un_estudiante_con_pagos_activo() {
		$padre = factory(Parents::class)->create([
			'sexo' => 'Masculino' ]);
		$madre = factory(Parents::class)->create([
			'sexo' => 'Femenino' ]);
		$confSistema = ConfiguracionSistema::where('nombre','CONTADOR_MATRICULA')
			->where('idPeriodo', Institution::first()->periodoLectivo)
			->first();
		$confSistema->valor = 'G';
		$confSistema->save();
		$transporte = factory(Transporte::class)->create([
			'idPeriodo' => Institution::first()->periodoLectivo ]);
		$course = factory(Course::class)->create([
			'grado' => 'Segundo',
			'paralelo' => 'A',
			'seccion' => 'EGB',
			'especializacion' => null]);
		$usuario = factory(Usuario::class)->create();
		$representante = factory(User::class)->create([
			'userid' => $usuario->id,
			'correo' => $usuario->email,
			'cargo' => 'Representante'
		]);
		$this->seed(factoryEstudiante::class);
		$student = Student2::where('ci', '1234567890')->first();
		$this->browse(function (Browser $browser) use ($transporte, $course, $representante, $padre, $madre, $student) {
			$browser->visit('/')
			->type('email', 'soporte@pined.ec')
			->type('password', 'adminPINED')
			->press('Ingresar')
            ->visit("/Editar Matricula/{$student->id}/1")
			->type('ci', '0930307444')
			->keys('[name="fecha_matriculacion"]', '06242019')
			->type('nombres', 'Miguel Vinicio')
			->type('apellidos', 'Bonifaz Calderon')
			->type('correo', 'miguelbonifaz126@gmail.com')
			->keys('[name="fechaNacimiento"]', '06241991')
			->keys('[name="fecha_ingreso_pais"]', '01012010')
			->keys('[name="fecha_expiracion_pasaporte"]', '01012020')
			->keys('[name="fecha_caducidad_pasaporte"]', '06062012')
			->select('sexo', 'Masculino')
			->type('celular_estudiante', '0969900987')
			->type('ingreso_familiar', '1200')
			->type('ciudad', 'Guayaquil')
			->type('direccion', 'Coop juan montalvo Mz a14 v25')
			->type('telefono', '0996690636')
			->type('tipoVivienda', 'tipo vivienda')
			->type('nacionalidad', 'Ecuatoriano')
			->type('lugarNacimiento', 'Guayaquil-nacimiento')
			->type('provincia', 'Guayas')
			->type('canton', 'Canton')
			->type('parroquia', 'Parroquia')
			->type('institucionAnterior', 'ACADEMIA NAVAL ALMIRANTE ILLINGWORTH')
			->type('razonCambio', 'razon cambio')
			->type('observaciones', 'observaciones porque el cambio')
			->type('clinica', 'clinica centro')
			->type('indicaciones', 'indicaciones etc etc')
			->type('tipoSangre', 'A+')
			->type('alergias', 'A la manzana')
			->select('inclusion', 'Si')
			->type('numero_carnet', '123456789')
			->select('seguro_institucional', 'Si')
			->select('nombre_seguro', 'Seguro 2')
			->select('discapacidad', 'Motor A')
			->select('condicionado', 'Si')
			->select('estado_civil_padres', 'Casados')
			->type('contactoEmergencia', 'Miguel Bonilla')
			->type('telefonoEmergencia', '042122815')
			// ->attach('fichaMedica','public/test.pdf')
			->select('matricula', 'Ordinaria')
			->select('curso', $course->id)
			->select('transporte', $transporte->id)
			->select('idRepresentante', $representante->id)
			->select('idPadre', $padre->id)
			->select('idMadre', $madre->id)
			// Facturación cliente
			->type('numero_identificacion', '0930307178')
			->type('facturacion_nombres', 'Diego')
			->type('facturacion_apellidos', 'Bonilla')
			->type('facturacion_correo', 'diegobonilla@gmail.com')
			->type('facturacion_movil', '0996690123')
			->type('facturacion_direccion', 'Ciudad las Joyas')
			->select('facturacion_parentezco', 'Madre')
			->keys('[name="facturacion_fecha_nacimiento"]', '06241995')
			->type('facturacion_telefono_domicilio', '042158535')
			->type('facturacion_profesion', 'Programador Full Stack')
			->type('facturacion_lugar_trabajo', 'Udesa central')
			->type('facturacion_telefono_trabajo', '065809675')
			->type('facturacion_nacionalidad', 'Ecuatoriana')
			->press('Actualizar Estudiante')
			->assertPathIs("/Editar%20Matricula/{$student->id}/1")
			->assertSee('Realizar Pago')
			->assertSee('Miguel Vinicio');
		});

		$user = Usuario::where('email', 'miguelbonifaz126@gmail.com')->first();
		$this->assertDatabaseHas('users_profile', [
			'ci' =>'0930307444',
			'nombres' => 'Miguel Vinicio',
			'apellidos' => 'Bonifaz Calderon',
			'sexo' => 'Masculino',
			'correo' => 'miguelbonifaz126@gmail.com',
			'fNacimiento' => '1991-06-24',
			'cargo' => 'Estudiante',
			'userid' => $user->id
		]);
		
		$this->assertDatabaseHas('users', [
			'email' => 'miguelbonifaz126@gmail.com',
		]);

		$this->assertDatabaseHas('students2', [
			'ci' => '0930307444',
			'nombres' => 'Miguel Vinicio',
			'apellidos' => 'Bonifaz Calderon',
			'fechaNacimiento' => '1991-06-24',
			'fecha_matriculacion' => '2019-06-24',
			'sexo' => 'Masculino',
			'ciudad' => 'Guayaquil',
			'direccion' => 'Coop juan montalvo Mz a14 v25',
			'telefono' => '0996690636',
			'tipoVivienda' => 'tipo vivienda',
			'nacionalidad' => 'Ecuatoriano',
			'canton' => 'Canton',
			'parroquia' => 'Parroquia',
			'lugarNacimiento' => 'Guayaquil-nacimiento',
			'provincia' => 'Guayas',
			'canton' => 'Canton',
			'parroquia' => 'Parroquia',
			'institucionAnterior' => 'ACADEMIA NAVAL ALMIRANTE ILLINGWORTH',
			'razonCambio' => 'razon cambio',
			'observaciones' => 'observaciones porque el cambio',
			'clinica' => 'clinica centro',
			'indicaciones' => 'indicaciones etc etc',
			'tipoSangre' => 'A+',
			'contactoEmergencia' => 'Miguel Bonilla',
			'telefonoEmergencia' => '042122815',
			// 'ficha_medica' =>'test.pdf',
			'matricula' => 'Ordinaria',
			'idPadre' => $padre->id,
			'idMadre' => $madre->id,
			'transporte_id' => $transporte->id,
		]);
		
		$this->assertDatabaseHas('clientes', [
			'nombres' => 'Diego',
			'apellidos' => 'Bonilla',
			'cedula_ruc' => '0930307178',
			'direccion' => 'Ciudad las Joyas',
			'correo' => 'diegobonilla@gmail.com',
			'telefono' => '0996690123',
			'parentezco' => 'Madre',
			'fecha_nacimiento' => '1995-06-24',
			'telefono_domicilio' => '042158535',
			'profesion' => 'Programador Full Stack',
			'lugar_Trabajo' => 'Udesa central',
			'telefono_trabajo' => '065809675',
			'nacionalidad' => 'Ecuatoriana'
		]);

		$student = Student2::where('nombres', 'Miguel Vinicio')->first();
		$cliente = Cliente::where('nombres', 'Diego')->first();
		$this->assertDatabaseHas('students2_profile_per_year', [
			'celular' => '0969900987',
			'ingreso_familiar' => '1200',
			'fecha_ingreso_pais' => '2010-01-01',
			'fecha_expiracion_pasaporte' => '2020-01-01',
			'fecha_caducidad_pasaporte' => '2012-06-06',
			'inclusion' => 1,
			'numero_carnet' => '123456789',
			'alergias' => 'A la manzana',
			'seguro_institucional' => 'Si',
			'nombre_seguro' => 'Seguro 2',
			'discapacidad' => 'Motor A',
			'condicionado' => 'Si',
			'estado_civil_padres' => 'Casados',
			'fecha_matriculacion' => '2019-06-24',
			'idCurso' => $course->id,
			'idRepresentante' => $representante->id,
			'idStudent' => $student->id,
			'transporte_id' => $transporte->id,
			'idCliente' => $cliente->id,
			'tipo_matricula' => 'Ordinaria',
			'seccion' => 'EGB',
			'ciudad_domicilio' => 'Guayaquil',
			'direccion_domicilio' => 'Coop juan montalvo Mz a14 v25',
			'telefono_movil' => '0996690636',
			'tipo_vivienda' => 'tipo vivienda',
			'nacionalidad' => 'Ecuatoriano',
			'hospital' => 'clinica centro',
			'indicaciones' => 'indicaciones etc etc',
			'nombre_contacto_emergencia' => 'Miguel Bonilla',
			'movil_contacto_emergencia' => '042122815',
			'ficha_medica' => 'test.pdf',
			'retirado' => 'NO'
		]);
	}
}
