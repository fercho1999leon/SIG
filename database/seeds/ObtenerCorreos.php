<?php

use Illuminate\Database\Seeder;
use App\Administrative;

class ObtenerCorreos extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = Administrative::all();

        $myfile = fopen("correos.txt", "w") or die("Unable to open file!");
        foreach($users as $user)
        {                        
            fwrite($myfile, $user->correo."\n");            
        }
        fclose($myfile);
    }
}
