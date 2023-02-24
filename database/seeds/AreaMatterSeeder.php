<?php

use Illuminate\Database\Seeder;
use App\Matter;
use App\Area;
class AreaMatterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $matters = Matter::all();
        $areas = Area::all();

        foreach ($matters as $key => $matter) {
            foreach ($areas as $areass){
                if ($matter->idArea == $areass->id){
                    $matter->area = $areass->nombre;
                    $matter->save();
                }
            }
        }
    }
}
