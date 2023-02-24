<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\User;
use App\Usuario;
use Sentinel;
use Illuminate\Foundation\Testing\RefreshDatabase;

class perfilTest extends TestCase
{
	use RefreshDatabase;
	
	/** @test */
	public function ver_datos_del_usuario() {
		$this->get('/Crear Matricula')
		->assertSee('DATOS BÁSICOS')
		->assertStatus(200);
	}

	/** @test */
	public function registrando_un_transporte() {
		$this->withoutExceptionHandling();
		$user = Sentinel::findById(1);
		Sentinel::login($user);
		$this->get('/transporte')
		->assertStatus(200);

	}
}
