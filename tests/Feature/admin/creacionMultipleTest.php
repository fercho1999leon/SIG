<?php

namespace Tests\Feature\admin;

use App\Cliente;
use App\Parents;
use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;

class creacionMultipleTest extends TestCase
{
	use RefreshDatabase;
    /** @test */
	public function creando_usuario_representante() {
		$this->loginUser(1);
		$this->withExceptionHandling();
		$this->post('FichasPersonales/administrativos/crear', [
			"ci" => "0930307178",
			"nombres" => "Miguel",
			"apellidos" => "Bonifaz",
			"sexo" => "Masculino",
			"nacionalidad" => "nacionalidad",
			"fNacimiento" => "1991-06-24",
			"correo" => "miguel@gmail.com",
			"movil" => "0996690636",
			"profesion" => "profesion",
			"lugar_trabajo" => "lugar trabajo",
			"telefono_trabajo" => "telefono trabajo",
			"ex_alumno" => 'Si',
			"fecha_promocion" => "1991-06-24",
			"fecha_ingreso" => "1992-06-24",
			"fecha_estado_migratorio" => "1993-06-24",
			"fecha_exp_pasaporte" => "1994-06-24",
			"fecha_caducidad_pasaporte" => "1995-06-23",
			"bio" => "biografia",
			"dDomicilio" => "direccion domicilio",
			"tDomicilio" => "042122815",
			// 'crearCliente' => 'on',
			'tipo_usuario' => 'Representante',
			// Cliente
			"parentezco" => 'Tia',
			// Padre
			"estado_civil" => null,
			"fallecido" => "No",
			"autorizacion_retirar_estudiante" => "Si",
			"religion" => null,
			"ciudadDomicilio" => null,
			"ciudadTrabajo" => null,
			"direccionTrabajo" => null,
			"cargoTrabajo" => null,
			"lugar_nacimiento" => null,
			"provincia" => null,
			"canton" => null,
			"parroquia" => null,
			"estudios" => null,
			"clinica" => null,
			"indicaciones" => null,
			"tipo_sangre" => "O+",
			"contacto_emergencia" => null,
			"telefono_emergencia" => null,
			"observacion_emergencia" => null,
			"cargo" => "Representante",
		]);
		
		$this->assertEquals(Cliente::count(), 0);
		$this->assertEquals(Parents::count(), 0);

		$this->assertDatabaseHas('users_profile', [
			"ci" => "0930307178",
			"nombres" => "Miguel",
			"apellidos" => "Bonifaz",
			"sexo" => "Masculino",
			"nacionalidad" => "nacionalidad",
			"fNacimiento" => "1991-06-24",
			"correo" => "miguel@gmail.com",
			"movil" => "0996690636",
			"profesion" => "profesion",
			"lugar_trabajo" => "lugar trabajo",
			"telefono_trabajo" => "telefono trabajo",
			"ex_alumno" => 1,
			"fecha_promocion" => "1991-06-24",
			"fecha_ingreso" => "1992-06-24",
			"fecha_estado_migratorio" => "1993-06-24",
			"fecha_exp_pasaporte" => "1994-06-24",
			"fecha_caducidad_pasaporte" => "1995-06-23",
			"bio" => "biografia",
			"dDomicilio" => "direccion domicilio",
			"tDomicilio" => "042122815",
		]);
	}

    /** @test */
	public function creando_usuario_representante_y_cliente_a_la_vez() {
		$this->loginUser(1);
		$this->withExceptionHandling();
		$this->post('FichasPersonales/administrativos/crear', [
			"ci" => "0930307178",
			"nombres" => "Miguel",
			"apellidos" => "Bonifaz",
			"sexo" => "Masculino",
			"nacionalidad" => "nacionalidad",
			"fNacimiento" => "1991-06-24",
			"correo" => "miguel@gmail.com",
			"movil" => "0996690636",
			"profesion" => "profesion",
			"lugar_trabajo" => "lugar trabajo",
			"telefono_trabajo" => "telefono trabajo",
			"ex_alumno" => 'Si',
			"fecha_promocion" => "1991-06-24",
			"fecha_ingreso" => "1992-06-24",
			"fecha_estado_migratorio" => "1993-06-24",
			"fecha_exp_pasaporte" => "1994-06-24",
			"fecha_caducidad_pasaporte" => "1995-06-23",
			"bio" => "biografia",
			"dDomicilio" => "direccion domicilio",
			"tDomicilio" => "042122815",
			'crearCliente' => 'on',
			'tipo_usuario' => 'Representante',
			// Cliente
			"parentezco" => 'Tia',
			
		]);
		
		$this->assertDatabaseHas('users_profile', [
			"ci" => "0930307178",
			"nombres" => "Miguel",
			"apellidos" => "Bonifaz",
			"sexo" => "Masculino",
			"nacionalidad" => "nacionalidad",
			"fNacimiento" => "1991-06-24",
			"correo" => "miguel@gmail.com",
			"movil" => "0996690636",
			"profesion" => "profesion",
			"lugar_trabajo" => "lugar trabajo",
			"telefono_trabajo" => "telefono trabajo",
			"ex_alumno" => 1,
			"fecha_promocion" => "1991-06-24",
			"fecha_ingreso" => "1992-06-24",
			"fecha_estado_migratorio" => "1993-06-24",
			"fecha_exp_pasaporte" => "1994-06-24",
			"fecha_caducidad_pasaporte" => "1995-06-23",
			"bio" => "biografia",
			"dDomicilio" => "direccion domicilio",
			"tDomicilio" => "042122815",
		]);

		$this->assertDatabaseHas('clientes', [
			'cedula_ruc' => '0930307178',
			'nombres' => 'Miguel',
			'apellidos' => 'Bonifaz',
			'correo' => 'miguel@gmail.com',
			'telefono' => '0996690636',
			'direccion' => 'direccion domicilio',
			'parentezco' => 'Tia',
			'fecha_nacimiento' => '1991-06-24',
			'telefono_domicilio' => '042122815',
			'profesion' => 'profesion',
			'lugar_trabajo' => 'lugar trabajo',
			'telefono_trabajo' => 'telefono trabajo',
			'nacionalidad' => 'nacionalidad',
		]);

		$this->assertEquals(Cliente::count(), 1);
		$this->assertEquals(Parents::count(), 0);
	}

    /** @test */
	public function creando_usuario_representante_coma_cliente_y_padre() {
		$this->loginUser(1);
		$this->withExceptionHandling();
		$this->post('FichasPersonales/administrativos/crear', [
			"ci" => "0930307178",
			"nombres" => "Miguel",
			"apellidos" => "Bonifaz",
			"sexo" => "Masculino",
			"nacionalidad" => "nacionalidad",
			"fNacimiento" => "1991-06-24",
			"correo" => "miguel@gmail.com",
			"movil" => "0996690636",
			"profesion" => "profesion",
			"lugar_trabajo" => "lugar trabajo",
			"telefono_trabajo" => "telefono trabajo",
			"ex_alumno" => 'Si',
			"fecha_promocion" => "1991-06-24",
			"fecha_ingreso" => "1992-06-24",
			"fecha_estado_migratorio" => "1993-06-24",
			"fecha_exp_pasaporte" => "1994-06-24",
			"fecha_caducidad_pasaporte" => "1995-06-23",
			"bio" => "biografia",
			"dDomicilio" => "direccion domicilio",
			"tDomicilio" => "042122815",
			'crearCliente' => 'on',
			'tipo_usuario' => 'Representante',
			// Cliente
			"parentezco" => 'Tia',
			// Padre
			'estado_civil' => 'Divorciado(a)',
			'fallecido' => 'Si',
			'autorizacion_retirar_estudiante' => 'Si',
			'religion' => 'cristiano',
			'ciudadDomicilio' => 'ciudad domicilio padre',
			'ciudadTrabajo' => 'Quevedo',
			'ciudadTrabajo' => 'Quito',
			'direccionTrabajo' => 'Direccion del trabajo',
			'cargoTrabajo' => 'Programador',
			'lugar_nacimiento' => 'Machala',
			'provincia' => 'Guayas',
			'canton' => 'canton',
			'parroquia' => 'Parroquia',
			'estudios' => 'estudios',
			'clinica' => 'Clinica etc',
			'indicaciones' => 'indicaciones del paciente',
			'tipo_sangre' => 'O-',
			'contacto_emergencia' => 'contacto_emergencia',
			'telefono_emergencia' => 'telefono_emergencia',
			'observacion_emergencia' => 'observacion_emergencia',
		]);
		
		$this->assertDatabaseHas('users_profile', [
			"ci" => "0930307178",
			"nombres" => "Miguel",
			"apellidos" => "Bonifaz",
			"sexo" => "Masculino",
			"nacionalidad" => "nacionalidad",
			"fNacimiento" => "1991-06-24",
			"correo" => "miguel@gmail.com",
			"movil" => "0996690636",
			"profesion" => "profesion",
			"lugar_trabajo" => "lugar trabajo",
			"telefono_trabajo" => "telefono trabajo",
			"ex_alumno" => 1,
			"fecha_promocion" => "1991-06-24",
			"fecha_ingreso" => "1992-06-24",
			"fecha_estado_migratorio" => "1993-06-24",
			"fecha_exp_pasaporte" => "1994-06-24",
			"fecha_caducidad_pasaporte" => "1995-06-23",
			"bio" => "biografia",
			"dDomicilio" => "direccion domicilio",
			"tDomicilio" => "042122815",
		]);

		$this->assertDatabaseHas('clientes', [
			'cedula_ruc' => '0930307178',
			'nombres' => 'Miguel',
			'apellidos' => 'Bonifaz',
			'correo' => 'miguel@gmail.com',
			'telefono' => '0996690636',
			'direccion' => 'direccion domicilio',
			'parentezco' => 'Tia',
			'fecha_nacimiento' => '1991-06-24',
			'telefono_domicilio' => '042122815',
			'profesion' => 'profesion',
			'lugar_trabajo' => 'lugar trabajo',
			'telefono_trabajo' => 'telefono trabajo',
			'nacionalidad' => 'nacionalidad',
		]);

		$this->assertDatabaseHas('datospadres', [
			'ci' => '',
			'nombres' => '',
			'apellidos' => '',
			'sexo' => '',
			'parentezco' => '',
			'fNacimiento' => '',
			'estado_civil' => '',
			'fallecido' => '',
			'correo' => '',
			'movil' => '',
			'bio' => '',
			'autorizadoRetirarEstudiante' => '',
			'religion' => '',
			'ciudadDomicilio' => '',
			'direccionDomicilio' => '',
			'telefonoDomicilio' => '',
			'ciudadTrabajo' => '',
			'direccionTrabajo' => '',
			'telefonoTrabajo' => '',
			'cargoTrabajo' => '',
			'lugarTrabajo' => '',
			'profesion' => '',
			'ex_alumno' => '',
			'fecha_promocion' => '',
			'fecha_ingreso_pais' => '',
			'fecha_expiracion_pasaporte' => '',
			'fecha_caducidad_pasaporte' => '',
			'nacionalidad' => '',
			'lugarNacimiento' => '',
			'provincia' => '',
			'canton' => '',
			'parroquia' => '',
			'estudios' => '',
			'clinica' => '',
			'indicaciones' => '',
			'tipoSangre' => '',
			'contactoEmergencia' => '',
			'telefonoEmergencia' => '',
			'observacionEmergencia' => '',
		]);

		$this->assertEquals(Cliente::count(), 1);
		$this->assertEquals(Parents::count(), 1);
	}
}
