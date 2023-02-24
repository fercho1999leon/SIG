<?php

use Illuminate\Database\Seeder;


class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        \DB::table('roles')->insert(
            [
                ['name'    =>    'Administrador', 'slug'    =>    'UsersViews.administrador'],
                ['name'    =>    'Secretaria', 'slug'    =>    'UsersViews.secretaria',],
                ['name'    =>    'Colecturia', 'slug'    =>    'UsersViews.colecturia',],
                ['name'    =>    'Docente', 'slug'    =>    'UsersViews.docente',],
                ['name'    =>    'Representante', 'slug'    =>    'UsersViews.representante',],
                ['name' =>  'Estudiante', 'slug'  =>  'UsersViews.estudiante',],
                ['name' =>  'Financiero', 'slug'  =>  'UsersViews.financiero',],
                ['name' =>  'Supervisor', 'slug'  =>  'UsersViews.supervisor',],
            ]
        );
    }
}
