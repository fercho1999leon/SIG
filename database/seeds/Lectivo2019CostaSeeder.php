<?php

use Illuminate\Database\Seeder;
use App\Institution;

class Lectivo2019CostaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $periodoLectivo = Institution::first();
        $periodoLectivo->periodoLectivo = 1; 
        $periodoLectivo->save();
    }
}
