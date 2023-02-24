<?php

use App\Parents;
use Illuminate\Database\Seeder;

class CorrecionPArentezcoDatosPadres extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $padres = Parents::all();
        foreach ($padres as $padre) {
            if ($padre->parentezco === 'Madres') {
                $padre->parentezco = 'Madre';
                $padre->save();
            }
        }
    }
}
