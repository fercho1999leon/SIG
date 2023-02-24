<?php

namespace Tests\Browser\Admin;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Student2;
use App\BecaDetalle;
use App\BecaDescuento;

class pagosTest extends DuskTestCase
{
	use DatabaseMigrations;
	
    /** @test */
    public function pago_pension_completo_sin_beca_y_sin_descuento() {
		$this->browse(function (Browser $browser) {
			$this->realizandoPago(190, $browser);
			$browser->assertSee('PAGADO');
		});
	}

    /** @test */
    public function pago_pension_completo_con_beca_en_porcentaje() {
		$this->creandoUnaBeca('BECA', 'PORCENTAJE', 15);
        $this->browse(function (Browser $browser) {
			$this->realizandoPago(161.5, $browser);
			$browser->assertSee('PAGADO');
		});
	}

    /** @test */
    public function pago_pension_completo_con_beca_en_dolares() {
		
		$this->creandoUnaBeca('BECA', 'USD', 75);
		$this->browse(function (Browser $browser) {
			$this->realizandoPago(115, $browser);
			$browser->assertSee('PAGADO');
        });
	}

    /** @test */
    public function realizando_abono_sin_beca_y_sin_descuento() {
		$this->browse(function (Browser $browser) {
			$this->realizandoAbono(100, $browser);
			$this->assertDatabaseHas('abonos', [
				'cantidad' => 100,
			]);
		});
	}

    /** @test */
    public function realizando_abono_con_beca_en_porcentaje() {
		$this->creandoUnaBeca('BECA', 'PORCENTAJE', 15);
        $this->browse(function (Browser $browser) {
			$this->realizandoAbono(50, $browser);
			$this->assertDatabaseHas('abonos', [
				'cantidad' => 50
			]);
		});
	}

    /** @test */
    public function realizando_abono_con_beca_en_dolares() {
		
		$this->creandoUnaBeca('BECA', 'USD', 75);
		$this->browse(function (Browser $browser) {
			$this->realizandoPago(30, $browser);
			$this->assertDatabaseHas('abonos', [
				'cantidad' => 30
			]);
        });
	}

	protected function realizandoPago($pago, $browser) {
		$browser->visit('/')
			->type('email', 'soporte@pined.ec')
			->type('password', 'adminPINED')
			->press('Ingresar')
			->visit('/Pagos')
			->assertSee('Pagos')
			->clickLink('Segundo  A')
			->clickLink('Miguel Vinicio')
			->assertSee('Miguel Vinicio')
			->clickLink('Realizar Pago')
			->assertSee($pago)
			->type('cedula_ruc', '0930307178')
			->type('nombres', 'Darwin Leon Ramos')
			->type('apellidos', 'Ramos')
			->type('apellidos', 'Ramos')
			->type('telefono', '0996690636')
			->type('email', 'miguel@gmail.com')
			->type('direccion', 'Km 8 1/2 via daule, coop juan montalvo MZ A 14 Villa 25')
			->type('valor_pagar', $pago)
			->press('Realizar Pago');
	}

	protected function realizandoAbono($pago, $browser) {
		$browser->visit('/')
			->type('email', 'soporte@pined.ec')
			->type('password', 'adminPINED')
			->press('Ingresar')
			->visit('/Pagos')
			->assertSee('Pagos')
			->clickLink('Segundo  A')
			->clickLink('Miguel Vinicio')
			->assertSee('Miguel Vinicio')
			->clickLink('Realizar Pago')
			->type('cedula_ruc', '0930307178')
			->type('nombres', 'Darwin Leon Ramos')
			->type('apellidos', 'Ramos')
			->type('apellidos', 'Ramos')
			->type('telefono', '0996690636')
			->type('email', 'miguel@gmail.com')
			->type('direccion', 'Km 8 1/2 via daule, coop juan montalvo MZ A 14 Villa 25')
			->type('valor_pagar', $pago)
			->press('Realizar Pago')
			->assertSee('PENDIENTE')
			->assertSee('Historico');
	}

	protected function otroPago($pago, $browser) {
		$browser->visit('/')
			->clickLink('Realizar Pago')
			->type('cedula_ruc', '0930307178')
			->type('nombres', 'Darwin Leon Ramos')
			->type('apellidos', 'Ramos')
			->type('apellidos', 'Ramos')
			->type('telefono', '0996690636')
			->type('email', 'miguel@gmail.com')
			->type('direccion', 'Km 8 1/2 via daule, coop juan montalvo MZ A 14 Villa 25')
			->type('valor_pagar', $pago)
			->press('Realizar Pago')
			->assertSee('Historico')
			->assertSee('PENDIENTE');
	}

	protected function creandoUnaBeca($nombreBeca, $tipoPago, $cantidad) {
		$student = Student2::whereNombres('Miguel Vinicio')->first();
		$beca = factory(BecaDescuento::class)->create([
			'tipo' => $nombreBeca,
			'tipo_pago' => $tipoPago,
			'valor' => $cantidad
		]);

		factory(BecaDetalle::class)->create([
			'idBeca' => $beca->id,
			'idEstudiante' => $student->id
		]);
	}
}
