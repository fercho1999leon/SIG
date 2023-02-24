<?php

use App\Roles;
use App\Usuario;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PerfilSupervisorNovusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert(
            [
                ['name' =>  'Supervisor', 'slug'  =>  'UsersViews.supervisor',],
            ]
        );

        $emails = ['eperez@centroeducativonovus.edu.ec', 'mchiriboga@centroeducativonovus.edu.ec', 'jarmijo@centroeducativonovus.edu.ec'];

        $users = Usuario::whereIn('email', $emails)->get();

        foreach ($users as $user) {
            if ($user->email === 'eperez@centroeducativonovus.edu.ec') {
                $user->profile->type_of_supervisor = 'inicial_y_preparatorio';
                $user->profile->save();
            }

            if ($user->email === 'mchiriboga@centroeducativonovus.edu.ec') {
                $user->profile->type_of_supervisor = 'basica_elemental_y_media';
                $user->profile->save();
            }

            if ($user->email === 'jarmijo@centroeducativonovus.edu.ec') {
                $user->profile->type_of_supervisor = 'basica_superior_y_bachillerato';
                $user->profile->save();
            }
            
            DB::statement("UPDATE `pined`.`role_users` SET `role_id` = '8' WHERE `user_id` = '1434' AND `role_id` = '1';");
            DB::statement("UPDATE `pined`.`role_users` SET `role_id` = '8' WHERE `user_id` = '1435' AND `role_id` = '1';");
            DB::statement("UPDATE `pined`.`role_users` SET `role_id` = '8' WHERE `user_id` = '1436' AND `role_id` = '1';");
        }
    }
}
