<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		DB::statement('SET FOREIGN_KEY_CHECKS = 0;');
		DB::table('activations')->truncate();
		DB::table('configuracionesparcial')->truncate();
		DB::table('configuracionessistema')->truncate();
		DB::table('periodo_lectivo')->truncate();
		DB::table('roles')->truncate();
		DB::table('role_users')->truncate();
		DB::table('institution')->truncate();
		DB::table('users')->truncate();
		DB::table('users_profile')->truncate();
		DB::statement('SET FOREIGN_KEY_CHECKS = 1;');

        $this->call(InstitucionTableSeeder::class);
		$this->call(RolesTableSeeder::class);
        $this->call(periodoLectivoInstitucionSeeder::class);
		$this->call(Lectivo2019CostaSeeder::class);
		$this->call(UsersTableSeeder::class);
		$this->call(CosasAdicionales::class);
		$this->call(ConfiguracionesSistemaSeeder::class);
		$this->call(SeAgregaNuevaConfiguracionBecas::class);
        $this->call(Menu::class);
		$this->call(UnidadesParcialesSeeder::class);
		$this->call(EstructuraCualitativaSeeder::class);
    }
}
