<?php

namespace Tests\Feature\admin\matricula;

use App\Cliente;
use App\ConfiguracionSistema;
use App\Course;
use App\Institution;
use App\Parents;
use App\Payment;
use App\PeriodoLectivo;
use App\Rubro;
use App\Student2;
use App\Transporte;
use App\User;
use App\Usuario;
use Sentinel;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Carbon;

class creacionEstudianteTest extends TestCase
{
	use RefreshDatabase;

	/** @test */
    public function que_cargue_correctamente_la_pagina() {
		$this->loginUser(1);
		$this->get('/Crear Matricula')
			->assertSee('Matrícula Estudiantil:')
			->assertStatus(200);
	}

	/** @test */
	public function matriculando_un_estudiante() {
		$institution = Institution::first();
		$confSistema = ConfiguracionSistema::where('nombre','CONTADOR_MATRICULA')
			->where('idPeriodo', $institution->periodoLectivo)
			->first();
		$confSistema->valor = 'G';
		$confSistema->save();
		$course = factory(Course::class)->create(['grado' => 'Segundo', 'paralelo' => 'A', 'cupos' => 20]);
		$rubro = factory(Rubro::class)->create([
			'tipo_rubro' => 'Pension', 
			'tipo_emision' => 'FACTURA',
		]);
		$pago = factory(Payment::class)->create([
			'idCurso' => $course->id,
			'idRubro' => $rubro->id
		]);
		$usuario = factory(Usuario::class)->create();
		$representante = factory(User::class)->create([
			'userid' => $usuario->id,
			'correo' => $usuario->email
		]);

		$padre = factory(Parents::class)->create();
		$madre = factory(Parents::class)->create();
		$transporte = factory(Transporte::class)->create();

		$this->loginUser(1);
		
		$this->post('Crear Matricula', $this->dataStudents([
			'curso' => $course->id,
			'idRepresentante' => $representante->id,
			'idPadre' => $padre->id,
			'idMadre' => $madre->id,
			'transporte' => $transporte->id
		]));

		$user = Usuario::where('email', 'miguel@gmail.com')->first();
		$this->assertDatabaseHas('users_profile', [
			'ci' =>'0930307444',
			'nombres' => 'Miguel Vinicio',
			'apellidos' => 'Bonifaz Calderon',
			'sexo' => 'Masculino',
			'correo' => 'miguel@gmail.com',
			'fNacimiento' => '06-24-1991',
			'cargo' => 'Estudiante',
			'userid' => $user->id
		]);
		
		$this->assertDatabaseHas('users', [
			'email' => 'miguel@gmail.com',
		]);

		$this->assertDatabaseHas('students2', [
			'ci' => '0930307444',
			'nombres' => 'Miguel Vinicio',
			'apellidos' => 'Bonifaz Calderon',
			'fechaNacimiento' => '06-24-1991',
			'ciudad' => 'Guayaquil',
			'direccion' => 'Coop juan montalvo Mz a14 v25',
			'telefono' => '0996690636',
			'sexo' => 'Masculino',
			'nacionalidad' => 'Ecuatoriano',
			'lugarNacimiento' => 'Guayaquil-nacimiento',
			'tipoVivienda' => 'tipo vivienda',
			'institucionAnterior' => 'ACADEMIA NAVAL ALMIRANTE ILLINGWORTH',
			'razonCambio' => 'razon cambio',
			'observaciones' => 'observaciones porque el cambio',
			'clinica' => 'clinica centro',
			'indicaciones' => 'indicaciones etc etc',
			'tipoSangre' => 'A+',
			'contactoEmergencia' => 'Miguel Bonilla',
			'telefonoEmergencia' => '042122815',
			'matricula' => 'Ordinaria',
			'retirado' => 'NO',
			'provincia' => 'Guayas',
			'canton' => 'Canton',
			'parroquia' => 'Parroquia',
			'idCurso' => $course->id,
			'idMadre' => $madre->id,
			'idPadre' => $padre->id,
			'transporte_id' => $transporte->id,
			'fecha_matriculacion' => '2019-06-24'
		]);
		
		$this->assertDatabaseHas('clientes', [
			'nombres' => 'Diego',
			'apellidos' => 'Bonilla',
			'cedula_ruc' => '0930307178',
			'direccion' => 'Ciudad las Joyas',
			'correo' => 'diegobonilla@gmail.com',
			'telefono' => '0996690123',
		]);

		$student = Student2::where('nombres', 'Miguel Vinicio')->first();
		$cliente = Cliente::where('nombres', 'Diego')->first();
		$this->assertDatabaseHas('students2_profile_per_year', [
			'fecha_matriculacion' => '2019-06-24',
			'idCurso' => $course->id,
			'idCliente' => $cliente->id,
			'idRepresentante' => $representante->id,
			'idStudent' => $student->id,
			'transporte_id' => $transporte->id,
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
			'retirado' => 'NO'
		]);
		$this->assertDatabaseHas('pago_estudiante_detalles', [
			'estado' => 'PENDIENTE',
			'idEstudiante' => $student->id,
			'idPago' => $pago->id
		]);
	}

	/** @test */
	public function pasando_un_estudiante_al_siguiente_periodo() {
		$institution = Institution::first();
		$periodoLectivo = PeriodoLectivo::where('nombre', '2020-2021')->first();
		$confSistema = ConfiguracionSistema::where('nombre','CONTADOR_MATRICULA')
			->where('idPeriodo', $institution->periodoLectivo)
			->first();
		$confSistema->valor = 'G';
		$confSistema->save();
		// $student->
		$course = factory(Course::class)->create([
			'grado' => 'Segundo', 
			'paralelo' => 'A', 
			'cupos' => 20,
			'idPeriodo' => $periodoLectivo->id
		]);
		$this->loginUser(1);
		
		$this->post("student/pasar-de-periodo-lectivo/$student->id", [
			'idCurso' => $course->id,
			'tipo_matricula' => 'Ordinaria'
		]);
	}

	protected function dataStudents($array = []) {
		$data = [
			'ci' => '0930307444',
			'fecha_matriculacion' => Carbon::createFromDate('2019', '06', '24')->format('Y-m-d'),
			'nombres' => 'Miguel Vinicio',
			'apellidos' => 'Bonifaz Calderon',
			'correo' => 'miguel@gmail.com',
			'fechaNacimiento' => '06-24-1991',
			'sexo' => 'Masculino',
			'ciudad' => 'Guayaquil',
			'seccion' => 'EGB',
			'direccion' => 'Coop juan montalvo Mz a14 v25',
			'telefono' => '0996690636',
			'tipoVivienda' => 'tipo vivienda',
			'nacionalidad' => 'Ecuatoriano',
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
			'retirado' => 'NO',
			'beca' => '0',
			// fichaMedica','public/test.pdf',
			'matricula' => 'Ordinaria',
			// 'curso' => $course->i,
			// 'transporte' => $transporte->i,
			// 'idRepresentante' => $representante->i,
			// 'idPadre' => $padre->i,
			// 'idMadre' => $madre->i,
			'numero_identificacion' => '0930307178',
			'facturacion_nombres' => 'Diego',
			'facturacion_apellidos' => 'Bonilla',
			'facturacion_correo' => 'diegobonilla@gmail.com',
			'facturacion_movil' => '0996690123',
			'facturacion_direccion' => 'Ciudad las Joyas'
		];

		return array_merge($data, $array);
	}
}
