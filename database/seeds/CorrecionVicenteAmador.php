<?php

use App\Roles;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CorrecionVicenteAmador extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('role_users')
            ->where('user_id', '>', 30)
            ->delete();

        DB::table('role_users')
            ->where('user_id', '>', 22)
            ->where('user_id', '<', 30)
            ->delete();
        
        DB::table('role_users')
            ->where(['user_id' => 21, 'role_id' => 6])
            ->delete();

        DB::table('role_users')
            ->where(['user_id' => 20, 'role_id' => 6])
            ->delete();

        DB::table('role_users')
            ->where(['user_id' => 22, 'role_id' => 6])
            ->delete();

        DB::table('role_users')
            ->where(['user_id' => 30, 'role_id' => 6])
            ->delete();
    }

    public function delete($roles) {
        foreach ($roles as $rol) {
            $rol->delete();
        }
    }
}
