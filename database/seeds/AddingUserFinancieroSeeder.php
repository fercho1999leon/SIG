<?php

use Illuminate\Database\Seeder;

class AddingUserFinancieroSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
			'slug' => 'UsersViews.financiero',
			'name' => 'Financiero'
		]);
    }
}
